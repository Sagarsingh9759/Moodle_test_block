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
 * Sagar Test Block
 *
 * @package    block_sagar_test
 * @copyright  Sagar Singh <sagar.singh9759@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Sagar Test block class.
 *
 * @package    block_sagar_test
 * @copyright  Sagar Singh <sagar.singh9759@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_sagar_test extends block_base {

    /**
     * Initialises the block instance.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_sagar_test');
    }

    /**
     * Generates the content of the block and returns it.
     *
     * @return stdClass
     */
    public function get_content() {
        global $OUTPUT, $CFG, $DB;


        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->footer = '';
        $this->content->text   = '';

        if (empty($this->instance)) {
            return $this->content;
        }

        $course = $this->page->course;

        $renderer = $this->page->get_renderer('block_sagar_test');
        $this->content->text = $renderer->data_display($course->id);
        

        return $this->content;
    }

    /**
     * Returns an array of formats for which this block can be used.
     *
     * @return array
     */
    public function applicable_formats() {
        return array(
            'course-view' => true,
        );
    }

}
