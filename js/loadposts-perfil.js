
document.addEventListener('DOMContentLoaded', function() {
    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
    var id=getQueryParam('id');
    if(id==null){id=getQueryParam('Iduser');}
    var selectedPostId = null;
    var start = 0;
    var limit = 10;
    var startComent=0;
    var limitComent=25;
    var loading=false;
    var numLikes=0;
    async function loadPosts() {
        if(loading){return;}
        loading=true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `php/posts-perfil.php?start=${start}&limit=${limit}&id=${id}`, true);  

        xhr.onload = async function() {
            if (this.status === 200) {
                var responseData = JSON.parse(this.responseText);
                var data=responseData.posts;
                var userId=responseData.userId;
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
                                    '<h2 style="text-align:center;">' +  post.titulo + ' - ' + post.nombre + '</h2>' +
                                    '<p style="text-align:center;">' + content + '</p>' +
                                    '</div>';
                                    if(post.url_recurso!=null){if(post.tipo=="imagen"){postHtml+='<div class="post-image">' +
                                        '<img id="post-img" src="' + post.url_recurso + '" />' +
                                    '</div>';}else if(post.tipo=="video"){postHtml+='<div class="post-image">' +
                                    '<video id="post-img" src="' + post.url_recurso + '" controls />' +
                                '</div>';}if(post.tipo=="audio"){postHtml+='<div class="post-image">' + "<audio class='post-audio' src='" + post.url_recurso + "' controls></audio>" + '</div>';}
                                else if(post.tipo=="archivo"){postHtml+='<div class="post-image">' + "<a class='post-archivo' href='" + post.url_recurso + "'>"+ post.titulo +"<i class='fa-solid fa-file-arrow-down' style='color: #dbdbdb;'></i></a>" + '</div>';} }
                                    postHtml+='<div class="post-arrow">' + 
                                        '<i class="more-icon fas fa-chevron-right fa-lg" style="color: #d9d9d9;"></i>' +
                                    '</div>';
                                    if(post.usuario_id==userId){postHtml+='<div class="container-delete invisible"><button class="deleteButton">Eliminar</button><button class="editButton">Editar</button></div>'};
                                postHtml+='</div>';
                                
                                postHtml+='<div class="cortina-post invisible">' +
                                '<div class="complete-Post ">' +
                                    '<div class="complete-post-image invisible">';
                                        if(post.url_recurso!=null){if(post.tipo=="imagen"){postHtml+='<div class="media"><img src="' + post.url_recurso + '" /></div>';
                                    }else if(post.tipo=="video"){postHtml+='<div class="media"><video src="' + post.url_recurso + '" controls ></video></div>';}else if(post.tipo=="audio"){postHtml+='<div class="cortina-audio"><audio src="' + post.url_recurso + '" controls ></audio></div>';}else if(post.tipo=="archivo"){postHtml+='<div class="post-image">' + "<a class='post-archivo' href='" + post.url_recurso + "'>"+ post.titulo +"<i class='fa-solid fa-file-arrow-down' style='color: #dbdbdb;'></i></a>" + '</div>';}};
                                       postHtml+= '<div>'+
                                       '<a href="perfil.php?id='+ post.usuario_id + '"><h2 style="text-align:center;">' + post.titulo + ' - ' + post.nombre + '</h2></a>' +
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
                likesShow(start);
                if(data.length === 10){start += limit;}else{start+=data.length;}
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

    function likesShow(start){
        var posts=document.querySelectorAll('.post');
        
        for(i=start;i<posts.length;i++){
            let postContent=posts[i].querySelector('.post-content');
            let cortinaPost=posts[i].nextElementSibling;
            let likeContainer=cortinaPost.querySelector('.like-container');
            let likes=likeContainer.innerHTML;
            postContent.innerHTML+=likes;
        }
    }
    function likesShowComplete(){
        var posts=document.querySelectorAll('.post');

        posts.forEach(function(post){
            let postContent=post.querySelector('.post-content');
            let cortinaPost=post.nextElementSibling;
            let likeContainer=cortinaPost.querySelector('.like-container');
            let likes=likeContainer.innerHTML;
            let likesOld=postContent.querySelector('.like');
            let numLikesOld=postContent.querySelector('.numLikes');
            likesOld.remove();
            numLikesOld.remove();
            postContent.innerHTML+=likes;
        });
    }

    async function checkLikeButton(postId) {
        let response= await fetch('php/check_like.php', {
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
        
                    
                    let comentsContainerOverflow = completePost.querySelector('.overflow-post-content');
                    let comentsContainer = completePost.querySelector('.coments');
                    comentsContainer.innerHTML = "";
                    if(startComent==0){loadComents(selectedPostId);}
                    const handleScroll = () => {
                        const { scrollTop, scrollHeight, clientHeight } = comentsContainerOverflow;
                        if (scrollTop + clientHeight >= scrollHeight - 5) {
                            if(startComent==25){
                            loadComents(selectedPostId);
                            }
                        }
                    };

      
                    comentsContainerOverflow.removeEventListener('scroll', handleScroll);
                    comentsContainerOverflow.addEventListener('scroll', handleScroll);
    }

    function handleCloseIconClick(icon){
        let completePost=icon.parentElement;
        let alert=completePost.parentElement;
        let video=completePost.getElementsByTagName('video')[0];
        let audio=completePost.getElementsByTagName('audio')[0];
        if(alert!==null){
            alert.classList.add('invisible');
            
    }
        document.body.style.overflow = 'auto';
        likesShowComplete();
        if(video!==undefined && video!==null){
            video.pause();
        }
        if(audio!==undefined && audio!==null){
            audio.pause();
        }
    }
  
  

function handleComentClick(coment){
    event.preventDefault();
    var comentario = coment.closest('.form-coment').querySelector('.coment-input').value; 
    var coment1= coment.closest('.form-coment').querySelector('.coment-input');
        if(comentario.length>0){
        fetch('php/coment.php', {
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
            var lastComentHtml = '<div class="coment" id="coment'+ data.comentId +'">' +
                '<div class="coment-content">' +
                '<a href=perfil.php?id=' + data.id +'><p style="padding:10px; margin:0; font-weight:bold;">' + data.username + '</p></a>' +
                '<div style="display:flex; justify-content:space-between;" ><p style="padding-left:50px; margin:0;">' + comentario + '</p>' +
                '<button style="background-color:transparent; border:none;" class="deleteComent" data-comentId="'+data.comentId+'"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button></div>' +
                '</div>' +
                '</div>';
            //document.getElementById('coments'+selectedPostId).innerHTML = lastComentHtml + document.getElementById('coments'+selectedPostId).innerHTML;
            document.getElementById('coments'+selectedPostId).insertAdjacentHTML('afterbegin', lastComentHtml);
            attachListeners();

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
    console.log(selectedPostId);
    var like2=true;
        if(like.src === 'http://localhost/AustrianEconomicsForum/img/like_icon.svg'){
            like2=false;
            console.log('like');
        }
        console.log(like2);
        fetch('php/like.php', {
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
        let icon=options.firstElementChild;
        if(deleteContainer.classList.contains('invisible')){
            deleteContainer.classList.remove('invisible');
            post.classList.add('post-optionsOpen');
            icon.classList.remove('fa-sort-down');
            icon.classList.add('fa-sort-up');
        }else{
            deleteContainer.classList.add('invisible');
            post.classList.remove('post-optionsOpen');
            icon.classList.remove('fa-sort-up');
            icon.classList.add('fa-sort-down');
        }
    }

    function handleDeleteClick(deleteButton){
        var post=deleteButton.closest('.post');
        var postId=post.getAttribute('data-id');
        console.log(postId);
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
            if(data==="deleted"){
                post.remove();
            }
        })
        .catch((error) => {
        console.error('Error:', error);
        });
    }
    function handleDeleteComent(comentId){
        let classComent="coment"+comentId;
        let coment=document.getElementById(classComent);
        fetch('php/delete-coment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'comentId': comentId
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data==="deleted"){
                coment.remove();
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
            let deleteComentButtons=document.querySelectorAll('.deleteComent');
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
            deleteComentButtons.forEach(function(button){
                if(button.listener){
                    button.removeEventListener('click', button.listener);
                }
                button.listener = function() { 
                    const comentId = parseInt(button.getAttribute('data-comentId'), 10);
                    handleDeleteComent(comentId); 
                };
                button.addEventListener('click', button.listener);
            });
       
        
        
    }

    


    function loadComents(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `php/comentarios-post.php?startComent=${startComent}&limitComent=${limitComent}&postId=${id}`, true);  

        xhr.onload = function() {
            if (this.status === 200) {
                var responseData = JSON.parse(this.responseText);
                var data=responseData.coments;
                var userId=responseData.userId;
                let comentHtml="";

                data.forEach(function(coment) {
                    comentHtml+='<div class="coment" id="coment'+ coment.id +'">' +
                    '<div class="coment-content">' +
                    '<a href=perfil.php?id='+ coment.usuario_id +'><p style="padding:10px; margin:0; font-weight:bold;">' + coment.username + '</p></a>' +'<div style="display:flex; justify-content:space-between;" >' +
                    '<p style="padding-left:50px; margin:0;">' + coment.contenido + '</p>';
                    if(coment.usuario_id == userId){
                        comentHtml+='<button style="background-color:transparent; border:none;" class="deleteComent" data-comentId="'+coment.id+'"><i class="fa-solid fa-trash" style="color: #ebebeb;"></i></button></div>';
                    }
                    comentHtml+='</div>' +
                    '</div>';
                    
                });
                document.getElementById('coments'+selectedPostId).innerHTML += comentHtml; 
                if(data.length === limitComent) { startComent += limitComent; } else { startComent += data.length; }
                attachListeners();
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
        
    
