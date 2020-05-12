<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<h1 class="m-0 text-dark">Sistem Penunjang Keputusan Pengelompokan UKT Mahasiswa</h1>
			<hr>
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Centroid</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						<li class="breadcrumb-item active">Centroid</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Penentuan Centroid</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<form action="<?= base_url() ?>Centroid/setCentroid" method="post" accept-charset="utf-8">
								<?php
								$no=1; 
								foreach ($status as $value): 
									?>
									<div class="form-group">
										<label for="golonganEkonomi"><?= $value->id_status."(".$value->nama_status.")" ?></label>
										<input type="hidden" class="form-control" name="id_centroid[]" value="<?= 'C'.$no ?>">
										<input type="hidden" class="form-control" name="id_status[]" value="<?= $value->id_status ?>">
										<select name="golonganEkonomi[]" class="form-control select2bs4" style="width: 100%;">
											<?php foreach ($mahasiswa as $mhs): ?>
												<option value="<?= $mhs->nim ?>"><?= $mhs->nama ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<?php
									$no++; 
								endforeach 
								?>
								<button type="submit" class="float-right btn btn-primary">
									Simpan
								</button>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="float-right">
								<?= validation_errors(); ?>
								<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" type="button">Tambah</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive">
							<table id="example1" class="table table-bordered table-striped text-nowrap">
								<thead>
									<tr>
										<th>No</th>
										<th>id Centroid</th>
										<th>Status</th>
										<th>NIM</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									foreach ($centroid as $key): ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $key->id_centroid ?></td>
											<td><?= $key->id_status ?></td>
											<td><?= $key->nim ?></td>

											<td>
												<div class="btn-group">
													<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default" type="button" data-id="<?= $key->nim;?>"><i class="fas fa-align-left"></i></button>
													<a class="btn btn-sm  btn-danger" href="<?= base_url() ?>StatusEkonomi/deleteData/<?= $key->nim;?>"><i class="fas fa-align-left"></i></a>
													<a class="btn btn-sm  btn-default" href="<?= base_url() ?>StatusEkonomi/deleteData/<?= $key->nim;?>"><i class="fas fa-align-left"></i></a>
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
			</div>
		</div>

