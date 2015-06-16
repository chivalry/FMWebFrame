<?php	

	/*
 
		File: 
			/application/cache-form.php
		
		Description:
			An example of FMWebFrame's ExecuteSQL and caching functions.
			
			This is the first step of the caching demo, which provides
			a link to the page showing a call to the database that does
			not use the cache ("cache-handler-no-cache.php").

		Dependencies:
			FMWebFrame
			cache-handler-no-cache.php
	
		Dependents:
			None.
	
		Version:
			1
	
		History:
		
			2014-06-14	Tim Dietrich
				Initial version.	
				
		Comments:		
			None.
			
		
	*/

	// Initialize the request.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );	
									
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Caching";
	
	// Start output buffering.
	ob_start();

	echo '<h1>Caching</h1>';
	
	echo '<p>';
	echo 'Caching is a technique where data obtained from a database can be stored in such a way that additional requests for it can be handled more quickly and efficiently. ';
	echo 'When used properly, caching can have a dramatic impact on database-driven, dynamic Web sites and applications. ';
	echo 'Caching can both improve performance for an application\'s users and reduce the load placed on the database server.';
	echo '</p>';
	
	echo '<p>FMWebFrame provides several cache-related functions that make it easy to implement caching techniques in your Web applications. ';
	echo 'You can cache find results, ExecuteSQL query results, value lists, containers, and more.</p>';
	
	echo '<p>This example demonstrates how much of an impact caching can have. First, <a href="cache-handler-no-cache.php">click here</a> to see the results of an ExecuteSQL query without caching. ';
	echo 'You will then have an opportunity to see the results when caching is used.</p>';
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>