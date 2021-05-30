<?php
    function getMonthName($monthNum) {
        switch ($monthNum) {
            case '1':
                $monthName = 'January';
                break;
            case '2':
                $monthName = 'February';
                break;
            case '3':
                $monthName = 'March';
                break;
            case '4':
                $monthName = 'April';
                break;
            case '5':
                $monthName = 'May';
                break;
            case '6':
                $monthName = 'June';
                break;
            case '7':
                $monthName = 'July';
                break;
            case '8':
                $monthName = 'August';
                break;
            case '9':
                $monthName = 'September';
                break;
            case '10':
                $monthName = 'October';
                break;
            case '11':
                $monthName = 'November';
                break;
            case '12':
                $monthName = 'December';
                break;    
          }  
          return $monthName;
    }
    function getYear($date) {
        $date = explode('-', $date);
        return $date[0];
    }
    function getMonth($date) {
        $date = explode('-', $date);
        return $date[1];
    }
    function getDay($date) {
        $date = explode('-', $date);
        return $date[2];
    }
    function getHour($time) {
        $time = explode(':', $time);
        return $time[0];
    }
    function getMinute($time) {
        $time = explode(':', $time);
        return $time[1];
    }
    function getDateOnly($dateTime) {
        $dateTime = explode(' ', $dateTime);
        return $dateTime[0];
    }
    function getTimeOnly($dateTime) {
        $dateTime = explode(' ', $dateTime);
        $time = $dateTime[1];
        $time = explode(':', $time);
        return $time[0] . ':' . $time[1];
    }

    function getDetailDateTime($dateTime) {
        $date = getDateOnly($dateTime);
        $time = getTimeOnly($dateTime);
        $detailDateTime['year'] = getYear($date);
        $detailDateTime['day'] = getDay($date);
        $detailDateTime['hour'] = getHour($time);
        $detailDateTime['minute'] = getMinute($time);
        return $detailDateTime;
    }

    function getCurDateTime($conn) {
        $stmt = $conn->query("SELECT CURRENT_TIMESTAMP() as 'CurDateTime'");
        $res = $stmt->fetch_assoc();
        return $res['CurDateTime'];
    }
?>