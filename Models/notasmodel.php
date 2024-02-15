<?php
require 'Models/marca.php';
require 'Models/tipo.php';
require 'Models/repuesto.php';
require 'Models/historicoventas.php';
require 'Models/notas.php';
require 'Models/cliente.php';
require 'Models/vendedor.php';
require 'Models/ventas.php';

class NotasModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    public function getNumeroNota(){
        $var = $query = $this->db->connect()->prepare("SELECT*FROM VENTAS ORDER BY codigoVenta DESC LIMIT 1");
        $var->execute();
        $cont = $var->rowCount();
        if($cont == 0){
            $nnota = "1302";
        }else{
            $resp = $var->fetch();
            $nnota = $resp['codigoVenta'] + 1;

            if ($nnota < 10) {
                $nnota = "000".$nnota;
            }elseif ($nnota < 100) {
                $nnota = "00".$nnota;
            }elseif ($nnota < 1000) {
                $nnota = "0".$nnota;
            }
        }
        
        
        return $nnota;
    }
    public function getClienteByDescAndCod($txtbusca){
        
        $html="<select class='form-control form-control-sm' name='idCliente'>";
        $error = "ERROR EN LA CONSULTA";
        try {
            $query = $this->db->connect()->prepare("SELECT  codigoCliente, nombreCliente FROM CLIENTE WHERE nombreCliente LIKE :txtbusca OR codigoCliente LIKE :txtbuscar ORDER BY nombreCliente DESC");
            $query->bindValue(':txtbusca', '%' . $txtbusca . '%', PDO::PARAM_STR);
            $query->bindValue(':txtbuscar', '%' . $txtbusca . '%', PDO::PARAM_STR);
            $query->execute();
            while ($row = $query->fetch()) {
                $html.= "<option value='".$row["codigoCliente"]."'>".$row["nombreCliente"]."</option>";
            }
            $html.="</select>";
            echo $html;
        } catch (PDOException $e) {
            return $error;
        }
    }

    public function getRepuestoForTipo($id){
        $items = [];
        try {
            $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE idTipo = :idTipo AND cantidadRep>0 ORDER BY codigoRep");
            $query->execute(['idTipo' => $id]);
            while ($row = $query->fetch()) {
                $query2 = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO WHERE idMarca = :idMarca");
                $query2->execute(['idMarca' => $row['idMarca']]);
                $marca = '';
                while ($row2 = $query2->fetch()) {
                    $marca = $row2['descripMarca'];
                }
                $item = new Repuesto();
                $item->idRep        = $row['idRep'];
                $item->codigoRep    = $row['codigoRep'];
                $item->descripRep   = $row['descripRep'];
                $item->cantidadRep  = $row['cantidadRep'];
                $item->precioRep    = $row['precioRep'];
                $item->idMarca      = $marca;
                $item->idTipo       = $row['idTipo'];
                if ($item->cantidadRep > 0) {
                    array_push($items, $item);
                }
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }
    public function getTipoById($id){
        $query = $this->db->connect()->prepare("SELECT*FROM TIPOREPUESTO WHERE idTipo = :idTipo");
        try {
            $query->execute(['idTipo' => $id]);
            $resp = '';
            while ($row = $query->fetch()) {
                $resp = $row["descripTipo"];
            }
            return $resp;
        } catch (PDOException $e) {
            return $resp;
        }

    }
    public function getRepuestoForCode($id){
        $resp = new Repuesto();
        try {
            $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE codigoRep = :codigoRep AND cantidadRep>0 ORDER BY codigoRep");
            $query->execute(['codigoRep' => $id]);
            while ($row = $query->fetch()) {
                $query2 = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO WHERE idMarca = :idMarca");
                $query2->execute(['idMarca' => $row['idMarca']]);
                $marca = '';
                while ($row2 = $query2->fetch()) {
                    $marca = $row2['descripMarca'];
                }
                $resp->idRep        = $row['idRep'];
                $resp->codigoRep    = $row['codigoRep'];
                $resp->descripRep   = $row['descripRep'];
                $resp->cantidadRep  = $row['cantidadRep'];
                $resp->precioRep    = $row['precioRep'];
                $resp->idMarca      = $marca;
                $resp->idTipo       = $row['idTipo'];

            }
            if ($resp->idRep == NULL || $resp->idRep == '') {
                return false;
            }else {
                return $resp;
            }
        } catch (PDOException $e) {
            return false;
        }
        
    }
    public function getAllFromCliente(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE ORDER BY nombreCliente");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Cliente();
                $item->idCliente        = $row["idCliente"];
                $item->codigoCliente    = $row["codigoCliente"];
                $item->nombreCliente    = $row["nombreCliente"];
                $item->telefonoCliente  = $row["telefonoCliente"];
                $item->direccionCliente = $row["direccionCliente"];
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }

    public function getAllFromVentas(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENTAS ORDER BY codigoVenta DESC LIMIT 50");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Ventas();
                $queryCliente = $this->db->connect()->prepare("SELECT nombreCliente FROM CLIENTE WHERE codigoCliente = :codigoCliente");
                $queryCliente->execute(['codigoCliente'   => $row['idCliente']]);
                while ($rowCliente = $queryCliente->fetch()) {
                    $item->nombreCliente = $rowCliente['nombreCliente'];
                }

                $queryVendedor = $this->db->connect()->prepare("SELECT nombreVendedor FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
                $queryVendedor->execute(['codigoVendedor'   => $row['idVendedor']]);
                while ($rowVendedor = $queryVendedor->fetch()) {
                    $item->nombreVendedor = $rowVendedor['nombreVendedor'];
                }

                $queryTotal = $this->db->connect()->prepare("SELECT*FROM HISTORICOVENTAS WHERE codigoVenta = :codigoVenta");
                $queryTotal->execute(['codigoVenta'   => $row['codigoVenta']]);
                $total = 0;
                while ($rowTotal = $queryTotal->fetch()) {
                    $total += $rowTotal['subtotalRep'];
                }



                $item->codigoVenta = $row["codigoVenta"];
                $item->idCliente   = $row["idCliente"];
                $item->idVendedor  = $row["idVendedor"];
                $item->tipoPago    = $row["tipoPago"];
                $item->fecha       = $row["fechaVenta"];
                $item->totalVenta  = $total;
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }

    public function getAllFromVentasByCodigo($id){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENTAS WHERE codigoVenta = :codigoVenta");
        try {
            $query->execute(['codigoVenta'   => $id]);
            while ($row = $query->fetch()) {
                $item = new Ventas();
                $queryCliente = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoCliente = :codigoCliente");
                $queryCliente->execute(['codigoCliente'   => $row['idCliente']]);
                while ($rowCliente = $queryCliente->fetch()) {
                    $item->nombreCliente = $rowCliente['nombreCliente'];
                }

                $queryVendedor = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
                $queryVendedor->execute(['codigoVendedor'   => $row['idVendedor']]);
                while ($rowVendedor = $queryVendedor->fetch()) {
                    $item->nombreVendedor = $rowVendedor['nombreVendedor'];
                }

                $queryTotal = $this->db->connect()->prepare("SELECT*FROM HISTORICOVENTAS WHERE codigoVenta = :codigoVenta");
                $queryTotal->execute(['codigoVenta'   => $row['codigoVenta']]);
                $total = 0;
                while ($rowTotal = $queryTotal->fetch()) {
                    $total += $rowTotal['subtotalRep'];
                }



                $item->codigoVenta = $row["codigoVenta"];
                $item->idCliente   = $row["idCliente"];
                $item->idVendedor  = $row["idVendedor"];
                $item->tipoPago    = $row["tipoPago"];
                $item->fecha       = $row["fechaVenta"];
                $item->totalVenta  = $total;
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }

    public function getAllFromVentasByFecha($f1,$f2){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENTAS ORDER BY codigoVenta DESC");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Ventas();

                if ($row['fechaVenta'] <= $f2 && $row['fechaVenta'] >= $f1) {
                    $queryCliente = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoCliente = :codigoCliente");
                    $queryCliente->execute(['codigoCliente'   => $row['idCliente']]);
                    while ($rowCliente = $queryCliente->fetch()) {
                        $item->nombreCliente = $rowCliente['nombreCliente'];
                    }
    
                    $queryVendedor = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
                    $queryVendedor->execute(['codigoVendedor'   => $row['idVendedor']]);
                    while ($rowVendedor = $queryVendedor->fetch()) {
                        $item->nombreVendedor = $rowVendedor['nombreVendedor'];
                    }
    
                    $queryTotal = $this->db->connect()->prepare("SELECT*FROM HISTORICOVENTAS WHERE codigoVenta = :codigoVenta");
                    $queryTotal->execute(['codigoVenta'   => $row['codigoVenta']]);
                    $total = 0;
                    while ($rowTotal = $queryTotal->fetch()) {
                        $total += $rowTotal['subtotalRep'];
                    }
    
    
    
                    $item->codigoVenta = $row["codigoVenta"];
                    $item->idCliente   = $row["idCliente"];
                    $item->idVendedor  = $row["idVendedor"];
                    $item->tipoPago    = $row["tipoPago"];
                    $item->fecha       = $row["fechaVenta"];
                    $item->totalVenta  = $total;
                    array_push($items,$item);
                }
               
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }

    public function getAllFromVentasByFechaAndVendedor($f1,$f2,$id){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENTAS WHERE idVendedor = :idVendedor ORDER BY codigoVenta DESC");
        try {
            $query->execute(['idVendedor'   => $id]);
            while ($row = $query->fetch()) {
                $item = new Ventas();

                if ($row['fechaVenta'] <= $f2 && $row['fechaVenta'] >= $f1) {
                    $queryCliente = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoCliente = :codigoCliente");
                    $queryCliente->execute(['codigoCliente'   => $row['idCliente']]);
                    while ($rowCliente = $queryCliente->fetch()) {
                        $item->nombreCliente = $rowCliente['nombreCliente'];
                    }
    
                    $queryVendedor = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
                    $queryVendedor->execute(['codigoVendedor'   => $row['idVendedor']]);
                    while ($rowVendedor = $queryVendedor->fetch()) {
                        $item->nombreVendedor = $rowVendedor['nombreVendedor'];
                    }
    
                    $queryTotal = $this->db->connect()->prepare("SELECT*FROM HISTORICOVENTAS WHERE codigoVenta = :codigoVenta");
                    $queryTotal->execute(['codigoVenta'   => $row['codigoVenta']]);
                    $total = 0;
                    while ($rowTotal = $queryTotal->fetch()) {
                        $total += $rowTotal['subtotalRep'];
                    }
    
    
    
                    $item->codigoVenta = $row["codigoVenta"];
                    $item->idCliente   = $row["idCliente"];
                    $item->idVendedor  = $row["idVendedor"];
                    $item->tipoPago    = $row["tipoPago"];
                    $item->fecha       = $row["fechaVenta"];
                    $item->totalVenta  = $total;
                    array_push($items,$item);
                }
               
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }

    public function getAllFromVentasByVendedor($id){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENTAS WHERE idVendedor = :idVendedor ORDER BY codigoVenta DESC");
        try {
            $query->execute(['idVendedor'   => $id]);
            while ($row = $query->fetch()) {
                $item = new Ventas();
                $queryCliente = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoCliente = :codigoCliente");
                $queryCliente->execute(['codigoCliente'   => $row['idCliente']]);
                while ($rowCliente = $queryCliente->fetch()) {
                    $item->nombreCliente = $rowCliente['nombreCliente'];
                }

                $queryVendedor = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
                $queryVendedor->execute(['codigoVendedor'   => $row['idVendedor']]);
                while ($rowVendedor = $queryVendedor->fetch()) {
                    $item->nombreVendedor = $rowVendedor['nombreVendedor'];
                }

                $queryTotal = $this->db->connect()->prepare("SELECT*FROM HISTORICOVENTAS WHERE codigoVenta = :codigoVenta");
                $queryTotal->execute(['codigoVenta'   => $row['codigoVenta']]);
                $total = 0;
                while ($rowTotal = $queryTotal->fetch()) {
                    $total += $rowTotal['subtotalRep'];
                }



                $item->codigoVenta = $row["codigoVenta"];
                $item->idCliente   = $row["idCliente"];
                $item->idVendedor  = $row["idVendedor"];
                $item->tipoPago    = $row["tipoPago"];
                $item->fecha       = $row["fechaVenta"];
                $item->totalVenta  = $total;
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }







    public function getVentaByCodigo($id){
        $query = $this->db->connect()->prepare("SELECT*FROM VENTAS WHERE codigoVenta = :codigoVenta");
        $query->execute(['codigoVenta'   => $id]);
        while ($row = $query->fetch()) {
            $item = [
                'idCliente' => $row["idCliente"],
                'idVendedor' => $row["idVendedor"],
                'tipoPago' => $row["tipoPago"],
                'fechaVenta' => $row["fechaVenta"],
                'codigoVenta' => $row["codigoVenta"]
            ];
            }
            return $item;
    }

    public function getHistorico($id){
        $items = [];
        try {
            $query = $this->db->connect()->prepare("SELECT*FROM HISTORICOVENTAS WHERE codigoVenta = :codigoVenta");
            $query->execute(['codigoVenta' => $id]);
            while ($row = $query->fetch()) {
                $query2 = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE codigoRep = :codigoRep");
                $query2->execute(['codigoRep' => $row['codigoRep']]);
                $descripRep = '';
                while ($row2 = $query2->fetch()) {
                    $descripRep = $row2['descripRep'];
                }
                $item = new Repuesto();
                $item->codigoRep    = $row['codigoRep'];
                $item->descripRep   = $descripRep;
                $item->cantidadRep  = $row['cantidadRep'];
                $item->precioRep    = $row['precioRep'];
                $item->subtotal     = $row['subtotalRep'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }

    public function getAllFromVendedor(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR ORDER BY nombreVendedor");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Vendedor();
                $item->idVendedor        = $row["idVendedor"];
                $item->codigoVendedor    = $row["codigoVendedor"];
                $item->nombreVendedor    = $row["nombreVendedor"];
                $item->telefonoVendedor  = $row["telefonoVendedor"];
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }
    public function getVendedor($id){
        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE idVendedor = :idVendedor");
        $query->execute(['idVendedor'   => $id]);
        while ($row = $query->fetch()) {
            $item = $row["codigoVendedor"];
            }
            return $item;
    }

    public function getVendedorById($id){
        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
        $query->execute(['codigoVendedor'   => $id]);
        while ($row = $query->fetch()) {
            $item = $row["nombreVendedor"];
            }
            return $item;
    }
    public function getClienteById($id){
        $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoCliente = :codigoCliente");
        $query->execute(['codigoCliente'   => $id]);
        while ($row = $query->fetch()) {
            $item = [
                'nombreCliente' => $row["nombreCliente"],
                'codigoCliente' => $row["codigoCliente"],
                'telefonoCliente' => $row["telefonoCliente"],
                'direccionCliente' => $row["direccionCliente"],
            ];
            }
            return $item;
    }

    public function insertNota($datos){


        try {
            $query = $this->db->connect()->prepare('INSERT INTO VENTAS (codigoVenta, idCliente,	idVendedor,	tipoPago, fechaVenta) VALUES(:codigoVenta, :idCliente, :idVendedor, :tipoPago, :fechaVenta)');
            $query->execute(    ['codigoVenta' => $datos['codigoVenta'], 
                                'idCliente'    => $datos['idCliente'],
                                'idVendedor'   => $datos['idVendedor'],
                                'tipoPago'     => $datos['tipoPago'],
                                'fechaVenta'   => $datos['fechaVenta']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        
    }

    public function insertDatosNota($datos){

        try {
            $query = $this->db->connect()->prepare('INSERT INTO HISTORICOVENTAS (codigoVenta, codigoRep, cantidadRep, precioRep, subtotalRep) VALUES(:codigoVenta, :codigoRep, :cantidadRep, :precioRep, :subtotalRep)');
            $query->execute(    ['codigoVenta' => $datos['codigoVenta'], 
                                'codigoRep'    => $datos['codigoRep'],
                                'cantidadRep'   => $datos['cantidadRep'],
                                'precioRep'     => $datos['precioRep'],
                                'subtotalRep'   => $datos['subtotalRep']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
    }

    public function updateDatosRep($datos){
        $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE codigoRep = :codigoRep");
        $query->execute(['codigoRep'   => $datos['codigoRep']]);
        $cantidad = 0;
        while ($row = $query->fetch()) {
            $cantidad = $row['cantidadRep'] - $datos['cantidadRep'];
            }
        $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET cantidadRep = :cantidadRep WHERE codigoRep = :codigoRep");
            try {
                $queryUpdate->execute([
                    'cantidadRep'    => $cantidad,
                    'codigoRep'      => $datos['codigoRep']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        

    }

    
    public function insertPro($datos){
        
        try {
            $query = $this->db->connect()->prepare('INSERT INTO PROVEEDOR (codigoProveedor,nombreProveedor,telefonoProveedor) VALUES(:codigoProveedor, :nombreProveedor, :telefonoProveedor)');
            $query->execute(    ['codigoProveedor'   => $datos['codigoProveedor'], 
                                'nombreProveedor'    => $datos['nombreProveedor'], 
                                'telefonoProveedor'  => $datos['telefonoProveedor']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        
        
    }
    
    public function insertTipo($datos){
        
        try {
            $query = $this->db->connect()->prepare('INSERT INTO TIPOREPUESTO (descripTipo) VALUES(:descripTipo)');
            $query->execute(['descripTipo'   => $datos['descripTipo']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        
        
    }
    public function insertVen($datos){
        
        try {
            $query = $this->db->connect()->prepare('INSERT INTO VENDEDOR (codigoVendedor,nombreVendedor,telefonoVendedor) VALUES(:codigoVendedor, :nombreVendedor, :telefonoVendedor)');
            $query->execute(    ['codigoProveedor'   => $datos['codigoProveedor'], 
                                'nombreProveedor'    => $datos['nombreProveedor'], 
                                'telefonoProveedor'  => $datos['telefonoProveedor']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        
        
    }
    public function insertMarca($datos){
        
        try {
            $query = $this->db->connect()->prepare('INSERT INTO MARCAREPUESTO (descripMarca) VALUES(:descripMarca)');
            $query->execute(['descripMarca'   => $datos['descripMarca']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }   
        
    }
    
    public function getRepuestoById($param = NULL){

        $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoRep = :codigoRep");
        $id = $param;
        $item = false;
        try {
            $query->execute(['codigoRep' => $id]);
            while ($row = $query->fetch()) {
                $item = true;
            }
            return $item;
        } catch (PDOException $e) {
            return $item;
        }
    }

    public function getTipoByDesc($param = NULL){

        $query = $this->db->connect()->prepare("SELECT*FROM TIPOREPUESTO WHERE descripTipo = :descripTipo");
        $id = $param;
        $item = false;
        try {
            $query->execute(['descripTipo' => $id]);
            while ($row = $query->fetch()) {
                $item = true;
            }
            return $item;
        } catch (PDOException $e) {
            return $item;
        }
    }

    public function getMarcaByDesc($param = NULL){

        $query = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO WHERE descripMarca = :descripMarca");
        $id = $param;
        $item = false;
        try {
            $query->execute(['descripMarca' => $id]);
            while ($row = $query->fetch()) {
                $item = true;
            }
            return $item;
        } catch (PDOException $e) {
            return $item;
        }
    }


    public function getClienteByCodigo($param = NULL){

        $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE codigoCliente = :codigoCliente");
        $id = $param;
        $item = false;
        try {
            $query->execute(['codigoCliente' => $id]);
            while ($row = $query->fetch()) {
                $item = true;
            }
            return $item;
        } catch (PDOException $e) {
            return $item;
        }
    }

    public function getAllFromMarca(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Marca();
                $item->idMarca      = $row["idMarca"];
                $item->descripMarca = $row["descripMarca"];
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }
    public function getAllFromTipo(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM TIPOREPUESTO ORDER BY descripTipo");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Tipo();
                $item->idTipo      = $row["idTipo"];
                $item->descripTipo = $row["descripTipo"];
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }
    
}



?>