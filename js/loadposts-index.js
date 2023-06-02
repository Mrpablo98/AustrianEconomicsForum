
document.addEventListener('DOMContentLoaded', function() {
    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    var id=getQueryParam('id');
    if(id==null){id=getQueryParam('Iduser');}
    var selectedPostId = null;
    var start = 0;
    var limit = 15;
    var startComent=0;
    var limitComent=25;
    var loading=false;
    async function loadPosts() {
        if(loading){return;}
        loading=true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `posts-index.php?start=${start}&limit=${limit}&id=${id}`, true);  

        xhr.onload = async function() {
            if (this.status === 200) {
                var data = JSON.parse(this.responseText);
                console.log(data);
                for(const post of data) {
                    let content=post.contenido;
                    if(content.length>100){
                        content=content.substring(0,100)+"...";
                    }
                    Likesrc= await checkLikeButton(post.id);
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
                                '<div class="cortina-post invisible">' +
                                        '<div class="complete-Post ">' +
                                            '<div class="complete-post-image invisible">' +
                                                '<img src="' + post.url_recurso + '" />' +
                                                '<div>'+
                                                '<h2 style="text-align:center; height: 5%;">' + post.titulo + '</h2>' +
                                                '<div class="overflow-post-content">' +
                                                '<p>' + post.contenido + '</p>' +
                                                '<div id="coments' +post.id + '" class="coments"'+'>' +
                                                    
                                                '</div>' +
                                                '</div>' +
                                                '<div class="like-container">' +
                                                    '<img  class="like" src="'+ Likesrc +'">' +
                                                '</div>' +
                                                '<div class="comentar-container">' +
                                                    '<form class="form-coment">' +
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
                    
                };
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

    async function checkLikeButton(postId) {
        let response= await fetch('check_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'postId': postId
            })
        });
        let data = await response.text();
        return data;
    }

    function handleMoreIconClick(icon){
      
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
        
                    // Select the specific comments container for the opened post
                    let comentsContainerOverflow = completePost.querySelector('.overflow-post-content');
                    let comentsContainer = completePost.querySelector('.coments');
                    comentsContainer.innerHTML = "";
                    if(startComent==0){loadComents(selectedPostId);}
        
                    // Apply the scroll listener to the specific comments container
                    comentsContainerOverflow.addEventListener('scroll', () => {
                        const { scrollTop, scrollHeight, clientHeight } = comentsContainerOverflow;
                        if (scrollTop + clientHeight >= scrollHeight - 5) {
                            loadComents(selectedPostId);
                        }
                    });
    }

    function handleCloseIconClick(icon){
        let completePost=icon.parentElement;
        let alert=completePost.parentElement;
        if(alert!==null){
            alert.classList.add('invisible');
        }
        document.body.style.overflow = 'auto';
        console.log('click');
    }
    function handleComentClick(coment){
        event.preventDefault();
        var comentario = coment.closest('.form-coment').querySelector('.coment-input').value; 
            if(comentario.length>0){
            fetch('coment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'comentario': comentario,
                    'postId': selectedPostId
                })
            })
            .then(response => response.text())
            .then(data => {console.log(data)
                loadComents(selectedPostId);
                comentario.value="";}
            )
            .catch((error) => {
            console.error('Error:', error);
            });
        }else{
            alert("No puedes enviar un comentario vacio");
        }
    }

    function handleLikeClick(like){

        var like2=true;
            if(like.src === 'http://localhost/AustrianEconomicsForum/img/like_icon.svg'){
                like2=false;
                console.log('like');
            }
            console.log(like2);
            fetch('like.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'postId': selectedPostId,
                    'liked' : like2
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                
           
            if (data === "liked") {
                like.style.transition = "all 0.5s";
                like.src = 'img/like2_icon.svg';
                like.style.transform = "scale(1.5)";
                setTimeout(function() {like.style.transform = "scale(1)";}, 500);
                

            } else if (data === "unliked") {
            
                like.src = 'img/like_icon.svg';
            }else{
                console.log("error");
            }
            })
            .catch((error) => {
            console.error('Error:', error);
            });
    }


    function attachListeners() {
            let moreIcons=document.querySelectorAll('.post-arrow .more-icon');
            let closeIcons=document.querySelectorAll('.closeIcon');
            let comentButtons=document.querySelectorAll('.coment-button');
            let likeButtons=document.querySelectorAll('.like');
            moreIcons.forEach(function(icon){
                if (icon.listener) {
                    icon.removeEventListener('click', icon.listener);
                }
                icon.listener = function() { handleMoreIconClick(icon) };
                icon.addEventListener('click', icon.listener);
            });
            
            closeIcons.forEach(function(icon){
                if (icon.listener) {
                    icon.removeEventListener('click', icon.listener);
                }
                icon.listener = function() { handleCloseIconClick(icon) };
                icon.addEventListener('click', icon.listener);
            });
            comentButtons.forEach(function(coment){
            if(coment.listener){
                coment.removeEventListener('click', coment.listener);
            }
            coment.listener = function() { handleComentClick(coment) };
            coment.addEventListener('click', coment.listener);
            });
            likeButtons.forEach(function(like){
                if(like.listener){
                    like.removeEventListener('click', like.listener);
                }
                like.listener = function() { handleLikeClick(like) };
                like.addEventListener('click', like.listener);
            });
       
        
        
    }

    /*var comentsContainer=document.querySelectorAll('.coment');
    comentsContainer.forEach(function(coment){
        coment.addEventListener('scroll', () => {
            const { scrollTop, scrollHeight, clientHeight } = coment;
        
            if (scrollTop + clientHeight >= scrollHeight - 5) {
            loadComents(selectedPostId);
            }
        });
    });*/
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
                    '<a href=perfil.php?id='+ coment.usuario_id +'><p style="padding:10px; margin:0; font-weight:bold;">' + coment.username + '</p></a>' +
                    '<p style="style="padding-left:50px; margin:0;">' + coment.contenido + '</p>' +
                    '</div>' +
                    '</div>';
                });
                document.getElementById('coments'+selectedPostId).innerHTML += comentHtml; 
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
  
    

});
        
    
