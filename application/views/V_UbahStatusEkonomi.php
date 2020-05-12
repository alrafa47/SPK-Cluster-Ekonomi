<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <h1 class="m-0 text-dark">Sistem Penunjang Keputusan Pengelompokan UKT Mahasiswa</h1>
      <hr>

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Mahasiswa</li>
            <li class="breadcrumb-item active">Ubah Data Mahasiswa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <?= validation_errors(); ?>
              
                <form action="<?= base_url() ?>StatusEkonomi/updateData/<?php echo $ubah->id_status ?>" method="post" class="form" accept-charset="utf-8">
                  <div class="form-group">
                    <label for="tingkat_status">Tingkat Status</label>
                    <input type="text" class="form-control" id="tingkat_status" name="tingkat_status" value="<?php echo $ubah->tingkat_status ?>">
                  </div>
                  <div class="form-group">
                    <label for="golonganEkonomi">Golongan Ekonomi</label>
                    <input type="text" class="form-control" id="golonganEkonomi" name="golonganEkonomi" value="<?php echo $ubah->nama_status ?>">
                  </div>
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- ./card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper