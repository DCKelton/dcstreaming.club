<?php
	
	require '../modules/sql.module.php';
	include '../modules/invite.module.php';
	
	$claim = 'CLAIMED';
	$code = $_POST["InviteCode"];
	$translate = $_GET['lang'];

	if (isset($_POST['submit'])){
																					
    if (empty($_POST["InviteCode"])) {
      $codeErr = "You need to be invited. Where is your Invitation Code?";
      } else {		  
	       $code = $_POST["InviteCode"];
		   $sql = "SELECT * FROM invites WHERE codes = '$code'";
           $res = mysqli_query($link, $sql);
           $count = mysqli_num_rows($res);
            if($count == 0){
			$codeErr = "Invalid Invite Code";												 
		    }elseif ($count == 1){ 
			    $sql = "SELECT * FROM invites WHERE codes = '$code' AND status != '$claim'";	
				$res = mysqli_query($link, $sql);
                $count = mysqli_num_rows($res);
                 if ($count == 1){				
			    $updatecode = "UPDATE invites SET status = 'CLAIMED' WHERE codes = '$code'"; 
                  if ($link->query($updatecode) === TRUE) {
                  header('Location: https://auth.mystreamnet.club/?page=join&user='.$code.'&lang='.$translate);
                 } else {
                 echo "Error: " . $updatecode . "<br>" . $link->error;
                 }
				
			}else{
				$codeErr = "This Invite Code has already been claimed!";
			}

		   
	}
	}
	}
	
?>

<!DOCTYPE html>
<html lang="en">

	<head>
	
		<!-- ================================= META DATA =============================== -->

                <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Flammang Yves">
        <meta name="google-site-verification" content="rubgHIvlVrrqFWt6ps5IQM-6aJ0A2oygfKSYcqWLGCk" />

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="../images/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../images/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../images/icons/favicon-16x16.png">
        <link rel="manifest" href="../images/icons/site.webmanifest">
        <link rel="mask-icon" href="../images/icons/safari-pinned-tab.svg" color="#160808">
        <meta name="msapplication-TileImage" content="../images/icons/ms-icon-144x144.png">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="theme-color" content="#ffffff">

		

		<title>Join StreamNet | Secure</title>

		<!--  CSS  -->
		
		<link href="../css/bootstrap.css" rel="stylesheet"/>
        <link href="../css/plexcolors.css" rel="stylesheet"/>


        <!--  JavaScripts -->
		
		<!--  Custom CSS  -->
		
        <style>

            body{
            background: url(../images/covers/image<?php $random = rand(1,51); echo $random; ?>.jpg) no-repeat center center fixed;
            background-color: #282A2D;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            overflow: hidden;
            }
				
        </style>
		

	</head>
	
	<body id="join"> 
      
        <div style="background-image: linear-gradient(to bottom, transparent 0%, black 100%);height: 100vh;">
        <div id="main" class="text-center">
 			<div style="padding-top:35px;" class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" align="center">
			          <img src="../images/logo-navbar.png" alt="STREAMNET" width="350" class="img-responsive">
					        </div>
					 	    <?php echo $lang['invitepage']; ?>
							<form method="post" action = "<?php $_PHP_SELF ?>">
							<div class="form <?php echo (!empty($codeErr)) ? 'has-error' : ''; ?>">
          					       <?php echo $lang['invitepage2']; ?>
						    <span class="help-block"><?php echo $codeErr; ?></span>
          					    </div>
							<?php echo $lang['invitepage3']; ?>							
			    </div>
            </div>
        </div>
        </div>
		
		<?php		
             				  		
		 $link->close();
        ?>
		
		<!--  Scripts  -->
        <!--  Bootstrap core JavaScript  -->
        <!--  Placed at the end of the document so the pages load faster  -->
		
        <script src="../js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/docs.min.js" type="text/javascript"></script>
        <script src="../js/app.js" type="text/javascript"></script>

    </body>
</html>
										
										
										
										