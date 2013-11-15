<?php
/**
*
* @package Codebox Plus
* @version 1.1.1 of 22.03.2013
* @copyright (c) 2012 o0johntam0o - o0johntam0o@gmail.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/codebox_plus_lang');

// Settings
$enable_codebox_plus = isset($config['codebox_plus_enable']) ? $config['codebox_plus_enable'] : 0;
$enable_download = isset($config['codebox_plus_download']) ? $config['codebox_plus_download'] : 0;
$enable_login_required = isset($config['codebox_plus_login_required']) ? $config['codebox_plus_login_required'] : 0;
$enable_prevent_bots = isset($config['codebox_plus_prevent_bots']) ? $config['codebox_plus_prevent_bots'] : 0;
$enable_captcha = isset($config['codebox_plus_captcha']) ? $config['codebox_plus_captcha'] : 0;
$max_attempt = isset($config['codebox_plus_max_attempt']) ? $config['codebox_plus_max_attempt'] : 0;

// If Codebox Plus was disabled
if (!$enable_codebox_plus)
{
	trigger_error($user->lang['CODEBOX_PLUS_ERROR_CODEBOX_PLUS_DISABLED']);
}
// If download function was disabled
if (!$enable_download)
{
	trigger_error($user->lang['CODEBOX_PLUS_ERROR_DOWNLOAD_DISABLED']);
}

// GET REQUEST
$id = request_var('id', 0);
$code_part = request_var('part', 0);
$mode = request_var('mode', '');

// Prevent bots
if ($enable_prevent_bots && $user->data['is_bot'])
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}
// Login to download...
if ($enable_login_required && !$user->data['is_registered'])
{
	login_box("code_downloader.$phpEx?mode=$mode&id=$id&part=$code_part", $user->lang['CODEBOX_PLUS_ERROR_LOGIN_REQUIRED']);
}
// Captcha
if ($enable_captcha && $config['enable_confirm'])
{
	// Get the captcha instance
	if (!class_exists('phpbb_captcha_factory'))
	{
		include($phpbb_root_path . 'includes/captcha/captcha_factory.' . $phpEx);
	}
	$captcha =& phpbb_captcha_factory::get_instance($config['captcha_plugin']);
	$captcha->init(CONFIRM_POST);
	$submit = request_var('submit', false);
	$ok = false;
	
	if ($submit)
	{
		// Check captcha
		$captcha->validate();
		// If captcha solved
		if ($captcha->is_solved())
		{
			// IMPORTANT: Reset the captcha
			$captcha->reset();
			// Start download
			codebox_output($mode, $id, $code_part);
			// Stop printing...
			$ok = true;
		}
	}
	
	// If the form was not submitted yet or the CAPTCHA was not solved
	if (!$ok)
	{
		// Too many request...
		if ($captcha->get_attempt_count() >= $max_attempt)
		{
			trigger_error($user->lang['CODEBOX_PLUS_ERROR_CONFIRM']);
		}
		
		$template->assign_vars(array(
			'S_CODE_DOWNLOADER_ACTION'		=> append_sid("{$phpbb_root_path}code_downloader.$phpEx", "id=$id&amp;part=$code_part" . ($mode == '' ? '' : "&amp;mode=$mode")),
			'S_CONFIRM_CODE'                => true,
			'CAPTCHA_TEMPLATE'              => $captcha->get_template(),
		));
		
		page_header($user->lang['CODEBOX_PLUS_DOWNLOAD']);

		$template->set_filenames(array(
			'body' => 'mods/code_downloader.html'
		));

		page_footer();
	}
	else
	{
		garbage_collection();
		exit_handler();
	}
}
else
{
	codebox_output($mode, $id, $code_part);
	garbage_collection();
	exit_handler();
}

function codebox_output($mode, $id, $code_part)
{
	global $user, $db;
	
	$id = (int) $id;
	$code_part = (int) $code_part;
	$code = '';
	$filename = $user->lang['CODEBOX_PLUS_DEFAULT_FILENAME'];
	$post_data = array();
	$code_data = array();

	// CHECK REQUEST
	if ($id <= 0 || $code_part <= 0)
	{
		trigger_error($user->lang['CODEBOX_PLUS_ERROR_GENERAL']);
	}

	// PROCESS REQUEST
	//- Get post data
	switch ($mode)
	{
		case 'pm':
			$table = PRIVMSGS_TABLE;
			$col_msg_id = 'msg_id';
			$col_msg_text = 'message_text';
			$col_bbcode_uid = 'bbcode_uid';
		break;
		
		case 'sign':
			$table = USERS_TABLE;
			$col_msg_id = 'user_id';
			$col_msg_text = 'user_sig';
			$col_bbcode_uid = 'user_sig_bbcode_uid';
		break;
		
		default:
			$table = POSTS_TABLE;
			$col_msg_id = 'post_id';
			$col_msg_text = 'post_text';
			$col_bbcode_uid = 'bbcode_uid';
		break;
	}

	$sql = "SELECT $col_msg_text, $col_bbcode_uid FROM $table WHERE $col_msg_id = $id";
	$result = $db->sql_query($sql);
	$post_data = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($post_data === false)
	{
		trigger_error($user->lang['CODEBOX_PLUS_ERROR_POST_NOT_FOUND']);
	}

	//- Process post data
	// Collect code
	preg_match_all("#\[code(?:=[a-z0-9_-]+)?(?: file=(.*?))?:" . $post_data[$col_bbcode_uid] . "\](.*?)\[/code:" . $post_data[$col_bbcode_uid] . "\]#msi", $post_data[$col_msg_text], $code_data);
	if (count($code_data[2]) >= $code_part)
	{
		$code_part--;
		$code = $code_data[2][$code_part];
		if ($code != '')
		{
			$str_from = array('&lt;', '&gt;', '&#91;', '&#93;', '&#46;', '&#58;', '&#058;', '&#39;', '&#039;', '&quot;', '&amp;');
			$str_to = array('<', '>', '[', ']', '.', ':', ':', "'", "'", '"', '&');
			$code = str_replace($str_from, $str_to, $code);
			if ($code_data[1][$code_part] != '')
			{
				$filename = $code_data[1][$code_part];
			}
		}
		else
		{
			trigger_error($user->lang['CODEBOX_PLUS_ERROR_FILE_EMPTY']);
		}
	}
	else
	{
		trigger_error($user->lang['CODEBOX_PLUS_ERROR_CODE_NOT_FOUND']);
	}

	// RESPOND
	header('Content-Type: application/force-download');
	header('Content-Length: ' . strlen($code));
	header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');

	echo $code;
}
?>
