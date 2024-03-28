<?php
require 'connect.php';

class Telebot
{
	private $token;
	private $chat_id;

	public function __construct($token, $chat_id)
	{
		$this->token = $token;
		$this->chat_id = $chat_id;
	}

	public function sendMessage($message)
	{
		$api = "https://api.telegram.org/bot" . $this->token . "/sendMessage?chat_id=" . $this->chat_id . "&text=" . $message;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		curl_close($ch);
	}

	public function sendFile($file)
	{
		$api = "https://api.telegram.org/bot" . $this->token . "/sendDocument?chat_id=" . $this->chat_id;
		$post = array('document' => new CURLFile($file));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_exec($ch);
		curl_close($ch);
	}
}

class Auth
{
	public function login($username, $password)
	{
		global $conn;

		$query = "SELECT * FROM user WHERE username = '$username'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) === 1) {
			$user = mysqli_fetch_assoc($result);
			if (password_verify($password, $user['password'])) {
				return true;
			}
		}
		return false;
	}

	public function register($data)
	{
		global $conn;

		$username = strtolower(strip_tags(stripslashes($data['username'])));
		$email = strip_tags($data['email']);
		$unit = strtoupper(strip_tags(stripslashes($data['unit'])));
		$password = mysqli_real_escape_string($conn, $data['pass']);
		$password2 = mysqli_real_escape_string($conn, $data['pass2']);

		// Cek apakah sudah terdapat username yang sama
		$checkUser = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
		if (mysqli_fetch_row($checkUser)) {
			return "Username sudah digunakan";
		}

		// Cek apakah email berdomain STIS
		$domain = substr(strstr($email, "@"), 1);
		if ($domain !== 'stis.ac.id') {
			return "Bukan email STIS";
		}

		// Cek apakah sudah terdapat unit yang sama
		$checkUnit = mysqli_query($conn, "SELECT * FROM user WHERE unit = '$unit'");
		if (mysqli_fetch_row($checkUnit)) {
			return "Unit sudah terdaftar pada sistem";
		}

		// Cek kesesuaian password dan konfirmasinya
		if ($password !== $password2) {
			return "Password dan konfirmasi tidak sesuai";
		}

		// Hash password
		$password = password_hash($password, PASSWORD_DEFAULT);

		$query = "INSERT INTO user VALUES (NULL, '$username', '$email', '$password', '$unit')";
		$result = mysqli_query($conn, $query);
		if ($result) {
			return true;
		} else {
			return "Registrasi tidak berhasil";
		}
	}
}
