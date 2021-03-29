<?php
// Load XML as string
$a = "<data><row><value>1</value></row><row><value>2</value></row><row><value>N</value></row></data>";
$b = "<data><row><attr>X1</attr></row><row><attr>X2</attr></row><row><attr>XN</attr></row></data>";

echo(do1($a, $b));
echo(do2($a, $b));
var_dump(do3($a, $b));

function do1 ($a, $b){
// Parse XML string data
    $xmlA = simplexml_load_string($a);
    $xmlB = simplexml_load_string($b);

// Search for <value>
    $resultA = $xmlA->xpath('/data/row/value');

// Search for <attr>
    $resultB = $xmlB->xpath('/data/row/attr');

// Since SimpleXML doesn't support formatting, use DOM format instead.
// https://stackoverflow.com/questions/3797300/simplexmladdchild-cant-add-line-break-when-output-to-a-xml
    $doc = new DomDocument('1.0');
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;

// create root node
    $data = $doc->createElement('data');
    $data = $doc->appendChild($data);

    for ($i = 0; $i <= count($resultA)-1; $i++) {
        // add child <row>
        $occ = $doc->createElement('row');
        $occ = $data->appendChild($occ);

        // Add element, append element to <row> and add data inside
        $child = $doc->createElement("value");
        $child = $occ->appendChild($child);
        $value = $doc->createTextNode($resultA[$i]);
        $child->appendChild($value);

        // Add element, append element to <row> and add data inside
        $child = $doc->createElement("attr");
        $child = $occ->appendChild($child);
        $value = $doc->createTextNode($resultB[$i]);
        $child->appendChild($value);
    }

// get completed xml document
    $xml_string = $doc->saveXML() ;
    return $xml_string;
}

function do2($a, $b){
// Parse XML string data
    $xmlA = simplexml_load_string($a);
    $xmlB = simplexml_load_string($b);

// Search for <value>
    $resultA = $xmlA->xpath('/data/row/value');

// Search for <attr>
    $resultB = $xmlB->xpath('/data/row/attr');

// Since SimpleXML doesn't support formatting, use DOM format instead.
// https://stackoverflow.com/questions/3797300/simplexmladdchild-cant-add-line-break-when-output-to-a-xml
    $doc = new DomDocument('1.0');
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;

// create root node
    $data = $doc->createElement('data');
    $data = $doc->appendChild($data);

    for ($i = 0; $i <= count($resultA)-1; $i++) {
        // add child <row>
        $occ = $doc->createElement('row');

        // Add attribute to <row>
        $attr = $doc->createAttribute('attr');
        $attr->value = $resultB[$i];
        $occ->appendChild($attr);
        $occ = $data->appendChild($occ);

        // Add element, append element to <row> and add data inside
        $child = $doc->createElement("attr");
        $child = $occ->appendChild($child);
        $value = $doc->createTextNode($resultA[$i]);
        $child->appendChild($value);
    }

// get completed xml document
    $xml_string = $doc->saveXML() ;
    return $xml_string;
}


function do3($a, $b){
// Parse XML string data
    $xmlA = simplexml_load_string($a);
    $xmlB = simplexml_load_string($b);

// Search for <value>
    $resultA = $xmlA->xpath('/data/row/value');

// Search for <attr>
    $resultB = $xmlB->xpath('/data/row/attr');

    $result[] = (array) null;
    for ($i = 0; $i <= count($resultA)-1; $i++) {
        $arr = array((string)$resultB[$i], (int)$resultA[$i]);
        array_push($result, $arr);
    }

    // remove default created first element.
    unset($result[0]);

    return $result;
}

?>