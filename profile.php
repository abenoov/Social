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
	if (isset($_SESSION["user_id"])) {
		$user_id = $_SESSION["user_id"];
		if (isset($_GET["id"])) {
			$currentProfileId=$_GET["id"];
			$profile = $db->query("SELECT * FROM profile WHERE user_id = $currentProfileId");
			$friends = $db->query("SELECT * FROM friends WHERE user_id = $currentProfileId OR friend_id = $currentProfileId");
			$user = $db->query("SELECT * FROM users WHERE id = $currentProfileId");
		} else {
			$currentProfileId=$user_id;
			$profile = $db->query("SELECT * FROM profile WHERE user_id = $user_id");
			$user = $db->query("SELECT * FROM users WHERE id = $user_id");
			$friends = $db->query("SELECT * FROM friends WHERE user_id = $user_id OR friend_id = $user_id");
		}
 	?>
	<link rel="stylesheet" type="text/css" href="style/all.css">
	<?php 
		if($profile->num_rows > 0) {
			$profileRow=$profile->fetch_object();
		}

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
								<form method="POST" action="./api/friends/requestFriend.php">

								<?php 
									if($friends->num_rows > 0) {
										while($friendsRow=$friends->fetch_object()){
											if ($friendsRow->friend_id!=$currentProfileId && $friendsRow->user_id!=$currentProfileId) {
												echo '<input type="hidden" name="friend_id" value='.$friendsRow->id.'>';
												echo "<button type='submit'>Add a friend</button>";
											}
										}
									} else {
										echo '<input type="hidden" name="friend_id" value='.$currentProfileId.'>';
										echo "<button type='submit'>Add a friend</button>";
									}
								 ?>
								</form>
								<form>
									<button>Update info</button>
								</form>
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
		}else {
					header("Location: $base_url"."login.php?error=1");
				}
	 ?>
</body>
</html>
