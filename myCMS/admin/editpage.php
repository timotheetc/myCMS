<?php

require('../includes/config.php'); 

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.DIRADMIN); 
}

if(isset($_POST['submit'])){

	$title = $_POST['pageTitle'];
	$content = $_POST['pageCont'];
	$pageID = $_POST['pageID'];
	
	$title = mysqli_real_escape_string($conn, $title);
	$content = mysqli_real_escape_string($conn, $content);
	
	mysqli_query($conn, "UPDATE pages SET pageTitle='$title', pageCont='$content' WHERE pageID='$pageID'");
	$_SESSION['success'] = 'Page Updated';
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
<h1>Edit Page</h1>

<?php
$id = $_GET['id'];
$id = mysqli_real_escape_string($conn, $id);
$q = mysqli_query($conn, "SELECT * FROM pages WHERE pageID='$id'");
$row = mysqli_fetch_object($q);
?>


<form action="" method="post">
<input type="hidden" name="pageID" value="<?php echo $row->pageID;?>" />
<p>Title:<br /> <input name="pageTitle" type="text" value="<?php echo $row->pageTitle;?>" size="103" />
</p>
<p>content<br /><textarea name="pageCont" cols="100" rows="20"><?php echo $row->pageCont;?></textarea>
</p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>