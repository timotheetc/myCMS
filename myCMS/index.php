<?php

require('includes/config.php'); ?>
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
	         <li><a href="<?php echo DIR;?>">Home</a></li>
	                <?php
		        //get the rest of the pages
		        $sql = mysqli_query($conn, "SELECT * FROM pages WHERE isRoot='1' ORDER BY pageID");
		        while ($row = mysqli_fetch_object($sql))
		        {
			      echo "<li><a href=\"".DIR."?p=$row->pageID\">$row->pageTitle</a></li>";
                        }
	                ?>
             </ul>
             <div class="formdiv">
	     <form action="" method="post">
             <span class="title">Username:</span> <input type="text" name="username" value=""/>
             <span class="title">Password:</span> <input type="password" name="password" value=""/>
             <input type="submit" name="loginsubmit" value="Login" class="button" />
	     </form>
	     </div>
        </div>
	<!-- END NAV -->
	
	<div id="content">
	
	<?php	
	//if no page clicked on load home page default to it of 1
	if(!isset($_GET['p'])){
		$q = mysqli_query($conn,"SELECT * FROM pages WHERE pageID='1'");
	} else { //load requested page based on the id
		$id = $_GET['p']; //get the requested id
		$id = mysqli_real_escape_string($conn, $id); //make it safe for database use
		$q = mysqli_query($conn, "SELECT * FROM pages WHERE pageID='$id'");
	}
	
	//get page data from database and create an object
	$r = mysqli_fetch_object($q);
	
	//print the pages content
	echo "<h1>$r->pageTitle</h1>";
	echo $r->pageCont;
	?>
	
	</div><!-- close content div -->

	<div id="footer">	
			<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
	</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>