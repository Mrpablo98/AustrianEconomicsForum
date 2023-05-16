document.addEventListener('DOMContentLoaded', function() {
    
    document.getElementById('search-bar').addEventListener('input', function() {
        var searchQuery = this.value;
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'search.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                console.log(this.responseText);
                resultCont.style.display='block';
                document.getElementById('result').innerHTML = this.responseText;
            } else {
                console.error('Hubo un error en la solicitud:', this.status, this.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Hubo un error al hacer la solicitud:', this.status, this.statusText);
        };
        xhr.send('search=' + encodeURIComponent(searchQuery));
    });
    

const buttonSearch=document.getElementById('search-button');
const resultCont=document.getElementById('result');
const searchContainer=document.getElementById('search-bar-container');

let drop=false;
buttonSearch.addEventListener('click',()=>{
    if(drop==false){
        searchContainer.style.height='4vh';
        searchContainer.style.borderBottom='1px solid rgba(255, 255, 255, 0.301)';
        drop=true;
    }else{
        searchContainer.style.height='0vh';
        searchContainer.style.border='none';
        resultCont.style.display='none';
        drop=false;
    }

});
document.addEventListener('click',function(e){
    resultCont.style.display='none';
});

});

