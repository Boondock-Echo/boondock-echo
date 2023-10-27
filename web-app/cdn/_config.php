<?php

$mqtt_server   = '3.137.29.71';
$mqtt_port     = 1883;
$mqtt_clientId = rand(5, 15);
$mqtt_username = 'blueman';
$mqtt_password = 'TYgu6fPhoofJ';
$mqtt_clean_session = false;

$uploadFolder = "storage/uploads/";

session_start();

$db_host = "localhost"; /* Host name */
$db_user = "root"; /* User */
$db_password = ""; /* Password */
$dbname = "boondock"; /* Database name */

// $db_host = "ls-42e6dd7bc9258cf1f8a2cda81cde2a0e754927a0.cpcqn8tguipy.ap-south-1.rds.amazonaws.com"; /* Host name */
// $db_user = "dbmasteruser"; /* User */
// $db_password = "H3oLxffzUWXwTq4LtReo6dH"; /* Password */
// $dbname = "boondock_dev"; /* Database name */
// $dbname2 = "bdk"; /* Database name */

$pdo = new PDO("mysql:host=$db_host;dbname=$dbname", $db_user, $db_password);


$con = mysqli_connect($db_host, $db_user, $db_password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
