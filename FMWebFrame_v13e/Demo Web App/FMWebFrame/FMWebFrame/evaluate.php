<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/evaluate.php
		
		Description:
			Loads the fmEvaluate function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			/FMWebFrame/FMWebFrame/execute-sql.php
	
		Version:
			1
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
		------------------------------------------------------------------------------------------------------------
	
		"fmEvaluate"
		
		Purpose:
			Used to evaluate any FileMaker expression as a calculation.
		
		Parameters:
			[1] $connection: The FileMaker connection object to be used.
			[2] $expression: The FileMaker expression to be evaluated.

		Output:
			Returns an associative array.
			
			Expression: The expression that was evaluated.
			Result: The result of the evaluated expression.
			
		Example:
		
			fmEvaluate 
			( 
				$fmDemo, 
				"Get(CurrentHostTimestamp)"
			);			
		
			Returns the following associative array:
			
				array(2) {
				  ["Expression"]=>
				  string(25) "Get(CurrentHostTimestamp)"
				  ["Result"]=>
				  string(20) "1/30/2014 1:08:39 PM"
				}				

		Notes:
		
			Invalid expressions will return a question mark as a result.


	*/	
	

	function fmEvaluate 
		( 
			$connection,
			$expression
		) 
	{
	

		// If the specified database connection isn't valid...
		if ( ! isset ( $connection ) ) {	
			$error_message = 'fmEvaluate failed. It looks like the database connection that was specified is invalid.';	
			die ( $error_message );
		}	
		
		
		// Setup the Find All command against the FMWebFrame Interface layout.
		$fm_request =  $connection -> newFindAllCommand( 'FMWebFrame' );
		
		
		// Create the "newPerformScriptCommand" request.
		$fm_request =  $connection -> newPerformScriptCommand( 'FMWebFrame', 'FMWebFrame', "evaluate\n" . $expression );		


		// Execute the request.
		$fm_result = $fm_request -> execute ();	

		
		// If there was an error...
		if ( FileMaker::isError($fm_result) ) {	
		
			$error_message = 'fmExecuteSQL failed with error ' . $fm_result -> code . '.';	
			die ( $error_message );					

			
		} else {	

			// Get the result.
			$result_records = $fm_result -> getRecords();
			$result_record = $result_records [0];			
			
		}


		// Convert the result into an associative array.
		$result_array = array();
		$result_array['Expression'] = $expression;		
		$result_array['Result'] = $result_record -> getField ( 'Result_Data' );	

					
		return ( $result_array );
					
	}
	

	
?>