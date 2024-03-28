<?php
require_once 'auth/login_handler.php';
require_once 'templates/favicon.php';

$assets = 'assets/';
$css = $assets . 'css/';
$js = $assets . 'js/';
$img = $assets . 'img/';
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sipinrang || Login</title>

	<link rel="stylesheet" href="<?= $css . 'login.css' ?>">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
</head>

<body class="bg-light">
	<div class="wrapper">
		<div class="box">
			<div class="logo">
				<img src="<?= $img . 'logo.png' ?>" alt="Logo STIS" width="100px">
			</div>
			<div class="my-3_2">
				<!-- <div class="text-center text-xl">Login</div> -->
				<div class="fw-bold text-center text-primary">Sistem Informasi Peminjaman Ruang</div>
			</div>

			<?php if (isset($error)) : ?>
				<div class="alert alert-warning mb-1_2">
					<i class="fas fa-warning"></i>
					<?= $error ?>
				</div>
			<?php elseif (isset($success)) : ?>
				<div class="alert alert-success mb-1_2">
					<i class="fas fa-check-circle"></i>
					<?= $success ?>
				</div>
			<?php endif; ?>

			<form method="POST">
				<input type="text" name="username" id="username" placeholder="Username" class="form-input my-1_2" maxlength="50" required>
				<input type="password" name="pass" id="pass" placeholder="Password" class="form-input my-1_2" autocomplete="on" minlength="8" required>
				<!-- <a href="#soon" class="text-small text-decoration-none text-black">Lupa password?</a> -->
				<div class="d-flex gap-1_2">
					<input type="checkbox" name="remember-me" id="remember-me" class="cursor-pointer">
					<label for="remember-me" class="cursor-pointer">Ingat saya</label>
				</div>
				<button type="submit" name="login" class="my-1_2 mt-1 btn btn-primary">Login</button>
				<button type="button" name="register" class="my-1_2 btn btn-outline-secondary" onclick="window.location = 'register'">Register</button>
			</form>
		</div>
	</div>

	<?php if (isset($error) || isset($success)) : ?>
		<script>
			window.onload = () => {
				const alert = document.querySelector(".alert");
				setTimeout(() => {
					alert.style.display = "none";
				}, 3000);
			};
		</script>
	<?php endif; ?>
	<script src="https://site-assets.fontawesome.com/releases/v6.5.1/js/all.js"></script>
</body>

</html>