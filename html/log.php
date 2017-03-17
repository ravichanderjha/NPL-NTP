<?php

    // configuration
    require("../includes/config.php");


    if (!isset($_GET["ID"]))
    {
	$results = query("INSERT INTO TIMESTAMP (USER_IP) VALUES(?)", $_SERVER["REMOTE_ADDR"]);

        $rows = query("SELECT LAST_INSERT_ID() as ID");
        $ID = $rows[0]["ID"];
	echo $ID;
    }    
    else
    {
	echo "aaaa";
    }
?>
