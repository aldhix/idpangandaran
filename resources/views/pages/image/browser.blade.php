@extends('pages.image.template')
@section('title','Image Gallery')

@section('content')
<div class="container-fluid mt-3 mb-3" id="app">
  <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" 
                id="file" ref="file" 
                v-on:change="handleFileUpload()">
                <label class="custom-file-label" for="file">Choose file</label>
              </div>
              <div class="input-group-append">
                <button class="btn btn-secondary" type="button" 
                v-on:click="submit">Upload</button>
              </div>
            </div>
            <div class="progress" v-show="prog">
              <div class="progress-bar progress-bar-striped progress-bar-animated" 
              role="progressbar" aria-valuenow="`${uploadPercentage}`" 
              aria-valuemin="0" aria-valuemax="100" 
              :style="`width:${uploadPercentage}%`"></div>
            </div>
        </div>
    </div>
  </div>

  <div class="row thumbs">
    <div class="col-2 mb-3" v-for="data in datapage.data">
        <img :src="`{{url('images/photos/thumbs/thumb_${data.filename}')}}`" 
        :data-src="`${data.filename}`"
        class="img-fluid" />
    </div>
  </div> 

  <nav class="mt-3">
    <ul class="pagination pagination-sm">
      <li class="page-item" v-if="datapage.current_page > 1 ">
      <a class="page-link" href="javascript:;" :data-id="`${datapage.current_page-1}`" v-on:click="pages">Previous</a></li>
      <li class="page-item disabled" v-else>
      <span class="page-link">Previous</span></li>

      <li class="page-item" 
      v-for="i in datapage.last_page" 
      :class="{'active' : i === datapage.current_page}">
        <a class="page-link" href="javascript:;" :data-id="`${i}`" v-on:click="pages">@{{i}}</a>
      </li>
      <li class="page-item" v-if="datapage.current_page < datapage.last_page ">
      <a class="page-link" href="javascript:;" :data-id="`${datapage.current_page+1}`" v-on:click="pages">Next</a></li>
      <li class="page-item disabled" v-else>
      <span class="page-link">Next</span></li>

    </ul>
  </nav>

</div>
@endsection

@push('js')
<?php 
$jscssadmin = new \App\Libs\JsCssAdmin;
$js = $jscssadmin->js('Vue.js v2.5.17')
   .$jscssadmin->js('axios v0.18.0');
echo $js;
 ?>

<script type="text/javascript">

@if(isset($_GET['CKEditorFuncNum']))
$(function(){
  $(document).on('click','.thumbs img', function(){
     var src_data = "{{url('images/photos')}}/"+$(this).attr('data-src');
     var CKEditorFuncNum = <?php echo $_GET['CKEditorFuncNum']; ?>;
      window.parent.opener.CKEDITOR.tools.callFunction( CKEditorFuncNum, src_data, '' );
      self.close();
  });
});
@else
$(function(){
  $(document).on('click','.thumbs img', function(){
     var src_data = $(this).attr('data-src');
      window.opener.app.addImg(src_data);
      self.close();
  });
});
@endif

<?php
  $page = App\Photo::select('filename')->orderBy('id','desc')->paginate(10);
?>

var app = new Vue({
  el : '#app',
  data : {
    file : '',
    uploadPercentage: 0,
    prog:false,
    datapage : <?= json_encode($page)?>,
  },
  methods : {
    submit : function (){
      this.prog = true;
      this.onUploadProgress = 0;
      let formData = new FormData();
      
      formData.append('file', this.file);

      var reqUrl = "{{route('image.upload')}}";
      axios.post(reqUrl,
        formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          },
          onUploadProgress : function( progressEvent ) {
              this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
            }.bind(this)
        }
      ).then(function(res){
        if (res.data.status == 1){
          app.datapage = res.data.data;
        }
        $('#file').val('');
        app.file='';
        app.prog = false;
        app.uploadPercentage = 0;
      })
      .catch(function(){
        console.log('FAILURE!!');
      });
    },
    handleFileUpload : function (){
      this.file = this.$refs.file.files[0];
      console.log(this.file);
    },
    pages : function(event){
        var id = $(event.target).attr('data-id');
        var urlRequest = "{{route('image.data')}}?page=";
        axios.get(urlRequest+id)
        .then(res=>{
            app.datapage = res.data;
        });
    }
  }
});

</script>
@endpush