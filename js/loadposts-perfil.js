function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}
var id=getQueryParam('Iduser');
var start = 0;
var limit = 15;
var loading=false;
function loadPosts() {
    if(loading){return;}
    loading=true;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', `posts-perfil.php?start=${start}&limit=${limit}&id=${id}`, true);  

    xhr.onload = function() {
        if (this.status === 200) {
            var data = JSON.parse(this.responseText);

            data.forEach(function(post) {
               
                var postHtml = '<div class="post">' +
                                   '<h2 style="text-align:center;">' + post.titulo + '</h2>' +
                                   '<img style="width:500px; height:auto;"src="' + post.url_recurso + '" />' +
                                   '<p style="text-align:center;">' + post.contenido + '</p>' +
                               '</div>';

                document.querySelector('#posts').innerHTML += postHtml;  
            });
            if(data.length === 15){start += limit;}else{start+=data.length;}
            loading=false;
        } else {
           
            console.error('Hubo un error al obtener los posts:', this.status, this.statusText);
        }
    };

    xhr.onerror = function() {
        console.error('Hubo un error al hacer la solicitud:', this.status, this.statusText);
    };

    xhr.send();
}
loadPosts();

window.addEventListener('scroll', () => {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
  
    if (scrollTop + clientHeight >= scrollHeight - 5) {
      loadPosts();
    }
  });




