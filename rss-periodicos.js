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
    var date = new Date(unixTimestamp * 1000); // La fecha en JavaScript se maneja en milisegundos, por eso se multiplica por 1000
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
                    titulo=titulo+'-'+fuente;
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
                    var fecha = convertUnixToSpanishDate(new Date(item.getElementsByTagName('pubDate')[0].textContent).getTime() / 1000);
                    var mediaUrlNode = item.getElementsByTagName('media:content')[0];
                    var mediaUrl = mediaUrlNode ? mediaUrlNode.getAttribute('url') : '';

                    noticias.push(new Noticia(titulo, descripcion, link, mediaUrl, fecha, 'ElMundo'));
                }

                resolve(noticias);
            });
        }).catch(reject);
    });
}

async function getElPais() {
    let urlEconomia = 'rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada';
    let urlInternacional = 'rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/internacional/portada';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getElMundo() {
    let urlEconomia = 'rss-proxy.php?url=https://e00-elmundo.uecdn.es/elmundo/rss/economia.xml';
    let urlInternacional = 'rss-proxy.php?url=https://e00-elmundo.uecdn.es/elmundo/rss/internacional.xml';
    let noticiasEconomia = await getNoticiasFromFeedElMundo(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeedElMundo(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getLibreMercado() {
    let urlEconomia = 'rss-proxy.php?url=http://feeds2.feedburner.com/libertaddigital/economia';
    let urlInternacional = 'rss-proxy.php?url=http://feeds2.feedburner.com/libertaddigital/internacional';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getLaVanguardia() {
    let urlEconomia = 'rss-proxy.php?url=https://www.lavanguardia.com/rss/economia.xml';
    let urlInternacional = 'rss-proxy.php?url=https://www.lavanguardia.com/rss/internacional.xml';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getElPeriodico() {
    let urlEconomia = 'rss-proxy.php?url=https://www.elperiodico.com/es/rss/economia/rss.xml';
    let urlInternacional = 'rss-proxy.php?url=https://www.elperiodico.com/es/rss/internacional/rss.xml';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getElEconómista() {
    let urlEconomia = 'rss-proxy.php?url=https://www.eleconomista.es/rss/rss-economia.php';
    let urlInternacional = 'rss-proxy.php?url=https://www.eleconomista.es/rss/rss-category.php?category=tecnologia';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getNos() {
    let urlEconomia = 'rss-proxy.php?url=https://www.nosdiario.gal/rss/economia';
    let urlInternacional = 'rss-proxy.php?url=https://www.nosdiario.gal/rss/internacional';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}

async function getLaVoz() {
    let urlEconomia = 'rss-proxy.php?url=https://www.lavozdegalicia.es/economia/index.xml';
    let urlInternacional = 'rss-proxy.php?url=https://www.lavozdegalicia.es/internacional/index.xml';
    let noticiasEconomia = await getNoticiasFromFeed(urlEconomia);
    let noticiasInternacional = await getNoticiasFromFeed(urlInternacional);
    var news = noticiasEconomia ? (noticiasInternacional ? noticiasEconomia.concat(noticiasInternacional) : noticiasEconomia) : (noticiasInternacional ? noticiasInternacional : []);

    return news;
}
async function getAllNews() {
    let elPais = await getElPais();
    let elMundo = await getElMundo();
    let libreMercado = await getLibreMercado();
    let laVanguardia = await getLaVanguardia();
    let elPeriodico = await getElPeriodico();
    let elEconómista = await getElEconómista();
    let nos = await getNos();
    let laVoz = await getLaVoz();
    var news = elPais.concat(elMundo, libreMercado, laVanguardia, elPeriodico, elEconómista, nos, laVoz);
    newsFinal= news.sort(function(a,b){
        return b.fecha - a.fecha;
    });

    return newsFinal;
}
let currentPage = 1;
const noticiasPorPagina = 15;

function displayNews(news) {
    let i = 0;
    const startIndex = (currentPage - 1) * noticiasPorPagina;
    const endIndex = startIndex + noticiasPorPagina;
    const noticiasPagina = news.slice(startIndex, endIndex);
    noticiasPagina.forEach((noticia) => {
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
        EnlaceTitle.setAttribute('href', noticia.enlace);
        newsTitle.setAttribute('class', 'newsTitle');
        newsTitle.textContent = noticia.titulo + ' - ' + noticia.fuente;
        let media;
        if(noticia.mediaUrl.includes('.mp4')){
            media = document.createElement('video');
            media.setAttribute('src', noticia.mediaUrl);
            media.setAttribute('controls', 'true');
            media.setAttribute('class', 'mediaNews');
            
        }else if(noticia.mediaUrl.includes('.jpg') || noticia.mediaUrl.includes('.png')){
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
        newsDiv.appendChild(media);
        newsDiv.appendChild(newsDescription);
        newsDiv.appendChild(newsDate);
        i++;
    });
    
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
      currentPage++;
      newsArray.then((noticias) => displayNews(noticias));
    }
  });


const filtro= document.getElementById('form-periodicos');
const inputs= document.querySelectorAll('#form-periodicos input');
const checkeds= Array.from(inputs).filter(input => input.checked);
const values= checkeds.map(input => input.value);
var linksEconomia=[];
var linksInternacional=[];

if (values.includes('ElPais')){

    linksEconomia.push('rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada');
    linksInternacional.push('rss-proxy.php?url=https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/internacional/portada');
}
else if (values.includes('ElMundo')){
    linksEconomia.push('rss-proxy.php?url=https://www.elmundo.es/rss/economia.xml');
    linksInternacional.push('rss-proxy.php?url=https://www.elmundo.es/rss/internacional.xml');
}
else if (values.includes('ElEconómista')){
    linksEconomia.push('rss-proxy.php?url=https://www.eleconomista.es/rss/rss-economia.php');
    linksInternacional.push('rss-proxy.php?url=https://www.eleconomista.es/rss/rss-flash-del-dia.php');
}
else if (values.includes('LaVanguardia')){
    linksEconomia.push('rss-proxy.php?url=https://www.lavanguardia.com/mvc/feed/rss/economia');
    linksInternacional.push('rss-proxy.php?url=https://www.lavanguardia.com/mvc/feed/rss/internacional');
}
else if (values.includes('ElPeriodico')){
    linksEconomia.push('rss-proxy.php?url=https://www.elperiodico.com/es/rss/economia/rss.xml');
    linksInternacional.push('rss-proxy.php?url=https://www.elperiodico.com/es/rss/internacional/rss.xml');
}
else if (values.includes('LibreMercado')){
    linksEconomia.push('rss-proxy.php?url=https://www.libremercado.com/rss/economia/');
    linksInternacional.push('rss-proxy.php?url=https://www.libremercado.com/rss/internacional/');
}
else if (values.includes('LaVoz')){
    linksEconomia.push('rss-proxy.php?url=https://www.lavozdegalicia.es/rss/finanzas.xml');
    linksInternacional.push('rss-proxy.php?url=https://www.lavozdegalicia.es/rss/internacional.xml');
}
else if (values.includes('NosDiario')){
    linksEconomia.push('rss-proxy.php?url=https://www.nosdiario.gal/rss/economia');
    linksInternacional.push('rss-proxy.php?url=https://www.nosdiario.gal/rss/internacional');
}
  // Mostrar las noticias al cargar la página

QuitarFiltro();
const newsArray=getAllNews();
newsArray.then(noticias =>{ 
    displayNews(noticias);
    MostrarFiltro();
});

