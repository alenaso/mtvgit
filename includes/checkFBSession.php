<?php
	$signed_req = $facebook->getSignedRequest();
	if($signed_req["user_id"] != $_SESSION["fbid"]){
		session_destroy();
		session_start();
		$_SESSION["fbid"] = $signed_req["user_id"];
		session_write_close();
	}
?>