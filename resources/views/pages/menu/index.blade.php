@extends('layouts.main')
@section('title','Menu')

@section('breadcrumb')
<li class="breadcrumb-item active">Menu</li>
@endsection

@section('content')
<div id="app">
	
<h1><i class="fas fa-sitemap"></i> Menu</h1>
<hr>
<div class="row mb-3">
	<!-- Col -->
	<div class="col-md-6 mt-3">
		<div class="card">
			<div class="card-header">Add Menu</div>
			<div class="card-body">
				<!-- ================ Nama Menu ===================== -->
				<div class="form-group form-label-group">

					<input type="text" id="iNama" placeholder="Menu" class="form-control" 
					v-model.trim="nama"
					:class="{'is-invalid':$v.nama.$invalid }">

					<label for="iNama">Menu</label>

					<div class="invalid-feedback" 
					v-show="!$v.nama.required">Field is required.</div>

					<div class="invalid-feedback" 
					v-show="!$v.nama.minLength">
					Field min @{{$v.nama.$params.minLength.min}} Letter</div>

				</div>
				<!-- ================ /Nama Menu ===================== -->
				<!-- ================ URL ===================== -->
				<div class="form-group form-label-group">
					<input type="text" id="iUrl" placeholder="URL" class="form-control"
					v-model.trim="url">

					<label for="iUrl">URL</label>
				</div>
				<!-- ================ / URL ===================== -->
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="button"
				v-on:click="simpan"
				:disabled="$v.$invalid">@{{typeButton}}</button>

				<button class="btn btn-dark" type="button"
				v-on:click="batal"
				v-show="typeButton == 'Update' ">Batal</button>

				<img src="{{url('images/loading.gif')}}" v-show="loader" />
			</div>
		</div>

		<!-- ================ / List Domain ===================== -->
		<table class="table mt-3">
			<tr><th>#</th><th>Domain</th><th></th></tr>
			@foreach(
				\App\Domain::orderBy('id','asc')->get() as $r
			)
			<tr>
				<td>{{$r->id}}</td>
				<td>{{$r->domain}}</td>
				<td>
					<a href="{{route('admin.menu.second',['id'=>$r->id])}}" 
					class="btn btn-sm btn-success">
						Menu 2nd
					</a>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	<!-- / Col -->
	<!-- Col -->
	<div class="col-md-6 mt-3">

<!-- ==================================== Menu List ==================================== -->
		<h4>Menu Top</h4>
		<ol class='list-menu border border-secondary' style="display:none" v-show="true">
		  <li :data-id="`${item.id}`" v-for="item in datas" 
		  class="border border-info bg-info text-white">
		  	<i class="cursor fas fa-arrows-alt"></i> 
		  	<a href="" target="_blank" :href="`${item.url_menu}`">
		  	<span>@{{item.nama_menu}}</span>
		  	</a>
		  	<i class="fas fa-trash right float-right" v-on:click="hapus"></i>
		  	<i class="fas fa-edit right float-right mr-2" v-on:click="edit"></i>
		  </li>
		</ol>
<!-- ====================================  / Menu List ==================================== -->
	</div>
	<!-- / Col -->

</div>

<!-- ==================================== Modal Hapus ==================================== -->
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
<!-- ====================================  / Modal Hapus ==================================== -->
</div> <!-- End App -->
@endsection

@push('css')
<style type="text/css">

li .fas.right {
	cursor: pointer;
}

body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.list-menu li.placeholder {
  position: relative;
  /** More li styles **/
  background-color: silver;
}
ol.list-menu li.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}

ol.list-menu li{
	padding: 5px;
	margin: 3px;
	height: 40px;
}

ol.list-menu{
	list-style-type: none;
	list-style-position: none;
	padding: 0;
	margin:0;
	min-height: 75px;

}

ol.list-menu .cursor{
	cursor: pointer;
}

ol.list-menu li a{
	color: #fff;
}

</style>
@endpush

@push('js')
<?php 
$jscssadmin = new \App\Libs\JsCssAdmin;
$js = $jscssadmin->js('Vue.js v2.5.17')
	 .$jscssadmin->js('axios v0.18.0')
	 .$jscssadmin->js('vuelidate.min')
	 .$jscssadmin->js('validators.min')
	 .$jscssadmin->js('jquery-sortable.js v0.9.13');
echo $js;
 ?>
<script type="text/javascript">
<?php
$data = App\Menu::select('id','nama_menu','url_menu')
		->orderBy('sort_menu','asc')
		->where('id_domain',1)
		->where('type_menu',1)->get();
?>

var urlSimpan = "{{route('admin.menu.simpan')}}";
var urlEdit = "{{route('admin.menu.edit')}}";
var urlHapus = "{{route('admin.menu.hapus')}}";
var type_menu = 1;
var iddomain = 1;

Vue.use(window.vuelidate.default)
const { required, minLength } = window.validators ;

var app = new Vue({
  el: '#app',
  data: {
    nama : '',
    url : '',
    loader:false,
    typeButton : 'Simpan',
	index : 0,
    datas: <?= json_encode($data)?>,
  },
  validations: {
  	nama: {
    	required,
    	minLength: minLength(4)
    }
  },
  methods : {  
  	simpan : function(event){
  		this.loader = true;
		$('#app input, #app .card-footer button').attr('disabled',true);

		/* Simpan */
		if(this.typeButton == 'Simpan'){
			axios.post(urlSimpan, {
				nama:this.nama, 
				url:this.url ,
				type : type_menu, 
				iddomain : iddomain
			})
			.then(res => {
				if(res.data.status === 1) {
					this.datas.push(res.data.data);	
					this.clear();
				}

				console.log(res);
			});
			
		}

		/* Update */
		if(this.typeButton == 'Update'){
			var iddata = this.datas[this.index].id;
			axios.post(urlEdit, {id : iddata, nama : this.nama, url : this.url })
			.then(res => {
				this.datas[this.index].nama_menu = this.nama;
				this.datas[this.index].url_menu = this.url;
				this.clear();
			});				
		}
  	},
  	edit : function (event){
		this.typeButton = 'Update';
		this.getId(event);
		this.nama= this.datas[this.index].nama_menu;
		this.url= this.datas[this.index].url_menu;
	},
  	hapus : function(event){
  		this.clear();
		this.getId(event);
		$('.m-hapus').modal('show');
  	},
  	yes : function(event){
  		var iddata = this.datas[this.index].id;
		axios.post(urlHapus, {id :iddata });
		$('.m-hapus').modal('hide');
		this.datas.splice(this.index, 1);
  	},
  	batal : function (){
		this.clear();
	},
	clear : function (){
		this.nama = '';
		this.url = '';
		this.loader = false;
		this.typeButton = 'Simpan';
		$('#app input, #app .card-footer .btn-dark').attr('disabled', false);
	},
  	getId : function(event){
		var iddata = $(event.target).parents('li').attr('data-id');
		this.index = this.datas.indexOf( this.datas.find(i => i.id == iddata) );
	}
  	
  }
});

$(function  () {
  var group = $("ol.list-menu").sortable({
	  group: 'serialization',
	  handle: '.cursor',
	  onDrop: function ($item, container, _super) {
	    var data = group.sortable("serialize").get();
	    var reqURL = "{{route('admin.menu.sort')}}";    
	    axios.post(reqURL, { data : data[0], type : type_menu, iddomain : iddomain } )
	    .catch(function (error) {
		    alert('Error');
		    console.log(error);
		 });
	    _super($item, container);
	  }

	});
});	
</script>
@endpush