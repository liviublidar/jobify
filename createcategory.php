<?php require 'header.php';?>

<?php 
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
?>
<form id="addcat" method="post">
	<label for "catname">Category name: </label>
	<input id="catname" name="catname" type="text" "required"/>
	<br/>
	<label for "catdesc">Category description: </label>
	<input id="catdesc" name="catdesc" type="text" "required"/>
	<br/>
	<input type="submit" name="addcat" value="Add Category"/>
	<br/>
</form>
<?php
}}
?>
<?php
	if(isset ($_POST['addcat'])){
    	$stmt = $pdo->prepare('INSERT INTO categories (name, `desc`)
								VALUES (:category_name, :category_desc)
					');
    				$criteria = [
						'category_name' => $_POST['catname'],
						'category_desc' => $_POST['catdesc']
   					 ];
    				
		// Execute the query
		if($stmt->execute($criteria)){
			echo "Category Was Added.";
		}else{
			echo 'Unable to Add Category. Please try again.';
		}
	}
				
?>
<?php require 'footer.php';?> 