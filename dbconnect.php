<?php
$server = '192.168.56.2';
$username = 'student';
$password = 'student';
//The name of the schema we created earlier in MySQL workbench
$schema = 'asse';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);
?>
<?php
$mysqli = new mysqli("192.168.56.2", "student", "student", "asse");
$_SESSION['connection'] = $mysqli;
?>