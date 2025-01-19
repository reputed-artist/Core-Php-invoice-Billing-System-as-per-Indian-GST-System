<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
include 'inc/getState.php';

 check_login();

$current_page="manage-paidhistory";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>


 <?php include_once "links.php"; ?>
 <link rel="stylesheet" href="script/daterangepicker/daterangepicker-bs3.css">

<script type="text/javascript" src="script/dataTables.export.js"></script> 

    <script src="script/daterangepicker/moment.min.js"></script>
    <script src="script/daterangepicker/daterangepicker.js"></script>

<!-- <script type="text/javascript" src="/script/script.js"></script> -->
<style type="text/css">
  .cancelBtn {
      background-color:#dc3545;
  }

  select {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    width: 100%;
    border: 1px solid #ccc;
    height: 34px;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">


<!-- <div id="loader"></div>
 -->

<div class="wrapper">

  <?php include_once "header.php"; ?>
    
<?php include_once"navbar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Sale Report
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Sale Report</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info" style="overflow: auto;">
            <div class="box-header">
              <!-- <h3 class="box-title" style="padding-top: 10px;"> All Client Details</h3> -->
            </div>

<?php 
$cv=mysqli_query($con,"select cid,c_name from client");

$cv2=mysqli_query($con,"select pcid,pcname from purchasecom");
?>

    <form name="form" id="form" method="GET" action="">
    <div class="box-body report_header_form">
                  <!-- Date range -->
           <div class="row">  
            <div class="col-md-3">
              <div class="form-group">
                  <label>Select Customers:</label>                    
                    
                      <select name="customer"  id="customer" class="form-control select2" style="height: 35px !important;width:100% !important;">
                         <option value=""></option>
                         <?php 
                          while($row=mysqli_fetch_array($cv))
                            { ?>
                          <option value="<?php echo $row['c_name']; ?>"><?php echo $row['c_name']; ?></option>
                         <?php   } ?> 

                                                      
                        </select>
                  <!-- /.input group -->                  
               </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                  <label>Select Supplier:</label>                    
                    
                      <select name="supplier" id="supplier" class="form-control select23" style="height: 35px !important;width:100% !important;" >
                          <option value=""></option>
                        <?php 
                          while($row2=mysqli_fetch_array($cv2))
                            { ?>
                          <option value="<?php echo $row2['pcname']; ?>"><?php echo $row2['pcname']; ?></option>
                         <?php   } ?>                             
                        </select>
                   <!-- /.input group -->                  
               </div>
            </div>         

            <div class="col-md-2">
              <div class="form-group">
                  <label>Select Type:</label>                    
                    
                      <select name="ctype" id="ctype" class="form-control select234" style="height: 35px !important;width:100% !important;" >
                          <option value=""></option>
                          <option value="1"> Supplier </option>
                          <option value="2"> Customer</option>                           
                        </select>
                      
               </div>
            </div> 

             <div class="col-md-2">
               <div class="form-group">
                  <label>Date range:</label>                    
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
            <input type="text" class="form-control pull-left" id="daterange-btn" name="date_range">
                    </div><!-- /.input group -->                  
               </div><!-- /.form group -->
             </div>

             <div class="col-md-2">
              <div class="form-group">
                <label>&nbsp;</label>
              <input type="submit" name="dat_range" id="searchBtn" value="Search" class="btn btn-primary" style="margin-top:25px;" >
                </div>
             </div>
           </div><!-- /.row -->
     </div> <!-- box body--> 
     </form>
    
      
            <div class="row">
              <div class="col-md-12">
                <div class="box box-success">
                  <div class="box-header" style="text-align:center">
                  </br>
                      <h3 class="box-title" id="item"></h3>
                      </br>
                      
                      <h4 id="date"> </h4>
                      </br>
                        <div id="hide">
                        <h3 class="box-title" id="company"></h3></br>
                        
                      <!--   <h3 class="box-title" id="stn"> STN:<?php echo $config->s_t_r_no; ?></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3 class="box-title" id="ntn">NTN:<?php echo $config->ntn_no; ?></h3> -->
                      </div>
                    </div>
                    <h3>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ' '." CodeTech Engineers";?></h3>
               <section class="content">
                  <div class="row">
                 <div class="col-xs-12">
                      <div class="box">
                        <div class="box-body">                                                 
                             
                               <table id="example" class="table table-bordered table-striped">

                                      <button type="button" id="btnplus" class="btn btn-success btn-sm pull-right" style="margin: 20px 70px 2px 2px;" onclick="window.location.href = 'add-payhis.php'";><span class="glyphicon glyphicon-plus"></span></button></br></br>
                                      <hr>

                                        <thead>
                                        <tr>
                                            <th>Sr. no.</th>
                                            <th class="hidden-phone">Per/Com</th>
                                            <th> Location </th>
                                            <th> Date of Payment
                                            <th> Type_Cs </th> 
                                            <th> Purpose</th>

                                            <th> Mode Of Payment</th>
                                            <th> Amount </th>
                                            <th>Created</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>

                                     <tbody>                                                                     
                  
                                     
                                         </tbody>
                                         <tfoot>
                                      <tr>
                                            <td> </td>
                                            <td>&nbsp;</td>
                                            <td><h3>Total </h3></td>
                                            <td></td>
                                            <td>&nbsp;</td>
                                                                              
                                            <td></td>
                                            <td></td>
                                            <td><h3 id="totalamt">0</h3></td>
                                            <td></td>
                                            <td></td>
                                            
                                            <td></td>
                                            
                                    </tr>
                                        </tfoot>
                                 </table> 
                                
                             </div>
                         </div>
                          <div  class="btn-group" data-toggle="buttons" role="group">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="0" value="Sr. No.">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="1" value="Per/Com">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="2" value="Location">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="3" value="dateofpayment">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="4" value="type_cs">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="5" value="purpose">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="6" value="modeofpayment">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="7" value="amount">
                                  <input type="button" class="toggle-vis btn btn-primary" data-column="8" value="created">
                                  
                                  </br>

                                </div>  
                         </div>
                       </div>
                    </section>
                </div>
           </div>
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <hr>
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

<script>
 
    var totalAmount=0;
    var table = $('#example').DataTable({
        'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'processing' :true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'footer': true,

   // 'dom':"<'row'<'col-sm-1'l><'col-sm-9 text-center'B><'col-sm-2'f>>" +
  //     "<'row'<'col-sm-12'tr>>" +
  //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
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
          },

        ],
            "ajax": "ajax/transection-data.php",
                        "dataType": 'json',
           "columns": [
                  { 'data': 'serial_number' }, 
            { 'data': 'c_name' },
            { 'data': 'location' },
             {
                'data': 'dateofpayment',
                render: function(data, type, row, meta) {
                    var parts = data.split('-');
                    var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
                    return formattedDate;
                }
            },// Add the 'id' column
             {
                'data': 'type_cs',
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        return '<span class="label label-success">' + "Supplier" + '</span>';
                    } else {
                        return '<span class="label label-warning">' + "Customer" + '</span>';
                    }
                }
            }, // Corrected the order based on your PHP code
            
            { 'data': 'purpose' },
            
            
             // Corrected the order based on your PHP code
           
            
            
            { 'data': 'mode' },
           { 'data': 'amount',
           render: function(data, type, row, meta) {
                    totalAmount += parseFloat(data); // Increment totalAmount
                    $('#totalamt').text(totalAmount + ".00");
                    return data;
                }
             },
            { 'data': 'created' },
             {'data':'editaction',

            render: function (data, type, row, meta) {
              var cidValue = row.pay_id;


      return '<a href="update-pay.php?payid=' + cidValue + '"><button class="btn btn-primary btn-xs" style="width:30px;height:25px"><i class="fa fa-pencil"></i></button></a>';
    }},
    {
      'data':'deleteaction',
      render: function (data, type, row, meta) {
              var cidValue = row.pay_id;


      return '<a class="btn btn-danger btn-xs" id="delete_product" style="width:30px;height:25px" data-id=' + cidValue + '"><i class="fa fa-trash-o "></i></a>';
    }}
    ],
    "initComplete": function() {
        console.log("DataTable initialized successfully!");
    },
    "error": function(xhr, error, thrown) {
        console.log("DataTable error:", error);
        console.log("XHR object:", xhr);
    }
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


    $('#daterange-btn').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),

    });

    $('#form').on('submit', function(event) {
        event.preventDefault();

        var startDate = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
        
        var endDate = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
        //$('#date').text(startDate+ " to " +endDate );

        var supplier=$('#supplier').val();
        //$('#item').text("Supply Of : "+item_name);
        var customer=$('#customer').val();
        var ctype=$('#ctype').val();
       // console.log(ctype);
        //console.log(customer);
        //console.log(supplier);

        if(ctype == 1)
        {
          $('#item').text("Supplier");
        }
        else
        {
          $('#item').text("Customer");
        }

        //$('#company').text(customer);

        $.ajax({
            url: 'ajax/transection-data.php',
            method: 'GET',
            data: { startDate: startDate, endDate: endDate,customer: customer, supplier: supplier, ctype:ctype},
            dataType: 'json',
            contentType: false,
            success: function(response) {
                console.log(response);
                //console.log(response.taxamt);
                //console.log(response.totalamount);

                table.clear();

                $('#date').text("Date Range: "+startDate +" To "+endDate);
                if (response && response.aaData && Array.isArray(response.aaData)) {
                    response.aaData.forEach(function(row) {
                        table.row.add(row);
                    });
                } else {
                    console.error("Invalid response format:", response);
                }
                table.draw();

                // $('#subtotal').text(response.subtotal + ".00");
                // $('#taxamt').text(response.taxamt + ".00");
                $('#totalamt').text(response.totalamount + ".00");
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('.select2').select2({ placeholder: "Select a Client", allowClear: true });
    $('.select23').select2({ placeholder: "Select Item", allowClear: true });
    $('.select234').select2({ placeholder: "Select Type", allowClear: true });

</script>


<script type="text/javascript">
  $('.btn-primary').on("click",function(){

        //$(".btn-primary").not(this).removeClass('active');
        if($(this).hasClass('active')){
            //$('.Resume-click-open').css({'height' : '100px'});
            $(this).removeClass('active');
            $(this).removeClass('btn-danger');
            //$(this).addClass("btn-primary");
        }else{
            $(this).addClass('active');
            $(this).addClass("btn-danger");
        }


    //$(".btn-success").removeClass('btn-danger');
    
});

</script>
 
<script>
   $(document).ready(function(){
    
    //readProducts(); /* it will load products when document loads */
    
    $(document).on('click', '#delete_product', function(e){
      
      var productId = $(this).data('id');
      
   Swal.fire({
  title: 'Are you sure?',
  text: "It will be deleted permanently!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  // Remove the showLoaderOnConfirm option
  // showLoaderOnConfirm: true,
  allowOutsideClick: false        
}).then((result) => {
  if (result.isConfirmed) {
    // Perform the deletion operation using AJAX
    $.ajax({
      url: 'ajax/delete payhis.php',
      type: 'POST',
      data: { delete: parseInt(productId) },
      dataType: 'json'
    })
    .done(function(response){
      // Display success message using Swal.fire
       Swal.fire({
        title: 'Deleted!',
        text: response.message,
        icon: response.status,
        showConfirmButton: false
      });
      // Refresh the product list or perform other actions as needed
      readProducts();
    })
    .fail(function(){
      // Display error message using Swal.fire
      Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
    });
  }
});
      e.preventDefault();
      console.log(parseInt(productId));
    });
    
  });
  

  function readProducts(){
    setTimeout(function(){
            window.location.href = 'paid-his.php';
         }, 3000);
    //$('#load-products').load('manage-clients.php'); 
  }
  
</script>

</body>
</html>
