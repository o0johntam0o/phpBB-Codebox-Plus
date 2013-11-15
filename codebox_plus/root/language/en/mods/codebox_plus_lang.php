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
	'CODEBOX_PLUS_ERROR_GENERAL'				=> 'General error',
	'CODEBOX_PLUS_ERROR_POST_NOT_FOUND'			=> 'Post not found',
	'CODEBOX_PLUS_ERROR_FILE_EMPTY'				=> 'This is a empty file',
	'CODEBOX_PLUS_ERROR_CODE_NOT_FOUND'			=> 'Code contents not found',
	'CODEBOX_PLUS_ERROR_LOGIN_REQUIRED'			=> 'Please login to download this file',
	'CODEBOX_PLUS_ERROR_CONFIRM'				=> 'You have exceeded the maximum number of submittion attempts for this session. Please try again later.',
	'CODEBOX_PLUS_ERROR_CODEBOX_PLUS_DISABLED'	=> 'Codebox Plus MOD was disabled by the administrator',
	'CODEBOX_PLUS_ERROR_DOWNLOAD_DISABLED'		=> 'Download function was disabled by the administrator',
	'CODEBOX_PLUS_CONFIRM'						=> 'Please enter the confirmation code to download this file',
	'CODEBOX_PLUS_DOWNLOAD'						=> 'Download',
	'CODEBOX_PLUS_EXPAND'						=> 'Expand',
	'CODEBOX_PLUS_COLLAPSE'						=> 'Collapse',
));

?>
