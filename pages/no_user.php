<?php

include "inc/modules/pages.module.php";
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
        <meta name="author" content="cyb3rgh05t">
        <meta name="google-site-verification" content="rubgHIvlVrrqFWt6ps5IQM-6aJ0A2oygfKSYcqWLGCk" />

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
        <link rel="manifest" href="/images/icons/site.webmanifest">
        <link rel="mask-icon" href="/images/icons/safari-pinned-tab.svg" color="#160808">
        <meta name="msapplication-TileImage" content="/images/icons/ms-icon-144x144.png">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="theme-color" content="#ffffff">
		
		<title>StreamNet Club</title>

		<!-- ================================= CSS BOOTSTRAP =============================== -->

		<link href="/css/bootstrap.css" rel="stylesheet"/>
                <link href="/css/plexcolors.css" rel="stylesheet"/>
                <link href="/css/fontawesome/css/all.min.css" rel="stylesheet">

                <link href="/css/jquery.fadeshow-0.1.1.min.css" rel="stylesheet"/>


		<!-- ================================= JavaScript BackGround Cover Slide =============================== -->
		
		<?php
		    include 'inc/pages.slideshow.php'
	    ?>
		
                
                <!-- ================================= Custom Bootstrap Styles =============================== -->

                <style>

                .background {
	          background: #282A2D;
	          position: fixed;
	          width: 100%;
	          height: 100%;
	          top: 0;
	          left: 0;
	          z-index: -1;
                 }

                </style>

	</head>
	<body id="login">
         <div class="background"></div>
                   
                               <div class="text-center">
 			          <div style="padding-top:5%;" class="modal-dialog">
				         <div class="modal-content">
					        <div class="modal-header">
					                 <div class="text-center">
						               <div class="modal-header" align="center">
			          <img src="/images/logo-navbar.png" alt="STREAMNET" width="350" class="img-responsive">
					        </div>					                 
                                                  </div>
					         </div>
					                <div class="modal-body">
									
									     <?php echo $lang['no_user']; ?>

                        </div>
                     </div>
                   </div>
					
		<!-- ================================= START SCRIPTS =============================== -->

		<script src="/js/jquery.min.js"></script>
	    <script src="/js/bootstrap.min.js"></script>

	    <!-- ================================= APP SCRIPTS =============================== -->

	    <script src="/js/app.js"></script>
		
	</body>
</html>