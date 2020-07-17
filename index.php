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
 *  A page for testing realtime event pushing form CL.
 *
 * @package    tool_realtime
 * @copyright  2020 Nicholas Parker
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../../config.php');

$url = new moodle_url('/admin/tool/realtime/plugin/phppoll/');
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'tool_realtime'));
$PAGE->set_heading(get_string('pluginname', 'tool_realtime'));
$PAGE->navbar->add(get_string('pluginname', 'tool_realtime'), $url);
require_login($course, true, $cm);
$contexttest = context_user::instance($USER->id);
$componenttest = "testcomponent";
$areatest = "testarea";
$itemidtest = 123;
\tool_realtime\api::subscribe($contexttest, $componenttest, $areatest, $itemidtest);
echo $OUTPUT->header();
print_object($USER);
echo $OUTPUT->footer();
?>

<script type="text/javascript">
    require(['core/pubsub', 'tool_realtime/events'], function(PubSub, RealTimeEvents) {
        PubSub.subscribe(RealTimeEvents.EVENT, function(data) {
            console.log(data);
        });
    });
</script>

