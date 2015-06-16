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

	function fmAbs ( $number ) {
		return ( abs ( $number ) );
	}
	
	function fmCeiling ( $number ) {
		return ( ceil ( $number ) );
	}	
	
	function fmChar ( $number ) {
		return ( chr ( $number ) );
	}	
	
	function fmCode ( $text ) {
		return ( ord ( $text ) );
	}	
	
	function fmDate ( $month, $day, $year ) {
		return ( date ( "n/j/Y", mktime ( 0, 0, 0, $month, $day, $year ) ) );
	}	
	
	function fmDay ( $date ) {
		return ( date ( "j", strtotime ( $date ) ) );
	}	
	
	function fmDayName ( $text ) {
		return ( date ( "l", strtotime ( $text ) ) );
	}		
	
	function fmDayOfWeek ( $text ) {
		return ( date ( "N", strtotime ( $text ) ) + 1 );
	}	
	
	function fmDayOfYear ( $text ) {
		return ( date ( "z", strtotime ( $text ) ) + 1 );
	}	
	
	function fmExact ( $text1, $text2 ) {
		if ( strcmp ( $text1, $text2 ) == 0 ) {
			$n = 1;
		} else {
			$n = 0;
		}		
		return ( $n );
	}	
	
	function fmFilter( $textToFilter, $filterText ) {
		$result = '';
        for ( $i = 0; $i < ( strlen( $textToFilter ) ); $i++ ) {
            if ( strpos( $filterText, $textToFilter[$i] ) !== FALSE ) {
                $result .= $textToFilter[$i];
            }
        }
        return $result;
    }		
	
	function fmFloor ( $number ) {
		return ( floor ( $number ) );
	}	
	
	function fmGetAsDate ( $text ) {
		return ( date ( "n/j/Y", strtotime ( $text ) ) );
	}
	
	function fmGetAsNumber ( $text ) {
		return ( preg_replace ( "/[^0-9.-]*/", "", $text ) );
	}
	
	function fmGetAsTime ( $text ) {
		return ( date ( "H:i:s", strtotime ( $text ) ) );
	}	
	
	function fmGetAsTimestamp ( $text ) {
		return ( date ( "n/j/Y H:i:s A", strtotime ( $text ) ) );
	}	
	
	function fmGetAsURLEncoded ( $text ) {
		return ( rawurlencode ( $text ) );
	}	
	
	function fmGetCurrentDate () {
		return ( date ( "n/j/Y" ) );
	}	
	
	function fmGetCurrentTime () {
		return ( date ( "h:i:s A" ) );
	}	
	
	function fmGetCurrentTimeStamp () {
		return ( date ( "n/j/Y H:i:s A" ) );
	}
		
	function fmHour ( $time ) {
		return ( date ( "H", strtotime ( $time ) ) );
	}		
	
	function fmInt ( $number ) {
		return ( (int) $number );
	}	
	
	function fmLeft ( $text, $number ) {
		return ( substr ( $text, 0, $number ) );
	}	
	
	function fmLeftWords ( $text, $number ) {
		return ( implode ( ' ', array_slice ( str_word_count ( $text, 1 ), 0, $number ) ) );
	}		
	
	function fmLength ( $text ) {
		return ( strlen ( $text ) );
	}	
	
	function fmLower ( $text ) {
		return ( strtolower ( $text ) );
	}	
	
	function fmMiddle ( $text, $start, $numchars ) {
		return ( substr ( $text, $start - 1, $numchars ) );
	}		
	
	function fmMiddleWords ( $text, $start, $numwords ) {
		return ( implode ( ' ', array_slice ( str_word_count ( $text, 1 ), $start - 1, $numwords ) ) );
	}	
	
	function fmMinute ( $time ) {
		return ( date ( "i", strtotime ( $time ) ) );
	}	
	
	function fmMod ( $number1, $number2 ) {
		return ( $number1 % $number2 );
	}		
	
	function fmMonth ( $date ) {
		return ( date ( "n", strtotime ( $date ) ) );
	}	
	
	function fmMonthName ( $text ) {
		return ( date ( "F", strtotime ( $text ) ) );
	}
	
	function fmMonthNameShort ( $text ) {
		return ( date ( "M", strtotime ( $text ) ) );
	}		
	
	function fmPatternCount ( $haystack, $needle ) {
		return ( substr_count ( strtolower ( $haystack ) , $needle ) );
	}		
				
	function fmPosition ( $haystack, $needle, $offset = 0 ) {
		$pos = stripos ( $haystack, $needle, $offset );
		if ( $pos === FALSE ) { 
			$pos = 0;			
		} else {
			$pos = $pos + 1;
		}
		return ( $pos );
	}		
	
	function fmProper ( $text ) {
		return ( ucwords ( strtolower ( $text ) ) );
	}	
	
	function fmRandom ( $min, $max ) {
		return ( rand ( $min, $max ) );
	}		

	function fmRight ( $text, $number ) {
		return ( substr ( $text, $number * -1 ) );
	}	
	
	function fmRightWords ( $text, $number ) {
		return ( implode ( ' ', array_slice ( str_word_count ( $text, 1 ), $number * -1 ) ) );
	}		
	
	function fmRound ( $number, $precision ) {
		return ( round ( $number, $precision ) );
	}	
	
	function fmSeconds ( $time ) {
		return ( date ( "s", strtotime ( $time ) ) );
	}	
	
	// fmSerialIncrement:
	// Note: Not an exact translation of FileMaker's "SerialIncrement" function - but close.
	// Example: fmSerialIncrement("abc12";1.2) should return "abc13" but returns "abc13.2" instead.
	function fmSerialIncrement ( $text, $number ) {
		$n1 = preg_replace ( "/[^0-9.-]*/", "", $text );
		$n2 = $n1 + $number;
		return ( str_replace ( $n1, $n2, $text ) );
	}	
	
	function fmSubstitute ( $subject, $search, $replace ) {
		return ( str_replace ( $search, $replace, $subject ) );
	}	
	
	function fmTime ( $hour, $minute, $second ) {
		return ( date ( "H:i:s", mktime ( $hour, $minute, $second ) ) );
	}		
	
	function fmTimestamp ( $date, $time ) {
		return ( date ( "n/j/Y H:i:s A", mktime ( fmHour ( $time ), fmMinute ( $time ), fmSeconds ( $time ), fmMonth ( $date ), fmDay ( $date ), fmYear ( $date ) ) ) );
	}	
	
	function fmTrim ( $text ) {
		return ( trim ( $text ) );
	}	
	
	function fmTruncate ( $number, $precision ) {
		return ( (int) ( $number * pow ( 10 , $precision ) ) / pow ( 10 , $precision ) );
	}	
	
	function fmUpper ( $text ) {
		return ( strtoupper ( $text ) );
	}	
	
	function fmWeekOfYear ( $text ) {
		return ( date ( "W", strtotime ( $text ) ) );
	}	
	
	function fmWordCount ( $text ) {
		return ( str_word_count ( $text ) );
	}			

	function fmYear ( $date ) {
		return ( date ( "Y", strtotime ( $date ) ) );
	}	

?>