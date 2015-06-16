<?php


	/*
 
		File: 
			/application/container-upload-handler.php
		
		Description:
			An example of FMWebFrame's "container upload" function, which
			makes it possible to store uploaded files in container fields.						
			
			This is the second step of the demo, which processes a form
			submitted by a visitor.				
		
		Dependencies:
			FMWebFrame
	
		Dependents:
			container-upload-form.php
	
		Version:
			1
	
		History:
		
			2014-06-14	Tim Dietrich
				Initial version.	
				
		Comments:
		
			See the comments for "container-upload-form.php" regarding the
			limitations imposed for this demo.		
		
	*/
	

	// Initialize the request.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );
	
	// Create an array of supported mime types.
	$supported_mime_types = array();	
	$supported_mime_types[] = "application/pdf"; // Portable Document Format
	$supported_mime_types[] = "image/bmp"; // Bitmap image
	$supported_mime_types[] = "image/gif"; // GIF image
	$supported_mime_types[] = "image/jpeg"; // JPEG image
	$supported_mime_types[] = "image/png"; // Portable Network Graphics image		

	// Specify the maximum upload size size.	
	define ( 'UPLOADS_MAXIMUM_FILE_SIZE', 1 * 1024 * 1024 ); // Measured in bytes. ex: 1Mb = 1 * 1024 * 1024		

	
	// Initialize the errors array.
	$errors = array();

	// If no file was uploaded...
	if ( $_FILES['uploaded_file']['tmp_name'] == '' ) {

		$errors[] = 'You did not choose a file.';
	
	} else {		
			
		// If the file uploaded is not supported...
		if ( array_search( $_FILES['uploaded_file']['type'], $supported_mime_types) === FALSE ) {
	
			$errors[] = 'This type of file (' . $_FILES['uploaded_file']['type'] . ') is not supported.';
		
		}
		
		// If the file is too large...						
		if ( $_FILES['uploaded_file']['size'] > UPLOADS_MAXIMUM_FILE_SIZE ) {
			$errors[] = 'This size of the file (' . $_FILES['uploaded_file']['size'] . ' bytes) exceeds the maximum size allowed (' . UPLOADS_MAXIMUM_FILE_SIZE . ' bytes).';
		}
							
	}

	
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Container Uploading";	
	
	// Start output buffering.
	ob_start();	
	
	echo '<h1>Container Uploading</h1>';
	
	// If there were validation errors, or no form has been submitted yet...
	if ( count ( $errors ) > 0 ) {	
	
		echo '<p>Sorry, but there were problems encountered that prevented the file from being uploaded:';
		echo '<ul>';
		foreach ( $errors as $error ) {
			echo '<li>' . $error . '</li>';
		}		
		echo '</ul>';
		echo '<a href="container-upload-form.php">Click here</a> to try again.';
		echo '</p>';	
		
	} else {
				
		// Create a record in the Resources table.
		$fm_request = $fmDemo -> newAddCommand( 'Resource - Form' );
		$fm_request->setField( 'Title', 'Demo Upload' );
		$fm_request->setField( 'File_Name', $_FILES['uploaded_file']['name'] );
		$fm_request->setField( 'File_Type', $_FILES['uploaded_file']['type'] );
		$fm_request->setField( 'File_Size', $_FILES['uploaded_file']['size'] );
		$fm_request->setField( 'Uploader_IP_Address', fmGetRemoteAddress() );	
		$fm_result = $fm_request -> execute();	
				
		if ( FileMaker::isError( $fm_result ) ) {
			echo '<h2>An Unexpected Error Has Occurred</h2>';
			echo "Error Code: " . $fm_result -> code . "<br>";
			echo "Error Message: " . $fm_result -> getMessage() . "<br>";
		} else {
		
			// Get the record that was just created.
			$resource_records = $fm_result -> getRecords();
			$resource_record = $resource_records[0];		
		
			// Upload the file into the new record's container field.
			$resource_record_updated = fmPutContainer
				( 
					$fmDemo, 						// The database connection object.
					'Resource - Form',				// The name of the layout on which the container appears.
					'Resource',						// The name of the container field into which the file is to be stored.
					$resource_record,				// The record object.
					$_FILES['uploaded_file']		// The file handle that PHP assigned to the uploaded file.
				);

			// fmDump ( $resource_record_updated, TRUE, 'resource_record_updated') ;	
		
			
			// Get an FMWebFrame URL for the uploaded file.
			$uploaded_file_url = fmGetContainerURL				
				( 
					$fmDemo, 						// The database connection object.
					$resource_record_updated,		// The record object.
					'Resource',						// The name of the container field.
					TRUE,							// Indicates if the generated URL should include a unique ID.
					NULL,							// An optional virtual subfolder to use in the URL.
					60 * 5,							// The max lifetime of the URL / file (in seconds).
					NULL							// The rule to use to determine if the user has permission to access the resource.
				);						

			
			echo '<p style="font-weight: bold;">The file was uploaded successfully.</p>';	
			echo '<p>To view the file, click here:<br />';
			echo '<a href="' . $uploaded_file_url . '" target="_uploaded">';
			echo $uploaded_file_url . '</a>';
			echo '</p>';
			
		}
			
	}
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );	


?>