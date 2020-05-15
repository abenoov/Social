<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>

	<?php
     include("./header.php");
     include "./db.php";
	 include "./config.php";

	session_start();
	// if (isset($_SESSION["user_id"])) {
 	?>
	<link rel="stylesheet" type="text/css" href="style/all.css">
	<?php 
		$profile = $db->query("SELECT * FROM profile WHERE user_id = 1");
		$user = $db->query("SELECT * FROM users WHERE id = 1");
		if($profile->num_rows > 0) {
			$profileRow=$profile->fetch_object();

		if($user->num_rows > 0) {
			$userRow=$user->fetch_object();
		}
	 ?>
			<div class="profileSection">
				<div class="profileInner">
					<div class="profile">
						<div class="container">
							<div class="profilePhoto-wrapper">
								<div class="profilePhoto" style="background: url(<?php echo "'$profileRow->img'"; ?>); background-position: center; background-size: cover; background-repeat: no-repeat;">
									

								</div>
							</div>

							<div class="profileName">
								<a href=""><?php echo $userRow->first_name." ".  $userRow->second_name; ?></a>
							</div>

							<div class="profileEdit">
								<button>Update info</button>
							</div>
						</div>
					</div>

				<div class="profileInfo">
					<div class="profileInfo-inner">
						<div class="profileInfo-btn">
							<a href="">Information</a>
							<a href="">Friends</a>
							<a href="">Photo</a>
							<a href="">Video</a>
						</div>
					</div>
				</div>

				</div>
			</div>
	<?php 
		}
		// } else {
		// 	echo "not logged in";
		// }
	 ?>
</body>
</html>
