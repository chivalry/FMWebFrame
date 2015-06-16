<?php	

	/*
 
		File: 
			/application/quick-find-handler.php
		
		Description:
			The home page for the Demo app.

		Dependencies:
			FMWebFrame
	
		Dependents:
			quick-find-form.php
	
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
	
	// Initialize the form variable.
	if ( ! isset ( $_POST['q'] ) ) { $_POST['q'] = ''; }
	
	// If no criteria was entered...
	if ( $_POST['q'] == '' ) {
		require_once ( dirname(__FILE__) . '/quick-find-form.php' );
		die;
	}
								
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Quick Find";
	
	// Start output buffering.
	ob_start();
	
	// Page header.
	echo '<h1>Quick Find</h1>';
		
	// Perform the quick find.		
	$quickfind_contacts = fmQuickFind 
		( 
			$fmDemo, 								// The FileMaker connection object to be used.
			'Contacts - Form',						// The layout on which the Quick Find is to be performed.
			$_POST['q'],							// The value to search for.
			'Contacts - Form',						// The layout from which results are to be returned.
			'Last_Name ASC, First_Name ASC'			// Optional sort instructions.
		);	

	// If there was an error...
	if ( FileMaker::isError( $quickfind_contacts ) ) {	

		echo '<p>Oh, no!</p>';
		echo '<p>Error Code: ' . $contacts -> code . '</p>';
		echo '<p>Error Message: ' . $contacts -> message . '</p>';	
	
	} else {
	
		// Provide feedback to the user.
		if ( $quickfind_contacts -> getFoundSetCount() > 0 ) {
			echo '<p>' . $quickfind_contacts -> getFoundSetCount() . ' contacts were found, and are displayed below.</p>';			
		} else {
			echo '<p>Oops! No contacts were found that contain "' . $_POST['q'] . '."</p>';
		}
		
		echo '<p>Feel free to change your search criteria to try again.</p>';
		echo '<form style="margin-bottom: 18px;" method="post" action="quick-find-handler.php">';
		echo '<input type="text" name="q" size="40" value="' . $_POST['q'] . '" />';
		echo '<input type="submit" value="Search" />';
		echo '</form>';		
	
		// If contacts were found...
		if ( $quickfind_contacts -> getFoundSetCount() > 0 ) {
		
			// Grab the results.
			$contacts = $quickfind_contacts -> getRecords();			

			// Display the results in a table.
			echo '<table class="gridtable">';
			
				echo '<tr>';
					echo '<th>Name</th>';
					echo '<th>Street Address</th>';
					echo '<th>City</th>';
					echo '<th>State</th>';
					echo '<th>Zip</th>';
				echo '</tr>';
			
				// Loop over the results...
				foreach ($contacts as $contact ) {

					// Add a row to the table.
					echo '<tr>';
						echo '<td>' . $contact -> getField ( 'Last_Name' ) . ', ' . $contact -> getField ( 'First_Name' ) . '</td>';
						echo '<td>' . $contact -> getField ( 'Street_Address' ) . '</td>';
						echo '<td>' . $contact -> getField ( 'City' ) . '</td>';
						echo '<td>' . $contact -> getField ( 'State' ) . '</td>';
						echo '<td>' . $contact -> getField ( 'Zip_Code' ) . '</td>';
					echo '</tr>' . "\n";

				}
			
			echo '</table>';

		}

	}
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>