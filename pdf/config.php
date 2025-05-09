<?php

function dd($var) {
    echo "<pre style='background-color: black; color: green; padding: 2%'> ";
    var_dump($var);
    echo '</pre>';
    die();
}

$host="localhost";
$dbname="openfolio";
$user="root";
$password='';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

try {
   $pdo = new PDO($dsn,$user,$pass,$options);
} catch(PDOException $e) {
    dd($e->getMessage());
}


$stmt = $pdo->query("SELECT * FROM users");

// dd($stmt);
$users= [];
while ($user = $stmt->fetch()){
    $users[] = $user;
}

// echo json response
$response = [
    'status' => 'success',
    'data' => $users
];
echo json_encode($response);
exit;

// another regarding prepared statements

$stat1 = $pdo->prepare("SELECT * FROM users WHERE email=?");

$email = 'gobenocis@mailinator.com';
$stat1->execute([$email]);
$results = 
$stat1->fetch();


// insertions
try {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, address) VALUES (:username, :email, :password, :address)");

    $username = "usera";
    $email = "gobenocis@mailinator.com";
    $password = password_hash("password", PASSWORD_DEFAULT);
    $address = "Cameroon, Bamenda";

    $stmt->execute(["username" => $username, "password"=>$password, "email" => $email, "address" => $address]);

} catch(PDOException $e) {
    dd($e->getMessage());
}
