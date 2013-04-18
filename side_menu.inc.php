<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002-2010                                              */
/* Inclusive Design Institute                                           */
/* http://atutor.ca                                                     */
/* This program is free software. You can redistribute it and/or        */
/* modify it under the terms of the GNU General Public License          */
/* as published by the Free Software Foundation.                        */
/************************************************************************/
// $Id$

if (!defined('AT_INCLUDE_PATH')) { exit; }
global $db;
global $_base_path;
global $savant;
global $system_courses;

// global $_course_id is set when a guest accessing a public course. 
// This is to solve the issue that the google indexing fails as the session vars are lost.
global $_course_id;
if (isset($_SESSION['course_id'])) $_course_id = $_SESSION['course_id'];

ob_start();

?>
<script type="text/javascript" src="http://cdn.userplane.com/release/sdk/userplane.js"></script>

<?php
$sql = "SELECT u.member_id,u.login,m.login as log FROM ".TABLE_PREFIX."users_online as u INNER JOIN ".TABLE_PREFIX."members as m ON u.member_id=m.member_id WHERE course_id=$_course_id AND expiry>".time()." AND u.member_id!=".$_SESSION['member_id']." ORDER BY u.login";
$result	= mysql_query($sql, $db);

if ($row = mysql_fetch_assoc($result)) {
	echo '<ul style="padding: 0px; list-style: none;">';
	do {
		$type = 'class="user"';
		if ($system_courses[$_course_id]['member_id'] == $row['member_id']) {
			$type = 'class="user instructor" title="'._AT('instructor').'"';
		}
		echo '<li style="padding: 3px 0px;"><a onClick="up.api.startInstantMessage(\''.$row['log'].'\')" href="'.$_base_path.'mods/userplane/index.php#OpenIM">'.AT_print($row['login'], 'members.login').'</a></li>';
	} while ($row = mysql_fetch_assoc($result));
	echo '</ul>';
} else {
	echo '<strong>'._AT('none_found').'</strong><br />';
}


$savant->assign('dropdown_contents', ob_get_contents());
ob_end_clean();
$savant->assign('title', _AT('userplane'));
$savant->display('include/box.tmpl.php');
?>