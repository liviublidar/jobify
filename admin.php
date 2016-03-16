<?php require 'header.php';?>
<?php
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
		echo'<a href="createjob.php"> Add a job</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="createcategory.php">Add a category</a><br/><br/><br/> ';
		
		
		
		$results = $pdo->query('SELECT * FROM categories');
		foreach ($results as $rows){
		echo '<input type="checkbox" name ="cat" value="'.$rows['category_id'].'" >'.$rows['name'].'<a href="editcategory.php?cat='.$rows['category_id'].'"> Edit category</a>'.'<a href="deletecategory.php?cat='.$rows['category_id'].'"> Delete category</a>'.'<br/>';
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
	if(isset($_POST['catSearch'])){
		echo '<ul>';
		
		$stmt = $pdo->prepare('SELECT * FROM jobs WHERE category_id = :cat');
		$criteria = [
			'cat' => $_POST['cat']
		];
		$stmt->execute($criteria);
		
		while ($rows = $stmt->fetch()) {
			
			echo'<li>Job name: '.$rows['job_name'].', Job Ref: '.$rows['job_id'].', Job salary: '.$rows['job_salary'].', Job Description: '.$rows['job_desc'].', Job Location: '.$rows['job_location'].', Job Cateory: '.$rows['category_id'].'; <a href="editjob.php?id='.$rows['job_id'].'">Edit</a>'.'; <a href="deletejob.php?id='.$rows['job_id'].'">Delete</a>'.'; <a href="listapplicants.php?id='.$rows['job_id'].'">List Applicants</a>'.'</li>';			
			
		}
		echo'</ul>';
		
	}
	else{
		$jobs = $pdo->query('SELECT * FROM jobs');
		echo'<ul>';
		foreach($jobs as $rows){
			echo'<li>Job name: '.$rows['job_name'].', Job Ref: '.$rows['job_id'].', Job salary: '.$rows['job_salary'].', Job Description: '.$rows['job_desc'].', Job Location: '.$rows['job_location'].', Job Cateory: '.$rows['category_id'].'; <a href="editjob.php?id='.$rows['job_id'].'">Edit</a>'.'; <a href="deletejob.php?id='.$rows['job_id'].'">Delete</a>'.'; <a href="listapplicants.php?id='.$rows['job_id'].'">List Applicants</a>'.'</li>';
		}
		echo'</ul>';
	}
	}
	
}
?>

<?php require 'footer.php';?> 
 