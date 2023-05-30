
document.addEventListener('DOMContentLoaded', function() {
    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    var id=getQueryParam('id');
    var selectedPostId = null;
    var start = 0;
    var limit = 15;
    var startComent=0;
    var limitComent=25;
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
                                            
                                        '</div>' +
                                            '<div class="complete-post-image invisible">' +
                                                '<img src="' + post.url_recurso + '" />' +
                                                '<div>' +
                                                '<h2 style="text-align:center;">' + post.titulo + '</h2>' +
                                                '<p>' + post.contenido + '</p>' +
                                                '<div id="coments" class="coments">' +
                                                    
                                                '</div>' +
                                                '<div class="like-container">' +
                                                    '<img  class="like" src="img/like_icon.svg">' +
                                                '</div>' +
                                                '<div>' +
                                                    '<form>' +
                                                        '<input type="hidden" name="postId" value="'+post.id+'">' +
                                                        '<input class="coment-input" type="text" id="comentario" name="comentario" placeholder="Comentario" required>' +
                                                        '<button name="submit" class="coment-button"><i class="far fa-comment" style="color: #e6e6e6;"></i></button>' +
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
        var comentsContainer=document.querySelectorAll('.coment');
            let closeIcons=document.querySelectorAll('.closeIcon');
        moreIcons.forEach(function(icon){
            icon.addEventListener('click',function(){
                let post=icon.parentElement.parentElement;
                selectedPostId = post.getAttribute('data-id');
                startComent=0;
                let completePost=post.nextElementSibling;
                let completePostImg=completePost.querySelector('.complete-post-image');
                if (completePost !== null) {
                    completePost.classList.remove('invisible');
                }
                if(completePostImg!==null){
                    completePostImg.classList.remove('invisible');
                }
                document.body.style.overflow = 'hidden';
                document.querySelector('#coments').innerHTML = "";
                loadComents(selectedPostId);
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
        comentsContainer.forEach(function(coment){
            coment.addEventListener('scroll', () => {
                const { scrollTop, scrollHeight, clientHeight } = coment;
            
                if (scrollTop + clientHeight >= scrollHeight - 5) {
                loadComents(selectedPostId);
                }
            });
        });
        document.querySelector(".coment-button").addEventListener("click", function(){
            var comentario = document.getElementById("comentario").value; 
            if(comentario.length>0){
            console.log(comentario);
            fetch('coment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'comentario': comentario,
                    'postId': selectedPostId,
                    'userId': userId
                })
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch((error) => {
            console.error('Error:', error);
            });
        }else{
            alert("No puedes enviar un comentario vacio");
        }
        document.querySelector('.like').addEventListener('click', function(){
            var like=true;
            if(this.src == 'img/like_icon.png'){
                like=false;
            }
            fetch('like.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'postId': selectedPostId,
                    'userId': userId,
                    'liked' : like
                })
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
  
        let likeImage = document.querySelector('#like img');
        if (data == 'Liked') {
           
            likeImage.src = 'img/like2_icon.png';
        } else if (data == 'Unliked') {
           
            likeImage.src = 'img/like_icon.png';
        }else{
            console.log(data);
        }
            })
            .catch((error) => {
            console.error('Error:', error);
            });
        });
        }); 
        
    }
    function loadComents(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `comentarios-post.php?startComent=${startComent}&limitComent=${limitComent}&postId=${id}`, true);  

        xhr.onload = function() {
            if (this.status === 200) {
                var data = JSON.parse(this.responseText);
                let comentHtml="";
                data.forEach(function(coment) {
                    comentHtml+='<div id="coments" class="coment">' +
                    '<div class="coment-content">' +
                    '<h2 style="padding:10px; margin:0;">' + coment.username + '</h2>' +
                    '<p style="style="padding-left:50px; margin:0;">' + coment.contenido + '</p>' +
                    '</div>' +
                    '</div>';
                });
                document.querySelector('#coments').innerHTML += comentHtml; 
                if(data.length === limitComent) { startComent += limitComent; } else { startComent += data.length; }

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
   /* comentsContainer.addEventListener('scroll', () => {
        const { scrollTop, scrollHeight, clientHeight } = comentsContainer;
    
        if (scrollTop + clientHeight >= scrollHeight - 5) {
        loadComents(selectedPostId);
        }
    });*/
    

});
        
    
