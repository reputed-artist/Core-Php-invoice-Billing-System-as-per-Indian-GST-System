
<?php

session_start();
include'dbconnection.php';
include("checklogin.php");
include 'inc/getState.php';

 check_login();

$current_page="email";

$current_page="email";

$today=date("d-M");

$cz=mysqli_query($con,"select * from fest where date='$today' ");

//echo "select * from fest where date='$today' ";
$number_of_result = mysqli_num_rows($cz);  

while($row=mysqli_fetch_array($cz))
{
  $fest_name = $row["fest_name"];
  $img = $row["gifs"];
}

?>
<!DOCTYPE html>
<html>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
  
  <?php include_once "links.php"; ?> 

  <script type="text/javascript" src="script/dataTables.export.js"></script>

  <style>
  /*.box
  {
   max-width:600px;
   width:100%;
   margin: 0 auto;;
  }*/
  .btn-default {
    
    color: #f5f0f0;
  }
  .status-label {
    padding: 10px 10px 10px 10px;
    border-radius: 3px;
    display: inline-block;
    min-width: 75px;
    text-align: center;
}

.status-sending {
    background-color: #f0ad4e; /* Bootstrap warning color */
    color: white;
}

.status-success {
    background-color: #5cb85c; /* Bootstrap success color */
    color: white;
}

.status-failed {
    background-color: #d9534f; /* Bootstrap danger color */
    color: white;
}

  </style>
 </head>
 <body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">
 <!-- <div id="loader"></div> -->
<!-- <div id="loader"></div> -->


<div class="wrapper">

  <?php include_once "header.php"; ?>
    
<?php include_once"navbar.php"; ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Manage Bulk Email
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Festival Email</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info" style="overflow: auto;">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;"> Festival Greetings for 
              <?php 
              if($number_of_result == 0) {
                echo "<p style='color:red;'>----------------------No Festival Today </p>";}
              else {
                echo "<p style='color:red';align='center'; >---------------------------------$fest_name <p>";
              }
              

              ?> </h3>

            </div></br></br>
            <!-- /.box-header -->
            <div class="box-body">
   <form id="upload_csv" method="post" enctype="multipart/form-data">
    <div class="col-md-3">
     <br />
     <!-- <label>Add More Data</label> -->
    </div>  
                <div class="form-group col-md-4">  
                   <input type="file" name="csv_file" id="csv_file" accept=".csv" style="margin-top:15px;font-size: 14pt;" />
                </div>  
                <div class="col-md-5">  
                    <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                </div>  
                <div style="clear:both"></div>
   </form>
   <br />
   <br />
   <hr>
   <div class="table-responsive">
    <table class="table table-striped table-bordered" id="data-table">
     <thead>
      <tr>
       <th>ID</th>
       <th>Customer Name</th>
       <th>Email</th>
       <th> <input type="checkbox" id="ckbCheckAll" /> Count </th>
       <th> Action</th>
       <th> Status </th>
      </tr>
     </thead>
     <tbody id="menu_table_data"></tbody>
     <tfoot>
     <tr>
          <td  colspan="4"> </td>
          <td><button type="button" name="bulk_email" class="btn btn-primary email_button" id="bulk_email" data-action="bulk">Send Bulk</button></td></tr>
           <tr>
       <th>ID</th>
       <th>Customer Name</th>
       <th>Email</th>
       <th> Count </th>
       <th> Action</th>
       <th> Status </th>
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

<?php include_once"settings.php";?>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- </section></div></div> -->
<!-- <script>

$(document).ready(function(){

  
// var oTable = $('#data-table').dataTable({
//         stateSave: true,
//         "bDestroy": true
//     });
$("#ckbCheckAll").click(function () {
var oTable = $('#data-table').dataTable();
 //var allPages2 = oTable.rows().nodes();

    var allPages = oTable.fnGetNodes();

    // $('body').on('click', '#ckbCheckAll', function () {
        if ($(this).hasClass('allChecked')) {
            $('input[type="checkbox"]', allPages).prop('checked', false);
            console.log("all page"+allPages);
        } else {
            $('input[type="checkbox"]', allPages).prop('checked', true);
        }
        $(this).toggleClass('allChecked');
    //})
//    $(".single_select").prop('checked', $(this).prop('checked'));
        //$('input[type="checkbox"]').prop('checked', 'checked')
    });



 $('#upload_csv').on('submit', function(event){
  
  console.log("Enter jquery");
  event.preventDefault();
  $.ajax({
   url:"import.php",
   method:"POST",
   data:new FormData(this),
   dataType:'json',
   contentType:false,
   cache:false,
   processData:false,
   success:function(jsonData)
   {

    $('#csv_file').val('');
    var oTable = $('#data-table').DataTable({
       'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'processing' :true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
       data  :  jsonData,
     columns :  [
      { data : "student_id" },
      { data : "student_name" },
      { data : "student_phone" },
      { data: function(data, type, full) {

    return '<input type="checkbox" class="single_select checkBoxClass btn btn-info btn-sm " name="single_select" data-email="' + data.student_phone + '" data-name="'+data.student_name +'" >';
  }},

   { data: function(data, type, full) {
    return '<button type="button" class="btn btn-info btn-xs email_button" name="email_button" value="Send Single" id='+data.student_id +' data-email="' + data.student_phone + '" data-name="'+data.student_name +'" data-action="single" > Send Single</button>';
      
  }},

  { data: null,
    render: function (data, type, row, meta) {
    // return '<td id="+ row.student_id + ">Pending</td>';
    return '<span class="label" id="status_'+data.student_id +'">!! Pending</span>';
    }
},
  // { data: null, render: function ( data, type, row, meta ) {
  //             return '<td id="status_"' + meta.row + '">Pending</td>';
  //           }},

     ],      

   'dom':"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
   
    
       buttons: [
             {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"> Copy </i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
      
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o">&nbsp; Excel</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o">&nbsp; CSV</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'CSV',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o">&nbsp; PDF</i>',
                className: "btn-sm btn btn-danger",  
                orientation: 'landscape',
                pageSize: 'LEGAL',          
                titleAttr: 'PDF',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },     
            {
                extend:    'print',
                text:      '<i class="fa fa-print">&nbsp;Print</i>',
                className: "btn btn-sm  btn-danger",  
                titleAttr: 'Print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },

        ],
   
      initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[100, 50, 150, -1], [100, 50, 150, "All"]]
    
    });


$('.email_button').click(function() {
        console.log("btn click");
        $(this).attr('disabled', 'disabled');

        var id  = $(this).attr("id");
        var action = $(this).data("action");
        var email_data = [];

        var oTable = $('#data-table').dataTable();
        var data = oTable.fnGetData(this);
        //console.log(data);
        console.log(id);
        console.log(action);
        //console.log(email_data);

        if(action == 'single') {
            email_data.push({
                id:$(this).attr("id"),
                email: $(this).data("email"),
                name: $(this).data("name")
            });
            console.log(email_data);
            //console.log(email);
        } else {
            $('.single_select').each(function() {
                if($(this).prop("checked") == true) {
                    email_data.push({
                        id:$(this).data("id"),
                        email: $(this).data("email"),
                        name: $(this).data('name')
                    });
                    //console.log(email,name);
                }
            });
        }



          console.log("Email data:", email_data);

          // Add a status column to each row if not already present
        email_data.forEach(function(item, index) {
            var elementId = 'status_' + item.id;

            // Add the status column if it doesn't exist
            if ($('#' + elementId).length === 0) {
                var row = $('#data-table tbody tr').filter(function() {
                    return $(this).find('button[id="' + item.id + '"]').length > 0;
                });
                if (row.length > 0) {
                    row.append('<td><span id="' + elementId + '" class="label label-default">Pending</span></td>');
                }
            }
        });



           email_data.forEach(function(item, index) {
            var elementId = 'status_' +item.id;

            console.log(elementId);


            $.ajax({
                url: "send_mail.php",
                method: "POST",
                data: { email_data: item.email, name: item.name },
                beforeSend: function() {
                    $('#' + elementId).html('Sending...');
                    $('#' + elementId).addClass('btn-danger');
                },
                success: function(data) {
                    console.log('Raw data:', data); // Debugging line
                    data = $.trim(data);
                    console.log('Trimmed data:', data); // Debugging line
                    if (data === "ok") {
                                    $('#' + elementId).html('&#10003; Success'); // Unicode tick character
                                    $('#' + elementId).removeClass('label status-sending');
                                    $('#' + elementId).addClass('label status-success');
                                } else {
                                    $('#' + elementId).html(data);
                                    $('#' + elementId).removeClass('label status-sending');
                                    $('#' + elementId).addClass('label status-failed');
                                }
                                $('#' + elementId).attr('disabled', false);
                            },
                            error: function(xhr, status, error) {
                                $('#' + elementId).html('Failed');
                                $('#' + elementId).addClass('status-failed');
                                $('#' + elementId).attr('disabled', false);
                            }
                
            });
        });

        // Re-enable the button after all requests are sent
        $(this).attr('disabled', false);
    });


   }
  });
});


 

});

</script> -->
<!-- <script>
$(document).ready(function() {
  $("#ckbCheckAll").click(function () {
var oTable = $('#data-table').dataTable();
 var allPages = oTable.rows().nodes();

    //var allPages = oTable.fnGetNodes();

    // $('body').on('click', '#ckbCheckAll', function () {
        if ($(this).hasClass('allChecked')) {
            $('input[type="checkbox"]', allPages).prop('checked', false);
            console.log("all page"+allPages);
        } else {
            $('input[type="checkbox"]', allPages).prop('checked', true);
        }
        $(this).toggleClass('allChecked');
    //})
//    $(".single_select").prop('checked', $(this).prop('checked'));
        //$('input[type="checkbox"]').prop('checked', 'checked')
    });

    // Handle button click
    $('.email_button').click(function() {
       console.log("Button clicked");
        $(this).attr('disabled', 'disabled');

        var action = $(this).data("action");
        console.log(action);
        var email_data = [];

        // Collect email data based on action (single or bulk)
        if (action == 'single') {
            email_data.push({
                id: $(this).attr("id"),
                email: $(this).data("email"),
                name: $(this).data("name")
            });

          

            var elementId = 'status_' + item.id;

            // Add the status column if it doesn't exist
            if ($('#' + elementId).length === 0) {
                var row = $('#data-table tbody tr').filter(function() {
                    return $(this).find('button[id="' + item.id + '"]').length > 0;
                });
                if (row.length > 0) {
                    row.append('<td><span id="' + elementId + '" class="label label-default">Pending</span></td>');
                }
            }
        

            var elementId = 'status_' + item.id;

            $.ajax({
                url: "send_mail.php",
                method: "POST",
                data: { email_data: item.email, name: item.name },
                beforeSend: function() {
                    $('#' + elementId).html('Sending...');
                    $('#' + elementId).removeClass('label-default').addClass('label-warning');
                },
                success: function(data) {
                    console.log('Raw data:', data);
                    data = $.trim(data);
                    console.log('Trimmed data:', data);

                    if (data === "ok") {
                        $('#' + elementId).html('&#10003; Success');
                        $('#' + elementId).removeClass('label-default').addClass('label-success');
                    } else {
                        $('#' + elementId).html(data);
                        $('#' + elementId).removeClass('label-warning').addClass('label-danger');
                    }
                },
                error: function(xhr, status, error) {
                    $('#' + elementId).html('Failed');
                    $('#' + elementId).removeClass('label-warning').addClass('label-danger');
                }
            });

        } else {
            $('.single_select').each(function() {
                if ($(this).prop("checked") == true) {
                    email_data.push({
                        id: $(this).data("id"),
                        email: $(this).data("email"),
                        name: $(this).data("name")
                    });
                }
            

        // Ensure all IDs are captured
        console.log("Email data:", email_data);

        // Add a status column to each row if not already present
        email_data.forEach(function(item, index) {
            var elementId = 'status_' + item.id;

            // Add the status column if it doesn't exist
            if ($('#' + elementId).length === 0) {
                var row = $('#data-table tbody tr').filter(function() {
                    return $(this).find('button[id="' + item.id + '"]').length > 0;
                });
                if (row.length > 0) {
                    row.append('<td><span id="' + elementId + '" class="label label-default">Pending</span></td>');
                }
            }
        });

        // Send AJAX requests for each email
        email_data.forEach(function(item) {
            var elementId = 'status_' + item.id;

            $.ajax({
                url: "send_mail.php",
                method: "POST",
                data: { email_data: item.email, name: item.name },
                beforeSend: function() {
                    $('#' + elementId).html('Sending...');
                    $('#' + elementId).removeClass('label-default').addClass('label-warning');
                },
                success: function(data) {
                    console.log('Raw data:', data);
                    data = $.trim(data);
                    console.log('Trimmed data:', data);

                    if (data === "ok") {
                        $('#' + elementId).html('&#10003; Success');
                        $('#' + elementId).removeClass('label-default').addClass('label-success');
                    } else {
                        $('#' + elementId).html(data);
                        $('#' + elementId).removeClass('label-warning').addClass('label-danger');
                    }
                },
                error: function(xhr, status, error) {
                    $('#' + elementId).html('Failed');
                    $('#' + elementId).removeClass('label-warning').addClass('label-danger');
                }
            });
        });

        // Re-enable the button after all requests are sent
        $(this).attr('disabled', false);
    });
  }
});
    // Handle CSV upload
    $('#upload_csv').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "import.php",
            method: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(jsonData) {
                $('#csv_file').val('');
                $('#data-table').DataTable({
                    data: jsonData,
                    columns: [
                        { data: "student_id" },
                        { data: "student_name" },
                        { data: "student_phone" },
                        { data: function(data) {
                            return '<input type="checkbox" class="single_select checkBoxClass btn btn-info btn-sm" name="single_select" data-id="' + data.student_id + '" data-email="' + data.student_phone + '" data-name="' + data.student_name + '" >';
                        }},
                        { data: function(data) {
                            return '<input type="button" class="btn btn-info btn-xs email_button" name="email_button" value="Send Single" id="' + data.student_id + '" data-email="' + data.student_phone + '" data-name="' + data.student_name + '" data-action="single">';
                        }},
                        { data: function(data) {
                            return '<span id="status_'+ data.student_id + '"class="label label-default">Pending</span>';
                        }}
                    ],
                    'paging': true,
                    'lengthChange': true,
                    'searching': true,
                    'processing': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false,
                    "dom": "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
  "buttons": [
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
          }

        ],
                    'initComplete': function () {
                        var btns = $('.dt-button');
                        btns.addClass('btn btn-primary btn-sm btn-group');
                        btns.removeClass('dt-button');
                    },
                    'lengthMenu': [[100, 50, 150, -1], [100, 50, 150, "All"]]
                });
            }
        });
    });
});

</script> -->

<script>
  $(document).ready(function() {
            console.log("Document is ready"); // Debug line

            // Check All functionality
            $("#ckbCheckAll").click(function () {
                var oTable = $('#data-table').DataTable();
                //var allPages = oTable.fnGetNodes();
                var allPages = oTable.rows().nodes();

                if ($(this).hasClass('allChecked')) {
                    $('input[type="checkbox"]', allPages).prop('checked', false);
                } else {
                    $('input[type="checkbox"]', allPages).prop('checked', true);
                }
                $(this).toggleClass('allChecked');
            });

            // Handle email button click
            $(document).on('click', '.email_button', function() {
                console.log("Button clicked"); // Debug line

                var action = $(this).data("action");
                var email_data = [];

                if (action == 'single') {
                    var item = {
                        id: $(this).attr("id"),
                        email: $(this).data("email"),
                        name: $(this).data("name")
                    };
                    email_data.push(item);

                    var elementId = 'status_' + item.id;

                    $.ajax({
                        url: "send_mail.php",
                        method: "POST",
                        data: { email_data: item.email, name: item.name },
                        beforeSend: function() {
                            $('#' + elementId).html('Sending...');
                            $('#' + elementId).removeClass('label-default').addClass('label-warning');
                        },
                        success: function(data) {
                            handleAjaxSuccess(data, elementId);
                        },
                        error: function() {
                            handleAjaxError(elementId);
                        }
                    });
                } else {
                    $('.single_select:checked').each(function() {
                        email_data.push({
                            id: $(this).data("id"),
                            email: $(this).data("email"),
                            name: $(this).data("name")
                        });
                    });

                    email_data.forEach(function(item) {
                        var elementId = 'status_' + item.id;

                        if ($('#' + elementId).length === 0) {
                            var row = $('#data-table tbody tr').filter(function() {
                                return $(this).find('button[id="' + item.id + '"]').length > 0;
                            });
                            if (row.length > 0) {
                                row.append('<td><span id="' + elementId + '" class="label label-default">Pending</span></td>');
                            }
                        }
                    });

                    email_data.forEach(function(item) {
                        var elementId = 'status_' + item.id;

                        $.ajax({
                            url: "send_mail.php",
                            method: "POST",
                            data: { email_data: item.email, name: item.name },
                            beforeSend: function() {
                                $('#' + elementId).html('Sending...');
                                $('#' + elementId).removeClass('label-default').addClass('label-warning');
                            },
                            success: function(data) {
                                handleAjaxSuccess(data, elementId);
                            },
                            error: function() {
                                handleAjaxError(elementId);
                            }
                        });
                    });
                }
            });

            // Handle CSV upload
            $('#upload_csv').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "import.php",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(jsonData) {
                        $('#csv_file').val('');
                        $('#data-table').DataTable({
                            data: jsonData,
                            columns: [
                                { data: "student_id" },
                                { data: "student_name" },
                                { data: "student_phone" },
                                {
                                    data: function(data) {
                                        return '<input type="checkbox" class="single_select checkBoxClass btn btn-info btn-sm" name="single_select" data-id="' + data.student_id + '" data-email="' + data.student_phone + '" data-name="' + data.student_name + '">';
                                    }
                                },
                                {
                                    data: function(data) {
                                        return '<input type="button" class="btn btn-info btn-xs email_button" name="email_button" value="Send Single" id="' + data.student_id + '" data-email="' + data.student_phone + '" data-name="' + data.student_name + '" data-action="single">';
                                    }
                                },
                                {
                                    data: function(data) {
                                        return '<span id="status_'+ data.student_id + '" class="label label-default">Pending</span>';
                                    }
                                }
                            ],
                            paging: true,
                            lengthChange: true,
                            searching: true,
                            processing: true,
                            ordering: true,
                            info: true,
                            autoWidth: false,
                            "dom": "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
                            buttons: getTableButtons(),
                            initComplete: function () {
                                var btns = $('.dt-button');
                                btns.addClass('btn btn-primary btn-sm btn-group');
                                btns.removeClass('dt-button');
                            },
                            lengthMenu: [[100, 50, 150, -1], [100, 50, 150, "All"]]
                        });
                    }
                });
            });
        });

        function handleAjaxSuccess(data, elementId) {
            data = $.trim(data);

            if (data === "ok") {
                $('#' + elementId).html('&#10003; Success');
                $('#' + elementId).removeClass('label-default').addClass('label-success');
            } else {
                $('#' + elementId).html(data);
                $('#' + elementId).removeClass('label-warning').addClass('label-danger');
            }
        }

        function handleAjaxError(elementId) {
            $('#' + elementId).html('Failed');
            $('#' + elementId).removeClass('label-warning').addClass('label-danger');
        }

        function getTableButtons() {
            return [
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
          }
            ];
        }
</script>
</body></html>
