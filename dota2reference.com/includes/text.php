<?php
	$letters = array('All', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	$letter = addslashes($_GET['letter']);
	if ($letter == 'All'){
		$heroQuery = mysql_query("SELECT * FROM heroes ORDER BY name ASC");
		$itemQuery = mysql_query("SELECT * FROM items ORDER BY name ASC");
	}
	else{
		$heroQuery = mysql_query("SELECT * FROM heroes WHERE name LIKE '$letter%' OR name LIKE '%- $letter%' ORDER BY name ASC");
		$itemQuery = mysql_query("SELECT * FROM items WHERE name LIKE '$letter%' OR name LIKE '%- $letter%' ORDER BY name ASC");

	}
	echo '<div id="letters"><center><b>';
	for($i = 0; $i < count($letters); $i++){
		echo '<a href="../index.php?letter='.$letters[$i].'&text=t">'.$letters[$i].'</a>&nbsp&nbsp ';
	}
	echo '</b></center></div><span style="float: left; margin-left: 60px; width: 40%;" class="section"><h1>Heroes</h1>';
	while($row = mysql_fetch_array($heroQuery)){
		echo '<a href="../hero.php?id='.$row['id'].'">'.$row['name'].'</a><br />';
	}
	echo '</span><span style="float: left; margin-left: 100px; width: 40%" class="section"><h1>Items</h1>';
	while($row = mysql_fetch_array($itemQuery)){
		echo '<a href="../item.php?id='.$row['id'].'">'.$row['name'].'</a><br />';
	}
	echo '</span>';
?>