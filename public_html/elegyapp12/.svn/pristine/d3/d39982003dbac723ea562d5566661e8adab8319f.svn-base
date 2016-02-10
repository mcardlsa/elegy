var zChar = new Array(' ', '(', ')', '-', '.');
var maxphonelength = 14;
var phonevalue1;
var phonevalue2;
var cursorposition;

function ParseForNumber1(object){
  phonevalue1 = ParseChar(object.value, zChar);
}

function ParseForNumber2(object){
  phonevalue2 = ParseChar(object.value, zChar);
}

function backspacerUP(object,e) { 
  if(e){ 
    e = e 
  } else {
    e = window.event 
  } 
  if(e.which){ 
    var keycode = e.which 
  } else {
    var keycode = e.keyCode 
  }

  ParseForNumber1(object)

  if(keycode >= 48){
    ValidatePhone(object)
  }
}

function backspacerDOWN(object,e) { 
  if(e){ 
    e = e 
  } else {
    e = window.event 
  } 
  if(e.which){ 
    var keycode = e.which 
  } else {
    var keycode = e.keyCode 
  }
  ParseForNumber2(object)
} 

function GetCursorPosition(){

  var t1 = phonevalue1;
  var t2 = phonevalue2;
  var bool = false
  for (i=0; i<t1.length; i++)
  {
    if (t1.substring(i,1) != t2.substring(i,1)) {
      if(!bool) {
        cursorposition=i
        window.status=cursorposition
        bool=true
      }
    }
  }
}

function ValidatePhone(object){

  var p = phonevalue1

  p = p.replace(/[^\d]*/gi,"")

  if (p.length < 3) {
    object.value=p
  } else if(p.length==3){
    pp=p;
    d4=p.indexOf('(')
    d5=p.indexOf(')')
    if(d4==-1){
      pp="("+pp;
    }
    if(d5==-1){
      pp=pp+")";
    }
    object.value = pp;
  } else if(p.length>3 && p.length < 7){
    p ="(" + p; 
    l30=p.length;
    p30=p.substring(0,4);
    p30=p30+") " 

    p31=p.substring(4,l30);
    pp=p30+p31;

    object.value = pp; 

  } else if(p.length >= 7){
    p ="(" + p; 
    l30=p.length;
    p30=p.substring(0,4);
    p30=p30+") " 

    p31=p.substring(4,l30);
    pp=p30+p31;

    l40 = pp.length;
    p40 = pp.substring(0,9);
    p40 = p40 + "-"

    p41 = pp.substring(9,l40);
    ppp = p40 + p41;

    object.value = ppp.substring(0, maxphonelength);
  }

  GetCursorPosition()

  if(cursorposition >= 0){
    if (cursorposition == 0) {
      cursorposition = 2
    } else if (cursorposition <= 2) {
      cursorposition = cursorposition + 1
    } else if (cursorposition <= 4) {
      cursorposition = cursorposition + 3
    } else if (cursorposition == 5) {
      cursorposition = cursorposition + 3
    } else if (cursorposition == 6) { 
      cursorposition = cursorposition + 3 
    } else if (cursorposition == 7) { 
      cursorposition = cursorposition + 4 
    } else if (cursorposition == 8) { 
      cursorposition = cursorposition + 4
      e1=object.value.indexOf(')')
      e2=object.value.indexOf('-')
      if (e1>-1 && e2>-1){
        if (e2-e1 == 4) {
          cursorposition = cursorposition - 1
        }
      }
    } else if (cursorposition == 9) {
      cursorposition = cursorposition + 4
    } else if (cursorposition < 11) {
      cursorposition = cursorposition + 3
    } else if (cursorposition == 11) {
      cursorposition = cursorposition + 1
    } else if (cursorposition == 12) {
      cursorposition = cursorposition + 1
    } else if (cursorposition >= 13) {
      cursorposition = cursorposition
    }

    var txtRange = object.createTextRange();
    txtRange.moveStart( "character", cursorposition);
    txtRange.moveEnd( "character", cursorposition - object.value.length);
    txtRange.select();
  }

}

function ParseChar(sStr, sChar)
{

  if (sChar.length == null) 
  {
    zChar = new Array(sChar);
  }
    else zChar = sChar;

  for (i=0; i<zChar.length; i++)
  {
    sNewStr = "";

    var iStart = 0;
    var iEnd = sStr.indexOf(sChar[i]);

    while (iEnd != -1)
    {
      sNewStr += sStr.substring(iStart, iEnd);
      iStart = iEnd + 1;
      iEnd = sStr.indexOf(sChar[i], iStart);
    }
    sNewStr += sStr.substring(sStr.lastIndexOf(sChar[i]) + 1, sStr.length);

    sStr = sNewStr;
  }

  return sNewStr;
}

function numbersonly(e, decimal) 
{
				var key;
				var keychar;

				if (window.event) {
				   key = window.event.keyCode;
				}
				else if (e) {
				   key = e.which;
				}
				else {
				   return true;
				}
				keychar = String.fromCharCode(key);

				if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
				   return true;
				}
				else if ((("0123456789").indexOf(keychar) > -1)) {
				   return true;
				}
				else if (decimal && (keychar == ".")) { 
				  return true;
				}
				else
				   return false;
}

function validationfile(id)
            {
                var id_value = document.getElementById(id).value;
				 
				 if(id_value != '')
				 { 
				  var valid_extensions = /(.jpg|.jpeg|.gif|.png)$/i;   
				  if(!valid_extensions.test(id_value))
				  { 
				   alert('Only jpg,jpeg,gif and png file allowed');
				   //alert(valid_extensions.test(id_value));
				   return false;
				  }
				} 
                
            }
function CheckFirstChar(key, txt)
{
    if(key == 32 && txt.value.length<=0)
    {
        return false;
    }
    else if(txt.value.length>0)
    {
        if(txt.value.charCodeAt(0) == 32)
        {
            txt.value=txt.value.substring(1,txt.value.length);
            return true;
        }
    }
    return true;
}

 var checkContents = function(input) {
      var text = input.value;
      if(!/[a-zA-Z]/.test(text))
         input.value = ""; 
   }

 function letters_numbersOnly(evt) 
 {
 
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 31 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122) && (charCode > 31 && (charCode < 48 || charCode > 57))) {
          //alert("Enter letters and numbers only");
          return false;
       }
       return true;
}
   function letters_space_dotOnly(evt) {
   evt = (evt) ? evt : event;      
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :           ((evt.which) ? evt.which : 0));    
   if ((charCode > 32 || charCode > 46) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {          
   //alertWithoutNotice("Only Letters and space");        
   return false;         
   } 
   return true; 
   }
 function letters_numbers_spaceOnly(evt) 
 {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 32 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122) && (charCode > 32 && (charCode < 48 || charCode > 57))) {
          //alert("Enter letters,numbers and space only");
          return false;
       }
       return true;
}

function letters_numbers_somecharsOnly(evt) 
 {
	  
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 32 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122) && (charCode > 32 && (charCode < 44 || charCode > 57))  ) {
          //alertWithoutNotice("Only letters,numbers,space and .,/");
          return false;
       }
       return true;
}


function numeralsOnly(evt) {
       evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
           ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
           //alert("Enter numerals only in this field.");
           return false;
          }
           return true;
   }

   function phone_Only(evt) {

       evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
           ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 40) && (charCode != 46) && (charCode != 41) && (charCode != 43) && (charCode != 45) && (charCode != 47)) {
           //alert("Enter numerals only in this field.");
           return false;
          }
           return true;
   }
   
   function backspaceOnly(evt) {
   
       evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
           ((evt.which) ? evt.which : 0));
		  
        if (charCode > 8 || charCode < 8) {
           return false;
          }
           return true;
   }
   
   function letters_spaceOnly(evt) {
       evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
           ((evt.which) ? evt.which : 0));
        if (charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
           //alertWithoutNotice("Only Letters and space");
           return false;
          }
           return true;
   }
   
     function letters_space_with_otherchars_Only(evt) {
       evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
           ((evt.which) ? evt.which : 0));
        if (charCode > 32 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode != 40 ) && (charCode != 41 ) && (charCode != 39 ) && (charCode != 45 )) {
           //alertWithoutNotice("Only Letters and space");
           return false;
          }
           return true;
   }
   
   function check_file_size(id)
   {
				//---check file size-------------
				var file = document.getElementById(id).files[0];
				if(file.size > 1000000)
				{
					//alert( "name " +  file.name + "Size " +  file.size );
					alert( 'File size should be less than 1MB' );
					return false;
				}
				//---check file size-------------
   }
   
   
function alertWithoutNotice(message)
{
							setTimeout(function(){
								alert(message);
							}, 100);
}
	
function goback()
{
	window.history.go(-1);
}

/*function checkURL(value) {
    var urlregex = new RegExp("^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
    if (urlregex.test(value)) {
        return (true);
    }
    return (false);
}*/


function checkURL(value) {
	var re = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org|.edu|.gov|.int|.mil|.net|.org|.biz|.arpa|.info|.name|.pro|.aero|.coop|.museum]+(\[\?%&=]*)?/
	if (re.test(value)) {
        return (true);
    }
    return (false);
}

function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
  if (charCode != 46 && charCode > 31 
	&& (charCode < 48 || charCode > 57))
	 return false;

  return true;
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

function returnlocaltime(unixtime)
{
	var d = new Date()
	var offset= d.getTimezoneOffset();
	var exttime = unixtime-(offset*60);
	
	var unixtime = exttime;

	var newDate = new Date();
	newDate.setTime(unixtime * 1000);
	dateString = newDate.toUTCString();
	//document.write(dateString.substring(0,dateString.length-3));
	return dateString.substring(0,dateString.length-3);
}

//here birthday in yyyy-mm-dd format
var calculateAge = function(birthday) {
    var now = new Date();
    var past = new Date(birthday);
    var nowYear = now.getFullYear();
    var pastYear = past.getFullYear();
    var age = nowYear - pastYear;

    return age;
};

$(document).ready(function(){

$.fn.putCursorAtEnd = function() {

  return this.each(function() {

    $(this).focus()

    // If this function exists...
    if (this.setSelectionRange) {
      // ... then use it (Doesn't work in IE)

      // Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      var len = $(this).val().length * 2;

      this.setSelectionRange(len, len);
    
    } else {
    // ... otherwise replace the contents with itself
    // (Doesn't work in Google Chrome)

      $(this).val($(this).val());
      
    }

    // Scroll to the bottom, in case we're in a tall textarea
    // (Necessary for Firefox and Google Chrome)
    this.scrollTop = 999999;

  });

};

});