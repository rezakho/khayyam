<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';

use Khayyam\Khayyam;
use Khayyam\DateTime;

class TestFixture extends \PHPUnit_Framework_TestCase
{
	private $saveTz;

	protected function setUp()
	{
		//save current timezone
		$this->saveTz = date_default_timezone_get();

		date_default_timezone_set('Asia/Tehran');
	}

	protected function tearDown()
	{
		date_default_timezone_set($this->saveTz);
	}

	protected function assertKhayyam(DateTime $d, $year, $month, $day, $hour = null, $minute = null, $second = null)
	{
		$this->assertSame($year, $d->year, 'Khayyam->year');
		$this->assertSame($month, $d->month, 'Khayyam->month');
		$this->assertSame($day, $d->day, 'Khayyam->day');

		if ($hour !== null) {
			$this->assertSame($hour, $d->hour, 'Khayyam->hour');
		}

		if ($minute !== null) {
			$this->assertSame($minute, $d->minute, 'Khayyam->minute');
		}

		if ($second !== null) {
			$this->assertSame($second, $d->second, 'Khayyam->second');
		}
	}

	protected function assertInstanceOfKhayyam($d)
	{
		$this->assertInstanceOf('Khayyam\Khayyam', $d);
	}

	protected function assertDateTime(DateTime $d, $year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null)
	{
		if ($year !== null) {
			$this->assertSame($year, (int)$d->format('Y'), 'DateTime->year');
		}

		if ($month !== null) {
			$this->assertSame($month, (int)$d->format('m'), 'DateTime->month');
		}

		if ($day !== null) {
			$this->assertSame($day, (int)$d->format('d'), 'DateTime->day');
		}
		
		if ($hour !== null) {
			$this->assertSame($hour, (int)$d->format('H'), 'DateTime->hour');
		}

		if ($minute !== null) {
			$this->assertSame($minute, (int)$d->format('i'), 'DateTime->minute');
		}

		if ($second !== null) {
			$this->assertSame($second, (int)$d->format('s'), 'DateTime->second');
		}
	}

	protected function assertInstanceOfDateTime($d)
	{
		$this->assertInstanceOf('Khayyam\DateTime', $d);
	}
}
