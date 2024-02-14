<?php
session_start();
	
require('../mc_table.php');
include('../conexion.php');
$link = Conectarse();

$id = $_REQUEST['id'];

/*$qr_head = "select p.*, c.cliente, e.estatus, r.repartidor, z.zona from pedidos_cliente p, clientes c, estatus e, repartidores r, zonas z where  p.idcliente = c.idcliente and p.idestatus = e.idestatus and c.idrepartidor = r.idrepartidor and r.idzona = z.idzona  and p.idsolicitud = '".$id."'";*/



/*  SI ALGO FALLA REGRESAR ESTE CODIGO 
$qr_head = "select p.*, c.cliente, e.estatus, rp.repartidor
from pedidos_cliente p 
left join clientes c on p.idcliente = c.idcliente 
left join estatus e on p.idestatus = e.idestatus
left join asignacion_rutas ar ON ar.idsolicitud = p.idsolicitud
left join repartidores rp ON ar.idrepartidor = rp.idrepartidor
where p.idsolicitud = '".$id."'"; */

$qr_head = "select p.*, c.cliente, e.estatus, rp.repartidor, sum(d.importe) total
from pedidos_cliente p 
left join clientes c on p.idcliente = c.idcliente 
left join estatus e on p.idestatus = e.idestatus
left join asignacion_rutas ar ON ar.idsolicitud = p.idsolicitud
left join repartidores rp ON ar.idrepartidor = rp.idrepartidor
left join pedidos_cliente_detalle d on d.idsolicitud=p.idsolicitud
where p.idsolicitud ='".$id."'";
$res_head = mysqli_query($link, $qr_head);
		
$row_head = mysqli_fetch_array($res_head);

$_SESSION['money']='$'.number_format($row_head['total'],0);
$_SESSION['cliente']=$row_head['cliente'];
$_SESSION['fecha']=$row_head['fecha'];
$_SESSION['idsolicitud']=$row_head['idsolicitud'];
$_SESSION['zona']=$row_head['zona'];
$_SESSION['repartidor']=$row_head['repartidor'];
$_SESSION['obs']=$row_head['obs'];

class PDF extends PDF_MC_Table
{	
	
	function Header()
	{
	     // Logo
	    $this->Image('../assets/img/logo_2x.png',10,15,60);
	    $this->Ln(20);
	    $this->SetTextColor(255,255,255);
		$this->SetFillColor(21, 45, 91);
		$this->SetFontSize(20);
		// Arial bold 15
		$this->SetFont('Arial','B',35);
		$this->Cell(30);
	    $this->Cell(90,30,$_SESSION['money'],1,0,'C',true);
		$this->Cell(10);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',8);
		$this->Cell(15,10,'Pedido de:',0,0,'R');
		$this->Cell(40,10,utf8_decode($_SESSION['cliente']),0,0,'L');
		
		$this->Ln(5);
		
		$this->Cell(125);
		
		$this->Cell(15,10,'Fecha:',0,0,'R');
		$this->Cell(16,10,$_SESSION['fecha'],0,0,'L');
		$this->Cell(35);
		
		$this->Ln(5);
		$this->SetFont('Arial','',12);
		$this->Cell(138);
		$this->Cell(15,10,'No. Pedido:',0,0,'R');
		$this->Cell(15,10,$_SESSION['idsolicitud'],0,0,'L');
		$this->Cell(35);
		$this->Ln(10);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',13);
		
		// Title
		
		
		$this->Ln(10);
		$this->Cell(54);
		$this->SetFont('Arial','',24);
		$this->Cell(15,10,'Repartidor:',0,0,'R');
		$this->Cell(40,10,utf8_decode($_SESSION['repartidor']),0,0,'L');
		
		$this->Ln(7);
		$this->Cell(38);
		$this->SetFont('Arial','',10);
		$this->Cell(10,10,'Observacion:',0,0,'R');
		$this->Cell(40,10,utf8_decode($_SESSION['obs']),0,0,'L');
		$this->Ln(10);
		$this->Ln(5);
	    
		// Title
		
		
	    // Arial bold 8
		
	    
	    // Line break
	   
	    
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
		$this->SetFont('Arial','B',17);
		$this->Cell(175,10,'Gracias por tu compra!',0,0,'C');
	}
	
}

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','',8);

$pdf->Cell(50,10,'Descripcion',0,0,'C');
$pdf->Cell(30,10,'Cantidad',0,0,'C');
$pdf->Cell(30,10,'U. Medida',0,0,'C');
$pdf->Cell(30,10,'P. Unitario',0,0,'C');
$pdf->Cell(30,10,'Peso Real',0,0,'C');
$pdf->Cell(30,10,'Importe',0,0,'C');
$pdf->Ln();

$pdf->SetWidths(array(50,30,30,30,30,30));
$pdf->SetAligns(array('C','C','C','C','C','C'));

/*$qr_tabla = "SELECT cd.idpedidodet, c.idpedido, pcd.idsolicitud, cl.cliente, p.idproveedor, p.proveedor, pro.producto, pcd.cantidad, um.umedida, pro.costo_venta FROM compras_detalle cd LEFT JOIN compras c ON c.idpedido = cd.idpedido LEFT JOIN proveedores p ON p.idproveedor=c.idproveedor LEFT JOIN clientes cl ON cl.idcliente = c.idcliente LEFT JOIN pedidos_cliente_detalle pcd ON pcd.idproducto = cd.idproducto LEFT JOIN productos pro ON pro.idproducto = pcd.idproducto LEFT JOIN unidad_medida um ON um.idmedida = pcd.idmedida WHERE c.idpedido = '".$id."' ORDER BY idsolicitud ASC";*/


$qr_tabla = "select p.*, d.*, c.codigo, c.producto, c.idproveedor, d.precio_unitario, d.importe as total, m.umedida from pedidos_cliente p, pedidos_cliente_detalle d, productos c, unidad_medida m where p.idsolicitud = d.idsolicitud and d.idproducto = c.idproducto and d.idmedida = m.idmedida and p.idsolicitud = '".$id."'";

$res = mysqli_query($link, $qr_tabla);
$subtotal = 0;

while($row_tabla = mysqli_fetch_array($res)){
	
	/*if($row_tabla['idmedida'] == '1'){
		$costo = $row_tabla['peso'] * $row_tabla['costo_venta'];
	} else {
		$costo = $row_tabla['cantidad'] * $row_tabla['costo_venta'];
	}
	if($row_tabla['idmedida'] == 4){
		$peso=$row_tabla['cantidad'].' PZA';
	} else {
		$peso= $row_tabla['peso'].' KG';
	}*/
	
	
	$pdf->Row(array($row_tabla['producto'], $row_tabla['cantidad'], $row_tabla['umedida'], '$'.number_format($row_tabla['precio_unitario'],0), $row_tabla['peso'], '$'.number_format($row_tabla['total'],0)));
	
	$subtotal = $subtotal + $row_tabla['total'];
				                          
	
	
	
}
$pdf->Ln();
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(21, 45, 91);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(370,10,'$'.number_format($subtotal,0),1,0,'C', true);


$pdf->Output();


?>