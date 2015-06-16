<?php

	 /*
 
		File: 
			/FMWebFrame/settings.php
		
		Description:
			Initializes FMWebFrame settings.
		
		Dependencies:
			None.
	
		Dependents:
			FMWebFrame.php
	
		Version:
			3
	
		History:
		
			2013-12-18	Tim Dietrich
				Initial version.
				
			2014-02-05 	Tim Dietrich
				Added "CONTAINER_FOLDER" setting.
				
			2014-06-05	Tim Dietrich
				Updated in-line docs.
		
	 */


	// Application's HTTP root URL.	
	// Example: http://demo.fmwebframe.com
	// Note: If the Web application is not running in the root, add the directory that it is in. (ex: http://demo.fmwebframe.com/myapp)
	// Note: Do not add trailing slashes.		
	define ( 'HTTP_ROOT_URL', 'http://' . $_SERVER['HTTP_HOST'] );
	
	
	// The OS path to the FileMaker API for PHP.
	// For information on how to manually install the API, see: 
	// http://help.filemaker.com/app/answers/detail/a_id/6531/~/manually-installing-the-filemaker-api-for-php
	// Note: Do not add the trailing slash.
	define ( 'FMAPI_PATH', dirname(__FILE__) . '/../FileMaker' );
	
	
	// The OS path to the Cache directory.
	// Note: Do not add the trailing slash.
	define ( 'CACHE_PATH', dirname(__FILE__) . '/../temp' );
	
	
	// The OS path to the Containers directory.
	// Note: Do not add the trailing slash.
	define ( 'CONTAINER_PATH', dirname(__FILE__) . '/../temp' );	
	
	
	// An optional virtual directory to use when publishing containers.
	// Note: Do not add the trailing slash.
	// Example: /containers
	define ( 'CONTAINER_FOLDER', '/containers' );		
	
	
	// The path to the Uploads directory.
	// Note: Do not add the trailing slash.
	define ( 'UPLOAD_PATH', dirname(__FILE__) . '/../temp' );	
	
	
	// The URL to the Uploads directory.
	// Note: Do not add the trailing slash.
	// ex: http://demo.fmwebframe.com/temp
	define ( 'UPLOAD_URL', HTTP_ROOT_URL . '/temp' );		
	
	
	// Indicates whether or not database connections should be tested automatically.
	// Note: You might want to set this to TRUE during setup, and then
	// set it to FALSE afterwards (to improve performance).
	define ( 'TEST_DB_CONNECTIONS', FALSE );	

	
	// An array of FileMaker database connection settings.
	$fm_databases = array ();	


	// Connection settings for the first database.
	// Note: To add support for an additional database, add another element to the
	// $fm_databases array.
	$fm_databases[] =
		array( 
			nickname => 'fmDemo', 
			hostspec => '*** YOUR SERVER ADDRESS HERE ***', 
			database => 'FMWebFrame_Demo_v13e', 
			username => 'php_fmwf', 
			password => 'J6^k=YcFHFjgZ{?YFJ2P' 
		);	
		
		
	// Can be used to enable and configure Site Shield, and control access to the application by IP.
	// Supported values are: 
	// NULL: Disables site shield. This is the default.
	// Deny/Allow: 	Denies access to all IPs except those listed in the $site_shield_ips array.
	// Allow/Deny: 	Allows access to all IPs except those listed in the $site_shield_ips array.	
	define ( 'SITE_SHIELD_METHOD', NULL );	
	
	
	// The site shield IP address array.
	// Specify the IP addresses to allow or deny.
	// Note: You can use wildcards. For example: 173.62.245.*, or even 198.*	
	$site_shield_ips = array();
	$site_shield_ips[] = '127.0.0.1';				// Localhost.
	

?>