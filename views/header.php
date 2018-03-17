<html>
	<head>
		<title>LDEQ Password system</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/ldeq/Assets/css/style.css" />
	</head>

<body>
<?php if(isset($_SESSION["username"])){ ?>
<div class="header">
	<div class="container">
		<img src="/ldeq/Assets/images/logo.png" style="width: 70px;display: inline-block;float: left;padding: 12px 15px 12px 0;">
		<ul>
			<li style="display:inline-block;list-style: none;border-left:solid 1px #65b4d4;border-right:solid 1px #65b4d4;padding:15px 20px;">
				<a style="color:#ffffff" href="/ldeq"><i class="fa fa-list-ul"></i>&nbsp;&nbsp;&nbsp;Projecten</a>
			</li>
			<li style="display:inline-block;list-style: none;border-right:solid 1px #65b4d4;padding:15px 20px;">
				<a style="color:#ffffff" href="/ldeq/systems"><i class="fas fa-cog"></i>&nbsp;&nbsp;&nbsp;Systemen</a>
			</li>
			<li style="display:inline-block;list-style: none;border-right:solid 1px #65b4d4;padding:15px 20px;">
				<a style="color:#ffffff" href="/ldeq/tasks"><i class="fa fa-clock"></i>&nbsp;&nbsp;&nbsp;Urenregistratie</a>
			</li>
	</div>
</div>
<?php } ?>