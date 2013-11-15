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
	'CODEBOX_PLUS_TITLE'					=> 'Cài đặt tổng quát',
	
	'CODEBOX_PLUS_ENABLE'					=> 'Kích hoạt Codebox Plus',
	'CODEBOX_PLUS_ENABLE_EXPLAIN'			=> 'Bạn có muốn sử dụng tùy chỉnh này ngay bây giờ?',
	'CODEBOX_PLUS_DOWNLOAD'					=> 'Kích hoạt chức năng tải về',
	'CODEBOX_PLUS_DOWNLOAD_EXPLAIN'			=> '',
	'CODEBOX_PLUS_LOGIN_REQUIRED'			=> 'Yêu cầu đăng nhập để tải về',
	'CODEBOX_PLUS_LOGIN_REQUIRED_EXPLAIN'	=> '',
	'CODEBOX_PLUS_PREVENT_BOTS'				=> 'Chặn các máy tìm kiếm',
	'CODEBOX_PLUS_PREVENT_BOTS_EXPLAIN'		=> 'Chặn các máy tìm kiếm tải về các đoạn mã',
	'CODEBOX_PLUS_CAPTCHA'					=> 'Kích hoạt chức năng CAPTCHA',
	'CODEBOX_PLUS_CAPTCHA_EXPLAIN'			=> 'Nhầm chặn các máy SpamBots tự động tải về các tập tin ("Thiết lập mã xác nhận" cần được kích hoạt trước)',
	'CODEBOX_PLUS_MAX_ATTEMPT'				=> 'Số lần nhập sai CAPTCHA tối đa',
	'CODEBOX_PLUS_MAX_ATTEMPT_EXPLAIN'		=> 'Nếu vượt quá giới hạn này, chức năng tải về sẽ tạm khóa trong phiên truy cập đó.',
	
	'CODEBOX_PLUS_SAVED'					=> 'Đã cập nhật các tùy chỉnh cho Codebox Plus',
	'CODEBOX_PLUS_LOG_MSG'					=> '<strong>Thay đổi cài đặt Codebox Plus</strong>',
));

?>
