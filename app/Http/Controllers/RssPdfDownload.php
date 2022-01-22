<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;

class RssPdfDownload extends Controller
{

    public function download($request)
    {
        // Suppress internal errors from bubbling out
        libxml_use_internal_errors(TRUE);
        $rss = new \DOMDocument();

        // Load RSS Feed URL
        $rss->load($request->post()['url']);

        // Make sure we have valid xml
        if(libxml_get_errors()){
            return 'RSS feed not found';
        }

        ob_start()?>

        <html>
            <head>
                <style>
                    .source-link{
                        overflow-wrap: break-word;
                    }
                </style>
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

        <?php

//        return ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->render();
//        $dompdf->stream('test.pdf', array("Attachment" => false));
        $dompdf->stream('test.pdf');

//        return var_dump($feeds);


//        response($pdfFile, 200, [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'attachment; filename="myRss.pdf"',
//        ]);

    }
}
