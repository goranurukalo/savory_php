    var errors = [];

    function displayerror(){
        var ve = document.getElementById('val_errors');
        var text = "";
        
        for(var i = 0; i < errors.length; i++){
            text +="<p>The "+errors[i]+" field is required.</p>";
        }
        ve.innerHTML = text;
    }
    
    var regEmail = /^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/;
    var regFirstName = /^[A-Z]{1}[a-z]{2,30}$/;
    var regLastName = /^[A-Z]{1}[a-z]{3,40}$/;
    var regPassword = /^[a-zA-Z0-9!@#$%^&*.]{6,128}$/;
    var regTextArea = /^[\w\d\s\.\,\!\?]{2,255}$/;
    var regFullName = /^[A-Z]{1}[a-z]{3,30}\s[A-Z]{1}[a-z]{3,40}$/;
    var regNumber = /^\d+$/;
    var regTimeOfReg = /^[1-9]{1}[0-9]{9}$/;
    var regVerificationCode = /^[A-z0-9]{20}$/;
    var regSalePercent = /^[1-9]{0,1}[0-9]{1,2}$|^100$/;

    var regProductName = /^[A-z0-9\s]{3,127}$/;
    var regProductPrice = /^[0-9]{1,4}(\.?[0-9]{2})?$/;
    var regProductDescription = /^[a-zA-Z0-9\!\$\%\&\.\,\s]{3,254}$/;
    var regProductQuantity = /^[0-9]{1,10}$/;
    var regProductImageAlt = /^[A-z0-9\s]{3,127}$/;

    var regQuestion = /^[\w\?\s\'\,\.]{3,254}$/;
    var regAnswer = /^[\w\s\'\.\,\!\d]{1,127}$/;

    var regDate = /(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/;
    var regTime = /^(((0?[1-8]):([0-5]?[0-9])\s?PM)|(0?9:0?0\s?PM)|(12:([0-5]?[0-9])\s?PM))|((0?[7-9]|1[0-2]):([0-5]?[0-9])\s?AM)$/;
    var regPersons = /^([1-5])$/;

function registration(){
    var err = 0;
    errors = [];
    if(!regFirstName.test(document.getElementById("firstName").value)){err++;errors.push("First Name");}
    if(!regLastName.test(document.getElementById("lastName").value)){err++;errors.push("Last Name");}
    if(!regEmail.test(document.getElementById("email").value)){err++;errors.push("Email");}
    if(!regPassword.test(document.getElementById("password").value)){err++;errors.push("Password");}
    if(document.getElementById("password").value != document.getElementById("re_password").value){err++;}

    if(!err){
        return true;
    }
    displayerror();
    return false;
}

function login(){
    var err = 0;
    errors = [];
    if(!regEmail.test(document.getElementById("email").value)){err++;errors.push("Email");}
    if(!regPassword.test(document.getElementById("password").value)){err++;errors.push("Password");}

    if(!err){
        return true;
    }
    displayerror();
    return false;
}

function reservation(){
    var err = 0;
    errors = [];
    if(!regPersons.test(document.getElementById("activities").value)){err++;errors.push("Persons");}
    if(!regDate.test(document.getElementById("date").value)){err++;errors.push("Date");}
    if(!regTime.test(document.getElementById("time").value)){err++;errors.push("Time");}

    if(!err){
        return true;
    }
    displayerror();
    return false;
}

function contactform(){
    var err = 0;
    errors = [];
    if(!regFullName.test(document.getElementById("name").value)){err++;errors.push("Full Name");}    
    if(!regEmail.test(document.getElementById("email").value)){err++;errors.push("Email");}
    if(!regTextArea.test(document.getElementById("message").value)){err++;errors.push("Message");}

    if(!err){
        return true;
    }
    displayerror();
    return false;
}
function forgotpassword(){
    var err = 0;
    errors = [];
    if(!regEmail.test(document.getElementById("email").value)){err++;errors.push("Email");}

    if(!err){
        return true;
    }
    displayerror();
    return false;
}