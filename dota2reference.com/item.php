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

$id = addslashes($_GET['id']);
$sql = "SELECT name, image, cost, content, vendor, buildsTo, buildsFrom FROM items WHERE id = '$id'";
$query = mysql_query($sql, $con);
$items = mysql_fetch_assoc($query);

$buildsTo = explode(',', $items['buildsTo']);
$buildsFrom = explode(',', $items['buildsFrom']);

$buildsToContent = '';
$buildsFromContent = '';
$heroContent = '';

$heroIdSql = "SELECT heroId FROM builds WHERE `starting` LIKE '%$id%' OR `early` LIKE '%$id%' OR `core` LIKE '%$id%' OR `luxury` LIKE '%$id%'";
$heroIdQuery = mysql_query($heroIdSql);

while($heroId = mysql_fetch_assoc($heroIdQuery)){
	$hId = $heroId['heroId'];
	$iDquery = mysql_query("SELECT id, name, image, faction, stat, roles, content FROM heroes WHERE id = '$hId'");
	$hero = mysql_fetch_assoc($iDquery);
	$heroContent .= '
				<ul class="item">
					<li><a href="../hero.php?id='.$hero['id'].'"><img width="100" src="'.$hero['image'].'" /></a>
						<em>
							<h3>'.$hero['name'].'</h3>
							<p><b>Stat: </b>'.$hero['stat'].'<br />
							<b>Role: </b>'.$hero['roles'].'<br />
							<b>Faction: </b>'.$hero['faction'].'</p>'
							.stripslashes($hero['content']).'
						</em>
					</li>
				</ul>';

}


if($items['buildsTo'] != ''){
	for($i = 0; $i < count($buildsTo); $i++){
		$query = mysql_query("SELECT * FROM items WHERE `id` = '$buildsTo[$i]'");
		$item = mysql_fetch_assoc($query);
		$buildsToContent .= '
						 <ul class="item" style="float: left; display: inline;">
								<li><a href="../item.php?id='.$item['id'].'"><img height="35" src="'.$item['image'].'" /></a>
									<em>
										<p>ID: '.$item['id'].'</p>
										<h3>'.$item['name'].'</h3>
										<p><b>Cost: </b>'.stripslashes($item['cost']).'</b></p>'
										.stripslashes($item['content']);
										if ($row['hon'] != ''){
											$buildsToContent .= '<p><b>HoN Equivalent: </b>'.$item['hon'].'</p>';
										}

									$buildsToContent .= '</em>
								</li>
							</ul>';

	}
}
if($items['buildsFrom'] != ''){
	for($i = 0; $i < count($buildsFrom); $i++){
		$query = mysql_query("SELECT * FROM items WHERE id = '$buildsFrom[$i]'");
		$item = mysql_fetch_assoc($query);
		$buildsFromContent .= '
							<ul class="item" style="float: left; display: inline;">
								<li><a href="../item.php?id='.$item['id'].'"><img height="35" src="'.$item['image'].'" /></a>
									<em>
										<p>ID: '.$item['id'].'</p>
										<h3>'.$item['name'].'</h3>
										<p><b>Cost: </b>'.stripslashes($item['cost']).'</b></p>'
										.stripslashes($item['content']);
										if ($row['hon'] != ''){
											$buildsFromContent .= '<p><b>HoN Equivalent: </b>'.$item['hon'].'</p>';
										}

									$buildsFromContent .= '</em>
								</li>
							</ul>';

	}
}


mysql_close($con);
?>

<html>
	<head>
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/init.js"></script>
		<style>
			p{color: #FFF;}
			#content{clear: none; float: left; width: 100%;}
		</style>
 	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<?php
			echo '<h1>'.$items['name'].'</h1>
			
			<div class="section">
				<img style="float: right;" src="'.$items['image'].'" />
				<p><b>Cost: </b> '.stripslashes($items['cost']).'<br />'
				.stripslashes($items['content']);
				if($buildsToContent != '' || $buildsFromContent != ''){
					echo '<table>';
					if($buildsToContent != ''){
						echo '<tr><td><b>Builds To: </b></td><td>'.$buildsToContent.'</td></tr>';
					}
					if($buildsFromContent != ''){
						echo '<tr><td><b>Builds From: </b></td><td>'.$buildsFromContent.'</td></tr>';
					}
					echo '</table>';
				}
				if($heroContent != ''){ echo '<br /><h3>Recommended On</h3>'.$heroContent;}
			echo '</div>';

		?>
	</body>
<html>