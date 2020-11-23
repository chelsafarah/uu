<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("_partial/head.php") ?>
</head>
<body>
<div class="content">
	<?php $this->load->view("_partial/navbar.php") ?>
	<div class="badan">
		<form action="<?php echo base_url('login/aksi_login'); ?>" method="post">		
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Login"></td>
			</tr>
		</table>
	</form>
	</div>
</div>
</body>
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>

</html>