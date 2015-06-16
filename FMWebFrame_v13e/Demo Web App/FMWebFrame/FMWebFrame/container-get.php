<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/container-get.php
		
		Description:
			Loads the fmGetContainer function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
	
		Version:
			1
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
			2014-06-14	Tim Dietrich
				Complete rewrite, using new container handling process.
				
		------------------------------------------------------------------------------------------------------------
	
		"fmGetContainer"
		
		Purpose:
			When called via the Web application's custom 404 error handler, the function
			will attempt to resolve the request and return the specified container's
			contents. The URLs that it resolves are those generated using the
			"fmGetContainerURL" function.
		
		Parameters:
			[1] $fm_databases: The array of FileMaker connections, as specified in 
				FMWebFrame's settings file.
				
		Output:
			If the URL can be resolved, then the container's contents are served up.
			Otherwise, control returns to the 404 error handler, which can
			continue to process the request.
				
		Example:
		
			A custom 404 error handler might call fmGetContainer like this:
		
				@require_once ( dirname(__FILE__) . '/FMWebFrame/FMWebFrame.php' );
				fmGetContainer( $fm_databases );
			
		Note:
		
			fmGetContainer is designed to handle a wide range of file types, and
			to serve them up based on their mime type. However, in cases where
			the file's mime type either cannot be identified or is not supported,
			then the content will be returned to the client in such a way that it 
			can be downloaded.
			
	*/
	
	
	function fmGetContainer ( $fm_databases )
		{	
						
			// Determine the resource that is being requested via the _SERVER scope.
			// ex: http://localhost/dynamic-containers/530f982c01733/1393530924/Sample.pdf
			if ( isset ( $_SERVER[ 'SCRIPT_URI' ] ) ) {
				$resource_requested = $_SERVER[ 'SCRIPT_URI' ];
			} elseif ( isset ( $_SERVER[ 'REDIRECT_URL' ] ) ) {
				$resource_requested = $_SERVER[ 'REDIRECT_URL' ];
			} else {
				die ( 'fmGetContainer: Unable to determine the resource that was requested.' );
			}
			
			
			// Remove the Root URL from the resource requested.
			// This resolves issues encountered when the Web app is in a sub-folder.
			// Example: /containers/macmini.png
			$resource_requested = fmSubstitute ( $resource_requested, HTTP_ROOT_URL, '' );

						
			// Remove the virtual container folder from the resource requested.
			// This resolves issues encountered when the Web app is in a sub-folder.
			// Example: /macmini.png
			$resource_requested = fmSubstitute ( $resource_requested, CONTAINER_FOLDER, '' );			
			// fmDump ( $resource_requested, TRUE, 'resource_requested' );
			
			
			// Get the resource's info file name.
			// Example: macmini.png.info
			$info_file_name = fmSubstitute ( $resource_requested, '/', '-' );
			$info_file_name = fmRight ( $info_file_name, fmLength ( $info_file_name ) - 1 );
			$info_file_name .= '.info';
			// fmDump ( $info_file_name, TRUE, 'info_file_name' );
				
			
			// Get the OS path that was used to store the container's info file.
			// Example: /domains/demo.fmwebframe.com/html/FMWebFrame/../temp/macmini.png.info
			$physical_path_container_info_file = CONTAINER_PATH . '/' . $info_file_name;
			// fmDump ( $physical_path_container_info_file, TRUE, 'physical_path_container_info_file' );
						
			// If the info file wasn't found...
			if ( ! file_exists ( $physical_path_container_info_file ) ) {					
				// Return control to the 404 error handler.
				return;				
			}
			
							
			// Read the info file.				
			$info_file_contents = @file_get_contents ( $physical_path_container_info_file );
			// fmDump ( $info_file_contents, TRUE, 'info_file_contents' );
			
			
			// Convert the contents of the info file into an array.
			$container_info_array = preg_split ( "/\n/", $info_file_contents );
			// fmDump ( $container_info_array, TRUE, 'container_info_array' );
			
			
			// Break the array up into variables for easier reference.
			$container_field_as_text = $container_info_array[0];
			$maximum_age = $container_info_array[1];
			$access_rule = $container_info_array[2];
			
			
			// Get the OS path that will be used to get/save the container's binary contents.
			// Example: /domains/demo.fmwebframe.com/html/FMWebFrame/../temp/macmini.png
			$physical_path_container_contents_file = fmLeft ( $physical_path_container_info_file, fmLength ( $physical_path_container_info_file ) - 5 );
			// fmDump ( $physical_path_container_contents_file, TRUE, 'physical_path_container_contents_file' );				
			
			
			// If the URL is only valid for a certain amount of time...
			if ( $maximum_age > 0 ) {
			
				// Get the age of the info file.
				$file_age = ( time () - filemtime ( $physical_path_container_info_file ) );
				// fmDump ( $file_age, TRUE, 'file_age' );	
				
				// If the URL has expired...
				if ( $file_age >= $maximum_age ) {
				
					// Delete the "stale" files.
					@unlink ( $physical_path_container_contents_file );	
					@unlink ( $physical_path_container_info_file );
					
					// Return control to the 404 error handler.
					return;						
				
				}				
			
			}

									
			// If an access rule was specified...
			if ( $access_rule !== '' ) {
			
				// Evaluate the rule.
				$allow_access = eval ( 'return (' . $access_rule . ');' );
				//fmDump ( $access_rule, FALSE, 'access_rule' );
				//fmDump ( $allow_access, TRUE, 'allow_access' );
				
				// If the rule failed...				
				if ( ! $allow_access ) {
				
					// Replace the 404 response with a "403 Forbidden" and die.
					header( 'Status: 403', TRUE, 403 );	
					die;
					
				}
				
			}
			
			
			// Split the container's text value into an array so that we can isolate the file name & container info.
			$container_field_array = explode ( '?', $container_field_as_text );
			// fmDump ( $container_field_array, TRUE, 'container_field_array' );
			
			
			// Get the file name (the first element of the "container_field_array" array).
			$filename = $container_field_array[0];
			$filename = fmsubstitute ( $filename, '/fmi/xml/cnt/', '' );
			$filename = urldecode ( $filename );
			$filename = fmsubstitute ( $filename, ' ', '-' );	
			// fmDump ( $filename, TRUE, 'filename' );
			
			
			// Parse the second element of the "container_field_array" array into individual variables.
			// Note: parse_str parses a query string into variables.
			// ex: -db=FMWebFrame_Demo&-lay=Resource%20-%20Form&-recid=2&-field=Resource(1)	
			// ---> db = FMWebFrame_Demo
			// ---> lay = Resource - Form
			// ---> recid = 2
			// ---> field = Resource(1)
			// Note that we're most interested in the database name, which we need in order to
			// determine the database connection info to use should we need to refer back to 
			// the record that the container was pulled from.
			$container_info = html_entity_decode ( $container_field_array[1] );
			$container_info = fmsubstitute ( $container_info, '-db', 'db' );
			$container_info = fmsubstitute ( $container_info, '&-', '&' );
			parse_str ( $container_info );					
			// fmDump ( $db, TRUE, 'db' );		
			

			// If the container contents file is available...
			if ( file_exists ( $physical_path_container_contents_file ) ) {
			
				// Read the file.
				$container_data = @file_get_contents ( $physical_path_container_contents_file );				
			
			} else {
			
				// Using the database name, find the database connection to use...
				foreach ( $fm_databases as $fm_database ) {
			
					// If the connection was found...
					if ( $fm_database['database'] == $db ) {																		
				
						// Create a connection to the database.
						$fm = new FileMaker ();
						$fm->setProperty ( 'hostspec', $fm_database['hostspec'] );
						$fm->setProperty ( 'database', $fm_database['database'] );
						$fm->setProperty ( 'username', $fm_database['username'] );
						$fm->setProperty ( 'password', $fm_database['password'] );	
						break;
					
					}
				
				}
				if ( ! isset ( $fm ) ) {
					// Return control to the 404 error handler.
					return;	
				}
				// fmDump ( $fm, TRUE, 'fm' );
			
			
				// Get the record that the container was pulled from.
				$container_record = $fm -> getRecordById ( $lay, $recid );
				// fmDump ( $container_record, TRUE, 'container_record' );			

				// Get the container data.
				$container_data = $fm -> getContainerData( $container_field_as_text );				
				if ( FileMaker::isError( $container_data ) ) {	
					die;
				}				
				// fmDump ( $container_data, FALSE, 'container_data' );
												
				// Save the container's contents on the server.
				@file_put_contents ( $physical_path_container_contents_file, $container_data );	

			}					
			
						
						
			// If we have the container's content...
			if ( isset ( $container_data ) ) {
			
				// Update the http response header, so that this does not appear to be a "404."
				header( 'Status: 200', TRUE, 200 );				
			
			
				// Explode the filename to get the extension.	
				$filename_parts = explode( '.', $filename );
				$extension = $filename_parts[1];	
		
				// If the extension includes a URL request...
				if ( fmPatternCount ( $extension, '?' ) ) {
					$extension_parts = explode( '?', $extension );
					$extension = $extension_parts[0];
				}
				
					
				// Setup the headers to use, based on the file type (extension).
				switch ( $extension ) {
		
					case 'gif':
						header( 'Content-type: image/gif');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;			
		
					case 'jpeg':
						header( 'Content-type: image/jpeg');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;	
			
					case 'jpg':
						header( 'Content-type: image/jpeg');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;    
				
					case 'mov':
						header( 'Content-type: video/quicktime');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;          	
						
					case 'mp3':
						header( 'Content-type: audio/mpeg');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;          		
				
					case 'mp4':
						header( 'Content-type: video/mp4');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;      
			
					case 'ogg':
						header( 'Content-type: application/ogg');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;    
					
					case 'pdf':
						header( 'Content-type: application/pdf');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;
			
					case 'png':
						header( 'Content-type: image/png');
						header(	'Content-Disposition: filename="' . $filename . '"');
						break;	        	
		
					default;
						header( 'Content-type: application/force-download' ); 
						header( 'Content-Transfer-Encoding: Binary' );
						header(	'Content-Disposition: attachment; filename="' . $filename . '"' );

				}


				// Send additional headers.					
				header( 'Content-Length: ' . strlen( $container_data ) );
				header( 'Cache-Control: private' );	

		
				// Send the container's binary data.
				echo $container_data;	
	
				die;				
			
			}
									
		}				

	
?>