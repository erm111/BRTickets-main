<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Brtickets</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <style>
        .text-primary {
            color: #64BAF3 !important;
        }

        .btn-primary {
            color: rgb(255, 255, 255);
            background-color: #64BAF3 !important;
            border-color: #64BAF3 !important;
        }

        a {
            color: #64BAF3;
            text-decoration: none;
        }

        #faq{
            padding: 8vw 20vw 0vw 20vw;
            margin-bottom: 8vw;
        }
        
        .accordion {
            background-color: #eee;
            color: #444;
            font-size: 20px;
            font-weight: 400;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            padding: 2rem;
            text-align: left;
            border: none;
            border-radius: 5px;
            outline: none;
            transition: 0.4s;
            margin-top: 1rem;
        
          }
          
          /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
          .accordion.active, .accordion:hover {
            background-color: #ccc;
          }
          
          /* Style the accordion panel. Note: hidden by default */
          
        
          .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
          }
        
          .panel p{
            font-size: 20px;
            margin: 10px;
            text-align: justify;
          }
          
          .accordion:after {
            content: '\02795'; /* Unicode character for "plus" sign (+) */
            font-size: 13px;
            color: #777;
            float: right;
            margin-left: 5px;
          }
          
          .accordion.active:after {
            content: "\2796"; /* Unicode character for "minus" sign (-) */
          }
    </style>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid topbar bg-secondary d-none d-xl-block w-100">
            <div class="container">
                <div class="row gx-0 align-items-center" style="height: 45px;">
                    <div class="col-lg-6 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <a href="#" class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Check Bus Stops</a>
                            <a href="tel:+01234567890" class="text-muted me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                            <a href="mailto:example@gmail.com" class="text-muted me-0"><i class="fas fa-envelope text-primary me-2"></i>support@brt-tickets.com</a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end">
                        <div class="d-flex align-items-center justify-content-end">
                            <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-light btn-sm-square rounded-circle me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-light btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <?php include 'header.php'; ?>

        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Frequently Asked Questions</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">FAQS</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <section id="faq" data-aos="fade-up" data-aos-delay="200">
            <h4>Frequently Asked Questions about BRTickets</h4>
            <button class="accordion" data-aos="fade-right" data-aos-delay="200">What is BRTickets?</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur nulla, sapiente sit molestiae eius distinctio dolore dolorem officia ipsum eum omnis reprehenderit quam eligendi necessitatibus totam ad asperiores consequatur optio!</p>
            </div>
        
            <button class="accordion" data-aos="fade-left" data-aos-delay="200">What support services does BRTickets offer?</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, labore esse necessitatibus itaque dolorum iure quidem quibusdam magni consequatur? Quo aliquid iusto sapiente tempore blanditiis explicabo corrupti neque rerum fugiat.</p>
            </div>
        
            <button class="accordion" data-aos="fade-right" data-aos-delay="200">What types of products can I find on your platform?</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim et repudiandae voluptate modi totam. Adipisci hic cum beatae cumque magni. Repudiandae sequi voluptas explicabo. Officia maiores repellendus cumque ipsum deserunt.</p>
            </div>
        
            <button class="accordion" data-aos="fade-left" data-aos-delay="200">How do I create an account on BRTickets?</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi blanditiis cupiditate quisquam sint libero odit nisi dolorum sapiente quae nobis sunt voluptatem sit nihil distinctio, accusamus, magnam quod autem eaque?</p>
            </div>
        
            <button class="accordion" data-aos="fade-right" data-aos-delay="200">How do I contact a manufacturer?</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, nobis nam officia velit quaerat, quae sint commodi ratione quia soluta rem voluptatibus nesciunt amet, praesentium repellendus illum? Consequatur, nobis maxime?</p>
            </div>
        
            <button class="accordion" data-aos="fade-left" data-aos-delay="200">How can I stay informed about new arrivals on your platform?</button>
            <div class="panel">
                <p><ul>
                    <li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita aspernatur fuga voluptates suscipit similique explicabo atque, laboriosam velit asperiores facere natus tenetur quidem sed beatae aliquid illum hic repellat. Commodi?</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere quos quae illum obcaecati, veniam incidunt nobis ducimus officiis recusandae repellat suscipit, magnam accusantium sunt, reiciendis sint quam facilis? Ratione, cumque.</li>
                </ul></p>
            </div>
        </section>
        
        

        <?php include 'footer.php'; ?>



        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
   
    <!-- Template Javascript -->
    <script>  var acc = document.getElementsByClassName("accordion");
       var i;
   
   for (i = 0; i < acc.length; i++) {
     acc[i].addEventListener("click", function() {
       this.classList.toggle("active");
       var panel = this.nextElementSibling;
       if (panel.style.maxHeight) {
         panel.style.maxHeight = null;
       } else {
         panel.style.maxHeight = panel.scrollHeight + "px";
       }
     });
   }
   
   menu = document.querySelector(".menu-btn")
   menu.onclick = function(){
       navbar = document.querySelector(".navigation")
       navbar.classList.toggle("active")
   }
   
   
   function myFunction(){
       document.getElementById("myDropdown").classList.toggle("show");
   }
     
     // Close the dropdown if the user clicks outside of it
     window.onclick = function(event) {
       if (!event.target.matches('.dropbtn')) {
         var dropdowns = document.getElementsByClassName("dropdown-content");
         var i;
         for (i = 0; i < dropdowns.length; i++) {
           var openDropdown = dropdowns[i];
           if (openDropdown.classList.contains('show')) {
             openDropdown.classList.remove('show');
           }
         }
       }
     }
   
   </script>
   <script src="js/main.js"></script>
   
   
     <script>
       AOS.init()({
               // Custom settings:
               duration: 800, // values from 0 to 3000, with step 50ms
               easing: 'ease-in-out-quart', // default easing for AOS animations
               once: true, // whether animation should happen only once - while scrolling down
               mirror: false, // whether elements should animate out while scrolling past them
           });
     </script>
    </body>

</html>