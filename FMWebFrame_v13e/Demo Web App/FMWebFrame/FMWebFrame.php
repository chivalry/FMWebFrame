<?php

	 /*
 
		File: 
			/FMWebFrame/FMWebFrame.php
		
		Description:
			Initializes the FMWebFrame extension. 
			This file should be included by all scripts that need access to FMWebFrame's functionality.
		
		Dependencies:
			settings.php
			/FMWebFrame/site-shield.php
			/FMWebFrame/api-loader.php
			/FMWebFrame/database-connect.php
			/FMWebFrame/databases-connect.php
			/FMWebFrame/translators.php
			/FMWebFrame/evaluate.php
			/FMWebFrame/execute-sql.php
			/FMWebFrame/row-get.php
			/FMWebFrame/quick-find.php
			/FMWebFrame/cache-get.php
			/FMWebFrame/cache-list.php
			/FMWebFrame/cache-purge-directory.php
			/FMWebFrame/cache-purge-file.php
			/FMWebFrame/cache-put.php
			/FMWebFrame/container-get-url.php
			/FMWebFrame/container-get.php
			/FMWebFrame/container-put.php			
			
	
		Dependents:
			None.
	
		Version:
			3
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
			2014-02-27	Tim Dietrich
				Split container functions into individual files.
				
			2014-06-05	Tim Dietrich
				Additional refactoring. All function files are now in the FMWebFrame subfolder.
		
	 */
	
	// FMWebFrame version.
	define ( 'FMWEBFRAME_VERSION', '13e' );	

	// Load settings.
	require_once ( dirname(__FILE__) . '/settings.php' );	
	
	// Load the site shield function.
	require_once ( dirname(__FILE__) . '/FMWebFrame/site-shield.php' );					
	
	// Load the FileMaker API for PHP.
	require_once ( dirname(__FILE__) . '/FMWebFrame/api-loader.php' );	

	// Create (and test) connections to the FileMaker databases.
	require_once ( dirname(__FILE__) . '/FMWebFrame/database-test.php' );
	require_once ( dirname(__FILE__) . '/FMWebFrame/databases-connect.php' );	
	
	// Load the FileMaker-to-PHP translator function library.
	require_once ( dirname(__FILE__) . '/FMWebFrame/translators.php' );
	
	// Load the "extras" function library.
	require_once ( dirname(__FILE__) . '/FMWebFrame/extras.php' );	
	
	// Load the fmEvaluate function.
	require_once ( dirname(__FILE__) . '/FMWebFrame/evaluate.php' );	
	
	// Load the ExecuteSQL-related functions.
	require_once ( dirname(__FILE__) . '/FMWebFrame/execute-sql.php' );	
	require_once ( dirname(__FILE__) . '/FMWebFrame/row-get.php' );		
	
	// Load the fmQuickFind function.
	require_once ( dirname(__FILE__) . '/FMWebFrame/quick-find.php' );		
	
	// Load the caching functions.
	require_once ( dirname(__FILE__) . '/FMWebFrame/cache-get.php' );
	require_once ( dirname(__FILE__) . '/FMWebFrame/cache-list.php' );	
	require_once ( dirname(__FILE__) . '/FMWebFrame/cache-purge-directory.php' );	
	require_once ( dirname(__FILE__) . '/FMWebFrame/cache-purge-file.php' );	
	require_once ( dirname(__FILE__) . '/FMWebFrame/cache-put.php' );	
	
	// Load the container functions.
	require_once ( dirname(__FILE__) . '/FMWebFrame/container-get-url.php' );		
	require_once ( dirname(__FILE__) . '/FMWebFrame/container-get.php' );		
	require_once ( dirname(__FILE__) . '/FMWebFrame/container-put.php' );			
			
?>