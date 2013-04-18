<?php

function getSSOToken($apiKey,$displayName,$email,$avatarIcon,$avatarThumb,$avatarFull,$line1,$line2,$line3,$line4,$userId) {
    $rv = "";
    $raw .= '&avatarFull='.$avatarFull;
    $raw .= '&avatarIcon='.$avatarIcon;
    $raw .= '&avatarThumb='.$avatarThumb;
    $raw .= '&displayName='.$displayName;
    $raw .= '&email='.$email;
    $raw .= '&line1='.$line1;
    $raw .= '&line2='.$line2;
    $raw .= '&line3='.$line3;
    $raw .= '&line4='.$line4;
    $raw .= '&ts='.date("U");
    $raw .= '&userId='.$userId;
    $raw .= '&role=default';
    $rv = $raw.'&token='.md5($raw.'&apiKey='.$apiKey);
    return $rv;    
}
        
function getAge($dob)
{

    list($y,$m,$d) = explode('-', $dob);
    
    if (($m = (date('m') - $m)) < 0) {
        $y++;
    } elseif ($m == 0 && date('d') - $d < 0) {
        $y++;
    }
    
    return date('Y') - $y;
    
}
	
?>