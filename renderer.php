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
 * Renderer for the Sagar Test block.
 *
 * @package    block_sagar_test
 * @copyright  Sagar Singh <sagar.singh9759@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Renderer for the Sagar Test block.
 *
 * @package    block_sagar_test
 * @copyright  Sagar Singh <sagar.singh9759@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_sagar_test_renderer extends plugin_renderer_base {

    /**
     * Renders the list of course modules along with course module id.
     *
     * @param int $courseid Course id of the current course
     * @return string The HTML to display.
     */
    public function data_display(int $courseid) {
        global $DB, $USER, $CFG;
        $data = [];
        $course_modules = $DB->get_records('course_modules', array('course' => $courseid), '', 'id, module, instance, added');
        if($course_modules){
            foreach($course_modules as $cm){
                $cmarray = new stdClass();
                $moduletypename = $DB->get_field('modules', 'name', ['id' => $cm->module]);
                $cmname = $DB->get_field($moduletypename, 'name', array('id' => $cm->instance));
                $url = new moodle_url($CFG->wwwroot . "/mod/$moduletypename/view.php", ['id' => $cm->id]);
                $cmarray->name = "<a href = $url> $cmname </a>";
                $cmarray->date = date( "d-M-Y" , $cm->added );
                $cmarray->id = $cm->id;
                $completionstatus = $DB->get_field('course_modules_completion', 'completionstate', ['coursemoduleid' => $cm->id, 'userid' => $USER->id]);
                if($completionstatus == 1){
                    $cmarray->completionstatus = get_string('completed', 'block_sagar_test');
                }
                $data[] = $cmarray;
            }
        }
        $html = '';
        if($data){
            foreach($data as $d){
                $html .= $d->id.' - '.$d->name.' - '.$d->date;
                if(isset($d->completionstatus)){
                    $html .= ' - '.$d->completionstatus.'<br>';
                }else{
                    $html .= '<br>';
                }
            }

        }else{
            $html .= get_string('nomodule', 'block_sagar_test');
        }

        return $html;
    }
}