<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<h1 class="m-0 text-dark">Sistem Penunjang Keputusan Pengelompokan UKT Mahasiswa</h1>
			<hr>
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Mahasiswa</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						<li class="breadcrumb-item active">Mahasiswa</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<?php echo validation_errors(); ?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Mahasiswa</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form action="<?= base_url() ?>Mahasiswa/validation_form" method="post" accept-charset="utf-8">
								<div class="card-body">
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label for="exampleInputEmail1">NIM</label>
												<input type="text" class="form-control" id="exampleInputEmail1" name="nim">
											</div>
											<div class="form-group">
												<label for="exampleInputPassword1">Nama</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="nama">
											</div>
											<div class="form-group">
												<label>Pekerjaan Ayah</label>
												<select class="form-control" name="pekerjaan_ayah">
													<?php foreach ($pekerjaan as $key=>$val): ?>
														<option value="<?php echo $key ?>"><?php echo $key ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="form-group">
												<label>Pekerjaan Ibu</label>
												<select class="form-control" name="pekerjaan_ibu">
													<?php foreach ($pekerjaan as $key=>$val): ?>
														<option value="<?php echo $key ?>"><?php echo $key ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="form-group">
												<label>Gaji Ayah</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="gaji_ayah">
											</div>
											
										</div>
										<div class="col-md-1"></div>
										<div class="col-md-5">
											<div class="form-group">
												<label>Gaji Ibu</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="gaji_ibu">
											</div>
											<div class="form-group">
												<label>Status Rumah</label>
												<select class="form-control" name="status_rumah">
													<?php foreach ($stat_rumah as $key=>$val): ?>
														<option value="<?php echo $key ?>"><?php echo $key ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="form-group">
												<label>PBB</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="pbb">
											</div>
											<div class="form-group">
												<label>Daya Listrik</label>
												<select class="form-control" name="dayalistrik">
													<?php foreach ($datalistrik as $key=>$val): ?>
														<option value="<?php echo $key ?>"><?php echo $key ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="form-group">
												<label>Rekening Listrik</label>
												<input type="text" class="form-control" id="exampleInputPassword1" name="reklistrik">
											</div>
											<br>
											<input type="submit" name="save" class="float-sm-right btn-lg btn btn-primary" value="Save">
										</div>
									</div>

									
								</div>
								<!-- /.card-body -->
							</form>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- ./card-body -->
			</div>
			<!-- /.card -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<!-- card-body -->
						<div class="card-body">
							<div class="table-responsive">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>NIM</th>
											<th>Nama</th>
											<th>pekerjaan ayah</th>
											<th>pekerjaan ibu</th>
											<th>gaji ayah</th>
											<th>gaji ibu</th>
											<th>kesejahteraan</th>
											<th>Status Rumah</th>
											<th>pbb</th>
											<th>daya listrik</th>
											<th>rek listrik</th>
											<th>StatusEkonomi</th>
											<th>action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($mahasiswa as $key){ ?>
											<tr>
												<td><?= $no ?></td>
												<td><?= $key->nim ?></td>
												<td><?= $key->nama ?></td>
												<td><?= $key->pekerjaan_ayah ?></td> 
												<td><?= $key->pekerjaan_ibu ?></td>
												<td><?= $key->gaji_ayah ?></td>
												<td><?= $key->gaji_ibu ?></td>
												<td><?= $key->kesejahteraan ?></td>
												<td><?= $key->status_rumah ?></td>
												<td><?= $key->pbb ?></td>
												<td><?= $key->dayalistrik ?></td>
												<td><?= $key->reklistrik ?></td>
												<td>
													<?php
													if ($HasCount == 1) {
														echo $key->nama_status;
													}else{
														echo "-";
													}
													?>
												</td>
												<td>
													<div class="btn-group">
														<a href="<?= base_url() ?>Mahasiswa/hapus/<?= $key->nim ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
														<a href="<?= base_url() ?>Mahasiswa/ubah/<?= $key->nim ?>" class="btn btn-warning">update</a>
													</div>
												</td>
											</tr>
											<?php
											$no++; 
										}
										?>	
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>

				<!-- /.col -->
			</div>
			<!-- /.row -->


			<!-- konversi -->
			<!-- /.card -->


			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Hasil Konversi</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">

						</button>
					</div>
				</div>


				<div class="row">
					<div class="col-12">
						<div class="card">
							<!-- card-body -->
							<div class="card-body">
								<table id="example2" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>NIM</th>
											<th>Nama</th>
											<th>pekerjaan ayah</th>
											<th>pekerjaan ibu</th>
											<th>gaji ayah</th>
											<th>gaji ibu</th>
											<th>kesejahteraan</th>
											<th>Status Rumah</th>
											<th>pbb</th>
											<th>daya listrik</th>
											<th>rek listrik</th>
											<!-- <th>StatusEkonomi</th> -->
											<!-- <th>action</th> -->
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($mahasiswa as $key){ ?>
											<tr>
												<td><?= $no ?></td>
												<td><?= $key->nim ?></td>
												<td><?= $key->nama ?></td>
												<td><?php 
												switch ($key->pekerjaan_ayah) {
													case 'buruh':
													echo '1';
													break;
													case 'petani/peternak':
													echo '1';
													break;
													case 'tidak bekerja':
													echo '1';
													break;
													case 'nelayan':
													echo '2';
													break;
													case 'pedagang':
													echo '2';
													break;

													default:
													echo '3';
													break;
												}
												?>

											</td> 
											<td><?php 
											switch ($key->pekerjaan_ibu) {
												case 'buruh':
												echo '1';
												break;
												case 'petani/peternak':
												echo '1';
												break;
												case 'tidak bekerja':
												echo '1';
												break;
												case 'nelayan':
												echo '2';
												break;
												case 'pedagang':
												echo '2';
												break;
												default:
												echo '3';
												break;
											}
											?>
										</td>
										<td><?= $key->gaji_ayah ?></td>
										<td><?= $key->gaji_ibu ?></td>
										<td><?= $key->kesejahteraan ?></td>
									</td> 
									<td><?php 
									switch ($key->status_rumah) {
										case 'kos':
										echo '1';
										break;
										case 'sewa':
										echo '2';
										break;
										case 'hak milik sendiri':
										echo '3';
										break;
									}
									?>
								</td>
								<td><?= $key->pbb ?></td>
								<td><?php 
								switch ($key->dayalistrik) {
									case '450 W':
									echo '1';
									break;
									case '900 W':
									echo '2';
									break;
									case '1300 W':
									echo '3';
									break;
									case '2200 W':
									echo '3';
									break;
									default:
									echo '3';
									break;
								}
								?>
							</td>
							<td><?= $key->reklistrik ?></td>
						</td>
					</tr>
					<?php
					$no++; 
				}
				?>	
			</tbody>
		</table>
	</div>
	<!-- /.card-body -->
</div>
<!-- /.card -->
</div>

<!-- /.col -->
</div>
</section>
<!-- /.content -->
</div>