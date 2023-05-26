/*document.addEventListener('DOMContentLoaded', function() {
function getQueryParam(name) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}
var id=getQueryParam('id');
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
                let content=post.contenido;
                if(content.length>100){
                    content=content.substring(0,100)+"...";
                }
                var postHtml = '<div class="post">' +
                                   '<div class="post-content">' +
                                   '<h2 style="text-align:center;">' + post.titulo + '</h2>' +
                                   '<p style="text-align:center;">' + content + '</p>' +
                                   '</div>' +
                                   '<div class="post-image">' +
                                      '<img id="post-img" src="' + post.url_recurso + '" />' +
                                   '</div>' +
                                   '<div class="post-arrow">' + 
                                      '<i id="more-icon" class="fas fa-chevron-right fa-lg" style="color: #d9d9d9;"></i>' +
                                   '</div>' +
                               '</div>' +
                               '<div class="complete-post invisible">' +
                                      '<div class="complete-Post ">' + '<div class="complete-post-content invisible">' +
                                        '<h2>' + post.titulo + '</h2>' +
                                        '<p>' + post.contenido + '</p>' +
                                      '</div>' +
                                        '<div class="complete-post-image invisible">' +
                                            '<img src="' + post.url_recurso + '" />' +
                                        '</div>' +
                               '</div';

                document.querySelector('#posts').innerHTML += postHtml; 
                let moreIcon=document.querySelectorAll('#more-icon');
                let PostImg=document.querySelectorAll('#post-img');

                moreIcon.forEach(function(icon){addEventListener('click',function(){
                    let post=icon.parentElement.parentElement;
                    let completePost=post.nextElementSibling;
                    //completePostImg.src=postImg.src;
                    //post.classList.add('invisible');
                    if (completePost !== null) {
                        completePost.classList.remove('invisible');
                    }
                })}); 
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
  

});*/
document.addEventListener('DOMContentLoaded', function() {
    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    var id=getQueryParam('id');
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
                    let content=post.contenido;
                    if(content.length>100){
                        content=content.substring(0,100)+"...";
                    }
                    var postHtml = '<div class="post" data-id="'+post.id+'">' +
                                       '<div class="post-content">' +
                                       '<h2 style="text-align:center;">' + post.titulo + '</h2>' +
                                       '<p style="text-align:center;">' + content + '</p>' +
                                       '</div>' +
                                       '<div class="post-image">' +
                                          '<img id="post-img" src="' + post.url_recurso + '" />' +
                                       '</div>' +
                                       '<div class="post-arrow">' + 
                                          '<i class="more-icon fas fa-chevron-right fa-lg" style="color: #d9d9d9;"></i>' +
                                       '</div>' +
                                   '</div>' +
                                   '<div class="complete-post invisible">' +
                                        '<div class="complete-Post ">' +
                                          '<div class="complete-post-content">' +
                                            '<h2 style="text-align:center;">' + post.titulo + '</h2>' +
                                          '</div>' +
                                            '<div class="complete-post-image invisible">' +
                                                '<img src="' + post.url_recurso + '" />' +
                                                '<div>' +
                                                '<p>' + post.contenido + '</p>' +
                                                '<div class="coments">' +
                                                    
                                                '</div>' +
                                                '<div>' +
                                                    '<form>' +
                                                        '<input class="coment-input" type="text" name="comentario" placeholder="Comentario" required>' +
                                                        '<button type="submit" name="submit" class="coment-button"><i class="far fa-comment" style="color: #e6e6e6;"></i></button>' +
                                                    '</form>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<i class="closeIcon fas fa-times" style="color: #d9d9d9;"></i>' +
                                   '</div>';
    
                    document.querySelector('#posts').innerHTML += postHtml; 
                    loadComents(post.id); 
                });
                if(data.length === 15){start += limit;}else{start+=data.length;}
                loading=false;
                attachListeners();
            } else {
               
                console.error('Hubo un error al obtener los posts:', this.status, this.statusText);
            }
        };
    
        xhr.onerror = function() {
            console.error('Hubo un error al hacer la solicitud:', this.status, this.statusText);
        };
    
        xhr.send();
    }
    function attachListeners() {
      let moreIcons=document.querySelectorAll('.more-icon');
        let closeIcons=document.querySelectorAll('.closeIcon');
      moreIcons.forEach(function(icon){
        icon.addEventListener('click',function(){
            let post=icon.parentElement.parentElement;
            let completePost=post.nextElementSibling;
            let completePostImg=completePost.querySelector('.complete-post-image');
            if (completePost !== null) {
                completePost.classList.remove('invisible');
            }
            if(completePostImg!==null){
                completePostImg.classList.remove('invisible');
            }
            document.body.style.overflow = 'hidden';
        });
      });
      closeIcons.forEach(function(icon){
        icon.addEventListener('click',function(){
            let completePost=icon.parentElement;
            let alert=completePost.parentElement;
            if(alert!==null){
                alert.classList.add('invisible');
            }
            document.body.style.overflow = 'auto';
            console.log('click');
        })
    });
    }
    function loadComents(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `comentarios.php?id=${id}`, true);  
    
        xhr.onload = function() {
            if (this.status === 200) {
                var data = JSON.parse(this.responseText);
                let comentHtml="";
                data.forEach(function(coment) {
                    comentHtml+='<div class="coment">' +
                    '<div class="coment-content">' +
                    '<h2 style="text-align:center;">' + coment.nombre + '</h2>' +
                    '<p style="text-align:center;">' + coment.contenido + '</p>' +
                    '</div>' +
                    '</div>';
                });
                document.querySelector('#coments').innerHTML = comentHtml;  
            } else {
               
                console.error('Hubo un error al obtener los comentarios:', this.status, this.statusText);
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
    });
    

