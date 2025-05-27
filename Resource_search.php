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
                       autocomplete="off"
                       width="100%"
                       max-width="700px"
                       margin="0 auto 24px auto">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            </div>
        </form>

        <div id="searchResults" class="search-results">
            <!-- Los resultados se mostrarán aquí -->
        </div>
    </div>

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(120deg, #ffe29f 0%, #ffa99f 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .search-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 32px 28px 24px 28px;
            background: #fffbe6;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }
        .search-box {
            display: flex;
            gap: 0;
            margin-bottom: 24px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
            min-height: 64px;
            width: 100%;
            max-width: 900px;
            margin: 0 auto 24px auto;
        }
        .search-box input {
            flex: 1;
            padding: 22px 24px 22px 54px;
            border: none;
            font-size: 22px;
            outline: none;
            background: transparent url('https://cdn-icons-png.flaticon.com/512/622/622669.png') no-repeat 12px center/28px 28px;
            background-size: 28px 28px;
            min-width: 0;
            width: 100%;
        }
        .search-box button {
            padding: 0 44px;
            background: linear-gradient(90deg, #ff9800 0%, #ff5722 100%);
            color: #fff;
            border: none;
            font-size: 22px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            border-radius: 0 8px 8px 0;
            height: 64px;
            display: flex;
            align-items: center;
        }
        .search-box button:hover {
            background: linear-gradient(90deg, #ffb347 0%, #ff7043 100%);
            transform: scale(1.05);
        }
        .filter-options {
            display: flex;
            gap: 24px;
            margin-bottom: 18px;
            justify-content: center;
        }
        .filter-options label {
            display: flex;
            align-items: center;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            padding-left: 28px;
        }
        .filter-options input[type="checkbox"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ff9800;
            border-radius: 4px;
            margin-right: 8px;
            position: absolute;
            left: 0;
            top: 2px;
            background: #fff;
            transition: background 0.2s, border-color 0.2s;
        }
        .filter-options input[type="checkbox"]:checked {
            background: linear-gradient(90deg, #ff9800 0%, #ff5722 100%);
            border-color: #ff5722;
        }
        .filter-options input[type="checkbox"]:checked:after {
            content: '\2713';
            color: #fff;
            font-size: 20px;
            position: absolute;
            left: 2px;
            top: 0px;
        }
        .search-results {
            margin-top: 28px;
        }
        .result-item {
            padding: 18px 22px;
            border: none;
            margin-bottom: 16px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 2px 12px rgba(255,152,0,0.08);
            animation: fadeIn 0.5s;
        }
        .result-item h3 {
            margin: 0 0 6px 0;
            font-size: 20px;
            color: #ff9800;
        }
        .result-item p {
            margin: 0;
            color: #444;
            font-size: 15px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 800px) {
            .search-container {
                max-width: 98vw;
                padding: 12px 4vw 16px 4vw;
            }
            .search-box input {
                font-size: 60px;
            }
            .search-box button {
                font-size: 15px;
                padding: 0 18px;
            }
            .filter-options {
                gap: 10px;
                font-size: 14px;
            }
            .result-item {
                padding: 12px 8px;
            }
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