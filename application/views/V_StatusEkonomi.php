<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<h1 class="m-0 text-dark">Sistem Penunjang Keputusan Pengelompokan UKT Mahasiswa</h1>
			<hr>

			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Status Ekonomi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						<li class="breadcrumb-item active">Status Ekonomi</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">

				<div class="card-header">
					<div class="float-right">
						<?= validation_errors(); ?>
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" type="button">Tambah</button>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Golongan Ekonomi</th>
								<th>Tingkat Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no=1;
							foreach ($Status as $key): ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $key->nama_status ?></td>
									<td><?php echo $key->tingkat_status ?></td>
									<td>
										<div class="btn-group">
											<a class="btn btn-sm  btn-warning" href="<?= base_url() ?>StatusEkonomi/ubah/<?php echo $key->id_status;?>">Update</a>
											<a class="btn btn-sm  btn-danger" href="<?= base_url() ?>StatusEkonomi/deleteData/<?php echo $key->id_status;?>">Hapus</i></a>
										</div>
									</td>
								</tr>
								<?php
								$no++; 
							endforeach ?>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
		</div>



		<!-- MODAL -->
		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Tambah Data</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url() ?>StatusEkonomi/addData" method="post" class="form" accept-charset="utf-8">
							<div class="form-group">
								<label for="tingkat_status">Tingkat Status</label>
								<input type="text" class="form-control" id="tingkat_status" name="tingkat_status">
							</div>
							<div class="form-group">
								<label for="golonganEkonomi">Golongan Ekonomi</label>
								<input type="text" class="form-control" id="golonganEkonomi" name="golonganEkonomi">
							</div>
							<div class="float-right">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
