<?php require 'header.php';?>
<?php
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
	$stmt = $pdo->prepare('DELETE FROM categories WHERE category_id = :category_id');
	$criteria = [
		'category_id' => $_GET['cat']
	];
		if($stmt->execute($criteria)){
			echo 'Category was deleted.';
		}else{
			echo 'Sorry, unable to delete category.';
		}
	}
}
?>
<?php require 'footer.php';?> 