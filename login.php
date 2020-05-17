<!DOCTYPE html>
<html>
<head>
	<title>Log In or Sign Up</title>
	<link rel="stylesheet" type="text/css" href="style/all.css">
</head>
<body>

<div class="logIn">
	<form action="./api/auth/signin.php" method="POST">

		<div class="logIn-wrapper">
			<p><strong>Create a Page </strong> for a celebrity, band or business.</p>
			<div class="logIn-inner">
				<div class="logotype">
					<img src="img/logotype.png" width="240px" height="240px">
				</div>
				<div class="logIn-input-wrapper">
				<div class="logIn-input">
					<input type="text" name="login" placeholder="Email">
				</div>
				<div class="logIn-input">
					<input type="password" name="password" placeholder="Password">
				</div>
				<div class="logIn-btn">
					<button type="submit">Log In</button>
				</div>
						<div class="hr"></div>

				<div class="to-auth-link">
					<a href="register.php"><button>Create New Account</button></a>
				</div>

				</div>

			</div>
		</div>
	</form>

</div>
</body>
</html>