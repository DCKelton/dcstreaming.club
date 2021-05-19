<!DOCTYPE html>
<html lang="en">
	<head>
		<!--  Meta  -->
		<?php require_once 'inc/meta.php'; ?>
		<title>StreamNet - Sign out</title>
    </head>
	
	<body>
	
		<main>
		
		<div>
		<h1>Bye StreamNet Club</h1>
		</div>
		
		<?php
		$rememberMe->clearCookie();
		$_SESSION = array();
		  if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
		session_regenerate_id();
	    header("Location: " . $GLOBALS['ini_array']['signout_return']);
		?>
							
		</main>
		
	</body>
</html>
