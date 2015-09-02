<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelArticulo');
		$this->load->library('form_validation');
		$this->load->library('pagination');
	}
	public function vista_descuentos()
	{
		$this->logueado();
		$this->load->view('includes/header');
		$this->load->view('admin/configuraciones');
	}
	public function logueado()
	{
		if(!$this->session->userdata('id_user'))
			redirect(base_url().'login/cerrarSesion');
	}
	public function descuento()
	{
		$this->logueado();
		$data=$this->input->post();
		$this->ModelArticulo->descuento($data);
		redirect(base_url().'configuracion/obtenerListaUtilidad/');
	}
	public function likeSeccion()
	{
		$this->logueado();
		$seccion=$this->input->post('seccion');
		$query=$this->ModelArticulo->likeSeccion($seccion);
		$i=0;
		foreach ($query->result() as $row ) {
			$data[$i]=$row->seccion;
			$i++;
		}
		echo json_encode($data);
	}

	public function likeMarca()
	{
		$this->logueado();
		$marca=$this->input->post('marca');
		$query=$this->ModelArticulo->likeMarca($marca);
		$i=0;
		foreach ($query->result() as $row ) {
			$data[$i]=$row->marca;
			$i++;
		}
		echo json_encode($data);
	}
	public function likeSku()
	{
		$this->logueado();
		$sku=$this->input->post('sku');
		$query=$this->ModelArticulo->likeSku($sku);
		$i=0;
		foreach ($query->result() as $row ) {
			$data[$i]=$row->sku;
			$i++;
		}
		echo json_encode($data);
	}
	public function utilidadSeccion()
	{
		$this->logueado();
		$this->form_validation->set_rules('seccion','Seccion','required');
		$this->form_validation->set_rules('utilidad','Utilidad','required');
		$this->form_validation->set_rules('desde','Desde','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===FALSE)
		{
			$this->obtenerListaUtilidad();
		}
		else
		{
			$data=$this->input->post();
			if(!isset($data['prioridad']))
				$data['prioridad']="";
			if(strlen($data['prioridad'])==1)
				$data['prioridad']=1;
			else
				$data['prioridad']=0;
			$query=$this->ModelArticulo->utilidadSeccion($data);
			//$this->vista_descuentos();	
			//redirect(base_url().'configuracion/obtenerListaUtilidad/');
			$this->obtenerListaUtilidad(0,$query);
		}
	}
	public function utilidadMarca()
	{
		$this->logueado();
		$this->form_validation->set_rules('marca','Marca','required');
		$this->form_validation->set_rules('utilidad','Utilidad','required');
		$this->form_validation->set_rules('desde','Desde','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===FALSE)
		{
			//$this->vista_descuentos();
			$this->obtenerListaUtilidad();
		}
		else
		{
			$data=$this->input->post();
			if(!isset($data['prioridad']))
				$data['prioridad']="";
			if(strlen($data['prioridad'])==1)
				$data['prioridad']=1;
			else
				$data['prioridad']=0;
			$query=$this->ModelArticulo->utilidadMarca($data);
			//$this->vista_descuentos();	
			$this->obtenerListaUtilidad(0,$query);
		}
	}
	public function utilidadSku()
	{
		$this->logueado();
		$this->form_validation->set_rules('sku','Sku','required');
		$this->form_validation->set_rules('utilidad','Utilidad','required');
		//$this->form_validation->set_rules('desde','Desde','required');
		//$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===FALSE)
		{
			//$this->vista_descuentos();
			$this->obtenerListaUtilidad();
		}
		else
		{
			$data=$this->input->post();
			
			$query=$this->ModelArticulo->utilidadSku($data);
			//$this->vista_descuentos();	
			redirect(base_url().'configuracion/obtenerListaUtilidad/');
		}
	}
	function listaUtilidad()
	{
		$this->logueado();
		$ind=$this->input->post('ind');
		$utilidad=$this->input->post('utilidad');
		for($i=0;$i<$ind;$i++)
		{
			if($this->input->post('item'.$i)==1)
				$this->ModelArticulo->listaUtilidad($this->input->post('id_articulo'.$i),$utilidad);
		}
		$this->obtenerListaUtilidad();
	}
	function busquedaLista()
	{
		$this->logueado();
		if($this->session->userdata('cadena'))
			$this->session->unset_userdata('cadeana');
		$this->session->set_userdata('cadena',$this->input->post('cadena'));
		$this->obtenerListaUtilidad(1);
	}
	function obtenerListaUtilidad($op=0,$bandera="")
	{
		$this->logueado();
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);	
		if(empty($offset))
				$offset=0;	
		$config['base_url']=base_url().'configuracion/obtenerListaUtilidad';

		
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		if($op==1 || $this->session->userdata('cadena'))
		{
			$data['query']=$this->ModelArticulo->buscarLista($this->session->userdata('cadena'),$offset,$config['per_page']);
			$config['total_rows']=$this->ModelArticulo->numRowsCadena($this->session->userdata('cadena'));
		}
		else
		{
			$data['query']=$this->ModelArticulo->obtenerListaUtilidad($offset,$config['per_page']);	
			$config['total_rows']=$this->ModelArticulo->numRows();
		}
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$data['ruta']="clientesgeneral.js";
		$data['bandera']="";
		switch ($bandera) 
		{
			case '1':
				$data['bandera']='Se aplico la utilidad correctamente';		
				break;
			case '2':
				$data['bandera']='El limite del rango, ya se encuentra dentro de otro. Incorrecto "hasta"';		
				break;
			case '3':
				$data['bandera']='El limite del rango, ya se encuentra dentro de otro. Incorrecto "desde"';		
				break;
			default:
				# code...
				break;
		}
		
		$this->load->view('includes/header',$data);
		$this->load->view('admin/configuraciones');	
	}
	function verEnvios($offset=0)
	{

		$this->logueado();
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);	
		if(empty($offset))
				$offset=0;	
		$config['base_url']=base_url().'configuracion/verEnvios';
		$config['total_rows']=$this->ModelArticulo->numRows_envios();
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['query']=$this->ModelArticulo->obtenerEnvios($offset,$config['per_page']);
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$this->load->view('includes/header',$data);
		$this->load->view('envios/verenvios');
		$this->load->view('envios/modales');
	}
	function verRemisiones()
	{
		$this->logueado();
		$id=$this->input->post('id_pago');
		$query=$this->ModelArticulo->getRemisiones($id);
		echo json_encode($query->result());
	}
	function editarRangos($offset=0)
	{
		$this->logueado();
		$categoria=$this->input->post('categoria');
		$uri_segment=3;
		$offset=$this->uri->segment($uri_segment);	
		if(empty($offset))
				$offset=0;	
		$config['base_url']=base_url().'configuracion/editarRangos';
		$config['total_rows']=$this->ModelArticulo->numRowsRangos($categoria);
		$config['per_page']=100;
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Ultimo";
		$config['next_link']=">>";
		$config['prev_link']="<<";
		$config['cur_tag_open']="<span class='badge'>";
		$config['cur_tag_close']="</span>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data['paginacion']=$this->pagination->create_links();
		$data['query']=$this->ModelArticulo->getRangos($offset,$config['per_page'],$categoria);
		$data['title']="";
		$data['cont']=$this->uri->segment($uri_segment);
		$this->load->view('includes/header',$data);
		$this->load->view('admin/rangos');
	}
	function modificarRango()
	{
		$this->form_validation->set_rules('id_utilidad','ID','required');
		$this->form_validation->set_rules('ut','Utilidad','required|number|callback_comprobarRango');
		$this->form_validation->set_rules('desde','Desde','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()==false)
		{
			$this->editarRangos();
		}
		else
		{
			$data=$this->input->post();
			$id=$data['id_utilidad'];
			unset($data['id_utilidad']);
			$this->ModelArticulo->modificarRango($data,$id);
			redirect(base_url().'configuracion/editarRangos');
		}
	}
	function comprobarRango()
	{
		$data=$this->input->post();
		$query=$this->ModelArticulo->comprobarRango($data);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('comprobarRango','Este rango se encuentra dentro de otro, verificalo');
			return false;
		}
		else
			return true;
	}
	function eliminarRango()
	{
		$id=$this->input->post('id_utilidad');
		$query=$this->ModelArticulo->eliminarRango($id);
		redirect(base_url().'configuracion/editarRangos');
	}
}