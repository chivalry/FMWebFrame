<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/cache-put.php
		
		Description:
			Loads the fmCachePut function.
		
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
	
		"fmCachePut"
		
		Purpose:
			Takes any PHP object and stores it in the cache.
			
		Parameters:
			[1] $object: The object to be cached.
			[2] $cache_file_name: The name to assign to the object when saving it to the cache.
			[3] $cache_path: An optional path to use when saving the file. 
				Defaults to CACHE_PATH as set in the FMWebFrame settings file.
				
		Output:
			Returns an associative array consisting of:
			• Result_Code: A numeric code indicating whether the request was successful or not. (See below.)
			• Result_Description: A textual description of the result code.
			
		Result Codes:
			-1: The request failed because the object specified is NULL.
			-2: The request did not include the cache path (or it was specified as null).
			-3: The cache file name was missing, so the request failed.
			1: The request was successful, and the object is now in the cache.
			
		Note:
			When using fmCachePut, be sure to use safe, sensible names for the $cache_file_name.
			
			When caching objects that contain database connection information (such as 
			the username and password that the API is using to connect to the database), 
			fmCachePut will attempt to redact those values before saving the cache file. 

			
	*/	

	
	function fmCachePut 
		( 
			$object = null,
			$cache_file_name = null,
			$cache_path = CACHE_PATH			
		) {
		
		// Prepare an array for returning the results..
		$results_array = array ();		
				
		// If the result to be cached is null...
		if ( is_null ( $object ) ) {
			$results_array['Result_Code'] = -1;
			$results_array['Result_Description'] = 'Error: Cannot cache a null result.';
			return ( $results_array );
		}
		
		// If the cache path is missing...
		if ( is_null ( $cache_path ) ) {
			$results_array['Result_Code'] = -2;
			$results_array['Result_Description'] = 'Error: The cache path was not specified.';
			return ( $results_array );
		}	
		
		// If the cache file name is missing...
		if ( is_null ( $cache_file_name ) ) {
			$results_array['Result_Code'] = -3;
			$results_array['Result_Description'] = 'Error: The cache file name was not specified.';
			return ( $results_array );
		}		
		
		// Create the full path to the cache file.
		$cache_file_path = $cache_path . '/' . $cache_file_name . '.fmcache';	
		
		
		// If the object includes database connection settings...
		if ( isset ( $object -> _impl ) ) {
			// For security purposes, redact the settings.
			$object -> _impl -> _fm -> V73ee434e ["hostspec"] = '[REDACTED]';
			$object -> _impl -> _fm -> V73ee434e ["database"] = '[REDACTED]';
			$object -> _impl -> _fm -> V73ee434e ["username"] = '[REDACTED]';
			$object -> _impl -> _fm -> V73ee434e ["password"] = '[REDACTED]';
		}
		
				
		// Cache the serialized object.					
		@file_put_contents ( $cache_file_path, serialize ( $object ) );	
		
		// Create and return the results array.
		$results_array['Result_Code'] = 1;
		$results_array['Result_Description'] = 'OK';		
		return ( $results_array );						
		
	}
	
?>