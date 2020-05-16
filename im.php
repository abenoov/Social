<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
</head>
<body>

	<style type="text/css">
		.wrapper {
			width: 100%;
			min-height: 100vh;
			display: flex;
			justify-content: center;
		}

		.wrapper-second {
			width: 100%;
			display: flex;
			flex-direction: column;
			align-items: center;
			min-height: 100vh;
		}

		.wrapper-second form {
			width: 80%;
			display: flex;
			justify-content: center;
			align-content: center;
			padding: 5px;
		}
		.wrapper-second form input {
			width: 80%;
			padding: 5px;
			margin-right: 2%;
		}
		.wrapper .wrapper-inner {
			width: 80%;
			background-color: lightgrey;
			display: flex;
			flex-direction: column;
			align-items: center;
			min-height: 90%;
		}

		.wrapper .wrapper-inner .bubbles {
			width: 100%;
			display: flex;
		}

		.wrapper .wrapper-inner .bubbles .message {
			width: 100%;
			display: flex;
			justify-content: center; 
			align-items: center;
			flex-wrap: wrap;
		}

		.wrapper .wrapper-inner .bubbles .message .image {
			width: 8%;
			border-radius: 100px;
			margin-right: 2%;
		}
		
		.wrapper .wrapper-inner .bubbles .message .image img {
			width: 100%;
			border-radius: 100px;
		}

		.wrapper .wrapper-inner .bubbles .message.left {
			justify-self: flex-start;
		}

		.wrapper .wrapper-inner .bubbles .message.right {
			justify-self: flex-end;
		}

		.wrapper .wrapper-inner .bubbles .message .messageContainer {
			width: 80%;
			display: flex;
			justify-content: space-between;
		}
		.wrapper .wrapper-inner .bubbles .message .messageContainer .date {
			font-size: 10px;
		}
	</style>

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
						<input type="text" name="content">
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