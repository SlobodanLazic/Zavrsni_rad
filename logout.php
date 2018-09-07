<?php
	if (session_id() === "")
	{
		session_start();
	}
	
	require_once("modules_BL/user/loginBL.class.php");
	
	$loginBL = new LoginBL();
	$loginBL->Logout();
?>