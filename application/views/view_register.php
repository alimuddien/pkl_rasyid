<!DOCTYPE html>
<html>
<head>
	<title>Medique - Login</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
	<style type="text/css">
		body {
			margin: 0px;
			padding: 0px;
			background-image: url("img/back_login.jpg");
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			font-family: sans-serif;
			margin-top: 50%;
			background-repeat: no-repeat;
			color: black;
		}
		#avatar {
			width: 100px;
			height: 100px;
			border-radius: 50%;
			position: absolute;
			top: -50px;
			left: calc(50% - 50px);
		}
		.loginbox {
			width: 320px;
			height: 450px;
			background: rgba(241,241,241,0.7);
			color: #fff;
			top: 50%;
			left: 50%;
			position: absolute;
			transform: translate(-50%, -50%);
			box-sizing: border-box;
			padding: 50px 30px;
		}
		.loginbox input {
			width: 100%;
			margin-bottom: 20px;
		}
		#textBox {
			border: none;
			border-bottom: 1px solid black;
			background: transparent;
			outline: none;
			height: 50px;
			font-size: 16px;
		}
		p {
			color: black;
			text-align: center;
			font-size: 12px;

		}
		#btnSubmit {
			width: 50%;
			border: none;
			outline: none;
			height: 50px;
			background: green;
			font-size: 16px;
			border-radius: 20px;
			color: white;
		}
		#btnSubmit:hover {
			cursor: pointer;
			background: #ad1925;
		}
	</style>
</head>
<body>
	<div class="loginbox">
		<img src="img/avatar.png" id="avatar">
		<h1 style="text-align: center; color: black;">REGISTER HERE</h1>
		<!-- <div class="container-fluid"> -->
			<form method="POST" action="<?php echo base_url('signup')?>">
        <input type="text" placeholder="Full Name" name="fname" id="textBox" required>
        <input type="email" placeholder="Email" name="email" id="textBox" required>
        <input type="text" placeholder="Username" name="uname" id="textBox" required>
				<input type="password" placeholder="Password" name="pass" id="textBox" required>
        <input type="password" placeholder="Confirm Password" name="cpass" id="textBox" required>
				<div align="center"><button type="submit" id="btnSubmit">Sign Up</button></div>
			</form>
		<!-- </div> -->
	</div>
</body>
</html>
