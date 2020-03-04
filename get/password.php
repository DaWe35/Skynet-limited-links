<!DOCTYPE html>
<html>
	<head>
		<title>Skynet limited links</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap-grid.css" rel="stylesheet">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	</head>
	<body>
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="622" viewBox="0 0 622 151" class="top-swoosh"><defs><filter id="a" width="103.4%" height="103.4%" x="-1.7%" y="-1.7%" filterUnits="objectBoundingBox"><feMorphology in="SourceAlpha" operator="dilate" radius="1" result="shadowSpreadOuter1"></feMorphology><feOffset in="shadowSpreadOuter1" result="shadowOffsetOuter1"></feOffset><feMorphology in="SourceAlpha" radius="1" result="shadowInner"></feMorphology><feOffset in="shadowInner" result="shadowInner"></feOffset><feComposite in="shadowOffsetOuter1" in2="shadowInner" operator="out" result="shadowOffsetOuter1"></feComposite><feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="4"></feGaussianBlur><feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0.341176471 0 0 0 0 0.709803922 0 0 0 0 0.376470588 0 0 0 0.3 0"></feColorMatrix></filter><path id="b" d="M384 768c212.077 0 384-171.923 384-384S596.077 0 384 0 0 171.923 0 384s171.923 384 384 384zm192-51.446c-91.832 53.02-252.238-52.89-358.277-236.554C111.684 296.336 100.168 104.466 192 51.446"></path></defs><g fill="none" fill-rule="evenodd"><g stroke-linejoin="round" transform="translate(-73 -626)"><use fill="#000" filter="url(#a)" xlink:href="#b"></use><use stroke="#2B6CB0" stroke-width="2" xlink:href="#b"></use></g><path fill="#3182CE" d="M119.706-574.998l-.78.524C27.13-521.461 38.642-329.612 144.64-145.968 250.637 37.676 410.982 143.572 502.779 90.559l.218-.052C446.488 123.254 380.859 142 310.853 142 98.857 142-73-29.904-73-241.957c0-142.44 77.542-266.765 192.706-333.04z"></path></g></svg>
		<?php

		if ($isPasswdEntered !== false) { ?>
			<h1 class="text-center top pt-4">Wrong password entered</h1>
			<p class="text-center top-info">Please retry, you have <?= 10 - $isPasswdEntered ?> more attempts.</p> <?php
		} else { ?>
			<h1 class="text-center top pt-4">Please enter the password</h1>
			<p class="text-center top-info">This file is protected by a password...</p> <?php
		} ?>

		<div class="border p-3 m-auto">
			<form method="POST" action="" class="home-upload-retrieve-form p-5 text-center" id="form">
				<input type="password" name="password" placeholder="Password" class="big">
				
				<button type="submit" class="button"><i class="fa fa-share mr-2"></i>Open file</button>
			</form>
		</div>
	</body>
</html>