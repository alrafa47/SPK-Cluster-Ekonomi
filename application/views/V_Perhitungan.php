<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<h1 class="m-0 text-dark">Sistem Penunjang Keputusan Pengelompokan UKT Mahasiswa</h1>
			<hr>
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Perhitungan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						<li class="breadcrumb-item active">Perhitungan</li>
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
							<h3 class="card-title">Centroid</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<?php 
							if ($checkCentroid) { ?>
								<!-- //muncul tabel -->
								<div class="card-body table-responsive">
									<table id="example1" class="table table-bordered table-striped text-nowrap">
										<thead>
											<tr>
												<th>No</th>
												<th>id Centroid</th>
												<th>NIM</th>
												<th>Nama</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$no=1;
											foreach ($centroid as $key): ?>
												<tr>
													<td><?= $no ?></td>
													<td><?= $key->nama_status ?></td>
													<td><?= $key->nim ?></td>
													<td><?= $key->nama ?></td>
												</tr>
												<?php
												$no++; 
											endforeach ?>
										</tbody>
									</table> 
									<a href="<?= base_url() ?>Perhitungan/emptyData" class="btn btn-danger float-right mt-3">Unset Centroid</a>
								</div>
							<?php }else{ ?>
								<!-- //muncul form -->
								<form action="<?= base_url() ?>Perhitungan/setCentroid" method="post" accept-charset="utf-8">
									<?php
									$no=1; 
									foreach ($status as $value): 
										?>
										<div class="form-group">
											<label for="golonganEkonomi"><?= 'C'.$no."(".$value->nama_status.")" ?></label>
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
									<a class="mr-2 btn btn-success float-right" href="<?php echo base_url() ?>Centroid/setCentroidOtomatis">Set Otomatis</a>
								</form>
								<?php
							}
							?>
							
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
			<?php if ($this->session->flashdata('perhitungan')): ?>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Perhitungan
								</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<?php echo $this->session->flashdata('perhitungan');?>
							</div>
							<!-- /.card-body -->

						</div>
					</div>
				</div>
			<?php endif ?>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="float-right">
								<!-- <?php echo base_url() ?>Perhitungan/Counting -->
								<form class="form-inline" action="<?php echo base_url() ?>Perhitungan/Counting" method="post" >
									<div class="form-group mr-2">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="customSwitch1" name="view" value="check">
											<label class="custom-control-label" for="customSwitch1">Lihat Perhitungan</label>
										</div>
									</div>
									<input class="mr-2 btn btn-success float-right btn-disable" id="hitung-cluster" type="submit" value="Hitung" name="submit"
									<?php echo $disabled = ($checkCentroid) ? '' : 'disabled' ; ?>
									/>
								</form>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive">
							<table id="example2" class="table table-bordered table-striped text-nowrap">
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
										<th>pbb</th>
										<th>daya listrik</th>
										<th>rek.listrik</th>
										<th>StatusEkonomi</th>
										<!-- <th>action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php 
									$no=1;
									foreach ($mahasiswa as $key): ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $key->nim ?></td>
											<td><?= $key->nama ?></td>
											<td><?= $key->pekerjaan_ayah ?></td>
											<td><?= $key->pekerjaan_ibu ?></td>
											<td><?= $key->gaji_ayah ?></td>
											<td><?= $key->gaji_ibu ?></td>
											<td><?= $key->kesejahteraan ?></td>
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