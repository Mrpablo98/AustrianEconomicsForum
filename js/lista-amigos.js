document.addEventListener('DOMContentLoaded', function() {

    function getQueryParam(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }
    
       

    var id=getQueryParam('id');
    
    const friends=document.getElementById('friends');
    const friendsList=document.getElementById('friendsList');
    const friendsListMovil=document.getElementById('friendsListMovil');
    var toggle=false;
    friends.addEventListener('click',(event)=>{
        getFriends().then(()=>{
            event.preventDefault();
        if(toggle==false){
            if(window.innerWidth>1263){
            friendsList.style.height='700px';
            friendsList.style.border='1px solid rgba(255, 255, 255, 0.301)';
        }else{
            friendsListMovil.style.height='700px';
            friendsListMovil.style.border='1px solid rgba(255, 255, 255, 0.301)';
        }
            toggle=true;
           
        }else{
            if(window.innerWidth>1263){
                friendsList.style.height='0px';
                friendsList.style.border='none';
            }else{
                friendsListMovil.style.height='0px';
                friendsListMovil.style.border='none';
            }
            toggle=false;
        }
        });
        

    });
    
   async function getFriends(){
        const xhr=new XMLHttpRequest();
        xhr.open('GET','php/lista-amigos.php?id='+id);
        xhr.onload=function(){
            if(this.status===200){
                var response=JSON.parse(this.responseText);
                var data=response.amigos;
                loggedUserId=response.loggedUserId;
                if(data.length==0){
                    if(window.innerWidth>1263){
                        friendsList.innerHTML='<p>No tienes amigos</p>';
                    }else{
                        friendsListMovil.innerHTML='<p>No tienes amigos</p>';
                    }
                }else{
                    var friendDiv="";
                for(const friend of data){
                    friendDiv+="<div class='friendDiv'><img src='img/icon.png' class='index-perfil-img'><a href='perfil.php?id="+ friend.id +"'><p>"+ friend.nombre +"</p>";if(id==loggedUserId){friendDiv+="</a><button class='deleteUser' data-id="+ friend.id +">Eliminar</button></div>"};
                };
                if(window.innerWidth>1263){
                    friendsList.innerHTML=friendDiv;
                }else{
                    friendsListMovil.innerHTML=friendDiv;
                }
                var deleteButtons=friendsList.querySelectorAll('.deleteUser');
                console.log(deleteButtons);
                deleteButtons.forEach((button)=>{
                    button.addEventListener('click',(event)=>{
                        userId=button.dataset.id;
                        event.preventDefault();
                        console.log(userId);
                        const xhr=new XMLHttpRequest();
                        xhr.open('POST','php/delete-friend2.php');
                        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                        xhr.onload=function(){
                            if(this.status===200){
                                console.log(this.responseText);
                                getFriends();
                            }else{
                                console.log(this.status);
                            }
                        };
                        xhr.send('id='+userId);
                    })
                })
                }
            }
        };
        xhr.send();
    };

   
    
});