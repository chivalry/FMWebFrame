<?php	

	/*
 
		File: 
			/application/cache-handler-with-cache.php
		
		Description:
			An example of FMWebFrame's ExecuteSQL and caching functions.
			
			This is the third step of the caching demo, showing the cache being used.
			
		Dependencies:
			FMWebFrame
	
		Dependents:
			cache-handler-no-cache.php
	
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

	// Try to get the data from the cache.
	$state_counts_cache = fmCacheGet ( 'state_counts_' . $_GET['uuid'] );
	
	// Get the stop time.
	$current_time = microtime();
	$current_time = explode(' ', $current_time);
	$current_time = $current_time[1] + $current_time[0];	
	$page_stop_time = $current_time;	
	
	// Get the elapsed time.
	$page_elapsed_time = round( ( $page_stop_time - $page_start_time ), 4 );		
	
	// If there is no cached list of states, or the cache is more than 30 days old...
	if ( ( $state_counts_cache === null ) or ( $state_counts_cache['Cache_Age'] > ( 60 * 60 * 24 * 30) ) ) {
	
		// Redirect back to the "no cache" step.
		require_once ( 'cache-handler-no-cache.php' );
		die;
					
	} else {
	
		// Get the contents of the cache.
		$state_counts = $state_counts_cache['Cache_Contents'];
	
	}	
		
	// Set page title.	
	$ui_title = "FMWebFrame Demo | Caching";
	
	// Start output buffering.
	ob_start();

	echo '<h1>Caching</h1>';
		
	echo '<p>The data used in the table below <b>was</b> pulled from the cache, and that is why the page loaded so quickly. ';
	echo 'It took only ' . $page_elapsed_time . ' seconds obtain the data, while it took ' . $_GET['elapsed'] . ' seconds for the previous request.';
	echo '</p>';

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