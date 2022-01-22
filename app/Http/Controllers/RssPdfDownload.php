<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class RssPdfDownload extends Controller
{

    public function download($request)
    {
        // Suppress internal errors from bubbling out
        libxml_use_internal_errors(TRUE);
        $rss = new \DOMDocument();

        if($request->post()['url'] === ''){
            return 'RSS feed not found';
        }

        // Load RSS Feed URL
        $rss->load($request->post()['url']);

        // Make sure we have valid xml
        if(libxml_get_errors()){
            return 'RSS feed not found';
        }

        $dompdf = new Dompdf();

        // Load a page that has the html with our rss feed in it
        $dompdf->loadHtml(View::make('rssXml')->with('rss', $rss));
        $dompdf->render();
        $dompdf->stream('test.pdf');
    }
}
