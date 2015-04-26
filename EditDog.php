<html>
	<head>
		<script src="Primary.js"></script> <!-- Reference your javascript file -->
		<style>
			td {
					text-align:right;
					padding:2px;
				}
		</style>
	</head>
	<body>
		<h1>Sheeba Cavaliers Pedigree</h1>

		<div id="content">
			<?php
			// Connect to the database server
			$link = mysql_connect('sheebacavs.dotstermysql.com', 'barry', 'karinost');
			if (!$link) { // error and quit if the link fails
				die('Could not connect: ' . mysql_error());
			}
			
			// select your database
			mysql_select_db(dogs);
			
			$dogID = $_GET['id'];
			
			//query the database
			$result = mysql_query( "Select * from tbl_Dogs where DOG_ID = ".$dogID );
			$resultM = mysql_query( "Select DOG_ID, DOG_NAME from tbl_Dogs where SEX = 'M'" );
			$resultF = mysql_query( "Select DOG_ID, DOG_NAME from tbl_Dogs where SEX = 'F'" );
			
			//Check if the results are false
			if (!$result || !$resultM || !$resultF)
			{
				echo "Database Error: ".mysql_error();
				die();
			}
			
			// $arrays = array();
			// $isNotLastResult = true;
			// $i = 0;
			
			// while (!is_null($isNotLastResult))
			// {
				// $arrays[$i] = array();
				// loop through the results
				// while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
				// {
					// $arrays[$i][] = $row;
				// }
				// $isNotLastResult = sqlsrv_next_result($result);
				// $i++;
			// }
			
			while ($row = mysql_fetch_assoc($result))
			{
				echo '
				<div>
					<h3>Edit Dog: '.$row['DOG_NAME'].'</h3><br />
					<form>
						<table>
							<tr>
								<td>Name</td><td><input type="text" style="width:100%;" name="DOG_NAME" value="'.$row['DOG_NAME'].'"></td>
								<td></td><td><input type="text" name="DOG_ID" value="'.$row['DOG_ID'].'" hidden></td>
							</tr>
							<tr>
								<td>Sex</td><td><select style="width:100%;" name="SEX">';
								if ($row['SEX'] == "M")
								{
									echo '<option value="M" selected>Male</option>
									<option value="F">Female</option>';
								}
								else
								{
									echo '<option value="M">Male</option>
									<option value="F" selected>Female</option>';
								}
								echo '</select></td>
								<td>Title</td><td><input type="text" style="width:100%;" name="TITLE" value="'.$row['TITLE'].'"></td>
							</tr>
							<tr>
								<td>Breeder</td><td><input type="text" style="width:100%;" name="BREEDER" value="'.$row['BREEDER'].'"></td>
								<td>Owner</td><td><input type="text" style="width:100%;" name="OWNER" value="'.$row['OWNER'].'"></td>
							</tr>
							<tr>
								<td>Birth Date</td><td><input type="date" style="width:100%;" value="'.$row['BIRTH_DATE'].'"></td>
								<td>Registration Number</td><td><input type="text" style="width:100%;" name="REGISTRATION_NB" value="'.$row['REGISTRATION_NB'].'"></td>
							</tr>
							<tr>
								<td>Sire</td><td><select style="width:100%;" name="SIRE_ID">
								<option value="0"></option>';
								while ($sire = mysql_fetch_assoc($resultM))
								{
									echo '<option value="'.$sire['DOG_ID'].'"';
									
									if ($row['SIRE_ID'] == $sire['DOG_ID'])
									{
										echo ' selected';
									}
									
									echo '>'.$sire['DOG_NAME'].'</option>';
								}
								echo '</select></td>
									<td>Dam</td><td><select style="width:100%;" name="DAM_ID">
									<option value="0"></option>';
									while ($dam = mysql_fetch_assoc($resultF))
									{
										echo '<option value="'.$dam['DOG_ID'].'"';
										
										if ($row['DAM_ID'] == $dam['DOG_ID'])
										{
											echo ' selected';
										}
										
										echo '>'.$dam['DOG_NAME'].'</option>';
									}
								echo '</select></td>
							</tr>
						</table>
					</form>
				</div>';
			}
		?>
		</div>
	</body>
</html>