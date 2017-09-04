<?php

require('../includes/config.php');
//process add user form----------+
if(isset($_POST['submit'])){
        if($_POST['username'] != '' && $_POST['password'] != ''){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$accessLevel = $_POST['accessLevel'];
	$username = mysqli_real_escape_string($conn,$username);
	$password = mysqli_real_escape_string($conn,$password);
	$password = md5($password);
	
	$sql = "SELECT username FROM members WHERE username = '$username'";

        if($result = mysqli_query($conn, $sql))
        {
                    $rowcount = mysqli_num_rows($result);
                    if($rowcount == 0){
                    mysqli_query($conn, "INSERT INTO members (username,password, access_level) VALUES ('$username','$password', '$accessLevel')")or die(mysql_error());
                    if($accessLevel == 1){
	                                  $_SESSION['success'] = 'User <b>'.$username.'</b> Added, with priviledged level access';
	                                  header('Location: '.DIRADMIN);
	                                  exit();
                                          }
                    else{
	                                  $_SESSION['success'] = 'User <b>'.$username.'</b> Added, with administrator level access';
	                                  header('Location: '.DIRADMIN);
	                                  exit();
                                          }

                    }
                    else {
                          $_SESSION['error'] = "Username already exists, please try another.";
                          }
        }
    }
    else {
         $_SESSION['error'] = "An input field was empty!";
         }
}

//make sure user is logged in, function will redirect use if not logged in
login_required();

//if logout has been clicked run the logout function which will destroy any active sessions and redirect to the login page
if(isset($_GET['logout'])){
	logout();
}

//run if a page deletion has been requested
if(isset($_GET['delpage'])){
		
	$delpage = $_GET['delpage'];
	$delpage = mysqli_real_escape_string($conn, $delpage);
	$sql = mysqli_query($conn, "DELETE FROM pages WHERE pageID = '$delpage'");
    $_SESSION['success'] = "Page Deleted"; 
    header('Location: ' .DIRADMIN);
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

            <script language="JavaScript" type="text/javascript">
	    function delpage(id, title)
	    {
	     if (confirm("Are you sure you want to delete '" + title + "'"))
	        {
		  window.location.href = '<?php echo DIRADMIN;?>?delpage=' + id;
	         }
              }
          </script>
    </head>
<body>

<div id="wrapper">

<div id="logo"><a href="<?php echo DIRADMIN;?>"><img src="images/logo3.png" alt="<?php echo SITETITLE;?>" border="0" /></a></div>

<!-- NAV -->
<div id="navigation">
	<ul class="menu">
		<li><a href="<?php echo DIRADMIN;?>">Admin</a></li>		
		<li><a href="<?php echo DIR;?>" target="_blank">View Website</a></li>
		<li><a href="<?php echo DIRADMIN;?>?logout">Logout</a></li>
	</ul>
</div>
<!-- END NAV -->

<div id="content">

<?php //show any messages if there are any. 
      messages();
      echo "<pre>"; print_r($_REQUEST) ;  echo "</pre>";?>
<hr/>
<?php Print_r ('<b>Logged in as: '.$_SESSION['username'].'</b>');?>
<hr/>
<h1>Manage Pages</h1>


<table>
<tr>
	<th><strong>Title</strong></th>
	<th><strong>Action</strong></th>
</tr>

<?php
$sql = mysqli_query($conn, "SELECT * FROM pages ORDER BY pageID");
while($row = mysqli_fetch_object($sql))
{
	echo "<tr>";
		echo "<td>$row->pageTitle</td>";
		if($row->pageID == 1){ //home page hide the delete link
			echo "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a></td>";
		} elseif($row->pageID == 2){ //Article page adds add article link
			echo "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a> | 
                        <a href=\"javascript:delpage('$row->pageID','$row->pageTitle');\">Delete</a> |
                        <a href=\"".DIRADMIN."addarticle.php?id=$row->pageID\">Add Article</a> </td>";
		} else {echo "<td><a href=\"".DIRADMIN."editpage.php?id=$row->pageID\">Edit</a> |
                        <a href=\"javascript:delpage('$row->pageID','$row->pageTitle');\">Delete</a></td>";
                }
		
	echo "</tr>";
}
?>
</table>

<p><a href="<?php echo DIRADMIN;?>addpage.php" class="button">Add Page</a></p>
<hr/>
<h1>Add User</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <p>Username:<br /> <input name="username" type="text" value="" size="20" /></p>
      <p>Password:<br /> <input name="password" type="text" value="" size="20" /></p>
      <h5>Access level</h5>
      <p><input type="radio" name="accessLevel" value=1 checked/>Privileged</p>
      <p><input type="radio" name="accessLevel" value=2 \/>Administrator</p>
      <p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>
</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SITETITLE.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>