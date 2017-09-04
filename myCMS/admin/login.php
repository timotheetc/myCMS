<?php

 require('../includes/config.php'); 
if(logged_in()) {header('Location: '.DIRADMIN);}
if(!isset($_POST['submit'])){$_POST['submit'] = '';}
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
            <link rel="stylesheet" href="<?php echo DIR;?>style/login.css" type="text/css" />
      </head>
<body>
<div class="lwidth">
	<div class="page-wrap">
		<div class="content">
		
		<?php 
		if($_POST['submit']) {
			login($_POST['username'], $_POST['password']);
		}
		?>

<div id="login">
	<p><?php echo messages();?></p>        
	<form method="post" action="">
	<p><label><strong>Username</strong><input type="text" name="username" /></label></p>
	<p><label><strong>Password</strong><input type="password" name="password" /></label></p>
	<p><br /><input type="submit" name="submit" class="button" value="login" /></p>                       
	</form>	  	  
</div>
		
		</div>	
		<div class="clear"></div>		
	</div>
<div class="footer">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>	
</div>
</body>
</html>