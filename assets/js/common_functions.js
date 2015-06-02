
function previewPage(sectionId, pageId) {
	openWindow('/managePages/'+sectionId+'/preview/'+pageId,1024,768);
}

/**
 * Limits the length of text displayed and attaches a elipsis
 * if longer than the length specified
 */
function more(strVar, dspLen) {
    var outStr = strVar.substr(0, dspLen);
    if (outStr == strVar) {
    } else {
    	// We lost something on the substring
    	var strLen = outStr.length;
    	if (strLen > 3) {
    		// Find the last space and add an elipsis to it        		
    		var lastSpace = outStr.lastIndexOf(' ');
    		outStr = (outStr.substr(0, lastSpace)+' &hellip;');
    	}        	
    }
    return outStr;
}

function escapeTinyMceString(elemId) {
	var escStr = tinyMCE.get(elemId).getContent();
	var div = document.createElement('div');
	var text = document.createTextNode(escStr);
	div.appendChild(text);
	return div.innerHTML;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function logout(url)
{
	var answer = confirm("Are you sure you want to logout?");
	if(answer)
	{
		PostForm(url,'');
	}
}

function PostSortEvent(event,sortBy,order)
{
	//alert(event + " , " + sortBy + " " + order);
	document.getElementById('hidEvent').value=event;
	document.getElementById('sortBy').value=sortBy;
	document.getElementById('order').value=order;
	document.frm.submit();
}

function PostForm(formaction,event)
{
	if(formaction!="")
	{
		document.frm.action=formaction;
	}
	document.getElementById('hidEvent').value=event;
	document.frm.submit();

}

function PostOnConfirm(msg, action)
{
	if (confirm(msg)) {
		document.frm.action = action;
		document.frm.submit();
	}
	return false;
}

function PostBack(event)
{
	document.getElementById('hidArguments').value="";
    var sep = '';
    // Examine all subsequent arguments, if any, and add them as a csv
	for (var i=1; i<arguments.length; i++) {
		document.getElementById('hidArguments').value += (sep+arguments[i]);
        sep = ',';
	}
	document.getElementById('hidEvent').value = event;
    var frm  = document.getElementById('frm');
    if (frm) {
        frm.action = '';
	    frm.submit();
    } else {
        alert('Could not find form');
    }
}

function PostForm(action, event)
{
    document.getElementById('hidArguments').value="";
    var sep = '';
    // Examine all subsequent arguments, if any, and add them as a csv
    for (var i=2; i<arguments.length; i++) {
        document.getElementById('hidArguments').value += (sep+arguments[i]);
        sep = ',';
    }
	document.getElementById('hidEvent').value = event;
    var frm  = document.getElementById('frm');
    if (frm) {
        frm.action = action;
        frm.submit();
    } else {
        alert('Could not find form');
    }
}

function Delete(arg)
{
if(confirm('Are you sure you want to delete'))
 window.location=arg;
}
function confirmDeletion()
{
if(confirm('Are you sure you want to delete?'))
return true;
else
return false;
}

function confirmAction($value)
	{
		if($value=='0')
		{
			if(confirm('Are you sure you want to make this record inactive.'))
				return true;
			else
				return false;
		}
		if($value=='1')
		{
			if(confirm('Are you sure you want to make this record active.'))
				return true;
			else
				return false;
		}
	}
function  first()
{
	document.getElementById('txtPageSize1').value = document.getElementById('txtPageSize').value;
	
}
function second()
{

	document.getElementById('txtPageSize').value = document.getElementById('txtPageSize1').value;
}
function  download($filename)
{
	alert($filename);
	var arg="admin/Assets/Download/";
	document.getElementById('hid_download').value=$filename;
		document.frm.action=arg;
	
	document.frm.submit();
}
   
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
         }
         return true;
      }
function textCounter(field,maxlimit) {
    if (field.value.length > maxlimit) { // if too long...trim it!
        field.value = field.value.substring(0, maxlimit);
    }
    // otherwise, update 'characters left' counter
}
function TinyMce()
{

tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "style,table,paste",
		editor_selector : "wysiwyg",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_toolbar_align : "left",
		theme_advanced_toolbar_location : "top",
		paste_use_dialog : false,
		paste_auto_cleanup_on_paste : true,
		theme_advanced_buttons1 : "bold,italic,underline,bullist,numlist,link,hr,formatselect",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_blockformats : "p,h2,h3",
		valid_elements : "a[href|target=_blank],strong/b,em/i,div[align],br,p,h1,h2,h3,h4,ul,ol,li,hr"
		});
	
}




function TinyMceFull()
{
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		width : "50%",
		height : "400",
		plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_toolbar_align : "left",
		theme_advanced_toolbar_location : "top",
		paste_use_dialog : false,
		force_p_newlines : false,
		force_br_newlines : true,
		paste_auto_cleanup_on_paste : true,
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
		theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo",
		theme_advanced_buttons4 : "link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons5 : "tablecontrols,|,hr,removeformat,visualaid",
		theme_advanced_buttons6 : "sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker",
		theme_advanced_blockformats : "p,h2,h3"
		
		});
	
}

//***************************//
/// Form validator class    ///
//***************************//
function formValidator() {
	// Data Members
	this.firstErrorElement = null;
	this.errorMsg = "At least one error was encountered:";
	this.errors = new Array();

	// Methods
	this.displayErrors = displayErrors;
	this.raiseError = raiseError;
	this.isError = isError;
	this.setFocusToFirstError = setFocusToFirstError;
}
function displayErrors() {
	var cr = "\n";
	var msgToDisplay = this.errorMsg;
	for (var i=0; i<this.errors.length; i++) {
		msgToDisplay += (cr + this.errors[i]);
	}
	alert(msgToDisplay);
}
function raiseError(errorMsg, errorElement) {
	this.errors[this.errors.length] = errorMsg;
	if (this.firstErrorElement == null) {
		this.firstErrorElement = errorElement;
	}
}
function isError() {
	return (this.errors.length > 0);
}
function setFocusToFirstError() {
	if (this.firstErrorElement != null) {
		this.firstErrorElement.focus();
	}
}

function validDateRange(fromDateId, toDateId, errorMsg) {
  // Validates a date range to ensure toDate is after fromDate.
  // NB See where used.
  var fromDate = getDateFromParts(fromDateId);
  var toDate = getDateFromParts(toDateId);
  if (compareDates(fromDate,toDate)>0) {
    if (errorMsg && errorMsg != '') {
      alert(errorMsg);
    }
    return false;
  }
  return true;
}

// Build and return a complete date from date parts.
function getDateFromParts(dateId) {
  var date_day = document.getElementById(dateId+'_day');
  var date_month = document.getElementById(dateId+'_month');
  var date_year = document.getElementById(dateId+'_year');
  return (date_day.value+'-'+date_month.value+'-'+date_year.value);
}

// Declaring valid date character, minimum year and maximum year
var dtCh= "/";
var minYear=1900;
var maxYear=2999;
function isInt(s){
	var i;
    for (i = 0; i < s.length; i++){
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function stripCharsInBag(s, bag){
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (var i = 0; i < s.length; i++){
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}
function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31;
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30;}
		if (i==2) {this[i] = 29;}
   }
   return this;
}
function isDate(dtStr, dateObj){

	/**
	   Use a js object to obtain the parsed details and a boolean result.
	   The object is passed by reference to this function, as follows:
  	var theDateObj = {day:'', month:'', year:''};
	if (!isDate(theDate, theDateObj)) {
		alert("Invalid date: "+theDate);
		return null;
	}
	// Otherwise it was valid and the parts are available to the caller.
	var dte = new Date(theDateObj.year,theDateObj.month,theDateObj.day);
	// etc...
	**/
  //var doMsgs = false; 
	var daysInMonth = DaysArray(12);
	var pos1=dtStr.indexOf(dtCh);
	var pos2=dtStr.indexOf(dtCh,pos1+1);
	var strDay=dtStr.substring(0,pos1);
	var strMonth=dtStr.substring(pos1+1,pos2);
	var strYear=dtStr.substring(pos2+1);
	strYr=strYear;
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1);
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1);
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1);
	}
	month=parseInt(strMonth);
	day=parseInt(strDay);
	year=parseInt(strYr);
	if (pos1==-1 || pos2==-1){
		//if (doMsgs) alert("The date format should be : dd-mm-yyyy")
		return false;
	}
	if (strMonth.length<1 || month<1 || month>12){
		//if (doMsgs) alert("Please enter a valid month")
		return false;
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		//if (doMsgs) alert("Please enter a valid day")
		return false;
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		//if (doMsgs) alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false;
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1){
		//if (doMsgs) alert("Please enter a valid date")
		return false;
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInt(stripCharsInBag(dtStr, dtCh))==false){
		//if (doMsgs) alert("Please enter a valid date")
		return false;
	}
	if (dateObj) {
		dateObj.day = day;
		dateObj.month = month;
		dateObj.year = year;
	}
	return true;
}
function compareDates(firstDateStr,secondDateStr) {
	/**
	 * This method is expecting 2 date. Both must be in dd/mm/yyyy format.
	 * Returns 0 if dates are equal, 1 if first date is after second date, and -1 if
	 * first date is earlier than the second date.
	 */
  var firstDateObj = {day:'', month:'', year:''};
	if (!isDate(firstDateStr, firstDateObj)) {
		//alert("Invalid date: "+firstDateStr);
		return false;
	}
  	var secondDateObj = {day:'', month:'', year:''};
	if (!isDate(secondDateStr, secondDateObj)) {
		//alert("Invalid date: "+secondDateStr);
		return false;
	}
	if (firstDateObj.year>secondDateObj.year) return 1;
	if (firstDateObj.year<secondDateObj.year) return -1;
	if (firstDateObj.month>secondDateObj.month) return 1;
	if (firstDateObj.month<secondDateObj.month) return -1;
	if (firstDateObj.day>secondDateObj.day) return 1;
	if (firstDateObj.day<secondDateObj.day) return -1;
	return 0;	// Identical.
}

function timeToMins(timeVal) { 
	/* h:m */
  var timeAry = timeVal.split(/\D+/); 
  // NB Multiplying by 1 converts to numeric.
  return ((timeAry[0] * 60) + (timeAry[1] * 1)); 
}
function roundNumber(num, dec) {
	// Apparently it is necessary to do this.
	var result = Math.round( Math.round( num * Math.pow( 10, dec + 1 ) ) / Math.pow( 10, 1 ) ) / Math.pow(10,dec);
	return result;
}
function replaceAll(strValue, pattern, replaceWith)
{
	// Replaces all occurences of pattern with replaceWith in strValue.
	var workValue = strValue;
	while (workValue != (strValue = strValue.replace(pattern, replaceWith))) {
		workValue = strValue;
	}
	return strValue;
}

var win;	// Popup window.
function closeWindow() {
	if (win && win.open && !win.closed) {
		win.close();
	}
}
function openWindow(url,width,height) {

	var displaywidth = width; // screen.availWidth;
	var displayheight = height; //screen.availHeight;

	var parms = ('height='+displayheight+',width='+displaywidth
			+ ',resizable=yes,status=no,toolbar=no,'
			+ 'menubar=no,location=no,scrollbars=yes, '
			+ 'screenx=100, screeny=100,'
			+ 'left=100,top=100');
	//alert("parms=" + parms);
	closeWindow();
	win=window.open(url, 'appWin', parms);
	
	return false;
}

function checkTitleText(text) {
	if (text && text != '') {
		// Convert any special chars
		return unescape(text);
	}
	return '';
}

function arrayHasEntry(dataArray, entry) {
	if (dataArray && dataArray.length>0) {
		for (var i=0; i<dataArray.length; i++) {
			if (dataArray[i] == entry) {
				return true;
			}
		}
	}
	return false;
}

function convertToList(dataArray, sep) {
	var rtn = '';
	var separator = '';
	if (!sep || sep == '') {
		sep = ',';
	}
	if (dataArray && dataArray.length>0) {
		for (var i=0; i<dataArray.length; i++) {
			if (dataArray[i] && dataArray[i] != '') {
				rtn += (separator + dataArray[i]);
				separator = sep;
			}
		}
	}
	return rtn;
}

function escapeEmbeddedQuotes(str) {
	return replaceAll(str, "'", "\'");
}

