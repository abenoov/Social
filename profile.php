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
											if ($friendsRow->friend_id != $user_id && $friendsRow->user_id != $user_id) {
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
							<a class="active" href="./profile.php">Information</a>
							<a href="./friends.php">Friends</a>
							<a href="./photos.php">Photo</a>
							<a href="./video.php">Video</a>
						</div>
					</div>
				</div>

					<!-- =============== -->

						<div class="profile-info-wrapper">

							<div class="profile-info-inner">
								<ul>
									<?php 
										$profile2 = $db->query("SELECT * FROM profile WHERE user_id = $currentProfileId");
										if($profile2->num_rows > 0) {
											while($profileRow2=$profile2->fetch_object()){
												echo '
														<li><h5>Education </h5> <span>'.$profileRow2->education.'</span> </li>
														<li><h5>Family status </h5> <span>'.$profileRow2->family_status.'</span> </li>
														<li><h5>From </h5> <span>'.$profileRow2->city.'</span> </li>
														<li><h5>Gender </h5> <span>'.$profileRow2->gender.'</span> </li>
													';
											}
										}

									 ?>
								</ul>
							</div>

						</div>

						<!-- =================== -->
				</div>
			</div>
	<?php
		}else {
					header("Location: $base_url"."login.php?error=1");
				}
	 ?>
</body>
</html>
