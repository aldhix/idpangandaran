@extends('layouts.main')
@section('title','Edit Post')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.post',['id'=>$domain->id])}}">Post</a></li>
<li class="breadcrumb-item active">Edit Post</li>
@endsection

@section('content')
<div id="app">
	
<h1>Edit Post</h1>
<hr>
<div class="alert alert-success alert-dismissible" role="alert" v-show="dialog_success">
  <strong>Saved Successfully!</strong> Data has been successfully saved.
  <button type="button" class="close" v-on:click="dialog_success = false">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="alert alert-danger alert-dismissible" role="alert" v-show="dialog_warning">
  <strong>Failed Save!</strong> Please try again.
  <button type="button" class="close" v-on:click="dialog_warning = false">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="row mb-3">
	<div class="col-9">
		<div class="form-group form-label-group">
			<input class="form-control" v-model="title" id="iTitle" placeholder="Title">
			<label for="iTitle">Title</label>
		</div>
		<div class="form-group form-label-group">
			<textarea class="form-control" 
			v-model="meta" placeholder="Meta Description"></textarea>
			
		</div>
		<div class="form-group">
			<ckeditor v-model="content"></ckeditor>
		</div>		 
	</div>
	<div class="col-3">
		<div class="form-group">
			<button class="btn btn-primary" v-on:click="simpan('publish')">Publish</button>
			<button class="btn btn-secondary" v-on:click="simpan('draft')">Draft</button>	
			<img src="{{url('images/loading.gif')}}" v-show="loader" />
		</div>
		<div class="form-group">
			<select class="form-control" v-model="kategori" required>
				<option value="1">Pilih Kategori : </option>
				@foreach(
					App\Categorie::whereNotIn('id',[1])
					->orderBy('nama_categorie','desc')
					->get() as $cat)
				<option value="{{$cat->id}}">{{$cat->nama_categorie}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<img :src="`{{url('images/photos')}}/${featured_img}`" class="img-fluid img-featured">	
		</div>
		<div class="form-group">
			<button class="btn btn-secondary btn-block" v-on:click="browserImg">Browser</button>
		</div>		
	</div>
</div>

</div>
@endsection

@push('js')
<?php 
$jscss = new App\Libs\JsCssAdmin;
$js = $jscss->js('Vue.js v2.5.17')
	  .$jscss->js('ckeditor4')
	  .$jscss->js('axios v0.18.0');

echo $js;
?>
<script>
 Vue.component('ckeditor', {
  template: `<div class="ckeditor"><textarea :id="id" :value="value"></textarea></div>`,
  props: {
	      value: {
	        type: String
	      },
	      id: {
	        type: String,
	        default: 'editor'
	      },
	      height: {
	        type: String,
	        default: '',
	      },
	      language: {
	        type: String,
	        default: 'en'
	      },
	      extraplugins: {
	        type: String,
	        default: 'autogrow'
	      }
		},
		beforeUpdate () {
      	  const ckeditorId = this.id
	      if (this.value !== CKEDITOR.instances[ckeditorId].getData()) {
	        CKEDITOR.instances[ckeditorId].setData(this.value)
	      }
		},
		mounted () {
	      const ckeditorId = this.id
	      console.log(this.value)
	      const ckeditorConfig = {
	        toolbar: this.toolbar,
	        language: this.language,
	        height: this.height,
	        extraPlugins: this.extraplugins,
	        filebrowserBrowseUrl: "{{route('admin.image.browser')}}",
	      }
	      CKEDITOR.replace(ckeditorId, ckeditorConfig)
	      CKEDITOR.instances[ckeditorId].setData(this.value)
	      CKEDITOR.instances[ckeditorId].on('change', () => {
	        let ckeditorData = CKEDITOR.instances[ckeditorId].getData()
	        if (ckeditorData !== this.value) {
	          this.$emit('input', ckeditorData)
	        }
	      })
		},
		destroyed () {
	      const ckeditorId = this.id
	      if (CKEDITOR.instances[ckeditorId]) {
	        CKEDITOR.instances[ckeditorId].destroy()
	      }
		}
 
});

var app = new Vue({
  el: '#app',
  data: {
  	dialog_success : false,
  	dialog_warning : false,
  	loader : false,
  	title : '{{$data->title}}',
  	kategori : {{$data->id_categorie}},
  	code_time : <?= $data->code_time?>,
  	button : 'update',
  	idpost : {{$data->id}},
  	featured_img : "{{$data->featured_image}}",
  	meta : '{{$data->meta_description}}',
    content: '<?= $data->content ?>'
  },
  methods : {
		simpan : function (type_save){
			this.dialog_success = false;
			this.dialog_warning = false;
			this.loader = true;
			
			var reqUrl = "{{route('admin.post.save')}}";
			axios.post(reqUrl, {
				title : this.title,
				kategori : this.kategori,
				featured_img : this.featured_img,
				meta:this.meta,
				content : this.content,
				code_time : this.code_time,
				id : this.idpost,
				button : this.button,
				type_save : type_save
			}).then(res=>{
				if(res.data.status == 1){
					this.idpost = res.data.id;
					this.button = 'update';
					this.dialog_success = true;
				} else if (res.data.status == 0){
					this.dialog_warning = true;
				}

				this.loader = false;
				console.log(res);
			});
			

		},
		browserImg: function(){
			var w = 630, h = 440; // default sizes  
	        w = $(window).width() * 80 / 100;
	        h = $(window).height() * 70 / 100;
			var url = "{{route('admin.image.browser')}}";
			var windowName = 'Window Browser Image';
			newwindow=window.open(url,windowName,'height='+h+',width='+w);
	       if (window.focus) {newwindow.focus()}
	       return false;
		},
		addImg :  function (src){
			this.featured_img = src;
		}
	}
});

CKEDITOR.on( 'dialogDefinition', function( ev )
{
	var dialogName = ev.data.name;
	var dialogDefinition = ev.data.definition;

	if ( dialogName == 'image' )
	{
		var advTab = dialogDefinition.getContents( 'advanced' );
		var urlField = advTab.get( 'txtGenClass' );
		urlField['default'] = 'img-fluid';
	}
});

</script>

@endpush