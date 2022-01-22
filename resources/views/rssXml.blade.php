<?php
if(!$rss){
    return 'You are using this wrong.  $rss should be passed to this view from the RssPdfDownload controller';
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('css/xmlPdf.css') }}" rel="stylesheet">
</head>
<body>
<?php
$count = 1;

// Push all elements of the feed into an array with a limit of 5 items
foreach ($rss->getElementsByTagName('item') as $node) {
    $title = $node->getElementsByTagName('title')->item(0)->nodeValue;
    $link = $node->getElementsByTagName('link')->item(0)->nodeValue;
    $description = $node->getElementsByTagName('description')->item(0)->nodeValue;
    $publishDate = $node->getElementsByTagName('pubDate')->item(0)->nodeValue;

    echo "<h1>$title</h1>";
    echo "<span>Source: </span><a href='$link' class='source-link'>$link</a>";
    echo "<br/><br/><span>Description: </span><p>$description</p>";
    echo "<span>Published: </span><p>$publishDate</p>";
    // Break after 5 items
    if($count >= 5){
        break;
    }else{
        echo '<div style="page-break-before:always;"></div>';
    }
    $count++;
}
?>
</body>
</html>
