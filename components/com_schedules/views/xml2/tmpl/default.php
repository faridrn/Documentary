<?php
/**
 * @version     1.0.0
 * @package     com_schedules
 * @copyright   Copyright (C) 2012,  Pooya TV. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Farid Roshan <faridv@gmail.com> - http://www.faridr.ir
 */

// no direct access
defined('_JEXEC') or die;

header("Content-type: text/xml; charset=utf-8");

include_once JPATH_COMPONENT_SITE . '/assets/jdf.php';

$today = date('Y-m-d', time());
list($y, $m, $d) = explode('-', $today);
$jalaliDate = gregorian_to_jalali($y, $m, $d, '-');
$dateValue = JRequest::getVar('date', null, 'get') ? JRequest::getVar('date', null, 'get') : $jalaliDate;
list($y2, $m2, $d2) = explode('-', $dateValue);
$printDate = tr_num($d2, 'fa') . '/' . tr_num($m2, 'fa') . '/' . tr_num($y2, 'fa');

list($y, $m, $d) = explode('-', $dateValue);
$y = tr_num($y, 'en'); $m = tr_num($m, 'en'); $d = tr_num($d, 'en');
$jalaliDate = $y . '-' . $m . '-' . $d;
if ($y < 2012) {
	if (intval($y) != 0) {
		$date = jalali_to_gregorian($y, $m, $d, '-');
	}
}
$query = 'SELECT s.*, u.name AS username FROM #__schedules AS s INNER JOIN #__users AS u on s.modified_by = u.id WHERE s.date = "' . $date . '" AND s.state = 1';
$db = JFactory::getDBO();
$db->setQuery($query, 0, 1);
$schedule = $db->loadObject();
if (count($schedule)) { 
	$schedule->start = ($schedule->start) ? $schedule->start : '06:30';
	$schedule->end = ($schedule->end) ? $schedule->end : '23:00';
	$programs = json_decode($schedule->programs);
	$now = strtotime(date('H:i', time()));
	$onAirId = 999999; // Invalid program ID
	if (!empty($schedule->modified)) {
		list($mdate, $mtime) = explode(' ', $schedule->modified);
		list($my, $mm, $md) = explode('-', $mdate);
		$mJalaliDate = gregorian_to_jalali($my, $mm, $md, '-');
	}
	foreach ($programs as $program) {
		// On Air
		if (strtotime($date) == strtotime($today)) {
			if (strtotime($program->time) < time()) {
				(int) $onAirId = $program->id;
			}
		}
		// Duration
		if (empty($program->duration)) {
			$nextProgram = $program->id + 1;
			if (isset($programs->$nextProgram->time)) {
				$program->duration = strtotime($programs->$nextProgram->time) - strtotime($program->time);
			} else {
				$program->duration = strtotime($schedule->end) - strtotime($program->time);
			}
			//$program->duration = gmdate('H:i:s', $program->duration);
		}
	}

	$i = 0;
?><?xml version="1.0" encoding="utf-8"?>
<schedule>
	<info>
		<occassion><?php echo $schedule->occassion; ?></occassion>
		<date><?php echo $date; ?></date>
		<jalaliDate><?php echo $jalaliDate; ?></jalaliDate>
		<startTimePrograms><?php echo $schedule->start; ?></startTimePrograms>
		<endTimePrograms><?php echo $schedule->end; ?></endTimePrograms>
		<?php if (!empty($schedule->modified)) { ?><lastModifiedDate><?php echo $mdate; ?></lastModifiedDate>
		<lastModifiedDateJalali><?php echo $mJalaliDate; ?></lastModifiedDateJalali>
		<lastModifiedTime><?php echo $mtime; ?></lastModifiedTime>
		<lastModifiedBy><?php echo $schedule->username; ?></lastModifiedBy>
<?php } ?>
	</info>
	<programs>
<?php
foreach ($programs as $item) {
	$i++;
	$onAir = ($item->id == $onAirId) ? true : 0;
	$part = (!empty($item->part) || ($item->part != 0)) ? ' - قسمت ' . $item->part : '';
?>
		<program>
			<id><?php echo $i; ?></id>
			<name><?php echo $item->name; ?></name>
			<startTime><?php echo $item->time; ?></startTime>
			<duration><?php echo $item->duration; ?></duration>
			<type><?php echo $item->kind; ?></type>
<?php if (!empty($item->part) || $item->part != 0) { ?>
			<part><?php echo $item->part; ?></part>
<?php } ?>
<?php if (!empty($item->parts) || $item->part != 0) { ?>
			<parts><?php echo $item->parts; ?></parts>
<?php } ?>
			<uniqueId><?php echo $item->uid; ?></uniqueId>
<?php if (!empty($item->note)) { ?>
			<notes><?php echo $item->note; ?></notes>
<?php } ?>
<?php if ($onAir != 0) { ?>
			<onAir><?php echo $onAir; ?></onAir>
<?php } ?>
		</program>
<?php } ?>
	</programs>
</schedule>
<?php 
} else {
?><?xml version="1.0" encoding="utf-8"?>
<error>No schedules found for specified date.</error>
<?php } ?>
<?php JFactory::getApplication()->close(); ?>