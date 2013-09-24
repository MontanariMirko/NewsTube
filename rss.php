<html>
<head>
<title></title>
</head>
<body>
<?php
$insideitem = false;
$tag = "";
$title = "";
$description = "";
$link = "";
$str = "";
function startElement($parser, $name, $attrs) {
global $insideitem, $tag, $title, $description, $link, $str;
if ($insideitem) {
$tag = $name;
} elseif (strtolower($name) == "item") {
$insideitem = true;
}
}
function endElement($parser, $name) {
global $insideitem, $tag, $title, $description, $link, $str;
if (strtolower($name) == "item") {
//printf("<strong>%s</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ,trim($title));
//printf("%s" ,trim($description));
//$str .= $title." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
print($title);
$title = "";
$description = "";
$link = "";
$insideitem = false;
}
}
function characterData($parser, $data) {
global $insideitem, $tag, $title, $description, $link, $str;
if ($insideitem) {
switch (strtolower($tag)) {
case "title":
$title .= utf8_decode($data)." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
break;

}
}
}
$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement" , "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
// Carico indirizzo feed rss delle news di WebMasterPoint.org
$dim = $_GET['dim'];
$colore = $_GET['col'];
$tipo = $_GET['tipo'];
$sito = $_GET['sito'];
if($tipo == "arial")
    $tipo = "Arial";
else
    $tipo = "Times New Roman";
print("<marquee><b><h$dim><font face='".$tipo."' color=$colore>");
$fp = fopen("$sito" ,"r")
or die("Error reading RSS data.");
while ($data = fread($fp, 4096))
xml_parse($xml_parser, $data, feof($fp))
or die(sprintf("XML error: %s at line %d" ,
xml_error_string(xml_get_error_code($xml_parser)),
xml_get_current_line_number($xml_parser)));
fclose($fp);
xml_parser_free($xml_parser);
print("</font></h$dim></b></marquee>");
//$stringa = utf8_decode($str);
//printf("<marquee><b><h2>$stringa</h2></b></marquee>");
  ?>
  </body>
  </html>