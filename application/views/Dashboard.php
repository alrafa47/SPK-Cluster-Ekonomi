<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<h1 class="m-0 text-dark">Sistem Penunjang Keputusan Pengelompokan UKT Mahasiswa</h1>
			<hr>
			<div class="row mb-2">
				<div class="col">
					<h3 class="m-0 text-dark">Dashboard</h3>
				</div><!-- /.col -->
				<div class="col-3">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item active">Dashboard</li>
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
				<div class="col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?= $sumStatus  ?></h3>
							<h4>Status Ekonomi</h4>
						</div>
						<div class="icon">
							<i class="fas fa-hand-holding-usd"></i>
						</div>
						<a href="<?= base_url()?>StatusEkonomi" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?= $sumMahasiswa  ?></h3>

							<h4>Mahasiswa</h4>
						</div>
						<div class="icon">
							<i class="fas fa-user-friends"></i>
						</div>
						<a href="<?php echo base_url() ?>Mahasiswa" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>

			<div class="row">
				<div class="col-12">
					<!-- Default box -->
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">
								<label>
									Data Penyebaram Kluster
								</label>
							</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fas fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<script>
								window.onload = function () {
									var chart = new CanvasJS.Chart("chartContainer", {
										animationEnabled: true,
										title: {
											text: "Penyebaran Titik Cluster"
										},
										axisY:{
											labelFontColor: "transparent",
											interval: 1
										},
										axisX: {
											title: "Jumlah Konversi Data Kriteria"
										},
										
										legend: {
											cursor: "pointer",
											itemclick: toggleDataSeries
										},
										data: <?php echo $chart ?>

									});
									chart.render();

									function toggleDataSeries(e) {
										if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
											e.dataSeries.visible = false;
										} else {
											e.dataSeries.visible = true;
										}
										e.chart.render();
									}

								}
							</script>
							<div id="chartContainer" style="height: 370px; max-width: 950; margin: 0px auto;">

							</div>

						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>
</div>
