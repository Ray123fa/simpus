<?php
require_once 'config/functions.php';

if (isset($_POST['login'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = $_POST['pass'];

	$auth = new Auth();

	if ($auth->login($username, $password) === TRUE) {
		$success = 'Diahlikan ke halaman utama...';
		header('refresh:3;url=index'); // Redirect ke halaman index setelah 3 detik
	} else {
		$error = 'Username atau password salah!';
	}
}
