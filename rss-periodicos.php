<?php

    function getElpais(){
        $i=0;
        $url = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada';
        $xml_content = file_get_contents($url);
        
        $dom = new DOMDocument();
        $dom->loadXML($xml_content);
        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('media', 'http://search.yahoo.com/mrss/');
        $items = $dom->getElementsByTagName('item');
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
            $media_content_url = $xpath->evaluate('string(media:content/@url)', $item);
            if(strpos($media_content_url, '.mp4')){
                echo "<video src='$media_content_url' width='50%' height='auto' controls></video>";
            }else{
                echo "<img src='$media_content_url' width='50%' height='auto'>";
            }
            
            echo "<p>$description</p>";
        
            echo '-------------------------------------' . PHP_EOL;
            echo "</div>";
            $i++;
        }
    }
    
    


?>