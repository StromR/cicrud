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
			<h3>Data Mahasiswa </h3>
			<a href="<?php echo base_url('mahasiswa/create/');?>" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Mahasiswa</a></p>

			<table class="table table-striped table-layout">
			  <thead>
			    <tr>
			      <th>#</th>
			      <th>NIM</th>
			      <th>Nama</th>
			      <th>Email</th>
			      <th>Jurusan</th>
				  <th>Foto</th>
			      <th>Aksi</th>
			    </tr>
			  </thead>
			  <tbody>

			  	<?php if($jumlah_data > 0):?>
			  		<?php $no=0; foreach ($mahasiswa as $m): $no++ ?>
				    <tr class="data">
				      <th><?php echo $no;?></th>
				      <td><?php echo $m->nim;?></td>
				      <td><?php echo $m->nama;?></td>
				      <td><?php echo $m->email;?></td>
				      <td><?php echo $m->jurusan;?></td>
					  <td><img class="img-circle img-foto" src="<?php echo base_url("assets/images/$m->foto");?>" alt="<?php echo $m->foto;?>"/></td>
				      <td>
				      	<a  href="<?php echo base_url('mahasiswa/edit/'.$m->id);?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
				      	<a  href="<?php echo base_url('mahasiswa/delete/'.$m->id);?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
				      </td>
				    </tr>
					<?php endforeach;?>

				<?php else:?>

				    <tr class="kosong">
				    	<td colspan="7">Tidak ada data</td>
				    </tr>

				<?php endif;?>


			  </tbody>
			</table>

		</div>
	</div>
