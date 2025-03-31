<html>
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<style>

.hero {
    position: relative;
    width: 100%;
    height: 80vh; /* Ajusta la altura según tus necesidades */
    overflow: hidden;
}
.hero__content {
    position: relative;
    z-index: 1; /* Asegura que el contenido esté encima del video */
    text-align: center;
    color:#832323;
    padding: 2rem;
    
}

.hero__video {
    position: absolute;
    top: 0%;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Asegura que el video cubra todo el contenedor */
    z-index: -1; /* Envía el video al fondo */
}
</style>
<body>
    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
        
    </header>
    <main>

        <div class="productos">
            
                  <section class="hero">
                  <video class="hero__video" autoplay muted loop>
                      <source src="video/Food_Video.mp4" type="video/mp4">
                      Your browser does not support the video tag.
                  </video>
                  <div class="hero__content">
                      
                     <h1> <p class="hero__subtitle">DESCUBRE LSO MEJORES RESTAURANTES CERCA DE TI  </p></h1>
                  </div>
              </section>
              <?php
                // Incluir la vista de los restaurantes 
                
                include 'Vista/filtro_productos.php';

                 
            ?>
            
        </div>
    </main>
</body>
<script src="main1.js"></script>
</html>
