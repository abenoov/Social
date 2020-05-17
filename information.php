<!DOCTYPE html>
<html>
<head>
	<title>Information</title>
	<link rel="stylesheet" type="text/css" href="style/all.css">
</head>

<body>

	<style type="text/css">
	.information {
	width: 100%;
	padding: 10% 0;
	text-align: center;
}

.information-wrapper {
}

.information-inner {
	display: flex;
	justify-content: center;
}

.information-input-wrapper {
	width: 400px;
	display: block;
	padding: 20px 0;
	margin: 0 50px;
	background-color: #fff;
	border-radius: 8px;
	box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
}

.information-input {
	padding: 6px 0;
}

.information-input input {
	width: 80%;
	line-height: 25px;
	font-size: 17px;
    padding: 14px 16px;
    border: 1px solid #dddfe2;
    color: #1d2129;
    border-radius: 6px;
}

.information-btn {
	padding: 6px 0;
}

.information-btn button {
	width: 354px;
	background-color: #42b72a;
	color: #fff;
	font-size: 20px;
	line-height: 53px;
	border: none;
	border-radius: 6px;
	cursor: pointer;
}

.information-btn button:hover {
	background-color: #36a420;
}

.hr {
	border-bottom: 1px solid #dadde1;
    margin: 20px 23px;
}

.to-login-link {
	padding: 6px 0;

}

.logotype {
	margin: 0 50px;
}

.logotype img {
	margin-top: 60px;
}

.information-wrapper p {
	display: flex;
	justify-content: center;
	margin-left: -45%;
	font-size: 20px;
}

.information-wrapper p strong {
	margin-right: 5px;
}
</style>


<div class="information">
	<form action="./api/profile/setProfile.php" method="POST" enctype="multipart/form-data">

		<div class="information-wrapper">
			
			<div class="information-inner">
				<div class="information-input-wrapper">

				<div class="information-input">
					<input type="text" name="education" placeholder="Education">
				</div>

				<div class="information-input">
					<input type="text" name="family_status" placeholder="Family Status">
				</div>				

				<div class="information-input">
					<input type="text" name="city" placeholder="City">
				</div>

				<div class="information-input">
					<input type="text" name="gender" placeholder="Gender">
				</div>

				<div class="information-input">
					<input type="file" name="img">
				</div>

				<div class="information-btn">
					<button type="submit">Register</button>
				</div>

						<div class="hr"></div>

				<div class="to-login-link">
					<a href="./login.php">Always have an account? Log In</a>
				</div>

				</div>

			</div>
		</div>
	</form>

</div>
</body>
</html>