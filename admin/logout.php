<?php 
if (!isset($_COOKIE['session'])) {
    header("location:../");
  }
	setcookie("session","",-1,"/");
	header("location:../");
 ?>