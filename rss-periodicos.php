<?php


class Noticia {
    public $titulo;
    public $descripcion;
    public $link;
    public $media_url;
    public $fecha;
    public $fuente;

    public function __construct($titulo, $descripcion, $link, $media_url, $fecha, $fuente) {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->link = $link;
        $this->media_url = $media_url;
        $this->fecha = $fecha;
        $this->fuente = $fuente;
    }
}

    function getElpais(){
    
        $url_economia = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia=$xpath_economia->evaluate('string(media:content/@url)',$item_economia);
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'El País');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/internacional/portada';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional=$xpath_internacional->evaluate('string(media:content/@url)',$item_internacional);
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'El País'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_elpais=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_elpais;
    }

    function getElMundo(){
   
        $url_economia = 'https://e00-elmundo.uecdn.es/elmundo/rss/economia.xml';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia=$xpath_economia->evaluate('string(media:content/@url)',$item_economia);
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'El Mundo');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://e00-elmundo.uecdn.es/elmundo/rss/internacional.xml';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional=$xpath_internacional->evaluate('string(media:content/@url)',$item_internacional);
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'El Mundo'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_elmundo=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_elmundo;
    }
    
    function getLaVanguardia(){
        $url_economia = 'https://www.lavanguardia.com/rss/economia.xml';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia=$xpath_economia->evaluate('string(media:content/@url)',$item_economia);
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'La vanguardia');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://www.lavanguardia.com/rss/internacional.xml';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional=$xpath_internacional->evaluate('string(media:content/@url)',$item_internacional);
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'La vanguardia'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_lavanguardia=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_lavanguardia;
    }
    
    function getElConfidencial(){}//diferentes secciones
    function getElPeriodico(){

        $url_economia = 'https://www.elperiodico.com/es/rss/economia/rss.xml';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia='..';
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'El periodico');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://www.elperiodico.com/es/rss/internacional/rss.xml';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional='..';
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'El periodico'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_elperiodico=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_elperiodico;

    }
    function getElEconomista(){

        $url_economia = 'https://www.eleconomista.es/rss/rss-economia.php';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia='';
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'El económista');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://www.eleconomista.es/rss/rss-category.php?category=tecnologia';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional='';
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'El económista'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_eleconomista=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_eleconomista;
    }
    function getLibreMercado(){
        $url_economia = 'http://feeds2.feedburner.com/libertaddigital/economia';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia=$xpath_economia->evaluate('string(media:content/@url)',$item_economia);
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'LibreMercado');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='http://feeds2.feedburner.com/libertaddigital/internacional';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional=$xpath_internacional->evaluate('string(media:content/@url)',$item_internacional);
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'LibertadDigital'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_libertadDigital=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_libertadDigital;

    }
    function getNos(){
        $url_economia = 'https://www.nosdiario.gal/rss/economia';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $enclosure=$item_economia->getElementsByTagName('enclosure')->item(0);
            $media_url_content_economia=$enclosure->getAttribute('url');
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'Nòs Diario');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://www.nosdiario.gal/rss/internacional';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $enclosure=$item_internacional->getElementsByTagName('enclosure')->item(0);
            $media_url_content_internacional=$enclosure->getAttribute('url');
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'Nòs Diario'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_nos=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_nos;
    }
    function getLaVoz(){

        $url_economia = 'https://www.lavozdegalicia.es/economia/index.xml';
        $xml_content_economia = file_get_contents($url_economia);
        
        $dom_economia = new DOMDocument();
        $dom_economia->loadXML($xml_content_economia);
        $xpath_economia = new DOMXPath($dom_economia);
        $xpath_economia->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items_economia = $dom_economia->getElementsByTagName('item');
        $noticias_economia=[];
        foreach ($items_economia as $item_economia) {
           
            $title_economia = $item_economia->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description_economia = $item_economia->getElementsByTagName('description')->item(0)->nodeValue;
            $media_url_content_economia=$xpath_economia->evaluate('string(media:content/@url)',$item_economia);
            $link_economia = $item_economia->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_economia = $item_economia->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_economia = strtotime($pubDate_economia);
            
            $noticia_economia=new Noticia($title_economia,$description_economia,$link_economia,$media_url_content_economia,$date_economia,'La Voz de Galicia');
            $noticias_economia[]=$noticia_economia;
           
            
        }
        $url_internacional='https://www.lavozdegalicia.es/internacional/index.xml';
        $xml_content_internacional=file_get_contents($url_internacional);
        $dom_internacional=new DOMDocument();
        $dom_internacional->loadXML($xml_content_internacional);    
        $xpath_internacional=new DOMXPath($dom_internacional);
        $xpath_internacional->registerNamespace('media','http://search.yahoo.com/mrss/');
        $noticias_internacional=[];
        $items_internacional=$dom_internacional->getElementsByTagName('item');
        foreach($items_internacional as $item_internacional){
            $title_internacional=$item_internacional->getElementsByTagName('title')->item(0)->nodeValue;
            $description_internacional=$item_internacional->getElementsByTagName('description')->item(0)->nodeValue;
            $link_internacional=$item_internacional->getElementsByTagName('link')->item(0)->nodeValue;
            $pubDate_internacional=$item_internacional->getElementsByTagName('pubDate')->item(0)->nodeValue;
            $date_internacional=strtotime($pubDate_internacional);
            $media_url_content_internacional=$xpath_internacional->evaluate('string(media:content/@url)',$item_internacional);
            $noticia_internacional=new Noticia($title_internacional,$description_internacional,$link_internacional,$media_url_content_internacional,$date_internacional,'La Voz de Galicia'); 
            $noticias_internacional[]=$noticia_internacional;
        }
        $noticias_lavoz=array_merge($noticias_economia,$noticias_internacional);
        return $noticias_lavoz;
    }
    function getAllNews(){
        $elmundo=getElMundo();
        $elpais=getElPais();
        $lavanguardia=getLaVanguardia();
        $elperiodico=getElPeriodico();
        $lavoz=getLaVoz();
        $nos=getNos();
        $economista=getElEconomista();
        $libertad=getLibreMercado();
        $noticias=array_merge($elmundo, $elpais, $lavanguardia, $elperiodico, $lavoz, $nos, $economista, $libertad);
        usort($noticias, function($a, $b) {
            return $b->fecha - $a->fecha;
        });
        $i=0;
        foreach($noticias as $noticia){
            setlocale(LC_TIME, 'es_ES', 'es_ES.UTF-8', 'Spanish_Spain', 'Spanish'); // Establece la configuración regional en español
            $fecha_formateada = strftime("%A, %d de %B de %Y", $noticia->fecha);
            
            if($i%2==0){
                echo "<div class='news1'>";
            }else{
                echo "<div class='news2'>";
            }
            echo "<h2><a href='$noticia->link'>$noticia->titulo - $noticia->fuente</a></h2>";
            if(strpos($noticia->media_url,'.mp4')){
                echo "<video src='$noticia->media_url' width='50%' height='auto' controls></video>";
            }else if(strlen($noticia->media_url)==0){

                echo "<div width='50%' height='50px' style='color:white; background-color:#444654; display:flex; justify-content:center; align-items:center;'><i class='fa-sharp fa-solid fa-eye-slash fa-xl' style='color: #eff0f0;'></i><p style='text-align:center;'>No hay imágen disponible.</p></div>";
            }else if($noticia->media_url=='..'){
                echo '';
            }else{
                echo "<img src='$noticia->media_url' width='50%' height='auto'>";
            }
            echo "<p>$noticia->descripcion</p>";
            echo "<p>$fecha_formateada</p>";
            echo "</div>";
            $i++;
        }
        
    }
    function getNews(){
        $elmundo=getElMundo();
        $elpais=getElPais();
        $lavanguardia=getLaVanguardia();
        $elperiodico=getElPeriodico();
        $lavoz=getLaVoz();
        $nos=getNos();
        $economista=getElEconomista();
        $libertad=getLibreMercado();
        $noticias=array_merge($elmundo, $elpais, $lavanguardia, $elperiodico, $lavoz, $nos, $economista, $libertad);
        usort($noticias, function($a, $b) {
            return $b->fecha - $a->fecha;
        });

        return $noticias;
    }
    
    

