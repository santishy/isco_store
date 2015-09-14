<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends CI_controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		ini_set('memory_limit', '-1');

	}
	public function index()
	{
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$vec=$this->generarAleatorios(12);
		$data['articles']=$this->consultaAleatoria($vec);
		//$data['articles'] = $this->ModelArticulo->Oferts();
		$vec=$this->generarAleatorios(12);
		$data['destacados'] = $this->consultaAleatoria($vec);
		$vec=$this->generarAleatorios(12);
		$data['recomendados'] = $this->consultaAleatoria($vec);
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('inicio');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');

	}
	function consultaAleatoria($id)
	{
		$cadena="select *from articulos a left join detinvart ea on a.id_articulo=ea.id_articulo left join inventario i on i.id_inventario=ea.id_inventario left join marcas m on m.id_marca=a.id_marca left join lineas l on l.id_linea=a.id_linea left join secciones s on s.id_seccion=a.id_seccion left join utilidades u on u.id_utilidad=a.id_utilidad where ";
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
	public function p(){
		echo 'debe de mostrar el mensaje';
	}
	public function cliente()
	{
		include('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
		$param = array('cliente' =>6722,'llave' => '112012');
		$result = $client->call('ObtenerListaArticulos', $param);
		if ($client->fault) 
			{
				echo 'Fallo';
				print_r($result);
			} 
			else 
			{	// Chequea errores
				$err = $client->getError();
				if ($err) {		// Muestra el error!
					echo 'Error' . $err ;
				} 
				else 
				{		// Muestra el resultado

					//print_r($result);
					if(!$this->session->userdata('dollarCambio'))
						$this->getParidad($client);	

					for($i=0;$i<count($result['datos']);$i++)
					 	$this->ModelArticulo->updateStore2($result['datos'][$i],$result['datos'][0]['inventario'][0],$this->session->userdata('dollarCambio'));
					
				}
			}
	}
		public function Obarticulo()
	{
		include('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
		$param = array('cliente' =>6722,'llave' => '112012','sku'=>'AC-366503-18');
		$result = $client->call('ObtenerArticulo', $param);
		if ($client->fault) 
			{
				echo 'Fallo';
				print_r($result);
			} 
			else 
			{	// Chequea errores
				$err = $client->getError();
				if ($err) {		// Muestra el error!
					echo 'Error' . $err ;
				} 
				else 
				{		// Muestra el resultado

					print_r($result);
					/*if(!$this->session->userdata('dollarCambio'))
						$this->getParidad($client);	

					for($i=0;$i<count($result['datos']);$i++)
					 	$this->ModelArticulo->updateStore2($result['datos'][$i],$result['datos'][0]['inventario'][0],$this->session->userdata('dollarCambio'));*/
					
				}
			}
	}
	function apartado(){
		include('lib/nusoap.php');
		$strUrl = "http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl";
		try{
			$client = new nusoap_client($strUrl, array("cache_wsdl" => WSDL_CACHE_NONE));
			$result = $client->call("GenerarRemision", array(
				6722,
				"112012",
				1,
				"MN",
				array(
						array(
							"strSku" => "DD-475503-02",
							"iCantidad" => 3
							)

					),

				"0012code"

			));
			print_r($result);

						

		}
		catch(Exception $ex){
			 print_r($ex->getMessage());
		}
		
		
		
	}
	function login()
	{
		$this->load->view('login');
	}
	function getParidad($client)
	{
		$param = array('cliente' =>6722,'llave' => '112012');
		$result = $client->call('ObtenerParidad', $param);
		if ($client->fault) 
		{
			echo 'Fallo';
			print_r($result);
		} 
		else 
		{	// Chequea errores
			$err = $client->getError();
			if ($err) {		// Muestra el error
				echo 'Error' . $err ;
			} 
			else 
			{		
				
				if($result['estatus'])
					$this->session->set_userdata('dollarCambio',$result['datos']);
				
			}
		}
		
	}

}
?>
