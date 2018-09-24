<html>

<head>
    <title>Therapy Box | NEWS</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="user-scalable = yes">
    <link rel="icon" href="LOGO.jpg">
    <link rel="stylesheet" href="main.css">
</head>    
    
<body>
    
	<?php
        $xml=("http://feeds.bbci.co.uk/news/rss.xml");
        $xmlFile = simplexml_load_file('http://feeds.bbci.co.uk/news/rss.xml');

        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);



        //get and output "<item>" elements
          $x=$xmlDoc->getElementsByTagName('item');
            
        
          $item_title = $x->item(0)->getElementsByTagName('title')
          ->item(0)->childNodes->item(0)->nodeValue;
    
          $item_link = $x->item(0)->getElementsByTagName('link')
          ->item(0)->childNodes->item(0)->nodeValue;
    
          $item_desc = $x->item(0)->getElementsByTagName('description')
          ->item(0)->childNodes->item(0)->nodeValue;
    
    
        $item = $xmlFile->channel->item;
    
        $media = $item->children('media', 'http://search.yahoo.com/mrss/');
        foreach($media->thumbnail as $thumb) {
            $url = $thumb->attributes()->url;
        }
    
    
          echo ('<img src="' . $url . '">');
              
          echo ("<h1><a href='" . $item_link
          . "'>" . $item_title . "</a></h1>");
          echo ("<br> <p>");
          echo ($item_desc . "</p>" );
        
    ?>
	
	
</body>
</html>