<?php

require('../includes/config.php'); 

if(isset($_POST['submit'])){

	$title = $_POST['pageTitle'];
	$content = $_POST['pageCont'];
	
	$title = mysqli_real_escape_string($conn, $title);
	$content = mysqli_real_escape_string($conn, $content);
	
	mysqli_query($conn, "INSERT INTO pages (pageTitle,pageCont) VALUES ('$title','$content')")or die(mysql_error());
	$_SESSION['success'] = 'Page Added';
	header('Location: '.DIRADMIN);
	exit();

}

?>
<!DOCTYPE html>
<html>
      <head>
            <meta charset="UTF-8">
            <meta name="description" content="Tims CMS">
            <meta name="keywords" content="CMS, content management system">
            <meta name="author" content="Tim Cartwright">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo SITETITLE;?></title>
            <link rel="stylesheet" href="<?php echo DIR;?>style/style.css" type="text/css" />
      </head>
<body>
<div id="wrapper">

<div id="logo"><a href="<?php echo DIR;?>"><img src="images/logo3.png" alt="<?php echo SITETITLE;?>" title="<?php echo SITETITLE;?>" border="0" /></a></div><!-- close logo -->

<!-- NAV -->
<div id="navigation">
<ul class="menu">
<li><a href="<?php echo DIRADMIN;?>">Admin</a></li>
<li><a href="<?php echo DIRADMIN;?>?logout">Logout</a></li>
<li><a href="<?php echo DIR;?>" target="_blank">View Website</a></li>
</ul>
</div>
<!-- END NAV -->

<div id="content">
<hr/>
<?php Print_r ('<b>Logged in as: '.$_SESSION['username'].'</b>');?>
<hr/>
<h1>Add Page</h1>

<form action="" method="post">
<p>Title:<br /> <input name="pageTitle" type="text" value="" size="103" /></p>
<p>content<br /><textarea name="pageCont" cols="100" rows="20"></textarea></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>