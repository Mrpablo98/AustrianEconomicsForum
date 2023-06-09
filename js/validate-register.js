document.addEventListener('DOMContentLoaded', function() {

    function isValidEmail(email) {
        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return pattern.test(email);
    }
    var registeBtn=document.querySelector('.registerButton');
    registeBtn.disabled=true;
    registeBtn.style.opacity='0.5';

    var email= document.getElementById('email');
    var username= document.getElementById('username');
    var password= document.getElementById('password');
    var Rpassword= document.getElementById('Rpassword');
    var emailBool=false;
    var usernameBool=false;
    var passwordBool=false;
    var RpasswordBool=false;

    email.addEventListener('input', function() {
        
        

        if(isValidEmail(email.value)){
            email.style.border='1px solid green';
            emailBool=true;
        }else{
            email.style.border='1px solid red';
            emailBool=false;
        }
        if(emailBool && usernameBool && passwordBool && RpasswordBool){
            registeBtn.disabled=false;
            registeBtn.style.opacity='1';
        }
    });

    username.addEventListener('input', function() {

        

        if(username.value.length>4){
            username.style.border='1px solid green';
            usernameBool=true;
        }else{
            username.style.border='1px solid red';
            usernameBool=false;
        }
        if(emailBool && usernameBool && passwordBool && RpasswordBool){
            registeBtn.disabled=false;
            registeBtn.style.opacity='1';
        }
    });

    password.addEventListener('input', function() {
            
        

            if(password.value.length>6){
                password.style.border='1px solid green';
                passwordBool=true;
            }else{
                password.style.border='1px solid red';
                passwordBool=false;
            }
            if(emailBool && usernameBool && passwordBool && RpasswordBool){
                registeBtn.disabled=false;
                registeBtn.style.opacity='1';
            }
    });
    Rpassword.addEventListener('input', function() {

        

        if(Rpassword.value!=password.value || Rpassword.value.length<6){
            Rpassword.style.border='1px solid red';
            RpasswordBool=false;
        }else if(Rpassword.value==password.value && Rpassword.value.length>=6){
            Rpassword.style.border='1px solid green';
            RpasswordBool=true;
        }
        if(emailBool && usernameBool && passwordBool && RpasswordBool){
            registeBtn.disabled=false;
            registeBtn.style.opacity='1';
        }
    });
    


});