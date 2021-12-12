<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Crud CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" type="text/css">
	<script src="<?php echo base_url('assets/js/jquery.min.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/jquery-migrate.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/tether.min.js');?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>
	<style>
		.img-foto{
			height:100px;
			width:100px;
			object-fit:cover;
		}
	</style>
</head>
<body>

	<div id="wrapper">
		<div class="container">
			<h3>Update Data</h3>
			<a href="<?php echo base_url('mahasiswa');?>" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

			<div class="grid-layout">
				<form method="post" action="<?php echo base_url('mahasiswa/update');?>" enctype="multipart/form-data">
					  <input type="hidden" name="id" value="<?php echo $row->id;?>">
					  <input type="hidden" name="foto_old" value="<?php echo $row->foto;?>">
					  
					  <div class="form-group">
					    <label for="nim">NIM</label>
					    <input type="text" class="form-control" id="nim" aria-describedby="NPMHelp" placeholder="Enter NIM" name="nim" value="<?php echo $row->nim;?>">
					    <?php echo form_error('nim', '<div class="error">', '</div>'); ?>
					  </div>

					  <div class="form-group">
					    <label for="Nama">Nama</label>
					    <input type="text" class="form-control" id="Nama" placeholder="Nama" name="nama" value="<?php echo $row->nama;?>">
					     <?php echo form_error('nama', '<div class="error">', '</div>'); ?>
					  </div>

					  <div class="form-group">
					  <label for="Email">Email</label>
						<input type="text" class="form-control" id="Email" placeholder="Email" name="email" value="<?php echo set_value('email');?>">
					     <?php echo form_error('email', '<div class="error">', '</div>'); ?>
					  </div>

					  <div class="form-group">
					    <label for="Jurusan">Jurusan</label>
					    <select class="form-control" id="Jurusan" name="jurusan">
					      <option value="<?php echo $row->jurusan;?>"><?php echo $row->jurusan;?></option>
					      <option value="Manajemen Informatika">Manajemen Informatika</option>
					      <option value="Sitem Informasi">Sitem Informasi</option>
					      <option value="Tehnik Informatika">Tehnik Informatika</option>
					      <option value="Sistem Komputer">Sistem Komputer</option>
					      <option value="Akutansi">Akutansi</option>
					    </select>
					    <?php echo form_error('jurusan', '<div class="error">', '</div>'); ?>
					  </div>
					  
					  <div class="form-group">
						<img class="img-circle img-foto" src="<?php echo base_url("assets/images/$row->foto");?>" alt="<?php echo $row->foto;?>"/>
					  </div>
					  <div class="form-group">
					    <label for="foto">Foto</label>
					    <input type="file" class="form-control" id="foto" name="foto">
						<?php if($this->session->userdata("upload_error")):?>
							<div class="error"><?php echo $this->session->userdata("upload_error");?></div>
						<?php endif;?>
					  </div>

					  <button type="button" class="btn btn-danger" onclick="self.history.back()">Cancel</button>
					  <button type="submit" class="btn btn-primary">Submit</button>
					</form>
			</div>

		</div>
	</div>

</body>
</html>