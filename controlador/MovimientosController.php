<?php

require_once 'modelo/Producto.php';
require_once 'modelo/Categoria.php';
require_once 'modelo/Proveedor.php';
require_once 'modelo/Venta.php';
require_once 'modelo/DetalleVenta.php';



class MovimientosController
{
	private $model;
	

	public function __CONSTRUCT()
	{
		//Inicializa los modelos
		$this->model = new Producto();
		$this->modelCategoria = new Categoria();
		$this->modelProveedor = new Proveedor();
		$this->modelVenta = new Venta();
		$this->modelDetalleVenta = new DetalleVenta();

	}

	//Tablas de Usuario
	public function Index(){
		//muestra todas las partes de la vista de Usuario Almacenado
		require_once 'vistas/pages/encabezadopagina1.php';
		require_once 'vistas/pages/registrar/ingresoproducto.php';
		require_once 'vistas/pages/piepagina1.php';
	}

	public function CrearVenta(){
		require_once 'vistas/pages/encabezadopagina1.php';
		require_once 'vistas/pages/registrar/crearventa.php';
		require_once 'vistas/pages/piepagina1.php';

	}

	  public function GuardarVenta(){


        $venta = new Venta();
        
        //captura todos los datos de la venta 
        
        $venta->numeroventa = $_REQUEST['txtNumeroVenta'];
        $venta->fechaventa = $_REQUEST['txtFechaVenta'];
        $venta->total = $_REQUEST["txtTotal"];
        $venta->idusuario = $_REQUEST["txtIdUsuario"];
        $venta->tipo_comprobante = $_REQUEST["selComprobante"];


        //obtener el número de detalles que se enviaron
        $numerodetalles = $_REQUEST['txtCantidadDetalle'];        

        //guardar la venta y obtener el id guardado
        $nuevaventa = $this->modelVenta->guardarventa($venta);



                   //guardar todos los detalles
            for ($i=1; $i < $numerodetalles; $i++) { 
                $detalleventa = new DetalleVenta();
                # tomar todos los datos del detalle
                $detalleventa->idventa = $nuevaventa;
                $detalleventa->idproducto = $_REQUEST['txtIdproducto'.$i];
                $detalleventa->cantidadventa = $_REQUEST['txtCantidad'.$i];
                $detalleventa->precioventa = $_REQUEST['txtSubTotal'.$i];
                

         
                $this->modelDetalleVenta->guardardetalleventa($detalleventa); 
            }

        
        echo "<script>alert('Guardamos todo con éxito');</script>"; 

        		//La vista de usuarios registrados
		echo "<script>
		alert('CORRECTO: Los datos fueron guardados.');
		window.location.href='?c=".base64_encode('Producto')."';
		</script>";
        
    }


	
}

?>