<?php require 'header.php';?>
<form id="registerform" method="post">
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
	<input type="submit" name="register" value="Register"/>
	<br/>
</form>
<?php
	if (isset($_POST['register'])){
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
		echo 'You have successfully registered';
	}
?>

<?php require 'footer.php';?> 
 