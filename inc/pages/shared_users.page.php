<?php
    // First things first. Kill the page if user isn't an admin.
    

    $xmlData = file_get_contents("https://plex.tv/api/users?X-Plex-Token=" . $GLOBALS['ini_array']['token']); // Download all friends in XML format.
    $data = simplexml_load_string($xmlData);    // Convert XML to useful object.


    function plexIDToUsername($id, $data) {
        // Function that will convert an input PlexID to their Username.
	    foreach ($data->User as $usr){
		if ($usr->attributes()['id'] == $id) {
			return $usr->attributes()['username'];
			break;
		}
	    }
    }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!--  Meta  -->
		
		<?php require_once 'inc/meta.php'; ?>
		
		<title>Permissions - StreamNet</title>
		
		<!--  CSS  -->
		
		<link href="css/logs.css" rel="stylesheet"/>
        <link href="css/plexcolors.css" rel="stylesheet"/>
        <link href="css/fontawesome/css/all.min.css" rel="stylesheet">
	
	<style>
	
    html {
		overflow: scroll;

    }

    body {
		margin-top: 20px;
	}


    ::-webkit-scrollbar {
        width: 0px;
        height: 0px;
    }

    ::-webkit-scrollbar-track {
       -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
       -webkit-border-radius: 10px;
       border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #E5A00D; 
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
    }
	
    ::-webkit-scrollbar-thumb:window-inactive {
	    background: rgba(255,0,0,0.4); 
    }
	
	

		
    #avatar {
       max-width: 40px;
       height: auto;
       background-color: black;
    }

    .img-circle {
       width : 40px;
       vertical-align: middle;
       border-radius: 50%;
       background-color: black;
    }

    #avatar:hover, #avatar:focus{
       box-shadow: 0 0 0 2px #E5A00D;
    }

    #username {color: ;
       vertical-align: middle;
    }
 
</style>
		
</head>


		<div class="container">
		<div class="col-sm-6 col-lg-12">
			  <div class="panel-default">
                     
                     <div class="panel-body">
	            <table class="table table-striped" data-effect="fade">
				<thead>
	                <tr>
	                  <th style="background:#282A2D;color:#E5A00D;"></th>
	                  <th style="background:#282A2D;color:#E5A00D;">USERNAME</th>
	                  <th style="background:#282A2D;color:#E5A00D;">ID</th>
	                  <th style="background:#282A2D;color:#E5A00D;">EMAIL</th>
					  <th style="background:#282A2D;color:#E5A00D;">DATE ADDED</th>
	                </tr>
	              </thead>				  
	              <tbody>
				  <?php
				  
                   foreach ($data->User as $usr){
                        $usr = $usr->attributes();
						$plexmail = $usr['email'];
						$data .= '<tr>';
                        $data .= '<td><img id="avatar" class="img-circle" src="'. $usr['thumb'] .'"></td>';
						$data .= '<td id="username">'. $usr['username'] .'</td>';
						$data .= '<td id="username">'. $usr['id'] .'</td>';
					    $data .= '<td id="username">'. $usr['email'] .'</td>';
						include_once('sql.module.php');	
		
                  $sql = "SELECT * FROM users WHERE plexmail='$plexmail'";
                  $result = $link->query($sql);

                 if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {                                                    
                       $date_added = $row["date_added"];                                                            
                       }
                }
                        $newdate = date_create($date_added);
						$data .= '<td id="username">'. date_format($newdate,"l, d F Y") .'</td>';
				        $data .= '</tr>';
                        }
		           ?>
	                <?php echo $data ?>					
	              </tbody>
	            </table>        
                </div>
	           
			   </div>
			   </div>



		
		<!--  Footer  -->

		<!--  Scripts  -->
<!--  Bootstrap core JavaScript  -->
<!--  Placed at the end of the document so the pages load faster  -->

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/docs.min.js"></script>
<script src="js/app.js"></script>
	</body>
</html>

