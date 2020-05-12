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
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="exampleInputEmail1">NIM</label>
                          <input type="text" class="form-control disabled" name="nim" value="<?= $ubah['nim'] ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nama</label>
                          <input type="text" class="form-control"name="nama" value="<?= $ubah['nama'] ?>">
                        </div>
                        <div class="form-group">
                          <label>Pekerjaan Ayah</label>
                          <select class="form-control" name="pekerjaan_ayah">
                            <?php foreach ($pekerjaan as $key=>$val): ?>
                              <?php if ($ubah['pekerjaan_ayah'] == $key){ ?>
                                <option value="<?php echo $key ?>" selected><?php echo $key  ?></option>
                              <?php }else{ ?>
                              <option value="<?php echo $key ?>"><?php echo $key  ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Pekerjaan Ibu</label>
                          <select class="form-control" name="pekerjaan_ibu">
                            <?php foreach ($pekerjaan as $key=>$val): ?>
                              <?php if ($ubah['pekerjaan_ibu'] == $key){ ?>
                                <option value="<?php echo $key ?>" selected><?php echo $key  ?></option>
                              <?php }else{ ?>
                              <option value="<?php echo $key ?>"><?php echo $key  ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Gaji Ayah</label>
                          <input type="text" class="form-control"name="gaji_ayah" value="<?= $ubah['gaji_ayah'] ?>">
                        </div>
                      </div>
                      <div class="col-md-1"></div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Gaji Ibu</label>
                          <input type="text" class="form-control"name="gaji_ibu" value="<?= $ubah['gaji_ibu'] ?>">
                        </div>
                        <div class="form-group">
                          <label>Status  Rumah</label>
                          <select class="form-control" name="status_rumah">
                            <?php foreach ($stat_rumah as $key=>$val): ?>
                              <?php if ($ubah['status_rumah'] == $key){ ?>
                                <option value="<?php echo $key ?>" selected><?php echo $key  ?></option>
                              <?php }else{ ?>
                              <option value="<?php echo $key ?>"><?php echo $key  ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>PBB</label>
                          <input type="text" class="form-control"name="pbb" value="<?= $ubah['pbb'] ?>">
                        </div>
                        <div class="form-group">
                          <label>Daya Listrik</label>
                          <select class="form-control" name="dayalistrik">
                            <?php foreach ($datalistrik as $key=>$val): ?>
                              <?php if ($ubah['dayalistrik'] == $key){ ?>
                                <option value="<?php echo $key ?>" selected><?php echo $key  ?></option>
                              <?php }else{ ?>
                              <option value="<?php echo $key ?>"><?php echo $key  ?></option>
                              <?php } ?>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Rekening Listrik</label>
                          <input type="text" class="form-control"name="reklistrik" value="<?= $ubah['reklistrik'] ?>">
                        </div>
                        <!-- <div class="form-group">
                          <label>Status Ekonomi </label>
                          <input type="text" class="form-control"name="status_ekonomi" value="<?= $ubah['status_ekonomi'] ?>">
                        </div> -->
                        <br>
                        <input type="submit" name="save" class="float-sm-right btn-lg btn btn-primary" value="Update">

                      </div>
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
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper