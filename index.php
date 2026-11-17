<?php
require_once __DIR__ . '/config/database.php';
$database = new Database();
$db = $database->getConnection();

$stmt = $db->query("SELECT COUNT(*) as total_platos FROM plato");
$resultado = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RestoVentas - Versión 1.0</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #1e272e; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #2f3640; padding: 30px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.4); width: 460px; border-top: 5px solid #2ed573; }
        h2 { margin-top: 0; color: #2ed573; }
        .badge { background: #ffa502; color: #1e272e; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 13px; }
        ul { line-height: 1.9; color: #dcdde1; }
    </style>
</head>
<body>
    <div class="card">
        <span class="badge">VERSIÓN 1.0 - NÚCLEO BASE</span>
        <h2>✅ Conexión Exitosa a MySQL</h2>
        <p>El núcleo del sistema <strong>RestoVentas</strong> está activo y conectado.</p>
        <ul>
            <li><strong>Base de Datos:</strong> dbrestaurante</li>
            <li><strong>Motor Conector:</strong> PHP Data Objects (PDO)</li>
            <li><strong>Seguridad:</strong> Sentencias preparadas y Excepciones activas</li>
            <li><strong>Platos iniciales en base de datos:</strong> <?php echo $resultado['total_platos']; ?> registrados</li>
        </ul>
    </div>
</body>
</html>