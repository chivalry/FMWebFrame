<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/container-get-url.php
		
		Description:
			Loads the fmGetContainerURL function.
		
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
	
		"fmGetContainerURL"
		
		Purpose:
			Takes a given container field value, creates an "info" file for it, stores the file on the Web server, 
			and returns an SEO-friendly URL that can be used to view / retrieve the file.
		
		Parameters:
			[1] $connection: The FileMaker connection object to be used.
			[2] $record: The FileMaker record object in which the container is stored.
			[3] $field: The name of the container field whose contents are to be served up.
			[4] $use_uuid: Indicates if the URL should include a unique ID. This should be used in cases where you might try to 
				serve multiple resources whose file names are identical, or when you are concerned that someone might
				manually manipulate URLs to try to access other files. Default is FALSE.
			[5] $virtual_subfolder: An optional virtual subfolder into which the container will appear to be served up from.
			[6] $maximum_age: The maximum amount of time (in seconds) that the URL is to be valid.	
				If NULL, then the there is no limit. Default is 30 (seconds).
			[7] $access_rule: The rule used to determine whether the current user has permission to access the resource.
				See below for more information about access rules.
				
		Output:
			Returns a URL to the container's contents, which FMWebFrame's "fmGetContainer" function can
			resolve.
			
		Notes regarding the "info file" concept:
		
			fmGetContainerURL generates an "info" file, a small text file consisting of:
			• The value of the container as a string. This is the same value that you would normally pass to the 
			"getContainerData" method to get a container's binary contents. Example: 			
				/fmi/xml/cnt/Sample.pdf?-db=FMWebFrame_Demo&-lay=Resource%20-%20Form&-recid=2&-field=Resource(1)
			• The maximum amount of time (in seconds) that the URL is to be valid.
			• Any rule that should be used to determine whether the current user has permission to access the resource.
		
			The fmGetContainerURL function does not actually get the contents of the container. That occures in the
			"fmGetContainer" function. As a result, we do not request the container contents unnecessarily, such as
			in cases where a link to a resource is generated but is never actually used.
			
			
		Notes regarding "Access Rules" (the "$access_rule" parameter):	
			
			Rules must be specified as a php code snippet that evaluates to a boolean value.
			
			For example: 
				
				$_SERVER["REMOTE_ADDR"] == "127.53.99.51"
			
			In that example, only users whose IP address is "127.53.99.51" will be able to access the resource.
			All other users will receive a "403 Forbidden" HTTP response.
			
			
		Additional Notes:
			
			The URLs returned by fmGetContainerURL are intended to be handled by a custom 404 error handler,
			which would include a call to the "fmGetContainer" function so that the URL can be resolved.
			
			Be careful when using low "$maximum_age" values. If the value is too low, then it is possible that the client 
			will not have enough time to retrieve the resource.
	
			
	*/

	
	function fmGetContainerURL 
		( 
			$connection = null, 
			$record = null,
			$field_name = null,
			$use_uuid = FALSE,
			$virtual_subfolder = null,
			$maximum_age = 30,
			$access_rule = null						
		) {	
		
		
			// Get the value of the container as a string.
			// This is the same value that you would normally pass to the "getContainerData" method to
			// get a container's binary contents.
			// Example: /fmi/xml/cnt/Sample.pdf?-db=FMWebFrame_Demo&-lay=Resource%20-%20Form&-recid=2&-field=Resource(1)			
			$container_field_as_text = $record -> getField ( $field_name );
			// fmDump ( $container_field_as_text, FALSE );			
		
			
			// Split the text value into an array so that we can isolate the file name.
			$container_field_array = explode ( '?', $container_field_as_text );
			// fmDump ( $container_field_array, FALSE );
		
					
			// Get the filename from the first element of the array.
			// Ex: /fmi/xml/cnt/Sample.pdf ---> Sample.pdf
			$filename = $container_field_array[0];
			$filename = fmsubstitute ( $filename, '/fmi/xml/cnt/', '' );
			$filename = urldecode ( $filename );
			$filename = fmsubstitute ( $filename, ' ', '-' );				
			// fmDump ( $filename, FALSE, 'FileName' );


			// Parse the second element of the array into individual variables.
			// Note: parse_str parses a query string into variables.
			// ex: -db=FMWebFrame_Demo&-lay=Resource%20-%20Form&-recid=2&-field=Resource(1)	
			// ---> db = FMWebFrame_Demo
			// ---> lay = Resource - Form
			// ---> recid = 2
			// ---> field = Resource(1)
			$container_info = html_entity_decode ( $container_field_array[1] );
			$container_info = fmsubstitute ( $container_info, '-db', 'db' );
			$container_info = fmsubstitute ( $container_info, '&-', '&' );
			parse_str ( $container_info );			
			
				
			// Create the OS path that will be used to store the container's info file.
			$physical_path_info_file = CONTAINER_PATH . '/';
			if ( $use_uuid ) {
				$uuid = uniqid() . '-' . time();
				$physical_path_info_file .= $uuid . '-';
			}
			if ( $virtual_subfolder !== NULL ) {
				$physical_path_info_file .= fmSubstitute ( $virtual_subfolder, '/', '-' ) . '-';
			}
			$physical_path_info_file .= $filename . '.info';
			// fmDump ( $physical_path_info_file, TRUE, 'physical_path_info_file' );
			
			
			// Prepare the contents of the info file.
			$info_file_contents = $container_field_as_text . "\n";
			$info_file_contents .= $maximum_age . "\n";
			$info_file_contents .= $access_rule . "\n";
			
			
			// Save the info file.
			@file_put_contents ( $physical_path_info_file, $info_file_contents );			
	
			
			// Create the virtual URL that will be used to serve up the file.
			$virtual_url = HTTP_ROOT_URL . CONTAINER_FOLDER . '/';
			if ( $use_uuid ) {
				$virtual_url .= fmSubstitute ( $uuid, '-', '/' ) . '/';
			}	
			if ( $virtual_subfolder !== NULL ) {
				$virtual_url .= fmSubstitute ( $virtual_subfolder, '-', '/' ) . '/';
			}				
			$virtual_url .= $filename;
			// fmDump ( $virtual_url, TRUE, 'virtual_url' );


			// Return the URL to the caller.
			return ( $virtual_url );		
		
		}	
		
?>