<?php
/**
*
* @package Codebox Plus
* @version 1.1.1 of 22.03.2013
* @copyright (c) 2012 o0johntam0o - o0johntam0o@gmail.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'CODEBOX_PLUS_TITLE_ACP';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'codebox_plus_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
*/
$language_file = 'mods/info_acp_codebox_plus';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'1.1.1'	=> array(
		// Nothing changed in this version
	),
	
	'1.1.0'	=> array(
		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'CODEBOX_PLUS_TITLE_ACP'),

			array('acp', 'CODEBOX_PLUS_TITLE_ACP', array(
					'module_basename'		=> 'codebox_plus',
				),
			),
		),
		// Add config value
		'config_add' => array(
			array('codebox_plus_enable', 1),
			array('codebox_plus_download', 1),
			array('codebox_plus_login_required', 0),
			array('codebox_plus_prevent_bots', 1),
			array('codebox_plus_captcha', 1),
			array('codebox_plus_max_attempt', 3),
		),
		// Purge the cache
		'cache_purge' => array(),
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);


?>