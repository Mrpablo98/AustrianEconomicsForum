document.addEventListener('DOMContentLoaded', function() {
    var edit=false;
    var editButtons=document.querySelectorAll('.fa-pen-to-square');
    var email=null;
    var password=null;
    var name=null;
    var oldPassword=null;
    editButtons.forEach(function(editButton){
        if(editButton.previousElementSibling.getAttribute('id')=='email'){
            email=editButton.previousElementSibling;
        }else if(editButton.getAttribute('id')=='password'){
            password=editButton.previousElementSibling;
        }else if(editButton.getAttribute('id')=='username'){
            name=editButton.previousElementSibling;
        }else if(editButton.getAttribute('id')=='old-password'){
            oldPassword=editButton.previousElementSibling;
        }   
        editButton.addEventListener('click',function(){
            console.log('edit1 button clicked');
            let input=editButton.previousElementSibling;
            if(edit==false){
                input.removeAttribute('disabled');
                edit=true;
            }else{
                input.setAttribute('disabled','disabled');
                edit=false;
            }

        });
    });
    

});