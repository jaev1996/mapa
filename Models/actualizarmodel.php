<?php
require 'Models/marca.php';
require 'Models/tipo.php';
require 'Models/repuesto.php';
require 'Models/historicoventas.php';
require 'Models/notas.php';
require 'Models/cliente.php';
require 'Models/vendedor.php';
class ActualizarModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }

    public function updateRep($datos){

        $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET codigoRep = :codigoRep, descripRep = :descripRep, cantidadRep= :cantidadRep, precioRep = :precioRep, idMarca = :idMarca, idTipo = :idTipo, ubicRep = :ubicRep WHERE idRep = :idRep");
            try {
                $queryUpdate->execute([
                    'idRep'         => $datos['idRep'],
                    'codigoRep'     => $datos['codigoRep'],
                    'descripRep'    => $datos['descripRep'],
                    'cantidadRep'   => $datos['cantidadRep'],
                    'idMarca'       => $datos['idMarca'],
                    'idTipo'        => $datos['idTipo'],
                    'ubicRep'       => $datos['ubicRep'],
                    'precioRep'     => $datos['precioRep']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        
    }

    public function updateRepMassive($datos){

        $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET cantidadRep= :cantidadRep, precioRep = :precioRep, ubicRep = :ubicRep WHERE codigoRep = :codigoRep");
            try {
                $queryUpdate->execute([
                    'codigoRep'     => $datos['codigoRep'],
                    'ubicRep'       => $datos['ubicRep'],
                    'cantidadRep'   => $datos['cantidadRep'],
                    'precioRep'     => $datos['precioRep']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        
    }

    public function updateCli($datos){

        $queryUpdate = $this->db->connect()->prepare("UPDATE CLIENTE SET codigoCliente = :codigoCliente, nombreCliente = :nombreCliente, telefonoCliente = :telefonoCliente, direccionCliente = :direccionCliente WHERE idCliente = :idCliente");
            try {
                $queryUpdate->execute([
                    'codigoCliente'    => $datos['codigoCliente'],
                    'nombreCliente'    => $datos['nombreCliente'],
                    'telefonoCliente'  => $datos['telefonoCliente'],
                    'direccionCliente' => $datos['direccionCliente'],
                    'idCliente'        => $datos['idCliente']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        				

    }

    public function updateVend($datos){
    
        $queryUpdate = $this->db->connect()->prepare("UPDATE VENDEDOR SET codigoVendedor = :codigoVendedor, nombreVendedor = :nombreVendedor, telefonoVendedor = :telefonoVendedor WHERE idVendedor = :idVendedor");
            try {
                $queryUpdate->execute([
                    'codigoVendedor'    => $datos['codigoVendedor'],
                    'nombreVendedor'    => $datos['nombreVendedor'],
                    'telefonoVendedor'  => $datos['telefonoVendedor'],
                    'idVendedor'        => $datos['idVendedor']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        				

    }

    
    public function updateTipo($datos){
        
        $queryUpdate = $this->db->connect()->prepare("UPDATE TIPOREPUESTO SET descripTipo = :descripTipo WHERE idTipo = :idTipo");
            try {
                $queryUpdate->execute([
                    'idTipo'    => $datos['idTipo'],
                    'descripTipo'    => $datos['descripTipo']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            } 
    }
    
    public function updateMarca($datos){
        
        $queryUpdate = $this->db->connect()->prepare("UPDATE MARCAREPUESTO SET descripMarca = :descripMarca WHERE idMarca = :idMarca");
            try {
                $queryUpdate->execute([
                    'idMarca'    => $datos['idMarca'],
                    'descripMarca'    => $datos['descripMarca']
                ]);
                return true;
            } catch (PDOException $e) {
                return false;
            } 
        
    }
    
    public function getRepuestoById($param = NULL){

        $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE codigoRep = :codigoRep");
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

    public function getVendedorByCodigo($param = NULL){

        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE codigoVendedor = :codigoVendedor");
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
    public function getRepuestoForTipo($id){
        $items = [];
        try {
            $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE idTipo = :idTipo");
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
                $item->ubicRep      = $row['ubicRep'];
                $item->idTipo       = $row['idTipo'];
                array_push($items, $item);
                
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }

    public function getRepuestoForTipo2($id){
        $items = [];
        try {
            $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE idTipo = :idTipo");
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
                $item->ubicRep      = $row['ubicRep'];
                $item->idTipo       = $row['idTipo'];
                array_push($items, $item);
                
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
            $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE codigoRep = :codigoRep");
            $query->execute(['codigoRep' => $id]);
            while ($row = $query->fetch()) {
                $query2 = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO WHERE idMarca = :idMarca");
                $query2->execute(['idMarca' => $row['idMarca']]);
                $marca = '';
                while ($row2 = $query2->fetch()) {
                    $marca = $row2['descripMarca'];
                }
                $query3 = $this->db->connect()->prepare("SELECT*FROM TIPOREPUESTO WHERE idTipo = :idTipo");
                $query3->execute(['idTipo' => $row['idTipo']]);
                $tipo = '';
                while ($row3 = $query3->fetch()) {
                    $tipo = $row3['descripTipo'];
                }
                $resp->idRep        = $row['idRep'];
                $resp->codigoRep    = $row['codigoRep'];
                $resp->descripRep   = $row['descripRep'];
                $resp->cantidadRep  = $row['cantidadRep'];
                $resp->precioRep    = $row['precioRep'];
                $resp->idMarca      = $marca;
                $resp->idTipo       = $row['idTipo'];
                $resp->ubicRep      = $row['ubicRep'];
                $resp->descripTipo  = $tipo;
                $resp->descripMarca = $row['idMarca'];

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

    public function getCodigoRepuesto($id, $codigo){
        
        $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS");
        try {
            $query->execute();
            while ($row = $query->fetch()) {

                if ($row['codigoRep'] == $codigo && $row['idRep'] != $id) {                 
                        return false;
                }
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCodigoVendedor($id, $codigo){
        
        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR");
        try {
            $query->execute();
            while ($row = $query->fetch()) {

                if ($row['codigoVendedor'] == $codigo && $row['idVendedor'] != $id) {                 
                        return false;
                }
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getDescripMarca($id, $descrip){
        
        $query = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO");
        try {
            $query->execute();
            while ($row = $query->fetch()) {

                if ($row['descripMarca'] == $descrip && $row['idMarca'] != $id) {                 
                        return false;
                }
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getDescripTipo($id, $descrip){
        
        $query = $this->db->connect()->prepare("SELECT*FROM TIPOREPUESTO");
        try {
            $query->execute();
            while ($row = $query->fetch()) {

                if ($row['descripTipo'] == $descrip && $row['idTipo'] != $id) {                 
                        return false;
                }
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllFromMarca(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM MARCAREPUESTO ORDER BY descripMarca");
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

    public function getVendedorById($id){
        $item = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR WHERE idVendedor = :idVendedor");
        try {
            $query->execute(['idVendedor' => $id]);
            while ($row = $query->fetch()) {
                $item = [
                    'idVendedor'        => $row['idVendedor'],
                    'nombreVendedor'    => $row['nombreVendedor'],
                    'codigoVendedor'    => $row['codigoVendedor'],
                    'telefonoVendedor'  => $row['telefonoVendedor']
                ];
            }
            return $item;
        } catch (PDOException $e) {
            return $item;
        }
    }
    public function getAllFromVendedor(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM VENDEDOR ORDER BY nombreVendedor ASC");
        try {
            $query->execute();
            while ($row = $query->fetch()) {
                $item = new Vendedor();
                $item->idVendedor      = $row["idVendedor"];
                $item->nombreVendedor = $row["nombreVendedor"];
                array_push($items,$item);
            }
            return $items;
        } catch (PDOException $e) {
            return $items;
        }
    }
    public function getClienteById($id){
        $item = [];
        $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE idCliente = :idCliente");
        try {
            $query->execute(['idCliente' => $id]);
            while ($row = $query->fetch()) {
                $query2 = $this->db->connect()->prepare("SELECT nombreVendedor FROM VENDEDOR WHERE idVendedor = :idVendedor");
                $query2->execute(['idVendedor' => $row['idVendedor']]);

                $result = $query2->fetch();
                
                $item = [
                    'idCliente'        => $row['idCliente'],
                    'nombreCliente'    => $row['nombreCliente'],
                    'codigoCliente'    => $row['codigoCliente'],
                    'direccionCliente' => $row['direccionCliente'],
                    'idVendedor'       => $row['idVendedor'],
                    'nombreVendedor'   => $result['nombreVendedor'],
                    'telefonoCliente'  => $row['telefonoCliente']
                ];
            }
            return $item;
        } catch (PDOException $e) {
            return $item;
        }
    }

        /* public function actualizarprecios(){
        $i=0;
        $query = $this->db->connect()->prepare("SELECT precioRep, idRep, idTipo FROM REPUESTOS");
            $query->execute();
            while ($row = $query->fetch()) {
                    $newPrecio = round($row["precioRep"], 2);
                    $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET precioRep = :precioRep WHERE idRep = :idRep");
                    
                        $queryUpdate->execute([
                            'idRep'         => $row['idRep'],
                            'precioRep'     => $newPrecio
                        ]);
                    $i++;
                
            }
            
        $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET precioRep = :precioRep WHERE idRep = :idRep");
            try {
                $queryUpdate->execute([]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
            return $i;
        
    }*/

    /*public function actualizarpastillas(){
        $i=0;
        $query = $this->db->connect()->prepare("SELECT precioRep, idRep, descripRep FROM REPUESTOS WHERE idTipo = :idTipo AND idMarca = :idMarca");
            $query->execute(['idTipo'       => 25,
                            'idMarca'       => 15]);
            $items = [];
            while ($row = $query->fetch()) {
                $newPrecio = $row["precioRep"] + ($row["precioRep"] * 0.22);
                $newPrecio = round($newPrecio, 2);
                $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET precioRep = :precioRep WHERE idRep = :idRep");
                    
                $queryUpdate->execute([
                            'idRep'         => $row['idRep'],
                            'precioRep'     => $newPrecio
                ]);
                $i++;
                
            }
        
    }
    */
    /*public function actualizargomas(){
        $i=0;
        $query = $this->db->connect()->prepare("SELECT precioRep, idRep, descripRep FROM REPUESTOS WHERE idTipo = :idTipo");
            $query->execute(['idTipo'       => 31]);
            $items = [];
            while ($row = $query->fetch()) {
                $newPrecio = $row["precioRep"] + ($row["precioRep"] * 0.12);
                $newPrecio = round($newPrecio, 2);
                $queryUpdate = $this->db->connect()->prepare("UPDATE REPUESTOS SET precioRep = :precioRep WHERE idRep = :idRep");
                    
                $queryUpdate->execute([
                            'idRep'         => $row['idRep'],
                            'precioRep'     => $newPrecio
                ]);
                $i++;
                
            }
        
    }*/
    
}



?>