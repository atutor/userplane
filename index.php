<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/userplane/module.css'; // use a custom stylesheet
require (AT_INCLUDE_PATH.'header.inc.php');
require ('config.php');
require ('functions.php');

$functions_js_path = $_base_path. 'mods/userplane/functions.js';

include ('userplane_header.php');

$friends = getFriends($_SESSION['member_id']);

$course_sql = "SELECT * FROM %scourses WHERE course_id = %d";
$course_sqlParams = array(TABLE_PREFIX, $_SESSION['course_id']);
$course_result = queryDB($course_sql, $course_sqlParams, true);

$room_id = $course_result['course_id'].'_'.str_replace(' ', '_', $course_result['title']);
$room_name = $course_result['title']." Room";
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
    up.api.require("WebchatLite",{ containerID: "wcl-demo", roomId: "<?php echo $room_id;?>",  roomName: "<?php echo $room_name;?>" })
    
    }
    
  budylist = function() {
    var buddyListArray = [
        <?php
        foreach($friends as $f)
        { 
          $sql='SELECT * FROM %smembers WHERE member_id=%d';
          $sql_Params = array(TABLE_PREFIX, $f);
          $friend = queryDB($sql, $sql_Params, true);
        ?>
              {displayName:"<?php echo $friend['first_name'];?>", userId:"<?php echo $friend['login']; ?>"},
        <?php     
        }
        ?>
                            
                         ];
    up.api.buddyList.setBuddyList( buddyListArray );

    }
    up.addCallback( up.api.events.READY, budylist );
  
    up.api.addEventListener(up.api.events.READY,onReady);
    up.api.addEventListener(up.api.events.READY,function() {
       up.api.require("PresenceBar",{
          minimizeLocation:"left"
    });
  });
</script>

<div class="input-form">
    <div class="row">
        <div id="wcl-demo" style="width:500px; height:600px;"></div>
    </div>
</div>

<?php require (AT_INCLUDE_PATH.'footer.inc.php'); ?>