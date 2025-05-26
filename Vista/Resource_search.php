<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .search-container {
            width: 100vw;
            max-width: 100vw;
            margin: 0;
            padding: 0;
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-box input {
            flex: 1;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-buscar {
            padding: 10px 20px;
            background-color:rgb(224, 118, 18); /* Color de fondo */
            color: white; /* Color del texto */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambia el cursor al pasar el ratón */
            transition: background-color 0.3s; /* Transición suave para el color de fondo */
        }

        .btn-buscar:hover {
            background-color: #0056b3; /* Color de fondo al pasar el ratón */
        }

        .filter-options {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .search-results {
            margin-top: 20px;
        }

        .result-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .search-bar-container {
            margin: 40px auto 20px auto;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            width: 950px;
            display: flex;
            align-items: center;
            background: rgb(237, 203, 116);
            border-radius: 40px;
            padding: 0 20px;
            height: 60px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            color:rgb(43, 33, 33);
            font-size: 2rem;
            flex: 1;
            padding: 18px 10px;
        }

        .search-icon {
            color:rgb(43, 105, 32);
            font-size: 2rem;
            margin-right: 10px;
        }

        .btn-buscar {
            display: none; /* Oculta el botón si solo quieres la barra tipo buscador */
        }

        .input-resena {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
            border: none;
            border-radius: 30px;
            background: #f7e7b5;
            font-size: 1.2em;
            color: #333;
            box-shadow: 0 2px 8px rgba(216, 168, 77, 0.15);
            outline: none;
            transition: box-shadow 0.2s;
        }

        .input-resena:focus {
            box-shadow: 0 4px 16px rgba(216, 168, 77, 0.25);
            background: #fffbe6;
        }

        .btn-resena {
            width: 100%;
            padding: 15px 0;
            border: none;
            border-radius: 30px;
            background: linear-gradient(90deg, #ffb347, #ffcc33);
            color: #a94400;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(216, 168, 77, 0.15);
            transition: background 0.3s, color 0.3s;
        }

        .btn-resena:hover {
            background: linear-gradient(90deg, #ffcc33, #ffb347);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <div class="search-bar-container">
            <form id="searchForm" class="search-form">
                <div class="search-bar">
                    <span class="search-icon"><i class="fas fa-search"></i></span>
                    <input type="text" name="query" id="searchInput" placeholder="Buscar productos, restaurantes o tipos de comida..." autocomplete="off">
                </div>
                <button type="submit" class="btn-buscar">Buscar</button>
            </form>
        </div>

        <div class="filter-options">
            <label><input type="checkbox" name="filter[]" value="productos" checked> Productos</label>
        </div>

        <div id="searchResults" class="search-results">
            <!-- Los resultados se mostrarán aquí -->
        </div>
    </div>

    <div id="modalDetalle" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
        <div id="modalContenido" style="background:#fff; padding:30px; border-radius:10px; max-width:400px;"></div>
    </div>

    <script>
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();
            fetchResults(searchInput.value.trim());
        });

        function fetchResults(query) {
            const filters = Array.from(document.querySelectorAll('input[name="filter[]"]:checked'))
                                .map(input => input.value);

            const data = {
                query: query,
                filter: filters
            };

            fetch('Controller/search.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                displayResults(data);
            })
            .catch(error => console.error('Error:', error));
        }

        function displayResults(data) {
            searchResults.innerHTML = '';
            
            if (data.length === 0) {
                searchResults.innerHTML = '<p>No se encontraron resultados</p>';
                return;
            }

            data.forEach(item => {
                if (item.tipo === 'producto') {
                    const card = document.createElement('div');
                    card.style.background = 'linear-gradient(to bottom, #f9d423, #ff4e50)';
                    card.style.borderRadius = '20px';
                    card.style.boxShadow = '0 4px 16px rgba(0,0,0,0.15)';
                    card.style.padding = '20px';
                    card.style.margin = '20px 0';
                    card.style.display = 'flex';
                    card.style.flexDirection = 'column';
                    card.style.alignItems = 'center';
                    card.style.maxWidth = '350px';

                    card.innerHTML = `
                        <img src="${item.imagen || 'ruta/por/defecto.jpg'}" alt="${item.nombre}" style="width: 90%; max-width: 300px; border-radius: 15px; margin-bottom: 15px;">
                        <h2 style="margin: 0 0 10px 0;">${item.nombre}</h2>
                        <p style="margin: 0 0 5px 0;">Categoría: ${item.categoria || '-'}</p>
                        <p style="font-weight: bold; font-size: 1.2em; margin: 0 0 10px 0;">€${item.precio}</p>
                        <button onclick="window.location.href='Vista/VistaProductoDetalle.php?id=${item.id}'" style="padding: 10px 20px; background: #fff; color: #c0392b; border: 2px solid #27ae60; border-radius: 20px; font-weight: bold; cursor: pointer;">
                            Ver detalles del producto
                        </button>
                    `;
                    searchResults.appendChild(card);

                    // Después de agregar la tarjeta al DOM:
                    card.querySelector('.btn-detalle').addEventListener('click', function() {
                        document.getElementById('modalContenido').innerHTML = `
                            <h2>${item.nombre}</h2>
                            <img src="${item.imagen || 'ruta/por/defecto.jpg'}" style="width:100%;">
                            <p>Categoría: ${item.categoria || '-'}</p>
                            <p>Precio: €${item.precio}</p>
                            <p>${item.descripcion || ''}</p>
                            <button onclick="document.getElementById('modalDetalle').style.display='none'">Cerrar</button>
                        `;
                        document.getElementById('modalDetalle').style.display = 'flex';
                    });
                }
                // Puedes agregar aquí el formato para restaurantes o tipos de comida si lo necesitas
            });
        }
    </script>
</body>
</html> 