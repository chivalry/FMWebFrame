<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/translators.php
		
		Description:
			Loads the library of FileMaker-to-PHP translation functions. These PHP functions are intended to 
			provide equivalent results from FileMaker functions.
			
			Several of the functions included here do not have FileMaker equivalents. These are functions that 
			we've found to be helpful during development of FileMaker-based Web applications.	
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			
		Version:
			1
	
		History:
		
			2013-12-18	Tim Dietrich / Jonathan Stark
				Initial version.
				
		Comments:
		
			Thanks to Jonathan Stark ( http://jonathanstark.com/ ) for providing the 
			original "FileMaker to PHP Translation Table" upon which many of these functions
			are based. The original table can be found here:
			http://jonathanstark.com/fm/filemaker-to-php-translation-table.php		
			
		
	 */
	
	// fmDump:
	// Wrapper for PHP's "var_dump" function.
	// $object: The object to display.
	// $die: Indicates whether PHP should die after the function completes.
	// $title: An optional title to display above the output.
	// example: fmDump ( $fm_result, FALSE, 'Find Results' )
	function fmDump ( $object, $die = FALSE, $title = null ) {
		if ( isset ( $title ) ) {
			echo '<h1>' . $title . '</h1>';
		}
		echo '<pre>';
		var_dump ( $object );
		echo '</pre>';
		if ( $die ) { die(); }
		return;
	}
	
	// fmDumpAll:
	// Uses "fmDump" to display several variables scopes,
	// including _SERVER, _SESSION, etc.
	function fmDumpAll () {
		fmDump ( $_SERVER, $die = FALSE, '$_SERVER' );
		fmDump ( $_SESSION, $die = FALSE, '$_SESSION' );
		fmDump ( $_COOKIE, $die = FALSE, '$_COOKIE' );
		fmDump ( $_POST, $die = FALSE, '$_POST' );
		fmDump ( $_GET, $die = FALSE, '$_GET' );		
		die();
		return;
	}
	
	// fmError:
	// Maps a given FileMaker error code to its corresponding error message.
	// example: fmError ( 101 ) --> Returns "Record is missing"
	function fmError ( $code ) {
		switch ( $code ) {
			case -1: return ( 'Unknown error' );
			case 0: return ( 'No error' );
			case 1: return ( 'User canceled action' );
			case 2: return ( 'Memory error' );
			case 3: return ( 'Command is unavailable' );
			case 4: return ( 'Command is unknown' );
			case 5: return ( 'Command is invalid' );
			case 6: return ( 'File is read-only' );
			case 7: return ( 'Running out of memory' );
			case 8: return ( 'Empty result' );
			case 9: return ( 'Insufficient privileges' );
			case 10: return ( 'Requested data is missing' );
			case 11: return ( 'Name is not valid' );
			case 12: return ( 'Name already exists' );
			case 13: return ( 'File or object is in use' );
			case 14: return ( 'Out of range' );
			case 15: return ( 'Can\'t divide by zero' );
			case 16: return ( 'Operation failed' );
			case 17: return ( 'Attempt to convert foreign character set to UTF-16 failed' );
			case 18: return ( 'Client must provide account information to proceed' );
			case 19: return ( 'String contains characters other than A-Z' );
			case 20: return ( 'Command/operation canceled by triggered script' );
			case 100: return ( 'File is missing' );
			case 101: return ( 'Record is missing' );
			case 102: return ( 'Field is missing' );
			case 103: return ( 'Relationship is missing' );
			case 104: return ( 'Script is missing' );
			case 105: return ( 'Layout is missing' );
			case 106: return ( 'Table is missing' );
			case 107: return ( 'Index is missing' );
			case 108: return ( 'Value list is missing' );
			case 109: return ( 'Privilege set is missing' );
			case 110: return ( 'Related tables are missing' );
			case 111: return ( 'Field repetition is invalid' );
			case 112: return ( 'Window is missing' );
			case 113: return ( 'Function is missing' );
			case 114: return ( 'File reference is missing' );
			case 115: return ( 'Specified menu set is not present' );
			case 116: return ( 'Specified layout object is not present' );
			case 117: return ( 'Specified data source is not present' );
			case 130: return ( 'Files are damaged or missing and must be reinstalled' );
			case 131: return ( 'Language pack files are missing (such as template files)' );
			case 200: return ( 'Record access is denied' );
			case 201: return ( 'Field cannot be modified' );
			case 202: return ( 'Field access is denied' );
			case 203: return ( 'No records in file to print' );
			case 204: return ( 'No access to field(s) in sort order' );
			case 205: return ( 'User does not have access privileges to create new records; import will overwrite existing data' );
			case 206: return ( 'User does not have password change privileges' );
			case 207: return ( 'User does not have sufficient privileges to change database schema' );
			case 208: return ( 'Password does not contain enough characters' );
			case 209: return ( 'New password must be different from existing one' );
			case 210: return ( 'User account is inactive' );
			case 211: return ( 'Password has expired' );
			case 212: return ( 'Invalid user account and/or password; please try again' );
			case 213: return ( 'User account and/or password does not exist' );
			case 214: return ( 'Too many login attempts' );
			case 215: return ( 'Administrator privileges cannot be duplicated' );
			case 216: return ( 'Guest account cannot be duplicated' );
			case 217: return ( 'User does not have sufficient privileges to modify administrator account' );
			case 300: return ( 'File is locked or in use' );
			case 301: return ( 'Record is in use by another user' );
			case 302: return ( 'Table is in use by another user' );
			case 303: return ( 'Database schema is in use by another user' );
			case 304: return ( 'Layout is in use by another user' );
			case 306: return ( 'Record modification ID does not match' );
			case 400: return ( 'Find criteria are empty' );
			case 401: return ( 'No records match the request' );
			case 402: return ( 'Selected field is not a match field for a lookup' );
			case 403: return ( 'Exceeding maximum record limit for trial version of FileMaker Pro' );
			case 404: return ( 'Sort order is invalid' );
			case 405: return ( 'Number of records specified exceeds number of records that can be omitted' );
			case 406: return ( 'Replace/Reserialize criteria are invalid' );
			case 407: return ( 'One or both match fields are missing (invalid relationship)' );
			case 408: return ( 'Specified field has inappropriate data type for this operation' );
			case 409: return ( 'Import order is invalid' );
			case 410: return ( 'Export order is invalid' );
			case 412: return ( 'Wrong version of FileMaker Pro used to recover file' );
			case 413: return ( 'Specified field has inappropriate field type' );
			case 414: return ( 'Layout cannot display the result' );
			case 415: return ( 'One or more required related records are not available' );
			case 416: return ( 'Primary key required from data source table' );
			case 417: return ( 'Database is not supported for ODBC operations' );
			case 500: return ( 'Date value does not meet validation entry options' );
			case 501: return ( 'Time value does not meet validation entry options' );
			case 502: return ( 'Number value does not meet validation entry options' );
			case 503: return ( 'Value in field is not within the range specified in validation entry options' );
			case 504: return ( 'Value in field is not unique as required in validation entry options' );
			case 505: return ( 'Value in field is not an existing value in the database file as required in validation entry options' );
			case 506: return ( 'Value in field is not listed on the value list specified in validation entry option' );
			case 507: return ( 'Value in field failed calculation test of validation entry option' );
			case 508: return ( 'Invalid value entered in Find mode' );
			case 509: return ( 'Field requires a valid value' );
			case 510: return ( 'Related value is empty or unavailable' );
			case 511: return ( 'Value in field exceeds maximum number of allowed characters' );
			case 512: return ( 'Record was already modified by another user' );
			case 513: return ( 'Record must have a value in some field to be created' );
			case 600: return ( 'Print error has occurred' );
			case 601: return ( 'Combined header and footer exceed one page' );
			case 602: return ( 'Body doesn\'t fit on a page for current column setup' );
			case 603: return ( 'Print connection lost' );
			case 700: return ( 'File is of the wrong file type for import' );
			case 706: return ( 'EPSF file has no preview image' );
			case 707: return ( 'Graphic translator cannot be found' );
			case 708: return ( 'Can\'t import the file or need color monitor support to import file' );
			case 709: return ( 'QuickTime movie import failed' );
			case 710: return ( 'Unable to update QuickTime reference because the database file is read-only' );
			case 711: return ( 'Import translator cannot be found' );
			case 714: return ( 'Password privileges do not allow the operation' );
			case 715: return ( 'Specified Excel worksheet or named range is missing' );
			case 716: return ( 'A SQL query using DELETE or UPDATE is not allowed for ODBC import' );
			case 717: return ( 'There is not enough XML/XSL information to proceed with the import or export' );
			case 718: return ( 'Error in parsing XML file (from Xerces)' );
			case 719: return ( 'Error in transforming XML using XSL (from Xalan)' );
			case 720: return ( 'Error when exporting; intended format does not support repeating fields' );
			case 721: return ( 'Unknown error occurred in the parser or the transformer' );
			case 722: return ( 'Cannot import data into a file that has no fields' );
			case 723: return ( 'You do not have permission to add records to or modify records in the target table' );
			case 724: return ( 'You do not have permission to add records to the target table' );
			case 725: return ( 'You do not have permission to modify records in the target table' );
			case 726: return ( 'There are more records in the import file than in the target table; not all records were imported' );
			case 727: return ( 'There are more records in the target table than in the import file; not all records were updated' );
			case 729: return ( 'Errors occurred during import; records could not be imported' );
			case 730: return ( 'Unsupported Excel version (convert file to Excel 7.0 (Excel 95) or 2007 format and try again)' );
			case 731: return ( 'The file you are importing from contains no data' );
			case 732: return ( 'This file cannot be inserted because it contains other files' );
			case 733: return ( 'A table cannot be imported into itself' );
			case 734: return ( 'This file type cannot be displayed as a picture' );
			case 735: return ( 'This file type cannot be displayed as a picture; it will be inserted and displayed as a file' );
			case 736: return ( 'Too much data to export to this format; it will be truncated' );
			case 737: return ( 'Bento collection or library is missing; data cannot be imported' );
			case 800: return ( 'Unable to create file on disk' );
			case 801: return ( 'Unable to create temporary file on System disk' );
			case 802: return ( 'Unable to open file' );
			case 803: return ( 'File is single user or host cannot be found' );
			case 804: return ( 'File cannot be opened as read-only in its current state' );
			case 805: return ( 'File is damaged; use Recover command' );
			case 806: return ( 'File cannot be opened with this version of FileMaker Pro' );
			case 807: return ( 'File is not a FileMaker Pro file or is severely damaged' );
			case 808: return ( 'Cannot open file because access privileges are damaged' );
			case 809: return ( 'Disk/volume is full' );
			case 810: return ( 'Disk/volume is locked' );
			case 811: return ( 'Temporary file cannot be opened as FileMaker Pro file' );
			case 813: return ( 'Record Synchronization error on network' );
			case 814: return ( 'File(s) cannot be opened because maximum number is open' );
			case 815: return ( 'Couldn\'t open lookup file' );
			case 816: return ( 'Unable to convert file' );
			case 817: return ( 'Unable to open file because it does not belong to this solution' );
			case 819: return ( 'Cannot save a local copy of a remote file' );
			case 820: return ( 'File is in the process of being closed' );
			case 821: return ( 'Host forced a disconnect' );
			case 822: return ( 'FMI files not found; reinstall missing files' );
			case 823: return ( 'Cannot set file to single-user guests are connected' );
			case 824: return ( 'File is damaged or not a FileMaker file' );
			case 900: return ( 'General spelling engine error' );
			case 901: return ( 'Main spelling dictionary not installed' );
			case 902: return ( 'Could not launch the Help system' );
			case 903: return ( 'Command cannot be used in a shared file' );
			case 905: return ( 'No active field selected; command can only be used if there is an active field' );
			case 906: return ( 'Current file must be shared in order to use this command' );
			case 920: return ( 'Can\'t initialize the spelling engine' );
			case 921: return ( 'User dictionary cannot be loaded for editing' );
			case 922: return ( 'User dictionary cannot be found' );
			case 923: return ( 'User dictionary is read-only' );
			case 951: return ( 'An unexpected error occurred' );
			case 954: return ( 'Unsupported XML grammar' );
			case 955: return ( 'No database name' );
			case 956: return ( 'Maximum number of database sessions exceeded' );
			case 957: return ( 'Conflicting commands' );
			case 958: return ( 'Parameter missing' );
			case 1200: return ( 'Generic calculation error' );
			case 1201: return ( 'Too few parameters in the function' );
			case 1202: return ( 'Too many parameters in the function' );
			case 1203: return ( 'Unexpected end of calculation' );
			case 1204: return ( 'Number, text constant, field name or "(" expected' );
			case 1205: return ( 'Comment is not terminated with "*/"' );
			case 1206: return ( 'Text constant must end with a quotation mark' );
			case 1207: return ( 'Unbalanced parenthesis' );
			case 1208: return ( 'Operator missing, function not found or "(" not expected' );
			case 1209: return ( 'Name (such as field name or layout name) is missing' );
			case 1210: return ( 'Plug-in function has already been registered' );
			case 1211: return ( 'List usage is not allowed in this function' );
			case 1212: return ( 'An operator (for example, +, -, *) is expected here' );
			case 1213: return ( 'This variable has already been defined in the Let function' );
			case 1214: return ( 'AVERAGE, COUNT, EXTEND, GETREPETITION, MAX, MIN, NPV, STDEV, SUM and GETSUMMARY: expression found where a field alone is needed' );
			case 1215: return ( 'This parameter is an invalid Get function parameter' );
			case 1216: return ( 'Only Summary fields allowed as first argument in GETSUMMARY' );
			case 1217: return ( 'Break field is invalid' );
			case 1218: return ( 'Cannot evaluate the number' );
			case 1219: return ( 'A field cannot be used in its own formula' );
			case 1220: return ( 'Field type must be normal or calculated' );
			case 1221: return ( 'Data type must be number or timestamp' );
			case 1222: return ( 'Calculation cannot be stored' );
			case 1223: return ( 'The function is not implemented' );
			case 1224: return ( 'The function is not defined' );
			case 1225: return ( 'The function is not supported in this context' );
			case 1300: return ( 'The specified name can\'t be used' );
			case 1400: return ( 'ODBC driver initialization failed; make sure the ODBC drivers are properly installed' );
			case 1401: return ( 'Failed to allocate environment (ODBC)' );
			case 1402: return ( 'Failed to free environment (ODBC)' );
			case 1403: return ( 'Failed to disconnect (ODBC)' );
			case 1404: return ( 'Failed to allocate connection (ODBC)' );
			case 1405: return ( 'Failed to free connection (ODBC)' );
			case 1406: return ( 'Failed check for SQL API (ODBC)' );
			case 1407: return ( 'Failed to allocate statement (ODBC)' );
			case 1408: return ( 'Extended error (ODBC)' );
			case 1409: return ( 'Error (ODBC)' );
			case 1413: return ( 'Failed communication link (ODBC)' );
			case 1450: return ( 'Action requires PHP privilege extension' );
			case 1451: return ( 'Action requires that current file be remote' );
			case 1501: return ( 'SMTP authentication failed' );
			case 1502: return ( 'Connection refused by SMTP server' );
			case 1503: return ( 'Error with SSL' );
			case 1504: return ( 'SMTP server requires the connection to be encrypted' );
			case 1505: return ( 'Specified authentication is not supported by SMTP server' );
			case 1506: return ( 'Email(s) could not be sent successfully' );
			case 1507: return ( 'Unable to log in to the SMTP server' );    
		}
	}		
		
	// fmGetDocumentRoot:
	// Returns the document root directory under which the current script is executing, as defined in the server's configuration file.
	// Example result: /home/156317/domains/fmwebframe.com/html
	function fmGetDocumentRoot () {
		return ( $_SERVER['DOCUMENT_ROOT'] );
	}		
	
	// fmGetRemoteAddress:
	// Returns the IP address from which the user is viewing the current page.
	function fmGetRemoteAddress () {
		return ( $_SERVER['REMOTE_ADDR'] );
	}			
	
	// fmGetRequestTime:
	// Returns the time that the request was made.
	function fmGetRequestTime () {
		return ( $_SERVER['REQUEST_TIME'] );
	}	
	
	// fmGetRequestURI:
	// Returns the URI which was given in order to access this page.
	// Example result: examples/example-fm2php-functions.php?first_name=john&last_name=doe
	function fmGetRequestURI () {
		return ( $_SERVER['REQUEST_URI'] );
	}	
	
	// fmGetQueryString:
	// Returns the query string, if any, via which the page was accessed.
	// Example result: first_name=john&last_name=doe
	function fmGetQueryString () {
		return ( $_SERVER['QUERY_STRING'] );
	}		
	
	// fmGetServerAddress:
	// Returns the IP address of the server on which the current PHP script is executing.
	// Example result: 205.186.187.224
	function fmGetServerAddress () {
		return ( $_SERVER['SERVER_ADDR'] );
	}		
	
	// fmGetServerName:
	// Returns the name of the server host under which the current script is executing.
	// If the script is running on a virtual host, this will be the value defined for that virtual host.
	// Example result: fmwebframe.com
	function fmGetServerName () {
		return ( $_SERVER['SERVER_NAME'] );
	}
	
	// fmGetServerPort:
	// Returns the port on the server machine being used by the web server for communication. 
	// For default setups, this will be '80'; using SSL, for instance, will change this to 
	// whatever your defined secure HTTP port is (typically 443).
	// Example result: 80
	function fmGetServerPort () {
		return ( $_SERVER['SERVER_PORT'] );
	}	
	
	// fmGetURL:
	// Status: Experimental.
	// Intended to replicate FileMaker's "Insert From URL" script step.
	// $url: The URL of the resource to be retrieved.
	// $referer: The http referer string to be sent to the web server.
	// $agent: The contents of the "User-Agent: " header to be used in a HTTP request.
	// $timeout: he maximum number of time (in seconds) to allow the http request ("curl_exec") to execute.
	function fmGetURL ( $url, $referer = null, $agent = null, $timeout = 10 ) {
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		if ( ! is_null ( $referer ) ) {
			curl_setopt( $ch, CURLOPT_REFERER, $referer );
		}
		if ( ! is_null ( $agent ) ) {
			curl_setopt( $ch, CURLOPT_USERAGENT, $agent );
		}		
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
		$text = curl_exec( $ch );
		curl_close( $ch );
		return ( $text );
	}	
	
	// fmGetUUID:
	// Status: Experimental.
	// Returns a unique identifier based on the current time.	
	// Example result: 52b1e1381dd3b
	function fmGetUUID () {
		return ( fmSubstitute ( uniqid( 'fmwf-', true ), '.', '-' ) );
	}		
	
	// fmIsValidEmail:
	// Used to determine whether a given value is a properly-formed email address.
	// Note: "True" results do not imply that the email address is a "good" (deliverable) address.
	function fmIsValidEmail ( $text ) {
		if ( filter_var( $text, FILTER_VALIDATE_EMAIL ) ) {
			return ( TRUE );
		} else {
			return ( FALSE );
		}
	}	
	
	// fmIsValidURL:
	// Used to determine whether a given value is a properly-formed URL.
	// Note: "True" results do not imply that the URL is a "good" (accessible) address.	
	function fmIsValidURL ( $text ) {
		if ( filter_var( $text, FILTER_VALIDATE_URL ) ) {
			return ( TRUE );
		} else {
			return ( FALSE );
		}
	}		
	
	// fmStripTags:
	// Returns the given value with unwanted characters either stripped or encoded.
	// Example: fmStripTags ( 'This is <bold>bold text</bold>. Or not.' ) --> This is bold text. Or not.
	function fmStripTags ( $text ) {
		return ( filter_var( $text, FILTER_SANITIZE_STRING ) );
	}	

?>