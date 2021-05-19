<?php
	
	require 'modules/sql.module.php';
        include_once "security/config.php";
        include_once "security/project-security.php";
        include 'modules/common.module.php';

	
	//INVITE CODE VALIDATION
	
	if (!empty($_GET)) {
        $code = $_GET['user']; //check if the user enterd a valid invite code
	}
	
	$claim = 'CLAIMED';
	
		   $sql = "SELECT * FROM invites WHERE codes = '$code' AND status = '$claim'";
           $res = mysqli_query($link, $sql);
           $count = mysqli_num_rows($res);
           if($count == 1){
			  
        //Plex FUNCTIONS

        function joinPlex($username, $email, $password) {
            require_once('PlexUser.class.php'); //Ensure that the PlexUser class has been loaded.
            $ticketData = array(
                'user[email]'=> $email,
                'user[username]'=> $username,
                'user[password]'=> $password);

            $ch = curl_init('https://plex.tv/users.json');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($ticketData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Plex-Client-Identifier: 5aea70da-7c8d-4866-ba78-f5925df92b40',
                'Content-Type: application/x-www-form-urlencoded'));
            $output = curl_exec($ch);

            $result = json_decode($output, true);
            if (array_key_exists("error",$result)){                 
	          print '<p style="color:red; background-color:#000000B3; padding:0.5% 0.5%;">There was an error creating the account. Username or Email has already been taken.<br/>Please try again.</p><br/>';
                //print_r($result); // Haven't done any real error capturing here. Print the unformated error to the user. I don't suspect this will happen often anyway.
            } elseif (array_key_exists("user",$result)) {
                return true;
            } else {
                print '<p style="color:red; background-color:#000000B3; padding:0.5% 0.5%;">There was an error creating the account. Username or Email has already been taken.<br/>Please try again.</p><br/>';
                //print_r($result);
            }
			return false;
        }

        function reloadPage($post = false) {
            if ($post) {
                $_POST = null;
                unset($_POST);
            }
            header('Location: '.$_SERVER['REQUEST_URI']);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //CURL POST Function
		
        function httpPost($url,$params,$header = null){
            $ch = curl_init();

            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch,CURLOPT_HEADER, false);
            curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch,CURLOPT_TIMEOUT, 30);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$params);

            $output=curl_exec($ch);

            curl_close($ch);
            return $output;
        }

        function alert($alert) {
            // Alert the user of something using javascript.
            echo '<script language="javascript">';
            echo 'alert("'.$alert.'")';
            echo '</script>';
        }
		
    ?>


<!DOCTYPE html>
<html lang="en">

	<head>
	
		<!--  Meta  -->
		
		<?php require_once 'inc/meta.php'; ?>

		<title>Join StreamNet | Secure</title>

		<!--  CSS  -->
		
		<link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/plexcolors.css" rel="stylesheet"/>


        <!--  JavaScripts -->
		
        <script>

            function create() {
                var elements = document.getElementsByClassName("createAccount");
                for (i = 0; i < elements.length; i++) {
                    if (document.getElementById("plexCreate").checked) {
                        elements[i].classList.remove("hide");
                        document.getElementById("submit").innerHTML = '<i class="fas fa-user-plus"></i>&nbsp;<?php echo $lang['konto']; ?>';
                        document.getElementById("email").focus();
						document.getElementById("email").placeholder = "Plex Email";
                       // document.getElementById("last_name").required = true;
                        // document.getElementById("first_name").required = true;
                    } else {
                         elements[i].className += " hide";
                         document.getElementById("submit").innerHTML = '<i class="fas fa-user-plus"></i>&nbsp;<?php echo $lang['details']; ?>';
						 document.getElementById("email").placeholder = "<?php echo $lang['usernamer']; ?>";
						 document.getElementById("email").focus();
                        }
                }
            }
        </script>

		
		<!--  Custom CSS  -->
		
        <style>

            body{
            background: url(images/covers/image<?php $random = rand(1,51); echo $random; ?>.jpg) no-repeat center center fixed;
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
 			<div style="padding-top:25px;" class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" align="center">
			          <img src="images/logo-navbar.png" alt="STREAMNET" width="350" class="img-responsive">
					        </div>
					 					<div class="modal-body">

		                <?php

       		         // Check if there are any alerts from the previous page load.

                            if (isset($_SESSION['alert'])) {
                                alert($_SESSION['alert']); // Create the alert.
                                unset($_SESSION['alert']); // Remove the alert so it can be reused.
                            }

                         // Check our progress indicators.

                            if (!isset($_SESSION['PlexLogin'])) {
                                       $_SESSION['PlexLogin'] = false; // Reset the Plex login status.
                            }

                            if (!isset($_SESSION['JoinComplete'])) {
                                       $_SESSION['JoinComplete'] = false; // Reset the join completion status.
                            }

						    if (!isset($_SESSION['accountCreated'])) {
                                       $_SESSION['accountCreated'] = false;
                            }

                            if (!$_SESSION['PlexLogin']) {

                                 // Do some validations here if they logged into Plex or not.

                                    if (isset($_POST) && $_POST['formname'] == 'login') {
                                        if ($_POST['plexCreate']) {
											$join = false;

											// Email Validation 
											
                                            if (empty($_POST["PlexEmail"])) {
                                                       $emailErr = "Email is required.";
                                            } else {
                                              $email = test_input($_POST["PlexEmail"]);
                                                if ($email != $_POST["PlexEmail"]) {
                                                    $emailErr = "Invalid email format.";
                                                } else {
                                                  // check if e-mail address is well-formed
                                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                         $emailErr = "Invalid email format.";
                                                    }
                                                }
                                            }
                                
                                            // Validate password
											
                                              if(empty(trim($_POST["PlexPassword"]))){
                                                 $pwdErr = " Password is required. ";     
                                                 } elseif(strlen(trim($_POST["PlexPassword"])) < 8){
                                                   $pwdErr = "Password must have at least 8 characters.";
                                                   } else{
                                                     $pwd = trim($_POST["PlexPassword"]);
                                                     }
    
                                            // Validate confirm password
											
                                              if(empty(trim($_POST["PlexPasswordConfirm"]))){
                                                   $pwdConErr = " Please confirm password. ";     
                                                   } else{
                                                      $pwdConfirm = trim($_POST["PlexPasswordConfirm"]);
                                                    if(empty($pwdErr) && ($pwd != $pwdConfirm)){
                                                     $pwdConErr = " Password did not match. ";
                                                      }
                                                   }
												   
												   
										    // Username validation
											
                                            if (empty(trim($_POST["PlexUsername"]))){
                                                $usrErr = " Username is required. ";
                                                } elseif(strlen(trim($_POST["PlexUsername"])) < 6){
                                                   $usrErr = "Username must have at least 6 characters.";
                                                    } else {
                                                       $username = trim($_POST["PlexUsername"]);
                                                 }

                                                $username = test_input(trim($_POST["PlexUsername"]));
                                                if ($username != trim($_POST["PlexUsername"])) {
                                                    $usrErr = " Invalid username, please do not use special characters in your username. ";
                                                } else {
                                                    if (!filter_var($username, FILTER_SANITIZE_STRING)) {
                                                        $usrErr = " Invalid username, please do not use special characters in your username. ";
                                                    }
                                                }
											
                                            if (isset($emailErr) || isset($usrErr) || isset($pwdErr) || isset($pwdConErr)) {
                                                $_SESSION['alert'] = "Please ensure you enter all details in the form accurately:\\n" . $emailErr . $usrErr . $pwdErr . $pwdConErr;
                                                reloadPage(true);
                                            } else {																						                                                               												
                                                $join = joinPlex($username, $email, $pwd);

                                                //Insert Into DataBase	
												
                                                $plexmail = $email;					            
												$user = $username;									
                                                $delete = "DELETE FROM users WHERE plex_mail='$email' OR plex_username='$username'";												
                                                    if ($link->query($delete) === TRUE) {
                                                          //echo "New record updated successfully";
                                                          } else {
                                                                 echo "Error: " . $delete . "<br>" . $link->error;
                                                                }
											    												
                                                $update = "INSERT INTO users (plexmail, plexusername) VALUES ('$plexmail', '$user')";                                                                          
                                                       if ($link->query($update) === TRUE) {
                                                            //echo "New record updated successfully";
                                                          } else {
                                                                  echo "Error: " . $update . "<br>" . $link->error;
                                                                }												
										    }				                                            									    										
                                    } else {											
										 $join = true;
                                         
										  //Insert Into DataBase
										 
                                         $email = $_REQUEST['PlexEmail'];																			 
                                         $update = "INSERT INTO users (plexmail) VALUES ('$email')";                                                                           
                                                if ($link->query($update) === TRUE) {
                                                      //echo "New record updated successfully";
                                                   } else {
                                                          echo "Error: " . $update . "<br>" . $link->error;
                                                        }										 
										}										
										// This is a post. Does the information validate?
										
										if ($join) {
    										
											require_once('PlexUser.class.php'); //Ensure that the PlexUser class has been loaded.
											if (isset($User)){
												$User = unserialize($_SESSION['streamnetuser']); //Workaround for bad code design for PlexUserClass
											}

											if (!isset($_SESSION['NewUser'])){
												$NewUser = new PlexUser(null, $_POST['PlexEmail'], $_POST['PlexPassword']);
												$_SESSION['NewUser'] = serialize($NewUser);
											} else {
												$NewUser = unserialize($_SESSION['NewUser']);
											}

											if (isset($User)){
												$_SESSION['streamnetuser'] = serialize($User); //Workaround for bad code design for PlexUserClass
											} else {
												unset($User);
												unset($_SESSION['streamnetuser']);
											}
											if ($NewUser->getUsername() != ''){
												$_SESSION['PlexLogin'] = true;																							  
												reloadPage(true);
												
											} else {
												$_SESSION['alert'] = "Username and Password were incorrect.";																  
												unset($_SESSION['NewUser']);
                                                $del = "DELETE FROM users ORDER BY id DESC LIMIT 1";
	                                                if ($link->query($del) === TRUE) {
                                                         //echo "New record updated successfully";
                                                             } else {
                                                                     echo "Error: " . $del . "<br>" . $link->error;
                                                                  }												
											}
										}
                                    }						    
						?>
                            <?php echo $lang['jointitle']; ?>						   
                            <form method="post" action = "">												                               
          				    <?php echo $lang['joinform']; ?>

                            <?php							
                                } elseif (!$_SESSION['JoinComplete']) {
                                    // Display the final page.
                                    if (isset($_POST) && $_POST['formname'] == 'details') {
                                        // This is a form submission. Check the data.
                                        if (empty($_POST["FName"]) || empty($_POST["LName"])) {
                                            $nameErr = "Name is required.";
                                        } else {
                                            $name = $_POST["FName"] . " " . $_POST["LName"];
                                            $name = test_input($name);
                                            // check if name only contains letters and whitespace
                                            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                                                $nameErr = "Invalid name, only letters and white space allowed.";
                                            } else {
                                                //Name validates.
                                                $_SESSION['FName'] = test_input($_POST["FName"]);
                                                $_SESSION['LName'] = test_input($_POST["LName"]);
                                            }
                                        }
                                        if (empty($_POST["PlexEmail"])) {
                                            $emailErr = "Email is required.";
                                        } else {
                                            $email = test_input($_POST["PlexEmail"]);
                                            if (($email != $_POST["PlexEmail"]) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
                                            // check if e-mail address is well-formed
                                                $emailErr = "Invalid email format.";
                                            } else {
                                                // Email validates.
                                                $_SESSION['PlexEmail'] = $email;
                                            }
                                        }
                                        if (!isset($_POST['priv']) || !isset($_POST['tac'])) {
                                            $agreeErr = "You must read and accept our Terms and Conditions and our Privacy Agreement.";
                                        }										
                                        if (!empty($nameErr)){
                                            $_SESSION['alert'] = "Please ensure you enter all details in the form accurately:\\n" . $nameErr . $emailErr;
                                            reloadPage(true);
                                        } elseif (!empty($agreeErr)) {
                                            $_SESSION['alert'] = $agreeErr;
                                            reloadPage(true);
                                        } else {
                                            // Validation successful.
                                            $_SESSION['JoinComplete'] = true;
                                            reloadPage();
                                        }
                                    }
                                    $NewUser = unserialize($_SESSION['NewUser']); // Load the user from the previous step.	
                                    
									     //Update DataBase	
									
                                         $FName = $_REQUEST['FName'];
									     $LName = $_REQUEST['LName'];
                                         $updatedata = "UPDATE users SET first_name='$FName', last_name='$LName', plexusername='$username', plexmail='$email' ORDER BY id DESC LIMIT 1";
                                                 if ($link->query($updatedata) === TRUE) {
                                                      //echo "New record updated successfully";
                                                    } else {
                                                          echo "Error: " . $updatedata . "<br>" . $link->error;
                                                        }
                            ?>
                                <?php echo $lang['jointitle2']; ?>                                
                                <form method="post" action = "">
								<?php echo $lang['joinform2']; ?>
                                    <div class="form">
                                        <input class="form-control" style="margin-bottom:8px; background-color:#000000B3;" placeholder="Best Email Contact" id="email" name="PlexEmail" type="text" disabled value="<?php echo $NewUser->getEmail();?>">
                                    </div>
                                    <div class="form">
                                        <input class="form-control" style="margin-bottom:8px; background-color:#000000B3;" placeholder="Plex Username" id="username" name="PlexUsername" type="text" disabled value="<?php echo $NewUser->getUsername();?>">                                                   
									</div>
                                    <div <div style="text-align: left" class="checkbox c-checkbox">
                                        <label>
                                            <input id="tac" name="tac" type="checkbox">
                                            <span class="fa fa-check"></span><a data-toggle="modal" data-target="#TAC" href="#" type="button" class="btn btn-sm btn-transparent btn-primary">Terms and Conditions</a>
                                        </label>
                                    </div>
                                    <div style="text-align: left" class="checkbox c-checkbox">
                                        <label>
                                            <input id="priv" name="priv" type="checkbox">
                                            <span class="fa fa-check"></span><b><a data-toggle="modal" data-target="#PRIV" href="#" type="button" class="btn btn-sm btn-transparent btn-primary">Privacy Agreement</a>
                                        </label>
                                    </div>                                  
                                    <?php echo $lang['joinfooter2']; ?>
                                       <input type="hidden" id="formname" name="formname" value="details"/>
                                </form>	
                                <?php
								
								    

                                    } elseif (!$_SESSION['accountCreated']) {
                                        $_SESSION['accountCreated'] = true; //Ensure the following can only be run once.
                                        $NewUser = unserialize($_SESSION['NewUser']); //Grab the NewUser from the session.
                                        $username = $NewUser->getUsername();
                                        $email =  $NewUser->getEmail();
										
                                                 //Plex Stuff
                                                 //HARD CODED VALUES THAT SHOULD BE MADE VARIABLE//
                                                 //Navigate to: https://plex.tv/api/resources.xml?X-Plex-Token=XXXXXXXXXXXXXXXX
     						                     //copy the clientIdentifier from your plex server: "fe3e045267994acdbe7c6d4f19daa105"

                                                 $MachineID = "dc9fd20ec7a617791774d2071cb3ed5027b705cc"; //MachineID of PlexServer
                                                 $XPCImd5 = md5($username);
                                                 $PToken = $GLOBALS['ini_array']['token'];

     					                         // All of this stuff can be edited to customize what you want.
     						                     // See here for details: https://github.com/jrudio/go-plex-client

                                                 $ContentBody = array(
                                                   "server_id" => $MachineID,
                                                   "shared_server" => array(
                                                   "library_section_ids" => array(),
                                                   "invited_email" => $username),
                                                   "sharing_settings" => "");

                                                 $JSONBody = json_encode($ContentBody);

                                                 $PlexHeader = array(
                                                     'X-Plex-Version: 1.0',
                                                     'X-Plex-Platform-Version: 1.0',
                                                     'X-Plex-Device-Name: StreamNet-UserJoin',
                                                     'X-Plex-Platform: StreamNet',
                                                     'Content-Type: application/json',
                                                     'X-Plex-Product: StreamNet-UserJoin',
                                                     'X-Plex-Device: StreamNet-UserJoin',
                                                     'Host: plex.tv'
                                                    );

                                                 $ContentLength = strlen($JSONBody);
                                                 array_push($PlexHeader, "X-Plex-Client-Identifier: $XPCImd5", "Content-Length: $ContentLength", "X-Plex-Token: $PToken");
                                                 httpPost("https://plex.tv/api/servers/$MachineID/shared_servers", $JSONBody, $PlexHeader);
                                                 //This should have invited the user.
												 
												 //Update DataBase
												 $code = $_GET['user'];
                                                 $updatedata = "UPDATE users SET plexusername='$username', plexmail='$email', invitecode='$code' ORDER BY id DESC LIMIT 1";
                                                 if ($link->query($updatedata) === TRUE) {
                                                      //echo "New record updated successfully";
                                                    } else {
                                                          echo "Error: " . $updatedata . "<br>" . $link->error;
                                                        }
																										
												//Select from DataBase
												
                                                $fetchdata = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                                                $result = $link->query($fetchdata);
                                                if ($result->num_rows > 0) {
                                                // output data of each row
                                                  while($row = $result->fetch_assoc()) {                                                    
                                                      $first_name = $row["first_name"];
                                                      $last_name = $row["last_name"];                                                     
                                                    }
                                                } else {
                                                      echo "0 results";
						                        }

                                             // Include phpmailer class
											 
                                             require 'phpmailer/PHPMailerAutoload.php';

                                             $mail = new PHPMailer;

                                             // SMTP configuration
                                             $mail->isSMTP();
                                             $mail->Host = 'mystreamnet-club.netcup-mail.de';
                                             $mail->SMTPAuth = true;
                                             $mail->Username = 'noreply@mystreamnet.club';
                                             $mail->Password = '9ffe4e761f';
                                             $mail->SMTPSecure = 'tls';
                                             $mail->Port = 587;

                                             $mail->setFrom('noreply@mystreamnet.club', 'StreamNet Club');
                                             $mail->addReplyTo('');

                                            // Add a recipient
                                             $mail->addAddress('admin@mystreamnet.club');

                                            // Add cc or bcc
                                             $mail->addCC('');
                                             $mail->addBCC('');

                                            // Add attachments
                                             $mail->addAttachment('');

                                            // Email subject
                                            $mailSubject = "".$username." has just joined StreamNet.Club";

                                            $mail->Subject = $mailSubject;


                                            // Set email format to HTML
                                            $mail->isHTML(true);

                                            // Email body content
                                            $mailContent = "<strong>".$username." has just joined StreamNet.Club!</strong><br/>
                                            <br/>
                                            <strong>".$last_name.", ".$first_name."</strong> has just joined StreamNet.Club<br/>
                                            Username: <strong>".$username."</strong><br/>
                                            Contact: <strong>".$email."</strong><br/>
                                            <br/>
                                            Regards,<br/>
                                            Streamnet.Club";


                                            $mail->Body = $mailContent;

                                            // Send email
                                            if(!$mail->send()) {                                       
                                            //echo 'Message could not be sent.';
                                            //echo 'Mailer Error: ' . $mail->ErrorInfo;
                                            } else {
                                            //echo 'Message has been sent';
                                            }

                                          reloadPage(true);

                                         } elseif ($_SESSION['accountCreated'])  {

                                                 $getuserreg = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                                                 $result = $link->query($getuserreg);
                                                 if ($result->num_rows > 0) {
                                                 // output data of each row
                                                  while($row = $result->fetch_assoc()) {                                                    
                                                      $userreg = $row["plexusername"];                                                   
                                                    }
                                                } else {
                                                      echo "0 results";
						                        }
                                          
										  if(($_GET['lang']) == 'en') {
											  
                                          echo '<h4 style="color:grey;"><strong>Howdy,</strong></h4><h3 class="text-gamboge"><strong>' . $userreg. '</strong>';
         				                  echo '<br/><br/><h4 style="color:green;"><i style="color:green;" class="fas fa-check-circle"></i><strong>&nbsp;Registration Successfull</strong></h4>';
                                          echo 'You should now have an email in your inbox with an invitation from Plex. Once you have accepted this, you will have access and be able to <a href="https://auth.mystreamnet.club/"> login </a>to StreamNet.Club! If you are unable to find the email please ensure you are checking the inbox of the email address associated with your Plex account.';
                                          echo '<br/><br/>If you experience any issues with StreamNet please log a support ticket at <a href="https://auth.mystreamnet.club/#">Support.</a>';
                                          echo '<br/><br/><br/><a type="button" href="https://auth.mystreamnet.club" class="btn btn-primary"><i class="fas fa-home"></i>&nbsp;Back Home</a>';
										  
                                          }else{
											  
										  echo '<h4 style="color:grey;"><strong>Howdy,</strong></h4><h3 class="text-gamboge"><strong>' . $userreg. '</strong>';
         				                  echo '<br/><br/><h4 style="color:green;"><i style="color:green;" class="fas fa-check-circle"></i><strong>&nbsp;Registrierung erfolgreich</strong></h4>';
                                          echo 'Du solltest jetzt eine E-Mail mit einer Einladung von Plex in deinem Posteingang haben. Sobald du diese akzeptiert hast, hast du Zugriff und kanst dich bei Streamnet.Club <a href="https://auth.mystreamnet.club/"> anmelden</a>! Wenn du die E-Mail nicht finden kanst, überprüfe bitte den Posteingang der E-Mail Adresse, die dienem Plex Konto zugeordnet ist.';
                                          echo '<br/><br/>Wenn du Probleme mit StreamNet hast, wende dich bitte an den <a href="https://auth.mystreamnet.club/#">Support.</a>';
                                          echo '<br/><br/><br/><a type="button" href="https://auth.mystreamnet.club" class="btn btn-primary"><i class="fas fa-home"></i>&nbsp;Start Seite</a>';
										  
                                        }
									}

                                    $link->close();
                                ?>
            </div>
        </div>
               </div>
        </div>
        </div>		
                    <div class="text-center">
                        <div id="TAC" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" class="modal" style="display: none;">
                          	<div class="modal-dialog">
                          	    <div class="modal-content">
                          				<div class="modal-header">
                          						<button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                          					<div class="text-center">
                          						<div class="page-header">
                          						  <h2 class="text-gamboge">Terms and Conditions</h2>
                          			            </div>
                          					</div>
                          				</div>

                          			<div class="modal-body text-left">

                                       Revised November 29, 2018
				                      <br/>
                                      <br/>
                                      1. <strong>Subscription(s)</strong>. Access to certain Content provided by Plex or a third party may require you to enroll in a subscription(s) for a recurring period of time 
									     as specified during order or registration (“Subscription(s)”). Subscription(s) for certain Content may also have particular access or usage requirements. 
										 The Plex Solution will connect you to any designated login, account, or registration process.
                                      <br/>
                                      <br/>
                                      2. <strong>Terms of Service</strong>. Subscription(s) is subject to these “Subscription(s) and Billing” terms, the Plex Terms of Service, and any other terms and conditions 
									     imposed by the third party provider of the Content, your financial services provider, and/or your mobile carrier or internet provider. You are solely responsible for 
										 reviewing the terms of use, privacy policy or any other terms governing your use of the Subscription(s) or the applicable service(s) provided by your financial 
										 services provider and/or mobile carrier.
                                      <br/>
                                      <br/>
                                      3. <strong>Privacy</strong>. Please see Plex's Privacy Policy to review the information collection and use practices of Plex.
                                         <strong>Order</strong>. To enroll in a Subscription, you may be required to create an account or complete a registration process. Orders placed are not final until 
										 confirmed by Plex.
                                      <br/>
                                      <br/>
                                      4. <strong>Fees</strong>. The applicable fee(s) for a Subscription(s) will be specified at the time of order or when you change your Subscription. 
									     All fees are exclusive of all taxes, levies, or duties imposed by applicable taxing authorities. Any applicable discounts or promotional prices will be noted at 
										 the time of order. Unless otherwise noted or required by applicable law, all fees are non-refundable and billed in advance for the upcoming Subscription(s) period.
										 No refunds or credits shall be issued for partial months, upgrade/downgrades, or nonuse. When you order a Subscription(s), you will initially be charged at the rate 
										 applicable at the time of your initial request to subscribe. If the price of your Subscription(s) changes, we will provide you with at least thirty (30) days prior notice.
                                      <br/>
                                      <br/>
                                      5. <strong>Billing</strong>. Following expiration of the applicable trial period, Subscription(s) is billed in advance for the identified subscription period. 
									     In addition to any fee(s) for a Subscription(s), you agree that you are responsible for any charges (including any foreign transaction charges) that may be imposed by 
										 credit card providers or other third parties in connection with your use of or payment for the Subscription(s). Should charges for which you are responsible fail at 
										 the time payment is required, you may be responsible for costs associated with Plex’s efforts to collect amounts due in accordance with applicable laws.
                                      <br/>
                                      <br/>
                                      8. <strong>Renewal</strong>. Unless otherwise noted at time of order, each Subscription(s) will renew automatically for recurring periods on or about the date the 
									     then-current recurring Subscription(s) period expires. Such renewal will be for the same duration of the original Subscription(s) term. Please also note that Content 
										 or the features or functionality of the Plex Solution may change for the renewal period and/or may be subject to different fees. We will provide prior notice of any 
										 changes in advance of any renewal. Your Subscription(s) will remain in effect and continue to renew automatically until it is cancelled by you or the Terms of Service 
										 are terminated (in accordance with their terms).
                                      <br/>
                                      <br/>
                                      7. <strong>Cancellation</strong>. You are responsible for cancellation of any Subscription(s). But, you can cancel at any time with such cancellation effective upon expiration 
									     of the then current Subscription(s) period. To cancel, please visit this page and make a cancellation request at least one (1) day prior to the end of your then-current 
										 Subscription term.
                                      <br/>
                                      <br/>
                                      8. <strong>Law</strong>. All Subscription(s) are void where prohibited by law. These Subscriptions and Billing terms and any Subscription(s) available through the Plex Solution 
									     shall be governed by the laws of the State of California.

                          		    </div>
                          			<div class="modal-footer">
                          					<button type="button" data-dismiss="modal" class="btn btn-primary">I understand</button>
                          		    </div>

                          		</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
	                    <div id="PRIV" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" class="modal" style="display: none;">
	                        <div class="modal-dialog">
	                            <div class="modal-content">
	                                <div class="modal-header">
	                                     <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
	                                    <div class="text-center">
	                                        <div class="page-header">
		                                         <h2 class="text-gamboge">Privacy Agreement</h2>
		                                    </div>
	                                    </div>
	                                </div>

	                                    <div class="modal-body text-left">
                                              You may choose to provide us with certain information, such as when you create your user profile or when you use the Services. 
											  We may also collect automatically-generated and technical information. Therefore, the information we have (“Collected Information”) may include:
                                              <br/>
                                              <br/>
                                              1. <strong>Profile Information</strong>. You may provide us with profile information such as your e-mail address, username, a profile image, and password when you create an account, 
											     or when you edit your account information. You may also provide us with your payment information when you sign-up for a paid service.
                                              <br/>
                                              <br/>
                                              2. <strong>Information from External Services</strong>. If you choose to connect your account to an account of an external service, such as a social networking site 
											     or cloud storage services, we may collect certain information from those accounts, such as your name and email address as well as data required to connect to that 
												 service. You may provide such authorization during the connection process, or it may be implicit in the service authorization itself. For example, 
												 if you choose to connect your Plex account to a social networking account, we may collect your public profile information if you agree to the collection of 
												 this information during the connection process.
                                              <br/>
                                              <br/>
                                              3. <strong>Metadata for Personal Content</strong>. Except for certain exceptions such as for Personal Cloud Content, Third-Party Control and Playback Mechanisms, 
											     and image analysis (i.e., metadata about photos when these features are user-enabled, such as geotag information or scene recognition analysis), as described below, 
												 we do not collect or store metadata (information about the specific file, cover art, subtitles, running length, etc.) for Personal Content stored on your personal 
												 Plex Media Server. However, your Plex Media Server may anonymously send us filenames or other identifiers for your Personal Content for the sole purpose of 
												 providing metadata back to your personal Plex Media Server. You may disable this metadata matching capability.
                                              <br/>
                                              <br/>
                                              4. <strong>Metadata for Personal Content for Integration with Third-Party Control and Playback Mechanisms</strong>. We may offer integrations with Third-Party Control 
											     and Playback Mechanisms that you may choose to use, such as Sonos, Amazon Alexa, IFTTT, Zapier, SmartThings, webhooks, etc. In order to provide the integrations 
												 with the Third-Party Control and Playback Mechanisms, we may collect Metadata for your Personal Content that is needed to integrate with the Third-Party Control 
												 and Playback Mechanisms. For example, if you use Amazon Alexa to play a particular song or movie from among your Personal Content at your home, then our Services 
												 may search your Personal Content in order to find and play the song or movie that you requested. Information provided by you to the Third-Party Control or Playback 
												 Mechanisms is not governed by this privacy policy.
                                              <br/>
                                              <br/>
                                              5. <strong>Usage Statistics for Personal Content</strong>. We may collect usage statistics for Personal Content. This includes information about your interaction 
											     with the Services, such as device information, duration, bit rate, media formats, resolution, and media type (music, photos, videos, etc.). Where possible, 
												 we will generalize this information to avoid identifying your Personal Content. Usage statistics do not include specific content titles or filenames. 
												 We may use information related to your usage to run and improve our Services, to provide, customize, and personalize communications and other content that we deliver 
												 or offer to you.
                                              <br/>
                                              <br/>
                                              6. <strong>Information on our Services</strong>. We may store information about your configuration or use of our Services when you create a Plex Media Server on a 
											     local device or in the cloud, connect to a Plex Media Server that you or another person has configured, or download or connect to a Plex app, or interact with or 
												 use other Plex software or Service. This information may include an IP address and port number(s), the name of a Plex Media Server, and information used to 
												 secure access to our Services.
                                              <br/>
                                              <br/>
                                              7. <strong>Information about Interfacing Software</strong>. “Interfacing Software” includes but is not limited to, plug-ins for the Services, channel plug-ins, 
											     metadata agents, and client applications that communicate directly or indirectly with the Services. We may store copies of Interfacing Software that you provide to 
												 Plex and that accesses or calls any software provided by Plex as part of the Services.
                                              <br/>
                                              <br/>
                                              8. <strong>Debugging and Other Information Voluntarily Provided</strong>. You may send us logs, metadata, or other information about your devices, media, 
											     and experiences for the purpose of resolving an issue you may have with the software or suggesting desired features. On client applications where it is possible, 
												 we will offer the ability to opt-out of sending crash reports. If you would like to learn more about the information being sent in crash reports, we encourage you 
												 to review the privacy policies for the third-party client applications you are using to access Plex Services. The information being sent to us will only be used to 
												 help resolve your issue and / or improve our Services, and using our Services and provision of such information, you agree to such use by us.
                                              <br/>
                                              <br/>
                                              9. <strong>Device Information</strong>. Like many online services, we may collect information about the devices that are used to access our Services, such as the 
											     IP address of the device, the operating system and version of the device, the browser that you use to access a Plex web page, and the versions of the Plex 
												 technologies being used. We may also collect location information about the devices that access our Services.
                                              <br/>
                                              <br/>
                                              10. <strong>Application Information</strong>. When a request for information or content is sent to a Plex Media Server, we may collect an application identifier 
											      that identifies which application sent the request. An application identifier uniquely identifies a particular copy of an application. For example, 
												  if you download an application from Plex, fully uninstall the copy of the application, and then re-download the application from Plex, the new copy of 
												  the application will be associated with a different application identifier than the uninstalled copy of the application. Note that simply deleting the app 
												  without fully uninstalling may not reset the application identifier.
                                              <br/>
                                              <br/>
                                              11. <strong>Plex Relay Service</strong>. We may provide, and you may choose to use, the Plex Relay Service to connect or stream your Personal Content to another device. 
											      If you choose to use the Plex Relay Service, we will transfer the data necessary to perform the service. All such traffic is encrypted from end-to-end in a manner 
												  that makes it impossible for Plex or the Plex Relay Service to decrypt or view any data. The data transferred via the Plex Relay Service is not stored by Plex except 
												  for the temporary buffering of data required to provide you with an optimal streaming experience. You can disable the Plex Relay Service by turning off Remote Access 
												  in your server settings.
                                              <br/>
                                              <br/>
                                              12. <strong>Cookies and Other Tracking Technology</strong>. Like many online services, Plex uses cookies, tracking pixels, and similar technologies to collect information 
											      that helps us provide our Services to you. We also use these technologies to help market our products and services to you and other customers. 
												  For more information about these technologies and how you may control them, please see the detailed description of Tracking Technologies.
                                              <br/>
                                              <br/>
                                              13. <strong>Obtaining Consent</strong>. If there is a change to any product or feature that we offer or have offered, and in order to use that product or feature a 
											      material change to the collection and / or use of information (including for Personal Content) not contemplated by the Privacy Policy is needed, we will obtain 
												  your consent before such collection and / or use.
                                                  <strong>Your Collected Information</strong>. In order to view, amend, erase, or correct your Collected Information, contact Plex support. All requests will be 
												  answered within one month of receipt.

                                        </div>
                                        <div class="modal-footer">
	                                         <button type="button" data-dismiss="modal" class="btn btn-primary">I understand</button>
		                                </div>

	                            </div>
	                        </div>
	                    </div>
	                </div>
<?php
}else{
  header('Location: https://auth.mystreamnet.club/ad.html');
}
?>			

                      
        <!--  Scripts  -->
        <!--  Bootstrap core JavaScript  -->
        <!--  Placed at the end of the document so the pages load faster  -->
		
        <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/docs.min.js" type="text/javascript"></script>
        <script src="js/app.js" type="text/javascript"></script>

    </body>
</html>
