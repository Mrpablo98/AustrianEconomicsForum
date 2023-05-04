<?php

    function getElpais(){

        $url = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/section/economia/portada';
        $xml_content = file_get_contents($url);
        
        $dom = new DOMDocument();
        $dom->loadXML($xml_content);
        
        $items = $dom->getElementsByTagName('item');
        foreach ($items as $item) {
           
            $title = $item->getElementsByTagName('title')->item(0)->nodeValue;
            
            $description = $item->getElementsByTagName('description')->item(0)->nodeValue;
        
            $link = $item->getElementsByTagName('link')->item(0)->nodeValue;
            
            echo "<h2><a href='$link'>$title - ElPaís</a></h2>";
            echo "<p>$description</p>";
        
            echo '-------------------------------------' . PHP_EOL;
        }
    }
    
    


?>