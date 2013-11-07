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
	'CODEBOX_PLUS_ERROR_GENERAL'				=> 'Lỗi tổng quát',
	'CODEBOX_PLUS_ERROR_POST_NOT_FOUND'			=> 'Không tìm thấy bài viết',
	'CODEBOX_PLUS_ERROR_FILE_EMPTY'				=> 'Đây là một tập tin rỗng',
	'CODEBOX_PLUS_ERROR_CODE_NOT_FOUND'			=> 'Không tìm thấy nội dung cú pháp',
	'CODEBOX_PLUS_ERROR_LOGIN_REQUIRED'			=> 'Vui lòng đăng nhập để tải tập tin này',
	'CODEBOX_PLUS_ERROR_CONFIRM'				=> 'Bạn đã gửi yêu cầu vượt quá số lần quy định trong phiên truy cập này. Vui lòng thử lại sau.',
	'CODEBOX_PLUS_ERROR_CODEBOX_PLUS_DISABLED'	=> 'Tùy chỉnh Codebox Plus đã được ngưng kích hoạt bởi người quản trị',
	'CODEBOX_PLUS_ERROR_DOWNLOAD_DISABLED'		=> 'Tính năng tải về đã được ngưng kích hoạt bởi người quản trị',
	'CODEBOX_PLUS_CONFIRM'						=> 'Vui lòng nhập mã xác nhận để tải tập tin này',
	'CODEBOX_PLUS_DOWNLOAD'						=> 'Tải về',
	'CODEBOX_PLUS_EXPAND'						=> 'Mở rộng',
	'CODEBOX_PLUS_COLLAPSE'						=> 'Thu hẹp',
));

?>
