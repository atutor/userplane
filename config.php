<?php

$sql = "SELECT * FROM ".TABLE_PREFIX."userplane_config";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$SITE_ID = "$row[site_id]";
$API_KEY = "$row[api_key]";
$lang = "en-US";
?>