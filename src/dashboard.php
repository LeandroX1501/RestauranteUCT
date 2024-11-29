<?php
session_start();
include_once "includes/header.php";
include "../conexion.php";

// Consultas para obtener los datos
$query1 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM salas WHERE estado = 1");
$totalSalas = mysqli_fetch_assoc($query1);

$query2 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM platos WHERE estado = 1");
$totalPlatos = mysqli_fetch_assoc($query2);

$query3 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM usuarios WHERE estado = 1");
$totalUsuarios = mysqli_fetch_assoc($query3);

$query4 = mysqli_query($conexion, "SELECT COUNT(id) AS total FROM pedidos WHERE estado = 1");
$totalPedidos = mysqli_fetch_assoc($query4);

// Consulta para obtener todos los platos disponibles
$queryPlatos = mysqli_query($conexion, "SELECT * FROM platos WHERE estado = 1");
?>

<div class="card">
    <div class="card-header text-center">
        Panel
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalPlatos['total']; ?></h3>
                        <p>Platos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="platos.php" class="small-box-footer">Ir a Platos <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $totalSalas['total']; ?></h3>
                        <p>Salas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="salas.php" class="small-box-footer">Ir a Salas <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $totalUsuarios['total']; ?></h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="usuarios.php" class="small-box-footer">Ir a Usuarios <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalPedidos['total']; ?></h3>
                        <p>Pedidos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="lista_ventas.php" class="small-box-footer">Ir a Pedidos <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Sección para mostrar los platos disponibles en una tabla -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Platos Disponibles</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre del Plato</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($queryPlatos) > 0) {
                                        while ($data = mysqli_fetch_assoc($queryPlatos)) { ?>
                                            <tr>
                                                <td><?php echo $data['id']; ?></td>
                                                <td><?php echo $data['nombre']; ?></td>
                                                <td>$<?php echo number_format($data['precio'], 2); ?></td>
                                                <td><img class="img-thumbnail" src="<?php echo ($data['imagen'] == null) ? '../assets/img/default.png' : $data['imagen']; ?>" alt="" width="100"></td>
                                            </tr>
                                    <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay platos disponibles</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
<script src="../assets/js/dashboard.js"></script>