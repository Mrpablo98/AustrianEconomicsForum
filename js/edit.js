document.addEventListener('DOMContentLoaded', function() {

    var editButtons=document.querySelector('.fa-pen-to-square');
    var edit=false;
    
        editButtons.addEventListener('click',function(){
            console.log('edit1 button clicked');
            var inputs=document.getElementsByTagName('input');
            if(edit==false){
            Array.from(inputs).forEach(function(input) {
                input.removeAttribute('disabled');
            });
            edit=true;
        }else{
            Array.from(inputs).forEach(function(input) {
                input.setAttribute('disabled','disabled');
            });
            edit=false;
        }

        });
   
});