<?php
	function dynamicManagement($User, $uri = false) {
		//Determine if management appears and what items should appear.
		//Array key is the name that will appear in the dropdown menu.
		//First element of the array is the authURI. Second element is the URL.
		$management_items = array();
		$return_items = array();
		foreach ($management_items as $item => $info) {
			if ($User->authURI($info[0])){
				$return_items[$item] = $info[1];
			}
		}
		return $return_items;
	}
?>
