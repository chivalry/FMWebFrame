<?php	

	/*
 
		File: 
			/application/executesql-handler.php
		
		Description:
			An example of FMWebFrame's ExecuteSQL function.
			
			This is the first step of the demo, providing a form that the visitor can use to enter 
			criteria used to perform a SELECT statement.

		Dependencies:
			FMWebFrame
	
		Dependents:
			executesql-form.php
	
		Version:
			1
	
		History:
		
			2014-01-14	Tim Dietrich
				Initial version.	
				
		Comments:		
			See "executesql-form.php" for comments about this demo.
					
	*/

	// Initialize the request.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );	
	
	// If no criteria was specified...
	if ( ( $_GET['first_name'] == '' ) and ( $_GET['last_name'] == '' ) and ( $_GET['state'] == '' ) ) {	
		require_once ( dirname(__FILE__) . '/executesql-form.php' );	
		die;	
	}	
	
	// Reverse the magic quotes, and properly delimit single quotes.
	if ( get_magic_quotes_gpc() ) {
		foreach ( $_GET as $nm => &$s ) {
			$s = stripslashes($s);			
		}
	}		
			
	// Build the SELECT statement.
	$query = 'SELECT Last_Name, First_Name, City, State, Zip_Code FROM Contacts WHERE';
	if ( $_GET['first_name'] !== '' ) { $query .= ' First_Name LIKE \'' . fmSubstitute ( $_GET['first_name'], '\'', '\'\'' ) . '%\''; }
	if ( $_GET['last_name'] !== '' ) {	
		if ( $_GET['first_name'] !== '' ) { $query .= ' AND'; }
		$query .= ' Last_Name LIKE \'' . fmSubstitute ( $_GET['last_name'], '\'', '\'\'' ) . '%\'';
	}	
	if ( $_GET['state'] !== '' ) {	
		if ( ( $_GET['first_name'] !== '' ) or ( $_GET['last_name'] !== '' ) ) { $query .= ' AND'; }
		$query .= ' State = \'' . fmSubstitute ( $_GET['state'], '\'', '\'\'' ) . '\'';
	}	
	$query .= ' ORDER BY Last_Name, First_Name';
	
	// Execute the query.
	$contacts = fmExecuteSQL ( $fmDemo, $query );
	
	// Set page title.	
	$ui_title = "FMWebFrame Demo | ExecuteSQL";
	
	// Start output buffering.
	ob_start();	
	
	// Page header.
	echo '<h1>ExecuteSQL</h1>';
		
	// If there was a problem with the query...
	if ( $contacts == '?' ) {
	
		echo '<p>Oops! An unexpected error occurred.</p>';
		echo '<p><a href="executesql-form.php">Click here</a> to try again.</p>';
		
	} elseif ( $contacts == '' ) {
	
		echo '<p>Sorry, but no contacts were found that meet your criteria.</p>';
		echo '<p><a href="executesql-form.php">Click here</a> to try again.</p>';	
		
	} else {
	
		// Display the number of contacts returned.
		echo '<p>' . count ( $contacts ) . ' contacts were found. <a href="executesql-form.php">Click here</a> to search again.</p>';

		// Display the results in a table.
		echo '<table class="gridtable">';
		
			echo '<tr>';
				echo '<th>Last Name</th>';
				echo '<th>First Name</th>';
				echo '<th>City</th>';
				echo '<th>State</th>';
				echo '<th>Zip Code</th>';
			echo '</tr>';
			
			// Loop over the results...
			foreach ( $contacts as $row ) {
	
				// Convert the row into an associative array. (Makes it easier to use the results.)
				$columns = fmGetRow ( $row, 'Last_Name, First_Name, City, State, Zip_Code' );

				// Display the row.
				echo '<tr>';
					echo '<td>' . $columns['Last_Name'] . '</td>';
					echo '<td>' . $columns['First_Name'] . '</td>';
					echo '<td>' . $columns['City'] . '</td>';
					echo '<td>' . $columns['State'] . '</td>';
					echo '<td>' . $columns['Zip_Code'] . '</td>';
				echo '</tr>' . "\n";
			
			}
			
		echo '</table>';		
		
	}

	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>