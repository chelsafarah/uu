
<!DOCTYPE html>
<html>
<head>
	<title>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</title>
</head>
<body>
	<center><h1>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</h1></center>
	<center><?php echo anchor('crud/tambah','Tambah Data'); ?></center>
	<table style="margin:20px auto;" border="1">
		<tr>
			<th>No</th>
			<th>Nama Saksi</th>
			<th>Provinsi</th>
			<th>Deskripsi</th>
			<th>Aksi</th>
		</tr>
		<?php 
		$no = 1;
		foreach($user as $u){ 
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $u->namasaksi ?></td>
			<td><?php echo $u->namakabupaten ?></td>
			<td><?php echo $u->deskripsikabupaten ?></td>
			<td>
			      <?php echo anchor('crud/edit/'.$u->idkabupaten,'Edit'); ?>
                  <?php echo anchor('crud/hapus/'.$u->idkabupaten,'Hapus'); ?>
			</td>
		</tr>
		<?php } 
		?>
	</table>
	<table style="margin:20px auto;" border="1">
		<tr>
			<th></th>
		<?php
		foreach($calon as $c){ 
		?>	
			<th><?php echo $c->namacaleg ?></th>	
		<?php 
		}
		?>
		</tr>
		
		<?php
		foreach($kab as $k){ 
			
		?>	
			<tr>
			<th><?php echo $k->namakabupaten ?></th>

			<?php
				foreach($calon as $cp){ 
					if(!empty($suara[$k->namakabupaten][$cp->namacaleg])){
			?>
				<td><?php echo $suara[$k->namakabupaten][$cp->namacaleg] ?></td>
			<?php
					}else{
			?>
				<td><?php echo "0" ?></td>
			<?php
					}
				}
			?>

			</tr>	
		<?php 
		} print_r($suara);
		?>
		
	</table>
</body>
</html>