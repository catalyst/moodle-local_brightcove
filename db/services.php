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
 * Brightcove web service external functions and service definitions.
 *
 * @package   local_brightcove
 * @author    Dmitrii Metelkin (dmitriim@catalyst-au.net)
 * @copyright Catalyst IT
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// We defined the web service functions to install.
$functions = array(
    'local_brightcove_video_list' => array(
        'classname'   => 'local_brightcove_external',
        'methodname'  => 'video_list',
        'classpath'   => 'local/brightcove/externallib.php',
        'description' => 'Returns available videos via the Brightcove API',
        'type'        => 'read',
        'ajax'        => true
    ),
    'local_brightcove_video' => array(
        'classname'   => 'local_brightcove_external',
        'methodname'  => 'video',
        'classpath'   => 'local/brightcove/externallib.php',
        'description' => 'Returns video via the Brightcove API',
        'type'        => 'read',
        'ajax'        => true
    ),
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
    'Brightcove video service' => array(
        'functions' => array('local_brightcove_video_list', 'local_brightcove_video'),
        'restrictedusers' => 0,
        'enabled' => 1,
    ),
);
