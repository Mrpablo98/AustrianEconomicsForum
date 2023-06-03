
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
    var numLikes=0;
    async function loadPosts() {
        if(loading){return;}
        loading=true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `posts-perfil.php?start=${start}&limit=${limit}&id=${id}`, true);  

        xhr.onload = async function() {
            if (this.status === 200) {
                var responseData = JSON.parse(this.responseText);
                console.log(responseData);
                var data=responseData.posts;
                var userId=responseData.userId;
                console.log(data);
                for(const post of data) {
                    let content=post.contenido;
                    Likesrc= await checkLikeButton(post.id);
                    try {
                        const response = await fetch('php/count-likes.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'postId=' + post.id
                        });
                        
                        const likeData = await response.text();
                        console.log(likeData);
                        numLikes=likeData;  
                        
                    } catch (error) {
                        console.error('Error:', error);
                    }
                    if(content.length>100){
                        content=content.substring(0,100)+"...";
                    }
                    
                    var postHtml = '<div class="post" data-id="'+post.id+'">'; 
                    if(post.usuario_id==userId){postHtml+='<div class="post-options"><i class="fas fa-sort-down fa-lg" style="color: #c0c0c0;"></i></div>';}
                        postHtml+= '<div class="post-content">' +
                                    '<h2 style="text-align:center;">' + post.titulo + '</h2>' +
                                    '<p style="text-align:center;">' + content + '</p>' +
                                    '</div>' +
                                    '<div class="post-image">' +
                                        '<img id="post-img" src="' + post.url_recurso + '" />' +
                                    '</div>' +
                                    '<div class="post-arrow">' + 
                                        '<i class="more-icon fas fa-chevron-right fa-lg" style="color: #d9d9d9;"></i>' +
                                    '</div>';
                                    if(post.usuario_id==userId){postHtml+='<div class="container-delete invisible"><button class="deleteButton">Eliminar</button><button class="editButton">Editar</button></div>'};
                                postHtml+='</div>';
                                
                                postHtml+='<div class="cortina-post invisible">' +
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
                                                    '<p class="numLikes">' + numLikes + ' likes' + '</p>' +
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
    var coment1= coment.closest('.form-coment').querySelector('.coment-input');
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
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var lastComentHtml = '<div id="coments" class="coment">' +
                '<div class="coment-content">' +
                '<a href=perfil.php?id=' + data.id +'><p style="padding:10px; margin:0; font-weight:bold;">' + data.username + '</p></a>' +
                '<p style="padding-left:50px; margin:0;">' + comentario + '</p>' +
                '</div>' +
                '</div>';
            document.getElementById('coments'+selectedPostId).innerHTML = lastComentHtml + document.getElementById('coments'+selectedPostId).innerHTML;
        })
        .then(coment1.value="")
        .catch((error) => {
        console.error('Error:', error);
        });
    }else{
        alert("No puedes enviar un comentario vacio");
    }
}

    function handleLikeClick(like){
        var countLikes=like.closest('.like-container').querySelector('.numLikes');
        var numLikes=parseInt(countLikes.innerHTML);
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
                numLikes++;
                countLikes.innerHTML = numLikes + ' likes';
                

            } else if (data === "unliked") {
            
                like.src = 'img/like_icon.svg';
                numLikes--;
                countLikes.innerHTML = numLikes + ' likes';
            }else{
                console.log("error");
            }
            })
            .catch((error) => {
            console.error('Error:', error);
            });
    }

    
        
    function handleOptionsClick(options){
        let post=options.parentElement;
        let deleteContainer=post.querySelector('.container-delete');
        if(deleteContainer.classList.contains('invisible')){
            deleteContainer.classList.remove('invisible');
            console.log(post);
            post.classList.add('post-optionsOpen');
        }else{
            deleteContainer.classList.add('invisible');
            post.classList.remove('post-optionsOpen');
        }
    }

    function handleDeleteClick(deleteButton){
        var post=deleteButton.closest('.post');
        var postId=post.getAttribute('data-id');
        console.log("is de post: "+postId);
        fetch('php/delete-post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'postId': postId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data==="deleted"){
                post.remove();
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
            let options=document.querySelectorAll('.post-options');
            let deleteButtons=document.querySelectorAll('.deleteButton');
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
            options.forEach(function(option){
                if(option.listener){
                    option.removeEventListener('click', option.listener);
                }
                option.listener = function() { handleOptionsClick(option) };
                option.addEventListener('click', option.listener);

            });
            deleteButtons.forEach(function(deleteButton){
                if(deleteButton.listener){
                    deleteButton.removeEventListener('click', deleteButton.listener);
                }
                deleteButton.listener = function() { handleDeleteClick(deleteButton) };
                deleteButton.addEventListener('click', deleteButton.listener);
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
                    console.log(coment);
                    comentHtml+='<div id="coments" class="coment">' +
                    '<div class="coment-content">' +
                    '<a href=perfil.php?id='+ coment.usuario_id +'><p style="padding:10px; margin:0; font-weight:bold;">' + coment.username + '</p></a>' +
                    '<p style="padding-left:50px; margin:0;">' + coment.contenido + '</p>' +
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
        
    
