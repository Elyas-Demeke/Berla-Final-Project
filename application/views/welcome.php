<!-- 				<form method="post" action="welcome/photo">
					
				<div class="upload-input">
					<input type="file" name="photo" class="form-control">
				</div>
				<button type="submit">submit</button>
				</form>
				 -->
<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php 
if(!empty($error))
echo $error;


	echo form_open_multipart('Welcome/uploadPic');
	echo form_upload(['name'=>'userfile', 'value'=>'Save']);
	echo form_error('userfile','<div class="text-danger">','</div>');

	echo form_submit(['name'=>'submit','value'=>'PUBLISH IMAGE']);
	echo anchor("welcome/viewImages",'View Images');
	echo form_close();
	?>
<!-- <input type="file" name="userfile" size="2000" />

<br /><br />

<input type="submit" value="upload" />

</form>
 -->
</body>
</html>				 