<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Productos extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
	}

	public function index()
	{
		

	}

	function detallesproducto(){
		$id = $this->uri->segment(3);
		$query = $this->ModelArticulo->getArticulo($id);
		foreach($query->result() as $prod){
			$sku = $prod->sku;
			$utilidad=$prod->utilidad;
			$ut=$prod->ut;
		}
		if($utilidad==0)
			$utilidad=$ut;
		$client = $this->socket->conexion();
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
		$param = array('cliente' =>6722,'llave' => '112012', 'sku' => $sku);
		$result = $client->call('ObtenerArticulo', $param);
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
				if($result['estatus'] == 1 || $result['estatus'] == '1'){
					$vec = array(
						'exis' => $result['datos']['inventario'][0]['existencia'],
						'almacen' => $result['datos']['inventario'][0]['almacen'],
						'sku' => $result['datos']['sku'],
						'precio' => $result['datos']['precio'],
						'marca' => $result['datos']['marca'],
						'seccion' => $result['datos']['seccion'],
						'linea' => $result['datos']['linea'],
						'serie' => $result['datos']['serie'],
						'peso' => $result['datos']['peso'],
						'alto' => $result['datos']['alto'],
						'ancho' => $result['datos']['ancho'],
						'largo' => $result['datos']['largo'],
						'moneda' => $result['datos']['moneda'],
						'utilidad'=>$utilidad
					);
					if(!$this->session->userdata('cambio'))
						$this->getParidad($client);	
					$this->mostrarProd($id,$vec);
				}
				else{
					$this->productSold();
				}

			}
		}
	}

	function mostrarProd($id,$vec){
		extract($vec);
		$query = $this->ModelArticulo->getArticulo($id);
		if($query->num_rows() > 0){
			$data['articulo'] = $query;
			$data['secciones'] = $this->ModelArticulo->getSections();
			$data['marcas'] = $this->ModelArticulo->getMarcas();
			$data['articles'] = $this->ModelArticulo->getArticles();
			if(strcmp($vec['moneda'], "MN") != 0){
				$vec['precio'] = $vec['precio'] * $this->session->userdata('cambio');
			}
			$data['costo'] = ceil(($vec['precio']+(($vec['precio']*$vec['utilidad'])/100)) * 1.16);
			$data['existencia'] = $vec['exis'];
			$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
			$data['file'] = 'main.js';
			$consulta=$this->ModelArticulo->getProdCategoria($vec['linea']);
			$data['query']=$this->generarAleatorios(6,$consulta->result_array());
			$this->load->view('includes/headersite',$data);
			$this->load->view('producto',$vec);
			$this->load->view('includes/cart');
			$this->load->view('includes/prefooter');
			$this->load->view('includes/scripts');

		}
		else
		{
			echo 'no se encontro el producto';
		}
		
	}
	public function generarAleatorios($n,$data)
	{
		$max=count($data);
		if($max<$n)
			$n=$max;
		for($i=0;$i<$n;$i++)
		{
			$ind=rand(1,$max);
			$vec[$i]=$data[$ind];
		}
		return $vec;
	}
	function productSold(){
		$vec['agotado'] = 'Lo sentimos no hay existencias disponibles del producto que deseas por ahora.';
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['articles'] = $this->ModelArticulo->getArticles();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$this->load->view('includes/headersite',$data);
		$this->load->view('sold',$vec);
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
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
					$this->session->set_userdata('cambio',$result['datos']);
				
			}
		}
		
	}

}
?>
