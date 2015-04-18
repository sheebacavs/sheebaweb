<?php
	// Connect to the database server
	$link = mysql_connect('sheebacavs.dotstermysql.com', 'barry', 'karinost');
	if (!$link) { // error and quit if the link fails
		die('Could not connect: ' . mysql_error());
	}
	
	// select your database
	mysql_select_db(dogs);
	
	// query the database
	$result = mysql_query("Select DOG_ID, DOG_NAME from tbl_Dogs");
	
	// Check if the results are false
    if (!$result)
    {
        echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
        die();
    }

	// create your form and select box  -- your action calls the javascript function getPedigree()
	echo "
	<form action=\"javascript:search()\">
		<input id=\"searchBox\" type=\"text\">
		<input type=\"submit\" value=\"Search\">
	</form>
	
	<select id=\"dogSelect\">";
		// loop through the results
		while ($row = mysql_fetch_assoc($result))
		{
			// Create your options with DOG_IDs and DOG_NAMEs
			echo "<option value=\"".$row['DOG_ID']."\">".$row['DOG_NAME']."</option>";
		}
	// On submit, you call the form's action -- value is the text of the button
	echo "</select>
	<input type=\"submit\" onclick=\"getPedigree()\" value=\"Select Dog\">
	<input type=\"submit\" onclick=\"editDog()\" value=\"Edit Dog\">";

?>