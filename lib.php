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
 * Lib file for callbacks.
 *
 * @package   local_brightcove
 * @author    Dmitrii Metelkin (dmitriim@catalyst-au.net)
 * @copyright Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Implements call back before_standard_html_head.
 *
 * @see https://docs.moodle.org/dev/Output_callbacks#before_http_headers
 *
 * @return string
 */
function local_brightcove_before_standard_html_head() {
    return local_brightcove_get_polymer_data_for_head();
}

/**
 * Return polymer data for the page head.
 *
 * @return string
 */
function local_brightcove_get_polymer_data_for_head() {
    $polymerlocation = "/local/brightcove/extlibs/polymer";

    $data = '<script src="' . $polymerlocation . '/bower_components/webcomponentsjs/webcomponents-lite.js"></script>';
    $data .= '<link rel="import" href="' . $polymerlocation . '/bower_components/polymer/polymer.html">';
    $data .= '<link rel="import" href="' . $polymerlocation . '/brightcove-video.html">';

    return $data;
}
