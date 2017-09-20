<?php
	$con = mysqli_connect("localhost", "root", "", "pageloads");
	
	$result = mysqli_query($con,"SELECT * FROM LoadSpeeds");
	
	$data = $result->fetch_all( MYSQLI_ASSOC ); 
	
	echo json_encode( $data );
?>