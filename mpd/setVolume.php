<?php
	system ( 'mpc  volume '. $_POST['volume']. " | grep 'volume' |  grep -oE '[0-9]{1,2}'" ); 
?>
