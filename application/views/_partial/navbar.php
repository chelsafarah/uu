<header>
	<h1 class="judul">PERATURAN PERUNDANG-UNDANGAN</h1>
	<h3 class="deskripsi">Kumpulan peraturan perundang-undangan</h3>
</header>
<div>
<!--
<div class="menu">
	<ul>
		<li><a href="<?php echo site_url() ?>" class="klik_menu" id="home">HOME</a></li>
		<li><a href="<?php echo site_url('home/tentang')?>" class="klik_menu" id="tentang">TENTANG</a></li>
		<li><a href="<?php echo site_url('home/peraturan')?>" class="klik_menu" id="tutorial">TUTORIAL</a></li>
		<li><a href="index.php?halaman=sosmed" class="klik_menu" id="sosmed">SOSIAL MEDIA</a></li>
	<?php if($this->session->userdata('status')=='login'){?>
		<li><a href="<?php echo site_url('peraturan')?>" class="klik_menu" id="daftar">Data File</a></li>
	<?php }?>
		<li><a href="<?php echo site_url('daftar')?>" class="klik_menu" id="list">Daftar Peraturan</a></li>
		<li><a href=""  data-toggle="modal" data-target="#ModalLogin" class="klik_menu" id="list">Login Modal</a></li>
		<li><a href="<?php echo site_url('login')?>" class="klik_menu" id="list">Login</a></li>
	</ul>
!-->
</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  	<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav mr-auto">
        <li><a href="<?php echo site_url() ?>">HOME</a></li>
        <li><a href="<?php echo site_url('home/tentang')?>" class="klik_menu" id="tentang">TENTANG</a></li>
		<li><a href="<?php echo site_url('home/peraturan')?>" class="klik_menu" id="tutorial">TUTORIAL</a></li>
		<li><a href="index.php?halaman=sosmed" class="klik_menu" id="sosmed">SOSIAL MEDIA</a></li>
			<?php if($this->session->userdata('status')=='login'){?>
		<li><a href="<?php echo site_url('peraturan')?>" class="klik_menu" id="daftar">DATA FILE</a></li>
			<?php }?>
		<li><a href="<?php echo site_url('daftar')?>" class="klik_menu" id="list">DAFTAR PERATURAN</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<?php if($this->session->userdata('status')=='login'){?>
      		<li><a href="<?php echo site_url('login/logout')?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      	<?php }?>
      		<?php if($this->session->userdata('status')!='login'){?>
        	<li><a href="<?php echo site_url('login')?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        	<?php }?>
      </ul>
    </div>
  </div>
</nav>
<!-- Modal Tambah Mahasiswa-->
<div class="modal fade" id="ModalLogin" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Form Login</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" method="post" id="form-login" enctype="multipart/form-data">

<div class="form-group">
<label>Judul</label>
<input type="text" name="judul" class="form-control" value="">      
</div>

<div class="modal-footer">  
<button type="submit" name="login" id="login" class="btn btn-success proseslogin">Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>        
</form>
</div>
</div>

</div>
</div>

