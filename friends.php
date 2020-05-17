<!DOCTYPE html>
<html>
<head>
	<title>Friends</title>
</head>
<body>
	<?php
	     include("./header.php");
	     include "./db.php";
		 include "./config.php";

		session_start();
		if (isset($_SESSION["user_id"])) {
			$user_id = $_SESSION["user_id"];

			$exist = $db->query("SELECT * FROM friendRequest WHERE friend_id = $user_id");
			$friends = $db->query("SELECT * FROM friends WHERE friend_id = $user_id OR user_id = $user_id");

			
	?>
		<link rel="stylesheet" type="text/css" href="style/all.css">

		<div class="friendSection">
			<div class="friendInner">
				<div class="friend-title-req">
					<h4>Requests</h4>
				</div>
				<?php 
					if ($exist->num_rows>0) {
						while ($row=$exist->fetch_object()) {
							$userProfile = $db->query("SELECT * FROM profile WHERE user_id = $row->user_id");
							$user = $db->query("SELECT * FROM users WHERE id = $row->user_id");
							$userRow=$user->fetch_object();
							$userProfileRow=$userProfile->fetch_object();
							echo '<div class="friendContainer">
								<div class="friendImg">
									<img src="'.$userProfileRow->img.'" width="150px" height="150px">
								</div>
								<div class="friendInformation">
									<p>
										'.$userRow->first_name.' '.$userRow->second_name.' '.$userRow->third_name.' 
									</p>
								</div>
								<form method="POST" action="./api/friends/acceptFriend.php">
									<input type="hidden" name="friend_id" value='.$row->user_id.'>
									<button>Accept Request</button>
								</form>
							</div>';
						}
					} else {
						echo '<div class="no-request">' . 'There are no request'. '</div>';
					}
				 ?>

				 <div class="friend-title" style="margin-top: 5%;">
					<h4>Friends</h4>
				</div>
				
				<?php 
					if ($friends->num_rows>0) {
						while ($friendsRow=$friends->fetch_object()) {

							$currentFriend="";

							if ($friendsRow->friend_id != $user_id) {
								$currentFriend = $friendsRow->friend_id;
							} elseif ($friendsRow->user_id != $user_id) {
								$currentFriend=$friendsRow->user_id;
							}

							$userProfile = $db->query("SELECT * FROM profile WHERE user_id = $currentFriend");
							$user = $db->query("SELECT * FROM users WHERE id = $currentFriend");
							$userRow=$user->fetch_object();
							echo '<div class="friendContainer">
								<div class="friendInformation">
									<p>
										'.$userRow->first_name.' '.$userRow->second_name.' '.$userRow->third_name.' 
									</p>
								</div>
								<form method="POST" action="./chat.php">
									<input type="hidden" name="friend_id" value='.$userRow->id.'>
									<button type="submit">Chat</button>
								</form>
							</div>';
						}
					} else {
						echo '<div class="no-request">' . 'You do not have any friends'. '</div>';
					}
				 ?>

			</div>
		</div>

	<?php 
		}else {
			header("Location: $base_url"."login.php?error=1");
		}
	 ?>
</body>
</html><!-- !!! This file is not a page, this file is just COMPONENT !!! -->




