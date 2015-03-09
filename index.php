<?php

require __DIR__.'/vendor/autoload.php';

$ts = jDateTime::mktime(0, 0, 0, 1, 1, 1394, $jalali = true, $timezone = 'Asia/Tehran');

echo  jDateTime::date('Y:m:d H:i:s', $ts, $convert = false, $jalali = true, 'Asia/Tehran');

for ($i=1385; $i < 1599; $i++)
{
	$ts = jDateTime::mktime(10, 10, 10, 10, 10, $i, $jalali = false, $timezone = 'Asia/Tehran');

	$isLeap = jDateTime::date('L', $ts, $convert = false, $jalali = false, 'Asia/Tehran');

	echo $i . $isLeap . ($isLeap ==1 ? 'leap' : '') . '<br/>';
}

echo time();exit;

print_r(date_parse("1393-10-10 12:12:12 +1 year - 1 month +1.5 second"));exit;



$d = new DateTime;

var_dump($d->format('Y-m-d H:i:s'));
var_dump($d->getTimestamp());

date_default_timezone_set('Asia/Tehran');
$d = new \Khayyam\DateTime;

var_dump($d->format('Y-m-d H:i:s'));
var_dump($d->getTimestamp());



/*
function isValid($time)
{
	$symbols =
	[
		"DD"           => '(0[0-9]|[1-2][0-9]|3[01])',
		"doy"          => '00[1-9]|0[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9]|36[0-6]',
		"frac"         => '\.[0-9]+',
		"hh"           => '0?[1-9]|1[0-2]',
		"HH"           => '[01][0-9]|2[0-4]',
		"meridian"     => '[AaPp]\.?[Mm]\.?[\0\t ]',
		"ii"           => '[0-5][0-9]',
		"II"           => '[0-5][0-9]',
		"M"            => '(jan|feb|mar|apr|may|jun|jul|aug|sep|sept|oct|nov|dec)',
		"MM"           => '[0-5][0-9]',
		"space"        => '[ \t]',
		"ss"           => '[0-5][0-9]',
		"SS"           => '[0-5][0-9]',
		"W"            => '0[1-9]|[1-4][0-9]|5[0-3]',
		"tzcorrection" => '(GMT)?[+-]0?[1-9]|1[0-2](\:?[0-5][0-9])?',
		"YY"           => '[0-9]{4}'
	];
}
*/
/*
dd\/M\/YY:HH\:II\:SSspacetzcorrection
YY\:MM\:DD HH\:II\:SS
YY\-?[W]W
YY\-?"W"W\-?[0-7]
YY\-MM\-DD HH\:II\:SS
YY\.?doy
YY\-MM\-DD[tT]HH\:II\:SSfractzcorrection?
"@"\-?[0-9]+
YYMMDD[tT]hh\:II\:SS
YYMMDD[tT]hhIISS
YY\-mm\-dd"T"hh\:ii\:ss
*/