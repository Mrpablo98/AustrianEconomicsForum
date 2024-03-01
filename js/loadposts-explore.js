



/*document.addEventListener('DOMContentLoaded', function() {*/
   
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
class Post{
constructor(id, usuarioId, titulo, contenido, nombre, postUrl, tipo){
    this.id=id;
    this.usuarioId=usuarioId;
    this.titulo=titulo;
    this.contenido=contenido;
    this.nombre=nombre;
    this.postUrl=postUrl;
    this.tipo=tipo;
}
}
let posts=[];
let userId=0;
let publications=[];
async function loadPosts() {
    if(loading){return;}
    loading=true;

    try {
        const response = await fetch(`php/posts-explorar.php?start=${start}&limit=${limit}&id=${id}`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        var responseData = await response.json();
         if(responseData.posts.length==0){
             window.removeEventListener('scroll', handleScroll);
             window.removeEventListener('touchmove', handleScroll);
        }
        publications=responseData.posts;
        posts=[];
        for(let post of publications){
            posts.push(new Post(post.id, post.usuario_id, post.titulo, post.contenido, post.nombre, post.url_recurso, post.tipo));
            console.log("respuesta:" + post);
        }
        console.log(posts)
        
        userId=responseData.userId;
        return posts;

        
    } catch (error) {
        console.error('Hubo un error al obtener los posts:', error);
    } 
}


 async function displayPosts(posts) {

    
    if(posts.length>0){
        for(const post of posts) {
            console.log(post);
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
            
            var postHtml = '<div style="display: none;" class="post" data-id="'+post.id+'">'; 
        if(post.usuario_id==userId){postHtml+='<div class="post-options"><i class="fas fa-sort-down fa-lg" style="color: #c0c0c0;"></i></div>';}
            postHtml+= '<div class="post-content">' +
                        '<h2 style="text-align:center;">' + post.titulo + ' || ' +'<a href="perfil?id='+ post.usuarioId + '">' + post.nombre + '</a>' + '</h2>' +
                        '<p style="text-align:center;">' + content + '</p>' +
                        '</div>';
                        if(post.postUrl!=null){if(post.tipo=="imagen"){postHtml+='<div class="post-image">' +
                            '<img class="post-img" src="' + post.postUrl + '" />' +
                        '</div>';}else if(post.tipo=="video"){postHtml+='<div class="post-image">' +
                        '<video class="post-img" src="' + post.postUrl + '" controls />' +
                    '</div>';}else if(post.tipo=="audio"){postHtml+='<div class="post-image">' + "<audio class='post-audio' src='" + post.postUrl + "' controls></audio>" + '</div>';}else if(post.tipo=="archivo"){postHtml+='<div class="post-image">' + "<a class='post-archivo' href='" + post.postUrl + "'>"+ post.titulo +"<i class='fa-solid fa-file-arrow-down' style='color: #dbdbdb;'></i></a>" + '</div>';}}
                        postHtml+='<div class="post-arrow">' + 
                            '<i class="more-icon fas fa-chevron-right fa-lg" style="color: #d9d9d9;"></i>' +
                        '</div>';
                        if(post.usuarioId==userId){postHtml+='<div class="container-delete invisible"><button class="deleteButton">Eliminar</button><button class="editButton">Editar</button></div>'};
                    postHtml+='</div>';
                    
                    postHtml+='<div class="cortina-post invisible">' +
                        '<div class="complete-Post ">' +
                            '<div class="complete-post-image invisible">';
                                if(post.url_recurso!=null){if(post.tipo=="imagen"){postHtml+='<div class="media"><img src="' + post.url_recurso + '" /></div>';
                            }else if(post.tipo=="video"){postHtml+='<div class="media"><video src="' + post.url_recurso + '" controls ></video></div>';}else if(post.tipo=="audio"){postHtml+='<div class="cortina-audio"><audio src="' + post.url_recurso + '" controls ></audio></div>';}else if(post.tipo=="archivo"){postHtml+='<div class="post-image">' + "<a class='post-archivo' href='" + post.url_recurso + "'>"+ post.titulo +"<i class='fa-solid fa-file-arrow-down' style='color: #dbdbdb;'></i></a>" + '</div>';}};
                              postHtml+= '<div>'+
                              '<div class="share-div"><h2 style="text-align:center;">' + post.titulo + ' || ' + '<a href="perfil?id='+ post.usuario_id + '">' + post.nombre + '</h2></a>' + '<svg class="share" fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 458.624 458.624" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M339.588,314.529c-14.215,0-27.456,4.133-38.621,11.239l-112.682-78.67c1.809-6.315,2.798-12.976,2.798-19.871 c0-6.896-0.989-13.557-2.798-19.871l109.64-76.547c11.764,8.356,26.133,13.286,41.662,13.286c39.79,0,72.047-32.257,72.047-72.047 C411.634,32.258,379.378,0,339.588,0c-39.79,0-72.047,32.257-72.047,72.047c0,5.255,0.578,10.373,1.646,15.308l-112.424,78.491 c-10.974-6.759-23.892-10.666-37.727-10.666c-39.79,0-72.047,32.257-72.047,72.047s32.256,72.047,72.047,72.047 c13.834,0,26.753-3.907,37.727-10.666l113.292,79.097c-1.629,6.017-2.514,12.34-2.514,18.872c0,39.79,32.257,72.047,72.047,72.047 c39.79,0,72.047-32.257,72.047-72.047C411.635,346.787,379.378,314.529,339.588,314.529z"></path> </g> </g> </g></svg></div>' +
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




            document.querySelector('#posts').insertAdjacentHTML('beforeend', postHtml);
            
        };
    }else if(posts.length==0 && start==0){
            let indexNoPosts=document.querySelector('.indexNoPost');
            indexNoPosts.classList.remove('invisible');
            let indexTitle=document.querySelector('.indexTitle');
            indexTitle.classList.add('invisible');
    }
    likesShow(start);
    if(posts.length === 10){start += limit;}else{start+=posts.length;}
    loading=false;
    attachListeners();



}



async function loadPostsDate() {
    if(loading){return;}
    loading=true;

    try {
        const response = await fetch(`php/posts-explorar-fechas.php?start=${start}&limit=${limit}&id=${id}`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

         var responseData = await response.json();
         if(responseData.posts.length==0){
             window.removeEventListener('scroll', handleScroll);
             window.removeEventListener('touchmove', handleScroll);
        }
        publications=responseData.posts;
        posts=[];
        for(let post of publications){
            posts.push(new Post(post.id, post.usuario_id, post.titulo, post.contenido, post.nombre, post.url_recurso, post.tipo));
            console.log("respuesta:" + post);
        }
        console.log(posts)
        
        userId=responseData.userId;
        return posts;

        
    } catch (error) {
        console.error('Hubo un error al obtener los posts:', error);
    }  finally {
        loading = false;
    }
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
        postContent.innerHTML+=likes;
    });
}

function likesShowBig(){
    var posts=document.querySelectorAll('.post');

    posts.forEach(function(post){
        let postContent=post.querySelector('.post-content');
        let cortinaPost=post.nextElementSibling;
        let likeContainer=cortinaPost.querySelector('.like-container');
        let likes=postContent.querySelector('.numLikes');
        let likeImg=postContent.querySelector('.like');
        let likeContainerImg=likeContainer.querySelector('.like');
        let numLikesContainer=likeContainer.querySelector('.numLikes');
        likeContainerImg.remove();
        numLikesContainer.remove();
        likeContainer.appendChild(likeImg);
        likeContainer.appendChild(likes);
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
                likesShowBig();
                
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
    attachListeners();
    if(video!==undefined && video!==null){
        video.pause();
    }
    if(audio!==undefined && audio!==null){
        audio.pause();
    }
}





  function handleLikeClick(like){
    let container = like.closest('.like-container');
    let countLikes=null;
    if (container !== null) {
      countLikes = container.querySelector('.numLikes');
    // Realizar operaciones con numLikes
    } else {
     countLikes=like.nextElementSibling;
     let postcontent=like.parentNode;
     let post=postcontent.parentNode;
     selectedPostId=post.getAttribute('data-id');
     
    }
    let numLikes=parseInt(countLikes.innerHTML);
    let like2=true;
        if(like.src === 'http://localhost/AustrianEconomicsForum/img/like_icon.svg'){
            like2=false;
        }
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
function handleShareClick(postId){
    let texto="http://localhost/AustrianEconomicsForum/post.php?p="+postId;
    navigator.clipboard.writeText(texto)
    .then(() => {
        alert("Enlace copiado al portapapeles: " + texto);
    })
    .catch(err => {
        console.error('Error al copiar al portapapeles: ', err);
        alert('No se pudo copiar al portapapeles');
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
        shareButtons.forEach(function(share){
            if(share.listener){
                share.removeEventListener('click', share.listener);
            }
            share.listener = function() { 
                let postId = parseInt(share.getAttribute('post-id'), 10);
                console.log(postId);
                handleShareClick(postId); 
            };
            share.addEventListener('click', share.listener);
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
                '<a href=perfil?id='+ coment.usuario_id +'><p style="padding:10px; margin:0; font-weight:bold;">' + coment.username + '</p></a>' +'<div style="display:flex; justify-content:space-between;" >' +
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


function quitarLoading(){
    document.getElementById('loading').style.display = 'none';
    let loading2=document.querySelectorAll('.loading2');
    if(loading2){loading2.forEach(function(loading2){loading2.style.display = 'none';})};
    let posts=document.querySelectorAll('.post');
    posts.forEach(function(post){
        post.style.display="flex";
    });
}



loadPosts().then(posts => {
    
    displayPosts(posts).then(() => {quitarLoading();
     if(posts.length>0){
     // Escuchar el evento scroll para navegadores de escritorio
window.addEventListener('scroll', handleScroll);

// Escuchar el evento touchmove para dispositivos móviles
window.addEventListener('touchmove', handleScroll);
    }
});
}).catch(error => {
    console.error('Hubo un error al obtener los posts:', error);
});



let isLoading = false;
 let filtrosFecha=document.getElementById('filtrosFecha');
let timeout;
function handleScroll() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        const { scrollY, innerHeight } = window;
        const { scrollHeight } = document.documentElement;
        
        if (scrollY + innerHeight >= scrollHeight - 5 && !isLoading && !loading) {
            isLoading = true;
            if(filtrosFecha.classList.contains('selected')){
            let contentContainer=document.querySelector('.content-container');
            let loading2='<img class="loading2" style="with:20%; margin:0 auto;" src="img/gif_loading.gif">';
             contentContainer.insertAdjacentHTML('beforeend', loading2);
            loadPostsDate().then(responseData => {
                displayPosts(responseData).then(() => {quitarLoading();isLoading = false;});
                
            }).catch(error => {
                console.error('Hubo un error al obtener los posts:', error);
                isLoading = false;
            });
        }else{
            let contentContainer=document.querySelector('.content-container');
            let loading2='<img class="loading2" style="with:20%; margin:0 auto;" src="img/gif_loading.gif">';
             contentContainer.insertAdjacentHTML('beforeend', loading2);
            loadPosts().then(responseData => {
                displayPosts(responseData).then(() => {quitarLoading();isLoading = false;});
                
            }).catch(error => {
                console.error('Hubo un error al obtener los posts:', error);
                //isLoading = false;
            });
        }
        }
    }, 200); // Esto retrasa la ejecución de la función por 200ms
}



 




//});



function postfecha(){
var fecha = document.getElementById('filtrosFecha');
var likes = document.getElementById('filtrosLikes');
var filtros=document.querySelector('.filtrosExplorar');
start=0;

if(fecha.classList.contains('unselected')){
    document.querySelector('#posts').innerHTML =""; 
    document.querySelector('#posts').innerHTML +="<img src='img/gif_loading.gif' id='loading'>";
    fecha.classList.remove('unselected');
    fecha.classList.add('selected');
    likes.classList.remove('selected');
    likes.classList.add('unselected');
    likes.classList.add('invisible');
    loadPostsDate().then(responseData => {displayPosts(responseData).then(()=>{quitarLoading();
    likes.classList.remove('invisible');
     window.addEventListener('scroll', handleScroll);
     window.addEventListener('touchmove', handleScroll);
    })}).catch(error => {});
}

}
function postlikes(){
var fecha = document.getElementById('filtrosFecha');
var likes = document.getElementById('filtrosLikes');
start=0;

if(likes.classList.contains('unselected')){
    document.querySelector('#posts').innerHTML =""; 
    document.querySelector('#posts').innerHTML +="<img src='img/gif_loading.gif' id='loading'>";
    likes.classList.remove('unselected');
    likes.classList.add('selected');
    fecha.classList.remove('selected');
    fecha.classList.add('unselected');
    fecha.classList.add('invisible');
loadPosts().then(responseData => {
    
    displayPosts(responseData).then(() => {quitarLoading();
    fecha.classList.remove('invisible');
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('touchmove', handleScroll);
    });
}).catch(error => {
    console.error('Hubo un error al obtener los posts:', error);
});
}

}


