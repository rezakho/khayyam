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

class CreateFromDateTest extends TestFixture
{
	public function testCreateFromDateWithDefaults()
	{
		$d = Khayyam::createFromDate();
		$this->assertSame($d->timestamp, Khayyam::create(null, null, null, null, null, null)->timestamp);
	}

	public function testCreateFromDate()
	{
		$d = Khayyam::createFromDate(1975, 5, 21);
		$this->assertKhayyam($d, 1975, 5, 21);
	}

	public function testCreateFromDateWithYear()
	{
		$d = Khayyam::createFromDate(1975);
		$this->assertSame(1975, $d->year);
	}

	public function testCreateFromDateWithMonth()
	{
		$d = Khayyam::createFromDate(null, 5);
		$this->assertSame(5, $d->month);
	}

	public function testCreateFromDateWithDay()
	{
		$d = Khayyam::createFromDate(null, null, 21);
		$this->assertSame(21, $d->day);
	}

	public function testCreateFromDateWithTimezone()
	{
		$d = Khayyam::createFromDate(1975, 5, 21, 'Europe/London');
		$this->assertKhayyam($d, 1975, 5, 21);
		$this->assertSame('Europe/London', $d->tzName);
	}

	public function testCreateFromDateWithDateTimeZone()
	{
		$d = Khayyam::createFromDate(1975, 5, 21, new \DateTimeZone('Europe/London'));
		$this->assertKhayyam($d, 1975, 5, 21);
		$this->assertSame('Europe/London', $d->tzName);
	}
}