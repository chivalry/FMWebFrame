<?php

	/*
 
		File: 
			/application/ui-template.php
		
		Description:
			A very basic template / user interface that is used by the demo app.

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
			The pages generate the body content and store it in a variable named $ui_body_content.
			They also specify the page title ( $ui_title ).
					
	*/
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title><?php echo $ui_title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo HTTP_ROOT_URL; ?>/application/ui-stylesheet.css" />
	</head>

	<body id="index-page" style="background: #cccccc;">
	
		<div style="background: #fff; padding: 9px; border: 1px solid #8F8F8F; width: 900px; margin-left:auto; margin-right:auto; margin-top: 12px; margin-bottom: 12px;">	
		
		<table class="page">
		
		
			<!-- Page Header Row -->
			<tr>
				<td>
					<!-- Header Table -->
					<table class="header">
						<tr>
							<td>				
								<a href="<?php echo HTTP_ROOT_URL; ?>/" style="font-size: 36pt; font-weight: bold; text-decoration: none;">
								FMWebFrame Demo</a>
							</td>
							<td style="text-align: right; vertical-align: middle;">
								<span style="font-weight: normal; font-size: 18pt;">v2.0</span><br/>
							</td>		
						<tr>
					</table>
				</td>
			</tr>
			
			
			<!-- Page Body Row -->
			<tr>
				<td>
					<!-- Body Table -->
					<table class="body">
						<tr>
							<!-- Body Left Column -->
							<td width="67%" valign="top" style="background: #fff; padding: 6px; border-color: #eee; border-width: 1px; border-style: none; vertical-align: top;">
								<?php echo $ui_body_content; ?>
							</td>
							<!-- Gutter -->
							<td width="3%" style="background: #ffffff;" valign="top">
								&nbsp;
							</td>	
							<!-- Body Right Column -->						
							<td width="30%" style="vertical-align: top;">	
								<table class="body_column first">
									<tr>
										<td>							
											<h2 class="body_column">Options</h2>
											<div class="small_text">
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/index.php">Home</a><br />
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/quick-find-form.php">Search Using QuickFind</a><br />
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/executesql-form.php">Search Using ExecuteSQL</a><br />
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/evaluate.php">Evaluate A FileMaker Expression</a><br />
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/cache-form.php">Caching</a><br />											
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/container-upload-form.php">Container Uploading</a><br />	
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/container-publishing.php">Container Publishing</a><br />																					
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/translations.php">FileMaker-to-PHP Translations</a><br />
											&bull; <a href="<?php echo HTTP_ROOT_URL; ?>/application/extras.php">Additional Functions</a><br />
											<br />
											</div>	
										</td>
									</tr>									
								</table>	
								<table class="body_column">
									<tr>
										<td>							
											<h2 class="body_column">For More Information</h2>
											<div class="small_text">
											Visit the <a href="http://www.fmwebframe.com/">FMWebFrame Web Site</a>.<br />
											<br />
											</div>	
										</td>
									</tr>									
								</table>																																																							
							</td>							
						</tr>	
					</table>
				</td>
			</tr>	
			
			
			<!-- Page Footer Row -->
			<tr>
				<td>
					<!-- Footer Table -->
					<table class="footer">
						<tr>
							<td>
								&copy; <?php echo date ("Y"); ?> <a href="http://timdietrich.me" target="_new">Tim Dietrich</a>. FileMaker&reg; is a registered trademark of FileMaker Inc.	
							</td>
							<td style="width: 30%; text-align: right;">
								<?php echo 'FMWebFrame v' . FMWEBFRAME_VERSION . '.'; ?>
							</td>
						</tr>					
					</table>
				</td>
			<tr>
				
		</table>	
		
		</div>
		
	</body>
	
</html>