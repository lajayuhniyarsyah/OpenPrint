<?php

namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


class NumericLib extends Component{
	public function convertToWords($number,$to)
	{
		if(strtolower($to)=='idr')
		{
			$ret = $this->convertToBahasa($number);
		}
		else
		{
			$ret = $this->convertToEnglish($number);
		}
		return $ret;
	}

	public function convertToBahasa($angka)
	{
	    $angka = (float)$angka;
	    $bilangan = array('','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan','sepuluh','sebelas');
	    if ($angka < 12) {
	        return $bilangan[$angka];
	    } else if ($angka < 20) {
	        return $bilangan[$angka - 10] . ' belas';
	    } else if ($angka < 100) {
	        $hasil_bagi = (int)($angka / 10);
	        $hasil_mod = $angka % 10;
	        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
	    } else if ($angka < 200) {
	        return sprintf('seratus %s', $this->convertToBahasa($angka - 100));
	    } else if ($angka < 1000) {
	        $hasil_bagi = (int)($angka / 100);
	        $hasil_mod = $angka % 100;
	        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], $this->convertToBahasa($hasil_mod)));
	    } else if ($angka < 2000) {
	        return trim(sprintf('seribu %s', $this->convertToBahasa($angka - 1000)));
	    } else if ($angka < 1000000) {
	        $hasil_bagi = (int)($angka / 1000);
	        $hasil_mod = $angka % 1000;
	        return sprintf('%s ribu %s', $this->convertToBahasa($hasil_bagi), $this->convertToBahasa($hasil_mod));
	    } else if ($angka < 1000000000) {
	        $hasil_bagi = (int)($angka / 1000000);
	        $hasil_mod = $angka % 1000000;
	        return trim(sprintf('%s juta %s', $this->convertToBahasa($hasil_bagi), $this->convertToBahasa($hasil_mod)));
	    } else if ($angka < 1000000000000) {
	        $hasil_bagi = (int)($angka / 1000000000);
	        $hasil_mod = fmod($angka, 1000000000);
	        return trim(sprintf('%s milyar %s', $this->convertToBahasa($hasil_bagi), $this->convertToBahasa($hasil_mod)));
	    } else if ($angka < 1000000000000000) {
	        $hasil_bagi = $angka / 1000000000000;
	        $hasil_mod = fmod($angka, 1000000000000);
	        return trim(sprintf('%s triliun %s', $this->convertToBahasa($hasil_bagi), $this->convertToBahasa($hasil_mod)));
	    } else {
	        return 'Wow...';
	    }
	}

	public function convertToEnglish($number)
	{
		$hyphen      = ' ';
		$conjunction = ' ';
		$separator   = ' ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
		    0                   => 'zero',
		    1                   => 'one',
		    2                   => 'two',
		    3                   => 'three',
		    4                   => 'four',
		    5                   => 'five',
		    6                   => 'six',
		    7                   => 'seven',
		    8                   => 'eight',
		    9                   => 'nine',
		    10                  => 'ten',
		    11                  => 'eleven',
		    12                  => 'twelve',
		    13                  => 'thirteen',
		    14                  => 'fourteen',
		    15                  => 'fifteen',
		    16                  => 'sixteen',
		    17                  => 'seventeen',
		    18                  => 'eighteen',
		    19                  => 'nineteen',
		    20                  => 'twenty',
		    30                  => 'thirty',
		    40                  => 'fourty',
		    50                  => 'fifty',
		    60                  => 'sixty',
		    70                  => 'seventy',
		    80                  => 'eighty',
		    90                  => 'ninety',
		    100                 => 'hundred',
		    1000                => 'thousand',
		    1000000             => 'million',
		    1000000000          => 'billion',
		    1000000000000       => 'trillion',
		    1000000000000000    => 'quadrillion',
		    1000000000000000000 => 'quintillion'
		);

		if (!is_numeric($number)) {
		    return false;
		}

		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		    // overflow
		    trigger_error(
		        'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
		        E_USER_WARNING
		    );
		    return false;
		}

		if ($number < 0) {
		    return $negative . $this->$this->convertToEnglish(abs($number));
		}

		$string = $fraction = null;

		if (strpos($number, '.') !== false) {
		    list($number, $fraction) = explode('.', $number);
		}

		switch (true) {
		    case $number < 21:
		        $string = $dictionary[$number];
		        break;
		    case $number < 100:
		        $tens   = ((int) ($number / 10)) * 10;
		        $units  = $number % 10;
		        $string = $dictionary[$tens];
		        if ($units) {
		            $string .= $hyphen . $dictionary[$units];
		        }
		        break;
		    case $number < 1000:
		        $hundreds  = $number / 100;
		        $remainder = $number % 100;
		        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		        if ($remainder) {
		            $string .= $conjunction . $this->convertToEnglish($remainder);
		        }
		        break;
		    default:
		        $baseUnit = pow(1000, floor(log($number, 1000)));
		        $numBaseUnits = (int) ($number / $baseUnit);
		        $remainder = $number % $baseUnit;
		        $string = $this->convertToEnglish($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		        if ($remainder) {
		            $string .= $remainder < 100 ? $conjunction : $separator;
		            $string .= $this->convertToEnglish($remainder);
		        }
		        break;
		}

		if (null !== $fraction && is_numeric($fraction)) {
		   
		    // $words = array();
		    // echo '----------='.$string.'===============';
		    // foreach (str_split((string) $fraction) as $number) {
		    //     $words[] = $dictionary[$number];
		    // }

		    $string_decimal = '';
		    if($fraction != '00'){
		    	$string .= $decimal;
		    	$number = $fraction;

				switch (true) {
				    case $number < 21:

					    if ($number[0] == 0){
			    			for ($i=0; $i < 2; $i++) { 
					    		$string_decimal .= ' '. $dictionary[$number[$i]];
					    	}
				    	}else{
				    		$string_decimal = $dictionary[$number];
				    	}
				    	
				        break;
				    case $number < 100:
				        $tens   = ((int) ($number / 10)) * 10;
				        $units  = $number % 10;
				        $string_decimal = $dictionary[$tens];
				        if ($units) {
				            $string_decimal .= $hyphen . $dictionary[$units];
				        }
				        break;
				    case $number < 1000:
				        $hundreds  = $number / 100;
				        $remainder = $number % 100;
				        $string_decimal = $dictionary[$hundreds] . ' ' . $dictionary[100];
				        if ($remainder) {
				            $string_decimal .= $conjunction . $this->convertToEnglish($remainder);
				        }
				        break;
				    default:
				        $baseUnit = pow(1000, floor(log($number, 1000)));
				        $numBaseUnits = (int) ($number / $baseUnit);
				        $remainder = $number % $baseUnit;
				        $string_decimal = $this->convertToEnglish($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				        if ($remainder) {
				            $string_decimal .= $remainder < 100 ? $conjunction : $separator;
				            $string_decimal .= $this->convertToEnglish($remainder);
				        }
				        break;
				}
				$string .= $string_decimal.' Cents Only';
			}
			else{
				$string .= $string_decimal.' Only';	
			}
		    
		}

		return $string;
	}

	/*public function indoStyle($numeric){
		return number_format($numeric,2,',','.');
	}*/

	public function indoStyle($numeric,$decimalDigit=2,$thousandSep='.',$decimalSep=','){
		$formatted = number_format(floatval($numeric),$decimalDigit,$decimalSep,$thousandSep);
		$exp = explode($decimalSep, $formatted);
		if(isset($exp[1]) && $exp[1]=='00'){
			$formatted = trim($exp[0]);
		}
		return $formatted;
	}

	public function westStyle($numeric,$decimalDigit=2,$thousandSep=',',$decimalSep='.',$showPointZero=false){
		$formatted = number_format(floatval($numeric),$decimalDigit,$decimalSep,$thousandSep);
		/*if(!$showPointZero){
			$exp = explode($decimalSep, $formatted);
			if($exp[1]=='00'){
				$formatted = trim($exp[0]).'.-&nbsp;&nbsp;';
			}
		}*/
		
		return $formatted;
	}
}
?>