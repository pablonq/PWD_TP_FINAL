<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="items">
            <?php
            include_once "../../../configuracion.php";
            $datos = data_submitted();
            $objCntrlCI = new AbmCompraItem();
            $suma = 0;

            $items = $objCntrlCI->buscar($datos);
            
            if (count($items) > 0) {
                foreach ($items as $item) {
                 ?>
                  <div class="product">
                    <div class="row">
                        <div class="col-md-2 d-flex">
                            <img src="<?php echo $item->getObjProducto()->getImagenProducto(); ?>" class="img-fluid mx-auto d-flex image">
                        </div>
                        <div class="col-md-8">
                            <div class="info">
                                <div class="row">
                                    <div class="col-md-5 product-name">
                                        <div class="product-name">
                                            
                                            <div class="product-info">
                                                <div>Marca: 
                                                    <span class="value"><?php echo $item->getObjProducto()->getPronombre(); ?></span>
                                                </div>
                                                <div>Cantidad: 
                                                    <span class="value"><?php echo $item->getCicantidad(); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                        
                                    <div class="col-md-2 price">
                                        <span>$ <?php echo $item->getObjProducto()->getProDetalle(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <?php
                 $suma = $suma + $item->getObjProducto()->getProDetalle() * $item->getCiCantidad();
                }
            } 
            ?>
            <div class="summary">
                <h2 class="text-start fs-4" class="">Resumen</h2>
                <!--<label>ID Compra:</label>-->
                <p class="text-start fs-6">ID Compra:&nbsp;<?php echo $datos["idcompra"]; ?></br>
                ID Estado compra:&nbsp;<?php echo $datos["idcompraestado"]; ?></p>
                <div class="summary-item">
                    <p class="text-start fs-4">Total: <span class="text-start text-success fs-4">$<?php echo $suma; ?></span></p>
                </div>
                <?php

                $param["idcompra"] = $datos["idcompra"];
                $param["idcompraestadotipo"] = 2;
                $objCntrlCE = new AbmCompraEstado();
                $objEstado1 = $objCntrlCE->verificarEstado($param);
                $param2["idcompra"] = $datos["idcompra"];
                $param2["idcompraestadotipo"] = 3;
                $objEstado2 = $objCntrlCE->verificarEstado($param2);
                $param3["idcompra"] = $datos["idcompra"];
                $param3["idcompraestadotipo"] = 4;
                $objEstado3 = $objCntrlCE->verificarEstado($param3);
                if ($objEstado1==null&&$objEstado3==null) {
                ?>
                    <button type="button" class="btn btn-warning" onclick="cambiarEstado('La compra fue aceptada!',2,<?php echo $datos['idcompra']; ?>,<?php echo $datos['idcompraestado']; ?>,<?php echo $datos['idusuario']; ?>)">Aceptar pedido</button>
                <?php
                }
                ?>
                <?php
            
                if ($objEstado2==null&&$objEstado3==null) {
                ?>
                    <button type="button" class="btn btn-success" onclick="cambiarEstado('La compra fue enviada!',3,<?php echo $datos['idcompra']; ?>,<?php echo $datos['idcompraestado']; ?>,<?php echo $datos['idusuario']; ?>)">Enviar pedido</button>
                <?php
                }
                ?>
                <?php
         
                if ($objEstado3==null) {
                ?>
                    <button type="button" class="btn btn-danger" onclick="cambiarEstado('La compra fue cancelada!',4,<?php echo $datos['idcompra']; ?>,<?php echo $datos['idcompraestado']; ?>,<?php echo $datos['idusuario']; ?>)">Cancelar pedido</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>



    <?php ?>