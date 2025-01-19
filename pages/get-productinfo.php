<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
 check_login();

include 'inc/getState.php';

$current_page="manage-products";

$invid=0;
$item_sold=0;
$total=0;

If(isset($_GET['pinfoid']))
{
  $val=$_GET['pinfoid'];


  $cvdata=mysqli_query($con,"SELECT COUNT(invid) 'invid',sum(quantity) 'item_sold', sum(totalamount) 'total' FROM invtest INNER JOIN invtest2 on invtest.orderid = invtest2.orderid INNER join products on invtest.item_name = products.name where 
    products.p_id=$val and invtest2.created GROUP BY item_name ORDER BY sum(quantity)");





  while($rx=mysqli_fetch_array($cvdata))

{
  $invid=$rx['invid'];
  $item_sold=$rx['item_sold'];
  $total=$rx['total'];

}


  $cinfo=mysqli_query($con,"SELECT COALESCE(techsps.p_id, products.p_id) AS p_id, COALESCE( products.name) AS name, COALESCE(techsps.techs, '') AS techs, COALESCE(techsps.img_loc, '') AS img_loc, COALESCE(products.hsn, '') AS hsn, COALESCE(products.p_type, '') AS p_type, COALESCE(techsps.subcat, '') AS subcat, COALESCE(products.created, '') AS created FROM products LEFT JOIN techsps ON techsps.p_id = products.p_id WHERE products.p_id =$val")  or die("Error: " . mysqli_error($con));

 //echo "SELECT products.p_id, products.name, techsps.techs, techsps.img_loc, products.hsn, products.p_type, techsps.subcat, products.created FROM `techsps` INNER JOIN products on techsps.p_id=products.p_id where products.p_id=$val";



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
 <?php include_once "links.php"; ?>
 <!-- Morris chart -->
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


</style>
</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">
<div id="loader"></div>
<div class="wrapper">

  <?php include_once "header.php"; ?>
    
<?php include_once"navbar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Product Details
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Product Details</li>
      </ol>
    </section>
    </br> 
<?php     
$cnt=0;
 while($row=mysqli_fetch_array($cinfo))

{

$cnt++;


$p_name=$row['name'];

$techs=$row['techs'];
$img=$row['img_loc'];
$hsn=$row['hsn'];
$subcat=$row['subcat'];


?>
     <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?php echo $row['name']; ?></h3>
              <h5 class="widget-user-desc">Since <?php
                    $c=date("d-M-Y",strtotime($row['created']));
                      echo $c;
               //echo $row['created']; ?> </h5>
            </div>
            <div class="widget-user-image" >
          <?php    echo "<img class='img-thumbnail' style='width: 250px !important;' src='../dist/img/".$img."' alt='User Avatar'>"; ?>
            </div>
            </br></br></br></br></br>
            <div class="box-footer" style="padding-top: 52px;">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php
                    //$test=$total;
                    //echo $test;
                    if($total == null || $total == 0)
                    {
                      echo "0";
                      //echo "<script>console_log('Enter if');</script>";
                      //echo "<p>0 </p>";
                    }
                    else
                    {
                     echo $total; 
                    } ?>
                      
                    </h5>
                    <span class="description-text">SALES</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php

                    $test=$item_sold;
                    //echo $test;

                      if($test == null || $test == 0)
                    {
                      //echo $test;
                       echo "<p>0 </p>";
                    }
                    else{
                     echo $item_sold; 
                    } ?> </h5>
                    <span class="description-text">Products</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $invid; ?> </h5>
                    <span class="description-text">Invoice</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->
              </br>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
     


                              <div class="col-md-4" id="examplez">
                                    <div class="box box-info" style="height: 360px;">
                                            
                                            <div class="box-header with-border center">
                                               <h3 class="box-title"><b> Technical Information </b> </h3> </div>

                                      <div class="box-body">
                                          <div class="form-group" style="padding-left: 6px">
                                          </br>
                                      <strong><p align="center" style="color:black;"></p></strong>
                                      <p align="left">
                                       <?php   $dy=array();

                                                  array_push($dy,$p_name);

                                                   printf ("<h4 class='box-title'><b><u>".$p_name."</b></u></h4>");


                                              echo "</br>";
                                             $var=$techs;
                                           

                                          $data2=mysqli_real_escape_string($con,$var);

                                            //echo $data2;
                                            

                                            $data = str_replace("\r",' ', $data2);
                                           $data = str_replace(" ",'', $data2);

                                        $data=explode(';', $data2);

                                           //var_dump( $data);
                                           echo "<ul>";
                                           
                                           for ($i = 0; $i < count($data); $i++) {
                                          print "<li>".stripcslashes($data[$i])."</br>"."</li>";
                                        } 
                                        echo "</br>";
                                        ?>
                                        </p>
                                        <?php } ?>

                                         </a>
                                    
                                       <!--  <a href="edittest.php?invid=<?php echo $row['invid'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                            
                                    <a class="btn btn-danger btn-xs pull-right" id="delete_product" data-id="<?php echo $id; ?>" ><i class="fa fa-trash-o "></i></a> -->
                                  </div> 
                                </div>

                              </div>
                              </div> 



                                <div class="col-md-4" id="examplez">
                                    <div class="box box-info" style="height: 360px;">
                                            
                                        <div class="box-header with-border center">
                                              <h3 class="box-title"><b>Yearly Sold Item Count  </b> </h3> </div>

                                      <div class="box-body" style="margin-top: -20px">
                                          <div class="form-group" style="padding-left: 6px">
                                      
                                      

                                      <div class="box-body chart-responsive">
                          <div class="chart_morris" id="chart_pie_1" style="height: 250px; margin-top: 5px !important;"></div>
                                      <div id='chart_pie_1_legend' class='text-center'></div>
                                      </br></br>
                        </div>
                                    
                                       <!--  <a href="edittest.php?invid=<?php echo $row['invid'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                            
                                    <a class="btn btn-danger btn-xs pull-right" id="delete_product" data-id="<?php echo $id; ?>" ><i class="fa fa-trash-o "></i></a> -->
                                  </div> 
                                </div>

                              </div>
                              </div> 



             

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;">Invoice Details</h3>
            </div>
            <!-- /.box-header -->
            <!--  <button type="button" id="btnplus"class="btn btn-success btn-sm pull-right" style="margin: 2px 20px 2px 2px;" onclick="window.location.href = 'add-client.php'";><span class="glyphicon glyphicon-plus"></span></button><br> -->

            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                            
                            <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Invoice Id</th>
                                  <th> Company Name</th>
                                  <th> Location</th>
                                  <th> Item Name </th>
                                  <th> Amount</th>
                                  <th> Created </th>
                                   <!-- <th>Reg. Date</th> -->
                                      <th>Edit</th>
                                      <th>View</th>
                                      <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $ret=mysqli_query($con,"select invtest.item_name 'Item', invtest2.invid,invtest2.created, client.c_name,substring_index(client.c_add, ',', -1) as location,invtest2.totalamount 'totalamount' from invtest2 inner join invtest on invtest.orderid = invtest2.orderid and invtest.item_name='$p_name' inner join client on invtest2.cid = client.cid  GROUP by invtest.orderid")or die("Error: " . mysqli_error($con));
     
                           
                $cnt=1;
                while($row=mysqli_fetch_array($ret))
                {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['invid'];?></td>
                                  <td>&nbsp;<?php echo $row['c_name'];?></td>
                                  <td>&nbsp;<?php echo $row['location'];?></td>
                                  <td>&nbsp;<?php echo $row['Item'];?></td>
                                  <td>&nbsp;<?php echo $row['totalamount'];?></td> 
                                  
                                  
                                  <td>&nbsp;<?php 
                                    $c=date("d-M-Y",strtotime($row['created']));
                                        echo $c;
                                  ?></td> 
                                 <td>
                                     
                                     <a href="edittest.php?invid=<?php echo $row['invid'];?>"> 
                                     <button class="btn btn-primary btn-xs" style="width:30px;height:25px"><i class="fa fa-pencil"></i></button></a>
                                            
                                    
                                   <?php $did=$row['invid']; ?>
                                   </td>
                                   <td>
                                     <a href="invtest.php?inv=<?php echo $row['invid'];?>" target="_blank"> 
                                     <button class="btn btn-warning btn-xs" style="width:30px;height:25px"><i class="fa fa-fw fa-eye"></i></button></a>
                                  </td> 
                                  <td>
                                    <a class="btn btn-danger btn-xs" id="delete_product" style="width:30px;height:25px" data-id="<?php echo $did; ?>" ><i class="fa fa-trash-o "></i></a>
                                  </td> 
                              </tr>

                              
                              <?php $cnt=$cnt+1; } }?>
                             
                              </tbody>
                <tfoot>
                <tr>
                  <th>Sr. no.</th>
                  <th>Invoice Id</th>
                  <th>Company Name</th>
                  <th>Location</th>
                  <th> Item Name </th>
                  <th>Amount </th> <th>Created</th>
                                    <th>Edit</th>
                                      <th>View</th>
                                      <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->



  </div>
  <!-- /.content-wrapper -->
   <?php include_once"footer.php"; ?>

  <?php include_once "settings.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
           'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
  
  // 'dom':"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
   //   "<'row'<'col-sm-12'tr>>" +
   //   "<'row'<'col-sm-5'i><'col-sm-7'p>>",
 dom: "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
    
       buttons: [
             {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o">&nbsp; Copy </i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
      
            },
            {
                text: '{ } &nbsp; JSON',
                className: "btn-sm btn btn-danger",
                titleAttr: 'JSON',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                },
                action: function ( e, dt, button, config ) {
                    var data = dt.buttons.exportData();
 
                    $.fn.dataTable.fileSave(
                        new Blob( [ JSON.stringify( data ) ] ),
                        'Export.json'
                    );
                }
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o">&nbsp; Excel</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Excel',
                                title: 'AdminLT || Clients Data',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o">&nbsp; CSV</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'CSV',
                                title: 'AdminLT || Clients Data',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o">&nbsp; PDF</i>',
                className: "btn-sm btn btn-danger",  
                orientation: 'landscape',
                pageSize: 'A3',          
                titleAttr: 'PDF',
                title: 'AdminLT || Clients Data',
                customize: function(doc) {  
                doc.pageMargins = [10,10,10,10];
                doc.defaultStyle.fontSize = 7;
                doc.styles.tableHeader.fontSize = 7;

               
                doc.styles.tableFooter.fontSize=15;
                doc.styles.title.fontSize = 15;
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();
        // Create a footer
        doc['footer']=(function(page, pages) {
            return {
                columns: [
                {
                        // This is the right column
                        alignment: 'center',
                        text: ['Clients Data from CodeTech Engineers'],
                        
                    },
                    {
                        // This is the right column
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                        //fontSize:10
                    }
                ],
                margin: [10, 0]
            }
        });


        // doc['header'] = (function (page, pages) {
        //         return {
        //           columns: [
        //             {
        //               // 'This is your left footer column',
        //               alignment: 'left',
        //               //fontSize: 8,
        //               text: ['test'],
        //              // margin: [0, 10]
        //             },
        //             {
        //               // This is the right column
        //               alignment: 'right',
        //               text: ['ama'],
        //               //margin: [0, 10]
        //             }
        //           ],
        //           margin: [30, 0]
        //         }
        //       });

        // Styling the table: create style object
        var objLayout = {};
        // Horizontal line thickness
        objLayout['hLineWidth'] = function(i) { return .5; };
        // Vertikal line thickness
        objLayout['vLineWidth'] = function(i) { return .5; };
        // Horizontal line color
        objLayout['hLineColor'] = function(i) { return '#aaa'; };
        // Vertical line color
        objLayout['vLineColor'] = function(i) { return '#aaa'; };
        // Left padding of the cell
        objLayout['paddingLeft'] = function(i) { return 4; };
        // Right padding of the cell
        objLayout['paddingRight'] = function(i) { return 4; };
        // Inject the object in the document
        doc.content[1].layout = objLayout;
    
                doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                doc.defaultStyle.alignment = 'center';
                doc.styles.tableHeader.alignment = 'center';
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },

            {
                extend:    'print',
                text:      '<i class="fa fa-print">&nbsp; Print</i>',
                className: "btn btn-sm  btn-danger",  
                titleAttr: 'Print',
                                                title: 'AdminLT || Clients Data',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5]
                }
            },
            {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'TXT',
       text: '<i class="fa fa-fw fa-file-text-o">&nbsp; TXT</i>',
  action: function (e, dt, node, config) {


        // Trigger the Ultimate Export plugin to export data from the textarea
        doExport('#example2', { type: 'txt' });
    },
  exportOptions: {
          columns: [ 0, 1, 2, 3,4,5],
    }
  },
              {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'sql',
       text: '<i class="fa fa-fw fa-database">&nbsp; SQL</i>',
  action: function (e, dt, node, config) {


        // Trigger the Ultimate Export plugin to export data from the textarea
        doExport('#example2', { type: 'sql' });
    },
  exportOptions: {
        modifier: {
            page: 'all'
        }
    }
  },
              {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'doc',
       text: '<i class="fa fa-fw fa-file-word-o">&nbsp; Docx</i>',
  action: function (e, dt, node, config) {


        // Trigger the Ultimate Export plugin to export data from the textarea
        doExport('#example2', { type: 'doc',mso: {pageOrientation: 'landscape'} });
    },
  exportOptions: {
        modifier: {
            page: 'all'
        }
    }
  },
  {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'PNG',
       text:'<i class="fa fa-fw fa-image">&nbsp; PNG</i>',
  action: function (e, dt, node, config) {


        // Trigger the Ultimate Export plugin to export data from the textarea
        doExport('#example2', { type: 'png'});
    },
  exportOptions: {
        modifier: {
            page: 'all'
        }
    }
  }



        ],
   
      initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[10, 50, 150, -1], [10, 50, 150, "All"]]
      });
 document.querySelectorAll('.toggle-vis').forEach((el) => {
    el.addEventListener('click', function (e) {
        e.preventDefault();
 
        let columnIdx = e.target.getAttribute('data-column');
        let column = table.column(columnIdx);
        
        // Toggle the visibility
        column.visible(!column.visible());
    });
});


    })
  
</script>

<script>
  $(document).ready(function(){
    

    var p_name = '<?php echo $p_name; ?>';
    console.log(p_name);

 var bootstrapColors = [
        '#007bff', // Primary
        '#6c757d', // Secondary
        '#28a745', // Success
        '#dc3545', // Danger
        '#ffc107', // Warning
        '#17a2b8', // Info
        '#343a40', // Dark
        '#e83e8c', // Pink
        '#6610f2', // Purple
        '#fd7e14', // Orange
    ];
        // var formData = $(this).serialize();
         
        //  formData += '&pname=' + encodeURIComponent(p_name);

    //readProducts(); /* it will load products when document loads */
    
     $.ajax({
        url: 'ajax/charts2.php', // Replace with the path to your PHP script
        type: 'GET',
        data: {p_name: p_name},
        dataType: 'json',
        success: function(data) {
            // Access data for each pie chart
            var pie1Data = data.pie1;

              //console.log(pie1Data);
            //var colors = generateRandomColors(pie1Data.length);
              

            Morris.Donut({
                element: 'chart_pie_1',
                data: pie1Data,
                dataLabels: true,
            showPercentage: true,
            colors:bootstrapColors.slice(0, pie1Data.length),

            }).options.colors.forEach(function(color, index) {
              if (pie1Data[index] != undefined) {
              var node = document.createElement('span');
              node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie1Data[index].label+'</span>';
              document.getElementById("chart_pie_1_legend").appendChild(node);
            }
                // Your legend generation logic here
            });

       }

    })

    // Function to generate random colors
    // function generateRandomColors(numColors) {
    //     var colors = [];
    //     for (var i = 0; i < numColors; i++) {
    //         var color = '#'+(Math.random()*0xFFFFFF<<0).toString(16); // Generate random hex color
    //         colors.push(color);
    //     }
    //     return colors;
    // }
  });
  
</script>


</body>
</html>
