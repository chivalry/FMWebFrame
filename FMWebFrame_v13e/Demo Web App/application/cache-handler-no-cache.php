<?php	

	/*
 
		File: 
			/application/cache-handler-no-cache.php
		
		Description:
			An example of FMWebFrame's ExecuteSQL and caching functions.
			
			This is the second step of the caching demo, showing a call to 
			the database that does not use the cache. It also links to
			the page that shows the cache being used ("cache-handler-with-cache.php").
			
		Dependencies:
			FMWebFrame
			cache-handler-with-cache.php
	
		Dependents:
			cache-form.php
	
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
	
	// Get the start time.
	$current_time = microtime();
	$current_time = explode(' ', $current_time);
	$current_time = $current_time[1] + $current_time[0];	
	$page_start_time = $current_time;	

	// Get a list of the states that are referenced in the Contacts table.
	$state_counts = fmExecuteSQL ( $fmDemo, 'SELECT State, COUNT(*) FROM Contacts GROUP BY State ORDER BY State' );	
	
	// Get the stop time.
	$current_time = microtime();
	$current_time = explode(' ', $current_time);
	$current_time = $current_time[1] + $current_time[0];	
	$page_stop_time = $current_time;	
	
	// Get the elapsed time.
	$page_elapsed_time = round( ( $page_stop_time - $page_start_time ), 4 );
	
	// Get a unique ID for this example.
	$uuid = uniqid();
	
	// Cache the results.
	fmCachePut ( $state_counts, 'state_counts_' . $uuid );		
											
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Caching";
	
	// Start output buffering.
	ob_start();

	echo '<h1>Caching</h1>';
		
	echo '<p>The data used in the table below was <b>not</b> pulled from the cache, and that is why it took so long for the page to load. ';
	echo 'In fact, <b>it took ' . $page_elapsed_time . ' seconds</b> just to obtain the data from the database server.';
	echo '</p>';
	
	echo '<p>';
	echo 'In this example, an ExecuteSQL call was made with this SELECT statement: SELECT State, COUNT(*) FROM Contacts GROUP BY State ORDER BY State. (The demo database includes over 25,000 sample contact records.)';
	echo '</p>';	
	
	echo '<p>To see how much faster the page loads when the cache is used, ';
	echo '<a href="cache-handler-with-cache.php?uuid=' . $uuid . '&elapsed=' . $page_elapsed_time . '">click here</a>.</p>';

	echo '<table class="gridtable">';
	echo '<tr>';
	echo '<th>State</th>';
	echo '<th># of Contacts</th>';
	echo '</tr>';
	// Loop over the results...
	foreach ( $state_counts as $row ) {

		// Convert the row into an associative array. (Makes it easier to use the results.)
		$columns = fmGetRow ( $row, 'State, Count' );

		// Display the row.
		echo '<tr>';
		echo '<td>' . $columns['State'] . '</td>';
		echo '<td>' . $columns['Count'] . '</td>';
		echo '</tr>' . "\n";
		
	}
	echo '</table>';		
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>