<?php
	require('last.php');
	$arr01 = array();
	foreach($_GET as $v)
	{
	    $arr01[] = $v;
	}
	if(count($arr)==10){
		Tui_song($arr01[0],$arr01[1],$arr01[2],$arr01[3],$arr01[4],$arr01[5],$arr01[6],$arr01[7],$arr01[8],$arr01[9]);
	}else{
		 Pay_money($arr01[0],$arr01[1],$arr01[2],$arr01[3],$arr01[4],$arr01[5],$arr01[6],$arr01[7]);
	}
	//Tui_song();
?>