document.addEventListener('DOMContentLoaded', function () {
    const optionsButton=document.getElementById('options-button');
    const optionsContainer=document.getElementById('options-container');
    const optionsForm=document.getElementById('options-form');
    const iconoOptions=document.getElementById('bars');
    var optionsOpen=false;
    
    document.addEventListener('click', function(event) {
        if (optionsOpen) {
            if (!optionsContainer.contains(event.target)) {
                optionsContainer.classList.remove('open-options');
                optionsContainer.classList.add('closed-options');
                optionsForm.classList.remove('open-options');
                optionsForm.classList.add('closed-options');
                iconoOptions.classList.remove('fa-xmark');
                iconoOptions.classList.add('fa-bars');
                optionsOpen = false;
            }
        }
    });

    optionsButton.addEventListener('click', function(){
        event.stopPropagation();
        if(!optionsOpen){
            optionsContainer.classList.remove('closed-options');
            optionsContainer.classList.add('open-options');
            optionsForm.classList.remove('closed-options');
            optionsForm.classList.add('open-options');
            iconoOptions.classList.remove('fa-bars');
            iconoOptions.classList.add('fa-xmark');
            optionsOpen=true;
            
        }else{
            optionsContainer.classList.remove('open-options');
            optionsContainer.classList.add('closed-options');
            optionsForm.classList.remove('open-options');
            optionsForm.classList.add('closed-options');
            iconoOptions.classList.remove('fa-xmark');
            iconoOptions.classList.add('fa-bars');
            optionsOpen=false;
        }
    });

});