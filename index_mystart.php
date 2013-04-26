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

$_user_location	= 'users';
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/userplane/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
require ('config.php');
require ('functions.php');

$functions_js_path = $_base_path. 'mods/userplane/functions.js';

include ('userplane_header.php');

?>

<script type="text/javascript" src="http://cdn.userplane.com/release/sdk/userplane.js"></script>
<script type="text/javascript" src="<?php echo $functions_js_path; ?>"></script>
<script>
    $(document).ready(function()
    {
        single_signon("<?php echo $SITE_ID ?>", "<?php echo $random_key; ?>", "<?php echo $token; ?>", "<?php echo $lang;?>");
    });
</script>
<script>
    onReady = function () {
    up.api.require("WebchatLite",{ containerID: "wcl-demo", roomId: "<?php echo $_config['userplane'];?>",  roomName: "General Discussion" })
    
    }
    up.api.addEventListener(up.api.events.READY,onReady);
</script>
<div class="input-form">
    <div class="row">
        <div id="wcl-demo" style="width:500px; height:600px;"></div>
    </div>
</div>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>