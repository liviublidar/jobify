<?php $title='Job Finder';?> 
<?php require 'header.php';?>
<form id="catSearch" method="post">
<p>Filter by category: </p>
<?php 
$results = $pdo->query('SELECT * FROM categories');
foreach ($results as $rows){
		echo '<input type="checkbox" name ="cat" value="'.$rows['category_id'].'" >'.$rows['name'].'<br/>';
	}
?>
<input type="submit" name="catSearch" value="Go">
</form>
<div id="jobs" style="display:block;">
	<?php
	$categories = $pdo->query('SELECT * FROM categories');
	$cat_num = $categories->rowCount();
	$cat_array = [];
	for ($x = 1; $x <= $cat_num; $x++) {
		$cat_array[$x] = $x;
	}
	if(isset($_POST['searchkey'])){
		echo '<ul>';
		/*
		$keywords = 'Northampton, manager, Pilot';
		$result = array();
		$keyword_tokens = explode(',', $keywords);
		foreach($keyword_tokens as $keyword) {
			$keyword = mysqli_real_escape_string($_SESSION['connection'], trim($keyword));
			$sql = "SELECT * FROM jobs WHERE (job_name LIKE'%$keyword%' OR job_desc LIKE'%$keyword%' OR job_salary LIKE'%$keyword%' OR job_location LIKE'%$keyword%' )";
			// query and collect the result to $result
			// before inserting to $result, check if the id exists in $result.
			// if yes, skip.
		}
		$display = var_dump($result);
		echo $display;
		*/
	}
	
	else{
	if(isset($_POST['catSearch'])){
		echo '<ul>';
		
		$stmt = $pdo->prepare('SELECT * FROM jobs WHERE category_id = :cat');
		$criteria = [
			'cat' => $_POST['cat']
		];
		$stmt->execute($criteria);
		
		while ($rows = $stmt->fetch()) {
			
			echo'<li>Job name: '.$rows['job_name'].', Job Ref: '.$rows['job_id'].', Job salary: '.$rows['job_salary'].', Job Description: '.$rows['job_desc'].', Job Location: '.$rows['job_location'].', Job Cateory: '.$rows['category_id'].'; <a href="apply.php?id='.$rows['job_id'].'">Apply</a>'.'</li>';			
			
		}
		echo'</ul>';
		
	}
	else{
		$jobs = $pdo->query('SELECT * FROM jobs');
		echo'<ul>';
		foreach($jobs as $rows){
			echo'<li>Job name: '.$rows['job_name'].', Job Ref: '.$rows['job_id'].', Job salary: '.$rows['job_salary'].', Job Description: '.$rows['job_desc'].', Job Location: '.$rows['job_location'].', Job Cateory: '.$rows['category_id'].'; <a href="apply.php?id='.$rows['job_id'].'">Apply</a>'.'</li>';
		}
		echo'</ul>';
	}
	}
	?>
	
</div>

<?php require 'footer.php';?>

