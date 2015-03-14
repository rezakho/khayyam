<?php

namespace Khayyam;

use DateTime as PhpDateTime;
use DateTimeZone;
use DateInterval;

class DateTime extends PhpDateTime
{
	protected $timestamp;


	protected $timezone;


	//protected $convertor;


	public function __construct($time = "now", DateTimeZone $timezone = null)
	{
		if (!is_string($time))
		{
			throw new \InvalidArgumentException("DateTime::__construct() expects parameter 1 to be string, ". gettype($time) ." given", 1);
		}

		$this->modify($time);

		$this->timezone = $timezone ?: new DateTimeZone(date_default_timezone_get());
	}



	/*public function add(DateInterval $interval)
	{
		return $this;
	}*/



	public static function createFromFormat($format ,$time, $timezone = null)
	{
		$dateInfo = date_parse_from_format($format, $time);

		$timestamp = static::parseJalaliDateInfoToUTCTimestamp($dateInfo);

		return new static('@'.$timestamp, $timezone);
	}



	/*public static function getLastErrors()
	{

	}*/



	public function modify($time)
	{
		// now
		if (empty($time) || $time === 'now')
		{
			$this->timestamp = time();

			return $this;
		}
		// @1212132132
		/*elseif (preg_match('#^@(\d+)$#', $time, $matched))
		{
			$this->timestamp = $matched[1];

			return $this;
		}*/

		$parsed = date_parse($time);

		$timestamp = $relativeTimestamp = 0;

		if ($this->hasAnyTime($parsed))
		{
			$timestamp = static::parseJalaliDateInfoToUTCTimestamp($parsed);
		}
		else
		{
			$timestamp = $this->timestamp ?: time();
		}
		
		if ($this->hasRelativeTime($parsed))
		{
			$relativeTimestamp = $this->parseRelative($parsed);
		}

		if ($parsed['is_localtime'] !== false)
		{
			$this->timestamp = $relativeTimestamp;

			return $this;
		}

		$this->timestamp = $timestamp + $relativeTimestamp;

		return $this;
	}



	protected function hasAnyTime($time)
	{
		return 
			$time['year'] !== false ||
			$time['month'] !== false ||
			$time['day'] !== false ||
			$time['hour'] !== false ||
			$time['minute'] !== false ||
			$time['second'] !== false ||
			$time['fraction'] !== false
			;
	}



	protected function hasRelativeTime($time)
	{
		return isset($time['relative']);
	}




	public static function parseJalaliDateInfoToUTCTimestamp($dateInfo)
	{
		$year          = $dateInfo['year'];
		$month         = $dateInfo['month'];
		$day           = $dateInfo['day'];
		$hour          = $dateInfo['hour'];
		$minute        = $dateInfo['minute'];
		$second        = $dateInfo['second'];
		$fraction      = $dateInfo['fraction'];
		$warning_count = $dateInfo['warning_count'];
		$warnings      = $dateInfo['warnings'];
		$error_count   = $dateInfo['error_count'];
		$errors        = $dateInfo['errors'];
		$is_localtime  = $dateInfo['is_localtime'];

		$year = ($year === false) ? static::date('Y') : $year;
		$month = ($month === false) ? static::date('n') : $month;
		$day = ($day === false) ? static::date('j') : $day;

		if ($hour === false)
		{
			$hour = static::date('G');
			$minute = ($minute === false) ? static::date('i') : $minute;
			$second = ($second === false) ? static::date('s') : $second;
		}
		else
		{
			$minute = ($minute === false) ? 0 : $minute;
			$second = ($second === false) ? 0 : $second;
		}

		
		return \jDateTime::mktime($hour, $minute, $second, $month, $day, $year);
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



	public function setTimezone($timezone)
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
		return static::date($format, $this->timestamp);
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



	public function parseRelative($time)
	{
		$relative = $time['relative'];

		$ts = 0;
		
		$year   = (int)$relative['year'];
		$month  = (int)$relative['month'];
		$day    = (int)$relative['day'];
		$hour   = (int)$relative['hour'];
		$minute = (int)$relative['minute'];
		$second = (int)$relative['second'];

		$ts += $year * 365 * 24 * 60 * 60; 
		$ts += $month * 30 * 24 * 60 * 60; 
		$ts += $day * 24 * 60 * 60; 
		$ts += $hour * 60 * 60; 
		$ts += $minute * 60; 
		$ts += $second * 1; 

		return $ts;
	}




	public static function date($format, $timestamp = null)
	{
		$timestamp = $timestamp ?: time();

		return \jDateTime::date($format, $timestamp, false, true);
	}



}
