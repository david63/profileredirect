<?php
/**
*
* @package Profile Redirect
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'PROFILE_OPTION_PROFILE'		=> 'You have been successfully logged in. You will now be redirected to the User Control Panel where you can set your profile details.',
	'PROFILE_OPTION_SIGNATURE'		=> 'You have been successfully logged in. You will now be redirected to the User Control Panel where you can set your signature.',
	'PROFILE_OPTION_AVATAR'			=> 'You have been successfully logged in. You will now be redirected to the User Control Panel where you can set your avatar.',
	'PROFILE_OPTION_PREFS'			=> 'You have been successfully logged in. You will now be redirected to the User Control Panel where you can set your global preferences.',
	'PROFILE_OPTION_NOTIFICATION'	=> 'You have been successfully logged in.You will now be redirected to the User Control Panel where you can set your notification options.',

	'PROFILE_REDIRECT_PROFILE'		=> '%sProceed to your profile%s',
	'PROFILE_REDIRECT_SIGNATURE' 	=> '%sProceed to your signature%s',
	'PROFILE_REDIRECT_AVATAR'		=> '%sProceed to your avatar%s',
	'PROFILE_REDIRECT_PREFS'		=> '%sProceed to your preferences%s',
	'PROFILE_REDIRECT_NOTIFICATION'	=> '%sProceed to your notifications%s',
));
