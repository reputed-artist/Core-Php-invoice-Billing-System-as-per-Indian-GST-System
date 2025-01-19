<?php
if(!empty($_FILES['picturelogo']['name'])){
    //Include database configuration file
    include_once 'dbConfig2.php';
    
    //File uplaod configuration
    $result = 0;
    $uploadDir = "../dist/img/uploads/logo/";
    $fileName = time().'_'.basename($_FILES['picturelogo']['name']);
    $targetPath = $uploadDir. $fileName;
    
    //Upload file to server
    if(@move_uploaded_file($_FILES['picturelogo']['tmp_name'], $targetPath)){
        //Get current user ID from session
        $userId = 1;
        
        //Update picture name in the database
        $update = $db->query("UPDATE admin SET picturelogo = '".$fileName."' WHERE id = $userId");
        
        //Update status
        if($update){
            $result = 1;
        }
    }
    
    //Load JavaScript function to show the upload status
    echo '<script type="text/javascript">window.top.window.completeUploadz(' . $result . ',\'' . $targetPath . '\');</script>  ';
}