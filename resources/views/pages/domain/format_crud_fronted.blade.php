@extends('layouts.main')
@section('title','Domain')

@section('breadcrumb')
<li class="breadcrumb-item active">Domain</li>
@endsection

@section('content')
<div id="app">
	
<h1>Domain</h1>
<hr>

<!-- Row -->
<div class="row">
	<!-- Col form -->
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">Add Domain</div>
			<div class="card-body">
				<div class="form-group form-label-group">
					
					<!-- Input Domain -->
					<input type="text" class="form-control" 
					id="iDomain" placeholder="Domain"
					v-model.trim="domain"
					:class="{'is-invalid':$v.domain.$invalid }" />

					<label for="iDomain">Domain</label>
					
					<div class="invalid-feedback" 
					v-show="!$v.domain.required">Field is required.</div>

					<div class="invalid-feedback" 
					v-show="!$v.domain.minLength">
					Field min @{{$v.domain.$params.minLength.min}} Letter</div>
					
					<!-- / Input Domain -->
				</div>
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
	</div>
	<!-- / Col form -->
	<!-- Col Table -->
	<div class="col-sm-6">
		<table class="table">
			<tr><th>Nama Domain</th><th></th></tr>
			<tr v-for="data in datas" :data-id="`${data.id}`">
				<td>@{{data.domain}}</td>
				<td>
					<i class="fas fa-edit text-warning" title="Edit"
					v-on:click="edit"></i>
					<i class="fas fa-trash text-danger" title="Delete" 
					v-on:click="hapus"></i>
				</td>
			</tr>
		</table>
	</div>
</div>
<!-- / Row -->

<!-- Modal Hapus -->
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
<!-- / Modal Hapus -->

</div>
@endsection

@push('css')
<style type="text/css">
td i.fa-edit, td i.fa-trash{
	cursor: pointer;
}
</style>
@endpush

@push('js')
<?php 
$jscssadmin = new \App\Libs\JsCssAdmin;
$js = $jscssadmin->js('Vue.js v2.5.17')
	 .$jscssadmin->js('axios v0.18.0')
	 .$jscssadmin->js('vuelidate.min')
	 .$jscssadmin->js('validators.min');
echo $js;
$datas = App\Domain::select('domain','id')->orderBy('id','asc')->get();
?>
<script type="text/javascript">
Vue.use(window.vuelidate.default)
const { required, minLength } = window.validators ;

var app = new Vue({
	el : '#app',
	data : {
		datas : <?= json_encode($datas) ?>,
		domain : '',
		loader: false,
		typeButton : 'Simpan',
		index : 0,
	},
	validations: {
	  	domain : {
	    	required,
	    	minLength: minLength(4)
	    },
 	},
	methods : {
		simpan : function (){
			//this.loader = true;
			//$('#app input, #app button').attr('disabled',true);
			var no = 5;
			if(this.typeButton == 'Simpan'){
				var resdata = {id:no++, domain:this.domain};
				this.datas.push(resdata);
			}

			if(this.typeButton == 'Update'){
				this.datas[this.index].domain = this.domain;
			}

			this.clear();

		},
		edit : function (event){
			this.typeButton = 'Update';
			this.getId(event);
			this.domain = this.datas[this.index].domain;
		},
		hapus : function (event) {
			this.getId(event);
			$('.m-hapus').modal('show');
		},
		yes : function (){
			$('.m-hapus').modal('hide');
			this.datas.splice(this.index, 1);
		},
		batal : function (){
			this.clear();
		},
		clear : function (){
			this.domain = '';
			this.typeButton = 'Simpan';
		},
		getId : function(event){
			var iddata = $(event.target).parents('tr').attr('data-id');
			this.index = this.datas.indexOf( this.datas.find(i => i.id == iddata) );
		}
	}
});
</script>
@endpush