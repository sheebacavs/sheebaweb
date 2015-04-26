<?php
	// Connect to the database server
	$link = mysql_connect('sheebacavs.dotstermysql.com', 'barry', 'karinost');
	if (!$link) { // error and quit if the link fails
		die('Could not connect: ' . mysql_error());
	}
	
	// select your database
	mysql_select_db(dogs);
	
	// query the database
	$result = mysql_query("Select 1 from tbl_Roles where UserID = '".$_POST['username']."' and Password = '".$_POST['password']."'");
	
	// Check if the results are false
    if (!$result)
    {
        echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
        die();
    }
	
	if(mysql_num_rows($result)==0)
	{
		echo "FAIL";
	}
?>