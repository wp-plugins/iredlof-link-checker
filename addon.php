<?php 
include "Snoopy.class.php";
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', false);	
	
	$linkslist = split(",",str_replace(" ","",$_POST['link_others']));
	$tofindlink = $_POST['link_my'];
	
	function checklink($linkslist)
	{
		global $tofindlink;	
		foreach($linkslist as $linkURL)
		{	
			$found=0;
			$snoopy = new Snoopy;
			$snoopy->expandlinks = true;
			$snoopy->read_timeout=0;
			if($snoopy->fetchlinks($linkURL))
			{	
				echo("Results for <b>".$linkURL."</b><br/>");
				//echo($linkURL);
				//echo "response code: ".$snoopy->response_code."<br>\n";
				while(list($key,$val) = each($snoopy->results))
					{
						
						if(strpos($val,$tofindlink)!==false)
						{
							echo "<img src='".$_POST['wAddress']."/wp-content/plugins/link_checker/images/chk_on.png' alt='' style='vertical-align:middle;'/> <b style='color:GREEN;'>Link Found</b> <b>".$tofindlink."</b> in <b>".$linkURL."</b> (<b>Key Position :</b> ".$key.")"."<br>\n";
							$found=1;
						}
					}
	
				if($found!=1)
					echo("<img src='".$_POST['wAddress']."/wp-content/plugins/link_checker/images/chk_off.png' alt='' style='vertical-align:middle;'/> <b style='color:RED;'>Link NOT FOUND</b> <b>".$tofindlink."</b> in <b>".$linkURL."</b><br/>\n");
				
				echo "<br/>\n";
			}
			else
				echo "error fetching document: ".$snoopy->error."\n";
			settype($snoopy, 'null');
			echo("<hr/>");
		}
	}
	
	checklink($linkslist);
?>