<html>
<head>
<title>Upload Form</title>
</head>
<body>
	<ul>
		<?php foreach($upload_data as $item => $value):?>
		<li><?php echo $item;?>: <?php echo $value;?></li>
		<?php endforeach; ?>
	</ul>
	<p><?php echo anchor('/board/lists/board/', '업로드!!'); ?></p>
</body>
</html>