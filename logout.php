<?php $title='Buh-Bye';?> 
<?php
session_start();
unset($_SESSION['loggedin']);
session_unset();
header('Location: index.php');
?>


You are now logged out
<?php require 'footer.php';?>

