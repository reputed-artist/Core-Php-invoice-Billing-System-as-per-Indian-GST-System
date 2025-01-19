<?php
include '../dbconnection.php';

$response = ['success' => false];

$insert_query="";
if (isset($_REQUEST['delivery_name']) && isset($_REQUEST['delivery_address']) && isset($_REQUEST['delivery_mobile']) && isset($_REQUEST['invid'])) {
    $delivery_name = $_REQUEST['delivery_name'];
    $delivery_address = $_REQUEST['delivery_address'];
    $delivery_mobile = $_REQUEST['delivery_mobile'];
    $invid = $_REQUEST['invid'];

    // Escape special characters to prevent SQL injection
    $delivery_name = mysqli_real_escape_string($con, $delivery_name);
    $delivery_address = mysqli_real_escape_string($con, $delivery_address);
    $delivery_mobile = mysqli_real_escape_string($con, $delivery_mobile);

    // Insert delivery address into the database
    if($delivery_name != null && $delivery_address !=null && $delivery_mobile != null)
    {
    $insert_query = "INSERT INTO delivery_addresses (delid, invid, name, address, mob) VALUES (NULL, '$invid', '$delivery_name', '$delivery_address', '$delivery_mobile')";

    //echo $insert_query;

    if (mysqli_query($con, $insert_query)) {
        $response['success'] = true;
        $response['message'] = 'Delivery address saved successfully.';
    } else {
        $response['message'] = 'Failed to save delivery address: ' . mysqli_error($con);
    }
   } 
} else {
    $response['message'] = 'Incomplete data.';
}

//echo $insert_query;
// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
