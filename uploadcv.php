<?php $title="Upload";?>
<?php
require'header.php';
require 'dbconnect.php';
?>
<?php
$userid="0";

$stmt = $pdo->prepare('SELECT * FROM users WHERE mail = :mail');
	$criteria = [
	'mail' => $_SESSION['email']
	];
	$stmt->execute($criteria);

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch()) {
			$user_id = $row['user_id'];
		}
	}




if ($stmt->rowCount() > 0) {
	while ($row = $stmt->fetch()) {
		$userid = $row['user_id'];
	}
}


$target_dir = "users/";
$target_file = $target_dir . $userid. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 8000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "doc" && $fileType != "pdf" && $fileType != "docx") {
    echo "Sorry, only doc, pdf & docx files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<?php require 'footer.php';?>