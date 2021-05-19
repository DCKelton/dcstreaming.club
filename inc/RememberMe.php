<?php
	//Lots of this code comes from: https://github.com/gbirke/rememberme
	require_once __DIR__.'/rememberme/vendor/autoload.php';
	use Birke\Rememberme;
	
	function redirect($destroySession=false) {
		if($destroySession) {
			pa_session_regenerate(true);
			session_destroy();
		}
		pa_session_regenerate(true);
        if ($_SESSION['return_url'] != ""){
			$url = $GLOBALS['ini_array']['protocol'];
            $url .= '://' . $_SESSION['return_url'];
            $_SESSION['return_url'] = "";
			header("Location: " . $url);
			die();
		} else {
			header("Location: index.php");
			die();
		}
		exit;
	}
	
	$storagePath = $path."/tokens";
	if(!is_writable($storagePath) || !is_dir($storagePath)) {
		die("'$storagePath' does not exist or is not writable by the web server.
				To run the example, please create the directory and give it the
				correct permissions.");
	}
	$storage = new Rememberme\Storage\File($storagePath);
	$rememberMe = new Rememberme\Authenticator($storage);
	$rememberMe->setExpireTime($GLOBALS['ini_array']['expire_time']);
	$rememberMe->setCookieName($GLOBALS['ini_array']['remember_cookie']);
	$new_cookie = $rememberMe->getCookie();
	$new_cookie->setPath('/');
	$new_cookie->setDomain($GLOBALS['ini_array']['domain']);
	$new_cookie->setSecure($GLOBALS['ini_array']['secure']);
	$new_cookie->setHttpOnly(false);
	$rememberMe->setCookie($new_cookie);
	
	//Set Salts.
	//Set any salt you wish to add here.
	
	// First, we initialize the session, to see if we are already logged in
	if (!isset($_SESSION)) {
        session_start(); 
    }

	if(!empty($_SESSION['streamnetuser'])) {
		$User = unserialize($_SESSION['streamnetuser']);
		if(!empty($_GET['logout'])) {
			$rememberMe->clearCookie($User->getToken());
			redirect(true);
		}
		if(!empty($_GET['completelogout'])) {
			$storage->cleanAllTriplets($User->getToken());
			redirect(true);
		}	
		// Check, if the Rememberme cookie exists and is still valid.
		// If not, we log out the current session
		if(!empty($_COOKIE[$rememberMe->getCookieName()]) && !$rememberMe->cookieIsValid()) {
			redirect(true);
		}
		if($User->getAuth()){
			// User is still logged in - show content
			header('X-Username: ' . $User->getUsername(), true, 200);
			if (isset($_SESSION['return_url'])){
				if ($_SESSION['return_url'] != ""){
					$url = $GLOBALS['ini_array']['protocol'];
					$url .= '://' . $_SESSION['return_url'];
					$_SESSION['return_url'] = "";
					header("Location: " . $url);
					die();
				}
			}
			if (isset($_GET['page'])){
				if ($_GET['page'] != ''){
					$_GET['page'] = strtolower($_GET['page']);
					require('pages/' . $_GET['page'] . '.page.php');
				}
			} else {
				require('main.page.php');
			}
		}else{
			//User has been loaded but not authed. This is odd.
			//print_r ($_SESSION);
			header('X-Username: ' . $User->getUsername(), true, 401);
			print 'ERROR User has been loaded but not authed. This is odd.';
		}
	}else{
		// If we are not logged in, try to log in via Rememberme cookie
		// If we can present the correct tokens from the cookie, we are logged in
		$loginresult = $rememberMe->login();
		if($loginresult) {
			if(CookieLogin($loginresult)){
				// There is a chance that an attacker has stolen the login token, so we store
				// the fact that the user was logged in via RememberMe (instead of login form)
				$_SESSION['remembered_by_cookie'] = true;
				header('X-Username: test', true, 200);
				redirect();
			} else {
				//User has logged in before. But can't anymore. Plex is now unshared?
				//print_r ($_SESSION);
				header('X-Username: ' . 'UnAuth', true, 401);
				print 'ERROR User has logged in before. But cant anymore. Plex is now unshared?';
			}
		}else{
			// If $rememberMe returned false, check if the token was invalid
			if($rememberMe->loginTokenWasInvalid()) {
				redirect();
			} else {
				if(!empty($_POST) && !isset($_POST['formname'])) {
					if (Login($_POST['PlexEmail'], $_POST['PlexPassword'])){
						pa_session_regenerate();
						// If the user wants to be remembered, create Rememberme cookie
						if(!empty($_POST['rememberme'])) {
							$User = unserialize($_SESSION['streamnetuser']);
							$rememberMe->createCookie($User->getToken());
						} else {
							$rememberMe->clearCookie();
						}
						redirect();
					} else {
						//Invalid credentials. Try again.
						header('X-Username: ' . $_POST['PlexEmail'], true, 401);
						require('login.page.php');
					}
				} else {
					//Show login.
					if (isset($_GET['page'])){
						$_GET['page'] = strtolower($_GET['page']);
						if ($_GET['page'] == "join"){
							require('pages/join.page.php');
						} else {
							require('login.page.php');
						}
					} else {
						require('login.page.php');
					}
				}
			}
		}
	}
	                
?>
