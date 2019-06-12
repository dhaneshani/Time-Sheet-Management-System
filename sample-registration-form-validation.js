
$('head').append('<link rel="stylesheet" href="sweetalert/dist/sweetalert.css" type="text/css" />');
var theNewScript = document.createElement("script");
theNewScript.type = "text/javascript";
theNewScript.src = "sweetalert/dist/sweetalert.min.js";
document.getElementsByTagName("head")[0].appendChild(theNewScript);
	
function formValidation()  
{  
var code = document.registration.code;  
var name = document.registration.name;  
var contactName = document.registration.contactName;  
var contactNo = document.registration.contactNo;   
var address= document.registration.address;
var designation=document.registration.designation;
var yes=document.registration.yes;
var no=document.registration.no;
var username = document.registration.username;  
var password = document.registration.password;  
 
if(alphanumeric(code))  
{  
if(isEmpty(name)) 
{
if(isEmpty(designation)) 
{ 
if(isEmpty(username)) 
{ 
if(isEmpty(password)) 
{ 
if(isAdmin(yes,no)) 
{  
if(isEmpty(contactName)) 
{ 
if(validatePhone(contactNo)) 
{ 
if(isEmpty(address)) 
{ 
}  
} 
}  
}  
} 
} 
} 
}  
}  

   

return false;  
} 

//////////////////////////////////////////////////////////////////////
function allnumeric(uzip)  
{   
var numbers = /^[0-9]+$/;  
if(uzip.value.match(numbers))  
{  
return true;  
}  
else  
{  
//sweetAlert('Sorry!','Code must have numeric characters only','warning');
//alert('Code must have numeric characters only');  
uzip.focus();  
return false;  
}  
}  
//////////////////////////////////////////////////////////////////////
function alphanumeric(uadd)  
{   
var letters = /^[0-9a-zA-Z]+$/;  
if(uadd.value.match(letters))  
{  
return true;  
}  
else  
{ 
//sweetAlert('Sorry!','Code must have alphanumeric characters only','warning'); 
//alert('Code must have alphanumeric characters only');  
uadd.focus();  
return false;  
}  
}
//////////////////////////////////////////////////////////////////////
function allLetter(uname)  
{   
var letters = /^[A-Za-z]+$/;  
if(uname.value.match(letters))  
{  
return true;  
}  
else  
{  
//sweetAlert('Sorry!','Username must have alphabet characters only','warning'); 
//alert('Username must have alphabet characters only');  
uname.focus();  
return false;  
}  
} 
//////////////////////////////////////////////////////////////////////
function validatePhone(phone) { 
    var phoneRegex = /^(\+91-|\+91|0)?\d{10}$/; 
    if(phone.value.match(phoneRegex))  
	{  
	return true;  
	}  
	else  
	{  
	//sweetAlert('Sorry!','Invalid Contact Number','warning'); 
	//alert('Invalid Contact Number');  
	phone.focus();  
	return false;  
	}  
} 

function isEmpty(field) {
    if (field.value == '') {
        //alert('Empty value is not allowed');
        //sweetAlert('Sorry!','Empty value is not allowed','warning');
        return false;
    }else{
    	return true;
    }
}
function isAdmin(yes,no)  
{  
x=0;  
  
if(yes.checked)   
{  
x++;  
} if(no.checked)  
{  
x++;   
}  
if(x==0)  
{ 
//sweetAlert('Sorry!','Select whether an Admin or not','warning'); 
//alert('Select whether an Admin or not');  
yes.focus();  
return false;  
}  
else  
{  
return true;}  
}  