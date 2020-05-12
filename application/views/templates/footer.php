
<footer class="main-footer">
  <strong>Copyright &copy; 2020 <a href="#">Alfrizal Rhama</a></strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
   <b>Version</b> 1.0.0
 </div>
</footer>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url() ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/canvasjs.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- PAGE SCRIPTS -->
<!-- <script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script> -->
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<!-- <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script>

  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
     "paging": true,
     "lengthChange": false,
     "searching": true,
     "autoWidth": true,
   });

    <?php if ($this->session->flashdata('flash')) : ?>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Data Berhasil <?php echo $this->session->flashdata("flash") ?>',
        showConfirmButton: false,
        timer: 1500
      })
      $body.removeClass("loading");    
    <?php endif ?>
	//Initialize Select2 Elements
	$('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    	theme: 'bootstrap4'
    });
  });

  $(function () {
    var scatterChart = new Chart(ctx, {
      type: 'scatter',
      data: {
        datasets: [{
          label: 'Scatter Dataset',
          data: [{
            x: -10,
            y: 0
          }, {
            x: 0,
            y: 10
          }, {
            x: 10,
            y: 5
          }]
        }]
      },
      options: {
        scales: {
          xAxes: [{
            type: 'linear',
            position: 'bottom'
          }]
        }
      }
    });


  })
</script>


<script>
  var color = Chart.helpers.color;
  function generateData() {
    var data = [];
    for (var i = 0; i < 7; i++) {
      data.push({
        x: randomScalingFactor(),
        y: randomScalingFactor()
      });
    }
    return data;
  }

  var scatterChartData = {
    datasets: [{
      label: 'My First dataset',
      borderColor: window.chartColors.red,
      backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
      data: generateData()
    }, {
      label: 'My Second dataset',
      borderColor: window.chartColors.blue,
      backgroundColor: color(window.chartColors.blue).alpha(0.2).rgbString(),
      data: generateData()
    }]
  };

  window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myScatter = new Chart(ctx, {
      type: 'scatter',
      data: scatterChartData,
      options: {
        title: {
          display: true,
          text: 'Chart.js Scatter Chart'
        },
      }
    });
  };

  document.getElementById('randomizeData').addEventListener('click', function() {
    scatterChartData.datasets.forEach(function(dataset) {
      dataset.data = dataset.data.map(function() {
        return {
          x: randomScalingFactor(),
          y: randomScalingFactor()
        };
      });
    });
    window.myScatter.update();
  });
</script>


</body>
</html>
