<?php require 'header.php';?>
<?php 
if(isset ($_SESSION['loggedin'])){
	if(($_SESSION['loggedin'])== true){
		
		
		$stmt = $pdo->prepare("INSERT INTO applications(job_id, user_id)
								VALUES(:job_id,
								(SELECT user_id from users
								WHERE mail = :mail))");
		$criteria = [
			'mail' => $_SESSION['email'],
			'job_id' => $_GET['id']
		];
		$stmt->execute($criteria);
		echo'you have applied for this this job: job ref = '.$_GET['id'];
		echo $_SESSION['email'];
		echo $stmt->errorInfo()[2];
	}
	
}
else{
	if (isset($_POST['apply'])){
		$stmt = $pdo->prepare("INSERT INTO users(mail, pass, adress, fname, sname, phone_no, cover_letter)
								VALUES(:mail, :pass, :adress, :fname, :sname, :phone_no, :cover_letter)");
		$criteria = [
			'mail' => $_POST['email'],
			'pass' => $_POST['pass'],
			'adress' => $_POST['city'],
			'fname' => $_POST['fname'],
			'sname' => $_POST['sname'],
			'phone_no' => $_POST['phone'],
			'cover_letter' => $_POST['covletter']
		];
		$stmt->execute($criteria);
		
		$stmt2 = $pdo->prepare("INSERT INTO applications(job_id, user_id)
								VALUES(:job_id,
								(SELECT user_id from users
								WHERE mail = :mail))");
		$criteria = [
			'mail' => $_POST['email'],
			'job_id' => $_GET['id']
		];
		$stmt2->execute($criteria);
		echo'you have applied for this this job: job ref = '.$_GET['id'].'<br/> You now have an account created and you can login with your details and apply for other jobs using th';
		
	}
	
	
	echo'<form id="applyform" method="post">
	<label for "mail">E-mail adress: </label>
	<input id="mail" name="email" type="email" "required"/>
	<br/>
	<label for "pass">Password: </label>
	<input id="pass" name="pass" type="password" "required"/>
	<br/>
	<label for "fname">Firstname: </label>
	<input id="fname" name="fname" type="text" "required"/>
	<br/>
	<label for "sname">Surname: </label>
	<input id="sname" name="sname" type="text" "required"/>
	<br/>
	<label for "city">City: </label>
	<input id="city" name="city" type="text" "required"/>
	<br/>
	<label for "phone">Phone number: </label>
	<input id="phone" name="phone" type="text" "required"/>
	<br/>
	<label for "cover">Cover letter: </label>
	<input id="cover" name="covletter" type="text" "required"/>
	<br/>
	<input type="submit" name="apply" value="Apply"/>
	<br/>
	</form>';
}
?>
<?php require 'footer.php';?> 