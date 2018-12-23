@extends('layouts.main')
@section('title','Kategori')

@section('breadcrumb')
<li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
<div id="app">
	
<h1><i class="fas fa-link"> </i> Kategori {{$domain->domain}}</h1>
<hr>
<div class="row mb-3">
	<div class="col-md-6 mt-3">
		<div class="card">
			<div class="card-header">Add Kategori</div>
			<div class="card-body">
				<div class="form-group form-label-group">					
					
					<input type="text" id="inputKategori" class="form-control"
					placeholder="Kategori"
					v-model.trim="kategori"
					v-bind:class="{'is-invalid' : validKategori() }"
					@input="$v.kategori.$touch()"
					v-on:keyup="delete errors.kategori"
					:disabled="disabled">

					<label for="inputKategori">Kategori</label>
					<div class="form-text text-muted"><small>Contoh : Travel</small></div>

					<div class="invalid-feedback" v-if="!$v.kategori.required">
					Field is required.</div>
			 		<div class="invalid-feedback" v-if="!$v.kategori.minLength">
			 		Kategori min 4 karakter.</div>
			 		<div class="invalid-feedback" v-if="errors.kategori">
			 		@{{ errors.kategori[0] }}
			 		</div>

				</div>
			</div>
			<div class="card-footer">
				<button class="btn" 
				:class="valid() ?'btn-primary':'btn-secondary'" 
				:disabled="!valid() ? true : disabled"
				type="button" v-on:click="simpan">Simpan</button>
				<button type="button" 
				class="btn btn-dark" 
				v-on:click="clearData"
				:disabled="disabled">Batal</button>

				<img src="{{url('images/loading.gif')}}" v-show="disabled" />

			</div>
		</div>
	</div>
	<div class="col-md-6 mt-3">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Kategori</th><th></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(item,index) in orderDatas">
					<td class="label-kategori">@{{item.kategori}}</td>
					<td class="action text-right">

					<div class="btn-group mr-3" role="group">
					    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					      Add To
					    </button>
					    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					    @foreach(
					    \App\Domain::whereNotIn('id', [$domain->id])
					    ->orderBy('id','asc')->get() as $r
					    )
					      <a data-id="{{$r->id}}" class="dropdown-item" href="javascript:;"
					      v-on:click='addto(index, $event)'>
					      {{$r->domain}}</a>
					    @endforeach
					    </div>
					 </div>

						<button type="button"
						class="btn btn-sm btn-warning" 
						v-on:click='edit(index)'
						:disabled="disabled">
							<i class="fas fa-edit"></i>	
						</button>
						
						<button type="button"
						class="btn btn-sm btn-danger" 
						v-on:click='hapus(index)' 
						:disabled="disabled">
							<i class="fas fa-trash"></i>	
						</button>						
					</td>
				</tr>
			</tbody>
		</table>
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

</div>
@endsection

@push('css')
<style type="text/css">
td.action .btn{
	padding: 0 5px 0 5px;
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
	 .$jscssadmin->js('Lodash 4.17.11');
echo $js;
 
?>
<script type="text/javascript">
<?php
$data = \App\Categorie::where('id_domain',$domain->id)
->whereNotIn('id',[1])
->select('id','nama_categorie as kategori')->get();
?>
Vue.use(window.vuelidate.default)
const { required, minLength } = window.validators ;

var idglobal = 1;
var id_domain = "{{$domain->id}}";

var app = new Vue({
	el:'#app',
	data : {
		kategori : '',
		selector : '',
		type : 'simpan',
		id : '',
		errors : {} ,
		disabled : false,
		datas :<?= json_encode($data) ?>,
	},
	computed: {
	  orderDatas : function () {
	    return _.orderBy(this.datas, 'kategori','desc');
	  },
	},
	validations: {
	  	kategori: {
	    	required,
	    	minLength: minLength(4)
	    },
	},
	methods : {
		validKategori : function (){
			return this.$v.kategori.$dirty ? (
						this.$v.kategori.$invalid || this.errors.kategori ? true : false 
					) : false ;
		}, 
		valid : function (){
			return (!this.$v.$invalid && this.isEmpty(this.errors) ) ? true : false;
		},
		simpan : function (event){
			
			this.disabled = true;
			var btn = $(event.target);
			var resdata = '';
			var urlSimpan = "{{route('admin.categorie.simpan')}}";
			var urlUpdate = "{{route('admin.categorie.update')}}";

			if(app.type === 'simpan'){
					
				axios.post(urlSimpan, {kategori:app.kategori, iddomain : id_domain})
				.then(res => {
					if(res.data.status === 0){
						app.errors = res.data.errors;
						app.disabled = false;
					} else if (res.data.status === 1){
						resdata = {id:res.data.data.id, kategori:res.data.data.kategori};
						app.datas.push(resdata);
						this.clearData();
					}
				});
				
			} else if (app.type === 'update'){
				var id_data = app.orderDatas[app.id].id; 
				axios.post(urlUpdate, {id:id_data, kategori:app.kategori})
				.then(res => {
					if(res.data.status === 0){
						app.errors = res.data.errors;
						app.disabled = false;
					} else if (res.data.status === 1) {
						app.orderDatas[app.id].kategori=app.kategori;
						this.clearData();
					}
				});
			}

		},
		edit : function(i) {
			app.id = i;
			app.kategori = app.orderDatas[i].kategori;
			app.type = 'update';
		},
		hapus : function(i) {
			app.id = i;
			$('.m-hapus').modal('show');
		},
		yes : function (){
			$('.m-hapus').modal('hide');
			var id_data = app.orderDatas[app.id].id;
			var urlDelete = "{{route('admin.categorie.delete')}}" ;
			axios.post(urlDelete, {id:id_data}).then(res=>{
				var index = _.findIndex(app.datas, { id : id_data });
				app.datas.splice(index, 1);
			});
			this.clearData();		
		},
		addto : function (i, event){
			app.id = i;
			var id_data = app.orderDatas[app.id].id;
			var add_id_domain = $(event.target).attr('data-id');
			var urlAddto = "{{route('admin.categorie.addto')}}" ;
			axios.post(urlAddto, {id:id_data, iddomain: add_id_domain}).then(res=>{
				var index = _.findIndex(app.datas, { id : id_data });
				app.datas.splice(index, 1);
			});
			this.clearData();		
		},
		clearData : function(){
			app.kategori = '';
			app.type = 'simpan';
			app.id = '';
			this.$v.$reset();
			app.disabled = false;
		},
		isEmpty : function (obj){
		  		for(var key in obj) {
		        if(obj.hasOwnProperty(key))
		            return false;
		    }
		    return true;
	  	},
	}
});
</script>
@endpush