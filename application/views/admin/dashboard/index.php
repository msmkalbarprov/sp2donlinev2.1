<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">   
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= trans('dashboard') ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('dashboard') ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $all_advices; ?></h3>

                <p>Daftar Penguji</p>
              </div>
              <div class="icon">
                <i class="ion ion-navicon-round"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $sent_advices; ?></h3>

                <p>Daftar Penguji via SP2D Online</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-upload"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $sp2d_advices; ?></h3>

                <p>SP2D</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-document"></i>
              </div>
              
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $sent_sp2d; ?></h3>

                <p>SP2D CAIR </p>
              </div>
              <div class="icon">
                <i class="ion ion-android-checkbox"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- <div class="row">
          <div class="card col-md-12">
            <div class="card-body">
              <div id="chartdiv"></div>
            </div>
          </div>
        </div> -->

        
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
        <div>
        <table id="listsp2d" class="table table-bordered table-striped" width="100%">
          <thead class="bg-secondary text-white">
            <tr>
                <th rowspan="3" class="valign text-center">No.SP2D</th>
                <th rowspan="3" class="valign text-center">SKPD</th>
                <th colspan="6" >Penerima</th>
            </tr>
            <tr>
                <th colspan="6">Keperluan</th>
            </tr>
            <tr>
               
                <th class="text-center">Jenis</th>
                <th class="text-center">Total</th>
                <th class="text-center">Potongan</th>
                <th class="text-center">Netto</th>
                <th class="text-center">Status</th>
                <th class="text-center">Tgl. transfer</th>
              </tr>
          </thead>
        </table>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- <script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script> -->
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>



<!-- amschart
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/kelly.js"></script> -->

<script>

$(document).ready(function(){

  // Apply chart themes
  var table = $('#listsp2d').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?= base_url('admin/Dashboard/datatable_json') ?>",
    "order": [[0,'asc']],
    "lengthMenu":[12, 30, 90],
    "columnDefs": [
    { "targets": 0, "name": "no_sp2d", 'searchable':true, 'orderable':false},
    { "targets": 1, "name": "nm_skpd", 'searchable':true, 'orderable':false},
    { "targets": 2, "name": "keperluan", 'searchable':true, 'orderable':false},
    { "targets": 3, "name": "tujuan", 'searchable':true, 'orderable':false},
    { "targets": 4, "name": "nilai", 'searchable':true, 'orderable':false},
    { "targets": 5, "name": "status", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "netto", 'searchable':false, 'orderable':false,'width':'100px'},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ],
      'rowsGroup': [0,1],
      'createdRow': function(row, data, dataIndex){
         // Use empty value in the "Office" column
         // as an indication that grouping with COLSPAN is needed
        //  alert(data[3]);
        //  return;
         if(data[3] === '<div class="text-right"><span align="left"><font size="2px">0,00</font></span></div></td>'){
            // Add COLSPAN attribute
            $('td:eq(2)', row).attr('colspan', 6);
            // Hide required number of columns
            // next to the cell with COLSPAN attribute
            $('td:eq(3)', row).css('display', 'none');
            $('td:eq(4)', row).css('display', 'none');
            $('td:eq(5)', row).css('display', 'none');
            $('td:eq(6)', row).css('display', 'none');
            $('td:eq(7)', row).css('display', 'none');
            // $('td:eq(8)', row).css('display', 'none');
         }
      }      
  });

  
            // $.ajax({
            //     type: "POST",
            //     url: "<?php echo base_url("admin/Dashboard/getData");?>",
            //     dataType: 'json',
            //     data: {
            //       '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            //     },
            //     beforeSend: function() {
            //         $("#overlay").fadeIn(100);
            //     },
            //     success: function(data){

            //       am4core.useTheme(am4themes_animated);
            //       am4core.useTheme(am4themes_kelly);
            //       var chart = am4core.create("chartdiv", am4charts.XYChart);
            //     // 
            //     chart.data = [{
            //       "bulan": "Januari",
            //       "realisasi": data.januari,
            //       "jumlah": data.tot1
            //     }, {
            //       "bulan": "Februari",
            //       "realisasi": data.februari,
            //       "jumlah": data.tot2
            //     }, {
            //       "bulan": "Maret",
            //       "realisasi": data.maret,
            //       "jumlah": data.tot3
            //     }, {
            //       "bulan": "April",
            //       "realisasi": data.april,
            //       "jumlah": data.tot4
            //     }, {
            //       "bulan": "mei",
            //       "realisasi": data.mei,
            //       "jumlah": data.tot5
            //     }, {
            //       "bulan": "Juni",
            //       "realisasi": data.juni,
            //       "jumlah": data.tot6
            //     }, {
            //       "bulan": "Juli",
            //       "realisasi": data.juli,
            //       "jumlah": data.tot7
            //     }, {
            //       "bulan": "Agustus",
            //       "realisasi": data.agustus,
            //       "jumlah": data.tot8
            //     }, {
            //       "bulan": "September",
            //       "realisasi": data.september,
            //       "jumlah": data.tot9
            //     }, {
            //       "bulan": "Oktober",
            //       "jumlah": data.oktober,
            //       "realisasi": data.tot10
            //     }, {
            //       "bulan": "November",
            //       "realisasi": data.november,
            //       "jumlah": data.tot11
            //     }, {
            //       "bulan": "Desember",
            //       "realisasi": data.desember,
            //       "jumlah": data.tot12
            //     }];
            //           var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            //           categoryAxis.dataFields.category = "bulan";
            //           categoryAxis.title.text = "Countries";

            //           // First value axis
            //           var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            //           valueAxis.title.text = "Realisasi";

            //           // Second value axis
            //           var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
            //           valueAxis2.title.text = "jumlah";
            //           valueAxis2.renderer.opposite = true;

            //           // First series
            //           var series = chart.series.push(new am4charts.ColumnSeries());
            //           series.dataFields.valueY = "realisasi";
            //           series.dataFields.categoryX = "bulan";
            //           series.name = "realisasi";
            //           series.tooltipText = "{name}: [bold]{valueY}[/]";
            //           series.columns.template.fill = am4core.color("#28a745");

            //           // Second series
            //           var series2 = chart.series.push(new am4charts.LineSeries());
            //           series2.dataFields.valueY = "jumlah";
            //           series2.dataFields.categoryX = "bulan";
            //           series2.name = "Jumlah";
            //           series2.tooltipText = "{name}: [bold]{valueY}[/]";
            //           series2.strokeWidth = 3;
            //           series2.yAxis = valueAxis2;

            //           // Add legend
            //           chart.legend = new am4charts.Legend();

            //           // Add cursor
            //           chart.cursor = new am4charts.XYCursor();
            //     }
                
            //     // 
            //   })
});



</script>

<style>
  body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 9pt;
}

#chartdiv {
  width: 100%;
  height: 400px;
}
</style>
