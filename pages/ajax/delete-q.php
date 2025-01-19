<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_GET['delete']) {
		
		require_once '../dbconfig.php';
		
		$pid = strval($_GET['delete']);
		//echo $pid;

		$query = "delete from quote2 where invid=:pid";
		//$query2="delete from quote where orderid=:pid";
		//echo "delete from invtest2 where invid=:pid";
		
		$stmt = $con->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));
	
		// $stmt = $con->prepare( $query2 );
		// $stmt->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Product Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete product ...';
		}
		echo json_encode($response);
	}