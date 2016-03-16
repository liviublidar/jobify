<?php require 'header.php';?>
<?php
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
	$results = $pdo->query('SELECT user_id FROM applications WHERE job_id = '.$_GET['id']);
	$userArray = [];
	foreach ($results as $row) {
		$userArray[] = $row['user_id'];
		//echo $row['user_id'];
		$users = $pdo->query('SELECT * FROM users WHERE user_id = '.$row['user_id']);
		foreach($users as $applicants){
			echo'<li> Applicant name:'.$applicants['fname'].' '.$applicants['sname'].';E-mail:'.$applicants['mail'].'; phone:'.$applicants['phone_no'].'; City:'.$applicants['adress'].'; Cover Letter:'.$applicants['cover_letter'];
		}
	}
}}
?>

<?php require 'footer.php';?> 