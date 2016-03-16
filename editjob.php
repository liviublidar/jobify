<?php require 'header.php';?>
<?php 
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
	$stmt = $pdo->prepare('SELECT * FROM jobs WHERE job_id = :job_id');
	$criteria = [
		'job_id' => $_GET['id']
	];
	$stmt->execute($criteria);
	

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch()) {
			$job_name=$row['job_name'];
			$job_desc=$row['job_desc'];
			$job_salary=$row['job_salary'];
			$job_location=$row['job_location'];
		}
	}
	else{
		echo 'no rows returned';
	}
echo'
<form id="editjob" method="post">
	<label for "jobname">Job name: </label>
	<input id="jobname" name="jobname" type="text" value="'.$job_name.'" "required"/>
	<br/>
	<label for "jobdesc">Job description: </label>
	<input id="jobdesc" name="jobdesc" type="text" value="'.$job_desc.'" "required"/>
	<br/>
	<label for "jobsalary">Salary: </label>
	<input id="jobsalary" name="jobsalary" type="text" value="'.$job_salary.'" "required"/>
	<br/>
	<label for "joblocation">Job Location: </label>
	<input id="joblocation" name="joblocation" type="text" value="'.$job_location.'" "required"/>
	<br/>
	<label for "category">Category: </label>';
	 	$results = $pdo->query('SELECT * FROM categories');
			echo'<select id="category" name="category">';
			foreach ($results as $rows){
				echo '<option value="'.$rows['name'].'">'.$rows['name'].'</option>';
			}
			echo '</select><br/>';
	echo'
	<input type="submit" name="editjob" value="Edit Job"/>
	<br/>
</form>
';
}}
?>
<?php
	if(isset ($_POST['editjob'])){
    	$stmt = $pdo->prepare('UPDATE jobs SET job_name = :job_name, job_desc = :job_desc, job_salary = :job_salary, job_location = :job_location, category_id = (SELECT category_id FROM categories WHERE name = :job_category)
								WHERE job_id = :job_id
					');
    				$criteria = [
						'job_id' => $_GET['id'],
						'job_name' => $_POST['jobname'],
						'job_desc' => $_POST['jobdesc'],
						'job_salary' => $_POST['jobsalary'],
						'job_location' => $_POST['joblocation'],
						'job_category' => $_POST['category']
   					 ];
    				
		// Execute the query
		if($stmt->execute($criteria)){
			echo "Job was eddited.";
		}else{
			echo 'Sorry, unable to edit job';
		}
	}
				
?>
<?php require 'footer.php';?> 