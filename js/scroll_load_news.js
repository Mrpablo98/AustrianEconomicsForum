let start = 0;
const limit = 5;

function loadNoticias() {
   
    $.getJSON('get_noticias_json.php', { start: start, limit: limit }, function(noticias) {
        noticias.forEach(noticia => {
            if(noticia.media_url.length === 0){
                var New="<div width='50%' height='50px' style='color:white; background-color:#444654; display:flex; justify-content:center; align-items:center;'><i class='fa-sharp fa-solid fa-eye-slash fa-xl' style='color: #eff0f0;'></i><p style='text-align:center;'>No hay imágen disponible.</p></div>";
            }else if(noticia.media_url === ".."){
                 var New='';
            }else{
                var New="<img src='" + noticia.media_url + "' width='50%' height='auto'>";
            }
            // Añade cada noticia al contenedor (personaliza el formato según sea necesario)
            $('#content-container').append(`<div>
                <h2>${noticia.titulo}</h2>`+ 
                New 
                +`<p>${noticia.descripcion}</p>
                <p>Fecha: ${noticia.fecha}</p>
            </div>`);
        });

        // Incrementa la posición de inicio para la siguiente carga
        start += noticias.length;
    });
}

$(document).ready(function() {
    loadNoticias();

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            loadNoticias();
        }
    });
});