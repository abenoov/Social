<!DOCTYPE html>
<html>
<head>
	<title>Feed</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		$thisUser = $db->query("SELECT * FROM users WHERE id = $user_id");
		$profile = $db->query("SELECT * FROM profile WHERE user_id = $user_id");
		if ($profile->num_rows>0) {
			
		} else{
			header("Location:".$base_url."information.php");
		}
		if($thisUser->num_rows > 0)
			$rowThisUser=$thisUser->fetch_object();

 	?>

	 	<div class="contentWrapper">
	 		<div class="contentWrapper-inner">
	 		<div class="navBar">
				<a href="./profile.php" style="color: #1d2129;"><?php echo $rowThisUser->first_name." ".$rowThisUser->second_name; ?></a>
				<h4>Quick Links</h4>
				<div class="quickLinks">
					<ul>
	 				<li><a href="https://edition.cnn.com/"><img src="img/news.png">News</a></li>
	 				<li><a href="./chat.php"><img src="img/messanger.png">Messenger</a></li>
	 				<li><a href="./video.php"><img src="img/watch.png">Watch</a></li>
	 				</ul>
	 			</div>

	 			<div class="weather" id="weatherPoint">
	 				<h4>Weather</h4>
	 			</div>

	 			<div class="weatherAPI">
	 				<!-- Code of weather... -->
	 			</div>
	 		</div>

	 		<div class="newsBar">
	 			<div class="createNews">
	 				<div class="createNews-title"><h4>Create publication</h4></div>
	 				<form method="POST" action="./api/feed/newPost.php" enctype="multipart/form-data">
	 					<div class="addPost" >
	 						<input type="text" name="content" placeholder="Anything new?">
	 						<input type="file" name="img" id="fileChoose" style="display: none;">
	 					</div>
	 					<div class="addMedia-tagFriend">
	 						<button id="uploadFileButton"><img src="img/photos.png"> Photo/Video</button>
	 						<button><img src="img/tag.png">Tag a friends</button>
	 						<button type="submit" ><img src="img/share.png" width="16" height="16">Share</button>
	 						<a href="#" style="font-size: 13px;">Jahongir Tostimir</a>
	 					</div>
	 					
	 				</form>
	 			</div>
	 			
	 			<div class="news">
	 				<div class="news-title"><h4>News</h4></div>

	 				<div class="preview">
	 						<div class="authorName">
	 							<span><a href=""><h5>Author's Signature</h5></a></span>
	 						</div>

	 						<div class="previewText">
	 							<p>We are talented group of developers who designed a social network connecting communities to make their own tight knitted environment. Our project is about meeting the people with common interests ,being aware of surrounding events and news etc. All rights reserved (c) 2020.</p>
	 						</div>
	 				</div>


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
		 	</div>
		 </div>

 <?php 
			}
			else {
					header("Location: $base_url"."login.php?error=1");
				}

		 ?>
<script async="" type="text/javascript">
	$( document ).ready(function() {


		var fileChoose = document.getElementById("fileChoose");
		var uploadFileButton = document.getElementById("uploadFileButton");

		uploadFileButton.addEventListener("click", function(){
			fileChoose.click();
		});
		

		$.ajax({
			method: "GET",
			url: 'http://api.openweathermap.org/data/2.5/weather?q=Almaty&appid=fd1ab7b2f231e500c32eab7e264fa362'
		}).done(function(data){
			// data = JSON.parse(data);
			console.log(data)
			showData(data);
		}).always(function(){
		});

	});

	var likeButton = document.querySelectorAll("#likeButton");
	console.log(likeButton)
	for (var i = 0; i < likeButton.length; i++) {
    	likeButton[i].addEventListener("click", pressLike);
	}

	var dislikeButton = document.querySelectorAll("#dislikeButton");
	console.log(dislikeButton)
	for (var i = 0; i < dislikeButton.length; i++) {
    	dislikeButton[i].addEventListener("click", pressDislike);
	}


	function pressLike(e){
		e.preventDefault();
		console.log(this.dataset.postid)
		$.ajax({
			method: "POST",
			url: './api/feed/pressLike.php',
			data: {post_id: this.dataset.postid}
		}).done(function(data){
			data = JSON.parse(data);
			console.log(data)
			showData(data);
		}).always(function(){
		});
	}

	function pressDislike(e){
		e.preventDefault();
		console.log(this.dataset.postid)
		$.ajax({
			method: "POST",
			url: './api/feed/pressDislike.php',
			data: {post_id: this.dataset.postid}
		}).done(function(data){
			data = JSON.parse(data);
			console.log(data)
			showData(data);
		}).always(function(){

		});
	}


	function showData(data){
		var weather = document.getElementById("weatherPoint");
		var description = "";
		var icon = "";
		var id = "";
		var main = "";
		var temperature = "";

		console.log(data.weather)
		for(var i = 0; i< data.weather.length; i++) {
			description = data.weather[i].description;
			id = data.weather[i].id;
			icon = data.weather[i].icon;
			main = data.weather[i].main;
			temperature = data.main.temp;
		}

		console.log(main)
		weather.innerHTML = "<h4>Weather</h4>" +
			"<div class='weather-inner'>"+
				"<h1>City: "+data.name+"</h1>"+
				"<div class='image'>"+
					"<img src = 'http://openweathermap.org/img/wn/"+icon+"@2x.png'>"+
				"</div>"+

				"<div class='status'>"+
					"<p>Today: "+description+"</p>"+
					"<p>Temperature: "+(temperature-273,15)+ "&#176;"+"</p>"+
				"</div>"+
			"</div>";
	}
</script>
</body>
</html>