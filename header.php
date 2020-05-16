<link rel="stylesheet" type="text/css" href="style/all.css">
<header>
	<div class="inner">
		<button class="logo"><img src="img/logo.png"></button>
		<div class="search-wrapper">
			<input id="searchInput" type="" name="">
			<div class="results hidden" id="results">
				
			</div>
			<div id="back" class="hidden"></div>
		</div>
		<div class="buttons left">
				<button><img src="">Mukhtar</button>
				<button><img src="">Main</button>
				<button><img src="">Messanger</button>
				<a href="api/auth/logout.php"><img src="">LogOut</a>
		</div>
<!-- 		<div class="buttons right">
				<button><img src=""></button>
				<button><img src=""></button>
				<button><img src=""></button>
				<button><img src=""></button>
				<button><img src=""></button>
		</div> -->
	</div>
</header>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$( document ).ready(function() {

		var back = document.getElementById("back");
		var search = document.getElementById("searchInput");
		var searchModal = document.getElementById("results");
		back.addEventListener("click", hideSearch);
		search.addEventListener("keyup", updateSearch);

			function updateSearch(e){
				e.preventDefault();
				console.log(this.dataset.postid)
				$.ajax({
					method: "POST",
					url: './api/friends/searchUser.php',
					data: {search: search.value}
				}).done(function(data){
					data = JSON.parse(data);
					console.log(data)
					back.classList.remove("hidden");
					searchModal.classList.remove("hidden");
					showSearchResult(data);
					
				}).always(function(){
				});
			}

			function showSearchResult(res){
				searchModal.innerHTML="";
				for (var i = 0; i < res.length; i++) {
					searchModal.innerHTML += 
					"<a href='./profile.php?id="+res[i].id+"'>"+
						"<div class='wrapper'>"+
							"<span>"+res[i].first_name+"</span>"+
							"<span>"+res[i].second_name+"</span>"+
						"</div>"+
					"</a>"
					;
				}
			}

			function hideSearch(){
				this.classList.add("hidden");
				searchModal.classList.add("hidden");
			}

	});
</script>