<!DOCTYPE html>
<html>
<head>
	<title>Images</title>
</head>
<body>
	<?php if(count($images)): ?>
		<?php foreach ($images as $img):?>
			<img src="<?php echo $img->photo;?>">
		<?php endforeach; ?>
	<?php else: ?>
		<p>No image found</p>
	<?php endif; ?>
</body>
</html>