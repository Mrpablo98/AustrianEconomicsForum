class Noticia {
    constructor(titulo, descripcion, link, mediaUrl, fecha, fuente) {
        this.titulo = titulo;
        this.descripcion = descripcion;
        this.link = link;
        this.mediaUrl = mediaUrl;
        this.fecha = fecha;
        this.fuente = fuente;
    }
}

function parseXml(xmlStr) {
    return new window.DOMParser().parseFromString(xmlStr, "text/xml");
}


function convertUnixToSpanishDate(unixTimestamp) {
    var date = new Date(unixTimestamp * 1000);
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', timeZone: 'Europe/Madrid' };
    return date.toLocaleString('es-ES', options);
}

function getNoticiasFromFeed(url) {
    return new Promise((resolve, reject) => {
        fetch(url).then(function(response) {
            response.text().then(function(xmlText) {
                var xmlDoc = parseXml(xmlText);
                var items = xmlDoc.getElementsByTagName('item');
                var noticias = [];

                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    var titulo = item.getElementsByTagName('title')[0].textContent;
                    var descripcion = item.getElementsByTagName('description')[0].textContent;
                    var link = item.getElementsByTagName('link')[0].textContent;
                    var fecha = (new Date(item.getElementsByTagName('pubDate')[0].textContent).getTime() / 1000);
                    var mediaUrlNode = item.getElementsByTagName('enclosure')[0] || item.getElementsByTagName('media:content')[0];
                    var mediaUrl = mediaUrlNode ? mediaUrlNode.getAttribute('url') : '';
                    var fuente='';
                    if(url.includes('libertaddigital')) fuente='LibreMercado';
                    else if(url.includes('elpais')) fuente='ElPais';
                    else if(url.includes('lavanguardia')) fuente='LaVanguardia';
                    else if(url.includes('elmundo')) fuente='ElMundo';
                    else if(url.includes('vozdegalicia')) fuente='LaVozDeGalicia';
                    else if(url.includes('nosdiario')) fuente='NòsDiario';
                    else if(url.includes('elperiodico')) fuente='Elperiodico';
                    else if(url.includes('eleconomista')) fuente='ElEconómista';
                    titulo=titulo+' - '+fuente;
                    noticias.push(new Noticia(titulo, descripcion, link, mediaUrl, fecha, fuente));
                }

                resolve(noticias);
            });
        }).catch(reject);
    });
}
function getNoticiasFromFeedElMundo(url) {
    return new Promise((resolve, reject) => {
        fetch(url).then(function(response) {
            response.text().then(function(xmlText) {
                var xmlDoc = parseXml(xmlText);
                var items = xmlDoc.getElementsByTagName('item');
                var noticias = [];

                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    var titulo = item.getElementsByTagName('title')[0].textContent;
                    var descripcion = item.getElementsByTagName('media:description')[0].textContent;
                    var link = item.getElementsByTagName('link')[0].textContent;
                    var fecha = new Date(item.getElementsByTagName('pubDate')[0].textContent).getTime() / 1000;
                    var mediaUrlNode = item.getElementsByTagName('media:content')[0];
                    var mediaUrl = mediaUrlNode ? mediaUrlNode.getAttribute('url') : '';
                    var fuente='ElMundo';
                    titulo=titulo+' - '+fuente;
                    noticias.push(new Noticia(titulo, descripcion, link, mediaUrl, fecha, fuente));
                }

                resolve(noticias);
            });
        }).catch(reject);
    });
}


async function getPeriodicos(arrayEconomia, arrayInternacional) {
    var news = [];
    for(let i=0; i<arrayEconomia.length; i++) {
        let urlEconomia = arrayEconomia[i];
        let urlInternacional = arrayInternacional[i];
        let noticiasEconomia=[];
        let noticiasInternacional=[];
        if(urlEconomia.includes('elmundo')){
            noticiasEconomia = await getNoticiasFromFeedElMundo(urlEconomia);
            noticiasInternacional = await getNoticiasFromFeedElMundo(urlInternacional);
        }else{
            noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
            noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
        }
        news = news.concat(noticiasEconomia, noticiasInternacional);
    }
    return news;
}
async function getAllNews(arrayEconomia, arrayInternacional) {
    
    let noticias= await getPeriodicos(arrayEconomia, arrayInternacional);
    newsFinal= noticias.sort(function(a,b){
        return b.fecha - a.fecha;
    });

    return newsFinal;
}
let currentPage = 1;
const noticiasPorPagina = 10;

function displayNews(news) {
    let i = 0;
    const startIndex = (currentPage - 1) * noticiasPorPagina;
    const endIndex = startIndex + noticiasPorPagina;
    const noticiasPagina = news.slice(startIndex, endIndex);
    noticiasPagina.forEach((noticia) => {
        let newsContainer= document.getElementById('newsContainer');
        let newsDiv = document.createElement('div');
        if(i%2==0){
            newsDiv.setAttribute('class', 'news');
        }else{
            newsDiv.setAttribute('class', 'news1');
        }
        
        let newsTitle = document.createElement('h2');
        let newsDescription = document.createElement('p');
        let EnlaceTitle= document.createElement('a');
        EnlaceTitle.setAttribute('target', '_blank');
        EnlaceTitle.setAttribute('class', 'EnlaceTitle');
        EnlaceTitle.setAttribute('href', noticia.link);
        newsTitle.setAttribute('class', 'newsTitle');
        newsTitle.textContent = noticia.titulo;
        let media;
        if(noticia.mediaUrl.includes('.mp4')){
            media = document.createElement('video');
            media.setAttribute('src', noticia.mediaUrl);
            media.setAttribute('controls', 'true');
            media.setAttribute('class', 'mediaNews');
            
        }else if(noticia.mediaUrl.includes('.jpg') || noticia.mediaUrl.includes('.png') || noticia.mediaUrl.includes('.jpeg')){
            media = document.createElement('img');
            media.setAttribute('src', noticia.mediaUrl);
            media.setAttribute('class', 'mediaNews');
            
        }else{
            media= document.createElement('div');
            media.setAttribute('class', 'NomediaNews');
            icon= document.createElement('i');
            mediaText= document.createElement('p');
            icon.setAttribute('class', 'fa-sharp fa-solid fa-eye-slash fa-xl');
            media.textContent = 'No hay imágenes disponibles';
            media.appendChild(icon);
            media.appendChild(mediaText);
        }
        
            newsDate= document.createElement('p');
            newsDate.setAttribute('class', 'newsDate');
            newsDate.textContent = convertUnixToSpanishDate(noticia.fecha);
            newsTitle.textContent = noticia.titulo;
            newsDescription.setAttribute('class', 'newsDescription');
            newsDescription.textContent = noticia.descripcion;
            newsContainer.appendChild(newsDiv);
            newsDiv.appendChild(EnlaceTitle);
            EnlaceTitle.appendChild(newsTitle);
            if(noticia.link.includes('elperiodico')){
                newsDiv.innerHTML = "<a target='_blank' href="+noticia.link+"><h2>"+noticia.titulo+"</h2></a>" + noticia.descripcion;
            }else{
                
                newsDiv.appendChild(media);
                newsDiv.appendChild(newsDescription);
                newsDiv.appendChild(newsDate);
        }
        i++;
        
    });
    currentPage++;
    
}
function QuitarFiltro(){
    let filter= document.getElementById('form-periodicos');
    filter.style.display = 'none';
}
function MostrarFiltro(){
    let filter= document.getElementById('form-periodicos');
    let loading= document.getElementById('loading');
    filter.style.display = 'flex';
    loading.style.display = 'none';
}
window.addEventListener('scroll', () => {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
  
    if (scrollTop + clientHeight >= scrollHeight - 5) {
      newsArray.then((noticias) => displayNews(noticias));
    }
  });

 
const filtro= document.getElementById('form-periodicos');

function enlaces(){
const inputs= document.querySelectorAll('#form-periodicos input');
const checkeds= Array.from(inputs).filter(input => input.checked);
const values= checkeds.map(input => input.value);
var linksEconomia=[];
var linksInternacional=[];
    if (values.includes('ElPais')){

        linksEconomia.push('php/rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada');
        linksInternacional.push('php/rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/internacional/portada');
    }else{
       linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/internacional/portada');
    }
    if (values.includes('ElMundo')){
        linksEconomia.push('php/rss-proxy.php?url=https://e00-elmundo.uecdn.es/elmundo/rss/economia.xml');
        linksInternacional.push('php/rss-proxy.php?url=https://e00-elmundo.uecdn.es/elmundo/rss/internacional.xml');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://e00-elmundo.uecdn.es/elmundo/rss/economia.xml');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://e00-elmundo.uecdn.es/elmundo/rss/internacional.xml');
    }
    if (values.includes('ElEconomista')){
        linksEconomia.push('php/rss-proxy.php?url=https://www.eleconomista.es/rss/rss-economia.php');
        linksInternacional.push('php/rss-proxy.php?url=https://www.eleconomista.es/rss/rss-category.php?category=tecnologia');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://www.eleconomista.es/rss/rss-economia.php');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://www.eleconomista.es/rss/rss-category.php?category=tecnologia');
    }
    if (values.includes('LaVanguardia')){
        linksEconomia.push('php/rss-proxy.php?url=https://www.lavanguardia.com/rss/economia.xml');
        linksInternacional.push('php/rss-proxy.php?url=https://www.lavanguardia.com/rss/internacional.xml');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://www.lavanguardia.com/rss/economia.xml');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://www.lavanguardia.com/rss/internacional.xml');
    }
    if (values.includes('ElPeriodico')){
        linksEconomia.push('php/rss-proxy.php?url=https://www.elperiodico.com/es/rss/economia/rss.xml');
        linksInternacional.push('php/rss-proxy.php?url=https://www.elperiodico.com/es/rss/internacional/rss.xml');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://www.elperiodico.com/es/rss/economia/rss.xml');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://www.elperiodico.com/es/rss/internacional/rss.xml');
    }
    if (values.includes('LibreMercado')){
        linksEconomia.push('php/rss-proxy.php?url=http://feeds2.feedburner.com/libertaddigital/economia');
        linksInternacional.push('php/rss-proxy.php?url=http://feeds2.feedburner.com/libertaddigital/internacional');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=http://feeds2.feedburner.com/libertaddigital/economia');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=http://feeds2.feedburner.com/libertaddigital/internacional');
    }
    if (values.includes('LaVoz')){
        linksEconomia.push('php/rss-proxy.php?url=https://www.lavozdegalicia.es/economia/index.xml');
        linksInternacional.push('php/rss-proxy.php?url=https://www.lavozdegalicia.es/internacional/index.xml');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://www.lavozdegalicia.es/economia/index.xml');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://www.lavozdegalicia.es/internacional/index.xml');
    }
    if (values.includes('NosDiario')){
        linksEconomia.push('php/rss-proxy.php?url=https://www.nosdiario.gal/rss/economia');
        linksInternacional.push('php/rss-proxy.php?url=https://www.nosdiario.gal/rss/internacional');
    }else{
        linksEconomia=linksEconomia.filter(item=> item!=='php/rss-proxy.php?url=https://www.nosdiario.gal/rss/economia');
        linksInternacional=linksInternacional.filter(item=>item!=='php/rss-proxy.php?url=https://www.nosdiario.gal/rss/internacional');
    }
    return [linksEconomia, linksInternacional];
}
function clear(){
    let newsDivs= document.querySelectorAll('.news');
    let newsDivs1= document.querySelectorAll('.news1');
    newsDivs.forEach(div => div.remove());
    newsDivs1.forEach(div => div.remove()); 
}

const filterButton= document.getElementById('filtrar');

filterButton.addEventListener('click', () =>{
    currentPage=1;
    let loading= document.getElementById('loading');
    QuitarFiltro();
    newsArray=[];
    clear();
    [linksEconomia, linksInternacional]=enlaces();
    loading.style.display = 'flex';
    newsArray=getAllNews(linksEconomia, linksInternacional);
console.log(linksEconomia);
newsArray.then(noticias =>{ 
    console.log(noticias);
    displayNews(noticias);
    MostrarFiltro();
});


});


  //Mostrar las noticias al cargar la página

QuitarFiltro();
let [linksEconomia, linksInternacional]=enlaces();
console.log(linksEconomia);
var newsArray=getAllNews(linksEconomia, linksInternacional);
newsArray.then(noticias =>{ 
    console.log(noticias);
    displayNews(noticias);
    MostrarFiltro();
});


