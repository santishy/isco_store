<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ModelArticulo');
	}
	
	public function index()
	{
		$data['cadena'] = $this->input->post('txtSearch');
		$data['precio'] = '';
		//echo $this->getParidad();
		//$data['articulos'] = $this->ModelArticulo->searchHome($data['cadena']);
		$data['articulos'] = $this->ModelArticulo->busquedaHome($data['cadena']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
		
	}

	function precio(){
		$data['cadena'] = $this->input->post('txtCadena');
		$data['precio'] = $this->input->post('txtPrecio');
		$data['preciof'] = '';
		$data['articulos'] = $this->ModelArticulo->busquedaPrecio($data['cadena'],$data['precio']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');

	}

	function rango(){
		$data['cadena'] = $this->input->post('txtCad');
		$data['precio'] = $this->input->post('txtRange1');
		$data['preciof'] = $this->input->post('txtRange2');
		$data['articulos'] = $this->ModelArticulo->busquedaRango($data['cadena'],$data['precio'],$data['preciof']);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
	}
	function mayorMenor()
	{
		$data['cadena'] = $this->uri->segment(4);
		$data['precio'] = '';
		$data['preciof'] = '';
		$cadena=$this->uri->segment(4);
		$op=$this->uri->segment(3);
		if($op==1)
			$data['articulos'] = $this->ModelArticulo->busquedaMenor($cadena);
		else
			$data['articulos'] = $this->ModelArticulo->busquedaMayor($cadena);
		$data['secciones'] = $this->ModelArticulo->getSections();
		$data['marcas'] = $this->ModelArticulo->getMarcas();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$data['file'] = "main.js";
		$this->load->view('includes/headersite',$data);
		$this->load->view('busqueda');
		$this->load->view('includes/cart');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/scripts');
	}
	function getParidad()
	{
		$cambio = 0;
		require_once('lib/nusoap.php');
		$client=new nusoap_client('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl','wsdl');
		$err = $client->getError();
		if ($err) {	echo 'Error en Constructor' . $err ; }
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
					$cambio = $result['datos'];
				
			}
		}

		return $cambio;
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */