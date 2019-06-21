<?php
/**
*
* @package User Login Redirect
* @copyright (c) 2014 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\profileredirect\acp;

class profileredirect_info
{
	function module()
	{
		return array(
			'filename'	=> '\david63\profileredirect\acp\profileredirect_module',
			'title'		=> 'REDIRECT_MANAGE',
			'modes'		=> array(
				'manage'	=> array('title' => 'PROFILE_REDIRECT_MANAGE', 'auth' => 'ext_david63/profileredirect && acl_a_board', 'cat' => array('PROFILE_REDIRECT')),
			),
		);
	}
}
