<?php

	/*

		File: 
			/FMWebFrame/FMWebFrame/site-shield.php
		
		Description:
			Loads the fmSiteShield function, then calls the function.
		
		Dependencies:
			None.
	
		Dependents:
			/FMWebFrame/FMWebFrame.php
			
		Version:
			1
	
		History:
		
			2014-06-14	Tim Dietrich
				Initial version.

		------------------------------------------------------------------------------------------------------------
		
	
		"fmSiteShield"
		
		Purpose:
			Provides a virtual firewall for the Web app.
		
		Parameters:
			[1] $site_shield_method: The protection method to use. See below for details.
			[2] $site_shield_ips: The IP addresses to allow / deny access.

		Output:
			Nothing if the user has permission to access the app. Otherwise, an error message
			indicating that the user is being denied access.
			
		Example:
		
			fmSiteShield ( SITE_SHIELD_METHOD, $site_shield_ips );
			
		Notes:
		
			Supported value for $site_shield_method:
			
				"Deny/Allow"
				All visitors, except those whose IPs are specified, will be denied access.
			
				"Allow/Deny"
				All visitors, except those whose IPs are specified, will be granted access.
			
				NULL
				SiteShiled is disabled. (All visitors will be granted access.)	
			
			
			Specifying $site_shield_ips:
			
				Should be passed as an array. For an example, see FMWebFrame's settings file.
				
				IP wildcards can be specified using the "*" symbol.
				For example, you can specify "173.67.245.*" to apply a rule to the IP address block
				173.67.245.1 thru 173.67.245.255, or "173.67.*" and so on.
		
	*/


	
	
	
	function fmSiteShield ( $site_shield_method, $site_shield_ips ) {

		// Get the visitor's IP.
		$visitor_ip = $_SERVER[ 'REMOTE_ADDR' ];

		if ( $site_shield_method == 'Deny/Allow' ) {
			// Assume that the visitor's IP address is not allowed.
			$access_allowed = FALSE;
		} elseif ( $site_shield_method == 'Allow/Deny' ) {
			// Assume that the visitor's IP address is allowed.
			$access_allowed = TRUE;		
		} else {
			return;
		}
				
		// Loop over the list of allowed IPs...
		foreach ( $site_shield_ips as $ip ) {
		
			// If the allowed IP is a wildcard (ex: 173.67.245.*)...
			if ( substr_count ( $ip , '*' ) ) {
			
				// Get the stem of the allowed IP (ex: 173.67.245.)
				$ip_partial = substr ( $ip, 0, stripos ( $ip , '*' ) );
				
				// Get the equivalent stem from the visitor's IP.
				$visitor_ip_partial = substr ( $visitor_ip, 0, strlen ( $ip_partial ) );
								
				// If the stems match.
				if ( $visitor_ip_partial == $ip_partial ) {
					if ( $site_shield_method == 'Deny/Allow' ) {
						$access_allowed = TRUE;						
					} else {
						$access_allowed = FALSE;
					}
					break;
				}
				
			// If the visitor's IP matches the allowed IP...
			} elseif ( $visitor_ip == $ip ) {
				if ( $site_shield_method == 'Deny/Allow' ) {
					$access_allowed = TRUE;						
				} else {
					$access_allowed = FALSE;
				}
				break;
			}
		
		}
				
				
		// If the visitor's IP address is denied...
		if ( ! $access_allowed ) {
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
			echo '<html xmlns="http://www.w3.org/1999/xhtml">';
			echo '<head>';
			echo '<title>Access Denied</title>';
			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
			echo '</head>';
			echo '<body style="background: red; font-family: Helvetica, sans-serif; text-align: center;">';
			echo '<p style="color: #fff; padding-top: 24px; padding-bottom: 36px;">';
			echo '<span style="color: #000; font-weight: bold; font-size: 24pt;">Sorry, but you do not have permission to access this site.</span><br /><br />';
			echo '<span style="color: #fff; font-weight: normal; font-size: 18pt;">Your IP Address is: ' . $visitor_ip . '</span>';
			echo '</p>';
			echo '</body>';
			echo '</html>	';		
			die;			
		}
	
	
	}
	
	// Call the fmSiteShield function.
	fmSiteShield ( SITE_SHIELD_METHOD, $site_shield_ips );
	
	
?>