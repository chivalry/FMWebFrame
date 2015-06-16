<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/row-get.php
		
		Description:
			Loads the fmGetRow function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			
		Version:
			2
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
				
		------------------------------------------------------------------------------------------------------------
	
	
		"fmGetRow"
		
		Purpose:
			A helper function, designed to make parsing the results of a fmExecuteSQL call easier.
		
		Parameters:
			[1] $row: The row (array element) to be parsed.
			[2] $column_names: The names to be assigned to the values in the row.
				For multiple columns, use a comma as the delimiter.
			[3] $field_separator: The separator (delimiter) between fields. 
				Default: [[[COL]]]

		Output:
			Returns an associative array.
			
		Example:
		
			foreach ( $contacts['Result_Rows_Array'] as $row ) {
		
				// Convert the reusult row into an associative array.
				$columns = fmGetRow ( $row, 'Last_Name, First_Name, City, State, Age' );

				// Display the row.
				echo '<tr>';
				echo '<td>' . $columns['Last_Name'] . '</td>';
				echo '<td>' . $columns['First_Name'] . '</td>';
				echo '<td>' . $columns['City'] . '</td>';
				echo '<td>' . $columns['State'] . '</td>';
				echo '<td>' . $columns['Age'] . '</td>';
				echo '</tr>' . "\n";

			}			
			
	*/
			
	
	function fmGetRow ( $row, $column_names, $delimiter = '[[[COL]]]' ) {
						
		// Remove any spaces between the column names.
		$column_names = str_replace ( ' ', '', $column_names );
		
		// Create an array based on the column names.
		$column_names_array = explode ( ',', $column_names );
		
		// Create an array based on the column values.
		$column_values_array = explode ( $delimiter, $row );		
		
		// The length of column names and values arrays should match.
		if ( count ( $column_names_array ) != count ( $column_values_array ) ) {
			return ( null );
		}
		
		// Initialize the array that we'll generate.
		$row_array = array();
		
		// Create the associative array.
		for ( $i = 0; $i <= ( count ( $column_names_array ) - 1 ); $i++) {
					
			$row_array [ $column_names_array[$i] ] = $column_values_array[$i];
		
		}
		
		return ( $row_array );		
	
	}	
	
	
	
?>