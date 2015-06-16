<?php


	/*
 
		File: 
			/FMWebFrame/FMWebFrame/api-loader.php
		
		Description:
			Loads the FileMaker API for PHP, and pre-loads a few class definitions so that
			FMWebFrame's caching function works properly.						
		
		Dependencies:
			FileMaker.php (The primary FileMaker API for PHP file.)
			/FileMaker/Result.php (The API's "Result" class definiton.)
			/FileMaker/Record.php (The API's "Record" class definiton.)
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
	
		Version:
			1
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.	
			
		
	*/
		
	

	// Load the FileMaker API for PHP.
	require_once ( FMAPI_PATH . '/FileMaker.php' );	
	
	
	// We also load class definitions for "FileMaker_Result" and "FileMaker_Record"
	// at this point to avoid the error...
	// "The script tried to execute a method or access a property of an incomplete object."
	// ... which would otherwise be thrown when unserializing cached API results.
	require_once ( FMAPI_PATH . '/FileMaker/Result.php' );	
	require_once ( FMAPI_PATH . '/FileMaker/Record.php' );		
	
	
?>