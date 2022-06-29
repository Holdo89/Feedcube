<?php
$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$parsedUrl = parse_url($url);
$host = explode('.', $url);
$subdomain = $host[0];
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=localhost;dbname=feedcube_'.$subdomain, 'root', '');
$statement = $pdo->prepare("SELECT name FROM users ORDER BY name");
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
?>