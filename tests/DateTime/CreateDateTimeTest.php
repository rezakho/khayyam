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

class CreateDateTimeTest extends TestFixture
{
	public function testCreateReturnsDatingInstance()
	{
		$d = new DateTime();
		$this->assertTrue($d instanceof \DateTime);
	}

	public function testCreateWithDefaults()
	{
		$d = new DateTime();
		$this->assertSame(time(), $d->getTimeStamp());
	}

	public function testCreateWithEmptyTime()
	{
		$d = new DateTime('');
		$this->assertSame(time(), $d->getTimeStamp());
	}

	public function testCreateWithNow()
	{
		$d = new DateTime('now');
		$this->assertSame(time(), $d->getTimeStamp());
	}

	public function testCreateWithInvalidTimeType()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = new DateTime(array());
	}
/*
	public function testCreateWithInvalidYear()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = new DateTime(-3);
	}
*/
	public function testCreateWithYear()
	{
		$d = new DateTime('1394');
		$this->assertDateTime($d, 1394);
	}


	public function testCreateWithMonth()
	{
		$d = new DateTime('1394-02');
		$this->assertDateTime($d, null, 2);
	}
/*
	public function testCreateWithInvalidMonth()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, -5);
	}
*/
	public function testCreateWithDay()
	{
		$d = new DateTime('1394-01-13');
		$this->assertDateTime($d, null, null, 13);
	}
/*
	public function testCreateWithInvalidDay()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, null, -4);
	}
*/
	public function testCreateWithHourMinSec()
	{
		$d = new DateTime('1394-01-01 12:13:14');
		$this->assertDateTime($d, null, null, null, 12, 13, 14);
	}
/*
	public function testCreateWithInvalidHour()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(null, null, null, -1);
	}

	public function testCreateWithMinute()
	{
		$d = DateTime::create(null, null, null, null, 58);
		$this->assertSame(58, $d->minute);
	}
*//*
	public function testCreateWithInvalidMinute()
	{
		$this->setExpectedException('InvalidArgumentException');
		$d = DateTime::create(1394, 1, 1, 0, -2, 0);
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

*/
	public function testCreateWithTimestampStyle()
	{
		$d = new DateTime('@1426883400');
		$this->assertEquals(1426883400, $d->getTimeStamp());
	}

	public function testCreateWithDefaultDateTimeZone()
	{
		$d = new DateTime();
		$this->assertSame('Asia/Tehran', $d->getTimezone()->getName());
	}

	public function testCreateWithNullDateTimeZone()
	{
		$d = new DateTime('now', null);
		$this->assertSame('Asia/Tehran', $d->getTimezone()->getName());
	}

	public function testCreateWithDateTimeZone()
	{
		$d = new DateTime('now', new \DateTimeZone('Asia/Tehran'));
		$this->assertSame('Asia/Tehran', $d->getTimezone()->getName());
	}


}
