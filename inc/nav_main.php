<?php  
 
        if ($loggeduser == ($GLOBALS['ini_array']['plexowner'])) {

?>

<!-- Fixed navbar -->
<nav id="nav_iframe" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-inner">
		<div class="navbar-header">
			<button type="button"  style="margin-right: 6px;" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
      <a class="navbar-brand" href=""><img src="images/logo-navbar.png" alt="StreamNet.Club" width="200" class="img-responsive"></a>
     <!-- <i style="margin-top: 22px; color: green;" class="fas fa-lock"></i> -->
      <span id="welcome" style="margin-top: 22px; color:white;text-transform: uppercase;">Welcome,</span><span id="welcome2" style="color:orange;"> <?php print $User->getUsername() ?>&nbsp;(Admin) </span>
      </div>

		<div id="navbar" style="margin-right: -10px;" class="collapse navbar-collapse" onclick="myNavItems(event)">
			<ul id="myTab" class="nav navbar-nav navbar-right">
				<li  class="dropdown">
					<a id="user" href="#!" class="dropdown-toggle active" data-toggle="dropdown"><img id="avatar" style="border-radius: 50%;" class="img-circle" src="<?php print $User->getThumb()?>">&#9662;</a>
					<ul style="background-color: black;" class="fa-ul dropdown-menu">
                                                <li style="text-align:center;color:white;text-transform: uppercase;"><?php print $User->getUsername()?></li><br/>
                                                      
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=portainer" target="frame"><i class="fa fa-archive" aria-hidden="true"></i>&nbsp;Portainer</a></span></li>
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=invite" target="frame"><i class="fas fa-ticket-alt" aria-hidden="true"></i>&nbsp;Invite</a></span></li>
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=shared_users" target="frame"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Users</a></span></li>
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=logs" target="frame"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Logs</a></span></li>
                                                <!--<li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=filebot" target="frame"><i class="far fa-file-alt"></i>&nbsp;Filebot</a></span></li>
                                                
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=mkv" target="frame"><i class="far fa-play-circle"></i>&nbsp;MKVToolNix</a></span></li>
                                                
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=shows" target="frame"><i class="fa fa-globe"></i>&nbsp;JD-Shows</a></span></li>
                                                
                                                <li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a style="color:#B3BAC1;" href="./?page=movies" target="frame"><i class="fa fa-globe"></i>&nbsp;JD-Movies</a></span></li>--> 
                                                <br/>                                                
						<li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a href="./?page=signout" style="color:orange;"><i class="fas fa-sign-out-alt" aria-hidden="true"></i>&nbsp;Sign Out</a></span></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
                                		
                                <li class="active"><a href="./tautulli" target="frame"><i class="fa fa-server" aria-hidden="true"></i>&nbsp;
				Statistics</a></li>
                      	        <li class><a href="./?page=ombi" target="frame"><i class="fa fa-tv" aria-hidden="true"></i>&nbsp;
				Requests</a></li>
                                <li><a href="./?page=kitana" target="frame"><i class="fa fa-plug" aria-hidden="true"></i>&nbsp;
				Plug-Ins</a></li>
                                <!-- <li><a href="./?page=xteve" target="frame"><i class="fas fa-satellite-dish" aria-hidden="true"></i>&nbsp;
				Live TV</a></li> -->
                                <li><a href="./?page=plex" target="frame"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;
				Server Settings</a></li>
                                <!-- <li><a href="./?page=invite" target="frame"><i class="fas fa-ticket-alt"></i>&nbsp;
                                Invite</a></li>
                                <li><a href="./?page=shared_users" target="frame"><i class="fa fa-users"></i>&nbsp;
				Users</a></li>
                                <li><a href="./?page=logs" target="frame"><i class="fa fa-tasks"></i>&nbsp;
				Logs</a></li> -->

			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>




<?php

} else {

?>

<!-- Fixed navbar -->
<nav id="nav_iframe" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-inner">
		<div class="navbar-header">
			<button type="button"  style="margin-right: 6px;" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
      <a class="navbar-brand" href=""><img src="images/logo-navbar.png" alt="StreamNet.Club" width="200" class="img-responsive"></a>
      <i style="margin-top: 22px; color: green;" class="fas fa-lock"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span id="welcome" style="margin-top: 22px; color:white;text-transform: uppercase;">Welcome,</span><span id="welcome2" style="color:orange;"> <?php print $User->getUsername() ?>&nbsp;</span>
		</div>

		<div id="navbar" style="margin-right: -10px;" class="collapse navbar-collapse" onclick="myNavItems(event)">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a id="user" href="#!" class="dropdown-toggle" data-toggle="dropdown"><img id="avatar" style="border-radius: 50%;" class="img-circle" src="<?php print $User->getThumb()?>">&#9662;</a>
					<ul style="background-color: black;" class="dropdown-menu">
                                                <li style="text-align:center;color:white;text-transform: uppercase;"><?php print $User->getUsername()?></li><br/>
						<li class="hover-item" style="font-size:14px;padding:5px 0px 5px 10px;text-align:left;"><span><a href="./?page=signout" style="color:orange;"><i class="fas fa-sign-out-alt"></i>&nbsp;Sign Out</a></span></li>					
						</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="./?page=media" target="frame"><i class="far fa-play-circle"></i>&nbsp;
				Recently Added</a></li>
				<li><a href="./?page=tautulli" target="frame"><i class="fa fa-server"></i>&nbsp;
				Statistics</a></li>
				<li><a href="./?page=ombi" target="frame"><i class="fa fa-tv"></i>&nbsp;
				Request Movie/Show</a></li>
				<li><a href="./?page=plex" target="frame"><i class="fa fa-cogs"></i>&nbsp;
				myPlex Server</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
<?php
}
?>
