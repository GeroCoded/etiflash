<!--    <div class="float-left mt-3 ml-3 d-none" id="show">
        <a  class="btn btn-primary text-white" ><i class="fas fa-arrow-right mt-2"></i></a>
    </div>
-->
    <div class="pl-3 bg-dark pr-0"  id="over-sidebar" style="">
            <!-- Sidebar Control Panel -->
            <ul class="nav flex-column p-0" id="sidebar">

                <div class="row mr-0">
                    <div class="col-9">
                        <span class="item-text">
                            <h3 class="text-white mt-3 ml-3">Panel</h3>
                        </span>
                    </div>
                    <div class="col-3 align-content-end mt-3">
                        <div class="text-center" id="dismiss">
                            <i class="fas fa-arrow-left mt-2" id="dismiss-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="row mr-0">
                    <div class="col-3">
                        <div id="logout-div">
                            <a href="../includes/cerrarSesion.php"><i class="fas fa-power-off fa-lg" id="logout"></i></a>
                        </div>
                    </div>
                    <div class="col-9 px-0">
                        <h6 class="text-muted mt-3 ml-3"><span id="datos-usuario" data-column="<?php echo $_SESSION['idAdmin']; ?>"><?php echo $_SESSION['nombre'] ?></span></h6>
                    </div>
                </div>
                
                <!-- DASHBOARD -->
                <li class="nav-item mt-5">
                    <a class="nav-link" href="#">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        <span class="item-text">Dashboard</span>
                    </a>
                </li>


                <!-- PEDIDOS -->
                <li class="nav-item">

                    <!-- PEDIDOS HEADER -->
                    <a class="nav-link pr-2" data-toggle="collapse" href="#pedidos-opciones" role="button" aria-expanded="false" aria-controls="pedidos-opciones">

                        <i class="fas fa-dollar-sign mr-2 mx-1"></i>
                        <span class="item-text">Pedidos</span>
                        <i class="fas fa-caret-down float-right mt-1"></i>

                    </a>

                    <!-- PEDIDOS COLLAPSE -->
                    <div class="collapse" id="pedidos-opciones">

                        <!-- PEDIDOS <UL> MENU -->
                        <div class="list-group" id="pedidosSubmenu">

                            <!-- Gráficas -->    
<!--                            <a class="list-group-item list-group-item-action active" id="pedidos-graficas" href="#">
                                <i class="fas fa-chart-pie mr-2"></i>
                                Gráficas
                            </a>
-->
                            <!-- Lista -->    
                            <a class="list-group-item list-group-item-action" id="pedidos-lista" href="#">
                                <i class="fas fa-list-ul mr-2"></i>
                                <span class="item-text">Lista</span>
                            </a>

                            <!-- Reporte -->    
<!--                            <a class="list-group-item list-group-item-action" href="#">
                                <i class="fas fa-file-pdf mr-2"></i>
                                <span class="item-text">Reporte</span>
                            </a>
-->
                        </div> <!-- FIN PEDIDOS <UL> MENU -->
                    </div> <!-- FIN PEDIDOS COLLAPSE -->

                </li> <!-- FIN PEDIDOS -->


                <!-- CLIENTES -->
                <li class="nav-item">

                    <!-- CLIENTES HEADER -->
                    <a class="nav-link pr-2" data-toggle="collapse" href="#clientes-opciones" role="button" aria-expanded="false" aria-controls="clientes-opciones">

                        <i class="fas fa-user mr-2"></i>
                        <span class="item-text">Clientes</span>
                        <i class="fas fa-caret-down float-right mt-1"></i>

                    </a>



                    <!-- CLIENTES COLLAPSE -->
                    <div class="collapse" id="clientes-opciones">

                        <!-- CLIENTES <UL> MENU -->
                        <div class="list-group" id="clientesSubmenu">

                            <!-- Gráficas -->    
<!--                            <a class="list-group-item list-group-item-action " id="clientes-graficas" href="#">
                                <i class="fas fa-chart-pie mr-2"></i>
                                Gráficas
                            </a>
-->
                            <!-- Lista -->    
                            <a class="list-group-item list-group-item-action" id="clientes-lista" href="#">
                                <i class="fas fa-list-ul mr-2"></i>
                                <span class="item-text">Lista</span>
                            </a>

                            <!-- Reporte -->    
<!--                            <a class="list-group-item list-group-item-action" href="#">
                                <i class="fas fa-file-pdf mr-2"></i>
                                <span class="item-text">Reporte</span>
                            </a>
-->
                        </div> <!-- FIN CLIENTES <UL> MENU -->

                    </div> <!-- FIN CLIENTES COLLAPSE -->

                </li> <!-- FIN CLIENTES -->


                <!-- VENDEDORES -->
                <li class="nav-item">

                    <!-- VENDEDORES HEADER -->
                    <a class="nav-link pr-2" data-toggle="collapse" href="#vendedores-opciones" role="button" aria-expanded="false" aria-controls="vendedores-opciones">

                        <i class="fas fa-hand-holding-heart mr-2"></i>
                        <span class="item-text">Vendedores</span>
                        <i class="fas fa-caret-down float-right mt-1"></i>

                    </a>

                    <!-- VENDEDORES COLLAPSE -->
                    <div class="collapse" id="vendedores-opciones">

                        <!-- VENDEDORES <UL> MENU -->
                        <div class="list-group" id="vendedoresSubmenu">

                            <!-- Gráficas -->    
<!--                            <a class="list-group-item list-group-item-action" id="vendedores-graficas" href="#">
                                <i class="fas fa-chart-pie mr-2"></i>
                                Gráficas
                            </a>
-->
                            <!-- Lista -->    
                            <a class="list-group-item list-group-item-action" id="vendedores-lista" href="#">
                                <i class="fas fa-list-ul mr-2"></i>
                                <span class="item-text">Lista</span>
                            </a>

                            <!-- Reporte -->    
<!--                            <a class="list-group-item list-group-item-action" href="#">
                                <i class="fas fa-file-pdf mr-2"></i>
                                <span class="item-text">Reporte</span>
                            </a>
-->
                        </div> <!-- FIN VENDEDORES <UL> MENU -->

                    </div> <!-- FIN VENDEDORES COLLAPSE -->

                </li> <!-- FIN VENDEDORES -->



                <!-- ADMNINISTRADORES -->
                <li class="nav-item pb-5">

                    <!-- ADMNINISTRADORES HEADER -->
                    <a class="nav-link pr-2" data-toggle="collapse" href="#administradores-opciones" role="button" aria-expanded="false" aria-controls="administradores-opciones">

                        <i class="fas fa-key mr-2 "></i>
                        <span class="item-text">Administradores</span>
                        <i class="fas fa-caret-down float-right mt-1"></i>

                    </a>

                    <!-- ADMNINISTRADORES COLLAPSE -->
                    <div class="collapse" id="administradores-opciones">

                        <!-- ADMNINISTRADORES <UL> MENU -->
                        <div class="list-group" id="administradoresSubmenu">

                            <!-- Gráficas -->    
<!--                            <a class="list-group-item list-group-item-action" id="administradores-graficas" href="#">
                                <i class="fas fa-chart-pie mr-2"></i>
                                Gráficas
                            </a>
-->
                            <!-- Lista -->    
                            <a class="list-group-item list-group-item-action" id="administradores-lista" href="#">
                                <i class="fas fa-list-ul mr-2"></i>
                                <span class="item-text">Lista</span>
                            </a>

                            <!-- Reporte -->    
<!--                            <a class="list-group-item list-group-item-action" href="#">
                                <i class="fas fa-file-pdf mr-2"></i>
                                <span class="item-text">Reporte</span>
                            </a>
-->
                        </div> <!-- FIN ADMNINISTRADORES <UL> MENU -->

                    </div> <!-- FIN ADMNINISTRADORES COLLAPSE -->

                </li> <!-- FIN ADMNINISTRADORES -->

            </ul>
        </div>