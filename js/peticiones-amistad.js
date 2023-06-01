document.addEventListener('DOMContentLoaded', function() {
   async function getPeticiones(){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'peticiones-amistad.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            console.log(this.responseText);
            if (this.responseText.trim() === '') {
                console.log('La respuesta está vacía');
            } else {
                let notificacion=document.getElementById('notificacion');
                let notiBall=document.getElementById('noti-ball');
                notificacion.classList.add('notification');
                notiBall.classList.add('noti-ball');
                document.getElementById('lista-peticiones').innerHTML = this.responseText;
            }
        } else {
            console.error('Hubo un error en la solicitud:', this.status, this.statusText);
        }
    }
    xhr.send(); 
   
   };
    function attachListeners(){
        notificacion.addEventListener('click',()=>{
            let listaPeticiones=document.getElementById('lista-peticiones');
            listaPeticiones.style.visibility='visible';
            listaPeticiones.style.height='auto';
    
    
        });
        var listaPeticiones = document.getElementById('lista-peticiones');

        listaPeticiones.addEventListener('click', function(event) {
            var button = event.target;
            if (button.classList.contains('aceptar-button')) {
                console.log('aceptar');
                userId=button.previousElementSibling.value;
                // ...resto del código para aceptar...
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'aceptar-rechazar-amistad.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        console.log(this.responseText);
                        if (this.responseText.trim() === '') {
                            console.log('La respuesta está vacía');
                        } else {
                            document.getElementById('lista-peticiones').innerHTML = this.responseText;
                        }
                    } else {
                        console.error('Hubo un error en la solicitud:', this.status, this.statusText);
                    }
                }
                var datos='userId='+encodeURIComponent(userId)+'&accion=aceptar';
                xhr.send(datos);
            } else if (button.classList.contains('cancelar-button')) {
                
                console.log('cancelar');
                let aceptarButton1=button.previousElementSibling;
                userId=aceptarButton1.previousElementSibling.value;
                // ...resto del código para cancelar...
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'aceptar-rechazar-amistad.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        console.log(this.responseText);
                        if (this.responseText.trim() === '') {
                            console.log('La respuesta está vacía');
                        } else {
                            document.getElementById('lista-peticiones').innerHTML = this.responseText;
                        }
                    } else {
                        console.error('Hubo un error en la solicitud:', this.status, this.statusText);
                    }
                }
                var datos='userId='+encodeURIComponent(userId)+'&accion=cancelar';
                xhr.send(datos);
            }
        });
       /* var aceptarButton=document.querySelectorAll('.aceptar-button');
        var cancelarButton=document.querySelectorAll('.cancelar-button');
    
        aceptarButton.forEach((button)=>{
            button.addEventListener('click',()=>{
                console.log('aceptar');
                userId=button.previousElementSibling.value;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'aceptar-rechazar-amistad.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        console.log(this.responseText);
                        if (this.responseText.trim() === '') {
                            console.log('La respuesta está vacía');
                        } else {
                            document.getElementById('lista-peticiones').innerHTML = this.responseText;
                        }
                    } else {
                        console.error('Hubo un error en la solicitud:', this.status, this.statusText);
                    }
                }
                var datos='userId='+encodeURIComponent(userId)+'&accion=aceptar';
                xhr.send(datos);
            });
        });
    
        cancelarButton.forEach((button)=>{
            button.addEventListener('click',()=>{
                console.log('cancelar');
                let aceptarButton1=button.previousElementSibling;
                userId=aceptarButton1.previousElementSibling.value;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'aceptar-rechazar-amistad.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        console.log(this.responseText);
                        if (this.responseText.trim() === '') {
                            console.log('La respuesta está vacía');
                        } else {
                            document.getElementById('lista-peticiones').innerHTML = this.responseText;
                        }
                    } else {
                        console.error('Hubo un error en la solicitud:', this.status, this.statusText);
                    }
                }
                var datos='userId='+encodeURIComponent(userId)+'&accion=aceptar';
                xhr.send(datos);
            });
        });*/
    };

    var peticiones=getPeticiones();
    peticiones.then(()=>{
        attachListeners();
    });
});