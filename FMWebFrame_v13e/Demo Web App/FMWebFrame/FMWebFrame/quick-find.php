<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/quick-find.php
		
		Description:
			Loads the fmQuickFind function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			
		Version:
			2
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
			2014-07-16	Tim Dietrich
				Now using the "newFindAnyCommand" method instead of "newFindllCommand."
				
		------------------------------------------------------------------------------------------------------------
	
		"fmQuickFind"
		
		Purpose:
			Used to perform a Quick Find (a find across multiple fields on a layout).
		
		Parameters:
			[1] $connection: The FileMaker connection object to be used.
			[2] $quickfind_layout: The name of the layout on which the Quick Find is to be performed.
			[3] $query: The value to search for.
			[4] $result_layout: The name of the layout from which results are to be returned.
			[5] $sort: Optional sort instructions. (See below.)
			[6] $start_row: The starting record to be returned. Default is 1.
			[7] $max_rows: The maximum number of records to be returned.

		Output:
			FileMaker_Result object
			
		Notes:
		
			To specify sort instructions, provide the field name to be sorted and the sort type (ASC / DESC).
			If sorting by multiple fields, comma-separate them.
			For example: Last_Name DESC, First_Name ASC
			
			Remember that this is a PHP function, so all params must be passed by position. 		

	*/
	
	function fmQuickFind 
		( 
			$connection, 
			$quickfind_layout,
			$query,
			$result_layout = null,
			$sort = null,
			$start_row = 1, 
			$max_rows = 999999999
		) 
	{


		// If the specified database connection isn't valid...
		if ( ! isset ( $connection ) ) {	
			$error_message = 'fmQuickFind failed. It looks like the database connection that was specified is invalid.';	
			die ( $error_message );
		}	
				
		// Create the FileMaker script paramater.
		$params = "Quick Find\n";
		$params .= $query . "\n";		
				
				
		// Find any record.
		$fm_request =  $connection -> newFindAnyCommand( $quickfind_layout );
	
		// Call the FMWebFrame script as the pre-sort script.
		$fm_request -> setPreSortScript( 'FMWebFrame', $params );

		// Specify the starting record to be returned, and the maximum number of records to be returned.
		$fm_request -> setRange( $start_row - 1, $max_rows );
	
		// If a result layout was specified...
		if ( $result_layout !== null ) {
			$fm_request -> setResultLayout( $result_layout );
		}
				
		// If a sort order was specified...
		if ( $sort !== null ) {
		
			// Remove extra spaces after commas.
			$sort = fmSubstitute ( $sort, ', ', ',' );
			
			// Convert the string to an array.
			$sort_array = explode ( ',', $sort );
			
			// Loop over the array to add the sort rules...
			for ( $i = 0; $i < count ( $sort_array ); $i++ ) {			
				$sort_spec = explode ( ' ', $sort_array[$i] );				
				$direction = $sort_spec [ count ( $sort_spec ) - 1 ];
				$field = implode (' ', array_slice ( $sort_spec, 0, count ( $sort_spec ) - 1 ) );				
				$fm_request -> addSortRule( $field, ( $i + 1 ), fmlower ( $direction ) . 'end' );				
			}
		}
	
		// Execute the request.
		$fm_result = $fm_request -> execute ();			
				
		// Return the result.
		return ( $fm_result );		
	
	}	
	
	
	
?>