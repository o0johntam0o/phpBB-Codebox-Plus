<?php
/**
*
* @package Codebox Plus
* @version 1.1.2 of 05.11.2013
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
* @package module_install
*/
class acp_codebox_plus_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_codebox_plus',
			'title'		=> 'CODEBOX_PLUS_TITLE_ACP',
			'version'	=> '1.1.2',
			'modes'		=> array(
				'index'	=> array(
					'title'			=> 'CODEBOX_PLUS_TITLE',
					'auth'			=> 'acl_a_board',
					'cat'			=> array('CODEBOX_PLUS_TITLE'),
				),
			),
		);
	}
}

?>