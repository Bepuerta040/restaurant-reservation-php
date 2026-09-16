<?php
include 'conexion.php';

$filtro_turno = isset($_GET['turno']) ? $_GET['turno'] : '';

try {
    if ($filtro_turno == 'Comida' || $filtro_turno == 'Cena') {
        $sql = "SELECT * FROM reservas WHERE turno = :turno";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':turno' => $filtro_turno]);
    } else {
        $sql = "SELECT * FROM reservas";
        $stmt = $conexion->query($sql);
    }
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al recuperar los datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Reservas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>Listado de Reservas</h1>
        
        <!-- Filtro por Turno -->
        <form method="GET" action="listas.php" class="filter-form">
            <label for="turno">Filtrar por turno:</label>
            <select name="turno" id="turno" onchange="this.form.submit()">
                <option value="">Todos</option>
                <option value="Comida" <?php if($filtro_turno == 'Comida') echo 'selected'; ?>>Comida</option>
                <option value="Cena" <?php if($filtro_turno == 'Cena') echo 'selected'; ?>>Cena</option>
            </select>
            <noscript><button type="submit">Filtrar</button></noscript>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Teléfono</th>
                    <th>Fecha</th>
                    <th>Personas</th>
                    <th>Turno</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($reservas) > 0): ?>
                    <?php foreach ($reservas as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['edad']); ?></td>
                            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_reserva']); ?></td>
                            <td><?php echo htmlspecialchars($row['num_personas']); ?></td>
                            <td><?php echo htmlspecialchars($row['turno']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No hay reservas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p><a href="formulario.html">Nueva Reserva</a></p>
    </div>
</body>
</html>