function startDateFormatFixed(input_date) {
    start_year          = input_date.getFullYear();
    start_month         = input_date.getMonth()+1;
    start_date          = input_date.getDate();
    start_hours         = input_date.getHours()-7;
    start_minutes       = input_date.getMinutes();
    start_seconds       = input_date.getSeconds();
    
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (start_hours < 0) {
        start_date  = start_date-1;
        start_hours = start_hours+24;
    }

    if (start_date < 10) {
      start_date = '0' + start_date;
    }
    if (start_month < 10) {
      start_month = '0' + start_month;
    }
    if (start_hours < 10) {
      start_hours = '0' + start_hours;
    }
    if (start_minutes < 10) {
      start_minutes = '0' + start_minutes;
    }
    if (start_seconds < 10) {
      start_seconds = '0' + start_seconds;
    }

    start_date_formatted = start_year+'-' + start_month + '-'+start_date+' '+start_hours+':'+start_minutes+':'+start_seconds;

    return start_date_formatted;
}

function FormatDate(input_date) {
    input_date  = new Date(input_date.setHours(input_date.getHours()-7));
    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth();
    formatted_date      = input_date.getDate();
    formatted_hours     = input_date.getHours();
    formatted_minutes   = input_date.getMinutes();
    formatted_seconds   = input_date.getSeconds();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }
    if (formatted_hours < 10) {
        formatted_hours = '0' + formatted_hours;
    }
    if (formatted_minutes < 10) {
        formatted_minutes = '0' + formatted_minutes;
    }
    if (formatted_seconds < 10) {
        formatted_seconds = '0' + formatted_seconds;
    }

    date_formatted = formatted_year+'-' + formatted_month + '-'+formatted_date+' '+formatted_hours+':'+formatted_minutes+':'+formatted_seconds;

    return date_formatted;
}

function startDateFormatFixedOnlyDate(input_date) {
    start_year          = input_date.getFullYear();
    start_month         = input_date.getMonth()+1;
    start_date          = input_date.getDate();
    start_hours         = input_date.getHours();
    start_minutes       = input_date.getMinutes();
    start_seconds       = input_date.getSeconds();
    
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (start_hours < 0) {
        start_date  = start_date-1;
        start_hours = start_hours+24;
    }

    if (start_date < 10) {
      start_date = '0' + start_date;
    }
    if (start_month < 10) {
      start_month = '0' + start_month;
    }
    if (start_hours < 10) {
      start_hours = '0' + start_hours;
    }
    if (start_minutes < 10) {
      start_minutes = '0' + start_minutes;
    }
    if (start_seconds < 10) {
      start_seconds = '0' + start_seconds;
    }

    start_date_formatted = start_year+'-' + start_month + '-'+start_date;

    return start_date_formatted;
}

function startDateFormatFixedOnlyTime(input_date) {
    start_year          = input_date.getFullYear();
    start_month         = input_date.getMonth()+1;
    start_date          = input_date.getDate();
    start_hours         = input_date.getHours();
    start_minutes       = input_date.getMinutes();
    start_seconds       = input_date.getSeconds();
    
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (start_hours < 0) {
        start_date  = start_date-1;
        start_hours = start_hours+24;
    }

    if (start_date < 10) {
      start_date = '0' + start_date;
    }
    if (start_month < 10) {
      start_month = '0' + start_month;
    }
    if (start_hours < 10) {
      start_hours = '0' + start_hours;
    }
    if (start_minutes < 10) {
      start_minutes = '0' + start_minutes;
    }
    if (start_seconds < 10) {
      start_seconds = '0' + start_seconds;
    }

    start_date_formatted = start_hours+':'+start_minutes+':'+start_seconds;

    return start_date_formatted;
}

function startDateFormatFixedWithoutGMT(input_date) {
    start_year          = input_date.getFullYear();
    start_month         = input_date.getMonth()+1;
    start_date          = input_date.getDate();
    start_hours         = input_date.getHours();
    start_minutes       = input_date.getMinutes();
    start_seconds       = input_date.getSeconds();
    
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (start_hours < 0) {
        start_date  = start_date-1;
        start_hours = start_hours+24;
    }

    if (start_date < 10) {
      start_date = '0' + start_date;
    }
    if (start_month < 10) {
      start_month = '0' + start_month;
    }
    if (start_hours < 10) {
      start_hours = '0' + start_hours;
    }
    if (start_minutes < 10) {
      start_minutes = '0' + start_minutes;
    }
    if (start_seconds < 10) {
      start_seconds = '0' + start_seconds;
    }

    start_date_formatted = start_year+'-' + start_month + '-'+start_date+' '+start_hours+':'+start_minutes+':'+start_seconds;

    return start_date_formatted;
}

function endDateFormatFixed(input_date) {
    end_year          = input_date.getFullYear();
    end_month         = input_date.getMonth()+1;
    end_date          = input_date.getDate();
    end_hours         = input_date.getHours()-7;
    end_minutes       = input_date.getMinutes();
    end_seconds       = input_date.getSeconds();
    
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (end_hours < 0) {
        end_date  = end_date-1;
        end_hours = end_hours+24;
    }

    if (end_date < 10) {
      end_date = '0' + end_date;
    }
    if (end_month < 10) {
      end_month = '0' + end_month;
    }
    if (end_hours < 10) {
      end_hours = '0' + end_hours;
    }
    if (end_minutes < 10) {
      end_minutes = '0' + end_minutes;
    }
    if (end_seconds < 10) {
      end_seconds = '0' + end_seconds;
    }

    end_date_formatted = end_year+'-' + end_month + '-'+end_date+' '+end_hours+':'+end_minutes+':'+end_seconds;

    return end_date_formatted;
}

function endDateFormatFixedWithoutGMT(input_date) {
    start_year          = input_date.getFullYear();
    start_month         = input_date.getMonth()+1;
    start_date          = input_date.getDate();
    start_hours         = input_date.getHours();
    start_minutes       = input_date.getMinutes();
    start_seconds       = input_date.getSeconds();
    
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (start_hours < 0) {
        start_date  = start_date-1;
        start_hours = start_hours+24;
    }

    if (start_date < 10) {
      start_date = '0' + start_date;
    }
    if (start_month < 10) {
      start_month = '0' + start_month;
    }
    if (start_hours < 10) {
      start_hours = '0' + start_hours;
    }
    if (start_minutes < 10) {
      start_minutes = '0' + start_minutes;
    }
    if (start_seconds < 10) {
      start_seconds = '0' + start_seconds;
    }

    start_date_formatted = start_year+'-' + start_month + '-'+start_date+' '+start_hours+':'+start_minutes+':'+start_seconds;

    return start_date_formatted;
}

function deactivateEndDateFormatFixed(input_date) {
    end_hours = input_date.getHours();
    // FIX HOURS WHEN THE FUNCTION IS USED AFTER 5PM
    if (end_hours < 17) {
        end_year          = input_date.getFullYear();
        end_month         = input_date.getMonth()+1;
        end_date          = input_date.getDate();
        end_hours         = input_date.getHours();
        end_minutes       = input_date.getMinutes();
        end_seconds       = input_date.getSeconds();
    }
    else {
        end_year          = input_date.getFullYear();
        end_month         = input_date.getMonth()+1;
        end_date          = input_date.getDate();
        end_hours         = input_date.getHours();
        end_minutes       = input_date.getMinutes();
        end_seconds       = input_date.getSeconds();
        end_hours         = end_hours+7;
    }

    if (end_date < 10) {
      end_date = '0' + end_date;
    }
    if (end_month < 10) {
      end_month = '0' + end_month;
    }
    if (end_hours < 10) {
      end_hours = '0' + end_hours;
    }
    if (end_minutes < 10) {
      end_minutes = '0' + end_minutes;
    }
    if (end_seconds < 10) {
      end_seconds = '0' + end_seconds;
    }

    end_date_formatted = end_year+'-' + end_month + '-'+end_date+' '+end_hours+':'+end_minutes+':'+end_seconds;

    return end_date_formatted;
}

// DECREASE ONE SECOND
function decreaseOneSecond(input_date) {
    end_year        = input_date.getFullYear();
    end_month       = input_date.getMonth()+1;
    end_date        = input_date.getDate();
    end_hours       = input_date.getHours();
    end_minutes     = input_date.getMinutes();
    end_seconds     = input_date.getSeconds();

    if (end_seconds = 0) {
        end_minutes = input_date.getMinutes()-1;
        end_seconds = input_date.getSeconds()+59;
    }
    else {
        end_seconds     = input_date.getSeconds()-1;
    }

    if (end_date < 10) {
      end_date = '0' + end_date;
    }
    if (end_month < 10) {
      end_month = '0' + end_month;
    }
    if (end_hours < 10) {
      end_hours = '0' + end_hours;
    }
    if (end_minutes < 10) {
      end_minutes = '0' + end_minutes;
    }
    if (end_seconds < 10) {
      end_seconds = '0' + end_seconds;
    }

    end_date_formatted = end_year+'-' + end_month + '-'+end_date+' '+end_hours+':'+end_minutes+':'+end_seconds;

    return end_date_formatted;
}

// DATE FORMAT FROM STRING
function dateStringFormat(input_date) {
    let currentYear     = input_date.substr(0, 4);
    let currentMonth    = input_date.substr(4, 2);
    let currentDate     = input_date.substr(6, 2);
    let currentHour     = input_date.substr(8, 2);
    let currentMinute   = input_date.substr(10, 2);
    let currentSecond   = input_date.substr(12, 2);
    let currentFormatted = currentYear+'-'+currentMonth+'-'+currentDate+' '+currentHour+':'+currentMinute+':'+currentSecond
    let momentDate      = moment(currentFormatted).toDate();

    return momentDate;
}

// DATE FORMAT ddmmyyyyhhmm
function dateformat_ddmmyyyyhhmm(input_date, separator, hour_separator, offset) {
    if (offset == 7) {
        input_date  = new Date(input_date);
    }
    else {
        input_date  = new Date(input_date.setHours(input_date.getHours()-7));
    }
    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth();
    formatted_date      = input_date.getDate();

    formatted_hour      = input_date.getHours();
    formatted_minute    = input_date.getMinutes();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    if (formatted_hour < 10) {
        formatted_hour = '0' + formatted_hour;
    }
    if (formatted_minute < 10) {
        formatted_minute = '0' + formatted_minute;
    }

    date_formatted = formatted_date+separator+formatted_month+separator+formatted_year+' '+formatted_hour+hour_separator+formatted_minute;

    return date_formatted;
}

// DATE FORMAT ddmmyyyyhhmmss
function dateformat_ddmmyyyyhhmmss_offset(input_date, date_separator, hour_separator, offset) {
    input_date  = new Date(input_date.setHours(input_date.getHours()+offset));
    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth();
    formatted_date      = input_date.getDate();

    formatted_hour      = input_date.getHours();
    formatted_minute    = input_date.getMinutes();
    formatted_second    = input_date.getSeconds();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    if (formatted_hour < 10) {
        formatted_hour = '0' + formatted_hour;
    }
    if (formatted_minute < 10) {
        formatted_minute = '0' + formatted_minute;
    }
    if (formatted_second < 10) {
        formatted_second = '0' + formatted_second;
    }

    date_formatted = formatted_date+date_separator+formatted_month+date_separator+formatted_year+' '+formatted_hour+hour_separator+formatted_minute+hour_separator+formatted_second;

    return date_formatted;
}

// DATE FORMAT ddmmyyyy
function dateformat_ddmmyyyy(input_date, separator) {
    input_date  = new Date(input_date.setHours(input_date.getHours()-7));
    input_date  = new Date(input_date.setMonth(input_date.getMonth()));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth()+1;
    formatted_date      = input_date.getDate();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    date_formatted = formatted_date+separator+formatted_month+separator+formatted_year;

    return date_formatted;
}

// CONVERT DATE FORMAT FROM DATE STRING dd/mm/yyyy to yyyymmdd with any separator
function dateformat_yyyymmdd(input_date, separator) {
    date_only   = input_date.substr(0, 2);
    month_only  = input_date.substr(3, 2);
    year_only   = input_date.substr(6, 4);
    input_date = new Date(month_only+'/'+date_only+'/'+year_only);

    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth();
    formatted_date      = input_date.getDate();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    date_formatted = formatted_year+separator+formatted_month+separator+formatted_date;

    return date_formatted;
}

// CONVERT DATE FORMAT to yyyymmdd without separator
function dateformat_yyyymmdd_without_separator(input_date) {
    input_date  = new Date(input_date.setHours(input_date.getHours()-7));
    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth();
    formatted_date      = input_date.getDate();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    date_formatted = formatted_year+formatted_month+formatted_date;

    return date_formatted;
}

// DATE FORMAT ddmm
function dateformat_ddmm(input_date, separator) {
    input_date  = new Date(input_date.setHours(input_date.getHours()-7));
    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_month     = input_date.getMonth();
    formatted_date      = input_date.getDate();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    date_formatted = formatted_date+separator+formatted_month;

    return date_formatted;
}

// DATE FORMAT mmyyyy
function dateformat_mmyyyy(input_date, separator) {
    input_date  = new Date(input_date.setHours(input_date.getHours()-7));
    input_date  = new Date(input_date.setMonth(input_date.getMonth()+1));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth();

    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }

    date_formatted = formatted_month+separator+formatted_year;

    return date_formatted;
}



// CONVERT DATE FORMAT FROM dmy to yyyy-mm-ddThh:mm WITH "-" SEPARATOR
function dateformat_dmytoymd(input_date) {
    date_only   = input_date.substr(0, 2);
    month_only  = input_date.substr(3, 2);
    year_only   = input_date.substr(6, 4);
    hour_only   = input_date.substr(11, 2);
    minute_only = input_date.substr(14, 2);

    date_formatted = year_only+'-'+month_only+'-'+date_only+'T'+hour_only+':'+minute_only+':00Z';
    date_formatted = new Date(date_formatted);
    date_formatted = new Date(date_formatted.setHours(date_formatted.getHours()-7));

    return date_formatted;
}

// CONVERT DATE FORMAT FROM dmy to yyyy-mm-ddThh:mm WITH "-" SEPARATOR
function dateformat_ddmmyyyyhhmmss(input_date, date_separator, time_separator) {
    // return input_date;
    input_date  = new Date(input_date.setHours(input_date.getHours()-7));

    formatted_year      = input_date.getFullYear();
    formatted_month     = input_date.getMonth()+1;
    formatted_date      = input_date.getDate();
    formatted_hour      = input_date.getHours();
    formatted_minute    = input_date.getMinutes();
    formatted_second    = input_date.getSeconds();

    if (formatted_date < 10) {
        formatted_date = '0' + formatted_date;
    }
    if (formatted_month < 10) {
        formatted_month = '0' + formatted_month;
    }
    if (formatted_hour < 10) {
        formatted_hour = '0' + formatted_hour;
    }
    if (formatted_minute < 10) {
        formatted_minute = '0' + formatted_minute;
    }
    if (formatted_second < 10) {
        formatted_second = '0' + formatted_second;
    }

    date_formatted = formatted_date+date_separator+formatted_month+date_separator+formatted_year+' '+formatted_hour+time_separator+formatted_minute+time_separator+formatted_second;

    return date_formatted;
}