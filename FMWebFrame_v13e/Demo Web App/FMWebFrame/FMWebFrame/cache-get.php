<?php

	/*
	
		File: 
			/FMWebFrame/FMWebFrame/cache-get.php
		
		Description:
			Loads the fmCacheGet function.
		
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
					
	
		"fmCacheGet"
		
		Purpose:
			Returns a cache file's contents, including the file's age and size.
			
		Parameters:
			[1] $cache_file_name: The name of the cache file to be retrieved.
			[2] $cache_path: An optional path to use when retrieving the file. 
				Defaults to CACHE_PATH as set in the FMWebFrame settings file.
				
		Output:
			If the specified cache file is available, the function returns 
			an associative array consisting of:
			• Cache_Contents: The contents of the cache file.
			• Cache_Age: The age of the cache file, in seconds.
			• Cache_File_Size: The size of the cache file, in kilobytes.
			
			If the specified cache file is not available, then a NULL value
			is returned.

		Note:
			When objects that contain database connection information are cached, 
			then the connection values are redacted.
			
	*/

	function fmCacheGet
		( 
			$cache_file_name = null,
			$cache_path = CACHE_PATH			
		) {

		// If the cache path is missing...
		if ( is_null ( $cache_path ) ) {
			die ( 'Error: The cache path was not specified.' );
		}	
		
		// If the cache file name is missing...
		if ( is_null ( $cache_path ) ) {
			die ( 'Error: The cache file name was not specified.' );
		}		
		
		// Create the full path to the cache file.
		$cache_file_path = $cache_path . '/' . $cache_file_name . '.fmcache';				
		
		// If the cache file exists...
		if ( file_exists ( $cache_file_path ) ) {
									
			// Read the cache.
			$cache = @file_get_contents ( $cache_file_path );
				
			// Unserialize the cached FileMaker record.
			$object = unserialize ( $cache );
										
			// Get the age of the cache file.
			$cache_age = ( time () - filemtime ( $cache_file_path ) );
			
			// Get the size of the cache file.
			$cache_file_size = number_format( filesize ( $cache_file_path ) / 1024, 2);
			
			// Move the results into an array.
			$results_array = array ();
			$results_array['Cache_Contents'] = $object;
			$results_array['Cache_Age'] = $cache_age;
			$results_array['Cache_File_Size'] = $cache_file_size;
			
			// Return the array to the caller.
			return ( $results_array );
			
		} else {
		
			return ( null );
			
		}
	
	}
	
	
?>