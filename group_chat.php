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

define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/userplane/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
require ('config.php');
require ('functions.php');

$functions_js_path = $_base_path. 'mods/userplane/functions.js';

include ('userplane_header.php');

$friends = getFriends($_SESSION['member_id']);

if (!$_SESSION['groups']) {
?>    
<div class="input-form">
    <div class="row">
<?php
	$msg->printErrors('NOT_IN_ANY_GROUPS');
	require(AT_INCLUDE_PATH.'footer.inc.php');
	exit;
?>
    </div>
</div>
<?php
}
?>
<script type="text/javascript" src="http://cdn.userplane.com/release/sdk/userplane.js"></script>
<script type="text/javascript" src="<?php echo $functions_js_path; ?>"></script>
<script>
    $(document).ready(function()
    {
        single_signon("<?php echo $SITE_ID ?>", "<?php echo $random_key; ?>", "<?php echo $token; ?>", "<?php echo $lang;?>");
    });
</script>

<?php
$group_list = implode(',', $_SESSION['groups']);
$sql = "SELECT group_id, title, description FROM ".TABLE_PREFIX."groups WHERE group_id IN ($group_list) ORDER BY title";
$result = mysql_query($sql, $db);
if(isset($_GET['submit']))
{
?>
<script>
    onReady = function () {
        up.api.require("WebchatLite",{ containerID: "roomcontainer" , roomId: "<?php echo $_GET['grp_name'];?>" ,  roomName: "<?php echo $_GET['grp_title'];?>" })
    
    }
    up.api.addEventListener(up.api.events.READY,onReady);
</script>
<?php
}
?>
<div class="input-form">
    <div class="row">
        <table class="data static" rules="rows" summary="">
            <thead>
		<tr>
			<th scope="col">Group Title</th>
			<th scope="col">Room</th>
		</tr>
            </thead>
            <tbody>
            <tr valign ="top">
                <td>
<?php
            while($row = mysql_fetch_assoc($result))
            {
                $course_group_name = $_SESSION['course_id'].'_'.$row['group_id'].'_'.str_replace(' ', '_', $row['title']);
                echo "
                    <ol id='tools'>
                    <form action='".$_SERVER['PHP_SELF']."' method='GET' >
                    <input type ='hidden' name='grp_name' value = '".$course_group_name."' />
                    <input type ='hidden' name='grp_title' value = '".$row['title']."' />    
                    <li class='top-tool'>".AT_print($row['title'], 'groups.title')."</li>
                    <li class='top-tool'><input type='submit' name='submit' value='Join Room' class='button'  /></li>
                    </form>
                    </ol>
                    ";
            }
?>
                </td>
                <td>
                    <div id="roomcontainer" style="width:500px; height:600px;"></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    
<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>