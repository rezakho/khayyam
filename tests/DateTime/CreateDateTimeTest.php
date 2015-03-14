<?php

/*
 * This file is part of the Khayyam package.
 *
 * (c) Reza Khodadadi <rezakho@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Khayyam\DateTime;

class CreateTest extends TestFixture
{
	public function testCreateReturnsDatingInstance()
	{
		$d = new DateTime();
		$this->assertTrue($d instanceof \DateTime);
	}

	public function testCreateByNowReturnsDatingInstance()
	{
		$d = new DateTime('now');
		$this->assertTrue($d instanceof \DateTime);
	}

	public function testCreateWithDefaults()
	{
		$d = new DateTime();
		$this->assertSame(time(), $d->getTimeStamp());
	}

	public function testCreateWithNow()
	{
		$d = new DateTime('now');
		$this->assertSame(time(), $d->getTimeStamp());
	}

	public function testCreateWithInvalidYear()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = new DateTime(-3);
	}

	public function testCreateWithYear()
	{
		$d = new DateTime('1394');
		$this->assertSame(1394, (int)$d->format('Y'));
	}
/*

	public function testCreateWithMonth()
	{
		$d = DateTime::create(null, 3);
		$this->assertSame(3, $d->month);
	}

	public function testCreateWithInvalidMonth()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, -5);
	}

	public function testCreateMonthWraps()
	{
		$d = DateTime::create(1394, 0, 1, 0, 0, 0);
		$this->assertDateTime($d, 1393, 12, 1, 0, 0, 0);
	}

	public function testCreateWithDay()
	{
		$d = DateTime::create(null, null, 21);
		$this->assertSame(21, $d->day);
	}

	public function testCreateWithInvalidDay()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, null, -4);
	}
	public function testCreateDayWraps()
	{
		$d = DateTime::create(1394, 1, 40, 0, 0, 0);
		$this->assertDateTime($d, 1394, 2, 9, 0, 0, 0);
	}

	public function testCreateWithHourAndDefaultMinSecToZero()
	{
		$d = DateTime::create(null, null, null, 14);
		$this->assertSame(14, $d->hour);
		$this->assertSame(0, $d->minute);
		$this->assertSame(0, $d->second);
	}

	public function testCreateWithInvalidHour()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, null, null, -1);
	}

	public function testCreateHourWraps()
	{
		$d = DateTime::create(1394, 1, 1, 24, 0, 0);
		$this->assertDateTime($d, 1394, 1, 2, 0, 0, 0);
	}

	public function testCreateWithMinute()
	{
		$d = DateTime::create(null, null, null, null, 58);
		$this->assertSame(58, $d->minute);
	}

	public function testCreateWithInvalidMinute()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(1394, 1, 1, 0, -2, 0);
	}
	public function testCreateMinuteWraps()
	{
		$d = DateTime::create(1394, 1, 1, 0, 62, 0);
		$this->assertDateTime($d, 1394, 1, 1, 1, 2, 0);
	}

	public function testCreateWithSecond()
	{
		$d = DateTime::create(null, null, null, null, null, 59);
		$this->assertSame(59, $d->second);
	}

	public function testCreateWithInvalidSecond()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, null, null, null, null, -2);
	}
	public function testCreateSecondsWrap()
	{
		$d = DateTime::create(1394, 1, 1, 0, 0, 61);
		$this->assertDateTime($d, 1394, 1, 1, 0, 1, 1);
	}
*/
	public function testCreateWithDateTimeZone()
	{
		$d = new DateTime('1394-01-01 00:00:00', new \DateTimeZone('Asia/Tehran'));
		$this->assertDateTime($d, 1394, 1, 1, 0, 0, 0);
		$this->assertSame('Asia/Tehran', $d->getTimezone()->getName());
	}


}
