<?php

	// Database connection stuff
	
	// Connect to the database server
	$link = mysql_connect('sheebacavs.dotstermysql.com', 'barry', 'karinost');
	if (!$link) { // If the connection failed...
		die('Could not connect: ' . mysql_error()); // Quit and print out the error
	}
	
	// select the database
	mysql_select_db(dogs);
	
	// Get the value passed in on the "GET"
	$baseDogID = $_GET['id'];
	
	// Create a function to get the dog name
	function GetDogName($id)
	{
		if ($id == 0)
		{
			return "|UNKNOWN";
		}
		
		// set the query
		$query = "Select Concat(TITLE, '|',TITLE, ' ', DOG_NAME) as DOG_NAME from tbl_Dogs where DOG_ID = ".$id;
		// get the results of the query
		$result = mysql_query($query);
	
		// if the result comes back false,
		if (!$result)
		{
			// throw an error and quit
			echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
			die();
		}
		
		// loop through the results
		while ($row = mysql_fetch_assoc($result))
		{
			$dogName = $row['DOG_NAME'];
			if($dogName == "| " || $dogName == "")
			{
				$dogName = "UNKNOWN";
			}
			return $dogName; // Grab the 'DOG_NAME' out of the array
		}
	}
	
	function GetDogBreederAndBirthdate($id)
	{
		if ($id == 0)
		{
			return "BREEDER AND BIRTHDATE UNKNOWN";
		}
		
		// set the query
		$query = "Select BREEDER, BIRTH_DATE from tbl_Dogs where DOG_ID = ".$id;
		// get the results of the query
		$result = mysql_query($query);
	
		// if the result comes back false,
		if (!$result)
		{
			// throw an error and quit
			echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
			die();
		}
		
		// loop through the results
		while ($row = mysql_fetch_assoc($result))
		{
			$breeder = "UNKNOWN";
			if ($row['BREEDER'] !== "")
			{
				$breeder = $row['BREEDER'];
			}
			
			$birth_date = "UNKNOWN";
			if ($row['BIRTH_DATE'] !== "0000-00-00")
			{
				$birth_date = $row['BIRTH_DATE'];
			}
			return 'Breeder: '.$breeder.'<br />Birth Date: '.$birth_date; // Grab the 'BREEDER' and 'BIRTH_DATE' out of the array
		}
	}
	
	// Create a function to get the sire ID
	function GetSire($id)
	{
		if ($id == 0)
		{
			return 0;
		}
		
		$query = "Select SIRE_ID from tbl_Dogs where DOG_ID = ".$id;
		$result = mysql_query($query);
	
		if (!$result)
		{
			echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
			die();
		}
		
		while ($row = mysql_fetch_assoc($result))
		{
			return $row['SIRE_ID'];
		}
	}
	
	// Create a function to get the dam ID
	function GetDam($id)
	{
		if ($id == 0)
		{
			return 0;
		}
		
		$query = "Select DAM_ID from tbl_Dogs where DOG_ID = ".$id;
		$result = mysql_query($query);
	
		if (!$result)
		{
			echo "Database Error: " . mysql_error()."<br /><b>$query</b><br />";
			die();
		}
		
		while ($row = mysql_fetch_assoc($result))
		{
			return $row['DAM_ID'];
		}
	}
	
	$dogName = GetDogName($baseDogID);
	
	// Get the Sire and Dam names
	$sire1 = GetSire($baseDogID);
	$sire1Name = GetDogName($sire1);
	$dam1 = GetDam($baseDogID);
	$dam1Name = GetDogName($dam1);
	
	// sire 1 sire and dam -- 2a
	$sire2a = GetSire($sire1);
	$sire2aName = GetDogName($sire2a);
	$dam2a = GetDam($sire1);
	$dam2aName = GetDogName($dam2a);
	
	// dam 1 sire and dam -- 2b
	$sire2b = GetSire($dam1);
	$sire2bName = GetDogName($sire2b);
	$dam2b = GetDam($dam1);
	$dam2bName = GetDogName($dam2b);
	
	// sire 2a sire and dam -- 3a
	$sire3a = GetSire($sire2a);
	$sire3aName = GetDogName($sire3a);
	$dam3a = GetDam($sire2a);
	$dam3aName = GetDogName($dam3a);
	
	// dam 2a sire and dam --3b
	$sire3b = GetSire($dam2a);
	$sire3bName = GetDogName($sire3b);
	$dam3b = GetDam($dam2a);
	$dam3bName = GetDogName($dam3b);
	
	// sire 2b sire and dam --3c
	$sire3c = GetSire($sire2b);
	$sire3cName = GetDogName($sire3c);
	$dam3c = GetDam($sire2b);
	$dam3cName = GetDogName($dam3c);
	
	// dam 2b sire and dam --3d
	$sire3d = GetSire($dam2b);
	$sire3dName = GetDogName($sire3d);
	$dam3d = GetDam($dam2b);
	$dam3dName = GetDogName($dam3d);
	
	// sire 3a sire and dam --4a
	$sire4a = GetSire($sire3a);
	$sire4aName = GetDogName($sire4a);
	$dam4a = GetDam($sire3a);
	$dam4aName = GetDogName($dam4a);
	
	// dam 3a sire and dam --4b
	$sire4b = GetSire($dam3a);
	$sire4bName = GetDogName($sire4b);
	$dam4b = GetDam($dam3a);
	$dam4bName = GetDogName($dam4b);
	
	// sire 3b sire and dam --4c
	$sire4c = GetSire($sire3b);
	$sire4cName = GetDogName($sire4c);
	$dam4c = GetDam($sire3b);
	$dam4cName = GetDogName($dam4c);
	
	// dam 3b sire and dam --4d
	$sire4d = GetSire($dam3b);
	$sire4dName = GetDogName($sire4d);
	$dam4d = GetDam($dam3b);
	$dam4dName = GetDogName($dam4d);
	
	// sire 3c sire and dam --4e
	$sire4e = GetSire($sire3c);
	$sire4eName = GetDogName($sire4e);
	$dam4e = GetDam($sire3c);
	$dam4eName = GetDogName($dam4e);
	
	// dam 3c sire and dam --4f
	$sire4f = GetSire($dam3c);
	$sire4fName = GetDogName($sire4f);
	$dam4f = GetDam($dam3c);
	$dam4fName = GetDogName($dam4f);
	
	// sire 3d sire and dam --4g
	$sire4g = GetSire($sire3d);
	$sire4gName = GetDogName($sire4g);
	$dam4g = GetDam($sire3d);
	$dam4gName = GetDogName($dam4g);
	
	// dam 3d sire and dam --4h
	$sire4h = GetSire($dam3d);
	$sire4hName = GetDogName($sire4h);
	$dam4h = GetDam($dam3d);
	$dam4hName = GetDogName($dam4h);
	
	
	// echo out the table, inputting the names in the proper places
	$split = explode('|', $dogName);
	echo '<h2>Pedigree of '.$split[1].'</h2>
	<table border="1">
		<tr> <!-- ROW 1 -->
			<td rowspan="16"';  // First column of the first row -- spans 16 rows
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			else
			{
				echo ' style="align:center;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="8"'; // Second column of the first row -- spans 8 rows
			$split = explode('|', $sire1Name);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="4"';
			$split = explode('|', $sire2aName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="2"';
			$split = explode('|', $sire3aName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4aName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr>  <!-- ROW 2 -->
			<td rowspan="1"';
			$split = explode('|', $dam4aName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr>  <!-- ROW 3 -->
			<td rowspan="2"';
			$split = explode('|', $dam3aName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4bName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 4 -->
			<td rowspan="1"';
			$split = explode('|', $dam4bName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 5 -->
			<td rowspan="4"';
			$split = explode('|', $dam2aName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="2"';
			$split = explode('|', $sire3bName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4cName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 6 -->
			<td rowspan="1"';
			$split = explode('|', $dam4cName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 7 -->
			<td rowspan="2"';
			$split = explode('|', $dam3bName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4dName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 8 -->
			<td rowspan="1"';
			$split = explode('|', $dam4dName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 9 -->
			<td rowspan="8"';
			$split = explode('|', $dam1Name);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="4"';
			$split = explode('|', $sire2bName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="2"';
			$split = explode('|', $sire3cName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4eName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 10 -->
			<td rowspan="1"';
			$split = explode('|', $dam4eName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 11 -->
			<td rowspan="2"';
			$split = explode('|', $dam3cName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4fName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 12 -->
			<td rowspan="1"';
			$split = explode('|', $dam4fName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 13 -->
			<td rowspan="4"';
			$split = explode('|', $dam2bName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="2"';
			$split = explode('|', $sire3dName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4gName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 14 -->
			<td rowspan="1"';
			$split = explode('|', $dam4gName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 15 -->
			<td rowspan="2"';
			$split = explode('|', $dam3dName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
			<td rowspan="1"';
			$split = explode('|', $sire4hName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
		<tr> <!-- ROW 16 -->
			<td rowspan="1"';
			$split = explode('|', $dam4hName);
			
			if ($split[0] !== "")
			{
				echo ' style="color:red;"';
			}
			
			echo '>'.$split[1].'</td>
		</tr>
	<table><br />'.GetDogBreederAndBirthdate($baseDogID);

?>