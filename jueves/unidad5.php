<?php
$host = "db";
$dbname = "appdb";
$username = "appuser";
$password = "apppass";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:green;'>✓ Conexión exitosa a la base de datos</p>";
} catch (PDOException $e) {
    die("<p style='color:red;'>✗ Error de conexión: " . $e->getMessage() . "</p>");
}

// Consultar usuarios
try {
    $stmt = $conn->query("SELECT * FROM usuarios");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Lista de Usuarios</h2>";
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #f2f2f2;'><th>ID</th><th>Username</th><th>Rol</th><th>Fecha Creación</th></tr>";
    
    if (!empty($result)) {
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . ($row['id'] ?? 'N/A') . "</td>";
            echo "<td>" . ($row["username"] ?? 'N/A') . "</td>";
            echo "<td>" . ($row["rol"] ?? 'usuario') . "</td>";
            echo "<td>" . ($row["created_at"] ?? 'N/A') . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' style='text-align:center;'>No hay usuarios registrados</td></tr>";
    }
    echo "</table>";

    // Actualizar rol
    $stmt = $conn->prepare("UPDATE usuarios SET rol = :rol WHERE username = :username");
    $stmt->execute(['rol' => 'admin', 'username' => 'kleal']);
    echo "<p style='color:green;'>✓ Usuario actualizado</p>";

    // Insertar nuevo usuario
    $password_hash = password_hash('12345', PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, rol) VALUES (:username, :password, :rol)");
    $result = $stmt->execute([
        'username' => 'nuevo_usuario', 
        'password' => $password_hash,
        'rol' => 'usuario'
    ]);
    
    if ($result) {
        echo "<p style='color:green;'>✓ Nuevo usuario insertado</p>";
    }

} catch (PDOException $e) {
    echo "<p style='color:red;'>Error en la consulta: " . $e->getMessage() . "</p>";
    echo "<p>Posibles soluciones:</p>";
    echo "<ul>";
    echo "<li>Ejecuta el script SQL para crear la tabla 'usuarios'</li>";
    echo "<li>Verifica que la base de datos 'appdb' existe</li>";
    echo "<li>Verifica las credenciales en PHPMyAdmin</li>";
    echo "</ul>";
}

// Mostrar información de depuración
echo "<hr>";
echo "<h3>Información de Depuración:</h3>";
echo "<p><strong>GET parameters:</strong> ";
print_r($_GET);
echo "</p>";

$page = $_GET['page'] ?? 'login';
echo "<p><strong>Página actual:</strong> " . htmlspecialchars($page) . "</p>";
?>