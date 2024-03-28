<?php
require_once 'auth/register_handler.php';
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
	<title>Sipinrang || Register</title>

	<link rel="stylesheet" href="<?= $css . 'register.css' ?>">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
</head>

<body class="bg-light">
	<div class="wrapper">
		<div class="box">
			<div class="logo">
				<img src="<?= $img . 'logo.png' ?>" alt="Logo STIS" width="100px">
			</div>
			<div class="my-3_2">
				<!-- <div class="text-center text-xl">Register</div> -->
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
				<input class="form-input my-1_2" type="text" name="username" id="username" placeholder="Username" oninput="this.style.textTransform = 'lowercase'" maxlength="50" value="<?= $username ?>" required>

				<input class="form-input my-1_2" type="email" name="email" id="email" placeholder="Email STIS" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" maxlength="50" value="<?= $email ?>" required>

				<input class="form-input my-1_2" type="text" name="unit" id="unit" placeholder="Organisasi/Unit/UKM/Himada" oninput="this.style.textTransform = 'uppercase'" value="<?= $unit ?>" required>

				<input class="form-input my-1_2" type="password" name="pass" id="pass" placeholder="Password" autocomplete="on" minlength="8" required>
				<input class="form-input my-1_2" type="password" name="pass2" id="pass2" placeholder="Konfirmasi Password" autocomplete="on" minlength="8" required>

				<button type="submit" name="register" class="my-1_2 btn btn-primary">Register</button>
				<button type="button" name="login" class="my-1_2 btn btn-outline-secondary" onclick="window.location = 'login'">Login</button>
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