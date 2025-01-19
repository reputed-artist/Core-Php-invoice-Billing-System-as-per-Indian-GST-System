
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet"  href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- media="screen" -->


  <link rel="stylesheet" href="../bower_components/Font-Awesome-Master/font-awesome/css/all.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
 


<link rel="stylesheet" type="text/css" href="../bower_components/exp_buttons/buttons.bootstrap.min.css"/>
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

   <!-- daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  

<link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">


<!-- <link rel="stylesheet" href="../plugins/swal2/sweetalert2.min.css" type="text/css" /> -->


<!-- <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css
" rel="stylesheet"> -->


  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


 <style>
    [class^='select2'] {
  border-radius: 0px !important;
  line-height: 21px !important;
  
  
}
.bootstrap-tagsinput {
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  
  
  margin-bottom: 10px;
  color: #555;
  width:100% !important;
  border-radius: 0px !important;
  max-width: 100%;

  cursor: text;
}
.bootstrap-tagsinput input {
  border: none;

  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0;
  margin: 0;
        // Add this in
}
.bootstrap-tagsinput .tag {
  background: gray;
  /*border: 1px solid black;*/
  padding: 5 18px;
  margin-right: 2px;
  color: black;
  border-radius: 6px;
  font-size: 14px;
}

input:focus, textarea:focus, select:focus, select{
        outline: none;
    }



html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;
/*background: url(snip.png) no-repeat 50% 50%;*/
    background-size: cover;
}

#loader {
    position: fixed;
    width: 100%;
    height: 100vh;
    z-index: 1;
    overflow: visible;
    background: #fff url('loading.gif') no-repeat center center;
}

  
  .btn-default{
  color:white;
  padding: 5px 30px 5px 5px;
  position: relative;
  width: 70px;

}
  
  </style>

  
        
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- <script src="../plugins/swal2/sweetalert2.min.js"></script> -->



<script src="../plugins/swal2/sweetalert2.all.min.js"></script>




<script src="../bower_components/echarts/dist/echarts.min.js"></script>

    <script src="../build/js/custom.min.js"></script>



<!-- date-range-picker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- bootstrap datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>




 <script src="../bower_components/exp_buttons/dataTables.buttons.min.js"></script>


 <script src="../bower_components/exp_buttons/jszip.min.js"></script>
 
 <script src="../bower_components/exp_buttons/pdfmake.min.js"></script>

  <script src="../bower_components/exp_buttons/vfs_fonts.js"></script>

  <script src="../bower_components/exp_buttons/buttons.html5.min.js"></script>
 
 <script src="../bower_components/exp_buttons/buttons.print.min.js"></script>


 <script type="text/javascript" src="../bower_components/exp_buttons/buttons.bootstrap.min.js"></script>






<script type="text/javascript">
  var loader;

function loadNow(opacity) {
    if (opacity <= 0) {
        displayContent();
    } else {
        loader.style.opacity = opacity;
        window.setTimeout(function() {
            loadNow(opacity - 0.05);
        }, 50);
    }
}

function displayContent() {
    loader.style.display = 'none';
    document.getElementById("wrapper").style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function() {
    loader = document.getElementById('loader');
    loadNow(1);
});
</script>


<script type="text/javascript" src="../bower_components/ultimate-export/libs/FileSaver/FileSaver.min.js"></script>
  <script type="text/javascript" src="../bower_components/ultimate-export/libs/js-xlsx/xlsx.core.min.js"></script>
  <script type="text/javascript" src="../bower_components/ultimate-export/libs/html2canvas/html2canvas.min.js"></script>
  <script type="text/javascript" src="../bower_components/ultimate-export/libs/jsPDF/jspdf.umd.min.js"></script>

  <script type="text/javascript" src="../bower_components/ultimate-export/tableExport.js"></script>

<script type="text/javaScript">

    function doExport(selector, params) {
      const options = {
        
        tableName: 'Table name'
      };

      jQuery.extend(true, options, params);

      const table = $(selector).DataTable();
        table.page.len(-1).draw();

      $(selector).tableExport(options);
      table.page.len(10).draw();
    }


  </script>
<script>
        $(document).ready(function() {
            // Attach event listeners to checkboxes
            $('#fixed-layout').change(function() {
                saveState('fixed-layout', this.checked);
                
            });

            $('#boxed-layout').change(function() {
                saveState('boxed-layout', this.checked);
            });

            $('#sidebar-collapse').change(function() {
                saveState('sidebar-collapse', this.checked);
            });

            $('#expand-on-hover').change(function() {
                saveState('expand-on-hover', this.checked);
            });

            $('#control-sidebar-open').change(function() {
                saveState('control-sidebar-open', this.checked);
            });

            $('#sidebar-skin-toggle').change(function() {
                saveState('sidebar-skin-toggle', this.checked);
            });

            function saveState(key, state) {
                $.post('save_settings.php', { key: key, state: state });
            }
        });
    </script>
