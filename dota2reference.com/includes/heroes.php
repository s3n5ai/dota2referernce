<?php
	echo '<a name="heroes"><h1>Heroes</h1></a>';
	if($mode != ''){
		echo '<div class="section">';
		if($mode == 'compact'){
			$compactSql = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes ORDER BY name");
		}
		elseif ($mode == 'hon'){
			$compactSql = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes WHERE content LIKE '%HoN Equivalent%' ORDER BY name");
		}
		elseif ($mode == 'search'){
			$compactSql = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes WHERE content LIKE '%$query%' OR name LIKE '%$query%' OR roles LIKE '%$query%' OR stat LIKE '%$query%' OR faction LIKE '%$query%' ORDER BY name");
		}
		$count = 0;
		while($row = mysql_fetch_array($compactSql)){
			echo '
				<ul class="item">
					<li><a href="../hero.php?id='.$row['id'].'">
						<img width="100" src="'.str_replace('images/heroes', 'images/heroes/small', $row['image']).'" />';
					     if($_GET['names'] == 't'){
						   echo $row['common_name'];
					     }
					echo'
					     </a>
						<em>
							<h3>'.$row['name'].'</h3>
							<p><b>Stat: </b>'.$row['stat'].'<br />
							<b>Role: </b>'.$row['roles'].'<br />
							<b>Faction: </b>'.$row['faction'].'</p>'
							.stripslashes($row['content']).'
						</em>
					</li>
				</ul>';
			$count++;
		}
		
		if($count == 0){ echo '<p style="color: #B3432A">No results found for "'.$query.'".</p>';}
		echo '</div><br style="clear: both;" />';
	}
	else{
		$sql = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes ORDER BY stat");
		$strQuery = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes WHERE stat = 'Strength' ORDER BY sort");
		$agiQuery = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes WHERE stat = 'Agility' ORDER BY sort");
		$intQuery = mysql_query("SELECT id, name, common_name, image, faction, roles, content, stat FROM heroes WHERE stat = 'Intelligence' ORDER BY sort");
		echo '<div class="section"><h3>Strength</h3>';
		while($row = mysql_fetch_array($strQuery)){
			echo '
				<ul class="item">
					<li><a href="../hero.php?id='.$row['id'].'">
						<img width="100" src="'.str_replace('images/heroes', 'images/heroes/small', $row['image']).'" />';
						if($_GET['names'] == 't'){
						   echo '<br /><span style="font-size: 12px; color: #978370;">'.$row['common_name'].'</span>';
					     	}
						echo '
						</a>
						<em>
							<h3>'.$row['name'].'</h3>
							<p><b>Stat: </b>'.$row['stat'].'<br />
							<b>Role: </b>'.$row['roles'].'<br />
							<b>Faction: </b>'.$row['faction'].'</p>'
							.stripslashes($row['content']).'
						</em>
					</li>
				</ul>';

		}
		echo '</div><br />';
		echo '<div class="section"><h3>Agility</h3>';
		while($row = mysql_fetch_array($agiQuery)){
			echo '
				<ul class="item">
					<li><a href="../hero.php?id='.$row['id'].'">
						<img width="100" src="'.str_replace('images/heroes', 'images/heroes/small', $row['image']).'" />';
						if($_GET['names'] == 't'){
						   echo '<br /><span style="font-size: 12px; color: #978370;">'.$row['common_name'].'</span>';
					     	}
						echo '
						</a>
						<em>
							<h3>'.$row['name'].'</h3>
							<p><b>Stat: </b>'.$row['stat'].'<br />
							<b>Role: </b>'.$row['roles'].'<br />
							<b>Faction: </b>'.$row['faction'].'</p>'
							.stripslashes($row['content']).'
						</em>
					</li>
				</ul>';

		}
		echo '</div><br />';
		echo '<div class="section"><h3>Intelligence</h3>';
		while($row = mysql_fetch_array($intQuery)){
			echo '
				<ul class="item">
					<li><a href="../hero.php?id='.$row['id'].'">
						<img width="100" src="'.str_replace('images/heroes', 'images/heroes/small', $row['image']).'" />';
						if($_GET['names'] == 't'){
						   echo '<br /><span style="font-size: 12px; color: #978370;">'.$row['common_name'].'</span>';
					     	}
						echo '
						</a>
						<em>
							<h3>'.$row['name'].'</h3>
							<p><b>Stat: </b>'.$row['stat'].'<br />
							<b>Role: </b>'.$row['roles'].'<br />
							<b>Faction: </b>'.$row['faction'].'</p>'
							.stripslashes($row['content']).'
						</em>
					</li>
				</ul>';

		}
		echo '</div><br />';


		/*
		$lastStat = '';
		while($row = mysql_fetch_array($sql)){
			if ($row['stat'] != $lastStat){
				echo '</div><br /><div class="section">
					<h3>'.$row['stat'].'</h3>';
				$lastStat = $row['stat'];
			}
			echo '
				<ul class="item">
					<li><a href="../hero.php?id='.$row['id'].'">
						<img width="100" src="'.str_replace('images/heroes', 'images/heroes/small', $row['image']).'" />';
						if($_GET['names'] == 't'){
						   echo '<br /><span style="font-size: 12px; color: #978370;">'.$row['common_name'].'</span>';
					     	}
						echo '
						</a>
						<em>
							<h3>'.$row['name'].'</h3>
							<p><b>Stat: </b>'.$row['stat'].'<br />
							<b>Role: </b>'.$row['roles'].'<br />
							<b>Faction: </b>'.$row['faction'].'</p>'
							.stripslashes($row['content']).'
						</em>
					</li>
				</ul>';
			
		}
		echo '</div><br />';
		*/
	}
?>