<?php
session_start();
	
require('../mc_table.php');
include('../conexion.php');
$link = Conectarse();

$id = $_REQUEST['id'];

$qr = "SELECT pro.proveedor, pc.idsolicitud, pc.fecha FROM pedidos_cliente pc LEFT JOIN pedidos_cliente_detalle pcd ON pc.idsolicitud=pcd.idsolicitud LEFT JOIN productos p ON p.idproducto=pcd.idproducto LEFT JOIN proveedores pro ON pro.idproveedor=p.idproveedor WHERE pro.idproveedor='".$id."' and pc.idestatus = 1 ";
$respuesta = mysqli_query($link, $qr);

$row = mysqli_fetch_array($respuesta);

$qr_head = "select pr.costo_compra, pd.cantidad, pd.idmedida, pd.peso
from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud 
left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where pr.idproveedor = '".$id."' and pd.idestatus = 2";
$res_head = mysqli_query($link, $qr_head);

$total = 0;

while($row_head = mysqli_fetch_array($res_head)){
	
	if($row_head['idmedida'] == 4){
		$total += $row_head['costo_compra']*$row_head['cantidad'];
	} else {
		$total += $row_head['costo_compra']*$row_head['peso'];
	}
	
}

$_SESSION['money']='$'.number_format($total,2);
$_SESSION['proveedor']=$row['proveedor'];
$_SESSION['fecha']=$row['fecha'];
$_SESSION['idsolicitud']=$row['idsolicitud'];

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
		$this->Cell(15,10,'No. Pedido:',0,0,'R');
		$this->Cell(15,10,$_SESSION['idsolicitud'],0,0,'L');
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
$pdf->SetTitle('Ticket por Cliente',true);

$pdf->Cell(20,10,'Num. Pedido',0,0,'C');
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

/*$qr_tabla = "SELECT cd.idpedidodet, c.idpedido, pcd.idsolicitud, cl.cliente, p.idproveedor, p.proveedor, pro.producto, pcd.cantidad, um.umedida, pro.costo_venta FROM compras_detalle cd LEFT JOIN compras c ON c.idpedido = cd.idpedido LEFT JOIN proveedores p ON p.idproveedor=c.idproveedor LEFT JOIN clientes cl ON cl.idcliente = c.idcliente LEFT JOIN pedidos_cliente_detalle pcd ON pcd.idproducto = cd.idproducto LEFT JOIN productos pro ON pro.idproducto = pcd.idproducto LEFT JOIN unidad_medida um ON um.idmedida = pcd.idmedida WHERE c.idpedido = '".$id."' ORDER BY idsolicitud ASC";*/

$clientes=0;

$qr_tabla = "select pd.idsolicitud, pc.idcliente, c.cliente, p.producto, pd.cantidad, um.umedida, pd.idmedida, pd.peso, p.costo_compra from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente left join unidad_medida um on pd.idmedida=um.idmedida where p.idproveedor='".$id."' and pd.idestatus=1";

$res = mysqli_query($link, $qr_tabla);

while($row_tabla = mysqli_fetch_array($res)){
	
	if($clientes <> $row_tabla['idcliente']){
		if($clientes <> 0){
			$pdf->Cell(0,10,'','B',0,'C');
			$pdf->Ln();
		}
	}
	
	if($row_tabla['idmedida'] == 4){
		$costo = $row_tabla['cantidad'] * $row_tabla['costo_compra'];
		$peso=$row_tabla['cantidad'].' PZA';
	} else {
		$costo = $row_tabla['peso'] * $row_tabla['costo_compra'];
		$peso= $row_tabla['peso'].' KG';
	}
	
	$pdf->Row(array($row_tabla['idsolicitud'], $row_tabla['cliente'], $row_tabla['producto'], $row_tabla['cantidad'], $row_tabla['umedida'], $peso, '$'.number_format($row_tabla['costo_compra'],2),'$'.number_format($costo,2)));
	$clientes=$row_tabla['idcliente'];
	
	
}



$pdf->Output();


?>