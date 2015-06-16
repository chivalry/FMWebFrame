<?php	

	/*

		File: 
			/FMWebFrame/FMWebFrame/database-test.php
		
		Description:
			Loads the fmDatabaseTest function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			/FMWebFrame/FMWebFrame/database-connect.php
	
		Version:
			2
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
			2014-07-16	Tim Dietrich
				Updated error messages for clarity.
				
		------------------------------------------------------------------------------------------------------------
	
		"fmDatabaseTest"
		
		Purpose:
			Used to test connectivity to a specified database.
			
			The function is typically called during the database connection setup process. See "databases-connect.php"
			for details.
			
			If the database cannot be accessed using the credentials that were specified (in the FMWebFrame
			settings file), then an error is thrown and the request dies.
			
			Otherwise, tests are done against the database to ensure that it is properly configured for use
			by FMWebFrame. For example, it checks to see if the required FMWebFrame layout and script
			are available.
		
		Parameters:
			[1] $connection_name: The name assigned to the connection object.
			[2] $connection: The actual FileMaker connection object.
				
		Output:
			Detailed error information, if applicable.
			
		Returns:
			Nothing. 

			
		
	*/

	function fmDatabaseTest ( $connection_name, $connection ) {
	
		// Check to see if the connection specified is valid.
		if ( $connection === null ) {
			echo '<p>fmWebFrame Error: Invalid connection (' . $connection_name . ') specified.</p>';
			echo '<p>Check FMWebFrame\'s settings file to confirm that the connection has been added to the $fm_databases array.</p>';
			die;
		}
		
		
		// Get the connection object's properties.
		$conn_properties = $connection -> getProperties();

		
		// Get a list of databases that are available.
		$fm_result = $connection -> listDatabases ();
		if ( FileMaker::isError( $fm_result ) ) {		
			echo 'fmWebFrame Error: ' . $fm_result -> code . '<br/>';
			echo $fm_result -> message;
			die;			
		}	
		
		
		// Check to see if the database associated with the connection is accessible.
		$database_valid = FALSE;
		foreach ( $fm_result as $database_name ) {		
			if ( $database_name == 	$conn_properties["database"] ) {
				$database_valid = TRUE;
				break;
			}
		}	
		if ( ! $database_valid ) {
			echo '<p>fmWebFrame Error: Database "' . $conn_properties["database"] . '" is not accessible.</p>';
			echo '<p>Review FMWebFrame\'s settings to confirm that the connection\'s properties have been set properly (in the $fm_databases array).</p>';
			die;		
		}	
		
		
		
		// Get a list of layouts that are available.
		$fm_result = $connection -> listLayouts ();
		if ( FileMaker::isError( $fm_result ) ) {		
			echo 'fmWebFrame Error: ' . $fm_result -> code . '<br/>';
			echo $fm_result -> message;
			die;			
		}			
		
		
		// Check to see if the FMWebFrame layout is accessible.
		$layout_visible = FALSE;
		foreach ( $fm_result as $layout_name ) {		
			if ( $layout_name == 'FMWebFrame' ) {
				$layout_visible = TRUE;
				break;
			}
		}	
		if ( ! $layout_visible ) {
			echo '<p>fmWebFrame Error: Unable to access the "FMWebFrame" layout in database "' . $conn_properties["database"] . '."</p>';
			echo '<p>Review the privilege set that the "' . $conn_properties["username"] . '" account has been assigned to, and confirm that it has the privileges required to view the layout.</p>';
			die;		
		}
		
		
		// Get a list of scripts that are available.
		$fm_result = $connection -> listScripts ();
		if ( FileMaker::isError( $fm_result ) ) {		
			echo 'fmWebFrame Error: ' . $fm_result -> code . '<br/>';
			echo $fm_result -> message;
			die;			
		}			
		
		
		// Check to see if the FMWebFrame script is accessible.
		$script_visible = FALSE;
		foreach ( $fm_result as $script_name ) {		
			if ( $script_name == 'FMWebFrame' ) {
				$script_visible = TRUE;
				break;
			}
		}	
		if ( ! $script_visible ) {
			echo '<p>fmWebFrame Error: Unable to access the "FMWebFrame" script in database "' . $conn_properties["database"] . '."</p>';
			echo '<p>Review the privilege set that the "' . $conn_properties["username"] . '" account has been assigned to, and confirm that it has the privileges required to execute the script.</p>';
			die;		
		}		
		
	}
	
?>