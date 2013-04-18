<?php
/*
This is the ATutor Userplane module page. It allows an admin user
to set or edit  the Userplane  for ATutor, and
it includes the launcher, which opens Userplane in a new window

*/
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
$_custom_css = $_base_path . 'mods/userplane/module.css'; // use a custom stylesheet

if (isset($_POST['submit'])) {
	$_POST['uri'] = trim($_POST['uri']);

	if (!$_POST['uri'] || !$_POST['site_id'] || !$_POST['api_key']){
		$msg->addError('USERPLANE_ID_ADD_EMPTY');
	}
			
	if (!$msg->containsErrors()) {
		$_POST['uri'] = $addslashes($_POST['uri']);
		$sql = "REPLACE INTO ".TABLE_PREFIX."config VALUES ('userplane', '$_POST[uri]')";
		mysql_query($sql, $db);
                
                $sql = "SELECT * FROM ".TABLE_PREFIX."userplane_config";
                $result = mysql_query($sql);
                $row = mysql_fetch_array($result);
                if(!$row) 
                {
                    $sql = "INSERT INTO ".TABLE_PREFIX."userplane_config(site_id, api_key) VALUES('$_POST[site_id]','$_POST[api_key]')";
                    echo $sql;
                    mysql_query($sql);
                }
                else
                {
                    $sql = "REPLACE INTO ".TABLE_PREFIX."userplane_config('site_id','api_key') VALUES('$_POST[site_id]','$_POST[api_key]')";
                    mysql_query($sql);
                }
                
                $msg->addFeedback('SITE_ID_SAVED');
                $msg->addFeedback('API_KEY_SAVED');
		$msg->addFeedback('USERPLANE_ID_SAVED');
                
                
		header('Location: '.$_SERVER['PHP_SELF']);
		exit;
	}
}

require (AT_INCLUDE_PATH.'header.inc.php');

?>

<?php
$sql = "SELECT * FROM ".TABLE_PREFIX."userplane_config";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
?>

<?php if ($_config['userplane'] && $row['site_id'] && $row['api_key']): ?>
	<div class="input-form">
		<div class="row">
			<p><?php echo _AT('userplane_text'); ?></p>
		</div>
	</div>
<?php else: ?>
	<div class="input-form">
		<div class="row">
			<p><?php echo _AT('userplane_missing_id');  ?></p>
		</div>
	</div>
<?php endif; ?>


<form action="<?php  $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="input-form">
		<div class="row">
			<p><label for="site_id"><?php echo _AT('userplane_site_id'); ?></label></p>
	
			<input type="text" name="site_id" value="<?php echo $row['site_id']; ?>" id="site_id" size="60" style="min-width: 65%;" />
                        
			<p><label for="api_key"><?php echo _AT('userplane_api_key'); ?></label></p>
                        
                        <input type="text" name="api_key" value="<?php echo $row['api_key']; ?>" id="uri" size="60" style="min-width: 65%;" />
                        
                        <p><label for="uri"><?php echo _AT('userplane_id'); ?></label></p>
                        
			<input type="text" name="uri" value="<?php echo $_config['userplane']; ?>" id="uri" size="60" style="min-width: 65%;" />
		</div>
		<div class="row buttons">
			<input type="submit" name="submit" value="<?php echo _AT('save'); ?>"  />
		</div>
	</div>
</form>
<?php
if($_config['userplane'] !=''){ ?>
	<div id="userplane">
	<script language="javascript" type="text/javascript" src="http://www.userplane.com/chatlite/medallion/chatlite.cfm?DomainID=<?php  echo $_config['userplane'];?>"></script><noscript>You must have JavaScript enabled to use <a href="http://www.userplane.com" title="Userplane" target="_blank">Userplane Chat</a></noscript>
	</div>

<?php }?>
<?php  require (AT_INCLUDE_PATH.'footer.inc.php'); ?>