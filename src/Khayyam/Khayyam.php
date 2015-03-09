<?php

/*
 * This file is part of the Khayyam package.
 *
 * (c) Reza Khodadadi <rezakho@gmail.com>
 */

namespace Khayyam;

use Carbon\Carbon;
use jDateTime;

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
}
