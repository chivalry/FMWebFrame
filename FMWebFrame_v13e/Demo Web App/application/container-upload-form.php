<?php


	/*
 
		File: 
			/application/container-upload-form.php
		
		Description:
			An example of FMWebFrame's "container upload" function, which
			makes it possible to store uploaded files in container fields.						
			
			This is the first step of the demo, which presents a form that
			the visitor can use to upload a file.
								
		Dependencies:
			FMWebFrame
			container-upload-handler.php
	
		Dependents:
			None.
	
		Version:
			1
	
		History:
		
			2014-06-14	Tim Dietrich
				Initial version.	
				
		Comments:
					
			The demo imposes a few limitations with regard to the types of files that can be uploaded.
			The maximum size of the file is 1Mb, and only PDF and a few image file formats are allowed. 
			
			These limitations are in place to prevent abuse of the form on the demo site. However, 
			you can modify and/or remove them should you want to.			
		
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
	
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Container Uploading";	
	
	// Start output buffering.
	ob_start();	
	
	echo '<h1>Container Uploading</h1>';

	echo '<p>';
	echo 'In addition to its easy and powerful container publishing functions, FMWebFrame also provides ';
	echo 'a function that enables users to upload files into container fields. ';
	echo 'The function uses only native FileMaker functionality, so no plugins are required.';
	echo '</p>';	

	echo '<p>Use the form below to upload a file to the demo database.</p>';
	echo '<p>For this demo, the maximum file size allowed is ' . UPLOADS_MAXIMUM_FILE_SIZE . ' bytes, ';
	echo 'and the file types supported are: ';
	for ( $i = 0; $i < count( $supported_mime_types ); ++$i ) {
		echo $supported_mime_types[$i];
		if ( $i < count( $supported_mime_types ) - 1 ) {
			echo ', ';
		} else {
			echo '.';
		}
	}				
	echo '</p>';
	
	
	// Display the upload form.
	echo '<form method="post" action="' .  HTTP_ROOT_URL . '/application/container-upload-handler.php" enctype="multipart/form-data">';
	echo '<input type="hidden" name="submit_token" value="1" />';
	echo '<p>File:<br /><input type="file" name="uploaded_file" size="60"></p>';
	echo '<p><input type="submit" name="upload_form_submit" value="Upload" /></p>';
	echo '</form>	';	
	
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );	


?>