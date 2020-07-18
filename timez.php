<?php
    timeconvtoIST("2000-02-28 15:29:54");
    function timeconvtoIST($s){
        //$s="2020-03-31 15:29:54";
        $h = substr($s,11,2);
        $a= intval($h)+9;
        $m = substr($s,14,2);
        $b = intval($m)+30;
        $date = substr($s,0,10);
        $sec = substr($s,17,2);
        //$c = intval($d);
        if($b>60){
            $b=numto30($b);
            $a=$a+1;
            if($a>=24){
                $a=numto12($a);
                $date = sumondate($date);
            }
        }
        elseif($b<60){
            if($a>=24){
                $a=numto12($a);
                $date = sumondate($date);
            }
        }
        $ist= $date.' '.$a.':'.$b.':'.$sec;
        echo $ist;
    }      
    function numto12(int $val){
        for ($x = 0; $x < 9; $x++) {
            if($val-24==$x){
                $y='0'.strval($x);
                 echo "The hour is: $y <br>";
                 return $y;       
            }
        }
    }
    function numto30(int $val){
        for ($x = 0; $x < 30; $x++) {
            if($val-60==$x){
                $y=addstr0($x);
                 echo "The minute is: $y <br>";
                 return $y;       
            }
        }
    }
    function addstr0($x){//adds '0' to single digits.
        if($x<10){
            $y='0'.strval($x);
        }
        else{
            $y=$x;
        }
        return $y;
    }
    function sumondate($str){
        //$str=2020-07-17
        $day= substr($str,8,2);
        $month = substr($str,5,2);
        $year = substr($str,0,4);
        $p = intval($day)+1;
        $q = intval($month);
        $r = intval($year);
        $leap = leapcheck($r);//Checking Leap year
        // months with 30 days == 04, 06, 09, 11.
        // months with 31 days == 01, 03, 05, 07, 08, 10, 12.
        if( $q==4 ||  $q==6 ||  $q==9 ||  $q==11 ){// months with 30 days
            if($p>30){
                $p=1;
                $p=addstr0($p);
                $q=$q+1;
                $q=addstr0($q);
            }
            else{
                $q=addstr0($q);
            }
        }
        else if( $q==2 && $leap==0){//feb
            if($p>28){
                $p=1;
                $p=addstr0($p);
                $q=$q+1;
                $q=addstr0($q);
            }
            else{
                $q=addstr0($q);
            }
        }
        else{
            if($p>31){//months with 31days & also works for a Leap year(Feb 29)
                $p=1;
                $p=addstr0($p);
                $q=$q+1;
                if($q>12){
                    $q=1;
                    $r=$r+1;
                }
                $q=addstr0($q);
            }
            else{
                $q=addstr0($q);
            }
        }
        $newdate = $r.'-'.$q.'-'.$p;
        return $newdate;

    }
    function leapcheck($yr){
        if ((($yr % 4 == 0) && ($yr % 100!= 0)) || ($yr%400 == 0)){
            return 1;
        }
        else
            return 0;
    }
?>
<html>
<head>
<title>Time Conversion</title>
</head>
<body>
</body>
</html>