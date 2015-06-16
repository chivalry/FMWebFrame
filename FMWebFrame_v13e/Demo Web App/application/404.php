<?php	

	/*
 
		File: 
			/application/404.php
		
		Description:
			This is a custom 404 error handler for the FMWebFrame demo app.				
		
		Dependencies:
			FMWebFrame
			.htaccess
	
		Dependents:
			None.
	
		Version:
			1
	
		History:
		
			2014-06-04	Tim Dietrich
				Initial version.	
				
		Comments:
		
			In order to use FMWebFrame's container publishing functions, you will need to configure your site 
			so that this custom 404 error handler is used.
		
			On Linux-based servers, an .htaccess file should be placed in the Web root, and contain this line:
		
				ErrorDocument 404 /application/404.php
		
			If the site is not running in the root, then be sure to specify the directory as well.
			For example, if the site is located at http://fmwebframe.com/test/, then you would use:
				ErrorDocument 404 /test/application/404.php

			You can use these sites to confirm that the http header responses returned for any 404s 
			that are resolved dynamically are responding properly (with "Status: 200"):
			• http://web-sniffer.net/
			• http://www.websitepulse.com/help/testtools.httpheaders-test.html
					
	*/
		
	// Initialize FMWebFrame.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );
	
	
	// Check to see if the request is for a container.
	// Note that if the requested URL can be resolved to a container,
	// then the container is served up, and the remainder of this script will not run.
	fmGetContainer( $fm_databases );	


	// Set page title.	
	$ui_title = "FMWebFrame Demo | 404 Error";
	
	
	// Start output buffering.
	ob_start();

?>

<h1>Oh no!</h1>
<p>
Sorry, but the resource that you requested is not available.
</p>

<?php	
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>