<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['delete']) {
		
		require_once '../dbconfig.php';
		
		$fid = intval(($_POST['delete']));
		//echo $fid;


		$query = "delete from fd where id=:fid";
		//echo "delete from fd where id=:fid";
		$stmt = $con->prepare( $query );
		$stmt->execute(array(':fid'=>$fid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Product Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete product ...';
		}
		echo json_encode($response);
	}