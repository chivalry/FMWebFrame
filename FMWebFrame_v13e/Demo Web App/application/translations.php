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
	$ui_title = "FMWebFrame Demo | FileMaker-to-PHP Translations";
	
	// Start output buffering.
	ob_start();

	echo '<h1>FileMaker-to-PHP Translation Functions</h1>';
	
	echo '<p>';
	echo 'FMWebFrame includes a library of FileMaker-to-PHP translation functions, ';
	echo 'so you can use your knowledge of FileMaker to more easily develop PHP-based solutions.';
	echo '</p>';
	
	echo '<p>';
	echo 'Examples of calls to the translation functions follow.';
	echo '</p>';
	
	echo '<p>&bull; fmAbs ( -5.2 ) = ' . fmAbs ( -5.2 ) . '</p>';
	echo '<p>&bull; fmCeiling ( -5.2 ) = ' . fmCeiling ( -5.2 ) . '</p>';	
	echo '<p>&bull; fmChar ( 98 ) = ' . fmChar ( 98 ) . '</p>';	
	echo '<p>&bull; fmCode ( \'b\' ) = ' . fmCode ( 'b' ) . '</p>';	
	echo '<p>&bull; fmDate ( 11, 27, 1968 ) = ' . fmDate ( 11, 27, 1968 ) . '</p>';	
	echo '<p>&bull; fmDay ( \'11/27/1968\' ) = ' . fmDay ( '11/27/1968' ) . '</p>';		
	echo '<p>&bull; fmDayName ( \'11/27/1968\' ) = ' . fmDayName ( '11/27/1968' ) . '</p>';	
	echo '<p>&bull; fmDayOfWeek ( \'11/27/1968\' ) = ' . fmDayOfWeek ( '11/27/1968' ) . '</p>';	
	echo '<p>&bull; fmDayOfYear ( \'11/27/1968\' ) = ' . fmDayOfYear ( '11/27/1968' ) . '</p>';
	echo '<p>&bull; fmError ( 202 ) = ' . fmError ( 202 ) . '</p>';	
	echo '<p>&bull; fmExact ( \'McDonald\', \'McDonald\' ) = ' . fmExact ( 'McDonald', 'McDonald' ) . '</p>';	
	echo '<p>&bull; fmExact ( \'McDonald\', \'MCDOnald\' ) = ' . fmExact ( 'McDonald', 'MCDOnald' ) . '</p>';	
	echo '<p>&bull; fmFilter( \'(408)555-1212\', \'0123456789\' ) = ' . fmFilter( '(408)555-1212', '0123456789' ) . '</p>';	
	echo '<p>&bull; fmFilter( \'AaBb\', \'AB\' ) = ' . fmFilter( 'AaBb', 'AB' ) . '</p>';	
	echo '<p>&bull; fmFloor ( 5.2 ) = ' . fmFloor ( 5.2 ) . '</p>';	
	echo '<p>&bull; fmGetAsDate ( \'5/1/2007\' ) = ' . fmGetAsDate ( '5/1/2007' ) . '</p>';			
	echo '<p>&bull; fmGetAsNumber ( \'PLAT-NO.1234\' ) = ' . fmGetAsNumber ( 'PLAT-NO.1234' ) . '</p>';
	echo '<p>&bull; fmGetAsTime ( \'10:51:22\' ) = ' . fmGetAsTime ( '10:51:22' ) . '</p>';
	echo '<p>&bull; fmGetAsTimestamp ( \'11/27/1968 10:51:22\' ) = ' . fmGetAsTimestamp ( '11/27/1968 10:51:22' ) . '</p>';
	echo '<p>&bull; fmGetAsURLEncoded ( \'San Diego\' ) = ' . fmGetAsURLEncoded ( 'San Diego' ) . '</p>';
	echo '<p>&bull; fmGetCurrentDate() = ' . fmGetCurrentDate () . '</p>';	
	echo '<p>&bull; fmGetCurrentTime() = ' . fmGetCurrentTime () . '</p>';	
	echo '<p>&bull; fmGetCurrentTimeStamp() = ' . fmGetCurrentTimeStamp () . '</p>';	
	echo '<p>&bull; fmHour ( \'3:51:22 PM\' ) = ' . fmHour ( '3:51:22 PM' ) . '</p>';
	echo '<p>&bull; fmInt ( -5.2 ) = ' . fmInt ( -5.2 ) . '</p>';
	echo '<p>&bull; fmLeft ( \'Xframe\', 3 ) = ' . fmLeft ( 'Xframe', 3 ) . '</p>';
	echo '<p>&bull; fmLeftWords ( \'This is a test.\', 2 ) = ' . fmLeftWords ( 'This is a test.', 2 ) . '</p>';
	echo '<p>&bull; fmLength ( \'Xframe\' ) = ' . fmLength ( 'Xframe' ) . '</p>';
	echo '<p>&bull; fmLower ( \'This is a test.\' ) = ' . fmLower ( 'This is a test.' ) . '</p>';
	echo '<p>&bull; fmMiddle ( \'Xframe\', 2, 3 ) = ' . fmMiddle ( 'Xframe', 2, 3 ) . '</p>';
	echo '<p>&bull; fmMiddleWords ( \'This is a bigger test.\', 2, 3 ) = ' . fmMiddleWords ( 'This is a bigger test.', 2, 3 ) . '</p>';
	echo '<p>&bull; fmMinute ( \'3:51:22 PM\' ) = ' . fmMinute ( '3:51:22 PM' ) . '</p>';
	echo '<p>&bull; fmMod ( 27, 11 ) = ' . fmMod ( 27, 11 ) . '</p>';
	echo '<p>&bull; fmMonth ( \'11/27/1968\' ) = ' . fmMonth ( '11/27/1968' ) . '</p>';
	echo '<p>&bull; fmMonthName ( \'11/27/1968\' ) = ' . fmMonthName ( '11/27/1968' ) . '</p>';
	echo '<p>&bull; fmMonthNameShort ( \'11/27/1968\' ) = ' . fmMonthNameShort ( '11/27/1968' ) . '</p>';
	echo '<p>&bull; fmPatternCount ( \'Xframe\', \'Z\' ) = ' . fmPatternCount ( 'Xframe', 'Z' ) . '</p>';
	echo '<p>&bull; fmPatternCount ( \'This is a test.\', \'a\' ) = ' . fmPatternCount ( 'This is a test.', 'a' ) . '</p>';
	echo '<p>&bull; fmPatternCount ( \'This is a test.\', \'is\' ) = ' . fmPatternCount ( 'This is a test.', 'is' ) . '</p>';
	echo '<p>&bull; fmPatternCount ( \'This is a test.\', \'IS\' ) = ' . fmPatternCount ( 'This is a test.', 'IS' ) . '</p>';	
	echo '<p>&bull; fmPosition ( \'Xframe\', "r" ) = ' . fmPosition ( 'Xframe', "r" ) . '</p>';
	echo '<p>&bull; fmPosition ( \'Xframe\', \'Z\' ) = ' . fmPosition ( 'Xframe', 'Z' ) . '</p>';
	echo '<p>&bull; fmProper ( \'this is a test.\' ) = ' . fmProper ( 'this is a test.' ) . '</p>';
	echo '<p>&bull; fmRandom ( 1, 100 ) = ' . fmRandom ( 1, 100 ) . '</p>';
	echo '<p>&bull; fmRight ( \'Xframe\', 3 ) = ' . fmRight ( 'Xframe', 3 ) . '</p>';
	echo '<p>&bull; fmRightWords ( \'This is a test.\', 2 ) = ' . fmRightWords ( 'This is a test.', 2 ) . '</p>';
	echo '<p>&bull; fmRound ( 123.456, 2 ) = ' . fmRound ( 123.456, 2 ) . '</p>';
	echo '<p>&bull; fmRound ( 123.456, -2 ) = ' . fmRound ( 123.456, -2 ) . '</p>';
	echo '<p>&bull; fmSeconds ( \'3:51:22 PM\' ) = ' . fmSeconds ( '3:51:22 PM' ) . '</p>';
	echo '<p>&bull; fmSerialIncrement ( \'abc12\', 1 ) = ' . fmSerialIncrement ( 'abc12', 1 ) . '</p>';
	echo '<p>&bull; fmSerialIncrement ( \'abc12\', 7 ) = ' . fmSerialIncrement ( 'abc12', 7 ) . '</p>';
	echo '<p>&bull; fmSerialIncrement ( \'abc12\', -1 ) = ' . fmSerialIncrement ( 'abc12', -1 ) . '</p>';
	echo '<p>&bull; fmSerialIncrement ( \'abc12\', 1.2 ) = ' . fmSerialIncrement ( 'abc12', 1.2 ) . '</p>';
	echo '<p>&bull; fmStripTags ( \'This is &lt;bold&gt;bold text&lt;/bold&gt;. Or not.\' ) = ' . fmStripTags ( 'This is <bold>bold text</bold>. Or not.' ) . '</p>';
	echo '<p>&bull; fmStripTags ( \'This is a &lt;a href="http://www.test.com/"&gt;link&lt;/a&gt;. Or not.\' ) = ' . fmStripTags ( 'This is <a href="http://www.test.com/">link</a>. Or not.' ) . '</p>';
	echo '<p>&bull; fmSubstitute ( \'Xframe\', "ram", "stu" ) = ' . fmSubstitute ( 'Xframe', "ram", "stu" ) . '</p>';	
	echo '<p>&bull; fmTime ( 10, 51, 22 ) = ' . fmTime ( 10, 51, 22 ) . '</p>';
	echo '<p>&bull; fmTimestamp ( fmGetAsDate ( \'5/1/2007\' ), fmGetAsTime ( \'10:51:22\' ) ) = ' . fmTimestamp ( fmGetAsDate ( '5/1/2007' ), fmGetAsTime ( '10:51:22' ) ) . '</p>';	
	echo '<p>&bull; fmTrim ( \' This is a test. \' ) = ' . fmTrim ( ' This is a test. ' ) . '</p>';
	echo '<p>&bull; fmTruncate ( -14.6, 0 ) = ' . fmTruncate ( -14.6, 0 ) . '</p>';
	echo '<p>&bull; fmTruncate ( 123.456, 2 ) = ' . fmTruncate ( 123.456, 2 ) . '</p>';
	echo '<p>&bull; fmTruncate ( 123.456, 4 ) = ' . fmTruncate ( 123.456, 4 ) . '</p>';
	echo '<p>&bull; fmTruncate ( 29343.98, -3 ) = ' . fmTruncate ( 29343.98, -3 ) . '</p>';
	echo '<p>&bull; fmUpper ( \'This is a test.\' ) = ' . fmUpper ( 'This is a test.' ) . '</p>';
	echo '<p>&bull; fmWeekOfYear ( \'11/27/1968\' ) = ' . fmWeekOfYear ( '11/27/1968' ) . '</p>';
	echo '<p>&bull; fmWordCount ( \'This is a test.\' ) = ' . fmWordCount ( 'This is a test.' ) . '</p>';
	echo '<p>&bull; fmYear ( \'11/27/1968\' ) = ' . fmYear ( '11/27/1968' ) . '</p>';
	
	
	
	// Grab the contents of the output buffer.
	$ui_body_content = ob_get_contents();
	
	// End output buffering, and erase the contents.
	ob_end_clean();		
	
	// Display the page, using the template.
	require_once ( dirname(__FILE__) . '/ui-template.php' );
		
?>