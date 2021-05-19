<?php
include "inc/modules/common.module.php";
?>



<!DOCTYPE html>
<html lang="en">

	<head>

		<!--  Custom Meta  -->

		<?php require_once 'inc/meta.php'; ?>
		
		<title>StreamNet.Club | Home</title>

		<!--  CSS  -->

		<link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/plexcolors.css" rel="stylesheet"/>
        <link href="css/scroll.css" rel="stylesheet"/>
        <link href="css/jquery.fadeshow-0.1.1.min.css" rel="stylesheet"/>
		<link href="css/fontawesome/css/all.min.css" rel="stylesheet">
		
		<script src="https://www.google.com/recaptcha/api.js"></script>

  		
		<!--  SlideShow  -->
		
        <?php require_once 'inc/slideshow.php'; ?>
    
        <!--  Scroller  -->
					
		<script>
		    $(function() {
	            $('a[href*=#]').on('click', function(e) {
		            e.preventDefault();
		        $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
	            });
                 });			
        </script>
		
		<script>
         $(document).ready(function(){
         $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
               localStorage.setItem('activeTab', $(e.target).attr('href'));
          });
         var activeTab = localStorage.getItem('activeTab');
         if(activeTab){
         $('#tabs a[href="' + activeTab + '"]').tab('show');
         }
        });
        </script>
        
        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <!--  Custom CSS  -->
                  
		<style>
		
    	        body {
	        font-size: 14px;
	        -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
    	        }

			
                .background {
	          background: #1f1f1f;
	          position: fixed;
	          margin-top: 60px;
	          width: 100%;
	          height: 100%;
	          top: 0;
	          left: 0;

	          z-index: -1;
                }
   
			
			
                @media (max-height:700px) {
                #scroller {visibility:hidden;
                     }
                }

                @media (max-width: 768px) {
                     p.screen {font-size: 15px;
                            }
                     div.screen {font-size: 10px;
                            }
                     #loginform {width: 70%;
                      display: inline-block;
                            }
                     #remember {font-size: 14px;
                            }
                        }
			
                @media (max-width: 320px) {
                     p.screen {font-size: 11px;
                            }
                     div.screen {font-size: 7px;
                            }
                     #loginform {width: 70%;
                     display: inline-block;
                            }
                     #remember {font-size: 14px;
                            }
                        }
                .hyperlink {
                 -webkit-font-smoothing: antialiased;
                  box-sizing: border-box;
                  color: rgb(89, 159, 204);
                  display: block;
                  float: right;
                  font-family: Lato, sans-serif;
                  font-size: 10px;
                  font-weight: normal;
                  height: 22px;
                  line-height: 22.85714340209961px;
                  margin-right: 4px;
                  text-align: left;
                  width: auto;
                  cursor : pointer;
                  }
                  
                .inner-div {
                  align:center;
                  display: inline-block; 
                  margin-bottom: 15px;
                  }

               </style>
	</head>


	<body>

        <!-- Fixed navbar -->
		
        <?php require_once 'inc/nav_login.php'; ?>
		
        <!--  Login  -->
		
        <div class="background"></div>
        <div id="login">
		   <div style="background-image: linear-gradient(to bottom, transparent 0%, black 100%);height: 100vh;">
	 	    <div id="test" class="main-header text-center">
	 		    <div class="elements">
	 				    <div class="logo page-header">
	 				      <img style="padding-top: 7%;" src="images/logo-header.png" alt="STREAMNET" width="1200" class="img-responsive">
	 			        </div>
						<div>
	 			        <p class="screen" style="background-color:#000000B3; margin:0px 30% 0px 30%; padding:0.5% 0.5%;" ><?php echo $lang['slogan']; ?></p>	 			       
						<br/>
						<br/>
						<div>
	 			        <form method="post" id="loginform" class="navbar-form" role="form">
	 				    <div class="form-group">
	 					<?php echo $lang['loginform']; ?>     
	 				    </div>
	 				    <div style="position: relative;" class="form-group">
	 					     <input id="password" name="PlexPassword" style="border-color:#E5A00D; background-color:#000000B3;" type="password" placeholder="Plex Password" required class="form-control">							 
							 <?php echo $lang['forgot']; ?>						
                             <!-- <a id="lnkforget" class="hyperlink" style="position: absolute;top: 7px;right: 0px;" href="" data-toggle="modal" data-target="#pass">Forgot&nbsp;<i class="fa fa-question-circle" aria-hidden="true"></i></a> -->
                        </div>					
	 				    <div style="padding-left: 10px" class="checkbox c-checkbox">
	 					    <label id="remember">
	 				        <input type="checkbox" id="indeterminate-checkbox" name="rememberme" value="true" checked>
	 					    <span class="fa fa-check"></span><?php echo $lang['rememberme']; ?>
						    </label>
	 				    </div>
	 					     <button type="submit" name="action" class="btn btn-primary"><i class="fas fa-sign-in-alt" aria-hidden="true"></i>&nbsp;<?php echo $lang['login']; ?></button>
							 <?php echo $lang['choice']; ?>
							 <?php echo $lang['invite']; ?>	    
	                    </form>
					    </div>
					    <br/>
                        <br/>
                        <?php echo $lang['discord']; ?>
                   <!-- <div style="background-color:#000000B3; margin:0px 40% 0px 40%; padding:0.5% 0.5%;" class="screen">Don't have an Invite&nbsp;<i class="fa fa-question-circle" aria-hidden="true"></i></div>						
						<br/>
					    <a type="button" href="./?page=join" class="btn btn-primary"><i class="fas fa-user-plus" aria-hidden="true"></i>&nbsp;Create Invite</a> -->
                        </div>
				</div>
				<br/>
				<br/>
		        <div id="scroller" style="padding-top:2%;" class="scroll">
	              <a href="#mainpage">
				    <span></span>
				  </a>
				</div>
	 		</div>
		   </div>
	    </div>
		
	   <!--  Main Page  -->

        <section id="mainpage" style="background: #1f1f1f;">
	 		<div id="tabs" class="container">
	 		     <!-- START panel-->
	 			    <div class="text-center">
	 				    <div class="panel-body">
	 				     <!-- Nav tabs -->
	 						<ul style=" padding-top: 60px;" class="text-gambodge nav nav-tabs">
	 							<li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;
								<?php echo $lang['home']; ?></a>
	 							</li>
	 			      	        <li><a href="#devices" data-toggle="tab"><i class="fas fa-play-circle" aria-hidden="true"></i>&nbsp;
								<?php echo $lang['media']; ?></a>
	 							</li>
	 							<li><a href="#contact" data-toggle="tab"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;
								<?php echo $lang['contact']; ?></a>
	 							</li>
	 							<li><a href="#faq" data-toggle="tab"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;
								<?php echo $lang['faq']; ?></a>
	 							</li>
	 						</ul>
	 				     <!-- Tab panes -->
					     <br/>
						 <br/>
	 				        <div class="tab-content">

	 					        <div id="home" class="tab-pane fade in active">
	 							   <?php echo $lang['homebutton']; ?>
								   <br/>
								   <br/>
	 							   <?php echo $lang['home1']; ?>

						            <?php
						             require_once ('plexpyAPI.module.php');
									 $stats = plexpyAPI('get_libraries')['response']['data'];
						             $stat_array = array();
									 foreach ((array)$stats as $section) {
							         $stat_array[$section['section_name']] = $section['count'];
										 if ($section['section_type'] == 'show') {
								            $stat_array["Episodes"] = $section['child_count'];
										}
									}
						            ?>

						            <div class="main-header">
	 					                <div class="logo">
	 						                 <img src="images/plex-tv.png" alt="STREAMNET" class="img-responsive">
							                 <br/>
	 			 				            <div class="" style="font-size:12px;" align="center">
							                  <strong>TV Shows: </strong><span class="text-gamboge"><?php print $stat_array['TV Shows']; ?></span> <span class="text-shuttle-gray">&#124;</span>
							                  <strong>Manga Series: </strong><span class="text-gamboge"><?php print $stat_array['Manga Series']; ?></span> <span class="text-shuttle-gray">&#124;</span>
							                  <strong>All Episodes: </strong><span class="text-gamboge"><?php print $stat_array['Episodes']; ?></span>
						                    </div>
	 					                      <br/>
	 						                  <img src="images/plex-movie.png" alt="STREAMNET" class="img-responsive">
							                  <br/>

	 			 				            <div class="" style="font-size:12px;" align="center">
                                              <strong>4K Movies: </strong><span class="text-gamboge"><?php print $stat_array['4K Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
									          <strong>HD Movies: </strong><span class="text-gamboge"><?php print $stat_array['Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
									          <strong>Manga Movies: </strong><span class="text-gamboge"><?php print $stat_array['Manga Movies']; ?></span> <span class="text-shuttle-gray">&#124;</span>
									          <strong>James Bond World: </strong><span class="text-gamboge"><?php print $stat_array['James Bond World']; ?></span> <span class="text-shuttle-gray">&#124;</span>
									          <strong>Disney MasterPieces: </strong><span class="text-gamboge"><?php print $stat_array['Disney MasterPieces']; ?></span> <span class="text-shuttle-gray">&#124;</span>
									          <strong>Marvel Universe: </strong><span class="text-gamboge"><?php print $stat_array['Marvel Universe']; ?></span> <span class="text-shuttle-gray">&#124;</span>
									          <strong>DC Universe: </strong><span class="text-gamboge"><?php print $stat_array['DC Universe']; ?></span> <span class="text-shuttle-gray">&#124;</span>
											  <strong>Animation Movies: </strong><span class="text-gamboge"><?php print $stat_array['Animation Movies']; ?></span>
	 					                    </div>
					                    </div>
					                </div>
				                </div>


				                <div id="devices" class="tab-pane fade">
					                 <?php echo $lang['media1']; ?>
				                </div>

							    <div id="contact" class="tab-pane fade">
								    <?php echo $lang['contact1']; ?> 
							    </div>


							    <div id="faq" class="tab-pane fade">
								  <?php echo $lang['faq1']; ?>    
						    </div>
							
							<p class="page-header"></p>
						    <p> <?php echo $lang['discord2']; ?> </p>
				        </div>
		            </div>
			</div>
	    </section> 

                     

		<!--  Modal Popups  -->
		
		<div class="text-center">
		    <div id="pass" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" class="modal" style="display: none;">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header" align="center">
		                  <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
			              <img src="images/logo-navbar.png" alt="STREAMNET" width="350" class="img-responsive">
		                </div>

		                <div class="modal-body">
				            <form action="inc/forgetpassword.php" method="post">
				                <div class="form">
	                              <input type="text" id="recoveremail" name="recoveremail" placeholder="Email Adress" class="form-control" style="background-color:#000000B3; margin-bottom: 10px;" required>
	                              
				                </div>
			            </div>
	                        <div class="modal-footer">
			                  <input type="submit" value="Recover" name="submit" id="recover" class="btn btn-primary">
						      <button  type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
						      <p class="text-gamboge pull-left">Password Recovering</p>						  
			                </div>
	                        </form>

		            </div>
		        </div>
		    </div>
		</div>


		<div class="text-center">
		    <div id="support" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" class="modal" style="display: none;">
			    <div class="modal-dialog">
				  <?php echo $lang['modalsupport']; ?>  
			    </div>
		    </div>
		</div>
		
		<div class="text-center">
		    <div id="howit" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" class="modal" style="display: none;">
			     <?php echo $lang['modalhowit']; ?> 
		      </div>
			  </div>
			  
			 

        <!--  Footer  -->

        <div id="footer">
			<div class="footer bg-black">
              <br/>
 				<div class="" style="float: right;margin-top:;margin-right:20px;">
 	              <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Github" href="https://github.com/Cyb3rGh05t" target="_blank"><i style="" class="fab fa-github fa-footer-github fa-2x"></i></a>
 				  <span style="padding-left:5px;padding-right:5px;"></span>
				  <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Discord" href="https://discord.gg/Aea4uuS" target="_blank"><i class="fab fa-discord fa-footer-discord fa-2x"></i></a>
				 <span style="padding-left:5px;padding-right:5px;"></span>
				  <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Telegram" href="https://t.me/joinchat/S_ZvjhypXWdaipYUfVwW4A" target="_blank"><i class="fab fa-telegram fa-2x" style="color:#0088cc;"></i></a>
 
                                 <br/>
 				</div>
			    <div class="" style="font-size:11px;float: left;margin-left:20px;">
				  <p>&copy; 2014 - <?php echo date("Y"); ?>&nbsp; <a href="https://mystreamnet.club">StreamNet.Club</a><br/><i style="font-size:9px;">StreamNet.Club is not affiliated to Plex.Inc</i></p>
                <div style="clear: both"></div>
                </div>
	        </div>
        </div>

	    <!--  Scripts  -->
        <!--  Bootstrap core JavaScript  -->
        <!--  Placed at the end of the document so the pages load faster  -->
        <script src="js/bootstrap.min.js"></script>
	    <script src="js/app.js"></script>
		
	</body>
</html>
