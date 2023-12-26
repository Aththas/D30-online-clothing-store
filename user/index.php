<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  
error_reporting(0);  
session_start(); 

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/D30.jpeg">
    <title>D30 Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <link href="css/index.css" rel="stylesheet"> 
    <link href="chatc.css" rel="stylesheet"> 
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0"
    />
   <style type="text/css">

   </style>
</head>

<body class="home">
        <?php 
            include('Header.php');
        ?>

          <!-- Hero Section  -->
  <section id="hero">
    <div class="hero containernew">
      <div>
        <h1>Welcome </h1>
        <h1>To </h1>
        <h1>D30 </h1>
        <a href="#" target="_blank" class="cta">Branded Products</a>
      </div>
    </div>
  </section>
  <!-- End Hero Section  -->

  <!-- Service Section -->
  <section id="services" >
    <div class="services containernew"> <!-- using another class with container class is if we need to overwrite the container class we can overwrite it using the other class-->

      <div class="service-top">
        <h1 class="section-title" style="font-size: 3rem; font-weight: bolder;"><span>s</span>e<span>r</span>v<span>i</span>c<span>e</span>s</h1>
        <p style="font-size: 1rem; line-height: 1.7rem;">We value excellence in support services and assure that faculty and staff governance is conducted in a thoughtful, constructive and innovative environment. We ensure all stakeholders act responsibly, creatively and collegially.</p>
      </div>

      <div class="service-bottom">

        <div class="service-item">
          <div class="icon">
            <img src="img/service1.png"/>
          </div>
          <h2 style="font-size: 1rem;">Continual Improvements</h2>
          <p style="font-size: 1rem; line-height: 1.7rem;">Committed to constant growth, we evolve to exceed your expectations in online fashion.</p>
        </div>

        <div class="service-item">
          <div class="icon">
            <img src="img/service2.png"/>
          </div>
          <h2 style="font-size: 1rem;">Rigorous learning</h2>
          <p style="font-size: 1rem; line-height: 1.7rem;">Continuous learning fuels our e-commerce clothing website's innovation and growth.</p>
        </div>

        <div class="service-item">
          <div class="icon">
            <img src="img/service3.png"/>
          </div>
          <h2 style="font-size: 1rem;">Excellent Standards</h2>
          <p style="font-size: 1rem; line-height: 1.7rem;">Pioneering excellence, we set the benchmark for superior quality and service in online fashion.</p>
        </div>

        <div class="service-item">
          <div class="icon">
            <img src="img/service4.png"/>
          </div>
          <h2 style="font-size: 1rem;">High standards of conduct</h2>
          <p style="font-size: 1rem; line-height: 1.7rem;">Exemplifying integrity and transparency in every transaction, we prioritize your trust.</p>
        </div>

      </div>
    </div>
  </section>
  <!-- End Service Section -->
      
      
	  
	
     
        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h1 class="section-title" style="font-size: 3rem; font-weight: bolder;">Latest <span>Products</span></h1>
                    <p class="lead">Easit way Get a Products via online</p>
                </div>
                <div class="row">
						<?php 					
						$query_res= mysqli_query($db,"select * from tbl_product order by product_id desc LIMIT 6"); 
                                while($r=mysqli_fetch_array($query_res))
                                {
                                        
                                    echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                                            <div class="food-item-wrap">
                                                <div class="figure-wrap bg-image" data-image-src="'.$r['product_image'].'"></div>
                                                <div class="content">
                                                    <h5><a href="view.php?res_id='.$r['product_id'].'">'.$r['product_name'].'</a></h5>
                                                    <div class="product-name">'.$r['description'].'</div>
                                                    <div class="price-btn-block"> <span class="price">'.$r['product_price'].'</span> <a href="view.php?res_id='.$r['product_id'].'" class="btn theme-btn-dash pull-right">Order Now</a> </div>
                                                </div>
                                                
                                            </div>
                                    </div>';                                      
                                }	
						?>
                </div>
            </div>
        </section>
 
        <!-- Project Section -->
  <section id="projects">
    <div class="projects containernew">
      <div class="projects-header">
       <h1 class="section-title" style="font-size: 3rem; font-weight: bolder;">Our <span>Categories</span></h1>
      </div>

      <div class="all-projects">
        <div class="project-item">
          <div class="project-info">
            <a href="shop.php">
            <h1 style="font-size: 2.5rem;">Men's Category</h1>
            <h2 style="font-size: 1.5rem;"><span>Empower Your Wardrobe, Shop with Distinction!</span></h2>
            <p style="font-size: 1rem; line-height: 1.5rem;">Experience a new level of sophistication in men's fashion with our exclusive e-commerce shopping platform. Our meticulously curated selection of clothing and accessories caters to the discerning modern man, offering a wide range of styles that blend classic elegance with contemporary flair. From tailored suits and crisp dress shirts for formal occasions to relaxed casual wear for everyday comfort, our collection is designed to enhance your personal style.Elevate your style with the finest in men's fashion. Discover a world of timeless elegance and modern trends at your fingertips. Unleash your inner gentleman, shop now!</p></a>
          </div>
          <div class="project-img"> 
               <img src="images/3.jpg" alt="img">
          </div>
        </div>

        <div class="project-item">
          <div class="project-info">
            <a href="shop.php">
            <h1 style="font-size: 2.5rem;">Women's Category</h1>
            <h2 style="font-size: 1.5rem;"><span>Elevate Your Style, Embrace Your Identity!</span></h2>
            <p style="font-size: 1rem; line-height: 1.5rem;">Indulge in the world of fashion at its finest with our women's e-commerce shopping platform. Our expansive collection of clothing and accessories is thoughtfully curated to cater to the diverse tastes and lifestyles of contemporary women. From elegant evening gowns to casual chic ensembles, we offer a comprehensive array of styles that empower you to express your individuality. We understand that every woman deserves clothing that not only fits perfectly but also makes her feel confident and beautiful. That's why we offer a wide range of sizes and a commitment to quality that ensures you get the best value for your fashion investment.</p></a>
          </div>
          <div class="project-img">
               <img src="images/1.jpg" alt="img">
          </div>
        </div>

        <div class="project-item">
          <div class="project-info">
            <a href="shop.php">
            <h1 style="font-size: 2.5rem;">Kid's Category</h1>
            <h2 style="font-size: 1.5rem;"><span>Where Little Dreams Shine Bright!</span></h2>
            <p style="font-size: 1rem; line-height: 1.5rem;">Embark on a delightful journey into the world of children's fashion with our dedicated e-commerce shopping platform. We've handpicked a whimsical collection of clothing and accessories designed to spark joy in the hearts of little ones and parents alike. From adorable and comfortable playwear to stylish outfits for special occasions, our selection covers all the bases to make your child feel like the superstar they are. We understand the importance of quality and safety when it comes to kids' clothing, which is why we prioritize materials that are soft, durable, and free from harmful substances. Our sizing options ensure a perfect fit, letting children move freely and comfortably.</p></a>
          </div>
          <div class="project-img">
               <img src="images/4.jpg" alt="img">
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php 
     include('chat.php');
     ?>
  <!-- End Project Section -->
     <?php 
     include('footer.php');
     ?>
    
    

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="script.js"></script>
</body>

</html>