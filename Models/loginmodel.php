<?php
include_once 'Models/usuario.php';
class LoginModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }

    public function getData(){
        try {
            $query = $this->db->connect()->query("SELECT*FROM usuarios LIMIT 1");
            while ($row = $query->fetch()) {
                $item = new Usuario();

                $item->idUser    = $row['id'];
                $item->nombreUser      = $row['nombre'];
                $item->apellidoUser    = $row['apellido'];
                $item->usuario          = $row['usuario'];
                $item->clave  = $row['clave'];
                $item->cedula  = $row['cedula'];
            }
            return $item;
        } catch (PDOException $e) {
            return [];
        }
        
    }

    public function updateUserData($item){
        $query = $this->db->connect()->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, cedula = :cedula WHERE id = :id");
        try {
            $query->execute([
                'id'          => $item['id'],
                'nombre'      => $item['nombre'],
                'apellido'    => $item['apellido'],
                'cedula'      => $item['cedula']
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateDataAccess($item){

        $query = $this->db->connect()->prepare("UPDATE usuarios SET usuario = :usuario, clave = :clave WHERE id = :id");
        try {
            $query->execute([
                'id'          => $item['id'],
                'usuario'      => $item['usuario'],
                'clave'    => $item['clave']]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function confirmarClave($id, $clave){
        $query = $this->db->connect()->prepare("SELECT*FROM usuarios WHERE id = :id");
        try {
            $query->execute(['id' => $id]);
            while ($row = $query->fetch()) {
                $claveAct    = $row['clave'];
            }
            if($claveAct == $clave){
                return true;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }    
    }

    public function getDataLogin($user, $clave){
        $item = new Usuario();

        $query = $this->db->connect()->prepare("SELECT*FROM usuarios WHERE usuario = :usuario");

        try {
            $query->execute(['usuario' => $user]);
            while ($row = $query->fetch()) {
                $item->usuario   = $row['usuario'];
                $item->clave    = $row['clave'];
                $item->nombreUser    = $row['nombre'];
                $item->apellidoUser    = $row['apellido'];
            }
            if($item->clave == $clave){
                return $item;
            }else{
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }    
    }

    


}



?>