<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("_partial/head.php") ?>
</head>
<body>
	<div class="content">
		<?php $this->load->view("_partial/navbar.php") ?>
		<div class="badan">
			<div class="halaman">
				<h2>Daftar File</h2>
					<div class="data">
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modaltambah"> <i class="fa fa-plus"></i> Tambah </button>
						<table id="listdata" class="table table-striped table-bordered" style="width:100%">
						    <thead>
						        <tr>
						            <td>No</td>
						            <td style="max-width: 400px">Judul</td>
						            <td>Kategori</td>
						            <td>Tahun</td>
						            <td>Nomor Surat</td>
						            <td>Dokumen</td>
						            <td style="min-width: 180px">Action</td>
						        </tr>
						    </thead>
						    <?php 
						    //$no=$model['nomer']+1; ?>
						    <tbody id="show_data">
						    </tbody>
						</table>
						<!-- Paginate -->
   <div style='margin-top: 10px;' id='pagination' ></div>

   <!-- Script -->
   
						<div class="row">
						    <div class="col" id="paging">
						     <!--Tampilkan pagination-->
						    </div>
						</div>
					</div>
			</div>
			
		</div>
	</div>
</body>
<!-- Modal Tambah Mahasiswa-->
<div class="modal fade" id="Modaltambah" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Data</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form role="form" method="post" id="form-tambah" enctype="multipart/form-data">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul" id="judul" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select name="kategori" id="kategori" class="form-control">
							<option value=""></option>
							<?php foreach ($kategori->result()  as $model) {?>
								<option value="<?php echo $model->nama_kategori; ?>"><?php echo $model->nama_kategori; ?></option>
							<?php } ?>
						</select> 
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<input type="text" name="tahun" id="tahun" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>No Surat</label>
						<input type="text" name="nomor" id="nomor" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>Keterkaitan</label>
						<select name="terkait" id="terkait" class="form-control">
							<option value=""></option>
							<?php foreach ($terkait->result()  as $s) {?>
								<option value="<?php echo $s->keterangan; ?>"><?php echo $s->keterangan; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Dokumen</label>
						<input type="file" name="berkas" id="fileupload" class="form-control" value="">    
					</div>
			<div class="modal-footer">  
				<button type="submit" id="simpan" class="btn btn-success simpandata">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>        
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="Modal_edit" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form role="form" method="post" id="form-edit" enctype="multipart/form-data">
					<div class="form-group">
						<input type="hidden" name="id" id="id" class="form-control" value="">      
					</div>
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judull" id="judull" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select name="kategorii" id="kategorii" class="form-control">
							<option value=""></option>
							<?php foreach ($kategori->result()  as $model) {?>
								<option value="<?php echo $model->nama_kategori; ?>"><?php echo $model->nama_kategori; ?></option>
							<?php } ?>
						</select> 
					</div>
					<div class="form-group">
						<label>Tahun</label>
						<input type="text" name="tahunn" id="tahunn" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>No Surat</label>
						<input type="text" name="nomorr" id="nomorr" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>Keterkaitan</label>
						<select name="terkaitt" id="terkaitt" class="form-control">
							<option value=""></option>
							<?php foreach ($terkait->result()  as $s) {?>
								<option value="<?php echo $s->keterangan; ?>"><?php echo $s->keterangan; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Dokumen</label>
						<input type="file" name="fileuploadd" id="fileuploadd" class="form-control" value="">    
					</div>
			<div class="modal-footer">  
				<button type="submit" id="editt" class="btn btn-success updatedata">Simpan Update</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>        
				</form>
			</div>
		</div>
	</div>
</div>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

</html>
<script type="text/javascript">
	$(document).ready(function(e){
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
		    url: '<?=base_url()?>peraturan/loadRecord/'+pagno,
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
		  $('#listdata tbody').empty();
		  var tr="";
		  for(index in result){
		     var id = result[index].id_file;
		     var title = result[index].judul;
		     var category = result[index].kategori;
		     var year = result[index].tahun;
		     var number = result[index].no;
		     var dok = result[index].dokumen;
		     dok=dok.replace(/ /g,"%20");
		     //var link = result[index].link;
		     sno+=1;

		     tr += '<tr>';
		     tr += '<td>'+ sno +'</td>';
		     tr += '<td style="text-align:justify;width:50%;"">'+ title +'</td>';
		     tr += '<td>'+ category +'</td>';
		     tr += '<td>'+ year +'</td>';
		     tr += '<td>'+ number +'</td>';
		     tr += '<td><a href=<?php echo base_url()?>dok/'+dok+' target="_blank" >'+ '<i class="fa fa-download"></i>' +'</a></td>';
		     tr += '<td> <button id="'+ id + '" class="btn btn-success btn-sm edit_data" data-toggle="modal" data-target="#Modal_edit"> <i class="fa fa-edit"></i> Edit </button> <button id="'+id+'" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button></td>'
		     tr += '</tr>';
		     

		   }
		   $('#listdata tbody').html(tr);
		}

		$("#form-tambah").on('submit', function(e){
			
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url();?>peraturan/tambah',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('.simpandata').attr("disabled","disabled");
					$('#form-tambah').css("opacity",".5");
				},
				success: function(response){ //console.log(response);
					//alert(response.pesan);
					//alert("berhasil");
					if(response.status==1){
						alert(response.pesan);
						$('#form-tambah')[0].reset();
						$('#form-tambah').css("opacity","");
						$(".simpandata").removeAttr("disabled");
						$('#Modaltambah').modal('hide');
						location.reload();
					}else{
						alert(response.pesan);
						$('#form-tambah').css("opacity","");
						$(".simpandata").removeAttr("disabled");
					}
					
				}				
			});
            return false;
		});
		
		$("#form-edit").on('submit', function(e){
			
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url();?>peraturan/edit',
				data: new FormData(this),
				dataType: 'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					//$('.simpandata').attr("disabled","disabled");
					//$('#form-tambah').css("opacity",".5");
				},
				success: function(response){ //console.log(response);
					//$('#fupForm')[0].reset();
					alert(response.err);
					//alert("berhasil");
					/*if(response.status==1){
						$('#Modaltambah').modal('hide');
						alert(response.message);
						$('#form-tambah')[0].reset();
						$('#form-tambah').css("opacity","");
						$(".simpandata").removeAttr("disabled");
						location.reload();
					}else{
						alert(response.message);
						$('#form-tambah').css("opacity","");
						$(".simpandata").removeAttr("disabled");
					}*/
					
				}				
			});
            return false;
			
		});
		
	});

	$(document).on('click', '.hapus_data', function(){
		
			var id = $(this).attr('id');
			$.ajax({
                type: "GET",
                url: "<?php echo base_url('peraturan/hapus')?>",
                data: { id: id },
                dataType: "json",
                success: function (data) {
					alert("berhasil menghapus");
                }
            });	
            location.reload();		
	});
    $(document).on('click', '.edit_data', function () {
			var id = $(this).attr("id");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('peraturan/get_aturan')?>",
                data: { id: id },
                dataType: "json",
                success: function (data) {
					$('#id').val(data.id);
                    $('#judull').val(data.judul);
                    $('#tahunn').val(data.tahun);
                    $('#nomorr').val(data.nomor);
					//alert(data.kategori);
					$('#kategorii option[value="'+data.kategori+'"]').prop('selected', true);
					$('#terkaitt option[value="'+data.terkait+'"]').prop('selected', true);
                }
            });
    });
    
</script>