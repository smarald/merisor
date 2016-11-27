<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


$monthsRoLong = array (
		    '1' => 'Ianuarie',
		     'Februarie',
		     'Martie',
		     'Aprilie',
		     'Mai',
		     'Iunie',
		     'Iulie',
		     'August',
		     'Septembrie',
		     'Octombrie',
		     'Noiembrie',
		     'Decembrie',
		    );

$monthsRoShort = array (
		    '1' => 'Ian',
		     'Feb',
		     'Mar',
		     'Apr',
		     'Mai',
		     'Iun',
		     'Iul',
		     'Aug',
		     'Sep',
		     'Oct',
		     'Noi',
		     'Dec',
		    );

function diffDays($toDate, $fromDate = 0)
{
      $tsToDate = db2Ts($toDate);

      if (!$fromDate) $tsFromDate = time();
      else $tsFromDate = db2Ts($fromDate);

      $tsDiff = $tsToDate - $tsFromDate;

      $res = $tsDiff / 86400;

      if ($tsDiff > 0) $days = floor($res);
      if ($tsDiff < 0) $days = ceil($res);

      return $days;
}


function db2rodate($dbDate, $month = 's', $noday = 0)
{
  $ts = dbDate2Ts($dbDate);
  return roDate($ts, $month, $noday);
}

function roDate($ts, $month='s', $noday)
{
  global $monthsRoShort, $monthsRoLong;

  if ($month == 's') {
  $mo = $monthsRoShort[date('n', $ts)];
  } else {
    $mo = $monthsRoLong[date('n', $ts)];
  }

  if (!$noday) {
  $day = date('d', $ts);
  } else {
    $day = '';
  }

  $year = date('Y', $ts);
  $date = $day.' '.$mo.' '.$year;
  return $date;
}




function smartDate($frmDate, $format = 'dmY')
{
  return frm2DbDate($frmDate, $format);
}



function frm2Db2($frmDate, $format = 'dmY')
{

  $time = substr($frmDate, -8);
  $frmDate = trim($frmDate);
  $frmDate = frm2DbDate($frmDate);

  return $frmDate.' '.$time;
}



function frm2DbDate($frmDate, $format = 'dmY') {

  if (strlen($frmDate)) {
    if (strpos("|", $frmDate)) {
      $dateTimeArr = split("|", $frmDate);
      $frmDate = $dateTimeArr[0];
      $frmTime = $dateTimeArr[1];
    }
  }

  if (isset($frmDate) && strlen($frmDate) > 0) {
    $dateArr = preg_split('/(\.|\/|\s|\-)/', $frmDate);

    if ($format == 'dmY') {
      if (isset($dateArr[0])) $day = (int)$dateArr[0];
      if (isset($dateArr[1])) $month = (int)$dateArr[1];
      if (isset($dateArr[2])) $year = (int)$dateArr[2];
    }  elseif ($format == 'mdY') {
      if (isset($dateArr[1]))  $day = @(int)$dateArr[1];
       if (isset($dateArr[0])) $month = @(int)$dateArr[0];
       if (isset($dateArr[2])) $year = @(int)$dateArr[2];
    }

    if (empty($day)) $day = date('d');
    if (empty($month)) $month = date('m');
    if (empty($year)) $year = date('Y');

    if ($year < 100 && $year > 9) $year = (int) ('20'.$year);
    if ($year < 10 && $year > 0) $year = (int) ('200'.$year);		
    if (!$year) $year = date('Y');

    if ($day && $month && $year) {
      $tsInvoiceDate = mktime(0, 0, 0, $month, $day, $year);
      $dbDate =  date('Y-m-d', $tsInvoiceDate);
    } else {
      $dbDate =  '0000-00-00';
    }
	
  } else {
    $dbDate =  date('Y-m-d');
  }
	
  if (!empty($frmTime)) {
    return $dbDate.' '.$frmTime;
  } else {
    return $dbDate;
  }

} ///


function db2Display($theDate, $type='short') {
  if (!$theDate or $theDate == 'NULL') {
    return '-';
  }
	if ($type == 'short') {
		$formatedDate = date('d M Y', strtotime($theDate));
	} elseif ($type == 'long') {
		$formatedDate = date('d M Y H:i:s', strtotime($theDate));
	} elseif ($type == 'longbr') {
	  $formatedDate = date('d M Y', strtotime($theDate));
	  $formatedDate .= '<br />';
	  $formatedDate .= date('H:i:s', strtotime($theDate));

	} elseif ($type == 'mdY') {
	  $formatedDate = date('m/d/Y', strtotime($theDate));
	}


	return $formatedDate;	
	
}

function db2Frm($theDate, $type='short') {
  if (!$theDate or $theDate == 'NULL') {
    return '-';
  }
	if ($type == 'short') {
		$formatedDate = date('d.m.y', strtotime($theDate));
	} elseif ($type == 'long') {
		$formatedDate = date('d.m.Y H:i:s', strtotime($theDate));
	}


	return $formatedDate;	
	
}

function db2Arr($date)
{
  $arr = split("-", $date);

  $arr2["year"] = $arr[0];
  $arr2["month"] = $arr[1];
  $arr2["day"] = $arr[2];

  return $arr2;
}

function now()
{
  return date('Y-m-d H:i:s');
}


// date1, date2 in db format: Y-m-d
// returns periods spanned in months intervals. except first and last interval which are piece of their current months
// return periods = array (
// 0 => array('begin' => date, 'end' => date)
// 1 => array('begin' => date, 'end' => date)
// .... 

function spanByMonths($date1, $date2) {

// include pear date and set the date format constant to database Y-m-d
define('DATE_CALC_FORMAT', '%Y-%m-%d');
include_once(PEAR_PATH . "Date.php");

$dc = new Date_Calc; // make our object


// get the array of them ar = array('day' => x, 'month' => x, 'year' => x);
$date1Arr = db2Arr($date1); 
$date2Arr = db2Arr($date2);

// if the dates are in the same month and year, we know exactly what are the periods. the rest of logic is for date1 in a month and date2 in other month
if ($date1Arr["year"] == $date2Arr["year"] and $date1Arr["month"] == $date2Arr["month"]) {
  $periods[0]["start"] = $date1;
  $periods[0]["end"] = $date2;
 } else {

$res = 0;
$i = 0;

// now that's the thing: it computes periods having the begin date begin of some month and end date the end of some month...
// ... starting with the beginning of next month (so the date1 end of date1 month) must be added separately
// ...and when the period end date is greater then date2 (date to) it stops. not including that period. (so it must be added separately also)
// lunile pline ce mai

$periods[0]["start"] = $date1;
 $periods[0]["end"] = $dc->endOfMonthBySpan(0, $date1Arr["month"], $date1Arr["year"]);

while (1 == 1) { // when endDate is later then date2 

  $i++;
  $startDate = $dc->beginOfMonthBySpan($i, $date1Arr["month"], $date1Arr["year"]);
  $endDate = $dc->endOfMonthBySpan($i, $date1Arr["month"], $date1Arr["year"]);


  $endDateArr = db2Arr($endDate);

  $res = $dc->compareDates($endDateArr["day"], $endDateArr["month"], $endDateArr["year"], $date2Arr["day"], $date2Arr["month"], $date2Arr["year"]); // compare endDate with date2. will stop only if endDate of the period becomes greater then date2.

  if ($res == 1 or $res == 0) break;

  $periods[$i]["start"] = $startDate;
  $periods[$i]["end"] = $endDate;

 }

 $periods[$i]["start"] = $dc->beginOfMonthBySpan(0, $date2Arr["month"], $date2Arr["year"]);
 $periods[$i]["end"] = $date2;


 } // else if in different months computes in someotherway the periods


 return $periods;

} /// spanByMonths



function dbDate2Ts($dbDate)
{
  $els = split(" ", $dbDate);

  $date = $els[0];

  if (isset($els[1])) {
    $time = $els[1];
    $timeEls = preg_split("/:|\./", $time);
    $timeData = array (
		       'hour' => (int)(@$timeEls[0]),
		       'minute' => (int)(@$timeEls[1]),
		       'second' => (int)(@$timeEls[2]),
		       );
  }

  $dateData = db2Arr($date);

  $ts = mktime($timeData["hour"], $timeData["minute"], $timeData["second"], $dateData["month"], $dateData["day"], $dateData["year"]);
  return $ts;
}


function getHourData($hourFormat)
{
  $pos = strpos($hourFormat, ":");
  if (!$pos) {
    $pos = strpos($hourFormat, ".");
    $sep = ".";
  } else {
    $sep = ":";
  }

 if (!$pos) $pos = 2;

  $hour = (int)(substr($hourFormat, 0, $pos));
  $minute = (int)(substr($hourFormat, $pos+1, 1000));

  return array($hour, $minute);
}

function getHour($hourFormat)
{
  $data = getHourData($hourFormat);
  return $data[0];
}


function getMinute($hourFormat)
{
  $data = getHourData($hourFormat);
  return (int)($data[1]);
}



function db2Ts($date)
{
  $arr = db2Arr($date);
  $ts = mktime(0, 0, 0, $arr["month"], $arr["day"], $arr["year"]);

  return $ts;
}



function getWeekDate($dayNumber, $date = '')
{
  if ($dayNumber < 1 or $dayNumber > 7) die('function: getWeekDate: wrong dayNumber. It has to be between 1 and 7 ');

  if (!$date) $date = date('Y-m-d'); // if no date, we put the current date

  $tsDate = db2Ts($date); // we find the timestamp for our date


  // we cycle back, to find the Monday of the week for this date. will be also in Y-m-d format
  for ($i = 0; $i < 7; $i++) {
    $ts = mktime(0, 0, 0, date('n', $tsDate), date('j', $tsDate)-$i, date('Y', $tsDate));
    $thisDayNumber = date('N', $ts);

    if ($thisDayNumber == 1) { // that's monday
      $mondayDate = date('Y-m-d', $ts);
    }
  }

  $tsMondayDate = db2Ts($mondayDate); // timestamp of Monday date


  // now we climb up, to find the date beginning with that Monday, and matching our dayNumber 
  for ($i = 0; $i < 7; $i++) {
    $ts = mktime(0, 0, 0, date('n', $tsMondayDate), date('j', $tsMondayDate) + $i, date('Y', $tsMondayDate));
    $thisDayNumber = date('N', $ts);

    if ($thisDayNumber == $dayNumber) {
      return date('Y-m-d', $ts);
    }
  }


} /// getWeekDate




function validate_birth_date($birth_date, $format="dmY", $minAge=6) { 
global $errors_array;


if (!preg_match("/^((\d){1,2}(\/|\.|\-)(\d){1,2}(\/|\.|\-)(\d){1,4})$/", $birth_date)) {
	$errors_array['other'][] = 'Invalid date format';
	return 0;

	} else { 

	$date_array = preg_split("(\/|\.|\-)", $birth_date);
	
	if ($format == 'dmY') {
	  $day = (int)($date_array[0]);
	  $month = (int)($date_array[1]);
	  $year = (int)($date_array[2]);
	} else {
	  $day = (int)($date_array[1]);
	  $month = (int)($date_array[0]);
	  $year = (int)($date_array[2]);
	}

	 if (!checkdate($month, $day, $year)) { 
	 $errors_array['other'][] = 'Invalid date';
	 return 0; 
	 }
	 
	 $min_birth_year = date("Y") - 105;
	 $max_birth_year = date("Y") - $minAge;
	 
	 if ($year < $min_birth_year or $year > $max_birth_year) { 
		 $errors_array['other'][] = 'You are too young or too old';
		 return 0;
	 } else { 
		 return 1;
	 }
	  
	 
	 
	} /// if

} /// validate_birth_date
?>