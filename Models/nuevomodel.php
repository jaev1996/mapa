<?php
require 'Models/vendedor.php';
require 'Models/marca.php';
require 'Models/tipo.php';
class NuevoModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }

    public function insertRep($datos){


        try {
            $query = $this->db->connect()->prepare('INSERT INTO REPUESTOS (codigoRep, descripRep, cantidadRep, precioRep, idMarca, idTipo, ubicRep) VALUES(:codigoRep, :descripRep, :cantidadRep, :precioRep, :idMarca, :idTipo, :ubicRep)');
            $query->execute(    ['codigoRep'   => $datos['codigoRep'], 
                                'descripRep'   => $datos['descripRep'],
                                'cantidadRep'  => $datos['cantidadRep'],
                                'precioRep'    => $datos['precioRep'],
                                'idMarca'      => $datos['idMarca'],
                                'ubicRep'      => $datos['ubicRep'],
                                'idTipo'       => $datos['idTipo']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        
    }

    public function insertCli($datos){

        try {
            $query = $this->db->connect()->prepare('INSERT INTO CLIENTE (codigoCliente,nombreCliente,telefonoCliente,direccionCliente,idVendedor) VALUES(:codigoCliente, :nombreCliente, :telefonoCliente, :direccionCliente, :idVendedor)');
            $query->execute(    ['codigoCliente'   => $datos['codigoCliente'], 
                                'nombreCliente'    => $datos['nombreCliente'], 
                                'direccionCliente' => $datos['direccionCliente'], 
                                'idVendedor'       => $datos['idVendedor'], 
                                'telefonoCliente'  => $datos['telefonoCliente']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
            return false;
        }
        				

    }

    public function insertVend($datos){

        try {
            $query = $this->db->connect()->prepare('INSERT INTO VENDEDOR (codigoVendedor,nombreVendedor,telefonoVendedor) VALUES(:codigoVendedor, :nombreVendedor, :telefonoVendedor)');
            $query->execute(    ['codigoVendedor'   => $datos['codigoVendedor'], 
                                'nombreVendedor'    => $datos['nombreVendedor'], 
                                'telefonoVendedor'  => $datos['telefonoVendedor']]);
            return true;
        } catch (PDOException $e) {
            //echo $e->getMessage();
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

    public function getAllFromTipo(){
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM TIPOREPUESTO");
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