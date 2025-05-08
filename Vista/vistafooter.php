<style>
.footer {
  background: #191919;
  color: #fff;
  padding: 40px 0 0 0;
  font-family: 'Montserrat', Arial, sans-serif;
  font-size: 15px;
}
.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  max-width: 1200px;
  margin: 0 auto;
  gap: 40px;
}
.footer-section {
  flex: 1 1 200px;
  min-width: 200px;
  margin-bottom: 30px;
}
.footer-logo {
  font-size: 2em;
  font-weight: bold;
  margin-bottom: 10px;
  color: #fff;
  display: flex;
  align-items: center;
}
.footer-logo-dot {
  color: #ffd600;
  font-size: 1.2em;
  margin-left: 2px;
}
.footer-title {
  font-weight: bold;
  margin-bottom: 10px;
}
.footer-section ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-section ul li {
  margin-bottom: 8px;
}
.footer-section a {
  color: #fff;
  text-decoration: none;
  transition: color 0.2s;
}
.footer-section a:hover {
  color: #ffd600;
}
.footer-apps {
  margin-top: 10px;
}
.footer-app-icon {
  height: 32px;
  margin-right: 8px;
  vertical-align: middle;
}
.footer-links {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 20px;
}
.footer-links a {
  font-size: 0.95em;
  color: #fff;
  opacity: 0.8;
}
.footer-links a:hover {
  color: #ffd600;
  opacity: 1;
}
.footer-bottom {
  border-top: 1px solid #333;
  margin-top: 30px;
  padding: 20px 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
  font-size: 0.98em;
}
.footer-bottom a {
  color: #ffd600;
  text-decoration: none;
  margin-right: 10px;
}
.footer-bottom a:hover {
  text-decoration: underline;
}
@media (max-width: 900px) {
  .footer-container, .footer-bottom {
    flex-direction: column;
    align-items: flex-start;
    gap: 20px;
  }
}
</style>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <div class="footer-logo">
        <span>RAPIDGO</span><span class="footer-logo-dot">●</span>
      </div>
      <div class="footer-title">Colabora con RAPIDGO</div>
      <ul>
        <li><a href="#">Trabaja con nosotros</a></li>
        <li><a href="#">Rapidgo para Partners</a></li>
        <li><a href="#">Repartidores</a></li>
        <li><a href="#">Rapidgo Business</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <div class="footer-title">Enlaces de interés</div>
      <ul>
        <li><a href="#">Acerca de nosotros</a></li>
        <li><a href="#">Preguntas frecuentes</a></li>
        <li><a href="#">Rapidgo Prime</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contacto</a></li>
        <li><a href="#">Seguridad</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <div class="footer-title">Síguenos</div>
      <ul>
        <li><a href="#">Instagram</a></li>
      </ul>
      <div class="footer-apps">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/67/App_Store_%28iOS%29.svg" alt="App Store" class="footer-app-icon">
        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" class="footer-app-icon">
      </div>
    </div>
    <div class="footer-section footer-links">
      <a href="#">CONFIGURA LAS COOKIES</a>
      <a href="#">CONDICIONES DE USO</a>
      <a href="#">POLÍTICA DE PRIVACIDAD</a>
      <a href="#">POLÍTICA DE COOKIES</a>
      <a href="#">CUMPLIMIENTO</a>
    </div>
  </div>
  <div class="footer-bottom">
    <div>
      <strong>Marcas populares: España</strong><br>
      <a href="#">McDonald's</a> · <a href="#">Burger King</a> · <a href="#">KFC</a> · <a href="#">Carrefour</a> · <a href="#">Telepizza</a>
    </div>
    <div>
      <strong>Principales categorías: España</strong><br>
      <a href="#">Supermercado</a><br>
      <a href="#">Ver todas las categorías</a>
    </div>
  </div>
</footer>
