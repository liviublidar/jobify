<?php require 'header.php';?>
<?php 
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
	$stmt = $pdo->prepare('SELECT * FROM categories WHERE category_id = :category_id');
	$criteria = [
		'category_id' => $_GET['cat']
	];
	$stmt->execute($criteria);
	

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch()) {
			$cat_name=$row['name'];
			$cat_desc=$row['desc'];
		}
	}
	else{
		echo 'no rows returned';
	}
echo'
<form id="editcat" method="post">
	<label for "catname">Category name: </label>
	<input id="catname" name="catname" type="text" value="'.$cat_name.'" "required"/>
	<br/>
	<label for "catdesc">Category description: </label>
	<input id="catdesc" name="catdesc" type="text" value="'.$cat_desc.'" "required"/>
	<br/>
	<input type="submit" name="editcat" value="Edit Category"/>
	<br/>
</form>
';
}}
?>
<?php
	if(isset ($_POST['editcat'])){
    	$stmt = $pdo->prepare('UPDATE categories SET name = :cat_name, `desc` = :cat_desc
								WHERE category_id = :cat_id
					');
    				$criteria = [
						'cat_id' => $_GET['cat'],
						'cat_name' => $_POST['catname'],
						'cat_desc' => $_POST['catdesc']
   					 ];
    				
		// Execute the query
		if($stmt->execute($criteria)){
			echo "Category was eddited.";
		}else{
			echo 'Sorry, unable to edit category';
		}
	}
				
?>
<?php require 'footer.php';?> 