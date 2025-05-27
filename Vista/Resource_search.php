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
            max-width: 1600px;
            margin: 40px auto;
            padding: 40px;
            background: #fffbe6;
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .search-box {
            display: flex;
            gap: 0;
            margin-bottom: 24px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            min-height: 70px;
            width: 100%;
            max-width: 1700px;
            margin: 0 auto 24px auto;
            transition: all 0.3s ease;
        }

        .search-box input {
            flex: 1;
            padding: 28px 28px 20px 100px;
            border: none;
            font-size: 20px;
            outline: none;
            background: transparent url('https://cdn-icons-png.flaticon.com/512/622/622669.png') no-repeat 15px center/30px 30px;
            background-size: 30px 30px;
            min-width: 0;
            width: 100%;
            color: #333;
            font-weight: 500;
        }

        .search-box button {
            padding: 0 36px;
            background: linear-gradient(90deg, #ff9800 0%, #ff5722 100%);
            color: #fff;
            border: none;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 0 16px 16px 0;
            height: 70px;
            display: flex;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);
        }

        .search-box button:hover {
            background: linear-gradient(90deg, #ff5722 0%, #ff9800 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 87, 34, 0.4);
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
    </style>
</head>
<body>
    <div class="search-container">
        <form id="searchForm" class="search-form">
            <div class="search-box">
                <input type="text" name="query" id="searchInput" 
                       placeholder="Buscar productos, restaurantes o tipos de comida..."
                       autocomplete="off">
                <button type="submit" class="btn-buscar">Buscar</button>
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