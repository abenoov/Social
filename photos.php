<!DOCTYPE html>
<html>
<head>
	<title>My Photos</title>
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
							<a href="./profile.php">Information</a>
							<a href="./friends.php">Friends</a>
							<a class="active" href="photos.php">Photo</a>
							<a href="./video.php">Video</a>
						</div>
					</div>
				</div>

					<!-- =============== -->

						<div class="profile-info-wrapper">

							<?php
							

							$exist = $db->query("SELECT * FROM posts");

							if ($exist->num_rows > 0) {

								// header("Location: $base_url"."signup.php?error=2");
								while ($row=$exist->fetch_object()) {

										// $output[] = array(
										// 	"id"=>$row->id,
										// 	"content"=>$row->content,
										// 	"img"=>$row->img,
										// 	"date"=>$row->date,
										// 	"user_id"=>$row->user_id,
										// );

										$post_id = $row->id;

										$rowLikes = 0;

										$user = $db->query("SELECT * FROM users WHERE id = $row->user_id");
										$likes = $db->query("SELECT COUNT(id) AS count FROM likes WHERE post_id = $row->id");
										$comments = $db->query("SELECT * FROM comments WHERE post_id = $row->id");

										if($user->num_rows > 0)
											$rowUser=$user->fetch_object();

										if($likes->num_rows > 0)
											$rowLikes=$likes->fetch_object();
										
										$field = 
											'<div class="newsContent">
							 					<form  action="./api/comments/addComment.php" method="POST">
							 						<div class="authorName">
							 							<span><a href=""><h5>'.$rowUser->first_name.' '.$rowUser->second_name.'</h5></a></span>
							 						</div>		

							 						<div class="newsText">
							 							<p>'.$row->content.'</p>
							 						</div>';

							 						if ($row->img != null) {
							 							$field .= '
								 						<div class="newsImg">
								    						<img src="'.$row->img.'" width="100%" height="400px">

								 						</div>';
						 							}
						 							$field .= '
						 							'.$row->date.'
							 						<div class="newsLike">
							 							<img src="img/like.png">
							 							<span>'.$rowLikes->count.'</span>
							 							<div class="comment-btn">
							 								<img src="img/chat.png">Comments
							 							</div>
							 						</div>

							 						<div class="like-dislike">
							 							<button  id="likeButton" data-postId="'.$post_id.'"><i class="fa fa-thumbs-up"></i>Like</button>
							 							<button  id="dislikeButton" data-postId="'.$post_id.'"><i class="fa fa-thumbs-down"></i>Dislike</button>
							 						</div>

							 						<div class="comments-section">';
							 							
							 							 if($comments->num_rows > 0){
															while($commentRow=$comments->fetch_object()){
																$userComments = $db->query("SELECT * FROM users WHERE id = $commentRow->user_id");
																		if ($userComments->num_rows>0) {
																			$commentUserRow=$userComments->fetch_object();
																		
																		$field .= '<div class="comments"><a href="'.$base_url.'"profile.php?id='.$commentRow->user_id.'>'.$commentUserRow->first_name.' '.$commentUserRow->second_name.'</a><span> '.$commentRow->content.'</span></div>';
																	}
															}
														 }
							 							$field .= '
							 							<br>
							 							<div class="send-comment">
												 			<input id="cm" type="text" name="content" placeholder="Write a comment...">
												 			<input type="hidden" name="post_id" value="'.$post_id.'">
															<button type="submit">Send</button>
							 							</div>
							 						</div>
							 					</form>
							 				</div>';

							 				echo "$field";

								}
							}
					 ?>

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
