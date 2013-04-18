<?php
/****************************************************************/
/* ATutor														*/
/****************************************************************/
/* Copyright (c) 2002-2010                                      */
/* Inclusive Design Institute                                   */
/* http://atutor.ca												*/
/*                                                              */
/* This program is free software. You can redistribute it and/or*/
/* modify it under the terms of the GNU General Public License  */
/* as published by the Free Software Foundation.				*/
/****************************************************************/
// $Id$

$_user_location	= 'public';

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/userplane/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<div class="input-form">
    <div class="row">
        <div id="userplane"><p><?php echo  _AT('userplane_howto');?></p></div>
        <div id="userplane">
            <script language="javascript" type="text/javascript" src="http://www.userplane.com/chatlite/medallion/chatlite.cfm?DomainID=<?php  echo $_config['userplane'];?>&initialRoom=<?php echo $_SESSION['course_title']; ?>"></script>
            <noscript>You must have JavaScript enabled to use <a href="http://www.userplane.com" title="Userplane" target="_blank">Userplane Chat</a></noscript>
        </div>
    </div>
</div>
<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>