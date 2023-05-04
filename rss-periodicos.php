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
        $i=0;
        $url = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada';
        $xml_content_elpais = file_get_contents($url);
        
        $dom_elpais = new DOMDocument();
        $dom_elpais->loadXML($xml_content_elpais);
        $xpath_elpais = new DOMXPath($dom_elpais);
        $xpath_elpais->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items = $dom_elpais->getElementsByTagName('item');
        foreach ($items as $item) {
           
            $title = $item->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description = $item->getElementsByTagName('description')->item(0)->nodeValue;
        
            $link = $item->getElementsByTagName('link')->item(0)->nodeValue;
            if($i%2==0){
                echo "<div class='news1'>";
            }else{
                echo "<div class='news2'>";
            }
            echo "<h2><a href='$link'>$title - ElPaís</a></h2>";
            $media_content_url = $xpath_elpais->evaluate('string(media:content/@url)', $item);
            if(strpos($media_content_url,'.mp4')){
                echo "<video src='$media_content_url' width='50%' height='auto' controls></video>";
            }else if(strlen($media_content_url)==0){

                echo "<div width='50%' height='50px' style='color:white; background-color:#444654; display:flex; justify-content:center; align-items:center;'><i class='fa-sharp fa-solid fa-eye-slash fa-xl' style='color: #eff0f0;'></i><p style='text-align:center;'>No hay imágen disponible.</p></div>";
            }else{
                echo "<img src='$media_content_url' width='50%' height='auto'>";
            }
            
            echo "<p>$description</p>";
        
           
            echo "</div>";
            $i++;
        }
    }

    function getElMundo(){
        $i=0;
        $url="https://e00-elmundo.uecdn.es/elmundo/rss/economia.xml";
        $xml_content_elmundo=file_get_contents($url);
        $dom_elmundo=new DOMDocument();
        $dom_elmundo->LoadXML($xml_content_elmundo);
        $xpath_elmundo=new DOMXPath($dom_elmundo);
        $xpath_elmundo->registerNamespace('media','http://search.yahoo.com/mrss/');
        $items=$dom_elmundo->getElementsByTagName('item');
        foreach($items as $item){

            $title=$item->getElementsByTagName('title')->item(0)->nodeValue;
            $description=$item->getElementsByTagName('description')->item(0)->nodeValue;
            $link=$item->getElementsByTagName('link')->item(0)->nodeValue;
            if($i%2==0){
                echo "<div class='news1'>";
            }else{
                echo "<div class='news2'>";
            }
            echo "<h2><a href='$link'>$title - ElMundo</a></h2>";
            $media_content_url=$xpath_elmundo->evaluate('string(media:content/@url)',$item);
            if(strpos($media_content_url,'.mp4')){
                echo "<video src='$media_content_url' width='50%' height='auto' controls></video>";
            }else if(strlen($media_content_url)==0){

                echo "<div width='50%' height='50px' style='color:white; background-color:#444654; display:flex; justify-content:center; align-items:center;'><i class='fa-sharp fa-solid fa-eye-slash fa-xl' style='color: #eff0f0;'></i><p style='text-align:center;'>No hay imágen disponible.</p></div>";
            }else{
                echo "<img src='$media_content_url' width='50%' height='auto'>";
            }
            echo "<p>$description</p>";
           
            echo "</div>";
            $i++;

        }
    }
    /*function getElPais() {
    // ... (mismo código que antes, sin imprimir directamente el contenido)

    $noticias = [];
    foreach ($items as $item) {
        $title = $item->getElementsByTagName('title')->item(0)->nodeValue;
        $description = $item->getElementsByTagName('description')->item(0)->nodeValue;
        $link = $item->getElementsByTagName('link')->item(0)->nodeValue;
        $pubDate = $item->getElementsByTagName('pubDate')->item(0)->nodeValue;
        $fecha = strtotime($pubDate);
        $media_content_url = $xpath->evaluate('string(media:content/@url)', $item);

        $noticia = new Noticia($title, $description, $link, $media_content_url, $fecha, 'El País');
        $noticias[] = $noticia;
    }
    return $noticias;
}*/
    function getLaVanguardia(){}
    function getLaRazon(){}
    function getElConfidencial(){}
    function getElDiario(){}
    function getElEconomista(){}
    function getElCorreo(){}
    function getLaVoz(){}
    
    
    

