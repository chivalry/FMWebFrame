<?php	

	/*
 
		File: 
			/application/translations.php
		
		Description:
			Includes examples of many of the functions available in FMWebFrame's 
			"FileMaker to PHP" translation function library.

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
	$ui_title = "FMWebFrame Demo | Additional Functions";
	
	// Start output buffering.
	ob_start();

	echo '<h1>Additional Functions</h1>';
	
	echo '<p>';
	echo 'FMWebFrame includes a few additional functions that we have found to be helpful, ';
	echo 'including functions to validate email addresses, get Web server and request information, and more.';
	echo '</p>';
	
	echo '<p>';
	echo 'Examples of calls to those functions follow...';
	echo '</p>';
	
	echo '<p>&bull; fmGetDocumentRoot () = ' . fmGetDocumentRoot () . '</p>';
	echo '<p>&bull; fmError ( 202 ) = ' . fmError ( 202 ) . '</p>';	
	echo '<p>&bull; fmGetDocumentRoot() = ' . fmGetDocumentRoot () . '</p>';	
	echo '<p>&bull; fmGetRemoteAddress() = ' . fmGetRemoteAddress () . '</p>';
	echo '<p>&bull; fmGetRequestTime() = ' . fmGetRequestTime () . '</p>';
	echo '<p>&bull; fmGetRequestURI() = ' . fmGetRequestURI () . '</p>';
	echo '<p>&bull; fmGetQueryString() = ' . fmGetQueryString () . '</p>';
	echo '<p>&bull; fmGetServerAddress() = ' . fmGetServerAddress () . '</p>';
	echo '<p>&bull; fmGetServerName() = ' . fmGetServerName () . '</p>';	
	echo '<p>&bull; fmGetServerPort() = ' . fmGetServerPort () . '</p>';
	// echo '<p>&bull; fmGetURL ( \'http://xgravity.net\' ) = ' . fmGetURL ( 'http://xgravity.net' ) . '</p>';	
	echo '<p>&bull; fmGetUUID() = ' . fmGetUUID () . '</p>';	
	echo '<p>&bull; fmIsValidEmail ( \'someone@test.com\' ) = ' . fmIsValidEmail ( 'someone@test.com' ) . '</p>';
	echo '<p>&bull; fmIsValidEmail ( \'someone@testcom\' ) = ' . fmIsValidEmail ( 'someone@testcom' ) . '</p>';
	echo '<p>&bull; fmIsValidURL ( \'http://www.test.com\' ) = ' . fmIsValidURL ( 'http://www.test.com' ) . '</p>';
	echo '<p>&bull; fmIsValidURL ( \'www.test.com\' ) = ' . fmIsValidURL ( 'www.test.com' ) . '</p>';	
	echo '<p>&bull; fmStripTags ( \'This is &lt;bold&gt;bold text&lt;/bold&gt;. Or not.\' ) = ' . fmStripTags ( 'This is <bold>bold text</bold>. Or not.' ) . '</p>';
	echo '<p>&bull; fmStripTags ( \'This is a &lt;a href="http://www.test.com/"&gt;link&lt;/a&gt;. Or not.\' ) = ' . fmStripTags ( 'This is <a href="http://www.test.com/">link</a>. Or not.' ) . '</p>';
	
	
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>