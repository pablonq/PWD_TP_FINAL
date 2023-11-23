<?php
class AbmUsuarioRol{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param)
    {
        $objUsuarioRol = null;
        $objRol = null;
        $objUsuario = null;
        if (array_key_exists('idrol', $param) && $param['idrol'] != null) {
            $objRol = new Rol();
            $objRol->setIdrol($param['idrol']);
            $objRol->cargar();
        }

        if (array_key_exists('idusuario', $param) && $param['idusuario'] != null) {
            $objUsuario = new Usuario();
            $objUsuario->setIdUsuario($param['idusuario']);
            $objUsuario->cargar();
        }

        $objUsuarioRol = new UsuarioRol();
        $objUsuarioRol->setear($objUsuario, $objRol);

        return $objUsuarioRol;
    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return UsuarioRol
     */
     private function cargarObjetoConClave($param)
     {
         $objUsuarioRol = null;
         $objRol = null;
         if (isset($param['idusuario']) && isset($param['idrol'])) {
            $objUsuarioRol = new UsuarioRol();
            $objUsuarioRol->setear($objUsuarioRol,$objRol);
         }
         return $objUsuarioRol;
     }

     /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
     private function seteadosCamposClaves($param)
     {
        $resp = false;
        if (isset($param['idusuario']) && isset($param['idrol']));

        $resp = true;
        return $resp;
     }

    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $unObj = $this->cargarObjeto($param);
        if ($unObj!=null && $unObj->insertar()){
            $resp = true;
        }
        return $resp;
        
    }


    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObj = $this->cargarObjeto($param);
            if ($unObj!=null && $unObj->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
 
    /** 
     * permite modificar un objeto
     * @param array $param
      *@return boolean
     */
    public function modificar($param){
        $resp = false;
       
        if ($this->seteadosCamposClaves($param)){
            $unObj = $this->cargarObjeto($param);
            
            if($unObj!=null and $unObj->modificar()){
                $resp = true;
            }
        }
        return $resp;
    } 
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " and idusuario = ".$param['idusuario'];
            }
            if (isset($param['idrol'])) {
                $where .= " and idrol = ".$param['idrol'];
            }
        }

        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }

/**
 * Espera como parámetro un array asociativo, donde sus claves indican
 * el tipo de cambio de rol que se hará y a qué usuario. Retorna booleano
 * indicando éxito o fracaso de la operación.
 * @param array $param
 * @return boolean
 */
public function cambiarRoles($param){

    $objUsuarioRol = new AbmUsuarioRol();
    
    // Acá guardo la operación de cambio de rol que será evaluada
    $accion = $param['rol'];
    $pudo = false;

    switch ($accion){
        case "alta1":
            $pudo = $objUsuarioRol->alta(['idusuario' => $param['idusuario'], 'idrol' => 1]);
            break;
        case "alta2":
            $pudo = $objUsuarioRol->alta(['idusuario' => $param['idusuario'], 'idrol' => 2]);
            break;
        case "alta3":
            $pudo = $objUsuarioRol->alta(['idusuario' => $param['idusuario'], 'idrol' => 3]);
            break;
        case "baja1":
            $pudo = $objUsuarioRol->baja(['idusuario' => $param['idusuario'], 'idrol' => 1]);
            break;
        case "baja2":
            $pudo = $objUsuarioRol->baja(['idusuario' => $param['idusuario'], 'idrol' => 2]);
            break;
        case "baja3":
            $pudo = $objUsuarioRol->baja(['idusuario' => $param['idusuario'], 'idrol' => 3]);
            break;
    }
    return $pudo;
}
}

?>