/* Configuration */

var local_server = '/';

var window_path = window.location.pathname;
var session_token = $('input[name=session_token]').val();
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var confirmation_add = 'Are you sure you want to add these data?';
var confirmation_edit = 'Are you sure you want to update these data?';
var confirmation_delete = 'Are you sure you want to delete these data?';
var confirmation_generate = 'Are you sure you want to generate card for these data?';
var confirmation_activate = 'Are you sure you want to activate these card?';
var confirmation_deactivate = 'Are you sure you want to deactivate these card?';
var confirmation_block = 'Are you sure you want to block these card?';
var confirmation_generate_pin = 'Are you sure you want to generate PIN for these card?';
var confirmation_generate_perso = 'Are you sure you want to generate Perso File right now?';
var confirmation_generate_report_xls = 'Are you sure you want to generate Report to Excel File?';
var confirmation_generate_report_pdf = 'Are you sure you want to generate Report to PDF?';
var confirmation_approve_account = 'Are you sure you want to approve this Account?';
var confirmation_reject_account = 'Are you sure you want to reject this Account?';
var confirmation_reset_password = 'Are you sure you want to reset the password of selected user?';
var confirmation_migrate = 'Are you sure you want to migrate selected cards?';
var confirmation_replace = 'Are you sure you want to replace selected card?';

function pad(n) {
    return (n < 10) ? ("0" + n) : n;
}

function strip_tags(str) {
    str = str.toString();
    return str.replace(/<\/?[^>]+>/gi, '');
}

function addCommas(n) {
    n = n.replace(/,/g, '');
    var s = n.split('.')[1];
    (s)
        ? s = '.' + s
        : n.indexOf('.') >= 0
            ? s = '.'
            : s = '';
    n = n.split('.')[0];
    while (n.length > 3) {
        s = ',' + n.substr(n.length - 3, 3) + s;
        n = n.substr(0, n.length - 3);
    }
    return n + s;
}

function postCommas(n){
	return n.replace(/,/g,'');
}

function addComasStatic(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function addCommasDot(n) {
    n = n.replace(/\./g, '');
    var s = n.split(',')[1];
    (s)
        ? s = ',' + s
        : n.indexOf(',') >= 0
            ? s = ','
            : s = '';
    n = n.split(',')[0];
    while (n.length > 3) {
        s = '.' + n.substr(n.length - 3, 3) + s;
        n = n.substr(0, n.length - 3);
    }
    return n + s;
}

function postCommasDot(n){
  return n.replace(/,/g,'.');
}

function addComasStaticDot(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function checkNA(str) {
   if(str == '-1'){
	   return 'N/A';
   }
   else{
	   return str;
   }
}

function postCheckNA(str) {
   if(str == 'N/A'){
	   return '-1';
   }
   else{
	   return str;
   }
}

function checkNull(str){
	if(str == 'null'){
		return '';
	}
	else{
		return str;
	}
}

function url_exists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}