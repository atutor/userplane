<?php
/*******
 * doesn't allow this file to be loaded with a browser.
 */
if (!defined('AT_INCLUDE_PATH')) { exit; }

/******
 * this file must only be included within a Module obj
 */
if (!isset($this) || (isset($this) && (strtolower(get_class($this)) != 'module'))) { exit(__FILE__ . ' is not a Module'); }

/*******
 * assign the instructor and admin privileges to the constants.
 */
define('AT_PRIV_USERPLANE',       $this->getPrivilege());
define('AT_ADMIN_PRIV_USERPLANE', $this->getAdminPrivilege());

/*******
 * create a side menu box/stack.
 */
$this->_stacks['userplane'] = array('title_var'=>'userplane', 'file'=>AT_INCLUDE_PATH.'../mods/userplane/side_menu.inc.php');

/*******
 * if this module is to be made available to students on the Home or Main Navigation.
 */
$_student_tool = 'mods/userplane/index.php';

/*******
 * add the admin pages when needed.
 */

if (admin_authenticate(AT_ADMIN_PRIV_USERPLANE, TRUE) || admin_authenticate(AT_ADMIN_PRIV_ADMIN, TRUE)) {
	$this->_pages[AT_NAV_ADMIN] = array('mods/userplane/index_admin.php');
	$this->_pages['mods/userplane/index_admin.php']['title_var'] = 'userplane';
	$this->_pages['mods/userplane/index_admin.php']['parent']    = AT_NAV_ADMIN;
}

/*******
 * instructor Manage section:
 */
$this->_pages['mods/userplane/index_instructor.php']['title_var'] = 'userplane';
$this->_pages['mods/userplane/index_instructor.php']['parent']   = 'tools/index.php';

/*******
 * student page.
 */
$this->_pages['mods/userplane/index.php']['title_var'] = 'userplane';
$this->_pages['mods/userplane/index.php']['img']       = 'mods/userplane/userplane.jpg';
$this->_pages['mods/userplane/index.php']['children'] = array('mods/userplane/old_course.php','mods/userplane/group_chat.php');

$this->_pages['mods/userplane/old_course.php']['title_var'] = 'up_old';
$this->_pages['mods/userplane/old_course.php']['parent'] = 'mods/userplane/index.php';

$this->_pages['mods/userplane/group_chat.php']['title_var'] = 'up_group_chat';
$this->_pages['mods/userplane/group_chat.php']['parent'] = 'mods/userplane/index.php';


/* my start page pages */
$this->_pages[AT_NAV_START]  = array('mods/userplane/index_mystart.php');
$this->_pages['mods/userplane/index_mystart.php']['title_var'] = 'userplane';
$this->_pages['mods/userplane/index_mystart.php']['parent'] = AT_NAV_START;

$this->_pages['mods/userplane/index_mystart.php']['children'] = array('mods/userplane/old.php');
$this->_pages['mods/userplane/old.php']['title_var'] = 'up_old';
$this->_pages['mods/userplane/old.php']['parent'] = 'mods/userplane/index_mystart.php';


?>