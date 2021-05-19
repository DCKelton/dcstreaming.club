<html lang="en">
<head>

<title>StreamNet | Dashboard</title>

<!--  Meta  -->

<?php require_once 'inc/meta.php'; 
include_once "inc/security/config.php";
include_once "inc/security/project-security.php";

?>


<!--  CSS  -->

<link href="css/bootstrap.css" rel="stylesheet"/>
<link href="css/plexcolors.css" rel="stylesheet"/>
<link href="css/iframe.css" rel="stylesheet"/>
<link href="css/fontawesome/css/all.min.css" rel="stylesheet">




<!--  GetServerStaus  -->

<?php require_once 'inc/modules/getServerStatus.module.php'; ?> 

   <!--  Welcome Mesaage  -->

   <script>

      setTimeout(function() {
           $('#welcome , #welcome2').fadeOut('fast');
            }, 10000);

   </script>



<?php   

    //Request Avatar and Username

	include_once('dynamic_management.module.php');

	$management_items = dynamicManagement($User);
    $loggeduser=$User->getUsername();
		
		
	//Insert and Update Logged In Status into Database

        include_once('sql.module.php');	
		
        $loggedin="SELECT * FROM users WHERE plexusername='$loggeduser'";
        $result = $link->query($loggedin);

            if ($result->num_rows > 0) {
            // output data of each row
                 while($row = $result->fetch_assoc()) {                                                    
                       $lastlogged = $row["logged_in"];                                                            
                       }
                } else {
                //echo "0 results";
						        }

    $newdate = date_create($lastlogged);
    $date_db = date('Y-m-d H:i:s');
	
    $logged="UPDATE users SET logged_in='$date_db' WHERE plexusername='$loggeduser'";
      if ($link->query($logged) === TRUE) {
            //echo "New record updated successfully";
              } else {
                 echo "Error: " . $logged . "<br>" . $link->error;
              }


?>

 <!--  Custom CSS  -->
 
  <style>
  
      #container_iframe {
        background-image: url("images/loader.gif");
	background-position: center;
	background-size: 50px;
	background-repeat: no-repeat;               				
      }
     
      .hover-item:hover {
	background-color: #282A2D;
      }


</style>

</head>

<body id="body_iframe"  onload="getServerStatus ()">

<!--  NavBar  -->

     <?php require_once 'inc/nav_main.php'; ?>

<!--  Main Page Iframe  -->
<?php  
 
        if ($loggeduser == ($GLOBALS['ini_array']['plexowner'])) {

?>


	<div id="container_iframe" style="background-color:black;">
          <iframe id="iframe" name="frame" frameBorder="0" scrollbar="no" src="./tautulli"></iframe>
        </div>

<?php

} else {

?>

<div id="container_iframe" style="background-color:black;">
          <iframe id="iframe" name="frame" frameBorder="0" scrollbar="no" src="./?page=media"></iframe>
        </div>

<?php
}
?>



<!--  Footer  -->

	<?php require_once 'inc/footer.php'; ?>

<!--  Scripts  -->
<!--  Bootstrap core JavaScript  -->
<!--  Placed at the end of the document so the pages load faster  -->

<script src="js/jquery-3.4.1.min.js"></script>
<script>
$(function(){
    $('li').click(function(){
        $('li.active').removeClass('active');
        $(this).addClass('active');
    });
});
</script>

<script src="js/bootstrap.min.js"></script>
<script src="js/docs.min.js"></script>
<script src="js/app.js"></script>

<?php

     $link->close();

?>
</body>
</html>
