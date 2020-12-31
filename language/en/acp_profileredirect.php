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
	'PROFILE_REDIRECT_EXPLAIN'			=> 'Here you can choose to have a new user redirected to their UCP upon their first log in after registering.',
	'PROFILE_REDIRECT_OPTIONS'			=> 'Profile redirect options',

	'REDIRECT_PROFILE_OPTIONS'			=> 'Profile option',
	'REDIRECT_PROFILE_OPTIONS_EXPLAIN'	=> 'Select the option within the UCP that you want the user to be redirected to.',
	'REDIRECT_REFRESH_MESSAGE'			=> 'Show a redirect message',
	'REDIRECT_REFRESH_MESSAGE_EXPLAIN'	=> 'Display a message to say that the user is being redirected to their UCP.',
));
