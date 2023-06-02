document.addEventListener('DOMContentLoaded', function () {

    var imagenes = document.querySelectorAll('.img-periodico');
    var checks=document.querySelectorAll('.check-periodico');

    imagenes.forEach(function (imagen) {
        imagen.addEventListener('click', function () {
            let check=imagen.parentElement.previousElementSibling;
            if(check.checked){
                console.log('checked');
                imagen.classList.remove('img-checked');
                imagen.classList.add('img-unchecked');
            }else{
                console.log('unchecked');
                imagen.classList.remove('img-unchecked');
                imagen.classList.add('img-checked');
            }
        });
    });


});