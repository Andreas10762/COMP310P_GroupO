//function that changes the display of the password in the login form from visible to dots and vice versa when the checkbox is ticked and unticked respectively
(function() {
                var loginpassbutton = document.getElementById("loginshow");
                loginpassbutton.onclick=function(){showloginpass()} ;

                function showloginpass() {
                    var x = document.getElementById("loginpassword");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
})();