<?php	

	/*

		File: 
			/FMWebFrame/FMWebFrame/databases-connect.php
		
		Description:
			Creates connection objects for all elements of the $fm_databases array, which 
			is set in FMWebFrame's settings file.
		
		Dependencies:
			/FMWebFrame/FMWebFrame/database-test.php
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
	
		Version:
			1
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.

			
		
	*/


	// Loop over elements in the $fm_databases array...
	foreach ( $fm_databases as $fm_database ) {
	
		// Create a connection object.
		$fm = new FileMaker ();
		$fm->setProperty ( 'hostspec', $fm_database['hostspec'] );
		$fm->setProperty ( 'database', $fm_database['database'] );
		$fm->setProperty ( 'username', $fm_database['username'] );
		$fm->setProperty ( 'password', $fm_database['password'] );
		
		// Create the name for the connection object.
		$nickname = $fm_database['nickname'];
		
		// Assign the name to the connection object. 
		// Note the "$$" prefix. 
		// See "Variable variables" discussed here: http://php.net/manual/en/language.variables.variable.php
		$$nickname = $fm;
		
		// Test the database.
		if ( TEST_DB_CONNECTIONS ) {
			fmDatabaseTest ( $fm_database['nickname'], $$nickname );
		}

	}
	
?>