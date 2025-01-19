<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_GET['delete']) {
		
		require_once '../dbconfig.php';
		
		$pid = strval($_GET['delete']);
		//echo $pid;

		$query = "delete from purchaseinv2 where orderid=:pid";
		$query2="delete from purchaseinv where orderid=:pid";
		//echo "delete from client where cid=:pid";
		$stmt = $con->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));

		$stmt2 = $con->prepare( $query2 );
		$stmt2->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Product Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete product ...';
		}
		echo json_encode($response);
	}