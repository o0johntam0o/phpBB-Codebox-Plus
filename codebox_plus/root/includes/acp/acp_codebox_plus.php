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
if (!defined('IN_PHPBB'))
{
	exit;
}


/**
* @package acp
*/
class acp_codebox_plus
{
	var $u_action;
	
	function main($id, $mode)
	{
		global $user, $template, $config;

		$this->tpl_name = 'acp_codebox_plus';
		$this->page_title = $user->lang['CODEBOX_PLUS_TITLE_ACP'];

		$form_name = 'acp_codebox_plus';
		add_form_key($form_name);

		$submit = isset($_POST['submit']) ? true : false;

		if ($submit)
		{
			if (!check_form_key($form_name))
			{
				trigger_error('FORM_INVALID');
			}
			
			set_config('codebox_plus_enable', request_var('codebox_plus_enable', 0));
			set_config('codebox_plus_download', request_var('codebox_plus_download', 0));
			set_config('codebox_plus_login_required', request_var('codebox_plus_login_required', 0));
			set_config('codebox_plus_prevent_bots', request_var('codebox_plus_prevent_bots', 0));
			set_config('codebox_plus_captcha', request_var('codebox_plus_captcha', 0));
			set_config('codebox_plus_max_attempt', request_var('codebox_plus_max_attempt', 0));
			
			add_log('admin', 'CODEBOX_PLUS_LOG_MSG');
			trigger_error($user->lang['CODEBOX_PLUS_SAVED'] . adm_back_link($this->u_action));
		}
		
		$template->assign_vars(array(
			'U_ACTION'							=> $this->u_action,
			'S_CODEBOX_PLUS_VERSION'			=> isset($config['codebox_plus_version']) ? $config['codebox_plus_version'] : 0,
			'S_CODEBOX_PLUS_ENABLE'				=> isset($config['codebox_plus_enable']) ? $config['codebox_plus_enable'] : 0,
			'S_CODEBOX_PLUS_DOWNLOAD'			=> isset($config['codebox_plus_download']) ? $config['codebox_plus_download'] : 0,
			'S_CODEBOX_PLUS_LOGIN_REQUIRED'		=> isset($config['codebox_plus_login_required']) ? $config['codebox_plus_login_required'] : 0,
			'S_CODEBOX_PLUS_PREVENT_BOTS'		=> isset($config['codebox_plus_prevent_bots']) ? $config['codebox_plus_prevent_bots'] : 0,
			'S_CODEBOX_PLUS_CAPTCHA'			=> isset($config['codebox_plus_captcha']) ? $config['codebox_plus_captcha'] : 0,
			'S_CODEBOX_PLUS_MAX_ATTEMPT'		=> isset($config['codebox_plus_max_attempt']) ? $config['codebox_plus_max_attempt'] : 0,
		));
	}
}
?>
