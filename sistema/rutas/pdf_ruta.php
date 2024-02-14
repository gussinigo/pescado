<?php
session_start();
	
require('../mc_table.php');
include('../conexion.php');
$link = Conectarse();

$id = $_REQUEST['id'];

$qr = "select repartidor from repartidores where idrepartidor='".$id."'";
$respuesta = mysqli_query($link, $qr);

$row = mysqli_fetch_array($respuesta);

$_SESSION['repartidor']=$row['repartidor'];

class PDF extends PDF_MC_Table
{	
	
	function Header()
	{
	    // Logo
	    $this->Image('../assets/img/logo_2x.png',20,15,50);
	    
		$this->Ln(5);
		
		$this->SetFont('Arial','',12);
		$this->Cell(69);
		$this->Cell(25,10,'Repartidor:',0,0,'L');
		$this->Cell(15,10,$_SESSION['repartidor'],0,0,'L');
		$this->Cell(35);
		
		$this->Ln(5);
		
		$this->SetFont('Arial','',12);
		$this->Cell(69);
		$this->Cell(25,10,'Fecha:',0,0,'L');
		$this->Cell(15,10,date('Y-m-d'),0,0,'L');
		$this->Cell(35);
		
	    // Line break
	    $this->Ln(20);
	    
	}
	
	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(10,10,'El Buen Pescado',0,0,'C');
	    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	    
	    $this->Ln(5);
	    $this->Cell(10,10,'(998)319-2813',0,0,'C');
		$this->Cell(175,10,'Gracias por tu compra!',0,0,'C');
	}
	
}

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->SetTitle('Ruta de entrega');
$pdf->Cell(10,5,'Orden',1,0,'C');

$pdf->Cell(10,5,'Ticket',1,0,'C');
$pdf->Cell(20,5,'Cliente',1,0,'C');
$pdf->Cell(55,5,'Direccion',1,0,'C');
$pdf->Cell(50,5,'Producto',1,0,'C');
$pdf->Cell(10,5,'Cant.',1,0,'C');
$pdf->Cell(15,5,'Peso',1,0,'C');
$pdf->Cell(20,5,'Total',1,0,'C');
$pdf->Ln();

$pdf->SetWidths(array(10,10,20,55,50,10,15,20));
$pdf->SetAligns(array('C','C','C','C','C','C','C','C','C'));


$orden = 0;
$cont=1;

$hoy = date('Y-m-d');
$ts = strtotime($hoy);
$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
$fechaIni = date('Y-m-d',$start);
$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
$filtro2 = " and p.fecha >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";


/*
$qr_tabla = "select a.idasignacion, a.orden, p.idsolicitud, c.idcliente, c.cliente, pro.producto, pcd.cantidad, pcd.idmedida, um.umedida, pcd.peso, p.fecha, c.sm, c.mza, c.calle, c.lote, c.telefono, c.residencial, c.residencial, r.repartidor, p.subtotal as total, p.obs
from asignacion_rutas a 
left join pedidos_cliente p on a.idsolicitud=p.idsolicitud 
left join clientes c on p.idcliente=c.idcliente 
left join repartidores r on a.idrepartidor = r.idrepartidor
left join pedidos_cliente_detalle pcd on a.idsolicitud = pcd.idsolicitud
left join productos pro on pcd.idproducto = pro.idproducto
left join unidad_medida um on pcd.idmedida = um.idmedida 
where p.idestatus=4 and a.idrepartidor=".$id.$filtro2." ORDER BY a.orden ASC";
*/
$qr_tabla = "select a.idasignacion, a.orden, p.idsolicitud, c.idcliente, c.cliente, pro.producto, pcd.cantidad, pcd.idmedida, um.umedida, pcd.peso, p.fecha, c.sm, c.mza, c.calle, c.lote, c.telefono, c.residencial, c.residencial, r.repartidor, (select sum(subpd.importe) from pedidos_cliente_detalle subpd where subpd.idsolicitud=p.idsolicitud) total, p.obs
from asignacion_rutas a
left join pedidos_cliente p on a.idsolicitud=p.idsolicitud 
left join clientes c on p.idcliente=c.idcliente 
left join repartidores r on a.idrepartidor = r.idrepartidor
left join pedidos_cliente_detalle pcd on a.idsolicitud = pcd.idsolicitud
left join productos pro on pcd.idproducto = pro.idproducto
left join unidad_medida um on pcd.idmedida = um.idmedida 
where p.idestatus=4 and a.idrepartidor=".$id.$filtro2." ORDER BY a.orden ASC";

$res = mysqli_query($link, $qr_tabla);
$contaclie="";
$contaid=0;
$contaorden=0;
$contadir="";
$contafecha="";
$contatick=0;
$contatotal=0;
while($row_tabla = mysqli_fetch_array($res)){
	
	
	if ($contaclie <> ""){
	 	if ($contaclie != $row_tabla['cliente']){
			 $contaclie=$row_tabla['cliente'];
			 $contaorden=$row_tabla['orden'];
			 $contadir=" Calle: ".$row_tabla['calle']." Lote: ".$row_tabla['lote']." Residencial: ".$row_tabla['residencial']." \n Observacion: ".$row_tabla['obs'];
			 $contatick=$row_tabla['idsolicitud'];
			 $contatotal='$'.number_format($row_tabla['total'],0);
		 } else {
			 $contaorden="";
			 $contaclie="";
			 $contadir="";
			 $contatick="";
			 $contatotal="";
		 }
	} else {
		if($contaid == $row_tabla['idsolicitud']){
			$contaclie="";
			$contaorden="";
			$contadir="";
			$contatick="";
			$contatotal="";
		} else {
			$contaclie=$row_tabla['cliente'];
			$contaorden=$row_tabla['orden'];
			$contadir=" Calle: ".$row_tabla['calle']." Lote: ".$row_tabla['lote']." Residencial: ".$row_tabla['residencial']." \n Observacion: ".$row_tabla['obs'];
			$contatick=$row_tabla['idsolicitud'];
			$contatotal='$'.number_format($row_tabla['total'],0);
		}
		
	}
	$contaid=$row_tabla['idsolicitud'];
	if($orden <> $row_tabla['orden']){
		if($orden <> 0){
			$pdf->Cell(0,10,'','B',0,'C');
			$pdf->Ln();
		}
	}
	$pdf->SetFont('Arial','',8);
	$pdf->Row(array($contaorden, $contatick, $contaclie, utf8_decode($contadir),$row_tabla['producto'],$row_tabla['cantidad'],$row_tabla['peso']." Kg", $contatotal));
	
	$orden=$row_tabla['orden'];
	$cont++;
	
}


//$pdf->MultiCell(0,5,$qr_tabla,1);
$pdf->Output();


?>