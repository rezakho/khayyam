<?php

require __DIR__.'/vendor/autoload.php';
require 'jDateTime.php';



header('Content-Type: text/plain; charset=utf-8');

date_default_timezone_set('GMT');


$date = new Khayyam\DateTime();
$date->modify('+20 hour')->modify('+41 hour');

echo $date->format('Y-m-d H:i:s');
exit;


//print_r(date_parse('@1564165431'));exit;
print_r(date_parse_from_format('Y-m-d i:s', '2290-02-31 00:12'));exit;


   
    $date=new DateTime();
    $date->setDate(2015,02,28);
   
    function addMonths($date,$months){
        
        $init=clone $date;
        $modifier=$months.' months';
        $back_modifier =-$months.' months';
       
        $date->modify($modifier);
        $back_to_init= clone $date;
        $back_to_init->modify($back_modifier);
       //return;
        while($init->format('m')!=$back_to_init->format('m')){
        $date->modify('-1 day')    ;
        $back_to_init= clone $date;
        $back_to_init->modify($back_modifier);   
        }
       
        /*
        if($months<0&&$date->format('m')>$init->format('m'))
        while($date->format('m')-12-$init->format('m')!=$months%12)
        $date->modify('-1 day');
        else
        if($months>0&&$date->format('m')<$init->format('m'))
        while($date->format('m')+12-$init->format('m')!=$months%12)
        $date->modify('-1 day');
        else
        while($date->format('m')-$init->format('m')!=$months%12)
        $date->modify('-1 day');
        */
       //echo 'sdfsdsd';
    }
    
    function addYears($date,$years){
       
        $init=clone $date;
        $modifier=$years.' years';
        $date->modify($modifier);
       
        while($date->format('m')!=$init->format('m'))
        $date->modify('-1 day');
       

       
    }
   
   
   
    addMonths($date,1);
     //addYears($date,3);
  
   
    //echo $date->format('m j,Y');
     

     //exit;
//echo time();exit;


print_r(Khayyam\Khayyam::now()->toDateTimeString());
echo "\n";
print_r(Khayyam\Khayyam::createFromDate(1393, 5, 21)->age);exit;
print_r(date_parse("@1711005151058451"));exit;

//array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

date_default_timezone_set('Asia/Tehran');
/*
$d = new \Khayyam\DateTime;
echo ($d->format('l Y-m-d H:i:s')) . PHP_EOL;
echo ($d->getTimestamp()) . PHP_EOL;

$d = new \Khayyam\DateTime;
echo ($d->modify('12 day')->format('l Y-m-d H:i:s')) . PHP_EOL;
echo ($d->getTimestamp()) . PHP_EOL;
*/
$d = new DateTime('2015-01-31');
echo ($d->format('Y-m-d H:i:s')) . PHP_EOL;
echo ($d->getTimestamp()) . PHP_EOL;

//$d = new DateTime();
echo ($d->modify('2 month')->format('Y-m-d H:i:s')) . PHP_EOL;
echo ($d->getTimestamp()) . PHP_EOL;



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