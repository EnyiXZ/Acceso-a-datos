<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Artistas</title>
</head>
<body>
    <h1>Gestión de Artistas</h1>

    <h2>Agregar Artista</h2>
    <form id="artistaForm" method="POST">
        <input type="text" id="non_art" name="non_art" placeholder="Nombre del artista" required>
        <button type="submit">Agregar Artista</button>
    </form>

    <ul id="artistasList">
        <li>Cargando artistas...</li>
    </ul>

</body>
</html>
