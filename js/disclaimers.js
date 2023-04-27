document.addEventListener('DOMContentLoaded', function() {
const containerDatos=document.getElementById('disclaimer-datos-text');
const disclaimerDatos=document.getElementById('disclaimer-datos');
const disclaimerExpresion=document.getElementById('disclaimer-expresion');
const containerExpresion=document.getElementById('disclaimer-expresion-text');
let datos=false;
let expresion=false;
disclaimerDatos.addEventListener('click',()=>{
    if(datos==false){
        containerDatos.style.display='flex';
        containerDatos.style.flexDirection='column';
        containerExpresion.style.display='none';
        expresion=false;
        datos=true;
    }else{
        containerDatos.style.display='none';
        datos=false;
    }



});
disclaimerExpresion.addEventListener('click',()=>{

    if(expresion==false){
        containerExpresion.style.display='flex';
        containerExpresion.style.flexDirection='column';
        containerDatos.style.display='none';
        expresion=true;
        datos=false;
    }else{
        containerExpresion.style.display='none';
        expresion=false;
    }


});
});