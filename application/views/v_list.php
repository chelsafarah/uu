<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("_partial/head.php") ?>
	<style type="text/css">
  #hasil {
    color:black;
        text-align:justify;
    border: 2px solid grey;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    width:100%;
    hover: #F5F5F5;
  }
  #hasil :hover{
    background:#F5F5F5;
  }
  
  #detail {
    border-radius: 3px;
    background-color:#F5F5F5;
    color: #BC8F8F;
    background-length:10px;
    padding: 3px;
    margin-bottom: 3px;
    }
</style>
</head>
<body>

<div class="content">
	<?php $this->load->view("_partial/navbar.php") ?>
	<div class="badan">
		<div class="halaman">
			
		
		<h1>Data <strong>Peraturan</strong></h1>
    <form method="GET" class="form-vertical" id="form-data">
  <div class="form-group row">
    <div class="col-sm-2">
      <div class="input-group" >
        <label> Kategori </label>
        <select id="kategori" name="kategori" class="form-control">
        <option value=""></option>
          <?php foreach ($kategori->result()  as $model) {?>
              <option value="<?php echo $model->id_kategori; ?>"><?php echo $model->nama_kategori; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="input-group" >
        <label> Tahun </label>
        <select id="thn" name="thn" class="form-control">
        <option value=""></option>
          <?php foreach ($tahun->result()  as $model) {?>
              <option value="<?php echo $model->tahun; ?>"><?php echo $model->tahun; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="input-group" >
        <label> Nomor </label>
        <input id="nosurat" type="text" name="nosurat"  class="form-control" value="<?php if(isset($_GET['nosurat'])){echo $_GET['nosurat'];}?>">
      </div>
    </div>
    </div>
  <div class="form-group row">
    <div  class="col-sm-8">
      <div class="input-group" >
        <input id="halaman" type="hidden" name="halaman"  class="form-control" value="list">
        <p> Kata Kunci </p>
        <textarea style="height:200px;" id="kunci" type="text" name="kunci"  class="form-control" ><?php if(isset($_GET['kunci'])){echo $_GET['kunci'];}?></textarea>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-1">
      
        <input type="submit" id="cari" name="cari" class="btn btn-success" value="Cari">

    </div>
  </div>
</form>
			<div id="listdata">
				
			</div>
		    <div class="row">
		        <div class="col" id="pagination">
		        </div>
		    </div>
		    </div>	      
		 
	</div>
</div>
</body>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
     // Detect pagination click
     $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });

     loadPagination(0);

     // Load pagination
     function loadPagination(pagno){
       $.ajax({
         url: '<?=base_url()?>daftar/loadRecord/'+pagno,
         type: 'get',
         dataType: 'json',
         success: function(response){
            $('#pagination').html(response.pagination);
            createTable(response.result,response.row);
         }
       });
     }

     // Create table list
     function createTable(result,sno){
       sno = Number(sno);
       $('#listdata').empty();
       var tr="";
       for(index in result){
          var id = result[index].id_file;
          var title = result[index].judul;
          var category = result[index].kategori;
          var year = result[index].tahun;
          var number = result[index].no;
          var terkait = result[index].terkait;
          var dok = result[index].dokumen;
          dok=dok.replace(/ /g,"%20");
          //var link = result[index].link;
          sno+=1;
          var link ='<?=base_url()?>daftar/keterkaitann/'+terkait+'/'+id;
          tr += '<div id="hasil"><div class="form-group row"><div class="col-sm-8">';
          tr += '<h4 id="judul"><a href=<?php echo base_url()?>file/'+dok+' target="_blank" >'+title+'</a></h4>';
          tr += '<label id="detail">Kategori : '+category+'</label><br>';
          tr += '<label id="detail">Tahun : '+year+'</label><br>';
          tr += '<label id="detail">Nomor : '+number+'</label>';
		    	tr += '</div>';
          //tr += '<div class="col-sm-4"><label>Terkait:</label><a href="'+link+'">tentang</a><br></div></div><div></div></div>';
          tr += '<div class="col-sm-4 terkait" ><label>Terkait:</label><ul id='+id+'><ul><br></div></div><div></div></div>';
          file_terkait(terkait,id);
        }

        $('#listdata').html(tr);
      }

      function file_terkait(kaitan,idf){
        if(kaitan!=""){
          var datahasil="ada"+kaitan +"dengan id "+idf;
          $.ajax({
            url: '<?=base_url()?>daftar/keterkaitan/'+kaitan+'/'+idf,
            type: 'get',
            dataType: 'json',
            success: function(response){
              var hasil=response.result;
              var string="";
              for(index in hasil){
                var tentang=  hasil[index].judul;
                tentang=tentang.toLowerCase();
                tentang=  tentang.replace(/^\w/g, c => c.toUpperCase());
                tentang=Capitalize(tentang);
                var dok = hasil[index].dokumen;
                dok=dok.replace(/ /g,"%20");
                string+='<li><a href=<?php echo base_url()?>file/'+dok+' target="_blank" >'+hasil[index].kategori+' Nomor '+hasil[index].no+' Tahun '+hasil[index].tahun+' Tentang '+tentang+'</a></li>';
              }

              $('#'+idf).html(string);
            }
          });
          return datahasil;
        }else{
          return "";
        }
      }

      function Capitalize(str)
      {  return str.replace (/\w\S*/g, 
            function(txt)
            {  return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase(); } );
      }
    });
    </script>