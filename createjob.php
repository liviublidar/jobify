<?php require 'header.php';?>

<?php 
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
?>
<form id="addjob" method="post">
	<label for "jobname">Job name: </label>
	<input id="jobname" name="jobname" type="text" "required"/>
	<br/>
	<label for "jobdesc">Job description: </label>
	<input id="jobdesc" name="jobdesc" type="text" "required"/>
	<br/>
	<label for "jobsalary">Salary: </label>
	<input id="jobsalary" name="jobsalary" type="text" "required"/>
	<br/>
	<label for "joblocation">Job Location: </label>
	<input id="joblocation" name="joblocation" type="text" "required"/>
	<br/>
	<label for "category">Category: </label>
	<?php 	$results = $pdo->query('SELECT * FROM categories');
			echo'<select id="category" name="category">';
			foreach ($results as $rows){
				echo '<option value="'.$rows['name'].'">'.$rows['name'].'</option>';
			}
			echo '</select><br/>';
	?>
	<input type="submit" name="addcat" value="Add Job"/>
	<br/>
</form>
<?php
}}
?>
<?php
	if(isset ($_POST['addcat'])){
    	$stmt = $pdo->prepare('INSERT INTO jobs (job_name, job_desc, job_salary, job_location, category_id)
								VALUES (:job_name, :job_desc, :job_salary, :job_location, (SELECT category_id FROM categories WHERE name = :job_category))
					');
    				$criteria = [
						'job_name' => $_POST['jobname'],
						'job_desc' => $_POST['jobdesc'],
						'job_salary' => $_POST['jobsalary'],
						'job_location' => $_POST['joblocation'],
						'job_category' => $_POST['category']
   					 ];
    				
		// Execute the query
		if($stmt->execute($criteria)){
			echo "Job was added.";
		}else{
			echo 'Unable to add job';
		}
	}
				
?>
<?php require 'footer.php';?> 