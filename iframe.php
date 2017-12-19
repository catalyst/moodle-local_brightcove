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
 * Prints video player.
 *
 * @package   local_brightcove
 * @author    Dmitrii Metelkin (dmitriim@catalyst-au.net)
 * @copyright Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true);

require(__DIR__.'/../../config.php');

$id = required_param('id', PARAM_INT);

$config = get_config('local_brightcove');

$pluginconfigured = true;

if ($config->accountid == ''
        || $config->playerid == ''
        || $config->apikey == ''
        || $config->apisecret == ''
        || $config->oauthendpoint == ''
        || $config->apiendpoint == '') {
            $pluginconfigured = false;
}

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/brightcove/iframe.php', array('id' => $id));
$PAGE->set_title(format_string('Iframe'));
$PAGE->set_heading(format_string('Iframe'));
$PAGE->set_pagelayout('embedded');
$PAGE->set_focuscontrol(false);

$brightcoveurl = '//players.brightcove.net/';
$brightcoveurl .= $config->accountid;
$brightcoveurl .= '/';
$brightcoveurl .= $config->playerid;
$brightcoveurl .= '_default/index';

$player = new stdClass();
$player->accountid = $config->accountid;
$player->playerid = $config->playerid;
$player->videoid = $id;

$PAGE->requires->js_amd_inline("requirejs.config({paths:{'bc':['{$brightcoveurl}']}});");
$PAGE->requires->js_call_amd('local_brightcove/brightcove', 'init', array($config->playerid));

$output = $PAGE->get_renderer('local_brightcove');

echo $output->header();
echo $output->render_from_template('local_brightcove/player', $player);
echo $output->footer();
