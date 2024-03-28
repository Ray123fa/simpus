<?php
require_once 'config/functions.php';

if (isset($_POST['register'])) {
	$auth = new Auth();

	if ($auth->register($_POST) === true) {
		$success = 'Diahlikan ke halaman login...';
		header('refresh:3;url=login'); // Redirect ke halaman login setelah 3 detik
	} else {
		$error = $auth->register($_POST);
	}
}

// Berguna bila user sudah mengisi form dan terdapat error
// Form akan tetap terisi dengan data yang sudah diinputkan
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$unit = $_POST['unit'] ?? '';
