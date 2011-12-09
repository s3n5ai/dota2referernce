<?php
	
	echo '<a name="items"><h1>Items</h1></a>';
	if($mode != ''){
		echo '<div class="section">';
		if ($mode == 'compact'){
			$compactItemSql = mysql_query("SELECT id, name, image, cost, content, vendor, hon FROM items WHERE active = '1' ORDER BY name");
		}
		elseif($mode == 'search'){
			$compactItemSql = mysql_query("SELECT id, name, image, cost, content, vendor, hon FROM items WHERE active = '1' AND name LIKE '%$query%' OR cost LIKE '%$query%' or content LIKE '%$query%' or vendor LIKE '%$query%' ORDER BY name");
		}
		elseif($mode == 'hon'){
			$compactItemSql = mysql_query("SELECT id, name, image, cost, content, vendor, hon FROM items WHERE active = '1' AND hon <> '' ORDER BY name");
		}
		$count = 0;
		while($row = mysql_fetch_array($compactItemSql)){
			echo '
				<ul class="item">
					<li><a href="../item.php?id='.$row['id'].'"><img width="100" src="'.$row['image'].'" />';
						if ($_GET['names'] == 't'){
							echo '<br /><span style="font-size: 12px; color: #978370;">'.$row['name'].'</span>';
						}
					echo'</a>
						<em>
							<p>ID: '.$row['id'].'</p>
							<h3>'.$row['name'].'</h3>
							<p><b>Cost: </b>'.stripslashes($row['cost']).'</b></p>'
							.stripslashes($row['content']);
							if ($row['hon'] != ''){
								echo '<p><b>HoN Equivalent: </b>'.$row['hon'].'</p>';
							}
						echo '
						</em>
					</li>
				</ul>';
			$count++;
		}

		if($count == 0){ echo '<p style="color: #B3432A">No results found for "'.$query.'".</p>';}
		echo '</div><br style="clear: both;" />';
	}
	else{

		$compactItemSql = mysql_query("SELECT id, name, image, cost, content, vendor, hon FROM items WHERE active = '1' ORDER BY name");
		echo '<div class="section">';
		while($row = mysql_fetch_array($compactItemSql)){
			echo '
				<ul class="item">
					<li><a href="../item.php?id='.$row['id'].'"><img width="100" src="'.$row['image'].'" />';
					if ($_GET['names'] == 't'){
							echo '<br /><span style="font-size: 12px; color: #978370;">'.$row['name'].'</span>';
						}

					echo '</a>
						<em>
							<p>ID: '.$row['id'].'</p>
							<h3>'.$row['name'].'</h3>
							<p><b>Cost: </b>'.stripslashes($row['cost']).'</b></p>'
							.stripslashes($row['content']);
							if ($row['hon'] != ''){
								echo '<p><b>HoN Equivalent: </b>'.$row['hon'].'</p>';
							}

						echo '</em>
					</li>
				</ul>';
		}
		echo '</div><br style="clear: both;" />';
	}
	
?>