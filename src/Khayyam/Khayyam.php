<?php

/*
 * This file is part of the Khayyam package.
 *
 * (c) Reza Khodadadi <rezakho@gmail.com>
 */

namespace Khayyam;

use Carbon\Carbon;

class Khayyam extends Carbon
{
	const IRAN_OFFICIAL_CALENDAR = 0;
	const GREGORIAN_CALENDAR     = 1;

	protected $calendar = self::IRAN_OFFICIAL_CALENDAR;

	///////////////////////////////////////////////////////////////////
	//////////////////////////// Overrides ////////////////////////////
	///////////////////////////////////////////////////////////////////

	public function format($format)
	{
		return jDateTime::date($format, $stamp = $this->getTimestamp(), $convert = false, $jalali = true, $this->getTimezone()->getName());
	}



	public static function create($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null)
    {
        $year = ($year === null) ? jDateTime::date('Y') : $year;
        $month = ($month === null) ? jDateTime::date('n') : $month;
        $day = ($day === null) ? jDateTime::date('j') : $day;

        if ($hour === null) {
            $hour = jDateTime::date('G');
            $minute = ($minute === null) ? jDateTime::date('i') : $minute;
            $second = ($second === null) ? jDateTime::date('s') : $second;
        } else {
            $minute = ($minute === null) ? 0 : $minute;
            $second = ($second === null) ? 0 : $second;
        }

        return static::createFromFormat('Y-n-j G:i:s', sprintf('%s-%s-%s %s:%02s:%02s', $year, $month, $day, $hour, $minute, $second), $tz);
    }
}
