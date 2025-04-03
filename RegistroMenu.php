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
    color:white;
    padding: 2rem;
    background: linear-gradient(0deg,rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.37),rgba(0, 0, 0, 0.72));
    text-shadow: 0px 0px 4px rgba(161, 37, 37, 0.91);

    
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
.separador{
    width: 100%;
    height: 5px;
    background:rgb(231, 53, 53);
}
.separador1{
    width: 100%;
    height: 2px;
    background:rgb(210, 54, 54);
}
.separador2{
    width: 100%;
    height: 3px;
    background:rgb(66, 107, 33);
}
.separador3{
    width: 100%;
    height: 3px;
    background:rgb(255, 255, 255);
}
</style>
<body>
    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
        <div class="separador1">
                    </div>
    </header>
    <main>

        <div class="productos">
            
                  <section class="hero">
                  <video class="hero__video" autoplay muted loop>
                      <source src="video/Food_Video.mp4" type="video/mp4">
                      Your browser does not support the video tag.
                  </video>
                  <div class="hero__content">
                      
                     <h1> <p class="hero__subtitle">DESCUBRE LOS MEJORES RESTAURANTES CERCA DE TI  </p></h1>
                  </div>
                  
              </section>
              
              <div class="separador">
                    </div>
                    <div class="separador2">
                    </div>
                    <div class="separador3">
                    </div>
              <?php
                // Incluir la vista de los restaurantes 
                
                include 'Vista/filtro_productos.php';

                 
            ?>
            
        </div>
    </main>
</body>
<script src="main1.js"></script>
</html>
