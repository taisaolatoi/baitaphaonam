<?php
$host = 'localhost';
$port = 5432;
$dbname = 'BanHang';
$user = 'postgres';
$password = '1';

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");  
return $conn;
?>