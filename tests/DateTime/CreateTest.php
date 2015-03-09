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
		$d = new DateTime;
		$this->assertTrue($d instanceof DateTime);
	}



	public function testSetTimeZoneInConstructer()
	{
		$tz =  new DateTimeZone('Asia/Tehran');

		$d = new DateTime(null, $tz);

		$this->assertSame($d->getTimezone(), $tz);
	}


}
