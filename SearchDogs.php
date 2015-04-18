<?php
	// Connect to the database server
	$link = mysql_connect('sheebacavs.dotstermysql.com', 'barry', 'karinost');
	if (!$link) { // error and quit if the link fails
		die('Could not connect: ' . mysql_error());
	}
	
	// select your database
	mysql_select_db(dogs);
	
	$searchText = $_GET['searchText'];
	
	//query the database
	$result = mysql_query("Select DOG_ID, DOG_NAME from tbl_Dogs where DOG_NAME like '%".$searchText."%'");
	
	//Check if the results are false
    if (!$result)
    {
        echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
        die();
    }

	//create your form and select box  -- your action calls the javascript function getPedigree()
	echo "<div><h3>Search Results For '".$searchText."'</h3>Click on dog for pedigree.<br /><br />";
			//loop through the results
			while ($row = mysql_fetch_assoc($result))
			{
				echo '<a style="cursor:pointer;" onclick="javascript:getPedigree('.$row['DOG_ID'].')">'.$row['DOG_NAME'].'</a><br />';
			}
		echo "</div>";

?>