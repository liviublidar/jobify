<?php $title='Jobify Homepage'; ?> 
<?php require 'header.php';?>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
	if(isset ($_SESSION['loggedin'])){
		if(($_SESSION['loggedin'])== true){
?>
<div id="userContent">
	<h3>Profile</h3>
	<p>To upload a profile picture, rename the file 'a.jpg'.</p>
	<form id="imgForm" action="uploadimg.php" method="post" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload"><br/>
		<input type="submit" value="Upload Image" name="upimg"/>
	</form>
	
	<p>To upload a cv, rename the cv file 'a.docx'.</p>
	<form id="cvForm" action="uploadcv.php" method="post" enctype="multipart/form-data">
		<input type="file" name="fileToUpload" id="fileToUpload"><br/>
		<input type="submit" value="Upload Cv" name="upcover"/>
	</form>
	
	<p>To change your cover letter, edit this text box.</p>
	<form id="coverForm" action="uploadcover.php" method="post">
		<input type="textbox" name="cover" id="cover"><br/>
		<input type="submit" value="Upload Cover" name="upimg"/>
	</form>
</div>

<?php
		}
	}
?>

<div class="fb-page" data-width="500" data-height="630" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>



<?php require 'footer.php';?>
