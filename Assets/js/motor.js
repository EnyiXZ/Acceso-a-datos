document.addEventListener('DOMContentLoaded', function () {
    const contenidoForm = document.getElementById('contenidoForm');
    const contenidosList = document.getElementById('contenidosList');
    const selectContenido = document.getElementById('selectContenido');
    const artistaForm = document.getElementById('artistaForm');
    const artistasList = document.getElementById('artistasList');
    const selectArtista = document.getElementById('selectArtista');
    const asociarForm = document.getElementById('asociarForm');
    const artistasContenidosList = document.getElementById('artistasContenidosList');

    // Cargar contenidos
    function loadContenidos() {
        if (!contenidosList) return;
        fetch('/site1/examen-acceso-datos/controllers/contenido1Controller.php?action=load')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.contenidos) {
                    contenidosList.innerHTML = '';
                    if (selectContenido) {
                        selectContenido.innerHTML = '<option value="">Seleccionar contenido</option>';
                    }
                    data.contenidos.forEach(contenido => {
                        const contenidoItem = document.createElement('li');
                        contenidoItem.classList.add('contenido-item');
                        contenidoItem.textContent = contenido.tit_con;
                        contenidosList.appendChild(contenidoItem);

                        if (selectContenido) {
                            const option = document.createElement('option');
                            option.value = contenido.ide_con;
                            option.textContent = contenido.tit_con;
                            selectContenido.appendChild(option);
                        }
                    });
                } else {
                    contenidosList.innerHTML = '<li>No hay contenidos registrados.</li>';
                    if (selectContenido) {
                        selectContenido.innerHTML = '<option value="">No hay contenidos</option>';
                    }
                }
            })
            .catch(error => {
                console.error('Error al cargar contenidos:', error);
            });
    }

    // Cargar artistas
    function loadArtistas() {
        if (!artistasList) return;
        fetch('/site1/examen-acceso-datos/controllers/artista1Controller.php?action=load')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.artistas) {
                    artistasList.innerHTML = '';
                    if (selectArtista) {
                        selectArtista.innerHTML = '<option value="">Seleccionar artista</option>';
                    }
                    data.artistas.forEach(artista => {
                        const artistaItem = document.createElement('li');
                        artistaItem.classList.add('artista-item');
                        artistaItem.textContent = artista.non_art;
                        artistasList.appendChild(artistaItem);

                        if (selectArtista) {
                            const option = document.createElement('option');
                            option.value = artista.ide_art;
                            option.textContent = artista.non_art;
                            selectArtista.appendChild(option);
                        }
                    });
                } else {
                    artistasList.innerHTML = '<li>No hay artistas registrados.</li>';
                    if (selectArtista) {
                        selectArtista.innerHTML = '<option value="">No hay artistas</option>';
                    }
                }
            })
            .catch(error => {
                console.error('Error al cargar artistas:', error);
            });
    }

    // Cargar asociaciones de artistas y contenidos
    function loadArtistasContenidos() {
        if (!artistasContenidosList) return;
        fetch('/site1/examen-acceso-datos/controllers/artista-contenido1Controller.php?action=load')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success' && data.artistas_contenidos) {
                    artistasContenidosList.innerHTML = '';
                    data.artistas_contenidos.forEach(asociacion => {
                        const asociacionItem = document.createElement('li');
                        asociacionItem.classList.add('asociacion-item');
                        asociacionItem.textContent = `Contenido: ${asociacion.tit_con} - Artista: ${asociacion.non_art}`;
                        artistasContenidosList.appendChild(asociacionItem);
                    });
                } else {
                    artistasContenidosList.innerHTML = '<li>No hay asociaciones registradas.</li>';
                }
            })
            .catch(error => {
                console.error('Error al cargar asociaciones:', error);
            });
    }

    loadContenidos();
    loadArtistas();
    loadArtistasContenidos();

    // Manejo del formulario de agregar contenido
    if (contenidoForm) {
        contenidoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('/site1/examen-acceso-datos/controllers/contenido1Controller.php?action=create', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            }).then(data => {
                if (data.status === 'success') {
                    const titulo = document.getElementById('titulo').value;
                    const newContenidoItem = document.createElement('li');
                    newContenidoItem.classList.add('contenido-item');
                    newContenidoItem.textContent = titulo;
                    contenidosList.appendChild(newContenidoItem);

                    if (selectContenido) {
                        const option = document.createElement('option');
                        option.value = data.ide_con;
                        option.textContent = titulo;
                        selectContenido.appendChild(option);
                    }

                    document.getElementById('titulo').value = '';
                } else {
                    alert('Error al crear contenido: ' + data.message);
                }
            }).catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });
        });
    }

    // Manejo del formulario de agregar artista
    if (artistaForm) {
        artistaForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('/site1/examen-acceso-datos/controllers/artista1Controller.php?action=create', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            }).then(data => {
                if (data.status === 'success') {
                    const nombre = document.getElementById('non_art').value;
                    const newArtistaItem = document.createElement('li');
                    newArtistaItem.classList.add('artista-item');
                    newArtistaItem.textContent = nombre;
                    artistasList.appendChild(newArtistaItem);

                    if (selectArtista) {
                        const option = document.createElement('option');
                        option.value = data.ide_art;
                        option.textContent = nombre;
                        selectArtista.appendChild(option);
                    }

                    document.getElementById('non_art').value = '';
                } else {
                    alert('Error al crear artista: ' + data.message);
                }
            }).catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });
        });
    }

    // Manejo del formulario de asociar artista a contenido
    if (asociarForm) {
        asociarForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('/site1/examen-acceso-datos/controllers/artista-contenido1Controller.php?action=associate', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            }).then(data => {
                if (data.status === 'success') {
                    loadArtistasContenidos();

                    const ideArtInput = document.getElementById('ide_art');
                    const ideConInput = document.getElementById('ide_con');

                    if (ideArtInput) {
                        ideArtInput.value = '';
                    }
                    if (ideConInput) {
                        ideConInput.value = '';
                    }
                } else {
                    alert('Error al asociar artista a contenido: ' + data.message);
                }
            }).catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });
        });
    }

});
