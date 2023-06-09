document.addEventListener('DOMContentLoaded', function() {

    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    

    var Error=getQueryParam('error');
    if(Error=='username'){
        document.getElementById('user-error').classList.remove('invisible');
    }else if(Error=='password'){
        document.getElementById('password-error').classList.remove('invisible');
    }
    var username= document.getElementById('username');
    var password= document.getElementById('password');

    username.addEventListener('input', function() {
            
            if(username.value.trim().length>=4 ){
                username.style.border='1px solid green';
            }else{
                username.style.border='1px solid red';
            }
    });

    password.addEventListener('input', function() {
                
                if(password.value.trim().length>=6){
                    password.style.border='1px solid green';
                }else{
                    password.style.border='1px solid red';
                }
    });
});