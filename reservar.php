<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $fecha_reserva = $_POST['fecha_reserva'];
    $num_personas = $_POST['num_personas'];
    $turno = $_POST['turno'];

    try {
        $sql = "INSERT INTO reservas (nombre, apellido, edad, telefono, fecha_reserva, num_personas, turno) 
                VALUES (:nombre, :apellido, :edad, :telefono, :fecha_reserva, :num_personas, :turno)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':edad' => $edad,
            ':telefono' => $telefono,
            ':fecha_reserva' => $fecha_reserva,
            ':num_personas' => $num_personas,
            ':turno' => $turno
        ]);

        echo "<h2>¡Reserva realizada con éxito!</h2>";
        echo "<a href='formulario.html'>Hacer otra reserva</a> | <a href='listas.php'>Ver listado</a>";
    } catch (PDOException $e) {
        echo "Error al guardar la reserva: " . $e->getMessage();
    }
}
?>