<?php
if(!empty($_FILES['picture']['name'])){
    //Include database configuration file
    include_once 'dbConfig2.php';
    
    //File uplaod configuration
    $result = 0;
    $uploadDir = "../dist/img/uploads/";
    $fileName = time().'_'.basename($_FILES['picture']['name']);
    $targetPath = $uploadDir. $fileName;
    
    //Upload file to server
    if(@move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)){
        //Get current user ID from session
        $userId = 1;
        
        //Update picture name in the database
        $update = $db->query("UPDATE admin SET picture = '".$fileName."' WHERE id = $userId");
        
        //Update status
        if($update){
            $result = 1;
        }
    }
    
    //Load JavaScript function to show the upload status
    echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' . $targetPath . '\');</script>  ';
}