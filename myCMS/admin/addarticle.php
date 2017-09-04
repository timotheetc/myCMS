<?php

require('../includes/config.php'); 

if(isset($_POST['submit'])){

	$articletitle = $_POST['articleTitle'];
	$articlecontent = $_POST['articleCont'];
	$pageID = $_POST['pageID'];
	$articleauth = $_SESSION['username'];
	$articleimg = $_POST['articleImageURL'];

	$articletitle = mysqli_real_escape_string($conn, $articletitle);
	$articlecontent = mysqli_real_escape_string($conn, $articlecontent);
	$articleimg = mysqli_real_escape_string($conn, $articleimg);

        date_default_timezone_set("Europe/London");
	$article = '<div class = "articleWrapper">
                         <h3 class = "articleTitle">'.$articletitle.'</h3>
                             <p class = "articleAuth">Posted by: <b>'.$articleauth.'</b>  '.date("h:i:sa").'  '.date("d/m/Y").'</p>
                             <div class = "articleCont">
                             <img class="articleImage" src="'.$articleimg.'" alt="oops"></img>'
                                  .$articlecontent.'
                             </div>
                   </div>';
	

	
	mysqli_query($conn, "UPDATE pages SET pageCont = CONCAT(pageCont, '$article') WHERE pageID='$pageID'")or die(mysql_error());
	$_SESSION['success'] = 'Page Added';
	if(!isset($articleauth)){echo '$articleauth not set!!!!';}
        else {echo $articleauth;}
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
<h1>Add Article</h1>


<?php
$id = $_GET['id'];
$id = mysqli_real_escape_string($conn, $id);
$q = mysqli_query($conn, "SELECT * FROM pages WHERE pageID='$id'");
$row = mysqli_fetch_object($q);
?>

<form action="" method="post">
<input type="hidden" name="pageID" value="<?php echo $row->pageID;?>" />
<p>Title:<br /> <input name="articleTitle" type="text" value="" size="103" /></p>
<p>content<br /><textarea name="articleCont" cols="78" rows="10"></textarea></p>
<p>Image<br /><input name="articleImageURL" type="text" value="http://localhost/simple-cms-master/admin/images/xxx.yyy" size="103" /></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>