<?php
/**
*
* @package Profile Redirect
* @copyright (c) 2016 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\profileredirect\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use phpbb\config\config;
use phpbb\user;
use phpbb\language\language;
use david63\profileredirect\core\functions;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string PHP extension */
	protected $phpEx;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \david63\profileredirect\core\functions */
	protected $functions;

	/**
	* Constructor
	*
	* @param \phpbb\config\config 						$config		Config object
	* @param \phpbb\user 								$user		Use object
	* @param string 									$root_path	phpBB rooy path
	* @param string 									$php_ext	phpBB&nbsp;file extension
	* @param \phpbb\language\language					$language	Language object
	* @param \david63\profileredirect\core\functions	$functions	Functions for the extension
	*
	* @access public
	*/
	public function __construct(config $config, user $user, $root_path, $php_ext, language $language, functions $functions)
	{
		$this->config		= $config;
		$this->user			= $user;
		$this->root_path	= $root_path;
		$this->phpEx		= $php_ext;
		$this->language		= $language;
		$this->functions	= $functions;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'			=> 'load_language_on_setup',
			'core.login_box_redirect'	=> array(
				'profile_redirect',
				10, // Needed to allow this extension to run before login redirect.
			),
		);
	}

	/**
	* Load common login redirect language files during user setup
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_language_on_setup($event)
	{
		$lang_set_ext	= $event['lang_set_ext'];
		$lang_set_ext[]	= array(
			'ext_name' => $this->functions->get_ext_namespace(),
			'lang_set' => 'profileredirect_common',
		);

		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Redirect the user after successful login
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function profile_redirect($event)
	{
		// No point going any further if the user is banned, but we have to allow founders to login
		if (defined('IN_CHECK_BAN') && $this->user->data['user_type'] != USER_FOUNDER)
		{
			return;
		}

		$redirect = $event['redirect'];

		// Redirect new member on first log in
		if ($this->user->data['user_lastvisit'] == 0)
		{
			switch ($this->config['profile_redirect_id'])
			{
				case 0: // Profile
					$profile_option	= 'ucp_profile&mode=profile_info';
					$message		= $this->language->lang('PROFILE_OPTION_PROFILE');
					$l_redirect		= $this->language->lang('PROFILE_REDIRECT_PROFILE');
				break;

				case 1: // Signature
					$profile_option	= 'ucp_profile&mode=signature';
					$message		= $this->language->lang('PROFILE_OPTION_SIGNATURE');
					$l_redirect		= $this->language->lang('PROFILE_REDIRECT_SIGNATURE');
				break;

				case 2: // Avatar
					$profile_option	= 'ucp_profile&mode=avatar';
					$message		= $this->language->lang('PROFILE_OPTION_AVATAR');
					$l_redirect		= $this->language->lang('PROFILE_REDIRECT_AVATAR');
				break;

				case 3: // Preferences
					$profile_option	= 'ucp_prefs&mode=personal';
					$message		= $this->language->lang('PROFILE_OPTION_PREFS');
					$l_redirect		= $this->language->lang('PROFILE_REDIRECT_PREFS');
				break;

				case 4: // Notifications
					$profile_option	= 'ucp_notifications&mode=notification_options';
					$message		= $this->language->lang('PROFILE_OPTION_NOTIFICATION');
					$l_redirect		= $this->language->lang('PROFILE_REDIRECT_NOTIFICATION');
				break;
			}

			// append/replace SID (may change during the session for AOL users)
			$redirect = reapply_sid("{$this->root_path}ucp.$this->phpEx?i=" . $profile_option);

			if ($this->config['profile_refresh'])
			{
				// This is legacy code but is required if the user is to be informed of the redirection
				$redirect = meta_refresh(2, $redirect);
				trigger_error($message . '<br><br>' . sprintf($l_redirect, '<a href="' . $redirect . '">', '</a>'));
			}
			else
			{
				redirect($redirect);
			}
		}
	}
}
