<?php 

include '../dbconnection.php';
include '../fy.php';

$response = array();

// Fetch the value for q_id from the database
$cs = mysqli_query($con, "SELECT CONCAT_WS('/', '24-25', COALESCE(LPAD(CASE WHEN '2024-04-19' >= DATE_FORMAT('2024-04-19', '%Y-04-01') THEN SUM(created >= DATE_FORMAT('2024-04-19', '%Y-04-01')) ELSE SUM(created BETWEEN DATE_FORMAT('2024-04-19', '%Y-04-01') - INTERVAL 1 YEAR AND DATE_FORMAT('2024-04-19', '%Y-04-01')) END + 1, 4, 0), LPAD(1, 4, 0))) AS 'q_id' FROM quickquote");
$result = mysqli_fetch_array($cs);

// Check if the query was successful and if the result is not empty
if ($result) {
    // Construct q_id using the fetched value
    $q_id = "QUICKT/" . $result['q_id'];
    
    // Process other request parameters
    $p_id = $_REQUEST['productId'];
    $quantity = $_REQUEST['quantity'];
    $price = $_REQUEST['price'];
    $mob = $_REQUEST['mobileNumber'];
    $subtotal = $_REQUEST['subtotal'];
    $gst = $_REQUEST['gst'];
    $totalAftertax = $_REQUEST['total'];
    $date = date("Y-m-d h:i:sa");

    // Insert data into the database
    $stm = mysqli_query($con, "INSERT INTO `quickquote` (`q_id`, `p_id`, `mob`, `quantity`, `price`, `subtotal`, `gst`, `total`, `created`) VALUES ('$q_id', '$p_id', '$mob', '$quantity', '$price', '$subtotal', '$gst', '$totalAftertax', '$date')");

    // Check if the insertion was successful
    if (!$stm) {
        $response['success'] = false;
        $response['message'] = "Error occurred: " . mysqli_error($con);
    } else {
        $response['success'] = true;
        $response['message'] = "Quick Quotation added successfully";
        $response['div'] = $p_id;
    }
} else {
    // Handle the case when the query fails or the result is empty
    $response['success'] = false;
    $response['message'] = "Error occurred while fetching q_id";
}

// Output the response as JSON
echo json_encode($response);
?>