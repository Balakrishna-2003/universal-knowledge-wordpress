<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <title><?php echo esc_html( get_the_title() ); ?> | Universal Knowledge Trust</title>
     <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">
    <meta name="theme-color" content="#27872e" >
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <!-- =========================================================
         GOOGLE FONTS
    ========================================================== -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">

     




      <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css">
      <?php wp_head(); ?>
</head>
<body>

<header class="ukt-header">


    <!-- =========================================================
         DESKTOP
    ========================================================== -->

    <div class="ukt-main-header">

        <div class="container-fluid px-xl-4">

            <div class="ukt-header-inner">


                <!-- LOGO -->

                <a
                    href="index.html"
                    class="ukt-logo"
                >

                        <img
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/universal-knowledge-trust-logo.png"
                        alt="Universal Knowledge Trust Logo"
                            class="ukt-logo-image"
                        >


                    <span class="ukt-logo-content">

                        <span class="ukt-logo-title">

                            UNIVERSAL<br>
                            KNOWLEDGE TRUST<sup>&reg;</sup>

                        </span>


                        <span class="ukt-logo-tagline">

                            Awaken · Transform · Serve

                        </span>

                    </span>

                </a>



                <!-- RIGHT SIDE -->

                <div class="ukt-header-actions">


                    <!-- PHONE -->

                    <a
                        href="tel:+919632171156"
                        class="ukt-contact-item"
                    >

                        <span class="ukt-contact-icon">

                            <i class="bi bi-telephone-fill"></i>

                        </span>


                        <span class="ukt-contact-content">

                            <span class="ukt-contact-label">
                                Call Us
                            </span>


                            <span class="ukt-contact-value">
                                  +91 96321 71156
                            </span>

                        </span>

                    </a>



                    <!-- EMAIL -->

                    <a
                        href="mailto:UniversalknowledgR@gmail.com"
                        class="ukt-contact-item"
                    >

                        <span class="ukt-contact-icon">

                            <i class="bi bi-envelope-fill"></i>

                        </span>


                        <span class="ukt-contact-content">

                            <span class="ukt-contact-label">
                                Email Us
                            </span>


                            <span class="ukt-contact-value">
                                UniversalknowledgR@gmail.com
                            </span>

                        </span>

                    </a>



                    <!-- MENU -->

                    <button
                        type="button"
                        class="ukt-menu-button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#uktOffcanvas"
                        aria-controls="uktOffcanvas"
                    >

                        <i class="bi bi-grid-3x3-gap"></i>

                        Menu

                    </button>


                </div>

            </div>

        </div>

    </div>



    <!-- =========================================================
         MOBILE HEADER
    ========================================================== -->

    <div class="ukt-mobile-header">

        <div class="container-fluid">

            <div
                class="d-flex
                       align-items-center
                       justify-content-between"
            >


                <a
                    href="index.html"
                    class="ukt-mobile-brand"
                >

                        <img
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/universal-knowledge-trust-logo.png"
                        alt="Universal Knowledge Trust"
                        >


                    <span class="ukt-mobile-brand-content">

                        <span class="ukt-mobile-brand-title">

                            Universal Knowledge Trust

                        </span>


                        <span class="ukt-mobile-brand-subtitle">

                            Awaken · Transform · Serve

                        </span>

                    </span>

                </a>



                <button
                    type="button"
                    class="ukt-mobile-menu-button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#uktOffcanvas"
                    aria-controls="uktOffcanvas"
                >

                    <i class="bi bi-list"></i>

                </button>


            </div>

        </div>

    </div>

</header>

