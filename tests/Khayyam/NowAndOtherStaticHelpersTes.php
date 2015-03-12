<?php

/*
 * This file is part of the Khayyam package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Khayyam\Khayyam;

class NowAndOtherStaticHelpersTest extends TestFixture
{
	public function testNow()
	{
		$dt = Khayyam::now();
		$this->assertSame(time(), $dt->timestamp);
	}

	public function testNowWithTimezone()
	{
		$dt = Khayyam::now('Asia/Tehran');
		$this->assertSame(time(), $dt->timestamp);
		$this->assertSame('Asia/Tehran', $dt->tzName);
	}

	public function testToday()
	{
		$dt = Khayyam::today();
		$this->assertSame(date('Y-m-d 00:00:00'), $dt->toDateTimeString());
	}

	public function testTodayWithTimezone()
	{
		$dt = Khayyam::today('Asia/Tehran');
		$dt2 = new \DateTime('now', new \DateTimeZone('Asia/Tehran'));
		$this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
	}

	public function testTomorrow()
	{
		$dt = Khayyam::tomorrow();
		$dt2 = new \DateTime('tomorrow');
		$this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
	}

	public function testTomorrowWithTimezone()
	{
		$dt = Khayyam::tomorrow('Asia/Tehran');
		$dt2 = new \DateTime('tomorrow', new \DateTimeZone('Asia/Tehran'));
		$this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
	}

	public function testYesterday()
	{
		$dt = Khayyam::yesterday();
		$dt2 = new \DateTime('yesterday');
		$this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
	}

	public function testYesterdayWithTimezone()
	{
		$dt = Khayyam::yesterday('Asia/Tehran');
		$dt2 = new \DateTime('yesterday', new \DateTimeZone('Asia/Tehran'));
		$this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
	}

	public function testMinValue()
	{
		$this->assertLessThanOrEqual(- 2147483647, Khayyam::minValue()->getTimestamp());
	}

	public function testMaxValue()
	{
		$this->assertGreaterThanOrEqual(2147483647, Khayyam::maxValue()->getTimestamp());
	}
}
