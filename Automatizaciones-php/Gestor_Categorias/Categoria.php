<?php
include("../connection/connection.php");
$con = connection();

// Inicializar $searchCedula y $searchIdPeticion
$searchNombre = isset($_GET['searchNombre']) ? $_GET['searchNombre'] : '';


$sqlCategoria = "SELECT * FROM tblcategorias";

if (!empty($searchNombre)) {
    $searchCedula = mysqli_real_escape_string($con, $searchNombre);
    $sqlCategoria .= " WHERE Nombre LIKE '%$searchNombre%'";
} else {
    echo ('');
}

$queryCategorias = mysqli_query($con, $sqlCategoria);
?>
<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    # code...
    header("location: ../menu/login.html ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilopeticiones.css">
    <title>Categoria Crud</title>
    <style>
        body {
            background-color: rgb(90, 89, 89);
        }
    </style>
</head>
<div class="menu">
    <nav>
        <ul>
            <li><a href="../Gestor_usuarios/usuario.php">Gestor de Usuarios</a></li>
            <li><a href="../Gestor_bots/bots.php">Gestor de Bots</a></li>
            <li><a href="../Gestor_peticiones/peticiones.php">Gestor de Peticiones</a></li>
            <li><a href="../Gestor_calificaciones/calificacion.php">Gestor de Calificaciones</a></li>
            <li><a href="../Gestor_roles/roles.php">Gestor de Roles</a></li>
            <li><a href="../Gestor_tipos/tipos.php">Gestor de Tipos</a></li>
            <li><a href="../Gestor_categorias/categoria.php">Gestor de Categorías</a></li>
            <li><a href="../Gestor_sub_categorias/sub_categoria.php">Gestor de Subcategorías</a></li>
            <li><a href="../Gestor_control/Control.php ">Control</a></li>
        </ul>
    </nav>
</div>
<body>
<div class="users-form">
    <h2>Registrar Categoria</h2>
    <form action="insert_categoria.php" method="POST">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="text" name="descripcion" placeholder="descripcion">
        <input type="submit" value="Agregar Categoria">
        <input type="reset" value="Limpiar">
    </form>
</div>
<div class="users-table">
    <h2>Peticiones Registradas</h2>
    <center>
    <form action="" method="GET">
        <label for="searchNombre">Buscar por Nombre de la categoria:</label><br>
        <input type="text" name="searchNombre" id="searchNombre" value="<?= $searchNombre ?>">
        <input type="submit" value="Buscar">
    </form>
    </center>
        <br><br>

    <table>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
    <?php
    while ($row = mysqli_fetch_array($queryCategorias)) :
        ?>
        <tr>
            <th><?= isset($row['Nombre']) ? $row['Nombre'] : 'N/A'; ?></th>
            <th><?= isset($row['Descripcion']) ? $row['Descripcion'] : 'N/A'; ?></th>
            <th><a href="update_Categoria.php?Nombre=<?= isset($row['Nombre']) ? $row['Nombre'] : ''; ?>" class="users-table--edit">Editar</a></th>
            <th><a href="delete_Categoria.php?Nombre=<?= isset($row['Nombre']) ? $row['Nombre'] : ''; ?>" class="users-table--delete">Eliminar</a></th>
        </tr>
    <?php
    endwhile;
    ?>
</tbody>
    </table>
</div>
</body>
</html>
