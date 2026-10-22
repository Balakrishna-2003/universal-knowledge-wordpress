<?php
$page_slug = get_post_field('post_name', get_queried_object_id());

switch ($page_slug) {
    case 'e-letter':
        ?>
            <!-- =========================================================
         E-LETTERS BANNER / HERO SECTION
         (Matches index.html showcase hero layout)
    ========================================================== -->
    <section class="ukt-hero-showcase">
        <div class="ukt-hero-slide-layout">
            <div class="container-fluid">
                <div class="row g-0 align-items-stretch">

                    <!-- LEFT CONTENT AREA -->
                    <div class="col-lg-5 d-flex align-items-center">
                        <div class="ukt-hero-copy-zone">
                            <div class="ukt-hero-left-decoration"></div>

                            <div class="ukt-hero-slide-kicker">
                                Universal Knowledge Trust
                            </div>

                            <h1 class="ukt-hero-main-title">
                                <span>Stories, Activities</span>
                                <span>&amp; Updates</span>
                            </h1>

                            <div class="ukt-hero-script-line">
                                From Universal Knowledge
                            </div>

                            <p class="ukt-hero-description">
                                Stay connected with the work of Universal Knowledge Trust through our monthly and periodic E-Letters. Explore our activities, programs, initiatives, events and community updates.
                            </p>

                            <div class="ukt-hero-action-row">
                                <a href="#e-letters" class="ukt-hero-primary-action">
                                    Explore E-Letters
                                    <i class="bi bi-arrow-down"></i>
                                </a>

                                <a href="<?php echo home_url('/about-us');?>" class="ukt-hero-secondary-action">
                                    About Us
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT IMAGE AREA -->
                    <div class="col-lg-7">
                        <div class="ukt-hero-visual-zone">
                            <div class="ukt-hero-image-frame">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/e-letters-banner.jpg"
                                    alt="Universal Knowledge Trust E-Letters - Stories, Activities & Updates"
                                    title="Stories, Activities & Updates from Universal Knowledge"
                                    loading="eager">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
        <?php
        break;
    case 'inspirational-videos':
        ?>
        <!-- =========================================================
         INSPIRATIONAL VIDEOS HERO SHOWCASE SECTION
         (Matches index.html showcase hero layout)
    ========================================================== -->
    <section class="ukt-hero-showcase">
        <div class="ukt-hero-slide-layout">
            <div class="container-fluid">
                <div class="row g-0 align-items-stretch">

                    <!-- LEFT CONTENT AREA -->
                    <div class="col-lg-5 d-flex align-items-center">
                        <div class="ukt-hero-copy-zone">
                            <div class="ukt-hero-left-decoration"></div>

                            <div class="ukt-hero-slide-kicker">
                                Universal Knowledge Trust
                            </div>

                            <h1 class="ukt-hero-main-title">
                                <span>Moments of Wisdom,</span>
                                <span>Positivity &amp; Growth</span>
                            </h1>

                            <div class="ukt-hero-script-line">
                                Inspirational Talks &amp; Videos
                            </div>

                            <p class="ukt-hero-description">
                                Explore inspirational talks, healing insights, spiritual reflections, life lessons and positive messages from Universal Knowledge Trust.
                            </p>

                            <div class="ukt-hero-action-row">
                                <a href="#videos" class="ukt-hero-primary-action">
                                    Watch Videos
                                    <i class="bi bi-arrow-down"></i>
                                </a>

                                <a href="<?php echo home_url('/about-us');?>" class="ukt-hero-secondary-action">
                                    About Us
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT IMAGE AREA -->
                    <div class="col-lg-7">
                        <div class="ukt-hero-visual-zone">
                            <div class="ukt-hero-image-frame">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/universal-knowledge-universal-talks.jpg"
                                    alt="Universal Knowledge Trust Inspirational Videos - Moments of wisdom, positivity and inner growth"
                                    title="Inspirational Videos from Universal Knowledge Trust"
                                    loading="eager">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
        <?php
        break;
    case 'books-and-articles':
        ?>
        <!-- =========================================================
         BOOKS & ARTICLES BANNER / HERO SECTION
         (Matches index.html showcase hero layout)
    ========================================================== -->
        <section class="ukt-hero-showcase">
            <div class="ukt-hero-slide-layout">
                <div class="container-fluid">
                    <div class="row g-0 align-items-stretch">

                        <!-- LEFT CONTENT AREA -->
                        <div class="col-lg-5 d-flex align-items-center">
                            <div class="ukt-hero-copy-zone">
                                <div class="ukt-hero-left-decoration"></div>

                                <div class="ukt-hero-slide-kicker">
                                    Books & Articles
                                </div>

                                <h1 class="ukt-hero-main-title">
                                    Explore Wisdom for a Meaningful Journey
                                </h1>

                                <div class="ukt-hero-script-line">
                                    Explore Knowledge, Find Meaning
                                </div>

                                <p class="ukt-hero-description">
                                    Discover books, articles and carefully selected resources related to positive
                                    living, spiritual growth, healing, nature and personal development.
                                </p>

                                <div class="ukt-hero-action-row">
                                    <a href="#books-articles" class="ukt-hero-primary-action">
                                        Explore Books
                                        <i class="bi bi-arrow-down"></i>
                                    </a>
                                    <a href="#articles" class="ukt-hero-secondary-action">
                                        Read Articles
                                        <i class="bi bi-newspaper ms-1"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <!-- RIGHT IMAGE AREA -->
                        <div class="col-lg-7">
                            <div class="ukt-hero-visual-zone">
                                <div class="ukt-hero-image-frame">
                                    <img src="<?php  echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles-banner.jpg"
                                        alt="Books &amp; Articles - Universal Knowledge Trust"
                                        title="Books &amp; Articles - Universal Knowledge Trust" loading="eager">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <?php
        break;
    
    case 'press-release':
        ?>
        <!-- =========================================================
             PRESS RELEASE BANNER / HERO SECTION
             (Matches index.html showcase hero layout & spacing)
        ========================================================== -->
    <section class="ukt-hero-showcase">
        <div class="ukt-hero-carousel-shell">
            <div class="carousel-inner">
                <div class="carousel-item active ukt-hero-carousel-item">
                    <div class="ukt-hero-slide-layout">
                        <div class="container-fluid">
                            <div class="row g-0 align-items-stretch">

                                <!-- LEFT CONTENT AREA -->
                                <div class="col-lg-5 d-flex align-items-center">
                                    <div class="ukt-hero-copy-zone">
                                        <div class="ukt-hero-left-decoration"></div>

                                        <div class="ukt-hero-slide-kicker">
                                            <i class="bi bi-newspaper me-1 ukt-text-green"></i>
                                            Universal Knowledge Trust • Media &amp; News
                                        </div>

                                        <h1 class="ukt-hero-main-title">
                                            <span>Press Releases</span>
                                        </h1>

                                        <div class="ukt-hero-script-line">
                                            Media Coverage · Press Releases
                                        </div>

                                        <p class="ukt-hero-description">
                                            Stay informed with official press releases, news features, media
                                            coverage, and public announcements showcasing Universal Knowledge
                                            Trust&rsquo;s mission of service, spiritual growth, free healing
                                            initiatives, and educational training programs.
                                        </p>

                                        <div class="ukt-hero-action-row">
                                            <a href="#latest-news" class="ukt-hero-primary-action">
                                                Read Latest News
                                                <i class="bi bi-newspaper"></i>
                                            </a>
                                            <a href="#articles"
                                                rel="noopener" class="ukt-hero-secondary-action">
                                                <i class="bi bi-envelope-fill me-1"></i> Media Inquiries
                                            </a>
                                        </div>

                                    </div>
                                </div>

                                <!-- RIGHT IMAGE AREA -->
                                <div class="col-lg-7">
                                    <div class="ukt-hero-visual-zone">
                                        <div class="ukt-hero-image-frame">
                                            <figure class="ukt-hero-image-figure">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/press-release-banner.jpg"
                                                    alt="Press Releases &amp; Media Coverage - Universal Knowledge Trust"
                                                    loading="eager">
                                                <figcaption class="visually-hidden">Press Releases &amp; Media
                                                    Coverage Hero Banner</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        break;

    case 'reviews-on-website':
        ?>
        <!-- =========================================================
         PRESS RELEASE BANNER / HERO SECTION
    ========================================================== -->
    <section class="ukt-hero-showcase">
        <div class="ukt-hero-carousel-shell">
            <div class="carousel-inner">
                <div class="carousel-item active ukt-hero-carousel-item">
                    <div class="ukt-hero-slide-layout">
                        <div class="container-fluid">
                            <div class="row g-0 align-items-stretch">

                                <!-- LEFT CONTENT AREA -->
                                <div class="col-lg-6 col-xl-5 d-flex align-items-center">
                                    <div class="ukt-hero-copy-zone">
                                        <div class="ukt-hero-left-decoration"></div>

                                        <div class="ukt-hero-slide-kicker">
                                            <i class="bi bi-chat-quote-fill me-1 ukt-text-green"></i>
                                            Universal Knowledge Trust • Reviews &amp; Testimonials
                                        </div>

                                        <h1 class="ukt-hero-main-title">
                                            <span>Reviews on</span>
                                            <span>Website</span>
                                        </h1>

                                        <div class="ukt-hero-script-line">
                                            Voices of Transformation · Real Experiences
                                        </div>

                                        <p class="ukt-hero-description">
                                            Read inspiring testimonials and heartfelt experiences shared by seekers,
                                            parents, educators, and participants whose lives have been deeply
                                            touched by Universal Knowledge Trust's healing sessions, workshops, and
                                            spiritual guidance.
                                        </p>

                                        <div class="ukt-hero-action-row">
                                            <a href="#reviews" class="ukt-hero-primary-action">
                                                Read Reviews
                                                <i class="bi bi-arrow-down-circle"></i>
                                            </a>
                                            <a href="#submit-review" class="ukt-hero-secondary-action">
                                                <i class="bi bi-chat-dots-fill me-1"></i> Share Your Review
                                            </a>
                                        </div>

                                    </div>
                                </div>

                                <!-- RIGHT IMAGE AREA -->
                                <div class="col-lg-6 col-xl-7">
                                    <div class="ukt-hero-visual-zone">
                                        <div class="ukt-hero-image-frame">
                                            <figure class="ukt-figure-fill">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/reviews-on-website-banner.jpg"
                                                    alt="Reviews on Website - Universal Knowledge Trust - Voices of Transformation"
                                                    loading="eager">
                                                <figcaption class="visually-hidden">Reviews on Website - Universal
                                                    Knowledge Trust Hero Banner</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        break;
    
    case 'video-testimonials':
        ?>
        <!-- =========================================================
             PROGRAM TESTIMONIALS BANNER / HERO SECTION
             (Matches index.html showcase hero layout & spacing)
        ========================================================== -->
        <section class="ukt-hero-showcase">
            <div class="ukt-hero-carousel-shell">
                <div class="carousel-inner">
                    <div class="carousel-item active ukt-hero-carousel-item">
                        <div class="ukt-hero-slide-layout">
                            <div class="container-fluid">
                                <div class="row g-0 align-items-stretch">

                                    <!-- LEFT CONTENT AREA -->
                                    <div class="col-lg-6 col-xl-5 d-flex align-items-center">
                                        <div class="ukt-hero-copy-zone">
                                            <div class="ukt-hero-left-decoration"></div>

                                            <div class="ukt-hero-slide-kicker">
                                                <i class="bi bi-camera-reels-fill me-1 ukt-text-green"></i>
                                                Universal Knowledge Trust • Video Testimonials
                                            </div>

                                            <h1 class="ukt-hero-main-title">
                                                <span>Video</span>
                                                <span>Testimonials</span>
                                            </h1>

                                            <div class="ukt-hero-script-line">
                                                Voices of Transformation · Real Experiences
                                            </div>

                                            <p class="ukt-hero-description">
                                                Watch inspiring video testimonials, participant reflections, and heartfelt retreat feedback shared by seekers whose lives have been deeply transformed through Universal Knowledge Trust.
                                            </p>

                                            <!-- <div class="ukt-hero-action-row">
                                                <a href="#inner-growth-2023" class="ukt-hero-primary-action">
                                                    Watch Testimonials
                                                    <i class="bi bi-play-circle ms-1"></i>
                                                </a>
                                                <a href="#uk-retreat-2022" class="ukt-hero-secondary-action">
                                                    <i class="bi bi-collection-play me-1"></i> Explore Series
                                                </a>
                                            </div> -->

                                        </div>
                                    </div>

                                    <!-- RIGHT IMAGE AREA -->
                                    <div class="col-lg-6 col-xl-7">
                                        <div class="ukt-hero-visual-zone">
                                            <div class="ukt-hero-image-frame">
                                                <figure class="ukt-figure-fill">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/video-testimonials-banner.jpg"
                                                        alt="Video Testimonials - Universal Knowledge Trust - Voices of Transformation"
                                                        loading="eager">
                                                    <figcaption class="visually-hidden">Video Testimonials - Universal Knowledge Trust Hero Banner</figcaption>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        break;
    
    default:
        # code...
        break;
}
?>