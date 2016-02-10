
function TimeZoneCookie()
{
 var u_gmt = (-(new Date().getTimezoneOffset()))/60;
 var o_date = new Date("December 31, 2025");
 var v_cookie_date = o_date.toGMTString();
 var str_cookie = "utimezone="+u_gmt;
 str_cookie += ";expires=" + v_cookie_date;
 document.cookie=str_cookie;
}
TimeZoneCookie();
