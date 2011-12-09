<?php
	include('includes/simple_html_dom.php');
	include('includes/preferences.php');
	function curl($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            return curl_exec($ch);
            curl_close($ch);
        }

	$con = mysql_connect($server, $dbUsername, $dbPassword);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	$selectDB = mysql_select_db($db, $con);
	if (!$selectDB){
		die('Could not connect to '.$db);
	}


	$url = 'http://www.dota2reference.com';
	$html =  file_get_html($url);
	$count = 0;
	foreach($html->find('div[id=faction]') as $items){
		foreach($items->find('ul') as $item){
			$count++;
			$image = $item->find('img');
			$title = $item->find('h3');
			$body = $item->find('em');
			$img = $image[0]->src;
			$price = $item->find('p[class=price]');
			$price[0] = mysql_real_escape_string($price[0]);
			$body[0] = $body[0]->innertext;	
			$pattern = '/b\>([0-9]*)\<\/p\>/';
			preg_match($pattern, $body[0], $cost);
			echo $cost[1];
			$image[0] =  mysql_real_escape_string($image[0]);
			$body[0] =  mysql_real_escape_string(str_replace($title[0], '', $body[0]));
			$body[0] = str_replace($price[0], '', $body[0]);
			$title[0] =  mysql_real_escape_string($title[0]->innertext);
			
			//echo $title[0];
			//echo '<br />';
			//echo $image[0];
			//echo $body[0];
			$sql = "UPDATE heroes SET image = '$img' WHERE name = '$title[0]'";
			echo $sql;
			mysql_query($sql, $con);
			echo mysql_error($link);
		}	
		echo $count;
	}
?>