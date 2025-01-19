<?php
include '../dbconnection.php';

$response = ['success' => false];

if (isset($_REQUEST['delivery_name']) && isset($_REQUEST['delivery_address']) && isset($_REQUEST['delivery_mobile']) && isset($_REQUEST['invid'])) {
    $delivery_name = $_REQUEST['delivery_name'];
    $delivery_address = $_REQUEST['delivery_address'];
    $delivery_mobile = $_REQUEST['delivery_mobile'];
    $invid = $_REQUEST['invid'];

    // Escape special characters to prevent SQL injection
    $delivery_name = mysqli_real_escape_string($con, $delivery_name);
    $delivery_address = mysqli_real_escape_string($con, $delivery_address);
    $delivery_mobile = mysqli_real_escape_string($con, $delivery_mobile);

    // Update delivery address in the database
    if (!empty($delivery_name) && !empty($delivery_address) && !empty($delivery_mobile)) {
        $update_query = "UPDATE delivery_addresses SET name = '$delivery_name', address = '$delivery_address', mob = '$delivery_mobile' WHERE invid = '$invid'";
        
        //echo $update_query;

        if (mysqli_query($con, $update_query)) {
            $response['success'] = true;
            $response['message'] = 'Delivery address updated successfully.';
        } else {
            $response['message'] = 'Failed to update delivery address: ' . mysqli_error($con);
        }
    } else {
        $response['message'] = 'Incomplete data.';
    }
} else {
    $response['message'] = 'Incomplete data.';
}

// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
