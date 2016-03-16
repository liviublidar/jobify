<?php $title='Job Finder';?> 
<?php require 'header.php';?>
<?php 
$mail=$_SESSION['email'];
$cover = $_POST['cover'];

$stmt = $pdo->prepare('UPDATE users SET cover_letter=:cover WHERE mail = :mail');
	
$criteria = [
	'mail' => $_SESSION['email'],
	'cover'=> $cover
];
$stmt->execute($criteria);
	
?>
cover updated
<?php require 'footer.php';?>