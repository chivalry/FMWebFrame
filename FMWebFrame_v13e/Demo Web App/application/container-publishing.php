<?php


	/*
 
		File: 
			/application/container-publishing.php
		
		Description:
			Demonstrates FMWebFrame's "fmGetContainerURL" function, which
			makes it possible to easily publish the contents of container
			fields using clean, easy-to-read, SEO-friendly URLs.						
		
		Dependencies:
			FMWebFrame
	
		Dependents:
			None.
	
		Version:
			1
	
		History:
		
			2014-06-14	Tim Dietrich
				Initial version.	
				
		Comments:
		
					
		
	*/
	

	// Initialize the request.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );
	
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Container Publishing";
	
	// Start output buffering.
	ob_start();		

	// Page header.	
	echo '<h1>Container Publishing</h1>';

	echo '<p>';			
	echo 'Using FMWebFrame\'s "fmGetContainerURL" function, you can easily generate easy-to-read, SEO-friendly URLs ';
	echo 'that can be used to publish a container\'s contents. ';
	echo 'Below are a few sample containers that have been Web-published with FMWebFrame.';
	echo '</p>';		
			
	// Find the first sample resource.
	$fm_request = $fmDemo -> newFindCommand ( 'Resource - Form' );	
	$fm_request -> addFindCriterion ( 'Resource_ID', '==1' );
	$fm_result = @ $fm_request -> execute ();	
	
	// If the resource was not found...
	if ( FileMaker::isError( $fm_result ) ) {	
	
		echo '<p>Unable to locate the sample resource.</p>';
	
	} else {
	
		// Get the record object.
		$resources = $fm_result -> getRecords();	
		$resource = $resources [0];		
		
		// Call fmGetContainerURL to prepare the resource and generate a URL to access it with. 
		$resource_url = fmGetContainerURL 
			( 
				$fmDemo, 				// The database connection object.
				$resource,				// The record object.
				'Resource',				// The name of the container field.
				FALSE,					// Indicates if the generated URL should include a unique ID.
				NULL,					// An optional virtual subfolder to use in the URL.
				60 * 60,				// The maximum amount of time (in seconds) that the URL is to be valid.
				NULL					// The rule to use to determine if the user has permission to access the resource.
			);		

						
		echo '<p>';
		echo '<a href="' . $resource_url . '" target="_sample_png">';
		echo '<img src="' . $resource_url . '"></a>';
		echo '</p>';			
		echo '<p>The URL that FMWebFrame created for that image is: ';
		echo '<a href="' . $resource_url . '" target="_sample_image">' . $resource_url . '</a>';
		echo '</p>';
		echo '<p>';
			
		
	}

	
	// Find the second sample resource.
	$fm_request = $fmDemo -> newFindCommand ( 'Resource - Form' );	
	$fm_request -> addFindCriterion ( 'Resource_ID', '==2' );
	$fm_result = @ $fm_request -> execute ();	
	
	// If the resource was not found...
	if ( FileMaker::isError( $fm_result ) ) {	
	
		echo '<p>Unable to locate the sample resource.</p>';
	
	} else {
	
		// Get the record object.
		$resources = $fm_result -> getRecords();	
		$resource = $resources [0];		
		
		// Call fmGetContainerURL to prepare the resource and generate a URL to access it with. 
		$resource_url = fmGetContainerURL 
			( 
				$fmDemo, 				// The database connection object.
				$resource,				// The record object.
				'Resource',				// The name of the container field.
				FALSE,					// Indicates if the generated URL should include a unique ID.
				NULL,					// An optional virtual subfolder to use in the URL.
				60 * 60,				// The maximum amount of time (in seconds) that the URL is to be valid.
				NULL					// The rule to use to determine if the user has permission to access the resource.
			);		
						
		echo '<p>Here is a link to another document stored in the database. This one is a PDF document: ';
		echo '<a href="' . $resource_url . '" target="_sample_pdf">' . $resource_url . '</a>';
		echo '</p>';				
		
	}	
	
	echo '<p>';	
	echo 'FMWebFrame supports publishing a wide range of file types, from images (gif, jpeg, jpg, png), to movies (quicktime, mp4), to audio files (mpeg), and more. ';
	echo 'And best of all, FMWebFrame fully supports all of the latest container storage options, including both the secure and open external storage options.';
	echo '</p>';		
	
	echo '<p>';		
	echo 'There are several options that the "fmGetContainerURL" function provides, including:';
	echo '<ul>';
	echo '<li>You can choose to add UUIDs to the URLs to ensure that they are unique. This is a handy option in cases where ';
	echo 'the names of the files stored in the containers might be duplicated, or in cases where you are concerned that  ';
	echo 'someone might try guessing at the names of files in an attempt to access them directly.</li>';
	echo '<li>You can indicate that a URL should only be valid for a certain amount of time. ';
	echo 'Using this option, you can cache container contents, thereby making your web application more responsive ';
	echo 'and reducing the load on FileMaker Server.</li>';
	echo '<li>You can specify a business rule that should be used to control who can use a given URL. For example, this is helpful ';
	echo 'in cases where a container\'s contents should only be available to authenticated users of a Web app.';
	echo '</li> ';
	echo '</ul>';
	echo '</p>';		
	
	echo '<p>';	
	echo 'FMWebFrame uses a custom 404 error handler, along with a second function called "fmGetContainer," to resolve ';
	echo 'the URLs generated by the "fmGetContainerURL" function. ';
	echo '</p>';	

	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );	


?>