<?php

session_start();
include'../dbconnection.php';
include("checklogin.php");
check_login();
$current_page="index1";
include 'fy.php';
include 'inc/getState.php';
// function getState($key) {
//     return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
// }

 $sql='';

 // Fill combobox logic 
 function fill_brand($con)    
 {  
      
      $output ='';  
      $sql = "SELECT CASE WHEN MONTH(created)>=4 THEN concat(YEAR(created), '-',YEAR(created)+1) ELSE concat(YEAR(created)-1,'-', YEAR(created)) END AS financial_year FROM invtest2 GROUP BY financial_year order by financial_year DESC";  

      $result = mysqli_query($con, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {  
           $output ='';
           ?>   <option value="<?php echo $row['financial_year'];?>"> <?php echo $row['financial_year']; ?> </option> 

           <?php

           echo $output;  
      }  
      //return $output;  
 }     

function indian_number_format($num) {
    $num = "".$num;
    if( strlen($num) < 4) return $num;
    $tail = substr($num,-3);
    $head = substr($num,0,-3);
    $head = preg_replace("/\B(?=(?:\d{2})+(?!\d))/",",",$head);
    return $head.",".$tail;
}



$neworder=mysqli_query($con,"SELECT count(invid) as count, sum(totalamount) as 'turnover' FROM invtest2 WHERE created between '$startyear-04-01' and '$endyear-03-31' and MONTH(created) = MONTH(CURRENT_DATE())");

$val=mysqli_fetch_array($neworder);


$bouncerate=mysqli_query($con,"SELECT ROUND((COUNT(DISTINCT CASE WHEN MONTH(created) = MONTH(CURRENT_DATE) THEN invid END) - COUNT(DISTINCT CASE WHEN MONTH(created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) THEN invid END)) / COUNT(DISTINCT CASE WHEN MONTH(created) = MONTH(CURRENT_DATE) THEN invid END) * 100, 2) AS bounce_rate FROM invtest2 WHERE (MONTH(created) = MONTH(CURRENT_DATE) OR MONTH(created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)) AND YEAR(created) = YEAR(CURRENT_DATE)");

$getval=mysqli_fetch_array($bouncerate);

$val2=$getval[0];


$newclients=mysqli_query($con,"SELECT count(c_name) FROM client WHERE created between '$startyear-04-01' and '$endyear-03-31' and MONTH(created) = MONTH(CURRENT_DATE())");
$val3=mysqli_fetch_array($newclients);


$actval4=indian_number_format($val['turnover']);



$invtotal=mysqli_query($con,"SELECT count(invid),sum(totalitems),sum(totalamount),sum(taxamount) FROM `invtest2` where created between '$startyear-04-01' and '$endyear-03-30'");

$invval=mysqli_fetch_array($invtotal);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

   
  <?php include_once "links.php"; ?>
  <!-- Morris chart -->
  <link rel="stylesheet" type="text/css" href="../dist/css/stylefortimer.css">
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  

<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script> -->
<!--   <script src="../bower_components/echarts/dist/echarts.min.js"></script> -->
<script src="../bower_components/apexcharts/dist/apexcharts.min.js"></script>


<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="../bower_components/font/font.css">
    <style>
    @import url(../bower_components/font/font.css?family=Open+Sans);


/*    .cover_art{
      height: 200px !important;

    }
*/


  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini
<?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>"> 

<!-- <div id="loader"></div>
 -->
<div class="wrapper">

 <?php include_once"header.php";?>

  <?php include_once"navbar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $val['count']; ?></h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $val2; ?><sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $val3[0]; ?></h3>

              <p>Clients Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php 
              if ($val[0] == null || $val[0] == 0)
              {
                echo "0 Rs";
              }
              else{ echo $actval4."Rs"; }?></h3>

              <p>Turnover of <?php echo date('M') ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.first row -->


        
      <div class="row">
        <div class="col-md-9" >
          
          <!-- BAR CHART -->
          <div class="box box-info col-md-9" style="overflow: auto;" >
            <div class="box-header">
              <h3 class="box-title" id="FY">Turnover Chart of the FY : <?php echo $startyear."-".$endyear;  ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
           <div class=" chart-responsive col-md-9" style="padding-top:25px;">
                                <select name="brand" id="brand" class="form-control select2 pull-right " 
                                style="height: 34px;width:20%">  
                          <!-- <option value=""> FY </option> -->  
                          <?php echo fill_brand($con); ?>  
                     </select>
                     </br></br></br>
                     <p class="text-center"> 
                     <strong id="Fyz" style="font-size: 18px;"><?php echo "Sales: 1 Apr,"." ".$startyear." - 30 Mar,"." ".$endyear;  ?></strong> </p>
              
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>

            <div class="box-body col-md-3" id="bars" style="padding-top: 80px; padding-bottom: 50px; padding-left: 2px;">
               <p class="text-center">
                    <strong style="font-size: 18px;"> Items Sold</strong>
                  </p>
                      </br>
                      <?php


                      $query=mysqli_query($con,"SELECT item_name,COUNT(item_name) 'item_sold' FROM invtest INNER JOIN invtest2 on invtest.orderid = invtest2.orderid INNER join products on invtest.item_name = products.name where products.p_type = 'Machine' and invtest2.created BETWEEN '$startyear-04-01' and '$endyear-03-31' GROUP BY item_name ORDER BY COUNT(item_name) DESC LIMIT 5") or die("Error".mysqli_error($con));


                      $i=0;

                      $colors=array("aqua","red","green","yellow","primary");

                      $ct=mysqli_num_rows($query);

                      //echo $ct;

                      if($ct == 5 || $ct < 5)
                      {
                      while($ro = mysqli_fetch_array($query))  
                      {

                      ?>
           <div class="progress-group">
                    <span class="progress-text"><?php echo $ro['item_name']; ?></span>
                    <span class="progress-number"><b><?php echo $ro['item_sold']; ?></b>/200</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-<?php echo $colors[$i]; ?>" style="width:<?php $r=(100*$ro['item_sold'])/200; echo $r; ?>%"></div>
                    </div>
                  </div>              
                    <?php $i+=1; 
                       }
                    }
                    if ($ct < 5) 
                    {

                       $v=5-$ct;

                    for($i=1;$i<=$v;$i++)
                    {
                      ?>
                 <div class="progress-group">
                    <span class="progress-text">No-Items</span>
                    <span class="progress-number"><b>00</b>/200</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-<?php echo $colors[$i]; ?>" style="width: 100%"></div>
                    </div>
                  </div>
 
                  <?php } }
                  ?>
              

            </div>


            <div class="box-body col-md-12">
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header" id="invval"><?php echo $invval[0]; ?></h5>
                    <span class="description-text">TOTAL Invoices</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header" id="totalitemval"><?php echo $invval[1]; ?></h5>
                    <span class="description-text">TOTAL ITEMS SOLD</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%
                    </span>
                    <h5 class="description-header" id="yeartotalval">
                    <?php

                     echo indian_number_format($invval[2]).".00"." Rs"; ?></h5>
                    <span class="description-text">TOTAL TURNOVER</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header" id="taxtotalvalz"><?php echo indian_number_format($invval[3]).".00"." Rs"; ?></h5>
                    <span class="description-text">GST Collection of Year </span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
         
          </div>          

     
        <!-- /.col (RIGHT) -->
      </div>
      
      <!-- /.row (main row) -->
      </div>
    
       <div class="col-md-3" >
          
          <!-- BAR CHART -->
          <div class="box box-info" style="height: 350px;">
            <div class="box-header with-border">
              <h3 class="box-title">Consumables sold in FY </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id='chart_pie_5' class='chart_morris' style="height: 230px;"></div>
            <div id='chart_pie_5_legend' class='text-center'></div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>     



<div class="col-md-3 timer" >
    <div class="box box-info">
          <div class="box-header with-border">
              <h3 class="box-title"> Timer </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>

      <div class="timeDiv">
        <span class="font-color" id="time"></span>
        <span class="font-color" id="sec"></span>
        <span class="font-color" id="med"></span>
      </div>
      <div class="dayDiv">
        <span class="font-color day">SUN</span>
        <span class="font-color day">MON</span>
        <span class="font-color day">TUE</span>
        <span class="font-color day">WED</span>
        <span class="font-color day">THU</span>
        <span class="font-color day">FRI</span>
        <span class="font-color day">SAT</span>
      </div>
      <span class="font-color" id="full-date"></span>
    </div>

   </div>


  

  </div>

<div class="row">
  
      <div class="col-md-3">  

              <div class="box box-info" style="height: 350px;">
            <div class="box-header with-border">
              <h3 class="box-title">Client Type </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart_morris" id="chart_pie_1" style="height: 230px;"></div>
                          <div id='chart_pie_1_legend' class='text-center'></div>
                          </br></br>
            </div>
            <!-- /.box-body -->
          </div>

      </div>
 
      <div class="col-md-3">
          
          <!-- BAR CHART -->
          <div class="box box-info" style="height: 350px;">
            <div class="box-header with-border">
              <h3 class="box-title">Clients in Countries</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id='chart_pie_2' class='chart_morris' style="height: 230px;"></div>
            <div id='chart_pie_2_legend' class='text-center'></div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>       


     
       
       <div class="col-md-3">
          
          <!-- BAR CHART -->
          <div class="box box-info" style="height: 350px;">
            <div class="box-header with-border">
              <h3 class="box-title">Products Count</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id='chart_pie_4' class='chart_morris' style="height: 230px;"></div>
            <div id='chart_pie_4_legend' class='text-center'></div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>       


     
         <div class="col-md-3" style="padding-right: 16px;">
          
          <div class="box box-info" style="height: 350px; ">
            <div class="box-header with-border">
              <h3 class="box-title">Billed / NB Clients</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id='chart_pie_3' class='chart_morris' style="height: 230px;"></div>
            <div id='chart_pie_3_legend' class='text-center'></div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>       




        <div class="col-md-9">
          <div class="box box-info" style="overflow: auto;">
            <div class="box-header with-border">
              <h3 class="box-title">Reminder for Clients</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="reminder">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>proforma Id</th>
                  <th>Company Name</th>
                  <th>Item name</th>
                  <th> Mob</th>

                </tr>
            
              </table>
            </div>

          </div> 
          </div>    



         <div class="col-md-3">
          
          <div class="box box-info" style="height: 350px; ">
            <div class="box-header with-border">
              <h3 class="box-title">Doc. Count of Year</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div id='chart_pie_6' class='chart_morris' style="height: 230px;"></div>
            <div id='chart_pie_6_legend' class='text-center'></div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>       

          
      <!--     <div class="col-md-4">
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
      
              <div class="pull-right box-tools">
    
                <div class="btn-group">

                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
  
            </div>
      
            <div class="box-body no-padding">
    
              <div id="calendar" style="width: 100%"></div>
            </div>
      
  
          </div>
          </div>   -->

      <div class="col-md-6 box-body">
          <div class="box box-info" style="height: 425px">
            <div class="box-header with-border">
              <h3 class="box-title"> Location Tree Data Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>
                <div class="box-body chart-responsive" style="margin-top: -15px;">
                   <div class="chart" id="ebar-chart-tree" style="height: 400px;"></div>
                </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>       

  

      <div class="col-md-6 box-body">
          <div class="box box-info" style="height: 425px">
            <div class="box-header with-border">
              <h3 class="box-title"> Annual Turnover Data Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>
                <div class="box-body chart-responsive">
            </br>              </br>
                   <div class="chart" id="bar-chart3" style="height: 300px;"></div>
               </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box -->
        </div>       



 

         </div><!-- </section> -->

      
    </section>
    <!-- /.content -->
  </div>
  <?php include_once"footer.php";?>

 <?php include_once"settings.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->

 <!-- Include Style Sheet -->
    


<script>

$(document).ready(function() {

$('#calendar').datepicker();

    // Make an AJAX request to fetch pie chart data
    $.ajax({
        url: 'ajax/charts.php', // Replace with the path to your PHP script
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Access data for each pie chart
            var pie1Data = data.pie1;
            //console.log(pie1Data);

            var pie2Data = data.pie2;
            //console.log(pie2Data);
            var pie3Data = data.pie3;
            var pie4Data = data.pie4;
            var graph1data =data.graph1;
            var graph2data =data.graph2;
            var pie5Data = data.pie5;
           
            var pie6Data = data.pie6;

            var tbdata=data.tbdata;

            var areadata=data.areadata;

            var x = Morris.Bar({
            element: 'bar-chart',
            data: graph1data,
            //'#f56954','#00a65a'
            barColors: [ '#03a9f3','#55ce63','#f56954'],
                xkey: 'y',
                ykeys: ['b','a','c'],
                labels: ['GST','Turnover','item_sold'],
                hideHover: 'auto',    
                xLabelAngle: 60,

                nbYkeys2: 1,
                dataLabels:false,  
                gridTextWeight:'Bold',
                
                hoverCallback: function(index, options, content, row) {
                  var dataLabel = row.label; // Assuming 'label' is the key for item_name
                  return "<div style='text-align:center;'>" + content + "<br>" + dataLabel + "</div>";
              },
               
          });
    

         $('#brand').change(function(){  
                //var data21,data22; 
                var brand_id = $(this).val();
                //console.log(brand_id);
                var startyear =brand_id.substr(0,4);
                //console.log(startyear);
                var endyear =brand_id.substr(5,10);
                //console.log(endyear);
               $.ajax({  
                url:"ajax/load_data.php",  
                method:"GET",  
                data:{brand_id:brand_id},  
                dataType:'json',
                showLoader:true,
                success:function(data){  
                  
                var data21=data['arr1'];
                var data22=data['arr2'];
                console.log(data21+"data21");
                console.log(data22[0].item_name);
                      
                x.setData(data21);
                x.redraw();

                console.log("Total Length"+data22.length);
                      //console.log(data['1']['item_name']);
                   // console.log(data[2]);

                    var arr=["aqua","red","green","yellow","primary","red","purple"];
              
                      $('#bars').empty();
                      var title='<p class="text-center"><strong style="font-size: 18px;"> Items Sold</strong></p></br>';
                      $('#bars').append(title);
                      var v=data22.length;
                      var val2= 5 - v;
                      console.log("V value:"+val2);
                        
                        if(val2 != 0)
                      { 
                        var sp='</br>'
                      }
                      
                      for(var i=0;i<=5;i++){
                      console.log(i);
                      
                      if(val2 == 0)
                      {
                      
                        console.log("Enters if");

                     $('#bars').append('<div class="progress-group"><span class="progress-text" id="'+i+'">'+data22[i].item_name+'</span><span class="progress-number"><b>'+data22[i].item_sold+'</b>/200</span><div class="progress sm"><div class="progress-bar progress-bar-'+arr[i]+'" style="width:'+(100 * data22[i].item_sold)/300+'%"></div></div></div>');
                     //v+=1;
                       }

                      else if (val2 < 5)
                      {
                          for(var i=0;i<v;i++){
                             console.log("else if "+i);
                                $('#bars').append('<div class="progress-group"><span class="progress-text" id="'+i+'">'+data22[i].item_name+'</span><span class="progress-number"><b>'+data22[i].item_sold+'</b>/200</span><div class="progress sm"><div class="progress-bar progress-bar-'+arr[i]+'" style="width:'+(100 * data22[i].item_sold)/200+'%"></div></div></div>');
                          }

                            for(var j=val2;j<=5;j++){
                                                            console.log("enter else if 2nd loop"+j);

                              $('#bars').append('<div class="progress-group"><span class="progress-text" id="'+j+'">No-Items</span><span class="progress-number"><b>'+"0"+'</b>/200</span><div class="progress sm"><div class="progress-bar progress-bar-'+arr[j]+'" style="width:100%"></div></div></div>');
                              val2+=1;


                            }

                      }                    
                      else 
                      {

                        console.log("enter else");

                      }
                      }

                    console.log("For loop complete");                  

                }
                
                });

                $.ajax({  
                url:"ajax/load_turn.php",  
                method:"GET",  
                data:{brand_y:brand_id},
                showLoader:true,  
                dataType:'json',
                success:function(data){  
                      //console.log(data);
                      //console.log(data['invoices']);

                       $('#invval').text(data['invoices']);
                       $('#totalitemval').text(data['totalitems']);
                      
                       $('#yeartotalval').text(addCommas(data['turnovery'])).append(".00 Rs");
                       $('#taxtotalvalz').text(addCommas(data['taxy'])).append(".00 Rs");
                      $('#FY').text("Turnover Chart of the FY : ").append(brand_id);
                      $('#Fyz').text("Sales: 1 Apr," +" "+ startyear+" - 30 Mar," +" "+ endyear);    
                     //console.log(data[1]);
                      // console.log(data[2]);
                      // console.log(data[3]);  
                    
                }
                });
              

  });


                    // Now you can use these variables to generate your Morris charts or any other charting library
                    Morris.Donut({
                        element: 'chart_pie_1',
                        data: pie1Data,
                    }).options.colors.forEach(function(color, index) {
                      if (pie1Data[index] != undefined) {
                      var node = document.createElement('span');
                      node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie1Data[index].label+'</span>';
                      document.getElementById("chart_pie_1_legend").appendChild(node);
                    }
                        // Your legend generation logic here
                    });


                    Morris.Donut({
                    element: 'chart_pie_2',
                    data:pie2Data,
                    resize:true,    
                    //dataLabels: true,
                    //showPercentage: true,
                    dataLabelsPosition: 'outside'
                  }).options.colors.forEach(function(color, b){ 
                    
              //b is parameter variable
                    if (pie2Data[b] != undefined) {
                      var node = document.createElement('span');
                      node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie2Data[b].label+'</span>';
                      document.getElementById("chart_pie_2_legend").appendChild(node);
                    }
                  });
         
                    Morris.Donut({
                    element: 'chart_pie_3',
                    data:pie4Data,
                    resize:true,    
                    //dataLabels: true,
                    //showPercentage: true,
                    //dataLabelsPosition: 'outside',
                  }).options.colors.forEach(function(color, c){ 
                    if (pie4Data[c] != undefined) {
                      var node = document.createElement('span');
                      node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie4Data[c].label+'</span>';
                      document.getElementById("chart_pie_3_legend").appendChild(node);
                    }
                  });
                 
                    Morris.Donut({
                    element: 'chart_pie_4',
                    data:pie3Data,
                    resize:true,    
                    //dataLabels: true,
                    //showPercentage: true,
                    //dataLabelsPosition: 'outside',
                  }).options.colors.forEach(function(color, d){ 
                    if (pie3Data[d] != undefined) {
                      var node = document.createElement('span');
                      node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie3Data[d].label+'</span>';
                      document.getElementById("chart_pie_4_legend").appendChild(node);
                    }
                  });   // Repeat similar logic for other charts


                    Morris.Donut({
                    element: 'chart_pie_5',
                    data:pie5Data,
                    resize:true,    
                    dataLabels: true,
                    showPercentage: true,
                    //dataLabelsPosition: 'outside',
                  }).options.colors.forEach(function(color, d){ 
                    if (pie5Data[d] != undefined) {
                      var node = document.createElement('span');
                      node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie5Data[d].label+'</span>';
                      document.getElementById("chart_pie_5_legend").appendChild(node);
                    }
                  });   // Repeat similar logic for other charts


                   Morris.Donut({
                    element: 'chart_pie_6',
                    data:pie6Data,
                    resize:true,    
                    dataLabels: true,
                    showPercentage: true,
                    //dataLabelsPosition: 'outside',
                  }).options.colors.forEach(function(color, d){ 
                    if (pie6Data[d] != undefined) {
                      var node = document.createElement('span');
                      node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie6Data[d].label+'</span>';
                      document.getElementById("chart_pie_6_legend").appendChild(node);
                    }
                  });  

                  var bar = new Morris.Bar({
                  element: 'bar-chart3',
                  resize: true,
                  data: graph2data, 
                  barColors: ['#00a65a','#FFBF00','#f56954'],
                  xkey: 'y',
                  ykeys: ['b','a','c'],
                  labels: ['GST','Turnover','item_sold'],
                  dataLabels:false,
                  hideHover: 'auto',
                  xLabelAngle: 60,
                  nbYkeys2:1,
                  //gridTextSize: '14px',
                  gridTextWeight:'Bold',
                  hoverCallback: function(index, options, content, row) {
                    var dataLabel = row.label; // Assuming 'label' is the key for item_name
                    return "<div style='text-align:center;'>" + content + "<br>" + dataLabel + "</div>";
                },
                 
                });


                  //   Morris.Donut({
                  //   element: 'chart_pie_6',
                  //   data:pie6Data,
                  //   resize:true,    
                  //   //dataLabels: true,
                  //   //showPercentage: true,
                  //   //dataLabelsPosition: 'outside',
                  // }).options.colors.forEach(function(color, d){ 
                  //   if (pie6Data[d] != undefined) {
                  //     var node = document.createElement('span');
                  //     node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie6Data[d].label+'</span>';
                  //     document.getElementById("chart_pie_6_legend").appendChild(node);
                  //   }
                  // });   // Repeat similar logic for other charts



                  var table = $('#reminder');
                  console.log("testiing print"+tbdata);
               $.each(tbdata, function(index, reminder) {
                var row = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + reminder.invno + '</td>' +
                    '<td>' + reminder.client + '</td>' +
                    '<td>' + reminder.item + '</td>' +
                    '<td>' + reminder.mob + '</td>' +
                    '</tr>';
                table.append(row);

              })

       let areaChartData = [];
        areadata.forEach(function(item) {
           let locationParts = item.location.split('-');
            let city = locationParts[0].trim(); // Get the left side (city)
            let count = item.count; // This will be the y value
            console.log(`x: ${city}, y: ${count}`);
            areaChartData.push({ x: city, y: count });
            //console.log(`x: ${item.location}, y: ${item.count}`);
        });


var options = {
  series: [
    {
     
          data: areaChartData,
      
    },
  ],
  legend: {
    show: false,
  },
  chart: {
    height: 360,
    type: "treemap",
    toolbar: {
      show: false, // Disable the toolbar
    },
  },
  title: {
    // text: 'Distributed Treemap (different color for each cell)',
    align: "center",
  },
  colors: [
    "#3B93A5",
    "#F7B844",
    "#ADD8C7",
    "#EC3C65",
    "#CDD7B6",
    "#C1F666",
    "#D43F97",
    "#1E5D8C",
    "#421243",
    "#7F94B0",
    "#EF6537",
    "#C0ADDB",
  ],
  plotOptions: {
    treemap: {
      distributed: true,
      enableShades: false,
    },
  },
};

var chart = new ApexCharts(document.querySelector("#ebar-chart-tree"), options);
chart.render();




    function currentTime() {
    var date = new Date();
    var day = date.getDay();
    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();
    var month = date.getMonth();
    var currDate = date.getDate();
    var year = date.getFullYear();
    var monthName = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    var showDay = $('.dayDiv span')
    var midDay= "AM"
    midDay = (hour>=12)? "PM":"AM";
    hour = (hour==0)?12:((hour<12)? hour:(hour-12));
    hour = updateTime(hour);
    min = updateTime(min);
    sec = updateTime(sec);
    currDate= updateTime(currDate);
    $("#time").html(`${hour}:${min}`);
    $("#sec").html(`${sec}`);
    $("#med").html(`${midDay}`);
    $("#full-date").html(`${monthName[month]} ${currDate} ${year}`);
    showDay.eq(day).css('opacity','1')
  }
  updateTime = function(x){
    if(x<10){
      
      return "0"+x
    }
    else{
      
      return x;
    }
    
  }
  setInterval(currentTime,1000);


        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('AJAX request failed: ' + status + ', ' + error);
        }
    });
});


    
 


function addCommas(numberString) {
  numberString += '';
  var x = numberString.split('.'),
      x1 = x[0],
      x2 = x.length > 1 ? '.' + x[1] : '',
      rgxp = /(\d+)(\d{3})/;

  while (rgxp.test(x1)) {
    x1 = x1.replace(rgxp, '$1' + ',' + '$2');
  }

  return x1 + x2;
}


</script>


<!-- <script type="text/javascript" src="amplitude audio/js/functions.js"></script> -->
  

</body>
</html>
