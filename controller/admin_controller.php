<?php
/**
*
* @package Profile Redirect
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\profileredirect\controller;

use phpbb\config\config;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use phpbb\log\log;
use phpbb\language\language;
use david63\profileredirect\core\functions;

/**
* Admin controller
*/
class admin_controller implements admin_interface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \david63\profileredirect\core\functions */
	protected $functions;

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor for admin controller
	*
	* @param \phpbb\config\config						$config		Config object
	* @param \phpbb\request\request						$request	Request object
	* @param \phpbb\template\template					$template	Template object
	* @param \phpbb\user								$user		User object
	* @param \phpbb\log\log								$log		Log object
	* @param \phpbb\language\language					$language	Language object
	* @param \david63\profileredirect\core\functions	$functions	Functions for the extension
	*
	* @return \david63\profileredirect\controller\admin_controller
	* @access public
	*/
	public function __construct(config $config, request $request, template $template, user $user, log $log, language $language, functions $functions)
	{
		$this->config		= $config;
		$this->request		= $request;
		$this->template		= $template;
		$this->user			= $user;
		$this->log			= $log;
		$this->language		= $language;
		$this->functions	= $functions;
	}

	/**
	* Display the options a user can configure for this extension
	*
	* @return null
	* @access public
	*/
	public function display_options()
	{
		// Add the language files
		$this->language->add_lang(array('acp_profileredirect', 'ucp', 'acp_common'), $this->functions->get_ext_namespace());

		// Create a form key for preventing CSRF attacks
		$form_key = 'login_redirect';
		add_form_key($form_key);

		$back = false;

		// Is the form being submitted
		if ($this->request->is_set_post('submit'))
		{
			// Is the submitted form is valid
			if (!check_form_key($form_key))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			// If no errors, process the form data
			// Set the options the user configured
			$this->set_options();

			// Add option settings change action to the admin log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_PROFILE_REDIRECT');

			// Option settings have been updated and logged
			// Confirm this to the user and provide link back to previous page
			trigger_error($this->language->lang('CONFIG_UPDATED') . adm_back_link($this->u_action));
		}

		// Create the select options
		$profile_opts_array = array(
			$this->language->lang('UCP_PROFILE_PROFILE_INFO'),
			$this->language->lang('UCP_PROFILE_SIGNATURE'),
			$this->language->lang('UCP_PROFILE_AVATAR'),
			$this->language->lang('UCP_PREFS_PERSONAL'),
			$this->language->lang('UCP_NOTIFICATION_OPTIONS'),
		);

		$profile_options = '';
		foreach ($profile_opts_array as $key => $profile_opt)
		{
			$selected = ($this->config['profile_redirect_id'] == $key) ? ' selected="selected"' : '';
			$profile_options .= '<option value="' . $key . '"' . $selected . '>' . $profile_opt . '</option>';
		}

		$profile_opts = '<select name="profile_redirect_id" id="profile_redirect_id">' . $profile_options . '</select>';

		// Template vars for header panel
		$version_data	= $this->functions->version_check();

		$this->template->assign_vars(array(
			'DOWNLOAD'			=> (array_key_exists('download', $version_data)) ? '<a class="download" href =' . $version_data['download'] . '>' . $this->language->lang('NEW_VERSION_LINK') . '</a>' : '',

			'HEAD_TITLE'		=> $this->language->lang('PROFILE_REDIRECT'),
			'HEAD_DESCRIPTION'	=> $this->language->lang('PROFILE_REDIRECT_EXPLAIN'),

			'NAMESPACE'			=> $this->functions->get_ext_namespace('twig'),

			'S_BACK'			=> $back,
			'S_VERSION_CHECK'	=> (array_key_exists('current', $version_data)) ? $version_data['current'] : false,

			'VERSION_NUMBER'	=> $this->functions->get_meta('version'),
		));

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'PROFILE_OPTIONS'			=> $profile_opts,
			'PROFILE_REFRESH'			=> isset($this->config['profile_refresh']) ? $this->config['profile_refresh'] : '',

			'U_ACTION' => $this->u_action,
		));
	}

	/**
	* Set the options a user can configure
	*
	* @return null
	* @access protected
	*/
	protected function set_options()
	{
		$this->config->set('profile_redirect_id', $this->request->variable('profile_redirect_id', 0));
		$this->config->set('profile_refresh', $this->request->variable('profile_refresh', 0));
	}
}
