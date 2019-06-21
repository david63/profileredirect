# Profile Redirect extension for phpBB

Redirects a user to their UCP when they first log-in after registration.

[![Build Status](https://travis-ci.com/david63/profileredirect.svg?branch=master)](https://travis-ci.com/david63/profileredirect)
[![License](https://poser.pugx.org/david63/profileredirect/license)](https://packagist.org/packages/david63/profileredirect)
[![Latest Stable Version](https://poser.pugx.org/david63/profileredirect/v/stable)](https://packagist.org/packages/david63/profileredirect)
[![Latest Unstable Version](https://poser.pugx.org/david63/profileredirect/v/unstable)](https://packagist.org/packages/david63/profileredirect)
[![Total Downloads](https://poser.pugx.org/david63/profileredirect/downloads)](https://packagist.org/packages/david63/profileredirect)

## Minimum Requirements
* phpBB 3.2.0
* PHP 5.4

## Install
1. [Download the latest release](https://github.com/david63/profileredirect/archive/3.2.zip) and unzip it.
2. Unzip the downloaded release and copy it to the `ext` directory of your phpBB board.
3. Navigate in the ACP to `Customise -> Manage extensions`.
4. Look for `Profile redirect` under the Disabled Extensions list and click its `Enable` link.

## Usage
1. Navigate in the ACP to `Extensions -> Profile redirect -> Manage profile redirect`.
2. Apply the settings that you require.

## Uninstall
1. Navigate in the ACP to `Customise -> Manage extensions`.
2. Click the `Disable` link for `Profile redirect`.
3. To permanently uninstall, click `Delete Data`, then delete the profileredirect folder from `phpBB/ext/david63/`.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)

© 2019 - David Wood