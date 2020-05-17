<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link rel="stylesheet" type="text/css" href="style/all.css">
</head>
<body>
	<?php
     include("./header.php");
     include "./db.php";
	 include "./config.php";

	session_start();
	if (isset($_SESSION["user_id"]) && isset($_GET["chat"])) {
		$user_id = $_SESSION["user_id"];
		$chat_id = $_GET["chat"];
 	?>


 		<div class="wrapper">
 			<div class="wrapper-second">
 				<div class="messagesTitle">
	 					<div class="messagesTitle-inner">
	 						<h4>Messages</h4>
	 					</div>
	 				</div>
	 			<div class="wrapper-inner">



	 				<?php
	 					$exist = $db->query("SELECT * FROM messages WHERE chat_id = $chat_id ORDER BY date");
	 					$messages="";
	 					$lastDate=null;
	 					if ($exist->num_rows>0) {
	 						while ($row=$exist->fetch_object()) {
	 							$time = strtotime($row->date);  
								$date = getDate($time);
								// if ($lastDate == null) {
								// 	$lastDate = $date;
								// }
								if ($lastDate == null) {
									$messages .= '<div class = "date">
		 								'.$date["weekday"].', '.$date["mday"].', '.$date["month"].'
		 							</div>';
		 							$lastDate = $date["mday"];
								}
								if ($lastDate != null) {
									if ($lastDate < $date["mday"]) {
										$messages .= '<div class = "date">
			 								'.$date["weekday"].', '.$date["mday"].', '.$date["month"].'
			 							</div>';
			 							$lastDate = $date["mday"];
									} 
								}
	 							$messages .= 
	 							'
	 							<div class = "bubbles">
		 							<div class = "message right">';
		 								$profile = $db->query("SELECT * FROM profile WHERE user_id = $row->user_id");
		 								$img ="";
		 								if ($profile->num_rows>0) {
		 									$profileRow=$profile->fetch_object();
		 									$img = $profileRow->img;
										} else {
											$img ="./images/profile/blank.jpg";
										}
	 									if ($img != null) {
	 										$messages.='
				 							<div class="image">
				 								<img src="'.$img.'">
							 				</div>';
	 									} else {
	 										$messages .='
				 							<div class="image">
				 								<img src="'.$img.'">
							 				</div>';
					 					}
	 									
						 		$messages .='
						 				<div class="messageContainer">
							 				<div class="content">
							 					'.$row->content.'	
							 				</div>
							 				<div class="date">
							 					'.$date["hours"].':'.$date["minutes"].'	
							 				</div>
						 				</div>
					 				</div>
				 				</div>';
	 						}
	 						echo $messages;
	 					}
	 				 ?>

	 			</div>
					<form method="POST" action="./api/messages/sendMessage.php">
						<input type="text" name="content" placeholder="Type something...">
						<input type="hidden" name="user_id" value=<?php echo $user_id; ?>>
						<input type="hidden" name="chat_id" value=<?php echo $chat_id; ?>>
						<button type="send">Send</button>
					</form>
			</div>
 		</div>


	<?php 
	} else {
		header("Location: $base_url"."login.php?error=1");
	}
	?>
</body>
</html>