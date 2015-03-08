<?php

class DateTime
{
	public function __construct($time = "now" ,DateTimeZone $timezone = null)
	{

	}



	public function add(DateInterval $interval)
	{
		return $this;
	}



	public static function createFromFormat($format ,$time ,DateTimeZone $timezone = null)
	{
		//return new static();
	}



	public static function getLastErrors()
	{

	}



	public function modify($modify)
	{
		return $this;
	}



	public static function __set_state($array)
	{

	}



	public function setDate($year, $month, $day)
	{
		return $this;
	}



	public function setISODate($year, $week, $day = 1)
	{
		return $this;
	}



	public function setTime($hour, $minute, $second = 0)
	{
		return $this;
	}



	public function setTimestamp($unixtimestamp)
	{
		return $this;
	}



	public function setTimezone(DateTimeZone $timezone)
	{
		return $this;
	}



	public function sub(DateInterval $interval)
	{
		return $this;
	}



	public function diff(DateTimeInterface $datetime2, $absolute = false)
	{
		//return $this;
	}



	public function format($format)
	{
		
	}



	public function getOffset()
	{
		return $this;
	}



	public function getTimestamp()
	{
		return $this;
	}



	public function getTimezone()
	{
		//return DateTimeZone;
	}



	public function __wakeup()
	{
		//return DateTimeZone;
	}
}