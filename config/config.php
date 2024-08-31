<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// require_once '../vendor/autoload.php';
// use Dotenv\Dotenv;
// $dotenv = Dotenv::createImmutable('../');
// $dotenv->load();

// connection to databse goes here

$db_host = $_ENV['DB_HOST'] ?? 'localhost';
$db_database = $_ENV['DB_DATABASE'] ?? 'openfolio';
$db_username = $_ENV['DB_USERNAME'] ?? 'root';
$db_password = $_ENV['DB_PASSWORD'] ?? '';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}