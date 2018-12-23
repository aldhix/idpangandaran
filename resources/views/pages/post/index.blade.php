@extends('layouts.main')
@section('title','Post')

@section('breadcrumb')
<li class="breadcrumb-item active">Post</li>
@endsection

@section('content')
<div id="app" class="mb-3">
	
<h1>Posts {{$domain->domain}}</h1>
<hr>

<div class="alert alert-success alert-dismissible" role="alert" v-show="success">
  <strong>Deleted Successfully!</strong> Data has been successfully deleted.
  <button type="button" class="close" v-on:click="success = false">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- Search -->
<div class="row">
	<div class="col-2">
		<a href="{{route('admin.post.add',['iddomain'=>$domain->id])}}" 
		class="btn btn-success">
		<i class="fas fa-plus"></i> Add Post</a>
	</div>
	<div class="offset-3"></div>
	<div class="col-3">
		<select class="form-control" v-model="kategori">
			<option value="">Semua Kategori</option>
			@foreach(
				App\Categorie::whereNotIn('id',[1])
				->where('id_domain',$domain->id)
				->orderBy('nama_categorie','desc')
				->get() as $data)
			<option value="{{$data->id}}">{{$data->nama_categorie}}</option>
			@endforeach
			<option value="1">Uncategory</option>
		</select>
	</div>
	<div class="col-4">
		<div class="input-group">
			<input type="text" class="form-control" v-model="keyword">
			<div class="input-group-append">
				<button type="button" class="btn btn-primary" v-on:click="search">Cari</button>
			</div>
		</div>
	</div>
</div>

<!-- List data post -->
<div class="media mt-3" v-for="(post, i) in postData">
  <img class="mr-3" :src="`{{url('images/photos/thumbs/thumb_')}}${post.filename}`" 
  alt="Generic placeholder image">
  <div class="media-body">
    <h5 class="mt-0"><a href="#">@{{post.title}}</a></h5>
    <span class="text-muted">@{{post.kategori}}</span>
    <br>
    @{{post.description}}
    <p>
    	<a :href="`${routeEdit(post.id)}`" class="mr-3 text-success"><i class="fas fa-edit"></i> Edit</a>
    	<a href="javascript:;" class="text-danger" v-on:click="hapus(post.id)"><i class="fas fa-trash"></i> Delete</a>
		| <span class="text-muted capitalize">@{{post.type_save}}</span>
		<small class="text-muted">- @{{tanggal(post.create)}}</small>	
    </p>
  </div>
</div>

<!-- Pagging -->
<nav class="mt-3">
    <ul class="pagination pagination-sm">
      <li class="page-item" v-if="posts.current_page > 1 ">
      <a class="page-link" href="javascript:;" :data-id="`${posts.current_page-1}`" 
      v-on:click="pages">Previous</a></li>
      <li class="page-item disabled" v-else>
      <span class="page-link">Previous</span></li>

      <li class="page-item" 
      v-for="i in posts.last_page" 
      :class="{'active' : i === posts.current_page}">
        <a class="page-link" href="javascript:;" :data-id="`${i}`" v-on:click="pages">@{{i}}</a>
      </li>
      <li class="page-item" v-if="posts.current_page < posts.last_page ">
      <a class="page-link" href="javascript:;" :data-id="`${posts.current_page+1}`" v-on:click="pages">Next</a></li>
      <li class="page-item disabled" v-else>
      <span class="page-link">Next</span></li>
    </ul>
 </nav>

<!-- Dialog Hapus -->
<div class="modal fade m-hapus" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah yakin akan dihapus?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-primary" v-on:click="yes">Ya</button>
      </div>
    </div>
  </div>
</div>

</div>
@endsection

@push('css')
<style type="text/css">
.deck {
   display: flex;
   flex-wrap: wrap;
}

.deck > div[class*='col-'] {
  display: flex;
}
.media img{
	height: 100px;
}

.capitalize {
  text-transform: capitalize;
}

.tanggal {
  text-transform: tanggal;
}

</style>
@endpush

@push('js')
<?php 
$jscssadmin = new \App\Libs\JsCssAdmin;
$js = $jscssadmin->js('Vue.js v2.5.17')
	 .$jscssadmin->js('axios v0.18.0')
	 .$jscssadmin->js('moment');

echo $js;
$post = App\Post::joinSelectAdmin()
->where('domains.id',$domain->id)
->orderBy('posts.id','desc')
->paginate(5);
?>
<script type="text/javascript">
var iddomain = "{{$domain->id}}";
var urlEdit = "{{route('admin.post.edit',['id'=>':id','iddomain'=>$domain->id])}}";
var app = new Vue({
	el : '#app',
	data : {
		keyword : '',
		kategori : '',
		id : 0,
		pageNow : 1,
		success : false,
		posts : <?= json_encode($post)?>,
	},
	computed : {
		postData : function (){
			return this.posts.data;
		}
	},
	methods : {
		routeEdit : function(id){
			var url = urlEdit;
			return url.replace(':id',id);
		},
		search : function (){
			this.pages({});
		},
		pages : function(event){
	     	var id = $(event.target).attr('data-id');
	        var urlRequest = "{{route('admin.post.data')}}?page="+id+"&keyword="+this.keyword+"&kategori="+this.kategori+"&iddomain="+iddomain;
	        axios.get(urlRequest)
	        .then(res=>{
	            this.posts = res.data;
	            this.pageNow = res.data.current_page;
	        });
	    },
	    hapus : function(i) {
			this.id = i;
			this.success = false;
			$('.m-hapus').modal('show');
		},
		yes : function (){
			$('.m-hapus').modal('hide');
			var urlRequest = "{{route('admin.post.delete')}}?page="+this.pageNow+"&keyword="+this.keyword+"&kategori="+this.kategori+"&iddomain="+iddomain;
	        axios.post(urlRequest,{id:this.id})
	        .then(res=>{
	            this.posts = res.data;
	            this.pageNow = res.data.current_page;
	            this.success = true;
	        });
		},
		tanggal : function (string){
			return moment(string, "YYYY-MM-DD hh:mm:ss").fromNow();
		}
	}
});


</script>

@endpush