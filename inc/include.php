<?php
	//Include all the files needed for Auth
	$path = __DIR__;
	//Adds inc directory to includes. Ensure this actually adds the path to where your files are located.
	set_include_path(get_include_path() . PATH_SEPARATOR . $path . PATH_SEPARATOR . $path . '/pages' . PATH_SEPARATOR . $path . '/modules');
	$ini_array = parse_ini_file($path."/config.ini.php"); //Config file that has configurations for site.
	$GLOBALS['ini_array'] = $ini_array;
	if (!isset($_SESSION)) {
        session_start();
		pa_session_regenerate();
    }
	
	function pa_session_regenerate($bool = false){
		ini_set('session.hash_function', 'whirlpool');
		ini_set('session.entropy_file', '/dev/urandom');
		ini_set('session.entropy_length', '512');
		ini_set('session.hash_bits_per_character', 5);
		session_set_cookie_params(0 , '/', $GLOBALS['ini_array']['domain']);
		session_name($GLOBALS['ini_array']['session_name']);
		session_regenerate_id($bool);
	}
	
	ini_set('display_errors', $GLOBALS['ini_array']['debug'] ? 'On' : 'Off'); //Enables or disables displaying of errors based on config file.
	require_once('plex_function.php');
	require_once('PlexUser.class.php');
	require_once('RememberMe.php');
?>