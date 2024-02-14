<?php
session_start();
	
require('../mc_table.php');
include('../conexion.php');
$link = Conectarse();

$id = $_REQUEST['id'];

$qr = "select repartidor from repartidores where idrepartidor='".$id."'";
$respuesta = mysqli_query($link, $qr);

$row = mysqli_fetch_array($respuesta);

$_SESSION['repartidor']=utf8_decode($row['repartidor']);

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
	    $this->Cell(10,10,'(998)0000-000',0,0,'C');
	}
	
}

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->SetTitle('Ruta de entrega',true);

$pdf->Cell(40,10,'Producto',0,0,'C');
$pdf->Cell(40,10,'Presentacion',0,0,'C');
$pdf->Cell(40,10,'Unidad',0,0,'C');
$pdf->Cell(40,10,'Cantidad',0,0,'C');

$pdf->Ln();

$pdf->SetWidths(array(40,40,40,40));
$pdf->SetAligns(array('C','C','C','C'));


$productos = 0;
$cont=1;

function diaSemana($date) {
    return date('w', strtotime($date));
}

$DoW = diaSemana(date('Y-m-d'));
$fecha = date('Y-m-d');
$domingo = date('Y-m-d', strtotime('-'.$DoW.' day', strtotime($fecha)));
$sabado = date('Y-m-d', strtotime('+6 day', strtotime($domingo)));

$qr_tabla = "select p.idproducto, p.producto, pd.peso, um.umedida, p.costo_compra, pd.cantidad, pd.peso*p.costo_compra as total, CASE WHEN pd.idmedida = 1 THEN sum(cantidad) WHEN pd.idmedida = 4 THEN sum(cantidad) ELSE sum(pd.peso) END as suma_cantidad from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente left join unidad_medida um on pd.idmedida=um.idmedida left join asignacion_rutas ar on ar.idsolicitud=pd.idsolicitud where ar.idrepartidor='".$id."' and pc.fecha >= '".$domingo."' AND pc.fecha <= '".$sabado."' and pd.idmedida<>5 GROUP BY p.producto, um.umedida union select p.idproducto, p.producto, pd.peso, um.umedida, p.costo_compra, pd.cantidad, (pd.peso*p.costo_compra)*COUNT(pd.peso) as total, COUNT(pd.peso) as suma_cantidad from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente left join unidad_medida um on pd.idmedida=um.idmedida left join asignacion_rutas ar on ar.idsolicitud=pd.idsolicitud where ar.idrepartidor='".$id."' and pc.fecha >= '".$domingo."' AND pc.fecha <= '".$sabado."' and pd.idmedida=5 GROUP BY p.producto, um.umedida, pd.peso";

$res = mysqli_query($link, $qr_tabla);
//$pdf->Row(array($qr_tabla ));
while($row_tabla = mysqli_fetch_array($res)){
	
	if($productos <> $row_tabla['idproducto']){
		if($productos <> 0){
			$pdf->Cell(0,10,'','B',0,'C');
			$pdf->Ln();
		}
	}
	
	$pdf->Row(array($row_tabla['producto'], $row_tabla['peso'], $row_tabla['umedida'], $row_tabla['suma_cantidad'],$vara ));
	
	$productos=$row_tabla['idproducto'];
	$cont++;
	
}



$pdf->Output();


?>