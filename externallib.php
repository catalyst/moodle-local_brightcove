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
 * Web Services.
 *
 * @package    local_brightcove
 * @copyright  2017 Matt Porritt <mattp@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use \local_brightcove\brightcove_api;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/externallib.php");

class local_brightcove_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function video_list_parameters() {
        return new external_function_parameters(
                array(
                        'q' => new external_value(PARAM_TEXT, 'The search query', VALUE_DEFAULT, '*'),
                        'page' => new external_value(PARAM_INT,
                                'Page number of results to return', VALUE_DEFAULT, 1),
                )
            );
    }

    /**
     * Returns available videos
     *
     */
    public static function video_list($q, $page) {
        global $USER;

        // Parameter validation.
        // This feels dumb and the docs are vague, buy it is required.
        $params = self::validate_parameters(self::video_list_parameters(), array('q' => $q, 'page' => $page));

        // Context validation.
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        // TODO: Capability checking.

        // Execute API call.
        $brightcove = new brightcove_api();
        $results = $brightcove->get_video_list($q, $page);

        return $results;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function video_list_returns() {
        return new external_single_structure(
            array(
                'videos' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'id' => new external_value(PARAM_TEXT, 'Brightcove video ID'),
                            'name' => new external_value(PARAM_TEXT, 'Video title'),
                            'complete' => new external_value(PARAM_TEXT, 'whether processing is complete'),
                            'created_at' => new external_value(PARAM_TEXT, 'when the video was created'),
                            'duration' => new external_value(PARAM_TEXT, 'video duration'),
                            'thumbnail_url' => new external_value(PARAM_RAW, 'URL for the default thumbnail source image'),
                        )
                    )
                ),
                'pages' => new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'page' => new external_value(PARAM_INT, 'page'),
                        )
                    )
                ),
            )
        );
    }

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function video_parameters() {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'The Brightcove video ID', VALUE_REQUIRED),
            )
        );
    }

    /**
     * Returns video
     *
     */
    public static function video($id) {
        global $USER;

        // Parameter validation.
        // This feels dumb and the docs are vague, buy it is required.
        $params = self::validate_parameters(self::video_parameters(), array('id' => $id));

        // Context validation.
        $context = context_user::instance($USER->id);
        self::validate_context($context);

        // TODO: Capability checking.

        // Execute API call.
        $brightcove = new brightcove_api();
        $results = $brightcove->get_video_by_id($id);

        return $results;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function video_returns() {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_TEXT, 'Brightcove video ID'),
                'name' => new external_value(PARAM_TEXT, 'Video title'),
                'complete' => new external_value(PARAM_TEXT, 'whether processing is complete'),
                'created_at' => new external_value(PARAM_TEXT, 'when the video was created'),
                'duration' => new external_value(PARAM_TEXT, 'video duration'),
                'thumbnail_url' => new external_value(PARAM_RAW, 'URL for the default thumbnail source image'),
             )
        );
    }

}
