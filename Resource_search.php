<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="search-container">
        <form action="Controller/search.php" method="GET" class="search-form">
            <div class="search-box">
                <input type="text" name="query" id="searchInput" 
                       placeholder="Buscar productos, restaurantes o tipos de comida..."
                       autocomplete="off">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <div class="filter-options">
                <label>
                    <input type="checkbox" name="filter[]" value="productos" checked> Productos
                </label>
                <label>
                    <input type="checkbox" name="filter[]" value="restaurantes" checked> Restaurantes
                </label>
                <label>
                    <input type="checkbox" name="filter[]" value="tipo_comida" checked> Tipo de Comida
                </label>
            </div>
        </form>

        <div id="searchResults" class="search-results">
            <!-- Los resultados se mostrarán aquí -->
        </div>
    </div>

    <style>
        .search-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
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

        .search-box button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', debounce(function() {
            if (this.value.length >= 2) {
                fetchResults(this.value);
            } else {
                searchResults.innerHTML = '';
            }
        }, 300));

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func.apply(this, args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function fetchResults(query) {
            const filters = Array.from(document.querySelectorAll('input[name="filter[]"]:checked'))
                                .map(input => input.value);
            
            fetch(`Controller/search.php?query=${encodeURIComponent(query)}&filters=${filters.join(',')}`)
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
                const resultDiv = document.createElement('div');
                resultDiv.className = 'result-item';
                
                let content = `<h3>${item.nombre}</h3>`;
                if (item.tipo === 'restaurante') {
                    content += `<p>Restaurante - ${item.tipo_comida}</p>`;
                } else if (item.tipo === 'producto') {
                    content += `<p>Producto - ${item.precio}€</p>`;
                }
                
                resultDiv.innerHTML = content;
                searchResults.appendChild(resultDiv);
            });
        }
    </script>
</body>
</html> 