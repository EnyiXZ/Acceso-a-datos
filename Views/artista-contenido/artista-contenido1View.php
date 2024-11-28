<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Contenidos y Artistas</title>
</head>
<body>
        <h1>Gestión de Contenidos y Artistas</h1>
    <h2>Asociar Artista a Contenido</h2>
    <form id="asociarForm" method="POST">
        <select id="selectContenido" name="ide_con" required>
            <option value="">Seleccionar contenido</option>
        </select>
        <select id="selectArtista" name="ide_art" required>
            <option value="">Seleccionar artista</option>
        </select>
        <button type="submit">Asociar</button>
    </form>

    <ul id="artistasContenidosList">
        <li>Cargando asociaciones...</li>
    </ul>
<div class="artista-contenido">
    <div>
        <h3>Contenido</h3>
        <ul id="contenidosList">
            <li>Cargando contenidos...</li>
        </ul>
    </div>
    <div>
        <h3>artistas</h3>
        <ul id="artistasList">
            <li>Cargando artistas...</li>
        </ul>
    </div>
</div>
</body>
</html>
