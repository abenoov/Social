<?php 
	include "../../db.php";
	include "../../config.php";

	if(isset($_POST["email"]) && strlen($_POST["email"])>0&&
		isset($_POST["first_name"]) && strlen($_POST["first_name"])>0&&
		isset($_POST["second_name"]) && strlen($_POST["second_name"])>0&&
		isset($_POST["third_name"]) && strlen($_POST["third_name"])>0&&
		isset($_POST["password"]) && strlen($_POST["password"])>0&&
		isset($_POST["passwordConfirm"]) && strlen($_POST["passwordConfirm"])>0){

		$login = $_POST["email"];
		$first_name = $_POST["first_name"];
		$second_name = $_POST["second_name"];
		$third_name = $_POST["third_name"];
		$password = $_POST["password"];
		$password2 = $_POST["passwordConfirm"];

		$exist = $db->query("SELECT * FROM users WHERE login = '$login'");

		if ($exist->num_rows > 0) {
			header("Location: $base_url"."signup.php?error=2");
		}else if ($password != $password2) { //May fail
			// header("Location: $base_url"."signup.php?error=3");
		} else {
			$db->query("INSERT INTO users(login, first_name, second_name, third_name, password) VALUES('$login','$first_name','$second_name','$third_name','".sha1($password)."')");
			// header("Location: $base_url"."login.php");
		}

	} else {
		// header("Location: $base_url"."signup.php?error=1");
	}

 ?>