<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = array("success" => false, "message" => "", "filename" => "");

if (isset($_FILES["uploadimg"])) {
    $targetDir = "../../dist/img/";
    $targetFile = $targetDir . basename($_FILES["uploadimg"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Debugging output
    $response["debug"][] = "Target file: " . $targetFile;

    // Check if file is an actual image
    $check = getimagesize($_FILES["uploadimg"]["tmp_name"]);
    if ($check === false) {
        $response["message"] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $response["message"] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["uploadimg"]["size"] > 5242880) { // 5MB limit
        $response["message"] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $response["message"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $response["message"] = "Sorry, your file was not uploaded.";
    } else {
        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES["uploadimg"]["tmp_name"], $targetFile)) {
            $response["success"] = true;
            $response["filename"] = basename($_FILES["uploadimg"]["name"]);
            $response["message"] = "The file " . htmlspecialchars(basename($_FILES["uploadimg"]["name"])) . " has been uploaded.";
        } else {
            $response["message"] = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $response["message"] = "No file uploaded.";
}

echo json_encode($response);
?>
