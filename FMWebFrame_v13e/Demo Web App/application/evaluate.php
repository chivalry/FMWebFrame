<?php	

	/*
 
		File: 
			/application/evaluate.php
		
		Description:
			A demonstration of the "Evaluate" function.

		Dependencies:
			FMWebFrame
	
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
	
	// Initialize the form variable.
	if ( ! isset ( $_POST['q'] ) ) { $_POST['q'] = ''; }
	
	// Strip slashes from the expression.
	$_POST['q'] = stripslashes( $_POST['q'] );
								
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Evaluate";
	
	// Start output buffering.
	ob_start();
		
	// Page header.
	echo '<h1>Evaluate</h1>';

	// If the form has not already been submitted...
	if ( $_POST['q'] == '' ) {			
	
		echo '<p>With FMWebFrame\'s "fmEvaluate" function, you can tap into the power of FileMaker\'s calculation engine from within your Web applications.</p>';
		echo '<p>You can use any valid expression, including those that reference custom functions or plugins that have been installed on the server.</p>';
		echo '<p>To give fmEvaluate a try, enter an expression below.</p>';	
	
	} else {
	
		$result_array = fmEvaluate ( $fmDemo, $_POST['q'] );
		
		if ( $result_array["Result"] == '?' ) {
		
			echo '<p style="color: red;">Oops, the expression "' . $result_array["Expression"] . '" is invalid.</p>';
		
		} else {
			
			echo '<p>The expression:</p>';
			echo '<pre>' . $result_array["Expression"] . '</pre>';
			echo '<p>Evaluates to:</p>';
			echo '<pre>' . $result_array["Result"] . '</pre>';
			
		}
		
		echo '<p style="margin-top: 18px;">Try another expression.</p>';
				
	}	
	
	echo '<form method="post" action="' .  HTTP_ROOT_URL  . '/application/evaluate.php">';
	echo '<textarea name="q" id ="q" cols="60" rows="5">' . $_POST['q'] . '</textarea><br />';
	echo 'Example: ValueListItems ( Get ( FileName ); "States" )<br />';
	echo '<input type="submit" name="evaluate_form_submit" value="Evaluate" />';
	echo '</form>';		
	
	if ( $_POST['q'] == '' ) {	
		echo '<script>';
		echo 'document.getElementById("q").focus();';
		echo '</script>';	
	}
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>