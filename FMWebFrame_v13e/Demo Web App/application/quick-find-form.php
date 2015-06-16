<?php	

	/*
 
		File: 
			/application/quick-find-form.php
		
		Description:
			An example of FMWebFrame's fmQuickFind function.
			
			This is the first step of the demo, providing a form that the visitor can use to enter 
			criteria used to perform the find.

		Dependencies:
			FMWebFrame
			/quick-find-handler.php
	
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
	$ui_title = "FMWebFrame Demo | Quick Find";
	
	// Start output buffering.
	ob_start();
		
?>

<h1>Quick Find</h1>

<p>FMWebFrame includes a function called "fmQuickFind" that makes it easy to add FileMaker's Quick Find functionality to your Web solutions.</p>

<p>The FMWebFrame demo database includes over 25,000 sample contact records. To see fmQuickFind in action, simply enter a common name, city, state, etc.</p>

<p>For example: smith</p>

<form method="post" action="quick-find-handler.php">
<input type="text" name="q" id="q" size="40" value="" />
<input type="submit" value="Search" />
</form>	

<script>
	document.getElementById("q").focus();
</script>
		
<?php
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>