<?php

namespace Khayyam;

class Convert
{
	function equationOfTime($jd)
	{
	    $alpha, $deltaPsi, $E, $epsilon, $L0, $tau;

	    $tau = ($jd - J2000) / JulianMillennium;
	//document.debug.log.value += "equationOfTime.  tau = " + tau + "\n";
	    $L0 = 280.4664567 + (360007.6982779 * tau) +
	         (0.03032028 * $tau * $tau) +
	         (($tau * $tau * $tau) / 49931) +
	         (-(($tau * $tau * $tau * $tau) / 15300)) +
	         (-(($tau * $tau * $tau * $tau * $tau) / 2000000));
	//document.debug.log.value += "L0 = " + L0 + "\n";
	    $L0 = fixangle($L0);
	//document.debug.log.value += "L0 = " + L0 + "\n";
	    $alpha = sunpos($jd)[10];
	//document.debug.log.value += "alpha = " + alpha + "\n";
	    $deltaPsi = nutation($jd)[0];
	//document.debug.log.value += "deltaPsi = " + deltaPsi + "\n";
	    $epsilon = obliqeq($jd) + nutation($jd)[1];
	//document.debug.log.value += "epsilon = " + epsilon + "\n";
	    $E = $L0 + (-0.0057183) + (-$alpha) + ($deltaPsi * dcos($epsilon));
	//document.debug.log.value += "E = " + E + "\n";
	    $E = $E - 20.0 * (floor($E / 20.0));
	//document.debug.log.value += "Efixed = " + E + "\n";
	    $E = $E / (24 * 60);
	//document.debug.log.value += "Eday = " + E + "\n";

	    return $E;
	}

	function tehran_equinox($year)
	{
	    $equJED, $equJD, $equAPP, $equTehran, $dtTehran;

	    //  March equinox in dynamical time
	    $equJED = equinox($year, 0);

	    //  Correct for delta T to obtain Universal time
	    $equJD = $equJED - (deltat($year) / (24 * 60 * 60));

	    //  Apply the equation of time to yield the apparent time at Greenwich
	    $equAPP = $equJD + equationOfTime($equJED);

	    /*  Finally, we must correct for the constant difference between
	        the Greenwich meridian andthe time zone standard for
		Iran Standard time, 52°30' to the East.  */

	    $dtTehran = (52 + (30 / 60.0) + (0 / (60.0 * 60.0))) / 360;
	    $equTehran = $equAPP + $dtTehran;

	    return $equTehran;
	}


	/*  TEHRAN_EQUINOX_JD  --  Calculate Julian day during which the
	                           March equinox, reckoned from the Tehran
	                           meridian, occurred for a given Gregorian
	                           year.  */

	function tehran_equinox_jd(year)
	{
	    var ep, epg;

	    ep = tehran_equinox(year);
	    epg = Math.floor(ep);

	    return epg;
	}


	function persiana_year($jd)
	{
	    $guess = jd_to_gregorian($jd)[0] - 2,
	        $lasteq, $nexteq, $adr;

	    $lasteq = tehran_equinox_jd($guess);
	    while ($lasteq > $jd) {
	        $guess--;
	        $lasteq = tehran_equinox_jd($guess);
	    }
	    $nexteq = $lasteq - 1;
	    while (!(($lasteq <= $jd) && ($jd < $nexteq))) {
	        $lasteq = $nexteq;
	        $guess++;
	        $nexteq = tehran_equinox_jd($guess);
	    }
	    $adr = Math.round(($lasteq - PERSIAN_EPOCH) / TropicalYear) + 1;

	    return array($adr, $lasteq);
	}




	public function jd_to_persiana($jd)
	{
	    $year, $month, $day,
	        $adr, $equinox, $yday;

	    $jd = $floor($jd) + 0.5;
	    $adr = persiana_year($jd);
	    $year = $adr[0];
	    $equinox = $adr[1];
	    $day = floor(($jd - $equinox) / 30) + 1;
	    
	    $yday = (floor(jd) - persiana_to_jd($year, 1, 1)) + 1;
	    $month = ($yday <= 186) ? ceil($yday / 31) : ceil(($yday - 6) / 30);
	    $day = (floor($jd) - persiana_to_jd($year, $month, 1)) + 1;

	    return array($year, $month, $day);
	}

/*  PERSIANA_TO_JD  --  Obtain Julian day from a given Persian
                    	astronomical calendar date.  */

	public function persiana_to_jd($year, $month, $day)
	{
	    $adr, $equinox, $guess, $jd;

	    $guess = (PERSIAN_EPOCH - 1) + (TropicalYear * (($year - 1) - 1));
	    $adr = new Array($year - 1, 0);

	    while ($adr[0] < $year) {
	        $adr = persiana_year($guess);
	        $guess = $adr[1] + (TropicalYear + 2);
	    }
	    $equinox = $adr[1];

	    $jd = $equinox +
	            (($month <= 7) ?
	                (($month - 1) * 31) :
	                ((($month - 1) * 30) + 6)
	            ) +
	    	    ($day - 1);
	    return $jd;
	}

/*  LEAP_PERSIANA  --  Is a given year a leap year in the Persian
    	    	       astronomical calendar ?  */

	public function leap_persiana($year)
	{
	    return (persiana_to_jd($year + 1, 1, 1) -
	    	    persiana_to_jd($year, 1, 1)) > 365;
	}

}