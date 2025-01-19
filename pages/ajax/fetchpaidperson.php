<?php 
    //replace connection variables with yours.
    //hope you store Vehicle with names in vehicle_reservation table
  
  
    $conn = mysqli_connect('localhost','root','','loginsystem');
    if(!$conn){
        $response = array('success'=>0,'data'=>'unable to connect with db');
    }else{
        $type = $_GET['para']; 
        //$where = ($type != "All Vehicle")?" WHERE Vehicle='".$type."'":"";
        if($type == 'supplier')
        {
        $sql ='select pcid,pcname from purchasecom';

        }
        else{
            $sql='select cid,c_name from client';
        }

        $query = mysqli_query($conn, $sql); 
       
       $data_points = array();
        if(mysqli_num_rows($query)>0 && $type == 'supplier'){
         while($row = mysqli_fetch_array($query))  
      {  

          $pointz = array($row['pcid'], $row['pcname']);
          //$d= array();
           array_push($data_points, $pointz);      
      }  
       

                //$data = mysqli_fetch_array($query);
                
     }
     if(mysqli_num_rows($query)>0 && $type == 'customer'){
         while($row = mysqli_fetch_array($query))  
      {  

          $pointz = array($row['cid'],$row['c_name']);
        
           array_push($data_points, $pointz);      
      }  
       

                //$data = mysqli_fetch_array($query);
                
     }   
    }
   echo json_encode($data_points, JSON_NUMERIC_CHECK);

?>



  
     
