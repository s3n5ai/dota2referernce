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

$id = $_GET['id'];
$sql = "SELECT * FROM heroes WHERE id = '$id'";

$query = mysql_query($sql, $con);
$hero = mysql_fetch_assoc($query);

$buildSql = "SELECT * FROM builds WHERE heroId = '$id'";
$buildQuery = mysql_query($buildSql, $con);
$build = mysql_fetch_assoc($buildQuery);

$starting = explode(',', $build['starting']);

$early = explode(',', $build['early']);
$core = explode(',', $build['core']);
$luxury = explode(',', $build['luxury']);


?>

<html>
	<head>
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/init.js"></script>
		<style>
			p{color: #FFF;}
			.item p{color:#000;}
			.item b{color: #000;}
			b{color: #FFF;}
		</style>
 	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<?php
			echo '<h1>'.$hero['name'].'</h1>
			
			<div class="section">
				<span id="content">';
					if($hero['q_name'] == ''){
						echo '<p><b>Faction: </b> '.stripslashes($hero['faction']).'<br />
						<b>Stat: </b> '.stripslashes($hero['stat']).'<br />
						<b>Roles: </b> '.stripslashes($hero['roles']).' </p>'
						.stripslashes($hero['content']);
					}
					else{
						echo '<h3>'.$hero['q_name'].'</h3>
							<img src="'.$hero['q_image'].'" style="float: left; margin: 0 10px 0 0;" />
							'.$hero['q_content'].'<br />
							<h3>'.$hero['w_name'].'</h3>
							<img src="'.$hero['w_image'].'" style="float: left; margin: 0 10px 0 0;" />
							'.$hero['w_content'].'<br />
							<h3>'.$hero['e_name'].'</h3>
							<img src="'.$hero['e_image'].'" style="float: left; margin: 0 10px 0 0;" />
							'.$hero['e_content'].'<br />
							<h3>'.$hero['r_name'].'</h3>
							<img src="'.$hero['r_image'].'" style="float: left; margin: 0 10px 0 0;" />
							'.$hero['r_content'];

					}
				echo '</span>
				<div id="stats">
					<img class ="center" src="'.$hero['image'].'" />
					<ul style="float: left;">
						<li><b>STR: </b>'.$hero['strength'].'</li>
						<li><b>HP(1-25): </b>'.$hero['hp'].'</li>
						<li><b>Damage: </b>'.$hero['damage'].'</li>
						<li><b>Movespeed: </b>'.$hero['movespeed'].'</li>
						<li><b>Attack Animation: </b>'.$hero['attackAnimation'].'</li>
						<li><b>Base Attack Time: </b>'.$hero['baseAttackTime'].'</li>
						<li><b>Missile Speed: </b>'.$hero['missileSpeed'].'</li>

					</ul>
					<ul style="float: right;">
						<li><b>AGI: </b>'.$hero['agility'].'</li>
						<li><b>INT: </b>'.$hero['intelligence'].'</li>
						<li><b>Mana(1-25): </b>'.$hero['mana'].'</li>
						<li><b>Armor: </b>'.$hero['armor'].'</li>
						<li><b>Attack Range: </b>'.$hero['attackRange'].'</li>
						<li><b>Cast Animation: </b>'.$hero['castAnimation'].'</li>
						<li><b>Site Range: </b>'.$hero['siteRange'].'</li>
					</ul>
				</div>

			<div id="build">
			<h3>Build:</h3>
				<table>
				<tr>
				<td><b style="float: left;">Starting: </b></td>';
				for($i = 0; $i < count($starting); $i++){
					$sql = "SELECT * FROM items WHERE id = '$starting[$i]'";
					$query = mysql_query($sql);
					$item = mysql_fetch_assoc($query);
					echo '<td>
						<ul class="item" style="float: left; display: inline;">
							<li><a href="../item.php?id='.$item['id'].'"><img height="35" src="'.$item['image'].'" /></a>
								<em>
									<p>ID: '.$item['id'].'</p>
									<h3>'.$item['name'].'</h3>
									<p><b>Cost: </b>'.stripslashes($item['cost']).'</b></p>'
									.stripslashes($item['content']);
									if ($row['hon'] != ''){
										echo '<p><b>HoN Equivalent: </b>'.$item['hon'].'</p>';
									}

								echo '</em>
							</li>
						</ul></td>';
				}
				echo '</tr><tr><td><b style="float: left;">Early: </b></td>';
				for($i = 0; $i < count($early); $i++){
					$sql = "SELECT * FROM items WHERE id = '$early[$i]'";
					$query = mysql_query($sql);
					$item = mysql_fetch_assoc($query);
					echo '<td>
						<ul class="item" style="float: left; display: inline;">
							<li><a href="../item.php?id='.$item['id'].'"><img height="35" src="'.$item['image'].'" /></a>
								<em>
									<p>ID: '.$item['id'].'</p>
									<h3>'.$item['name'].'</h3>
									<p><b>Cost: </b>'.stripslashes($item['cost']).'</b></p>'
									.stripslashes($item['content']);
									if ($row['hon'] != ''){
										echo '<p><b>HoN Equivalent: </b>'.$item['hon'].'</p>';
									}

								echo '</em>
							</li>
						</ul></td>';

				}

				echo '</tr><tr><td><b style="float: left;">Core: </b></td>';
				for($i = 0; $i < count($core); $i++){
					$sql = "SELECT * FROM items WHERE id = '$core[$i]'";
					$query = mysql_query($sql);
					$item = mysql_fetch_assoc($query);
					echo '<td>
						<ul class="item" style="float: left; display: inline;">
							<li><a href="../item.php?id='.$item['id'].'"><img height="35" src="'.$item['image'].'" /></a>
								<em>
									<p>ID: '.$item['id'].'</p>
									<h3>'.$item['name'].'</h3>
									<p><b>Cost: </b>'.stripslashes($item['cost']).'</b></p>'
									.stripslashes($item['content']);
									if ($row['hon'] != ''){
										echo '<p><b>HoN Equivalent: </b>'.$item['hon'].'</p>';
									}

								echo '</em>
							</li>
						</ul></td>';
				}

				echo '</tr><tr><td><b style="float: left;">Luxury: </b></td>';
				for($i = 0; $i < count($luxury); $i++){
					$sql = "SELECT * FROM items WHERE id = '$luxury[$i]'";
					$query = mysql_query($sql);
					$item = mysql_fetch_assoc($query);
					echo '<td>
						<ul class="item" style="float: left; display: inline;">
							<li><a href="../item.php?id='.$item['id'].'"><img height="35" src="'.$item['image'].'" /></a>
								<em>
									<p>ID: '.$item['id'].'</p>
									<h3>'.$item['name'].'</h3>
									<p><b>Cost: </b>'.stripslashes($item['cost']).'</b></p>'
									.stripslashes($item['content']);
									if ($row['hon'] != ''){
										echo '<p><b>HoN Equivalent: </b>'.$item['hon'].'</p>';
									}

								echo '</em>
							</li>
						</ul></td>';
				}

				echo '</tr></table><br style="clear: both;"/>';

			echo '</div></div>';
		?>
	</body>
<html>
<?php mysql_close($con); ?>