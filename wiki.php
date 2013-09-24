<?php
class RemoteFileReader{
private $url = "";
private $content = "";
function __construct($url) {
$this->url = $url;
//Testo l'esistenza delle cURL lib
if (function_exists('curl_init')) {
//Inizializzo una nuova Risorsa
$ch = curl_init();
//Imposto l'URL da agganciare
curl_setopt($ch, CURLOPT_URL, $url);
//Siccome non mi interessa alcun Header
//ma solo il contenuto del file remoto
//imposto a zero la richiesta di Header
curl_setopt($ch, CURLOPT_HEADER, 0);
//Siccome la risposta non la voglio visualizzare
//sul browser ma la voglio conservare imposto 1
//alla proprieta' CURLOPT_RETURNTRANSFER
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//Imposto uno user agent per simulare un browser
curl_setopt($ch, CURLOPT_USERAGENT,
'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)'
. ' Gecko/20041107 Firefox/1.0');
//Setto la proprieta' content della classe con
//il contenuto della risorsa remota
$this->content = curl_exec($ch);
//Chiudo la connessione e rilascio la risorsa
curl_close($ch);
}
else {
//Le librerie non sono installate: restituisco FALSE
$this->content = FALSE;
}
}
//Metodi Getters/Setters
public function getContent(){
return $this->content;
}
public function setContent($c){
$this->content = $c;
}
public function getUrl(){
return $this->url;
}
public function setUrl($c){
$this->url = $c;
}
} 
?>


<html>
<body>

<?
$gg = date('j');
if($gg == 1)
  $gg = "1%BA";
$mm = date('m');
//Conversione a parole del mese del sistema
switch($mm){
    case 01:
        $mm = "gennaio";
        break;
    case 02:
        $mm = "febbraio";
        break;
    case 03:
        $mm = "marzo";
        break;
    case 04:
        $mm = "aprile";
        break;
    case 05:
        $mm = "maggio";
        break;
    case 06:
        $mm = "giugno";
        break;
    case 07:
        $mm = "luglio";
        break;
    case 08:
        $mm = "agosto";
        break;
    case 09:
        $mm = "settembre";
        break;
    case 10:
        $mm = "ottobre";
        break;
    case 11:
        $mm = "novembre";
        break;
    case 12:
        $mm = "dicembre";
        break;
} 

//URL da agganciare
$url_feed = "http://it.wikipedia.org/w/api.php?action=query&prop=revisions&titles=".$gg."_".$mm."&rvprop=content&format=xml";
//Istanzio un oggetto RemoteFileReader
$rfR = new RemoteFileReader($url_feed);
//Test delle librerie
if (! $rfR->getContent()) {
echo 'Librerie CURL non installate.';
exit;
}
//Visualizzo il contenuto del file remoto
if(isset($_GET['col']))
    $col = $_GET['col'];
else
    $col = "black";
if(isset($_GET['tipo']))
    $tipo = $_GET['tipo'];
else
    $tipo = "arial";
if(isset($_GET['w']))
    $w = $_GET['w'];
else
    $w = 450;
if(isset($_GET['h']))
    $h = $_GET['h'];
else
    $h = 450;
if(isset($_GET['dim'])) 
     $dim = $_GET['dim'];
else
     $dim = 2;   

$stringa = utf8_decode($rfR->getContent());
$stringa = strstr($stringa, "== Eventi ==");
$posizione = strpos($stringa, "== [[Nati");
$lunghezza = strlen($stringa);
$num = $lunghezza - $posizione;
$stringa = substr($stringa, 0, -$num);
$stringa = "<font face='$tipo' color='$col'>".$stringa;
$stringa = str_replace("[[", "</font><font color='red' face='$tipo'>[[", $stringa); 
$stringa = str_replace("]]", "]]</font><font face='$tipo' color='$col'>", $stringa);
$stringa = $stringa."</font>"; 
$bol = false;
$char = '';
$str = '';
$str2 = '';
$lunghezza = strlen($stringa);
for($i=0; $i<$lunghezza; $i++){
    $char = substr($stringa, $i, 1);
    if($char == '['){
        $bol = true;
    }
    if($bol == true){
        $str2 .=$char;
    }else{
          $str .= $char;
    }
    if($char == '|'){
        $bol = false;
        $str2 = '';
    }
    if($char == ']'){
        $bol = false;
        $str .= $str2;
        $str2 = '';
    }

}
$str = str_replace(array("[[","]]"), "", $str); 
$str = str_replace("**", " -- ", $str);
$str = str_replace("*", "<br><br>", $str);  
echo "<marquee align=middle scrollamount=1 height=$h vspace=20 width=$w direction=up scrolldelay=1 border=2><h$dim align='justify'><b>$str</b></h$dim></marquee>";  
?>
 
</body>
</html>