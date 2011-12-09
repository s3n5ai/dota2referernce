<?php
include('includes/preferences.php');
$con = mysql_connect($server, $dbUsername, $dbPassword);
if (!$con){
	die('Could not connect: ' . mysql_error());
}
$selectDB = mysql_select_db($db, $con);
if (!selectDB){
	die('Could not connect to '.$db);
}

$mode = addslashes($_GET['mode']);
$query = addslashes($_GET['query']);
$text = addslashes($_GET['text']);
?>

<html>
	<head>
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/init.js"></script>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
			</script>
			<script type="text/javascript">
			try{
			var pageTracker = _gat._getTracker("UA-25235423-1");
			pageTracker._trackPageview();
			} catch(err) {}
			</script>
 	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<?php 
			if ($text == 't'){include('includes/text.php');}
			else{
				include('includes/heroes.php');
				include('includes/items.php');
			}
		?>
		
	</body>
<html>