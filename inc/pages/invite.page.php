<!DOCTYPE html>
<html lang="en">
	<head>

<?php
function invite($length_of_string) 
{ 
    $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
	
    return substr(str_shuffle($str_result), 0, $length_of_string); 
	
	} 
	
	if(isset($_POST['invite'])) {
	$invitecode = invite(16);
	
include 'modules/sql.module.php';

        $update = "INSERT INTO invites (codes, status) VALUES ('$invitecode', 'UNCLAIMED')";                                                                          
            if ($link->query($update) === TRUE) {
               //echo "New record updated successfully";
               } else {
                echo "Error: " . $update . "<br>" . $link->error;
              }   
	}			  
?>
<title>Invite to Plex</title>


		<link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/plexcolors.css" rel="stylesheet"/>
        <link href="css/fontawesome/css/all.min.css" rel="stylesheet">

<script>
function copyText(){
    var text = document.getElementById("invitecode");
    text.select();
    document.execCommand("copy");
    alert("Copied the text: " + text.value);
}
</script>
		


</head>
     <body>
		<main>
				<div class="section">
					<div class="container text-center">
								<div class="text-center">
							    <h1 class="">Invite someone to StreamNet</h1>
								</div> 
								<br/>
								<br/>
                                <form class="form-signin align-center" method="post"> 
							    <input type="text" id="invitecode" value="<?php echo $invitecode; ?>" class="text-center form-control" style="font-size: 30px;background-color:#000000B3; margin-bottom: 10px">					
							    <br/>
                                <button type="submit" name="invite" class="btn btn-primary"><i class="fas fa-ticket-alt" aria-hidden="true"></i>&nbsp;create code</button>
                                <button class="btn btn-default" onclick="copyText()"><i class="fas fa-ticket-alt" aria-hidden="true"></i>&nbsp;Copy Code</button>
                                </form> 								
					</div>
				</div>
		</main>
	 </body>
</html>