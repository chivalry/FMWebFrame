<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/cache-list.php
		
		Description:
			Loads the fmCacheList function.
		
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
	
		"fmCacheList"
		
		Purpose:
			Returns a list of files in the cache.
			
		Parameters:
			[1] $cache_path: An optional path to use when retrieving the list. 
				Defaults to CACHE_PATH as set in the FMWebFrame settings file.
				
		Output:
			Returns an associative array consisting of:
			• filename: The name of the cache file.
			• size_kb: The size of the cache file, in kilobytes.
			• date_created: the date that the file was saved to the cache.
			• age_seconds: The age of the cache file, in seconds.
			
	*/
	

	function fmCacheList ( $cache_path = CACHE_PATH ) {	
	
		$cache_files = array();

		if ( is_dir ( $cache_path ) ) {	
		
			if ( $dh = opendir ( $cache_path ) ) {		
											
				while ( ( $file = readdir($dh) ) !== false) {			
				
					if ( filetype( $cache_path . '/' . $file ) == 'file' ) {
						$a = array();
						$a['filename'] = fmSubstitute ( $file, '.fmcache', '' );	
						$a['size_kb'] = number_format( filesize ( $cache_path . '/' . $file ) / 1024, 2);
						$a['date_created'] = date ("m/d/Y H:i:s", filemtime ( $cache_path . '/' . $file ) );
						$a['age_seconds'] = ( time () - filemtime ( $cache_path . '/' . $file ) );				
						$cache_files[] = $a;
					}				
					
				}			
				
				closedir( $dh );			
				
			}
			
		}	
		
		return ( $cache_files );
	
	}		

?>