<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package   local_brightcove
 * @author    Dmitrii Metelkin (dmitriim@catalyst-au.net)
 * @copyright Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if (is_siteadmin()) {

    // Settings page page.
    $settings = new admin_settingpage('local_brightcove', get_string('pluginname', 'local_brightcove'));
    $ADMIN->add('localplugins', $settings);

    // Brightcove API and account settings.
    $settings->add(new admin_setting_configtext('local_brightcove/accountid',
            get_string('accountid', 'local_brightcove'),
            get_string('accountid_help', 'local_brightcove'),
            null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext('local_brightcove/playerid',
            get_string('playerid', 'local_brightcove'),
            get_string('playerid_help', 'local_brightcove'),
            null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext('local_brightcove/apikey',
            get_string('apikey', 'local_brightcove'),
            get_string('apikey_help', 'local_brightcove'),
            null, PARAM_TEXT));

    $settings->add(new admin_setting_configpasswordunmask('local_brightcove/apisecret',
            get_string('apisecret', 'local_brightcove'),
            get_string('apisecret_help', 'local_brightcove'),
            null));

    $settings->add(new admin_setting_configtext('local_brightcove/oauthendpoint',
            get_string('oauthendpoint', 'local_brightcove'),
            get_string('oauthendpoint_help', 'local_brightcove'),
            'https://oauth.brightcove.com/v4/', PARAM_URL));

    $settings->add(new admin_setting_configtext('local_brightcove/apiendpoint',
            get_string('apiendpoint', 'local_brightcove'),
            get_string('apiendpoint_help', 'local_brightcove'),
            'https://cms.api.brightcove.com/v1/', PARAM_URL));

    $settings->add(new admin_setting_configtext('local_brightcove/perpage',
            get_string('perpage', 'local_brightcove'),
            get_string('perpage_help', 'local_brightcove'),
            5, PARAM_INT));
}
