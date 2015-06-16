<?php	

	/*
 
		File: 
			/application/index.php
		
		Description:
			The index ("home") page for the Demo application.

		Dependencies:
			FMWebFrame
	
		Dependents:
			None.
	
		Version:
			1
	
		History:
		
			2014-01-14	Tim Dietrich
				Initial version.	
				
		Comments:		
			None.
					
	*/

	// Initialize the request.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );

			
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Home";
	
	
	// Start output buffering.
	ob_start();

?>

<h1>Welcome!</h1>

<p>
This Web application is designed to provide examples of FMWebFrame's capabilities, 
as well as sample code that you can use to create your own solutions. 
</p>

<p>
The FMWebFrame demo database includes over 25,000 sample contact records. 
All of the names, addresses, and other information are fictitious.
</p>

<p>
To get started with the demo, select one of the options to the right.
</p>


<?php	
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>