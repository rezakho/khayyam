<?php

namespace Khayyam;

use jDateTime;
use DateTimeZone;
use DateInterval;

class DateTime
{
	protected $timestamp;


	protected $timezone;


	//protected $convertor;


	public function __construct($time = "now", DateTimeZone $timezone = null)
	{
		if (is_string($time) && $time === 'now')
		{
			$this->timestamp = time();
		}

		$this->timezone = $timezone ?: new DateTimeZone(date_default_timezone_get());
	}



	/*public function add(DateInterval $interval)
	{
		return $this;
	}*/



	/*public static function createFromFormat($format ,$time ,DateTimeZone $timezone = null)
	{
		//return new static();
	}*/



	/*public static function getLastErrors()
	{

	}*/



	public function modify($modify)
	{
		$parsed = date_parse($modify);

		if (isset($parsed['relative']))
		{
			$this->parseRelative($parsed['relative']);
		}

		return $this;
	}



	/*public static function __set_state($array)
	{

	}*/



	/*public function setDate($year, $month, $day)
	{
		$this->year  = (int)$year;

		$this->month = (int)$month;

		$this->day   = (int)$day;

		return $this;
	}*/



	/*public function setISODate($year, $week, $day = 1)
	{
		return $this;
	}*/



	/*public function setTime($hour, $minute, $second = 0)
	{
		$this->hour   = (int)$hour;

		$this->minute = (int)$minute;

		$this->second = (int)$second;

		return $this;
	}*/



	public function setTimestamp($timestamp)
	{
		$this->timestamp = $timestamp;

		return $this;
	}



	public function setTimezone(DateTimeZone $timezone)
	{
		$this->timezone = $timezone;

		return $this;
	}



	/*public function sub(DateInterval $interval)
	{
		return $this;
	}*/



	/*public function diff(DateTimeInterface $datetime2, $absolute = false)
	{
		//return $this;
	}*/



	public function format($format)
	{
		return jDateTime::date($format, $stamp = $this->timestamp, $convert = false, $jalali = true, $this->timezone->getName());
	}



	/*public function getOffset()
	{
		return $this;
	}*/



	public function getTimestamp()
	{
		return $this->timestamp;
	}



	public function getTimezone()
	{
		return $this->timezone;
	}



	/*public function __wakeup()
	{
		//return DateTimeZone;
	}*/



	public function parseRelative($relative)
	{
		list($year, $month, $day, $hour, $minute, $second) = $relative;

		$year *= 365*
	}
}