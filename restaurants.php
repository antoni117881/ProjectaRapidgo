
<!DOCTYPE html>
<html LANG?="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Main Page</title>
    <meta naem="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylehome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
  
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">RapidGo</a>

            <div class="nav__menu" id="nav-menu">
               <ul class="nav__list">
                  <li class="nav__item">
                     <a href="?action=" class="nav__link">Home</a>
                  </li>

                  <li class="nav__item">
                     <a href="?action=Restaurantes" class="nav__link">Restaurants</a>
                  </li>

                  <li class="nav__item">
                     <a href="?action=" class="nav__link">Trending</a>
                  </li>

                  <li class="nav__item">
                     <a href="?action=Menus" class="nav__link">Articles</a>
                  </li>

                  <li class="nav__item">
                     <a href="?action=" class="nav__link">Contact Us</a>
                  </li>
               </ul>

               <!-- Close button -->
               <div class="nav__close" id="nav-close">
                  <i class="ri-close-line"></i>
               </div>
            </div>

            <div class="nav__actions">
               <!-- Search button -->
               <i class="ri-search-line nav__search" id="search-btn"></i>

               <!-- Login button -->
               <i class="ri-user-line nav__login" id="login-btn"></i>

               <!-- Toggle button -->
               <div class="nav__toggle" id="nav-toggle">
                  <i class="ri-menu-line"></i>
               </div>
               <!--Cart-->
                <div class="nav__cart">
                    <i class="ri-shopping-cart-line"></i>
                </div>  
            </div>
        </nav>
    </header>
    
   
      <!--==================== SEARCH ====================-->
      <div class="search" id="search">
         <form action="" class="search__form">
            <i class="ri-search-line search__icon"></i>
            <input type="search" placeholder="What are you looking for?" class="search__input">
         </form>

         <i class="ri-close-line search__close" id="search-close"></i>
      </div>

      <!--==================== LOGIN ====================-->
      <div class="login" id="login">
         <form action="" class="login__form" id="loginUser">
            <h2 class="login__title">Log In</h2>
            
            <div class="login__group">
               <div>
                  <label for="email" class="login__label">Email</label>
                  <input type="email" placeholder="Write your email" id="email" class="login__input">
               </div>
               
               <div>
                  <label for="password" class="login__label">Password</label>
                  <input type="password" placeholder="Enter your password" id="password" class="login__input">
               </div>
            </div>

            <div>
               <p class="login__signup">
                  You do not have an account? <a href="#">Sign up</a>
               </p>
   
               <a href="#" class="login__forgot">
                  You forgot your password
               </a>
   
               <button type="submit" class="login__button">Log In</button>
            </div>
         </form>

         <i class="ri-close-line login__close" id="login-close"></i>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <video class="hero__video" autoplay muted loop>
            <source src="video/Food_Video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="hero__content">
            
            <p class="hero__subtitle">Discover the best restaurants near you</p>
        </div>
    </section>

    <div class="menu">
        <div class="heading">
            <h1>Meet Our Top Tier Restaurants</h1>
            <!--<h3>&mdash;Meet Our Top Tier Restaurants&mdash;</h3>-->
        </div>
        <div>
        <?php
        include 'Vista/filtro_productos.php';
        ?>
        </div>
       <div class="filtro-container">
        <p>Hoal</p>
        <input type="checkbox" id="opcion1" name="vegano">
        <input type="checkbox" id="opcion2" name="opcion1">
        <input type="checkbox" id="opcion3" name="opcion1">
        <input type="checkbox" id="opcion4" name="opcion1">
       </div>

          
    
        
        <div class="restaurants">
            <img src="imgs/Italian_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>La mia mamma</h5>
                    <p class="category">Italian Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
        <div class="restaurants">
            <img src="/imgs/El_Rodeo_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>El Rodeo</h5>
                    <p class="category">American Grill Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
        <div class="restaurants">
            <img src="imgs/Flamenco_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>Entablao Cordobeh</h5>
                    <p class="category">Spanish Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
        <div class="restaurants">
            <img src="imgs/Irish_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>Drunken Sailor</h5>
                    <p class="category">Irish Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
        <div class="restaurants">
            <img src="imgs/Midori_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>Midori</h5>
                    <p class="category">Japense Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
        <div class="restaurants">
            <img src="imgs/Indian_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>Eh Bangladesh</h5>
                    <p class="category">Indian Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
        <div class="restaurants">
            <img src="/imgs/BGame_Restaurant.jpg" alt="restaurant1">
            <div class="details">
                <div class="details-sub">
                    <h5>MMORPG</h5>
                    <p class="category">Gaming Restaurant</p>
                    <p class="rating">4.5/5</p>
                </div>
                <button>Order Now</button>
            </div>
        </div>
    </div>
    <!-- Footer -->
<footer class="footer">
    <div class="footer__content">
        <p>&copy; 2025 RapidGo. All rights reserved.</p>
    </div>
    
</footer>

    <script src="main1.js"></script>
</body>

</html>