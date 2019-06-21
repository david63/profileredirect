<?php
/**
*
* @package Profile Redirect
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\profileredirect\migrations;

use phpbb\db\migration\migration;

class version_2_1_0 extends migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('profile_refresh', '0')),
			array('config.add', array('profile_redirect_id', '')),

			// Add the ACP module
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'PROFILE_REDIRECT')),

			array('module.add', array(
				'acp', 'PROFILE_REDIRECT', array(
					'module_basename'	=> '\david63\profileredirect\acp\profileredirect_module',
					'modes'				=> array('manage'),
				),
			)),
		);
	}
}
