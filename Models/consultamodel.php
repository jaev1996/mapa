<?php
include_once 'Models/cliente.php';
include_once 'Models/marca.php';
include_once 'Models/repuesto.php';
include_once 'Models/proveedor.php';
include_once 'Models/tipo.php';
include_once 'Models/vendedor.php';


class ConsultaModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT*FROM MARCAREPUESTO ORDER BY descripMarca");
            while ($row = $query->fetch()) {
                $query2 = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE idMarca = :idMarca ORDER BY codigoRep");
                $query2->execute(['idMarca' => $row['idMarca']]);
                $marca = $row['descripMarca'];
                while ($row2 = $query2->fetch()) {
                    $item = new Repuesto();
                    $item->idRep        = $row2['idRep'];
                    $item->codigoRep    = $row2['codigoRep'];
                    $item->descripRep   = $row2['descripRep'];
                    $item->cantidadRep  = $row2['cantidadRep'];
                    $item->precioRep    = $row2['precioRep'];
                    $item->ubicRep      = $row2['ubicRep'];
                    $item->idMarca      = $marca;
                    $item->idTipo       = $row2['idTipo'];

                    array_push($items, $item);
                }
                
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }
    public function historico(){
        $items = [];
        $codigo[0] = "NADA";
        try {
            $query = $this->db->connect()->query("SELECT `codigoRep`,`cantidadRep` FROM `historicoventas` ORDER BY `codigoRep`");
            $item = new Repuesto();
            $i= 1;
            while ($row = $query->fetch()) {
                $codigo[$i] = $row["codigoRep"];
                if($codigo[$i-1] != $row["codigoRep"]){
                    array_push($items, $item);
                    unset($item);
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                    $queryDescrip = $this->db->connect()->prepare("SELECT `descripRep`,`idMarca`,`idTipo` FROM `repuestos` WHERE codigoRep = :codigoRep"); 
                    $queryDescrip->execute(['codigoRep' => $row['codigoRep']]);
                    $row2 = $queryDescrip->fetch();
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DE LA MARCA
                    $queryMarca = $this->db->connect()->prepare("SELECT `descripMarca` FROM `marcarepuesto` WHERE idMarca = :idMarca"); 
                    $queryMarca->execute(['idMarca' => $row2['idMarca']]);
                    $row3 = $queryMarca->fetch();
                    
                    //INSTANCIAMOS LA VARIABLE ITEM Y LE ASIGNAMOS LOS VALORES QUE SE DESEAN RETORNAR
                    $item = new Repuesto();
                    $item->codigoRep    = $row['codigoRep'];
                    $item->cantidadRep  = $row['cantidadRep'];
                    $item->descripRep   = $row2['descripRep'];
                    $item->idMarca      = $row3['descripMarca'];
                    $item->idTipo       = $row2['idTipo'];
                }else{
                    $item->cantidadRep  += $row['cantidadRep'];
                }
                $i++;
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }

    /*public function historicoPorFecha($desde, $hasta, $mostrar){
        $items = [];
        $codigo[0] = "NADA";
        $desdeFecha = $desde;
        $hastaFecha = $hasta;
        $idTipo = $mostrar;
        try {
            if ($idTipo != "All") {
                $query = $this->db->connect()->query("SELECT `codigoRep`,`descripRep`,`idMarca`,`idTipo` FROM `repuestos` WHERE idTipo = :idTipo ORDER BY `codigoRep`");
                $query->execute(['idTipo' => $idTipo]);
            }else {
                $query = $this->db->connect()->query("SELECT `codigoRep`,`descripRep`,`idMarca`,`idTipo` FROM `repuestos` ORDER BY `codigoRep`"); 
            }
            
            
            $item = new Repuesto();
            $i= 1;
            while ($row = $query->fetch()) {
                //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                $queryFecha = $this->db->connect()->prepare("SELECT `cantidadRep` FROM `historicoventas` WHERE fechaVenta >= :desdeFecha AND fechaVenta <= :hastaFecha AND codigoRep = :codigoRep"); 
                $queryFecha->execute(['desdeFecha' => $desdeFecha, 'hastaFecha' => $hastaFecha,  $row['hastaFecha']]);
                $rowFecha = $queryFecha->fetch();
               
                $codigo[$i] = $rowFecha["codigoRep"];
                if($codigo[$i-1] != $rowFecha["codigoRep"]){
                        array_push($items, $item);
                        unset($item);
                        $i++;
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                    $queryDescrip = $this->db->connect()->prepare("SELECT `descripRep`,`idMarca`,`idTipo` FROM `repuestos` WHERE codigoRep = :codigoRep"); 
                    $queryDescrip->execute(['codigoRep' => $rowFecha['codigoRep']]);
                    $row2 = $queryDescrip->fetch();
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DE LA MARCA
                    $queryMarca = $this->db->connect()->prepare("SELECT `descripMarca` FROM `marcarepuesto` WHERE idMarca = :idMarca"); 
                    $queryMarca->execute(['idMarca' => $row2['idMarca']]);
                    $row3 = $queryMarca->fetch();
                    
                    //INSTANCIAMOS LA VARIABLE ITEM Y LE ASIGNAMOS LOS VALORES QUE SE DESEAN RETORNAR
                    $item = new Repuesto();
                    $item->codigoRep    = $row['codigoRep'];
                    $item->cantidadRep  = $row['cantidadRep'];
                    $item->descripRep   = $row2['descripRep'];
                    $item->idMarca      = $row3['descripMarca'];
                    $item->idTipo       = $row2['idTipo'];
                }elseif($codigo[$i-1] == $row["codigoRep"]){
                    $item->cantidadRep  += $row['cantidadRep'];
                }
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }*/


    public function historicoPorFecha($desde, $hasta){
        $items = [];
        $codigo[0] = "NADA";
        $desdeFecha = $desde;
        $hastaFecha = $hasta;
        try {
            $query = $this->db->connect()->query("SELECT `codigoRep`,`cantidadRep`,`codigoVenta` FROM `historicoventas` ORDER BY `codigoRep`");
            $item = new Repuesto();
            $i= 1;
            while ($row = $query->fetch()) {
                //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                $queryFecha = $this->db->connect()->prepare("SELECT `fechaVenta` FROM `ventas` WHERE codigoVenta = :codigoVenta"); 
                $queryFecha->execute(['codigoVenta' => $row['codigoVenta']]);
                $rowFecha = $queryFecha->fetch();
                $status = false;
                $fechaRep = strtotime($rowFecha['fechaVenta']);
                if ($fechaRep >= $desdeFecha && $fechaRep <= $hastaFecha) {$status=true;}

                $codigo[$i] = $row["codigoRep"];
                if($codigo[$i-1] != $row["codigoRep"] && $status==true){
                        array_push($items, $item);
                        unset($item);
                        $i++;
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                    $queryDescrip = $this->db->connect()->prepare("SELECT `descripRep`,`idMarca`,`idTipo` FROM `repuestos` WHERE codigoRep = :codigoRep"); 
                    $queryDescrip->execute(['codigoRep' => $row['codigoRep']]);
                    $row2 = $queryDescrip->fetch();
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DE LA MARCA
                    $queryMarca = $this->db->connect()->prepare("SELECT `descripMarca` FROM `marcarepuesto` WHERE idMarca = :idMarca"); 
                    $queryMarca->execute(['idMarca' => $row2['idMarca']]);
                    $row3 = $queryMarca->fetch();
                    
                    //INSTANCIAMOS LA VARIABLE ITEM Y LE ASIGNAMOS LOS VALORES QUE SE DESEAN RETORNAR
                    $item = new Repuesto();
                    $item->codigoRep    = $row['codigoRep'];
                    $item->cantidadRep  = $row['cantidadRep'];
                    $item->descripRep   = $row2['descripRep'];
                    $item->idMarca      = $row3['descripMarca'];
                    $item->idTipo       = $row2['idTipo'];
                }elseif($codigo[$i-1] == $row["codigoRep"] && $status==true){
                    $item->cantidadRep  += $row['cantidadRep'];
                }
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }
    public function historicoPorCodigo($codigoRep){
        $items = [];
        $codRep = $codigoRep;
        $status = false;
        try {
            $query = $this->db->connect()->prepare("SELECT `cantidadRep`,`codigoVenta` FROM `historicoventas` WHERE codigoRep= :codigoRep");
            $query->execute(['codigoRep' => $codRep]);
            $item = new Repuesto();
            $i= 1;
            while ($row = $query->fetch()) {
                //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                
                if($status == false){
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                    $queryDescrip = $this->db->connect()->prepare("SELECT `descripRep`,`idMarca`,`idTipo` FROM `repuestos` WHERE codigoRep = :codigoRep"); 
                    $queryDescrip->execute(['codigoRep' => $codRep]);
                    $row2 = $queryDescrip->fetch();
                    
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DE LA MARCA
                    $queryMarca = $this->db->connect()->prepare("SELECT `descripMarca` FROM `marcarepuesto` WHERE idMarca = :idMarca"); 
                    $queryMarca->execute(['idMarca' => $row2['idMarca']]);
                    $row3 = $queryMarca->fetch();
                    
                    //INSTANCIAMOS LA VARIABLE ITEM Y LE ASIGNAMOS LOS VALORES QUE SE DESEAN RETORNAR
                    $item->codigoRep    = $codRep;
                    $item->cantidadRep  = $row['cantidadRep'];
                    $item->descripRep   = $row2['descripRep'];
                    $item->idMarca      = $row3['descripMarca'];
                    $item->idTipo       = $row2['idTipo'];
                    $status = true;
                }elseif($status == true){
                    $item->cantidadRep  += $row['cantidadRep'];
                }
            }
            array_push($items, $item);
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }
    public function historicoPorTipo($tipoRep){
        $items = [];
        $codigo[0] = "NADA";
        $tipoRep = $tipoRep;
        try {
            $queryTipo = $this->db->connect()->prepare("SELECT `codigoRep`,`descripRep`,`idMarca` FROM `repuestos` WHERE idTipo = :idTipo"); 
            $queryTipo->execute(['idTipo' => $tipoRep]);
            $item = new Repuesto();
            $i= 1;
            while ($row = $queryTipo->fetch()) {
                //CONSULTA PARA BUSCAR LA DESCRIPCION DEL REPUESTO Y EL ID DE LA MARCA
                $codigo[$i] = $row["codigoRep"];

                $queryHistorico = $this->db->connect()->prepare("SELECT `cantidadRep` FROM `historicoventas` WHERE codigoRep = :codigoRep");
                $queryHistorico->execute(['codigoRep' => $row['codigoRep']]);
                $cant = 0;
                while ($rowh = $queryHistorico->fetch()) {
                    $cant += $rowh['cantidadRep'];
                }
                if ($cant > 0) {
                    //CONSULTA PARA BUSCAR LA DESCRIPCION DE LA MARCA
                    $queryMarca = $this->db->connect()->prepare("SELECT `descripMarca` FROM `marcarepuesto` WHERE idMarca = :idMarca"); 
                    $queryMarca->execute(['idMarca' => $row['idMarca']]);
                    $row3 = $queryMarca->fetch();
                    $item = new Repuesto();
                    $item->codigoRep    = $row['codigoRep'];
                    $item->cantidadRep  = $cant;
                    $item->descripRep   = $row['descripRep'];
                    $item->idMarca      = $row3['descripMarca'];
                    $item->idTipo       = $tipoRep;
                    array_push($items, $item);
                    unset($item);
                }
            }
            
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getAllFromVendedor(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT*FROM VENDEDOR ORDER BY nombreVendedor ASC");
            while ($row = $query->fetch()) {

                $item = new Vendedor();
                $item->idVendedor        = $row['idVendedor'];
                $item->codigoVendedor    = $row['codigoVendedor'];
                $item->nombreVendedor   = $row['nombreVendedor'];
                $item->telefonoVendedor  = $row['telefonoVendedor'];

                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }
    public function getAllFromCliente(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT*FROM CLIENTE");
            while ($row = $query->fetch()) {

                $item = new Cliente();
                $item->idCliente        = $row['idCliente'];
                $item->codigoCliente        = $row['codigoCliente'];
                $item->nombreCliente    = $row['nombreCliente'];
                $item->telefonoCliente   = $row['telefonoCliente'];
                $item->direccionCliente  = $row['direccionCliente'];

                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
        
    }

    public function getAllFromClienteByVendedor($id, $nombre){
        $html="";

        $idVendedor = $id;
        $nombre = $nombre;
        $query = "";
        try {
            if($nombre === ""){
                $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE idVendedor = :id ORDER BY nombreCliente ASC");
                $query->execute(['id' => $idVendedor]);
            }elseif ($idVendedor == "0") {
                $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE nombreCliente LIKE :txt ORDER BY nombreCliente ASC");
                $query->bindValue(':txt', '%' . $nombre . '%', PDO::PARAM_STR);
                $query->execute();
            }else {
                $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE idVendedor = :id AND nombreCliente LIKE :txt ORDER BY nombreCliente ASC");
                $query->bindValue(':txt', '%' . $nombre . '%', PDO::PARAM_STR);
                $query->bindValue(':id', $idVendedor, PDO::PARAM_INT);
                $query->execute();
            }

            while ($row = $query->fetch()) {
                $html.='<tr>
                            <td>'.$row["nombreCliente"].'</td>
                            <td>'.$row["codigoCliente"].'</td>
                            <td>'.$row["direccionCliente"].'</td>
                            <td class="text-center"><a class="btn btn-sm btn-info" href="'.constant("URL").'actualizar/detallesCliente/'.$row["idCliente"].'">Ver Detalles</a>
                            </td>
                        </tr>';
            }
            return $html;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

            return [];
        }
        
    }

    public function getAllFromClienteByNombre($txt, $id){
        $html="";

        $nombre = $txt;
        $query = "";

        try {

            if($id == 0){
                $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE nombreCliente LIKE :txt ORDER BY nombreCliente ASC");
                $query->bindValue(':txt', '%' . $nombre . '%', PDO::PARAM_STR);
                $query->execute();
            }else {
                $query = $this->db->connect()->prepare("SELECT*FROM CLIENTE WHERE idVendedor = :id AND nombreCliente LIKE :txt ORDER BY nombreCliente ASC");
                $query->bindValue(':txt', '%' . $nombre . '%', PDO::PARAM_STR);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->execute();

            }
            

            while ($row = $query->fetch()) {
                $html.='<tr>
                            <td>'.$row["nombreCliente"].'</td>
                            <td>'.$row["codigoCliente"].'</td>
                            <td>'.$row["direccionCliente"].'</td>
                            <td class="text-center"><a class="btn btn-sm btn-info" href="'.constant("URL").'actualizar/detallesCliente/'.$row["idCliente"].'">Ver Detalles</a>
                            </td>
                        </tr>';
            }
            return $html;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

            return [];
        }
        
    }

    public function getTipo(){
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT*FROM TIPOREPUESTO ORDER BY descripTipo");
            while ($row = $query->fetch()) {

                $item = new Tipo();
                $item->idTipo        = $row['idTipo'];
                $item->descripTipo   = $row['descripTipo'];
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

    public function getRepuestoForTipo($id){
        $items = [];
        try {
            $query = $this->db->connect()->prepare("SELECT*FROM REPUESTOS WHERE idTipo = :idTipo ORDER BY codigoRep");
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
                $item->ubicRep      = $row['ubicRep'];
                $item->idMarca      = $marca;
                $item->idTipo       = $row['idTipo'];

                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
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
                $resp->idRep        = $row['idRep'];
                $resp->codigoRep    = $row['codigoRep'];
                $resp->descripRep   = $row['descripRep'];
                $resp->cantidadRep  = $row['cantidadRep'];
                $resp->precioRep    = $row['precioRep'];
                $resp->ubicRep      = $row['ubicRep'];
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

    public function getRepuestoByDescAndCod($txtbusca){
        
        $html="";
        $error = "ERROR EN LA CONSULTA";
        try {
            $query = $this->db->connect()->prepare("SELECT descripRep, codigoRep, cantidadRep, precioRep, ubicRep FROM REPUESTOS WHERE descripRep LIKE :txtbusca OR codigoRep LIKE :txtbuscar ORDER BY cantidadRep DESC");
            $query->bindValue(':txtbusca', '%' . $txtbusca . '%', PDO::PARAM_STR);
            $query->bindValue(':txtbuscar', '%' . $txtbusca . '%', PDO::PARAM_STR);
            $query->execute();
            while ($row = $query->fetch()) {
                $html.= "<tr><td>".$row["codigoRep"]."</td> <td>".$row["descripRep"]."</td> <td>".$row["cantidadRep"]."</td> <td>".$row["precioRep"]."</td> <td>".$row["ubicRep"]."</td><td><a class='btn btn-sm btn-info mt-2 mb-2' href='".constant('URL')."actualizar/actualizarep/".$row["codigoRep"]."' target='_blank'>Editar</a></td></tr>";
            }
            return $html;
        } catch (PDOException $e) {
            return $error;
        }
        
    }


    
}


?>