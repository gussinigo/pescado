<?php
session_start();
	
require('../mc_table.php');
include('../conexion.php');
$link = Conectarse();

$id = $_REQUEST['id'];
$idcompra = $_REQUEST['idcompra'];

/*$qr_head = "SELECT pcd.peso, pcd.cantidad, pcd.idmedida, p.costo_compra as punitario FROM compras_detalle cd left join pedidos_cliente_detalle pcd on cd.idsolicitud = pcd.idsolicitud left join productos p on pcd.idproducto=p.idproducto WHERE p.idproveedor='".$id."' and cd.idcompra='".$idcompra."'";*/

$qr_head = "select d.peso, d.cantidad, d.idmedida, p.costo_compra as punitario from compras c, compras_detalle cd, pedidos_cliente_detalle d, productos p where c.idcompra = cd.idcompra and cd.idsolicitud = d.idsolicitud and cd.idproducto = d.idproducto and cd.idproducto = p.idproducto and d.idestatus != 1 and c.idproveedor = '".$id."' and c.idcompra= '".$idcompra."' ";
$res_head = mysqli_query($link, $qr_head);
	
$importe=0;		
while ($row_head = mysqli_fetch_array($res_head)){
	
	if ($row_head['idmedida'] == 4){
		//importe si es 4
		$importe+= $row_head['punitario']*$row_head['cantidad'];
		}
	else {
		//importe normal
		$importe+=$row_head['punitario']*$row_head['peso'];
	}
	
	
}

//$qr = "SELECT p.proveedor, c.idcompra, c.fecha FROM proveedores p LEFT JOIN compras c ON p.idproveedor=c.idproveedor WHERE p.idproveedor='".$id."'";
$qr = "SELECT p.proveedor, c.idcompra, c.fecha FROM compras c, proveedores p WHERE p.idproveedor=c.idproveedor and p.idproveedor='".$id."' and c.idcompra = '".$idcompra."'";
$respuesta = mysqli_query($link, $qr);

$row = mysqli_fetch_array($respuesta);

$_SESSION['money']='$'.number_format($importe,2);
$_SESSION['proveedor']=$row['proveedor'];
$_SESSION['fecha']=$row['fecha'];
$_SESSION['idcompra']=$idcompra;
class PDF extends PDF_MC_Table
{	
	function Header()
	{
	    // Logo
	    $this->Image('../assets/img/logo_2x.png',50,15,50);
	    $this->Ln(5);
	    
		// Title
		
		
	    // Arial bold 8
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',8);
	    
	    // Title
	    $this->Cell(90);
		$this->Cell(15,10,'Pedido a:',0,0,'R');
		$this->Cell(40,10,$_SESSION['proveedor'],0,0,'L');
		
		$this->Ln(5);
		
		$this->Cell(87);
		$this->Cell(15,10,'Fecha:',0,0,'R');
		$this->Cell(16,10,$_SESSION['fecha'],0,0,'L');
		$this->Cell(35);
		
		$this->Ln(5);
		$this->SetFont('Arial','',12);
		$this->Cell(100);
		$this->Cell(15,10,'No. Ticket:',0,0,'R');
		$this->Cell(15,10,$_SESSION['idcompra'],0,0,'L');
		$this->Cell(35);
		$this->Ln(10);
	    // Line break
	    $this->SetTextColor(255,255,255);
		$this->SetFillColor(21, 45, 91);
		$this->SetFontSize(20);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		$this->Cell(60);
	    $this->Cell(60,20,$_SESSION['money'],1,0,'C',true);
		$this->Ln(0);
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
$pdf->SetTitle('Ticket Compra Solicitada',true);
/*
$pdf->Cell(20,10,'Ticket Cliente',0,0,'C');
$pdf->Cell(60,10,'Cliente',0,0,'C');
$pdf->Cell(60,10,'Lista de Productos',0,0,'C');
$pdf->Cell(20,10,'Cantidad',0,0,'C');
$pdf->Cell(20,10,'U. Medida',0,0,'C');
//$pdf->Cell(20,10,'Costo',0,0,'C');
$pdf->Ln();
$pdf->SetWidths(array(20,60,60,20,20));
$pdf->SetAligns(array('L','C','C','C','C'));*/

$pdf->Cell(20,10,'Num. Pedido Cliente',0,0,'C');
$pdf->Cell(30,10,'Cliente',0,0,'C');
$pdf->Cell(40,10,'Lista de Productos',0,0,'C');
$pdf->Cell(20,10,'Cantidad',0,0,'C');
$pdf->Cell(20,10,'U. Medida',0,0,'C');
$pdf->Cell(20,10,'Peso Real',0,0,'C');
$pdf->Cell(20,10,'P. Unitario',0,0,'C');
$pdf->Cell(20,10,'Importe',0,0,'C');
$pdf->Ln();

$pdf->SetWidths(array(20,30,40,20,20,20,20,20));
$pdf->SetAligns(array('C','C','C','C','C','C','C','C'));

$clientes=0;

/*$qr_tabla = "select c.idcompra, cl.idcliente, cl.cliente, pr.producto, cd.cantidad, um.umedida, pcd.peso, costo_compra as unitario, pcd.idsolicitud, pcd.idmedida  from compras_detalle cd left join compras c on c.idcompra=cd.idcompra left join pedidos_cliente pc on cd.idsolicitud=pc.idsolicitud left join pedidos_cliente_detalle pcd on cd.idsolicitud=pcd.idsolicitud left join productos pr on pcd.idproducto=pr.idproducto left join proveedores p on pr.idproveedor=p.idproveedor left join clientes cl on pc.idcliente=cl.idcliente left join unidad_medida um on pcd.idmedida=um.idmedida where pr.idproveedor='".$id."' and cd.idcompra='".$idcompra."'";*/

$qr_tabla = " select c.idcompra, cl.idcliente, cl.cliente, pr.producto, cd.cantidad, um.umedida, pcd.peso, pr.costo_compra as unitario, pcd.idsolicitud, pcd.idmedida from compras c, compras_detalle cd, pedidos_cliente pc, pedidos_cliente_detalle pcd, productos pr, clientes cl, unidad_medida um where c.idcompra=cd.idcompra and pc.idsolicitud = pcd.idsolicitud and cd.idsolicitud = pcd.idsolicitud and cd.idproducto = pcd.idproducto and cd.idproducto = pr.idproducto and pcd.idproducto = pr.idproducto and pc.idcliente = cl.idcliente and pcd.idmedida=um.idmedida and c.idproveedor = '".$id."' and cd.idcompra = '".$idcompra."' and pcd.idestatus != 1 ";

$res = mysqli_query($link, $qr_tabla);

while($row_tabla = mysqli_fetch_array($res)){
	
	
	
	if($row_tabla['idmedida'] == 4){
		$peso=$row_tabla['cantidad'].' PZA';
		$costo = $row_tabla['cantidad'] * $row_tabla['unitario'];
	} else {
		$peso= $row_tabla['peso'].' KG';
		$costo = $row_tabla['peso'] * $row_tabla['unitario'];
	}
	
	
	if($clientes <> $row_tabla['idcliente']){
		if($clientes <> 0){
			$pdf->Cell(0,10,'','B',0,'C');
			$pdf->Ln();
		}
	}
	
	$pdf->Row(array($row_tabla['idsolicitud'], $row_tabla['cliente'], $row_tabla['producto'], $row_tabla['cantidad'], $row_tabla['umedida'],$peso,$row_tabla['unitario'], $costo ));
	$clientes=$row_tabla['idcliente'];
	
}



$pdf->Output();


?>