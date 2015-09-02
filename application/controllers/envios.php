<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Envios extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelEnvios');
		$this->load->model('ModelArticulo');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('cart');
		$this->load->library('email');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	public function registrarUsuario()
	{
		$this->form_validation->set_rules('correo','Correo','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|md5');
		$this->form_validation->set_rules('confirmacionPass','Password','required|md5');
		if($this->form_validation->run()===false)
		{
			$data['mensaje']="";
			$data['mensaje2']="";
			$this->vistaRegistroUsuario($data);
		}
		else
		{
			$data['correo']=$this->input->post('correo');
			$data['pass']=$this->input->post('pass');
			$confirmacionPass=$this->input->post('confirmacionPass');
			$query=$this->ModelEnvios->buscarUsuario($data['correo']);
			if($query->num_rows()==0)
			{
				if($data['pass']==$confirmacionPass)
				{
					$query=$this->ModelEnvios->registrarUsuario($data);
					$this->vistaRegistroEnvio($data);
				}
				else
				{
					$vec['mensaje']="Confirme su password";
					$vec['mensaje2']="";
					$this->vistaRegistroUsuario($vec);
				}
			}
			else
			{
				$vec['mensaje']="Ya existe ese usuario";
				$this->vistaRegistroUsuario($vec);
			}
		}
	}
	public function vistaRegistroEnvio($data)
	{

		$query=$this->ModelEnvios->buscarUsuario($data['correo']);
		foreach ($query->result() as $row) 
		{
			$data['id_usuario']=$row->id_usuario;
		}
		$this->vistaPrincipal();
		$this->load->view('includes/scripts');
		$data['envios']=$this->ModelEnvios->getLastSends($data['id_usuario']);
		$this->load->view('envios/datosenvio',$data);
		$this->vistaFooter();
	}
	public function ingresarUsuario()
	{
		$this->form_validation->set_rules('correo','Correo','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|md5');
		if($this->form_validation->run()===false)
		{
			$data['mensaje']="";
			$this->vistaRegistroUsuario($data);
		}
		else
		{
			$data['correo']=$this->input->post('correo');
			$data['pass']=$this->input->post('pass');
			$query=$this->ModelEnvios->comprobarUsuario($data['correo'],$data['pass']);
			if($query->num_rows()>0)
			{
				$this->vistaRegistroEnvio($data);
			}
			else
				{
					$data['mensaje2']="Compruebe sus datos";
					$this->vistaRegistroUsuario($data);
				}
		}
	}
	public function vistaRegistroUsuario($data)
	{
		$data=$this->generarAleatorios(4);
		$consulta['query']=$this->consultaAleatoria($data);
		$this->vistaPrincipal();
		$this->load->view('envios/usuario',$consulta); //vista para agregar o loguearte e ir a llenar los datos
		$this->vistaFooter();
	}
	function consultaAleatoria($id)
	{
		$cadena="select *from articulos a join detinvart ea on a.id_articulo=ea.id_articulo join inventario i on i.id_inventario=ea.id_inventario join marcas m on m.id_marca=a.id_marca join lineas l on l.id_linea=a.id_linea join secciones s on s.id_seccion=a.id_seccion where ";
		for($i=0;$i<count($id);$i++)
		{
			$cadena.=' a.id_articulo='.$id[$i];
			if($i==(count($id)-1))
				$cadena.=';';
			else
				$cadena.=' or';
		}
		$query=$this->ModelArticulo->consultaAleatoria($cadena);
		return $query;
	}
	public function generarAleatorios($n)
	{
		$max=$this->ModelArticulo->numRows();
		for($i=0;$i<$n;$i++)
		{
			$num[$i]=rand(1,$max);
		}
		return $num;
	}
	public function registroEnvio()
	{
		$this->form_validation->set_rules('nombre','Nombre','required|trim');
		$this->form_validation->set_rules('apellido_paterno','Apellido Paterno','required|trim');
		$this->form_validation->set_rules('apellido_materno','Apellido Materno','required|trim');
		$this->form_validation->set_rules('calle','Calle','required|trim');
		$this->form_validation->set_rules('n_interior','Número Interior','required|trim');
		$this->form_validation->set_rules('n_exterior','Número Exterior','required|trim');
		$this->form_validation->set_rules('referencia','Referencia','required|trim');
		$this->form_validation->set_rules('ciudad','Ciudad','required|trim');
		$this->form_validation->set_rules('estado','','required|trim');
		$this->form_validation->set_rules('colonia','Colonia','required|trim');
		$this->form_validation->set_rules('telefono','Telefono','required|trim');
		$this->form_validation->set_rules('codigo_postal','Codigo Postal','required|trim');
		$this->form_validation->set_rules('razon_social','Razon Social','trim');
		$this->form_validation->set_rules('rfc','RFC','trim');
		if($this->form_validation->run()===false)
		{
			$data['correo']=$this->input->post('correo');
			$data['id_usuario']=$this->input->post('id_usuario');
			$this->vistaRegistroEnvio($data);
			$data=$this->input->post();
			
		}
		else
		{
			$data=$this->input->post();
			$correo=$data['correo'];
			unset($data['correo']);
			if(!empty($data['id_cliente']) )
			{
				$id_cliente=$data['id_cliente'];
			}
			else 
			{
				$this->ModelEnvios->registroEnvio($data);
				$query=$this->ModelEnvios->obtenerUltimoEnvio($correo);
				foreach ($query->result() as $row)
				{
					$id_cliente=$row->id_cliente;
					
				}
			}
			$this->session->set_userdata('id_cliente',$id_cliente);
			$this->agregarDetEnvArt();
			$this->vistaPagos();		
		}
	}
	function ordenamiento()
	{
		$data[0]=array('almacen'=>5,'moneda'=>'usd');
		$data[1]=array('almacen'=>3,'moneda'=>'mn');
		$data[2]=array('almacen'=>1,'moneda'=>'mn');
		$data[3]=array('almacen'=>4,'moneda'=>'usd');
		$data[4]=array('almacen'=>2,'moneda'=>'mn');
		print_r($data);
		//echo '<br>';
		$arr=$this->quicksort($data,0,count($data)-1);
		print_r($arr);
	}
	function quicksort($data,$izq,$der)
	{
		if($izq>=$der)
			return $data;
		 $i=$izq;$d=$der;
		if($izq!=$der)
		{
			$aux=0;
			$pivote=$izq;
			while($izq!=$der)
			{
				while($data[$der]['almacen']>=$data[$pivote]['almacen'] && $izq<$der)
					$der--;
				while($data[$izq]['almacen']<$data[$pivote]['almacen'] && $izq<$der)
					$izq++;
				if($der!=$izq)
				{
					$aux=$data[$der];
					$data[$der]=$data[$izq];
					$data[$izq]=$aux;
				}
				if($der==$izq)
				{
					$data=$this->quicksort($data,$i,$izq-1);
					$data=$this->quicksort($data,$izq+1,$d);
				}
			}
		}
		else
			return $data;
		return $data;
	}
	#funcion ajax, para sacar el ultimo envio del cliente
	function obtenerUltimoEnvio()
	{
		$id_cliente=$this->input->post('id_cliente');
		$data=array();
		$query=$this->ModelEnvios->obtenerEnvio($id_cliente);
		echo json_encode($query->result());
	}
	function ordenarArticulos()
	{
		$i=0;
		$j=0;
		foreach ($this->cart->contents() as $item)
		{
			if($item['moneda']=="MN")
			{
				$mn[$i++]=array('almacen'=>$item['almacen'],'moneda'=>$item['moneda'],'strSku'=>$item['sku'],'iCantidad'=>$item['qty']);
			}
			else
			{
				$usd[$j++]=array('almacen'=>$item['almacen'],'moneda'=>$item['moneda'],'strSku'=>$item['sku'],'iCantidad'=>$item['qty']);
			}
			//$this->procesoApartado($mn);

		}
		if(isset($mn))
		{
			$mn=$this->quicksort($mn,0,count($mn)-1);
			$this->procesoApartado($mn);
		}
		if(isset($usd))
		{
			$usd=$this->quicksort($usd,0,count($usd)-1);
			$this->procesoApartado($usd);
		}
	}

	function procesoApartado($data)
	{
		$i=0;
		$carrito=array();
		while($i<count($data))
		{
			$temp=$data[$i]['almacen'];
			for($j=0;$j<count($data);$j++)
			{
				if($temp==$data[$j]['almacen'])
				{
					$carrito[]=array('strSku' => $data[$j]['strSku'],'iCantidad'=>$data[$j]['iCantidad'] );
					$moneda=$data[$j]['moneda'];
					$almacen=$data[$j]['almacen'];
				}
				else 
					continue;
			}
			$folio=$this->apartado($almacen,$moneda,$carrito);
			$i=$j;
			//$folio['estatus']=1;
			$campos['moneda']=$moneda;
			$campos['almacen']=$almacen;
			$campos['estado_remision']=$folio['estatus'];
			$campos['id_pago']=$this->session->userdata('id_pago');
			if($folio['estatus'])
				{
					$campos['remision']=$folio['datos'];
				}
				else
				{
					$campos['mensaje']=$folio['mensaje'];
				}
			$this->ModelEnvios->agregarRemision($campos);
		} //while
	}
	function agregarDetEnvArt()
	{
		
		foreach ($this->cart->contents() as $item)
		{
			
			$data['id_cliente']=$this->session->userdata('id_cliente');
			$data['id_articulo']=$item['id'];
			$data['cant']=$item['qty'];
			$this->ModelEnvios->agregarDetEnvArt($data);
		}
	}
	
	function vistaPrincipal()
	{
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['articles'] = $this->ModelArticulo->Oferts();
		$data['destacados'] = $this->ModelArticulo->Destacados();
		$data['recomendados'] = $this->ModelArticulo->Recomendados();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
	}
	function vistaFooter()
	{
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');

	}
	function apartado($almacen,$moneda,$data){
		include_once('lib/nusoap.php');
		$strUrl = "http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl";
		try{
			$client = new nusoap_client($strUrl, array("cache_wsdl" => WSDL_CACHE_NONE));
			$result = $client->call("GenerarRemision", array(
				6722,
				"112012",
				$almacen,
				$moneda,
				
					$data,
					
				"0012code"
			));
			return $result;
		}
		catch(Exception $ex)
		{
			 print_r($ex->getMessage());
		}	
	}
	function agregarPago()
	{
		$this->form_validation->set_rules('tipo_pago','Pago','required');
		$this->form_validation->set_rules('fecha_pago','Fecha','required');
		$this->form_validation->set_rules('total','Total','required');
		if($this->form_validation->run()===false)
		{
			$this->vistaPagos();
		}
		else
		{
			$data=$this->input->post();
			$data['id_cliente']=$this->session->userdata('id_cliente');
			$query=$this->ModelEnvios->agregarPago($data);

			$sql=$this->ModelEnvios->obtenerEnvio($this->session->userdata('id_cliente'));
			$vec=array();
			if($sql->num_rows()>0)
				$vec=$sql->row_array();
			switch ($data['tipo_pago']) {
				case 'referencia':
						$mensaje='<!DOCTYPE html><html><head><title>ISCO COMPUTADORAS</title>';
						$estilo='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
						<style>
							hr{
								background-color:white;
							}
							.tabla thead {
							  background-color: #b88ae6;
							  color: #fff;
							}
							.tabla tbody tr:nth-child(even) {
							  background-color: #e6ccff;
							}
							.tabla tbody tr:nth-child(odd) {
							  background-color: #f5ebff;
							}
							.titulo{
								color:#001A66;
								font-weight:bold;
							}
							.well{
								display:inline-block;
								width:40%;
								margin-left:25px !important;
							}
							.container
							{
								width:80%;
								margin-left:9%;
								background-color:#F5FFFF;
							}
						</style><body>';
						$mensaje.=$estilo;
						$mensaje.='<div class="container">';
						$mensaje.='<h2 class="titulo">ISCO COMPUTADORAS</h2>';
						$mensaje.='<b>ISCO COMPUTADORAS AGRADECE TU PREFERENCIA, A CONTINUACION SE MUESTRA TU COMPRA Y LAS REFERENCIAS PARA QUE HAGAS EL PAGO INDICADO EN ESTE CORREO</b><HR style="color:white">';
						$mensaje.='Nombre del cliente: <b>'.$vec['nombre'].' '.$vec['apellido_paterno'].' '.$vec['apellido_materno'].'</b>';
						$carrito='<table class="table table-bordered tabla">
                        <thead>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>';
                             foreach ($this->cart->contents() as $item) 
                            {
                               $carrito.= '<tr>
                                    <td>'.$item['name'].'</td>
                                    <td>'.$item['price'].'</td>
                                    <td>'.$item['qty'].'</td>
                                    <td>'.($item['price']*$item['qty']).'</td>
                                </tr>';
                             }
                            $carrito.='<tr><td class="font-size:.7em"colspan="2">Se incluye el costo del envio $99.00</td><td class="titulo">Total:</td><td style="font-weight:bold">$'.number_format($this->cart->total()+99,2).'</td></tr>
                        </tbody>
                   </table>';
                    $mensaje.=$carrito;
                    $mensaje.='<hr style="color:white"><h2 class="titulo">Referencias Bancarias</h2>';
                    $mensaje.='<div><div class="well" style="margin-left:9%;">';
                    $mensaje.='<p><b>SCOTIABANK</b></p>';
                    $mensaje.='<p>1) No. cuenta: 03100155144';
                    $mensaje.='<p>2) No. cuenta: 03100126160';
					$mensaje.='</div>';
					$mensaje.='<div style="width:7%;display:inline-block;"></div>';
					$mensaje.='<div class="well" style="margin-left:9%;height:100%;">';
					$mensaje.='<p><b>BANCOMER</b></p>';
					$mensaje.='<p>1) No. cuenta: 00165304288</p></div></div>';
					$mensaje.='</div>';
                    $mensaje.='</body></html>';
                    $this->sendEmail('iscosahuayo@gmail.com',$vec['correo'],$mensaje);
					break;
				case 'isco':
					break;
				default:
					break;
			}
			if($query>0)
			{
				$this->session->set_userdata('id_pago',$query);
			}
			$this->ordenarArticulos();
			$this->destruirCarro();
			$this->vistaPrincipal();
			$this->load->view('inicio');
			$this->vistaFooter();
		}
	}
	function crearNota()
	{
		require_once('fpdf/fpdf.php');

	}
	function sendEmail($from="",$to="",$cadena="")
	{
		$config['mailtype']='html';
		$config['protocol']='mail';
		$config['priority']=5;
		$this->email->initialize($config);
		$this->email->from($from,'ISCO COMPUTADORAS');
		$this->email->to($to);
		$this->email->subject('ISCO TIENDA ONLINE');
		$this->email->message($cadena);
		$this->email->send();
	}
	function destruirCarro()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('id_pago');
		$this->session->unset_userdata('id_cliente');
		$this->session->unset_userdata('carrito');
	}
	function vistaPagos()
	{
		date_default_timezone_set('America/Monterrey');
		$prop['fecha_pago']=date('Y-m-d H:i:s');  
		$this->vistaPrincipal();
		$this->load->view('includes/scripts');
		$this->load->view('envios/pagos',$prop);
		$this->vistaFooter();
	}
}
?>