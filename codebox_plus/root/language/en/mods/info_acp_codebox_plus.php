<?php
/**
*
* @package Codebox Plus
* @version 1.1.1 of 22.03.2013
* @copyright (c) 2012 o0johntam0o - o0johntam0o@gmail.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
// Force text encoding to UTF-8 without BOM: Huỳnh Bửu Tâm

$lang = array_merge($lang, array(
	'CODEBOX_PLUS_TITLE_ACP'				=> 'Codebox Plus',
	'CODEBOX_PLUS_TITLE'					=> 'Codebox Plus Settings',
	
	'CODEBOX_PLUS_ENABLE'					=> 'Enable Codebox Plus',
	'CODEBOX_PLUS_ENABLE_EXPLAIN'			=> 'Do you want to use this mod now?',
	'CODEBOX_PLUS_DOWNLOAD'					=> 'Enable download feature',
	'CODEBOX_PLUS_DOWNLOAD_EXPLAIN'			=> '',
	'CODEBOX_PLUS_LOGIN_REQUIRED'			=> 'Requires login to download',
	'CODEBOX_PLUS_LOGIN_REQUIRED_EXPLAIN'	=> '',
	'CODEBOX_PLUS_PREVENT_BOTS'				=> 'Prevent Bots',
	'CODEBOX_PLUS_PREVENT_BOTS_EXPLAIN'		=> 'Prevent Bots from downloading code.',
	'CODEBOX_PLUS_CAPTCHA'					=> 'Enable CAPTCHA function',
	'CODEBOX_PLUS_CAPTCHA_EXPLAIN'			=> 'To block automated form submissions by spambots ("Spambot countermeasures" must be enabled first)',
	'CODEBOX_PLUS_MAX_ATTEMPT'				=> 'Max attempt',
	'CODEBOX_PLUS_MAX_ATTEMPT_EXPLAIN'		=> 'Number of attempts users can make at solving the anti-spambot task before being locked out of that session',
	
	'CODEBOX_PLUS_SAVED'					=> 'Codebox Plus settings updated',
	'CODEBOX_PLUS_LOG_MSG'					=> '<strong>Altered Codebox Plus settings</strong>',
));

?>
