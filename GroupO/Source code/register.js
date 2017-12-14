//function that changes the display of the password and the verify password in the register form from visible to dots and vice versa when the checkbox is ticked and unticked respectively
(function() {
    
    var passbutton = document.getElementById("show");
    var verpassbutton = document.getElementById("showver");

    passbutton.onclick=function(){showpass()} ;
    verpassbutton.onclick=function(){showverpass()} ;
   
    function showpass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function showverpass() {
        var x = document.getElementById("verpassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    
})();     