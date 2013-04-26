# sql file for Userplane module

CREATE TABLE  `userplane_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `site_id` VARCHAR( 255 ) NOT NULL ,
  `api_key` VARCHAR( 255 ) NOT NULL
);

INSERT INTO `language_text` VALUES ('en', '_module','userplane','UserPlane',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','up_group_chat','UserPlane Group Chat',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','up_old','Old Version',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','userplane_site_id','UserPlane Site ID',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','userplane_api_key','UserPlane API Key',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','userplane_id','UserPlane Community ID',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','userplane_text','Your Userplane configuration is displayed in the box below. ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','userplane_missing_id','Follow the instructions in the Readme file. ',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','userplane_howto','Use Userplane Web Chat to communicate with other ATutor users using voice and video. <strong>Requires Javascript and Flash</strong>. Enter a screen name then press Login, or choose Sign Up to create a user profile.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SITE_ID_SAVED','UserPlane Site ID was successfully saved.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_API_KEY_SAVED','UserPlane API Key was successfully saved.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_USERPLANE_ID_SAVED','UserPlane ID was successfully saved.',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_ERROR_USERPLANE_ID_ADD_EMPTY','One or more fields are empty.',NOW(),'');

