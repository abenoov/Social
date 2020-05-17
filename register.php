<!DOCTYPE html>
<html>
<head>
	<title>Log In or Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style/all.css">
</head>

<body>

	<style type="text/css">
	.signUp {
	width: 100%;
	padding: 10% 0;
	text-align: center;
}

.signUp-wrapper {
}

.signUp-inner {
	display: flex;
	justify-content: center;
}

.signUp-input-wrapper {
	width: 400px;
	display: block;
	padding: 20px 0;
	margin: 0 50px;
	background-color: #fff;
	border-radius: 8px;
	box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
}

.signUp-input {
	padding: 6px 0;
}

.signUp-input input {
	width: 80%;
	line-height: 25px;
	font-size: 17px;
    padding: 14px 16px;
    border: 1px solid #dddfe2;
    color: #1d2129;
    border-radius: 6px;
}

.signUp-btn {
	padding: 6px 0;
}

.signUp-btn button {
	width: 354px;
	background-color: #42b72a;
	color: #fff;
	font-size: 20px;
	line-height: 53px;
	border: none;
	border-radius: 6px;
	cursor: pointer;
}

.signUp-btn button:hover {
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

.signUp-wrapper p {
	display: flex;
	justify-content: center;
	margin-left: -45%;
	font-size: 20px;
}

.signUp-wrapper p strong {
	margin-right: 5px;
}
</style>


<div class="signUp">
	<form action="./api/auth/signup.php" method="POST">

		<div class="signUp-wrapper">
			<p><strong>Create a Page </strong> for a celebrity, band or business.</p>
			<div class="signUp-inner">
				<div class="logotype">
					<img src="img/logotype.png" width="240px" height="240px">
				</div>
				<div class="signUp-input-wrapper">

				<div class="signUp-input">
					<input type="text" name="first_name" placeholder="First Name">
				</div>

				<div class="signUp-input">
					<input type="text" name="second_name" placeholder="Second Name">
				</div>				

				<div class="signUp-input">
					<input type="email" name="email" placeholder="Email">
				</div>

				<div class="signUp-input">
					<input type="password" name="password" placeholder="Password">
				</div>

				<div class="signUp-input">
					<input type="password" name="passwordConfirm" placeholder="Confirm Password">
				</div>

				<div class="signUp-btn">
					<button type="submit">Continue</button>
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