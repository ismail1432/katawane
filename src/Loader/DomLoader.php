<?php


namespace App\Loader;


class DomLoader
{
    public function loader($url)
    {
        echo $this->run($url);
    }

    public function run($url)
    {
        $internalErrors = libxml_use_internal_errors(true);

        $content = file_get_contents($url);
        $doc = new \DOMDocument();
        $doc->loadHTML($content);

        $xpath = new \DOMXPath($doc);
        $elements = $xpath->query('//*[@id="mw-content-text"]/table');


        $table = new \DOMDocument();

        foreach ($elements as $element) {
            $copy = $table->importNode($element, true);
            $table->appendChild($copy);
        }
        $xlsdoc = new \DOMDocument();
        $xlsdoc->load(__DIR__ . '/pic2csv.xsl');

        $xls = new \XSLTProcessor();
        $xls->importStylesheet($xlsdoc);

        //file_put_contents('pics.csv', $xls->transformToXML($table));
        libxml_use_internal_errors($internalErrors);
        return $xls->transformToXml($table);

    }
}