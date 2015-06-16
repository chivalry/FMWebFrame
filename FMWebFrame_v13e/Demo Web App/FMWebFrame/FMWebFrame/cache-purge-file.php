<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/cache-purge-file.php
		
		Description:
			Loads the fmCachePurgeFile function.
		
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
	
		"fmCachePurgeFile"
		
		Purpose:
			Deletes a specified file in the cache.
			
		Parameters:
			[1] $cache_file_name: The name of the file to be deleted.
			[2] $cache_path: An optional path to use when deleting the file. 
				Defaults to CACHE_PATH as set in the FMWebFrame settings file.
				
		Output:
			Returns TRUE if the file was deleted. Otherwise, FALSE.
			
	*/	
	
	function fmCachePurgeFile (
			$cache_file_name = null,
			$cache_path = CACHE_PATH		
	) {	

		return ( @unlink ( $cache_path . '/' . $cache_file_name . '.fmcache' ) );
	
	}	
	
	
?>