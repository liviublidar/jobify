<?php require 'header.php';?>
<?php
if(isset($_SESSION['admin'])){
	if($_SESSION['admin'] == 'y'){
	$stmt = $pdo->prepare('DELETE FROM jobs WHERE job_id = :job_id');
	$criteria = [
		'job_id' => $_GET['id']
	];
		if($stmt->execute($criteria)){
			echo 'Job was deleted.';
		}else{
			echo 'Sorry, unable to delete job';
		}
	}
}
?>
<?php require 'footer.php';?> 