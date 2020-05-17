<!DOCTYPE html>
<html>
<head>
	<title>My Chats</title>
	<link rel="stylesheet" type="text/css" href="style/all.css">
</head>
<body>
	<?php
     include("./header.php");
     include "./db.php";
	 include "./config.php";

	session_start();
	if (isset($_SESSION["user_id"])) {
		$user_id = $_SESSION["user_id"];
 	?>

 		<div class="chatTitle">
 			<div class="chatTitle-inner">
 			<h4>Chats</h4>
	</div> 			
			</div>

		<div class="wrapper">


			<?php 
			$chats = "";
				$exist = $db->query("SELECT * FROM chat WHERE user_id = $user_id OR participant_id = $user_id");
				if ($exist->num_rows > 0) {
					while ($row=$exist->fetch_object()) {
						if ($row->user_id != $user_id) {
							$user = $db->query("SELECT * FROM users WHERE id = $row->participant_id");
							$profile = $db->query("SELECT * FROM profile WHERE user_id = $row->participant_id");
							// echo "yes";
						} elseif ($row->participant_id != $user_id) {
							$user = $db->query("SELECT * FROM users WHERE id = $row->user_id");
							$profile = $db->query("SELECT * FROM profile WHERE user_id = $row->user_id");
							// echo "Yes";
						}

						if ($user->num_rows >0) {
							$userRow=$user->fetch_object();
							$chats .= '
								<div class="chat"><a href="'.$base_url.'im.php?chat='.$row->id.'">';
									if ($profile->num_rows>0) {
										$profileRow=$profile->fetch_object();
									$chats .= '
									<div class="img">
										<img src = "'.$profileRow->img.'">
									</div>';
								} else {
									$chats .= '
									<div class="img">
										<img src = "./images/profile/blank.jpg">
									</div>';
								}
							$chats.='
									<div class="name">
										'.$userRow->first_name.' '.$userRow->second_name.'
									</div>
								</div>';
						}
						echo $chats;	
					}
				}
			 ?>
		</div>

	<?php 
	} else {
		header("Location: $base_url"."login.php?error=1");
	}
	?>
</body>
</html>