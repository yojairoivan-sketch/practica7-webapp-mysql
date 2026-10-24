<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $version  = $pdo->query('SELECT VERSION()')->fetchColumn();
    $mensajes = $pdo->query('SELECT texto FROM mensajes')->fetchAll(PDO::FETCH_COLUMN);
    $estado   = "Conectado a MySQL $version (base de datos: $db)";
} catch (PDOException $e) {
    $mensajes = [];
    $estado   = 'Error de conexión: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hola Mundo - PHP + MySQL</title>
</head>
<body>
  <h1>Hola Mundo</h1>
  <p><?= htmlspecialchars($estado) ?></p>
  <h2>Mensajes desde la base de datos</h2>
  <ul>
    <?php foreach ($mensajes as $m): ?>
      <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <p>Yojairo Rodriguez — Electiva 2, ITLA</p>
</body>
</html>
