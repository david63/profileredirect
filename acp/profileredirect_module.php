<?php
/**
*
* @package Profile Redirect
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\profileredirect\acp;

class profileredirect_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container;

		$this->tpl_name		= 'profile_redirect_manage';
		$this->page_title	= $phpbb_container->get('language')->lang('PROFILE_REDIRECT');

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('david63.profileredirect.admin.controller');

		$admin_controller->display_options();
	}
}
