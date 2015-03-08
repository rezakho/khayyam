<?php

/*
 * This file is part of the Khayyam package.
 *
 * (c) Reza Khodadadi <rezakho@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Khayyam\Khayyam;

class CreateTest extends TestFixture
{
	public function testCreateReturnsDatingInstance()
	{
		$d = Khayyam::create();
		$this->assertTrue($d instanceof Khayyam);
	}

	public function testCreateWithDefaults()
	{
		$d = Khayyam::create();
		$this->assertSame($d->timestamp, Khayyam::now()->timestamp);
	}

	public function testCreateWithYear()
	{
		$d = Khayyam::create(2012);
		$this->assertSame(2012, $d->year);
	}

	public function testCreateWithInvalidYear()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = Khayyam::create(-3);
	}

	public function testCreateWithMonth()
	{
		$d = Khayyam::create(null, 3);
		$this->assertSame(3, $d->month);
	}

	public function testCreateWithInvalidMonth()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = Khayyam::create(null, -5);
	}

	public function testCreateMonthWraps()
	{
		$d = Khayyam::create(2011, 0, 1, 0, 0, 0);
		$this->assertKhayyam($d, 2010, 12, 1, 0, 0, 0);
	}

	public function testCreateWithDay()
	{
		$d = Khayyam::create(null, null, 21);
		$this->assertSame(21, $d->day);
	}

	public function testCreateWithInvalidDay()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = Khayyam::create(null, null, -4);
	}
	public function testCreateDayWraps()
	{
		$d = Khayyam::create(2011, 1, 40, 0, 0, 0);
		$this->assertKhayyam($d, 2011, 2, 9, 0, 0, 0);
	}

	public function testCreateWithHourAndDefaultMinSecToZero()
	{
		$d = Khayyam::create(null, null, null, 14);
		$this->assertSame(14, $d->hour);
		$this->assertSame(0, $d->minute);
		$this->assertSame(0, $d->second);
	}

	public function testCreateWithInvalidHour()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = Khayyam::create(null, null, null, -1);
	}

	public function testCreateHourWraps()
	{
		$d = Khayyam::create(2011, 1, 1, 24, 0, 0);
		$this->assertKhayyam($d, 2011, 1, 2, 0, 0, 0);
	}

	public function testCreateWithMinute()
	{
		$d = Khayyam::create(null, null, null, null, 58);
		$this->assertSame(58, $d->minute);
	}

	public function testCreateWithInvalidMinute()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = Khayyam::create(2011, 1, 1, 0, -2, 0);
	}
	public function testCreateMinuteWraps()
	{
		$d = Khayyam::create(2011, 1, 1, 0, 62, 0);
		$this->assertKhayyam($d, 2011, 1, 1, 1, 2, 0);
	}

	public function testCreateWithSecond()
	{
		$d = Khayyam::create(null, null, null, null, null, 59);
		$this->assertSame(59, $d->second);
	}

	public function testCreateWithInvalidSecond()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = Khayyam::create(null, null, null, null, null, -2);
	}
	public function testCreateSecondsWrap()
	{
		$d = Khayyam::create(2012, 1, 1, 0, 0, 61);
		$this->assertKhayyam($d, 2012, 1, 1, 0, 1, 1);
	}

	public function testCreateWithDateTimeZone()
	{
		$d = Khayyam::create(2012, 1, 1, 0, 0, 0, new \DateTimeZone('Europe/London'));
		$this->assertKhayyam($d, 2012, 1, 1, 0, 0, 0);
		$this->assertSame('Europe/London', $d->tzName);
	}

	public function testCreateWithTimeZoneString()
	{
		$d = Khayyam::create(2012, 1, 1, 0, 0, 0, 'Europe/London');
		$this->assertKhayyam($d, 2012, 1, 1, 0, 0, 0);
		$this->assertSame('Europe/London', $d->tzName);
	}
}
