<?php
    function DateDiff(DateTime $d1, DateTime $d2, $s)
    {
        //$interval = $d1->diff($d2);
		$interval = date_diff($d1, $d2);
        
        $days =  $interval->format("%R%d");
        $months =  $interval->format("%R%m");
        $years =  $interval->format("%R%y");
        
        $hours =  $interval->format("%R%h");
        $miniutes =  $interval->format("%R%i");
        $seconds =  $interval->format("%R%s");
        
        //echo "$days days $months months $years years _ $hours $miniutes $seconds<br>";
        
        if ($d2 > $d1)
            $sign = 1;
        else
            $sign = -1;
            
        switch ($s)
        {
            case "s":
                return ($seconds + $miniutes*60 + $hours*3600 + $days*24*3600 + $months*30*24*3600 + $years*365*24*3600)*$sign;
                break;
            case "m":
                return ($seconds/60 + $miniutes + $hours*60 + $days*24*60 + $months*30*24*60 + $years*365*24*60)*$sign;
                break;
            case "h":
                return ($seconds/3600 + $miniutes/60 + $hours + $days*24 + $months*30*24 + $years*365*24)*$sign;
                break;
            case "d":
                return ($seconds/3600/24 + $miniutes/60/24 + $hours/24 + $days + $months*30 + $years*365)*$sign;
                break;
            case "M":
                return ($seconds/3600/24/30 + $miniutes/60/24/30 + $hours/24/30 + $days/30 + $months + $years*12)*$sign;
                break;
            case "Y":
                return ($seconds/3600/24/365 + $miniutes/60/24/365 + $hours/24/365 + $days/365 + $months/12 + $years)*$sign;
                break;                
        }
    }
	
	if(!function_exists('date_diff')) {
    class DateInterval {
        public $y;
        public $m;
        public $d;
        public $h;
        public $i;
        public $s;
        public $invert;
       
        public function format($format) {
            $format = str_replace('%R%y', ($this->invert ? '-' : '+') . $this->y, $format);
            $format = str_replace('%R%m', ($this->invert ? '-' : '+') . $this->m, $format);
            $format = str_replace('%R%d', ($this->invert ? '-' : '+') . $this->d, $format);
            $format = str_replace('%R%h', ($this->invert ? '-' : '+') . $this->h, $format);
            $format = str_replace('%R%i', ($this->invert ? '-' : '+') . $this->i, $format);
            $format = str_replace('%R%s', ($this->invert ? '-' : '+') . $this->s, $format);
           
            $format = str_replace('%y', $this->y, $format);
            $format = str_replace('%m', $this->m, $format);
            $format = str_replace('%d', $this->d, $format);
            $format = str_replace('%h', $this->h, $format);
            $format = str_replace('%i', $this->i, $format);
            $format = str_replace('%s', $this->s, $format);
           
            return $format;
        }
    }

    function date_diff(DateTime $date1, DateTime $date2) {
        $diff = new DateInterval();
        if($date1 > $date2) {
            $tmp = $date1;
            $date1 = $date2;
            $date2 = $tmp;
            $diff->invert = true;
        }
       
        $diff->y = ((int) $date2->format('Y')) - ((int) $date1->format('Y'));
        $diff->m = ((int) $date2->format('n')) - ((int) $date1->format('n'));
        if($diff->m < 0) {
            $diff->y -= 1;
            $diff->m = $diff->m + 12;
        }
        $diff->d = ((int) $date2->format('j')) - ((int) $date1->format('j'));
        if($diff->d < 0) {
            $diff->m -= 1;
            $diff->d = $diff->d + ((int) $date1->format('t'));
        }
        $diff->h = ((int) $date2->format('G')) - ((int) $date1->format('G'));
        if($diff->h < 0) {
            $diff->d -= 1;
            $diff->h = $diff->h + 24;
        }
        $diff->i = ((int) $date2->format('i')) - ((int) $date1->format('i'));
        if($diff->i < 0) {
            $diff->h -= 1;
            $diff->i = $diff->i + 60;
        }
        $diff->s = ((int) $date2->format('s')) - ((int) $date1->format('s'));
        if($diff->s < 0) {
            $diff->i -= 1;
            $diff->s = $diff->s + 60;
        }
       
        return $diff;
    }
}

    
    function ConvertToNewsDateFormat($myDate)
    {
        $newsDate = new DateTime($myDate);
        $day = $newsDate->format("d");
        $month = $newsDate->format("m");
        $year = $newsDate->format("Y");
        
        $newsDateFormat = "";
        $newsDateFormat.= '<table width="50" border="0" class="tabledate">';
        $newsDateFormat.= '     <tr>';
        $newsDateFormat.= '         <td class="date">'.$day.'</td>';
        $newsDateFormat.= '         <td class="year" rowspan="2">'.$year.'</td>';
        $newsDateFormat.= '     </tr>';
        $newsDateFormat.= '     <tr>';
        $newsDateFormat.= '         <td class="month">'.$month.'</td>';
        $newsDateFormat.= '     </tr>';
        $newsDateFormat.= '</table>';
        
        return $newsDateFormat;
    }
    
    function SplitDateValue($myDate, &$day, &$month, &$year)
    {
        $newsDate = new DateTime($myDate);
        $day = $newsDate->format("d");
        $month = $newsDate->format("m");
        $year = $newsDate->format("Y");
    }
    
    function CurrentDateTimeFileName()
    {
        $currentDate = new DateTime(date("now"));
        return $currentDate->format("Ymd-his");
    }
    
    function CurrentDateTimeString()
    {
        $currentDate = new DateTime(date("now"));
        return $currentDate->format("Y-m-d h:i:s");
    }
?>