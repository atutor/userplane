<?php
$sql	= 'SELECT * FROM %smembers WHERE member_id=%d';
$sql_Params = array(TABLE_PREFIX, $_SESSION['member_id']);
$row = queryDB($sql, $sql_Params, true);

$small = "get_profile_img.php?id=".$_SESSION['member_id'];
$large = "get_profile_img.php?id=".$_SESSION['member_id']."&size=p";

$age = ($row['dob'] == '0000-00-00') ? "N/A" : getAge($row['dob']);

$random_key = mt_rand().'_'.$row['login'];

$token = getSSOToken( 
                        $API_KEY,
                        $row['first_name'],
			$row['private_email']? _AT('private'): $row['email'],
			$small,
                        $small,
                        $large,
			$age,
			$row['gender']=='n' ? 'N/A': ($row['gender']=='m' ? 'male' : 'female'),
			$row['country']=='' ? 'N/A' : $row['country'],
			"Insert Line4 Value",
			$row['login'] 
                    );

?>