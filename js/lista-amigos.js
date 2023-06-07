document.addEventListener('DOMContentLoaded', function() {

  
    var Friends=getFriends();
       


    const friends=document.getElementById('friends');
    const friendsList=document.getElementById('friendsList');
    var toggle=false;
    friends.addEventListener('click',(event)=>{
        event.preventDefault();
        if(toggle==false){
            friendsList.style.height='700px';
            friendsList.style.border='1px solid rgba(255, 255, 255, 0.301)';
            toggle=true;
           
        }else{
            friendsList.style.height='0px';
            friendsList.style.border='none';
            toggle=false;
        }

    });
    
   async function getFriends(){
        const xhr=new XMLHttpRequest();
        xhr.open('GET','php/lista-amigos.php');
        xhr.onload=function(){
            if(this.status===200){
                console.log(this.responseText);
                var data=JSON.parse(this.responseText);
                if(data.length==0){
                    friendsList.innerHTML='<p>No tienes amigos</p>';
                }else{
                    var friendDiv="";
                for(const friend of data){
                    friendDiv+="<div class='friendDiv'><img src='img/icon.png' class='index-perfil-img'><p>"+ friend.nombre +"</p><button class='deleteUser' data-id="+ friend.id +">Eliminar</button></div>";
                };
                friendsList.innerHTML=friendDiv;
                var deleteButtons=friendsList.querySelectorAll('.deleteUser');
                console.log(deleteButtons);
                deleteButtons.forEach((button)=>{
                    console.log(button);
                    button.addEventListener('click',(event)=>{
                        userId=button.dataset.id;
                        event.preventDefault();
                        console.log(userId);
                        const xhr=new XMLHttpRequest();
                        xhr.open('POST','php/delete-friend.php');
                        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                        xhr.onload=function(){
                            if(this.status===200){
                                console.log(this.responseText);
                                getFriends();
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