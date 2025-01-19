<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
check_login();

include 'inc/getState.php';

$current_page="manage-qlist";
//$current_page1="manage-qlist";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Advanced form elements</title>
  <?php include_once"links.php"; ?>

 

</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">
<div id="loader"></div>
<div class="wrapper">

  <?php include_once"header.php"; ?>

    
<?php include_once"navbar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quotation List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quotation List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;"> Quotation Search </h3>
            </div>
          </br>
<?php include_once"inv-list-filter.php"; ?>

            </br>
            </br>

                      </div>
              </div>
        </div>



      <div class="row">
                    
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
                            
          
      <?php 

    
               if (date('m') > 3) {
                  $year = date('Y')."-".(date('Y') +1);
              }
              else {
                  $year = (date('Y')-1)."-".date('Y');
              }
              //echo $year; // 2015-2016


              $startyear = substr($year, 0,4);

              //echo "\n<br>".$startyear;


              $endyear=substr($year,5,8);

              //echo "<br>".$endyear;

              $results_per_page = 20;  



        if(isset($_GET['submit']))
        {
          if($_GET['client'] != null){
              $val=$_GET['client'];

              $gval=mysqli_query($con,"select cid from client where c_name='$val'");

              $cs=mysqli_fetch_array($gval);
                          
              $ds=$cs[0];    

                        $query="SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where client.cid='$ds' order by invid desc";

                         $result = mysqli_query($con, $query);  
                    $number_of_result = mysqli_num_rows($result);  
                  
                    //determine the total number of pages available  
                    $number_of_page = ceil ($number_of_result / $results_per_page);  
                  
                    //determine which page number visitor is currently on  
                    if (!isset ($_GET['page']) ) {  
                        $page = 1;  
                    } else {  
                        $page = $_GET['page'];  
                    }  
                  
                    //determine the sql LIMIT starting number for the results on the displaying page  
                    $page_first_result = ($page-1) * $results_per_page;    
  

                          $ret2 = mysqli_query($con,"SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where client.cid='$ds' order by invid desc LIMIT " . $page_first_result . ',' . $results_per_page."")or die("Error: " . mysqli_error($con));
                        

                          

                        }


             
             else if(isset($_GET['year']))
             {
              if($_GET['year'] != null)
              {

              $year=$_GET['year'];
              $startyear = substr($year, 0,4);
              $endyear=substr($year,5,8);


              $query="SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where quote2.created between '$startyear-04-01' and '$endyear-03-31' order by invid desc ";

                 $result = mysqli_query($con, $query);  
                  $number_of_result = mysqli_num_rows($result);  
                
                  //determine the total number of pages available  
                  $number_of_page = ceil ($number_of_result / $results_per_page);  
                
                  //determine which page number visitor is currently on  
                  if (!isset ($_GET['page']) ) {  
                      $page = 1;  
                  } else {  
                      $page = $_GET['page'];  
                  }  
                
                  //determine the sql LIMIT starting number for the results on the displaying page  
                  $page_first_result = ($page-1) * $results_per_page;    
  


              $ret2 = mysqli_query($con,"SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where quote2.created between '$startyear-04-01' and '$endyear-03-31' order by invid desc LIMIT " . $page_first_result . ',' . $results_per_page."")or die("Error: " . mysqli_error($con));  


         

            }
             }

             elseif (($_GET['client'] != "") && ($_GET['year'] != "")) {


               $val=$_GET['client'];

              $gval=mysqli_query($con,"select cid from client where c_name='$val'");

              $cs=mysqli_fetch_array($gval);
                          
              $ds=$cs[0];   

               $year=$_GET['year'];
              $startyear = substr($year, 0,4);
              $endyear=substr($year,5,8);

 

              $query="SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where client.c_name= '$ds' and quote2.created between '$startyear-04-01' and '$endyear-03-31' order by invid desc";

               $result = mysqli_query($con, $query);  
                $number_of_result = mysqli_num_rows($result);  
              
                //determine the total number of pages available  
                $number_of_page = ceil ($number_of_result / $results_per_page);  
              
                //determine which page number visitor is currently on  
                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                }  
              
                //determine the sql LIMIT starting number for the results on the displaying page  
                $page_first_result = ($page-1) * $results_per_page;    
              
              
              $ret2=mysqli_query($con,"SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where client.c_name= '$ds' and quote2.created between '$startyear-04-01' and '$endyear-03-31' order by invid desc LIMIT " . $page_first_result . ',' . $results_per_page."")or die("Error: " . mysqli_error($con)); 
               
               
            
              }
          }

                          else
                          {

                             //find the total number of results stored in the database  

                              $query = "SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where quote2.created between '$startyear-04-01' and '$endyear-03-31' order by invid desc";  

                               $result = mysqli_query($con, $query);  
                                $number_of_result = mysqli_num_rows($result);  
                              
                              
                                $number_of_page = ceil ($number_of_result / $results_per_page);  
                              
                                
                                if (!isset ($_GET['page']) ) {  
                                    $page = 1;  
                                } else {  
                                    $page = $_GET['page'];  
                                }  
                              
                                  
                                $page_first_result = ($page-1) * $results_per_page;    
  

                            $ret2=mysqli_query($con,"SELECT quote2.invid,client.c_name,substring_index(c_add, ',', -1) as location, quote2.totalamount, quote2.created FROM `quote2` INNER join client on quote2.cid=client.cid where quote2.created between '$startyear-04-01' and '$endyear-03-31' order by invid desc  LIMIT " . $page_first_result . ',' . $results_per_page."");
    
                         

                          }

 
    //find the total number of results stored in the database  
   
   

                        
                          if(mysqli_num_rows($ret2)==0)
                                             {?>
                                              <div align="center">
                                              <font color='red' align='center'>No Records Found </font>       </div>                                       
                                           <?php  }                  


              


                          $cnt=1;
                          $x=1;
                while($row=mysqli_fetch_array($ret2))
                {?>

                              <?php 
                              if($x % 3 == 0) echo "<tr>";
                                 $x++;  ?>
                                  <a href="a4.php?did=<?php echo $row['invid']; ?>" target="_blank">
                                  <div class="col-md-4" id="example1">
                                    <div class="box box-info">
                                            
                                            <div class="box-header">
                                               <h3 class="box-title"><?php $id = $row['invid'];
                                      echo $id;?>  </h3> </div>

                                      <div class="box-body">
                                          <div class="form-group">
                                      <strong><p align="center" style="color:black;"><?php echo $row['c_name']; ?></p></strong>
                                      <p align="center"><strong>Location:</strong> <?php echo $row['location'];?>  </p>
                                      <p align="center"><strong> Total Bill:</strong> <?php echo $row['totalamount'];?></p>
                                      <p align="center"><strong> Created: </strong>
                                        <?php 
                                      
                                        $c=date("d-M-Y",strtotime($row['created']));
                                        echo $c;
                                         ?></p> </a>
                                       </br>
                                        <a href="edit-q.php?invid=<?php echo $row['invid'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                            
                                    <a class="btn btn-danger btn-xs pull-right" id="delete_product" data-id="<?php echo $id; ?>" ><i class="fa fa-trash-o "></i></a>
                                  </div> 
                                </div>

                              </div></div> 
                              <?php $cnt=$cnt+1; }?>
             
                            </table>
                           
                   


<?php
 if(mysqli_num_rows($ret2)!= 0  && isset($_GET['year']))
                               {  ?>              
                            
                            <div class="page" style="text-align: center;">
                            <nav aria-label="Page navigation example">
                              <ul class="pagination pagination-lg justify-content-end">
                                  <!-- <li class="page-item disabled">
                                    <a class="page-link" href="#"  tabindex="-1">Previous</a>
                                  </li> -->
                                  <?php                   
                                  $curr_page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                    if($curr_page == 1)
                                  { ?>

                                  <li class="page-item disabled">
                                    <a class="page-link" href="#"  tabindex="-1">Previous</a>
                                  </li>

                                  <?php }  
                                  else {   
                                  echo  '<li class="page-item">
                                    <a class="page-link" href="q-list.php?client=&year='.$startyear.'-'.$endyear.'&product=&submit=Submit&page='.($curr_page-1).'">Previous</a>
                                  </li>';
                                }


                                          

                                  for($page = 1; $page<= $number_of_page; $page++) {  
                                          if($curr_page == $page)
                                          {

                                            echo '<li class="page-item active"> <a class="page-link" href = "q-list.php?client=&year='.$startyear.'-'.$endyear.'&product=&submit=Submit&page=' . $page . '">' . $page . '</a></li>';
                                          }
                                            
                                          else{
                                      echo '<li class="page-item"> <a class="page-link" href = "q-list.php?client=&year='.$startyear.'-'.$endyear.'&product=&submit=Submit&page=' . $page . '">' . $page. '</a></li>';  
                                    }
                                  }  
                              
                            if($number_of_page == $curr_page)
                            {
                                 echo  '<li class="page-item disabled">
                                    <a class="page-link" href="q-list.php?client=&year='.$startyear.'-'.$endyear.'&product=&submit=Submit&page='.($curr_page+1).'">Next</a>
                                  </li>';
                            }      
                           else
                           {


                            echo  '<li class="page-item">
                                    <a class="page-link" href="q-list.php?client=&year='.$startyear.'-'.$endyear.'&product=&submit=Submit&page='.($curr_page+1).'">Next</a>
                                  </li>';
                           }

                                    ?>


                                </ul>
                              </nav> </div>
                    
                     <?php         } 
                             
                     else if(isset($_GET['client']) && ($_GET['year'] != "")){
                      
                      ?>
                      <div class="page" style="text-align: center;">
                            <nav aria-label="Page navigation example">
                              <ul class="pagination pagination-lg justify-content-end">
                                  <!-- <li class="page-item disabled">
                                    <a class="page-link" href="#"  tabindex="-1">Previous</a>
                                  </li> -->
                                  <?php                   
                                  $curr_page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                    if($curr_page == 1)
                                  { ?>

                                  <li class="page-item disabled">
                                    <a class="page-link" href="#"  tabindex="-1">Previous</a>
                                  </li>

                                  <?php }  
                                  else {   
                                  echo  '<li class="page-item">
                                    <a class="page-link" href="q-list.php?page='.($curr_page-1).'">Previous</a>
                                  </li>';
                                }


                                          

                                  for($page = 1; $page<= $number_of_page; $page++) {  
                                          if($curr_page == $page)
                                          {

                                            echo '<li class="page-item active"> <a class="page-link" href = "q-list.php?page=' . $page . '">' . $page . '</a></li>';
                                          }
                                            
                                          else{
                                      echo '<li class="page-item"> <a class="page-link" href = "q-list.php?page=' . $page . '">' . $page . '</a></li>';  
                                    }
                                  }  
                              
                            if($number_of_page == $curr_page)
                            {
                                 echo  '<li class="page-item disabled">
                                    <a class="page-link" href="q-list.php?page='.($curr_page+1).'">Next</a>
                                  </li>';
                            }      
                           else
                           {


                            echo  '<li class="page-item">
                                    <a class="page-link" href="q-list.php?page='.($curr_page+1).'">Next</a>
                                  </li>';
                           }

                              
                           ?>
                             </ul>
                              </nav> </div>


                  <?php   }

                        else
                               {

                             ?>

                            <div class="page" style="text-align: center;">
                            <nav aria-label="Page navigation example">
                              <ul class="pagination pagination-lg justify-content-end">
                                  <!-- <li class="page-item disabled">
                                    <a class="page-link" href="#"  tabindex="-1">Previous</a>
                                  </li> -->
                                  <?php                   
                                  $curr_page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                                    if($curr_page == 1)
                                  { ?>

                                  <li class="page-item disabled">
                                    <a class="page-link" href="#"  tabindex="-1">Previous</a>
                                  </li>

                                  <?php }  
                                  else {   
                                  echo  '<li class="page-item">
                                    <a class="page-link" href="q-list.php?page='.($curr_page-1).'">Previous</a>
                                  </li>';
                                }


                                          

                                  for($page = 1; $page<= $number_of_page; $page++) {  
                                          if($curr_page == $page)
                                          {

                                            echo '<li class="page-item active"> <a class="page-link" href = "q-list.php?page=' . $page . '">' . $page . '</a></li>';
                                          }
                                            
                                          else{
                                      echo '<li class="page-item"> <a class="page-link" href = "q-list.php?page=' . $page . '">' . $page . '</a></li>';  
                                    }
                                  }  
                              
                            if($number_of_page == $curr_page)
                            {
                                 echo  '<li class="page-item disabled">
                                    <a class="page-link" href="q-list.php?page='.($curr_page+1).'">Next</a>
                                  </li>';
                            }      
                           else
                           {


                            echo  '<li class="page-item">
                                    <a class="page-link" href="q-list.php?page='.($curr_page+1).'">Next</a>
                                  </li>';
                           }

                              
                           ?>
                             </ul>
                              </nav> </div>

                              <?php     }?>
                           


                              
                            </div></div>
                        
                        
                     
  </div>
</div>  
</section>

<?php include_once"footer.php";?>

<?php include_once"settings.php";?>     



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Person or Company",
    allowClear: true
    });

  });

  
</script>
<script>
  $(document).ready(function(){
    
    //readProducts(); /* it will load products when document loads */
    
    $(document).on('click', '#delete_product', function(e){
      
      var productId = $(this).data('id');
      swal.fire({
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

             
           $.ajax({
            url: 'ajax/delete-q.php',
            type: 'GET',
              data: 'delete='+productId,
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
            window.location.href = 'q-list.php';
         }, 3000);
    //$('#load-products').load('manage-clients.php'); 
  }
  
</script>
</body>
</html>
