<?php
class AbmCompraEstado{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idcompraestado',$param) and array_key_exists('idcompra',$param)     
          and array_key_exists('idcompraestadotipo',$param) and array_key_exists('cefechaini',$param) and array_key_exists('cefechafin',$param)){
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], $param['idcompra'],$param['idcompraestadotipo'],$param['cefechaini'],$param['cefechafin']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if(isset($param['idcompraestado']) ){
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'],null,null,null,null);
        }
        return $obj;
    }


     /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $unObjCompraEstado = $this->cargarObjeto($param);
        if ($unObjCompraEstado!=null && $unObjCompraEstado->insertar()){
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
            $unObjCompraEstado = $this->cargarObjeto($param);
            if ($unObjCompraEstado!=null && $unObjCompraEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificar($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraEstado = $this->cargarObjeto($param);
            if($unObjCompraEstado!=null && $unObjCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
   /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>null){

            if(isset($param['idcompraestado'])){
                $where.=" and idcompraestado ='".$param['idcompraestado']."'";
            }
            if(isset($param['idcompra'])){
                $where.=" and idcompra ='".$param['idcompra']."'";
            }
                
            if(isset($param['idcompraestadotipo'])){
                $where.=" and idcompraestadotipo ='".$param['idcompraestadotipo']."'";
            }
                
            if(isset($param['cefechaini'])){
                $where.=" and cefechaini ='".$param['cefechaini']."'";
            }
                
            if(isset($param['cefechafin'])){

                if($param['cefechafin'] != "NULL"){
                    $where.=" and cefechafin = ".$param['cefechafin'];
                } else {
                    $where.=" and cefechafin is NULL";
                }
                
            }
            
        }
        $obj = new CompraEstado();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
    public function verificarEstado($param)
    {
        $objCompraEstado=null;
        $arreCompraEstado=$this->buscar($param);
        if(count($arreCompraEstado)==1)
        {
            $objCompraEstado=$arreCompraEstado[0];
        }
        return $objCompraEstado;
    }
    public function cambiarEstado($datos)
    {
        $hoy = date("Y-m-d H:i:s");
        $datos["cefechaini"]=$hoy;
        $datos["cefechafin"]="null";
        if($datos["idcompraestadotipo"]==4)
        {
          $objCtrlCI=new ABMcompraitem();
          $data["idcompra"]=$datos["idcompra"];
          $objCtrlCI->devolverProductos($data);
        }else{
          $param["idcompraestado"]=$datos["idcompraestado"];  
           //agregamos el nuevo estado 
          $seagrego = $this->alta($datos); 
           //para actualizar asignamos la fecha fin del estado anterior 
           //print_r($seactualizo);
          $seactualizo = $this->modificar($param);     
             
          
       }       
       $resultado["seagrego"]=$seagrego;
       $resultado["seactualizo"]=$seactualizo;

       return $resultado;

    }
}

?>