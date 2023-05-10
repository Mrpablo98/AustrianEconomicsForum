document.addEventListener('DOMContentLoaded', function() {


        $('#search').on('input', function() {
            var searchQuery = $(this).val();
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {
                    search: searchQuery
                },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        });

    

const buttonSearch=document.getElementById('search-button');
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
        drop=false;
    }

});

});

