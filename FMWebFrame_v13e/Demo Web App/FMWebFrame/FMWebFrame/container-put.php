<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/container-put.php
		
		Description:
			Loads the fmPutContainer function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
	
		Version:
			1
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
		------------------------------------------------------------------------------------------------------------
	
		"fmPutContainer"
		
		Purpose:
			Used to place an uploaded file into a container field.
		
		Parameters:
			[1] $connection: The FileMaker connection object to be used.
			[2] $layout_name: The name of the layout on which the container appears.
			[3] $container_field_name: The name of the container into which the file is to be stored.
			[4] $record_object: The record object that corresponds to the record on which the file is to be stored.
			[5] $uploaded_file_handle: The file handle that PHP assigned to the uploaded file. See example below.
				
		Output:
			None.
			
		Returns:
			The record object for the record that the file was uploaded to.
			
		Example:
		
			 Suppose that we have Web form that includes an input field of type "file" named "uploaded_file", like this:
			 	<input type="file" name="uploaded_file"> 
			 	
			 During the processing of a submitted form, we could store the file in a container field using fmPutContainer, 
			 	like this:

				fmPutContainer
				( 
					$fmDemo, 
					'Resource - Form',
					'Resource',
					$uploaded_record,
					$_FILES['uploaded_file']
				);
				
			In this example:

			• $fmDemo is the name of the database connection object that was used.
			• "Resource - Form" is the name of the layout that the container field appears on.
			• "Resource" is the name of the container field that the file is to be stored in.
			• $uploaded_record is the FileMaker record object that the file is to be saved to.
			• And "_FILES['uploaded_file']" is the file handle that PHP assigned to the uploaded file.
			
			
			
	*/	
		
		
		
	function fmPutContainer
		( 
			$connection = null, 
			$layout_name = null,
			$container_field_name = null,
			$record_object = null,			
			$uploaded_file_handle = null
		) {			
		
			// Move the file from PHP's temp folder to the uploads folder.
			move_uploaded_file( $uploaded_file_handle['tmp_name'], UPLOAD_PATH . '/' . $uploaded_file_handle['name'] );
						
			// Set the URL to the uploaded file.		
			$file_url = UPLOAD_URL . '/' . $uploaded_file_handle['name'];			
						
			// Setup the request as an "edit" command.	
			$fm_request = $connection -> newEditCommand( $layout_name, $record_object -> getRecordId() );
			$fm_request -> setField( $container_field_name, '' );
			$fm_request -> setScript( 'FMWebFrame', 'Upload' . "\n" . $container_field_name . "\n" . $file_url );
			$fm_result = $fm_request -> execute();	
			
			if ( FileMaker::isError( $fm_result ) ) {
				$errors = '<h1>fmPutContainer: An unexpected error has occurred.</h1>';
				echo "Error Code: " . $fm_result -> code . "<br>";
				echo "Error Message: " . $fm_result -> getMessage() . "<br>";
				die;
			}						
		
			// Delete the temp file.
			unlink ( UPLOAD_PATH . '/' . $uploaded_file_handle['name'] );	
			
			// Get the record that the file was uploaded to.
			$records = $fm_result -> getRecords();
			$record = $records[0];				
			
			return ( $record );		
		
		}
		

	
?>