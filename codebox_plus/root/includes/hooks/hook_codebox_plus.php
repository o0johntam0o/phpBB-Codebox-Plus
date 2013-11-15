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
if ( !defined('IN_PHPBB') )
{
	exit;
}

function codebox_plus_hook()
{
	global $config, $template, $phpEx, $phpbb_root_path, $user;
	
	if (isset($template->_tpldata['.'][0]['S_CODEBOX_PLUS_LOADED']))
	{
		return;
	}
	
	$codebox_plus_enabled = isset($config['codebox_plus_enable']) ? $config['codebox_plus_enable'] : 0;
	$download_enabled = isset($config['codebox_plus_download']) ? $config['codebox_plus_download'] : 0;

	if (!$codebox_plus_enabled || !$download_enabled)
	{
		return;
	}
	
	$find = preg_quote('/<a class="CodeboxPlus_Censor_123_abc_xyz_890" href="#">/i', '#');
	
	// If in viewtopic
	if (isset($template->_tpldata['postrow']))
	{
		if (isset($template->_tpldata['postrow']))
		{
			// Fetch each post
			foreach ($template->_tpldata['postrow'] as $key => $post_data)
			{
				// IN VIEW POSTS <<<<<<<<
				$message = isset($post_data['MESSAGE']) ? $post_data['MESSAGE'] : '';
				$post_id = isset($post_data['POST_ID']) ? $post_data['POST_ID'] : 0;
				$code_part = 0;
				
				while (preg_match($find, $message))
				{
					// Correct links to the downloader
					$code_part++;
					$message = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'id=' . $post_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $message, 1);
				}
				if ($code_part > 0)
				{
					// Send to template
					if (isset($template->_tpldata['postrow'][$key]['MESSAGE']))
					{
						$template->_tpldata['postrow'][$key]['MESSAGE'] = $message;
					}
				}
				
				// IN SIGNATURE (VIEW POSTS) <<<<<<<<
				$signature = isset($post_data['SIGNATURE']) ? $post_data['SIGNATURE'] : '';
				$poster_id = isset($post_data['POSTER_ID']) ? $post_data['POSTER_ID'] : 0;
				$code_part = 0;
				
				while (preg_match($find, $signature))
				{
					// Correct links to the downloader
					$code_part++;
					$signature = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'mode=sign&amp;id=' . $poster_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $signature, 1);
				}
				if ($code_part > 0)
				{
					// Send to template
					if (isset($template->_tpldata['postrow'][$key]['SIGNATURE']))
					{
						$template->_tpldata['postrow'][$key]['SIGNATURE'] = $signature;
					}
				}
			}
		}
	}
			
	// IN SIGNATURE (VIEW PROFILE) <<<<<<<<
	if (isset($template->_tpldata['.'][0]['L_VIEWING_PROFILE']))
	{
		$signature = isset($template->_tpldata['.'][0]['SIGNATURE']) ? $template->_tpldata['.'][0]['SIGNATURE'] : '';
		$user_id = request_var('u', 0);
		$code_part = 0;
		
		while (preg_match($find, $signature))
		{
			// Correct links to the downloader
			$code_part++;
			$signature = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'mode=sign&amp;id=' . $user_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $signature, 1);
		}
		if ($code_part > 0)
		{
			// Send to template
			if (isset($template->_tpldata['.'][0]['SIGNATURE']))
			{
				$template->_tpldata['.'][0]['SIGNATURE'] = $signature;
			}
		}
	}
	
	// IN PM (VIEW MESSAGE) <<<<<<<<
	if (isset($template->_tpldata['.'][0]))
	{
		// IN MAIN MESSAGE <<<<<<<<
		$message = isset($template->_tpldata['.'][0]['MESSAGE']) ? $template->_tpldata['.'][0]['MESSAGE'] : '';
		$msg_id = isset($template->_tpldata['.'][0]['MSG_ID']) ? $template->_tpldata['.'][0]['MSG_ID'] : 0;
		$code_part = 0;
		
		while (preg_match($find, $message))
		{
			// Correct links to the downloader
			$code_part++;
			$message = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'mode=pm&amp;id=' . $msg_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $message, 1);
		}
		if ($code_part > 0)
		{
			// Send to template
			if (isset($template->_tpldata['.'][0]['MESSAGE']))
			{
				$template->_tpldata['.'][0]['MESSAGE'] = $message;
			}
		}
		
		// IN SIGNATURE (VIEW MESSAGE) <<<<<<<<
		/* Remove this line if you want to make it available for download
		$code_part = 0;
		$user_id = 0;
		$tmp = 0;
		
		if (isset($template->_tpldata['.'][0]['U_MESSAGE_AUTHOR']))
		{
			$tmp = substr(stristr($template->_tpldata['.'][0]['U_MESSAGE_AUTHOR'], 'memberlist.php?mode=viewprofile&amp;u='), 38);
			$tmp2 = stristr($tmp, '&amp;');
			if ($tmp2 != false)
			{
				$tmp2 = -strlen($tmp2);
				$tmp = substr($tmp, 0, $tmp2);
			}
		}
		
		$user_id = $tmp;

		$signature = isset($template->_tpldata['.'][0]['SIGNATURE']) ? $template->_tpldata['.'][0]['SIGNATURE'] : '';
		
		while (preg_match($find, $signature))
		{
			// Correct links to the downloader
			$code_part++;
			$signature = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'mode=sign&amp;id=' . $user_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $signature, 1);
		}
		if ($code_part > 0)
		{
			// Send to template
			if (isset($template->_tpldata['.'][0]['SIGNATURE']))
			{
				$template->_tpldata['.'][0]['SIGNATURE'] = $signature;
			}
		}
		Remove this line if you want to make it available for download */
	}
	
	// IN POSTING (HISTORY) <<<<<<<<
	if (isset($template->_tpldata['topic_review_row']))
	{
		foreach ($template->_tpldata['topic_review_row'] as $h_key => $h_data)
		{
			$message = isset($h_data['MESSAGE']) ? $h_data['MESSAGE'] : '';
			$post_id = isset($h_data['POST_ID']) ? $h_data['POST_ID'] : 0;
			$code_part = 0;
			
			while (preg_match($find, $message))
			{
				// Correct links to the downloader
				$code_part++;
				$message = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'mode=pm&amp;id=' . $post_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $message, 1);
			}
			if ($code_part > 0)
			{
				// Send to template
				if (isset($template->_tpldata['topic_review_row'][$h_key]['MESSAGE']))
				{
					$template->_tpldata['topic_review_row'][$h_key]['MESSAGE'] = $message;
				}
			}
		}
	}
	
	// IN PM (HISTORY) <<<<<<<<
	if (isset($template->_tpldata['history_row']))
	{
		foreach ($template->_tpldata['history_row'] as $h_key => $h_data)
		{
			$message = isset($h_data['MESSAGE']) ? $h_data['MESSAGE'] : '';
			$msg_id = isset($h_data['MSG_ID']) ? $h_data['MSG_ID'] : 0;
			$code_part = 0;
			
			while (preg_match($find, $message))
			{
				// Correct links to the downloader
				$code_part++;
				$message = preg_replace($find, '<a href="' . append_sid("{$phpbb_root_path}code_downloader.$phpEx", 'mode=pm&amp;id=' . $msg_id . '&amp;part=' . $code_part) . '" onclick="window.open(this.href); return false;">', $message, 1);
			}
			if ($code_part > 0)
			{
				// Send to template
				if (isset($template->_tpldata['history_row'][$h_key]['MESSAGE']))
				{
					$template->_tpldata['history_row'][$h_key]['MESSAGE'] = $message;
				}
			}
		}
	}
	
	$template->assign_vars(array(
		'S_CODEBOX_PLUS_LOADED'			=> true,
	));
}

$phpbb_hook->register(array('template','display'), 'codebox_plus_hook');

?>
