
		<a href="index.php"><img src="images/dota2logo.jpg" /></a><a href="#top"><br /></a>
		<div id="topbar">
			<b style="float: left; margin: 5px 0 0 0;">
			<?php 
				if(count($_GET) == 0){
					echo '<a href="#heroes">Heroes</a>  <a href="#items">Items</a> ';
				}
				if ($mode != ''){echo '<a href="index.php">Normal View</a>';}
				else{echo '<a href="index.php?mode=compact">Compact View</a>';}
				
				if($text == 't'){echo '<a href="index.php">Pictures</a>';}
				else{echo '<a href="index.php?text=t">Text-Only</a>';}

				if($_GET['names'] == 't'){echo '<a href="index.php">Hide Names</a>';}
				else{echo '<a href="index.php?names=t">Show Names</a>';}
			?>
			 <a href="index.php?mode=hon">HoN Equivalents</a></b>
			
			
			<form style="margin: 0 0 0 3px; float: right; display: inline;" action="index.php" method="get">
				<b style="color: #978370; font-family: arial, sans-serif;">Search:</b> 
				<input type="text" class="rounded" name="query" id="query"/></p>
				<input type="hidden" name="mode" id="mode" value="search" />
			</form>
		</div>