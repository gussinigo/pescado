<?php
	
	include('../conexion.php');
	$link = Conectarse();
	
	$id= $_REQUEST['id'];
	
	$qr = "select * from clientes where idcliente = ".$id;
	$res_qr = mysqli_query($link, $qr);
	$row_qr = mysqli_fetch_array($res_qr);
	
	
	$idclie = $row_qr['idcliente'];
	$cliente = utf8_encode($row_qr['cliente']);
	$dir = 'SM '.$row_qr['sm'];
	$lat = $row_qr['lat'];
	$lng = $row_qr['lng'];
	$type = $row_qr['type'];
	
	
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
//$ind=0;
// Iterate through the rows, printing XML nodes for each
//while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $idclie . '" ';
  echo 'name="' . parseToXML($cliente) . '" ';
  echo 'address="' . parseToXML($dir) . '" ';
  echo 'lat="' . $lat . '" ';
  echo 'lng="' . $lng . '" ';
  echo 'type="' . $type . '" ';
  echo '/>';
  //$ind = $ind + 1;
//}

// End XML file
echo '</markers>';

?>
