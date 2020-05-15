<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/all.css">
</head>

<body>

	<?php
     include("./header.php");
     include "./db.php";
	 include "./config.php";

	session_start();
	// if (isset($_SESSION["user_id"])) {
 	?>

 	<div class="contentWrapper">
 		<div class="contentWrapper-inner">
 		<div class="navBar">
			<a href="" style="color: #1d2129;">Mukhtar Abenov</a>
			<h4>Quick Links</h4>
			<div class="quickLinks">
				<ul>
 				<li><a href=""><img src="img/news.png">News</a></li>
 				<li><a href=""><img src="img/messanger.png">Messenger</a></li>
 				<li><a href=""><img src="img/watch.png">Watch</a></li>
 				</ul>
 			</div>

 			<div class="weather"><h4>Weather</h4></div>

 			<div class="weatherAPI">
 				<!-- Code of weather... -->
 			</div>
 		</div>

 		<div class="newsBar">
 			<div class="createNews">
 				<div class="createNews-title"><h4>Create publication</h4></div>
 				<form>
 					<div class="addPost">
 						<input type="text" name="" placeholder="Anything new?">
 					</div>
 					<div class="addMedia-tagFriend">
 						<button><img src="img/photos.png"> Photo/Video</button>
 						<button><img src="img/tag.png">Tag a friends</button>
 						<a href="" style="font-size: 13px;">Alikhon Nursapayev</a>
 					</div>
 				</form>
 			</div>
 			
 			<div class="news">
 				<div class="news-title"><h4>News</h4></div>

 				<div class="preview">
 						<div class="authorName">
 							<span><a href=""><h5>Pavel Durov</h5></a></span>
 						</div>

 						<div class="previewText">
 							<p>Preview text, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
 						</div>
 				</div>


 				<?php 
					


						// $user_id = $_SESSION["user_id"];

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

									$rowLikes = 0;

									$user = $db->query("SELECT * FROM users WHERE id = $row->user_id");
									$likes = $db->query("SELECT COUNT(id) AS count FROM likes WHERE post_id = $row->id");

									if($user->num_rows > 0)
										$rowUser=$user->fetch_object();

									if($likes->num_rows > 0)
										$rowLikes=$likes->fetch_object();
									
									
									echo '<div class="newsContent">
						 					<form>
						 						<div class="authorName">
						 							<span><a href=""><h5>'.$rowUser->first_name.' '.$rowUser->second_name.'</h5></a></span>
						 						</div>		

						 						<div class="newsText">
						 							<p>'.$row->content.'</p>
						 						</div>

						 						<div class="newsImg">
						    						<img src="'.$row->img.'" width="100%" height="400px">
						 						</div>

						 						<div class="newsLike">
						 							<img src="img/like.png">
						 							<span>'.$rowLikes->count.'</span>

						 							<div class="comment-btn">
						 								<a href="#"><button><img src="img/chat.png">Comments</button></a>
						 							</div>
						 						</div>

						 						<div class="like-dislike">
						 							<button type="submit"><i class="fa fa-thumbs-up"></i>Like</button>
						 							<button type="submit"><i class="fa fa-thumbs-down"></i>Dislike</button>
						 						</div>

						 						<div class="comments-section">
						 							<div class="comments">
						 								<a href="">Author Name </a><span>Some text...</span>
						 							</div>
						 							<br>
						 							<div class="send-comment">
						 							<input type="" name="" placeholder="Write a comment...">
						 							<button type="submit">Send</button>
						 							</div>
						 						</div>
						 					</form>
						 				</div>';

							}
						}

				 ?>



 		</div>

 	</div>
 </div>

 <?php 
			// }
			// else {
			// 		// header("Location: $base_url"."signup.php?error=1");
			// 	}

		 ?>

</body>
</html>