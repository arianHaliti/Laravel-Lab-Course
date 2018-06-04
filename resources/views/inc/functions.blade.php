<?php


if (!function_exists('time_since')) {
function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}
}
if (!function_exists('substring')) {
function substring($data,$number){
	$result="";
	if(strlen($data) > $number){
	$result = substr($data,0,$number).' ...';
	}
	else{
		$result = $data;
	}
	return $result;
}

}
if (!function_exists('number_transform')) {
function number_transform($number){
	if($number >= 100000000){
		
	
			$shortnumber= substr($number,0,3). 'm ';
	}
	else if($number >= 10000000){
		$secondnumber= substr($number,2,1);
	if($secondnumber == 0){
			$shortnumber= substr($number,0,2). 'm ';
		}
		else{
			
			$shortnumber1 = substr($number,0,2). '.';
			$shortnumber2= substr($number,2,1). 'm ';
			$shortnumber = $shortnumber1.''.$shortnumber2;
		}
	}
	else if ($number >= 1000000){
		$secondnumber= substr($number,1,1);
	if($secondnumber == 0){
			$shortnumber= substr($number,0,1). 'm ';
		}
		else{
			
			$shortnumber1 = substr($number,0,1). '.';
			$shortnumber2= substr($number,1,1). 'm ';
			$shortnumber = $shortnumber1.''.$shortnumber2;
		}
		
	}
	else if ($number >= 100000){
		
		$shortnumber= substr($number,0,3). 'k';
	}
	else if ($number >= 10000){
		$secondnumber= substr($number,2,1);
	   if($secondnumber == 0){
			$shortnumber= substr($number,0,2). 'k ';
		}
		else{
			
			$shortnumber1 = substr($number,0,2). '.';
			$shortnumber2= substr($number,2,1). 'k ';
			$shortnumber = $shortnumber1.''.$shortnumber2;
		}
	}
	
	else {
		$shortnumber = $number;
	}
	return $shortnumber;
}
}
?>