document.addEventListener('DOMContentLoaded', function () {
const optionsButton=document.getElementById('options-button');
const optionsContainer=document.getElementById('options-container');
var optionsOpen=false;
optionsButton.addEventListener('click', function(){
if(!optionsOpen){
    optionsContainer.classList.remove('closed-options');
    optionsContainer.classList.add('open-options');
    optionsOpen=true;
}else{
    optionsContainer.classList.remove('open-options');
    optionsContainer.classList.add('closed-options');
    optionsOpen=false;
}


});

});