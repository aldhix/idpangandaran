@extends('layouts.main')
@section('title','Menu')

@section('breadcrumb')
<li class="breadcrumb-item active">Menu</li>
@endsection

@section('content')
<div id="app">
	
<h1>Menu</h1>
<hr>
<div class="row mb-3">
	<div class="col-md-6 mt-3">
		<div class="card">
			<div class="card-header"><i class="fas fa-link"></i>Add Menu</div>
			<div class="card-body">
				<div class="alert alert-success alert-dismissible" style="display:none;" role="alert" v-show="success">
				  <strong>Saved Successfully!</strong> Data has been successfully saved.
				  <button type="button" class="close" v-on:click="success = false">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="form-group form-label-group">
					<input type="text" id="inputNama" 
					class="form-control" 
					v-bind:class="{'is-invalid': $v.nama.$invalid || errors.nama,'is-valid':!$v.nama.$invalid}" 
					placeholder="Menu" autofocus 
					v-model.trim="nama"
					v-on:keyup="delete errors.nama">

					<label for="inputNama">Nama Menu</label>
					
					<div class="invalid-feedback" 
					v-if="!$v.nama.required">Field is required.</div>
			 		<div class="invalid-feedback" v-if="!$v.nama.minLength">Name must have at least @{{$v.nama.$params.minLength.min}} letters.</div>
			 		<div class="invalid-feedback" v-if="errors.nama">@{{errors.nama[0]}}</div>

			 		<div class="form-text text-muted"><small>Contoh : Travel</small></div>
				</div>

				<div class="form-group form-label-group">
					<input type="text" id="inputUrl" class="form-control"
					v-bind:class="{'is-invalid': $v.url.$invalid || errors.url,'is-valid':!$v.url.$invalid}" 
					placeholder="URL" 
					v-model.trim="url"
					v-on:keyup="delete errors.url">

					<label for="inputUrl">URL</label>

					<div class="invalid-feedback" v-if="!$v.url.required">Field is required.</div>
			 		<div class="invalid-feedback" v-if="!$v.url.minLength">URL must valid.</div>
			 		<div class="invalid-feedback" v-if="errors.url">@{{errors.url[0]}}</div>
			 		<div class="form-text text-muted">
			 		<small>Contoh : http://domain.com/category</small></div>
				</div>
				<div class="form-group">
					<div class="form-check form-check-inline">
					  <input type="radio" id="one" class="form-check-input" v-model="type" value="1">
					  <label class="form-check-label" for="one">Menu Top</label>
					</div>
					<div class="form-check form-check-inline">
					  <input type="radio" id="two" class="form-check-input" v-model="type" value="2">
					  <label class="form-check-label" for="two">Menu Secondary</label>
					</div>
				</div>
			</div>
			<div class="card-footer">
				
				<button type="button" class="btn" 
				:class=" !$v.$invalid && isEmpty(errors)? 'btn-primary': 'btn-secondary' "
				:disabled="$v.$invalid || !isEmpty(errors)"
				v-on:click="submit">Simpan</button>

				<img src="{{url('images/loading.gif')}}" v-show="loader" />
			</div>
		</div>
	</div>
	<div class="col-md-6 mt-3">
		<h4>Menu Top</h4>
		<ol class='list-menu border border-secondary' style="display:none" v-show="true">
		  <li :data-id="`${item.id}`" v-for="item in menus" 
		  class="border border-info bg-info text-white">
		  	<i class="cursor fas fa-arrows-alt"></i> 
		  	<a href="" target="_blank" :href="`${item.url_menu}`">
		  	<span>@{{item.nama_menu}}</span>
		  	</a>
		  	<i class="fas fa-trash right float-right" v-on:click="hapus"></i>
		  </li>
		</ol>
		<h4 class="mt-3">Menu Secondary</h4>
		<ol class='list-menu border border-secondary' style="display:none" v-show="true">
		  <li :data-id="`${item.id}`" v-for="item in menus2" 
		  class="border border-info bg-info text-white">
		  	<i class="cursor fas fa-arrows-alt"></i> 
		  	<a href="" target="_blank" :href="`${item.url_menu}`">
		  	<span>@{{item.nama_menu}}</span>
		  	</a>
		  	<i class="fas fa-trash right float-right" v-on:click="hapus"></i> 
		  </li>
		</ol>
	</div>
</div>

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

</div> <!-- End App -->
@endsection

@push('css')
<style type="text/css">
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
$data = App\Menu::select('id','nama_menu','url_menu','type_menu')
		->orderBy('sort_menu','asc')->where('type_menu',1)->get();

$data2 = App\Menu::select('id','nama_menu','url_menu','type_menu')
		->orderBy('sort_menu','asc')->where('type_menu',2)->get();
?>

Vue.use(window.vuelidate.default)
const { required, minLength } = window.validators ;

var app = new Vue({
  el: '#app',
  data: {
    nama : '',
    url : '',
    type:1,
    loader:false,
    errors : {},
    success : false,
    menus: <?= json_encode($data)?>,
    menus2: <?= json_encode($data2)?>,
    selector:null,
  },
  validations: {
  	nama: {
    	required,
    	minLength: minLength(4)
    },
    url : {
    	required,
    	minLength: minLength(10)
    }
  },
  methods : {  
  	submit : function(event){
  		var button = $(event.target);
  		this.allDisabled(button);
  		var reqURL = "{{route('admin.menu.simpan')}}";
  		axios.post(reqURL,{nama:this.nama, url:this.url, type:this.type}).then(res => {
  			this.allEnabled(button);
  			if(res.data.status === 1){
  				var resdata = {
  						nama_menu:res.data.data.nama_menu,
  						url_menu:res.data.data.url_menu,
  						id:res.data.data.id,
  				}
  				if (res.data.data.type_menu == 1){
  					this.menus.push(resdata);
  				} else {
  					this.menus2.push(resdata);
  				}
  				this.nama = '';
  				this.url = '';
  				this.success = true;
  				//console.log(res);
  			} else if ( res.data.status === 0) {
  				this.errors = res.data.errors;
  			}
  		});
  	},
  	allDisabled : function(selector){
  		this.loader = true;
  		$('#inputNama').attr('disabled',true);
  		$('#inputUrl').attr('disabled',true);
  		selector.removeClass('btn-primary').addClass('btn-secondary');
  		$('.card-footer button').attr('disabled',true)
  	},
  	allEnabled : function(selector){
  		this.loader = false;
  		$('#inputNama').attr('disabled',false);
  		$('#inputUrl').attr('disabled',false);
  		selector.removeClass('btn-secondary').addClass('btn-primary');
  		$('.card-footer button').attr('disabled',false)
  	},
  	isEmpty : function (obj){
	  		for(var key in obj) {
	        if(obj.hasOwnProperty(key))
	            return false;
	    }
	    return true;
  	},
  	hapus : function (event){
  		this.selector = $(event.target).parent('li');
  		$('.m-hapus').modal('show');
  	},
  	yes : function (){
		var iddata = this.selector.attr('data-id');
		var reqURL = "{{route('admin.menu.hapus')}}";
  		axios.post(reqURL,{id:iddata});
  		this.selector.remove();
  		this.selector = null;
		$('.m-hapus').modal('hide');
	},

  }
});

$(function  () {
  var group = $("ol.list-menu").sortable({
	  group: 'serialization',
	  handle: '.cursor',
	  onDrop: function ($item, container, _super) {
	    var data = group.sortable("serialize").get();
	    var reqURL = "{{route('admin.menu.sort')}}";    
	    axios.post(reqURL, { data : data[0], data2 : data[1] } )
	    .catch(function (error) {
		    alert('Error');
		    console.log(error);
		 });
	    // var jsonString = JSON.stringify(data[0], null, ' ');
	    // $('#serialize_output2').text(jsonString);
	    _super($item, container);
	  }

	});
});	
</script>
@endpush