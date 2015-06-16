<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/execute-sql.php
		
		Description:
			Loads the fmExecuteSQL function.
		
		Dependencies:
			/FMWebFrame/FMWebFrame/execute-sql.php
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			
		Version:
			2
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
			2014-06-14	Tim Dietrich
				Complete rewrite to make use of fmEvaluate.
				
		------------------------------------------------------------------------------------------------------------
	
		"fmExecuteSQL"
		
		Purpose:
			Used to perform a SQL SELECT statement.
		
		Parameters:
			[1] $connection: The FileMaker connection object to be used.
			[2] $query: The SQL SELECT statement to be performed.
			[3] $delimiter: The delimiter used between fields. Default: [[[COL]]]

		Output:
			Returns a "?" if the SELECT statement is invalid.
			Returns an empty string if the SELECT statement is valid but no rows were returned.
			Otherwise, it returns an array representing the rows that were returned, with the $field_separator
			as the column delimiter.
			
		Example:
		
			fmExecuteSQL ( $fmDemo, "SELECT * FROM Contacts WHERE Last_Name LIKE 'Smit%'" );	
		
		Notes:
		
			Starting with FileMaker 13, the ExecuteSQL function provides support for
			"OFFSET" and "FETCH FIRST ROWS" clauses. Use those to handle paging of 
			results.
			
			fmExecuteSQL uses "[[[ROW]]]" as the record delimiter for the call to ExecuteSQL,
			and also uses it to explode the results into an array.

	*/	
	

	function fmExecuteSQL ( 
			$connection, 
			$query, 
			$delimiter = '[[[COL]]]' 
		) {


		// If the specified database connection isn't valid...
		if ( ! isset ( $connection ) ) {	
			$error_message = 'fmExecuteSQL failed. The specified database connection is invalid.';	
			die ( $error_message );
		}
		
		
		// Execute the query using an ExecuteSQL via fmEvaluate.
		$fm_result = fmEvaluate ( $connection, "ExecuteSQL ( \"" . $query . "\"; \"[[[COL]]]\", \"[[[ROW]]]\" )" );		
		
		
		// If rows were returned...
		if ( ( $fm_result ['Result'] != '?' ) and ( $fm_result ['Result'] != '' ) ) {
			// Return the rows as an array.
			return ( explode ( '[[[ROW]]]', $fm_result ['Result'] ) );
		}	


		// Return the unexpected result.
		// It will likely be an empty string (indicating that the SELECT statement returned no rows)
		// or a "?" (which indicates that the SELECT statement was invalid).
		return ( $fm_result ['Result'] );

					
	}
	

	
	
?>