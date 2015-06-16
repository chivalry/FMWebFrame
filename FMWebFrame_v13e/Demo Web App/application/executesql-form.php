<?php	

	/*
 
		File: 
			/application/executesql-form.php
		
		Description:
			An example of FMWebFrame's ExecuteSQL function.
			
			This is the first step of the demo, providing a form that the visitor can use to enter 
			criteria used to perform a SELECT statement.

		Dependencies:
			FMWebFrame
			executesql-handler.php
	
		Dependents:
			None.
	
		Version:
			1
	
		History:
		
			2014-01-14	Tim Dietrich
				Initial version.	
				
		Comments:		
		
			The form itself includes a call to the fmExecuteSQL function, using a static SELECT statement 
			to generate the list of the states referenced in the database. 
			
			It also makes use of FMWebFrame's caching function. If available, the list of states
			is pulled from the cache.
					
	*/

	// Initialize the request.
	require_once ( dirname(__FILE__) . '/../FMWebFrame/FMWebFrame.php' );	
	
	
	// Check to see if there is a list of states in the cache.
	$states_cache = fmCacheGet ( 'states' );
	
	// If there is no cached list of states, or the cache is more than 30 days old...
	if ( ( $states_cache === null ) or ( $states_cache['Cache_Age'] > 60 * 60 * 24 * 30 ) ) {

		// Get a list of the states that are referenced in the Contacts table.
		$states = fmExecuteSQL ( $fmDemo, 'SELECT DISTINCT State FROM Contacts ORDER BY State' );	
			
		// Cache the list.
		fmCachePut ( $states, 'states' );
					
	} else {
	
		// Get the content of the cache.
		$states = $states_cache['Cache_Contents'];
	
	}
									
	// Set page title.	
	$ui_title = "FMWebFrame Demo | ExecuteSQL";
	
	// Start output buffering.
	ob_start();
	
?>

<h1>ExecuteSQL</h1>

<p>With FMWebFrame's "fmExecuteSQL" function, you can query FileMaker databases using SQL Select statements directly from your Web solutions. The SELECT statements can be static (like the one used to generate the list of states in the form below) or dynamically generated (based on user criteria).</p>
<p>To give fmExecuteSQL a try, enter some search criteria using the form below. For example, search for the last name of: Smith</p>

<form method="get" action="<?php echo HTTP_ROOT_URL; ?>/application/executesql-handler.php">
<table>
	<tr>
		<td>Last Name:</td>
		<td>First Name:</td>		
		<td>State:</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><input type="text" name="last_name" id="last_name" size="15" value="" /></td>
		<td><input type="text" name="first_name" id="first_name" size="15" value="" /></td>		
		<td>
			<select name="state">
			<option value="" selected></option>
			<?php
				foreach ( $states as $state ) {
					echo '<option value="' . $state . '">' . $state . '</option>';
				}
			?>
			</select>
		</td>
		<td><input type="submit" value="Search" /></td>
	</tr>
</table>		
</form>

<p>Note: ExecuteSQL is case-sensitive.</p>

<script>
	document.getElementById("last_name").focus();
</script>
	
<?php
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>