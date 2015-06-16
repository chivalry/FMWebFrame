<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/cache-purge-directory.php
		
		Description:
			Loads the fmCachePurgeDirectory function.
		
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
	
		"fmCachePurgeDirectory"
		
		Purpose:
			Deletes all files in the cache.
			
		Parameters:
			[1] $cache_path: An optional path to use when purging the cache. 
				Defaults to CACHE_PATH as set in the FMWebFrame settings file.
				
		Output:
			Returns an array of the names of the files that were deleted.
			
	*/


	function fmCachePurgeDirectory ( $cache_path = CACHE_PATH ) {	
	
		$files_deleted = array();

		if ( is_dir ( $cache_path ) ) {	
		
			if ( $dh = opendir ( $cache_path ) ) {		
											
				while ( ( $file = readdir($dh) ) !== false) {			
				
					if ( filetype( $cache_path . '/' . $file ) == 'file' ) {				
						@unlink ( $cache_path . '/' . $file );											
						$files_deleted[] = $file;					
					}				
					
				}			
				
				closedir( $dh );			
				
			}
			
		}	
		
		return ( $files_deleted );
	
	}	


?>