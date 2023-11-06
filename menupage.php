<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "restaurant";
$port = 3307;

$your_db_connection = new mysqli($host, $username, $password, $database, $port);

if ($your_db_connection->connect_error) {
    die("Connection failed: " . $your_db_connection->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: login.html");
    exit();
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title>Kokan Katta</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="images/download.png">

	<!--LINK FOR CSS-->
	<link rel="stylesheet" href="css/cart-page.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive-style.css">

	<!--BOX ICONS-->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    
</head>
<body>
<!--Preloader-->
<div id="preloader">
</div>
<!--Preloader-->
	<!--HEADER-->
	<header>
		<!--NAV-->
		<div class="nav container">
            <a class="navbar-brand" href="index.html">
                <img decoding="async" src="images/logo1.png" class="img-fluid" alt="logo" style="height: 100px; width: 100px;">
            </a>

            <span id="logo">
                <i class='bx bx-user' id="user-icon"></i>
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']; // Display the logged-in user's name
                    } else {
                        echo "Guest"; // Or handle the case where the user is not logged in
                    }
                ?>
            </span>

			<!--CART ICON-->
			<i class='bx bx-shopping-bag' id="cart-icon"></i>
			
			
			<!--CART-->
			<div class="cart">
				<h2 class="cart-title">Your Cart</h2>
				<!--CONTENT-->
				<div class="cart-content">
					
				</div>
				<!--TOTAL-->
				<div class="total">
					<div class="total-title">Total</div>
					<div class="total-price">₹0</div>
				</div>
				<!--BUY BUTTON-->
				<a href="payment.html"><button type="button" class="btn-buy">Buy Now</button></a>
				<!--Cart Close-->
				<i class="bx bx-x" id="close-cart"></i>
			</div>

			
		</div>
	</header>
	<!--CART ICON-->
	<section class="shop container">
		<div class="section-header">
				<div class="search-container"><i class='bx bx-search' id="search-icon"></i>
				<input type="text" id="search-item" placeholder="Search..." onkeyup="search()"></div>
    	</div>
    	
    	<div id="results"></div>
		<h5 class="section-title" style="font-size: 40px;">Kokani Katta Menu</h5>
		<div id="item-not-found" style="display: none;">Dish Not Found</div>

		<!--CONTENT-->

        <h3>Malvani Specials</h3>
        <div class="rounded-lg h-64 overflow-hidden">
            <img alt="content" class="object-cover object-center h-full w-full" src="menuimg/malvanisp.jpg">
        </div>
        <br>
        <p class="leading-relaxed text-base">This restaurant offers a variety of Malvani fish dishes, such as Sumari Bhaji, 
            Bangda Kadhi,Fried Surmai, Fish Rassa,Tambda pandhra, etc.</p>
        <br>
        <div class="shop-content">
        <!--BOX 1-->
			<div class="product-box">
				<img src="menuimg/malvani special\bangdacurry.jpg" alt="Bangda curry" class="product-img">
				<h2 class="product-title">Bangda curry</h2>
				<span class="price">₹ 220</span>
				<i class="bx bx-shopping-bag add-cart" name="Bangda curry"></i>
			</div>

			<div class="product-box">
				<img src="menuimg/malvani special\friedsurmai.jpg" alt="Fried Surmai" class="product-img">
				<h2 class="product-title">Fried Surmai</h2>
				<span class="price">₹ 260</span>
				<i class="bx bx-shopping-bag add-cart" id="Fried Surmai"></i>
			</div>

			<div class="product-box">
				<img src="menuimg/malvani special\chickensukka.jpg" alt="Chicken Sukka" class="product-img">
				<h2 class="product-title">Chicken Sukka</h2>
				<span class="price">₹ 270</span>
				<i class="bx bx-shopping-bag add-cart"></i>
			</div>

			<div class="product-box">
				<img src="menuimg/malvani special\muttonchop.jpg" alt="Mutton Chop Dry" class="product-img">
				<h2 class="product-title">Mutton Chop Dry</h2>
				<span class="price">₹ 280</span>
				<i class="bx bx-shopping-bag add-cart"></i>
			</div>

			<div class="product-box">
				<img src="menuimg/malvani special\kombdivade.jpg" alt="Kombdi Wade" class="product-img">
				<h2 class="product-title">Kombdi Wade</h2>
				<span class="price">₹ 370</span>
				<i class="bx bx-shopping-bag add-cart"></i>
			</div>

			<div class="product-box">
				<img src="menuimg/malvani special\stuffbangda.jpg" alt="Stuffes Bangda Fry" class="product-img">
				<h2 class="product-title">Stuffes Bangda Fry</h2>
				<span class="price">₹ 210</span>
				<i class="bx bx-shopping-bag add-cart"></i>
			</div>

            <div class="product-box">
                <img src="menuimg/malvani special\kolimbirassa.jpg" alt="Kolimbi Rassa" class="product-img">
                <h2 class="product-title">Kolimbi Rassa</h2>
                <span class="price">₹ 200</span>
                <i class="bx bx-shopping-bag add-cart"></i>
            </div>

            <div class="product-box">
                <img src="menuimg/malvani special\fishfry.jpg" alt="Fish Rava Fry" class="product-img">
                <h2 class="product-title">Fish Rava Fry</h2>
                <span class="price">₹ 195</span>
                <i class="bx bx-shopping-bag add-cart"></i>
            </div>
        </div>

        <br>
        <h3>Kokani Specials</h3>
        <div class="rounded-lg h-64 overflow-hidden">
            <img alt="content" class="object-cover object-center h-full w-full" src="menuimg/kokanisp.jpg">
        </div>
        <br>
        <p class="leading-relaxed text-base">This restaurant offers a variety of Kokani fish curry, pomphlet fry, Solkhadi, variety of fish dishes, etc.</p>
        <br>
        <div class="shop-content">
            <!--BOX 1-->
                <div class="product-box">
                    <img src="menuimg/kspecial/solkhadi.jpeg" alt="Sol kadi" class="product-img">
                    <h2 class="product-title">Sol kadi</h2>
                    <span class="price">₹ 25</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kspecial/fishcurry.jpg" alt="Kokani Fish Curry" class="product-img">
                    <h2 class="product-title">Kokani Fish Curry</h2>
                    <span class="price">₹ 215</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kspecial/fry.jpg" alt="Pomphlet Fry" class="product-img">
                    <h2 class="product-title">Pomphlet Fry</h2>
                    <span class="price">₹ 150</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kspecial/patole.jpg" alt="Haldi Patole" class="product-img">
                    <h2 class="product-title">Haldi Patole</h2>
                    <span class="price">₹ 120</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kspecial/dalkheer.jpg" alt="Channa Dal Kheer" class="product-img">
                    <h2 class="product-title">Channa Dal Kheer</h2>
                    <span class="price">₹ 60</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kspecial/phenori.jpg" alt="Phenori" class="product-img">
                    <h2 class="product-title">Phenori</h2>
                    <span class="price">₹ 50</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/kspecial/malpua.jpg" alt="Malpoe" class="product-img">
                    <h2 class="product-title">Malpoe</h2>
                    <span class="price">₹ 85</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/kspecial/sundal.jpg" alt="Sundal" class="product-img">
                    <h2 class="product-title">Sundal</h2>
                    <span class="price">₹ 65</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
            </div>

        <br>
        <h3>Thali Feasts</h3>
        <div class="rounded-lg h-64 overflow-hidden">
            <img alt="content" class="object-cover object-center h-full w-full" src="menuimg/thali.jpg">
        </div>
        <br>
        <p class="leading-relaxed text-base">This restaurant offers a variety of Veg Thali, Ravana Thali, Non-veg Thali, Bangda Thali, chicken Thali, Egg Thali etc.</p>
        <br>
        <div class="shop-content">
            <!--BOX 1-->
                <div class="product-box">
                    <img src="menuimg/thali/vegthali.jpg" alt="Veg Thali" class="product-img">
                    <h2 class="product-title">Veg Thali</h2>
                    <span class="price">₹ 180</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/thali/crabthali.jpg" alt="Crab Thali" class="product-img">
                    <h2 class="product-title">Crab Thali</h2>
                    <span class="price">₹ 290</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/thali/muttonthali.jpg" alt="Mutton Thali" class="product-img">
                    <h2 class="product-title">Mutton Thali</h2>
                    <span class="price">₹ 320</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/thali/chickenthali.jpg" alt="Chicken Thali" class="product-img">
                    <h2 class="product-title">Chicken Thali</h2>
                    <span class="price">₹ 290</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/thali/ravana thali.jpg" alt="Ravnana Thali" class="product-img">
                    <h2 class="product-title">Ravnana Thali</h2>
                    <span class="price">₹ 350</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/thali/eggthali.jpg" alt="Anda Thali" class="product-img">
                    <h2 class="product-title">Anda Thali</h2>
                    <span class="price">₹ 210</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/thali/bangdathali.jpg" alt="Bangda / Surmai Thali" class="product-img">
                    <h2 class="product-title">Bangda / Surmai Thali</h2>
                    <span class="price">₹ 240</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/thali/upavasthali.jpg" alt="Upavas Thali" class="product-img">
                    <h2 class="product-title">Upavas Thali</h2>
                    <span class="price">₹ 150</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
            </div>

        <br>
        <h3>Chinese Menu</h3>
        <div class="rounded-lg h-64 overflow-hidden">
            <img alt="content" class="object-cover object-center h-full w-full" src="menuimg/chinese.jpg">
        </div>
        <br>
        <p class="leading-relaxed text-base">This restaurant offers a variety of pithala bhakri, malvani kalavatana usal, Anda masal, anda curry, 
            crab curry rice etc.</p>
            <br>
            <div class="shop-content">
                <!--BOX 1-->
                    <div class="product-box">
                        <img src="menuimg/chinese/soup.jpg" alt="Soup Special" class="product-img">
                        <h2 class="product-title">Soup Special</h2>
                        <span class="price">₹ 150</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
        
                    <div class="product-box">
                        <img src="menuimg/chinese/gravy.jpg" alt="Manchurian Fry / Gravy" class="product-img">
                        <h2 class="product-title">Manchurian Fry / Gravy</h2>
                        <span class="price">₹ 120</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
        
                    <div class="product-box">
                        <img src="menuimg/chinese/rice.jpg" alt="Triple Schezwan Rice" class="product-img">
                        <h2 class="product-title">Triple Schezwan Rice</h2>
                        <span class="price">₹ 130</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
        
                    <div class="product-box">
                        <img src="menuimg/chinese/hakkanoodles.jpg" alt="Hakka Noodles" class="product-img">
                        <h2 class="product-title">Hakka Noodles</h2>
                        <span class="price">₹ 120</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
        
                    <div class="product-box">
                        <img src="menuimg/chinese/chilly.jpg" alt="Paneer Chilly" class="product-img">
                        <h2 class="product-title">Paneer Chilly</h2>
                        <span class="price">₹ 145</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
        
                    <div class="product-box">
                        <img src="menuimg/chinese/frice.jpg" alt="Fried Rice" class="product-img">
                        <h2 class="product-title">Fried Rice</h2>
                        <span class="price">₹ 140</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>

                    <div class="product-box">
                        <img src="menuimg/chinese/springrolls.jpg" alt="Spring rolls" class="product-img">
                        <h2 class="product-title">Spring rolls</h2>
                        <span class="price">₹ 150</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
    
                    <div class="product-box">
                        <img src="menuimg/chinese/mchilly.jpg" alt="Manchurian Chilly" class="product-img">
                        <h2 class="product-title">Manchurian Chilly</h2>
                        <span class="price">₹ 130</span>
                        <i class="bx bx-shopping-bag add-cart"></i>
                    </div>
                </div>
        
        <br>
        <h3>Kokani Mornings</h3>
        <div class="rounded-lg h-64 overflow-hidden">
            <img alt="content" class="object-cover object-center h-full w-full" src="menuimg/kokanim.jpg">
        </div>
        <br>
        <p class="leading-relaxed text-base">This restaurant offers a variety of Amboli, Anda curry Pav, Egg bhurji Pav, Malwani Poha, Kaal Watana Usal Pav, etc.</p>
        <br>
        <div class="shop-content">
            <!--BOX 1-->
                <div class="product-box">
                    <img src="menuimg/kmorning/RavaUpma.jpg" alt="Rava Upma" class="product-img">
                    <h2 class="product-title">Rava Upma</h2>
                    <span class="price">₹ 80</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kmorning/pooribhaji.jpg" alt="Poori Bhaji" class="product-img">
                    <h2 class="product-title">Poori Bhaji</h2>
                    <span class="price">₹ 120</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kmorning/sandhan.jpg" alt="Sandhan" class="product-img">
                    <h2 class="product-title">Sandhan</h2>
                    <span class="price">₹ 95</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kmorning/dalappe.jpg" alt="Dal Appe" class="product-img">
                    <h2 class="product-title">Dal Appe</h2>
                    <span class="price">₹ 120</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kmorning/aluwadi.jpg" alt="Alu Wadi" class="product-img">
                    <h2 class="product-title">Alu Wadi</h2>
                    <span class="price">₹ 100</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/kmorning/poharassa.jpeg" alt="Kande Poha rasa" class="product-img">
                    <h2 class="product-title">Kande Poha rasa</h2>
                    <span class="price">₹ 80</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/kmorning/sheera.jpg" alt="Goda Sheera" class="product-img">
                    <h2 class="product-title">Goda Sheera</h2>
                    <span class="price">₹ 90</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/kmorning/thalipeeth.jpg" alt="Thalipeetha" class="product-img">
                    <h2 class="product-title">Thalipeetha</h2>
                    <span class="price">₹ 70</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
            </div>
        <br>

        <br>
        <h3>Vegan Dishes</h3>
        <div class="rounded-lg h-64 overflow-hidden">
            <img alt="content" class="object-cover object-center h-full w-full" src="menuimg/veg.jpg">
        </div>
        <br>
		<p class="leading-relaxed text-base">This restaurant offers a variety of veg Kolhapuri,panner masala,veg thikka,channa masala,veg biryani, etc.</p>
        <br>
        <div class="shop-content">
            <!--BOX 1-->
                <div class="product-box">
                    <img src="menuimg/vegan/vegbiryani.jpg" alt="Veg Biryani" class="product-img">
                    <h2 class="product-title">Veg Biryani</h2>
                    <span class="price">₹ 280</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/vegan/vegkolhapuri.jpg" alt="Veg Kolhapuri" class="product-img">
                    <h2 class="product-title">Veg Kolhapuri</h2>
                    <span class="price">₹ 170</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/vegan/veghandi.jpg" alt="Veg Handi" class="product-img">
                    <h2 class="product-title">Veg Handi</h2>
                    <span class="price">₹ 180</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/vegan/roti.jpg" alt="Roti / Naan" class="product-img">
                    <h2 class="product-title">Roti / Naan</h2>
                    <span class="price">₹ 12</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/vegan/jeerarice.jpg" alt="Jeera Rice" class="product-img">
                    <h2 class="product-title">Jeera Rice</h2>
                    <span class="price">₹ 120</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
    
                <div class="product-box">
                    <img src="menuimg/vegan/daltadka.jpg" alt="Dal Tadka" class="product-img">
                    <h2 class="product-title">Dal Tadka</h2>
                    <span class="price">₹ 150</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/vegan/dalkhichadi.jpg" alt="Dal Khichadi" class="product-img">
                    <h2 class="product-title">Dal Khichadi</h2>
                    <span class="price">₹ 210</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>

                <div class="product-box">
                    <img src="menuimg/vegan/paneer.jpg" alt="Paneer special" class="product-img">
                    <h2 class="product-title">Paneer special</h2>
                    <span class="price">₹ 230</span>
                    <i class="bx bx-shopping-bag add-cart"></i>
                </div>
            </div>
	</section>

	<!--LINK FOR JS-->
	<div id="search-result"></div>
	<script>
	var loader = document.getElementById("preloader");
	window.addEventListener("load", function() {
		loader.style.display = "none"
	})
	</script>
	<script src="js\cart-page.js">
	</script>

</body>
</html>