<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['delete']) {
		
		require_once '../dbconfig.php';
		
		$pid = intval($_POST['delete']);
		//echo $pid;

		$query = "delete from client where cid=:pid";
		//echo "delete from client where cid=:pid";
		$stmt = $con->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Client Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete Client ...';
		}
		echo json_encode($response);
	}