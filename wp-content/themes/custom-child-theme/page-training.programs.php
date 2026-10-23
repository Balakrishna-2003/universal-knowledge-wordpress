<?php
    /*Template Name: Training Programs Template */
    get_header();
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1, // Use -1 to show all posts, or a number like 10
        'category_name'  => 'training-programs', // The slug of the parent category
        'post_status'    => 'publish',
    );
    $posts = new WP_Query($args);
    ?>
    <article>

        <?php get_template_part('page-banners');?>
        <!-- =========================================================
             SECTION: INTRO OVERVIEW
        ========================================================== -->
        <section class="py-5 ukt-program-section-white">
            <div class="container py-lg-4">

                <!-- SECTION HEADER -->
                <div class="ukt-section-header mb-5">
                    <div class="ukt-section-eyebrow">
                        <span></span>
                        DAILY LIFE BETTERMENT
                        <span></span>
                    </div>
                    <h2 class="ukt-section-main-title ukt-program-title-teal">
                        Techniques for <span>Betterment in Daily Life</span>
                    </h2>
                    <div class="ukt-section-heading-design">
                        <span></span>
                        <i class="bi bi-flower1"></i>
                        <span></span>
                    </div>
                </div>

                <div class="row align-items-center g-4 g-lg-5">
                    
                    <!-- LEFT: IMAGE WITH UNIQUE ARCHITECTURAL FRAME -->
                    <div class="col-lg-5">
                        <div class="ukt-program-feature-outer">
                            <div class="ukt-program-feature-inner">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/universal-knowledge-trust-training-programs-intro-img.jpg"
                                     alt="Universal Knowledge Trust Training Programs"
                                     class="ukt-program-feature-img">
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: CONTENT PANEL -->
                    <div class="col-lg-7">
                        <div class="ukt-program-hero-card">
                            <p class="ukt-program-hero-lead">
                                For many years, trainers of Universal Knowledge Trust have mastered and perfected the techniques of betterment in daily life which is easy for children to grasp. Trainers will provide training on various simple easy unique techniques to schools in order to perform better than before from Day 1 of the training. This one or 4 day programme can bring great results immediately and the details of which are as mentioned in the brochure below.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- =========================================================
             SECTION: TRAINING IN SCHOOLS
        ========================================================== -->
        <section id="training-in-schools" class="py-5 ukt-program-section-slate">
            <div class="container py-lg-4">

                <!-- SECTION HEADER -->
                <div class="ukt-section-header mb-5">
                    <div class="ukt-section-eyebrow">
                        <span></span>
                        EDUCATION &amp; YOUTH
                        <span></span>
                    </div>
                    <h2 class="ukt-section-main-title ukt-program-title-teal">
                        Training in <span>Schools</span>
                    </h2>
                    <div class="ukt-section-heading-design">
                        <span></span>
                        <i class="bi bi-flower1"></i>
                        <span></span>
                    </div>
                </div>

                <div class="row g-4 g-lg-5 align-items-start">

                    <!-- LEFT COLUMN: CONTENT & TECHNIQUES & CONNECT -->
                    <div class="col-lg-8">
                        <div class="ukt-program-block-card">
                            
                            <!-- INTRO CONTENT PARAGRAPHS -->
                            <div class="ukt-program-block-body">
                                <p class="ukt-program-p-mb-20">
                                    Trainers from Universal Knowledge will train your Students to make them understand subjects easily to score very good marks in their Academic career. This program will help students to balance their brain and excel with their own in-born talent using the ancient methods written in the book <strong class="ukt-text-teal-dark">“Learning made easy with Positive Energy”</strong> authored by <strong class="ukt-text-teal-dark">Master Rohan M. Shiri</strong>.
                                </p>
                                <p class="ukt-program-p-mb-25">
                                    The training will help students to build their positive energy and increase their brain capacity by practicing simple techniques taught in the training program. Universal knowledge team has been training students since 2018 and this has helped many students to score very high marks and also build their talents and excel in the same by practicing. Many Schools where the programs were conducted have achieved 100% results in their academic year.
                                </p>
                            </div>

                            <!-- TECHNIQUES TAUGHT SECTION -->
                            <div class="mt-4 pt-4 ukt-program-topics-wrap">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="ukt-program-topics-icon">
                                        <i class="bi bi-stars"></i>
                                    </span>
                                    <h3 class="ukt-program-topics-title">
                                        TECHNIQUES TAUGHT
                                    </h3>
                                </div>

                                <!-- TECHNIQUES BADGES/PILLS -->
                                <div class="d-flex flex-wrap gap-2 pt-1 mb-4">
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> BRAIN BALANCE
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> SUPER BRAIN YOGA
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> OBTAIN KNOWLEDGE
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> CUTTING UNWANTED THOUGHTS
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> KEEPING BODY FIT
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> IMPORTANCE OF TRUTH
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> BREATHING
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> WHITE LIGHT PROTECTION
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> SCANNING
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> FORGIVENESS
                                    </span>
                                </div>
                            </div>

                            <!-- CONNECT NOTE / CALLOUT -->
                            <div class="p-3 p-md-4 mt-3 ukt-program-cta-banner">
                                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                    <div class="d-flex align-items-start gap-3">
                                        <i class="bi bi-info-circle-fill ukt-program-cta-icon"></i>
                                        <p class="ukt-program-cta-text">
                                            If any schools or corporations would like to know more about the program then they can connect with Universal Knowledge Trust Team.
                                        </p>
                                    </div>
                                    <a href="contact.html" class="ukt-program-cta-btn">
                                        Connect With Us <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT COLUMN: BROCHURE PDF DOWNLOAD CARD -->
                    <div class="col-lg-4">
                        <div class="ukt-program-brochure-card">
                            
                            <!-- BROCHURE COVER IMAGE -->
                            <figure class="ukt-program-brochure-thumb">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/brochure-pdf-cover-img-212x300.png" alt="Training in Schools Brochure Cover" class="ukt-program-brochure-img">
                                <figcaption class="visually-hidden">Training in Schools Brochure Cover</figcaption>
                            </figure>

                            <!-- BROCHURE INFO & DOWNLOAD BUTTON -->
                            <h4 class="ukt-program-brochure-title">
                                Program Brochure
                            </h4>
                            <p class="ukt-program-brochure-desc">
                                Learning Made Easy School Training Program
                            </p>

                            <div class="d-grid gap-2">
                                <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/training-in-schools-Brochers-1-1.pdf" target="_blank" rel="noopener noreferrer"
                                   class="ukt-program-btn-teal">
                                    <i class="bi bi-file-earmark-pdf-fill ukt-text-gold"></i> View Brochure (PDF)
                                </a>
                                <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/training-in-schools-Brochers-1-1.pdf" download="training-in-schools-brochure.pdf"
                                   class="ukt-program-cta-btn">
                                    <i class="bi bi-download ukt-program-topic-icon"></i> Download PDF
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>


        <!-- =========================================================
             SECTION: CORPORATE TRAINING
        ========================================================== -->
        <section id="corporate-training" class="py-5 ukt-program-section-white">
            <div class="container py-lg-4">

                <!-- SECTION HEADER -->
                <div class="ukt-section-header mb-5">
                    <div class="ukt-section-eyebrow">
                        <span></span>
                        ORGANIZATIONAL WELLNESS
                        <span></span>
                    </div>
                    <h2 class="ukt-section-main-title ukt-program-title-teal">
                        Corporate <span>Training</span>
                    </h2>
                    <div class="ukt-section-heading-design">
                        <span></span>
                        <i class="bi bi-flower1"></i>
                        <span></span>
                    </div>
                </div>

                <div class="row g-4 g-lg-5 align-items-start">

                    <!-- MAIN CONTENT & INSIDE BENEFITS -->
                    <div class="col-12">
                        <div class="ukt-program-block-card">
                            
                            <!-- INTRO CONTENT PARAGRAPHS -->
                            <div class="ukt-program-block-body">
                                <p class="ukt-program-p-mb-20">
                                    This program is specially Designed to increase Positivity. It will create a positive impact on the participant and also will change life’s direction forever. These basic and other advanced techniques are useful in the corporate environment to reduce boredom, depression, and negativity leading to better performances. They will regain lost energy and think Positively.
                                </p>
                                <p class="ukt-program-p-mb-25">
                                    Productivity of the Employees improves and Builds Confidence and helps Employees towards better Decisions Making Builds Teamwork by developing improved relationships. It will also help Employees to have a Healthy living and be able to give more productive hours while overcoming family issues, conflicts among each other, and other issues. They are able to Understand his/her own Mind and body power and be able to build their Spiritual Connections and Trustworthiness. relationships.
                                </p>
                            </div>

                            <!-- INSIDE BENEFITS SECTION -->
                            <div class="mt-4 pt-4 ukt-program-topics-wrap">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="ukt-program-topics-icon">
                                        <i class="bi bi-award-fill"></i>
                                    </span>
                                    <h3 class="ukt-program-topics-title">
                                        INSIDE BENEFITS
                                    </h3>
                                </div>

                                <p class="ukt-program-block-body ukt-program-p-mb-20">
                                    Helps in improving Creativity, Building new Ideas &amp; Technology. When the creative &amp; analytical brain works together new concepts and ideas are materialised. Builds Teamwork by developing improved relationships. Increases Productivity and Profits. Employee retention and long-term association, Positive minds, stable thinking, easy to train and creative employees with more affiliation to organisation.
                                </p>

                                <!-- BENEFITS PILLS -->
                                <div class="d-flex flex-wrap gap-2 pt-1 mb-2">
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Improving Creativity, Building New Ideas &amp; Technology
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Creative &amp; Analytical Brain Synergy
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Builds Teamwork &amp; Improved Relationships
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Increases Productivity &amp; Profits
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Employee Retention &amp; Long-term Association
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Positive Minds &amp; Stable Thinking
                                    </span>
                                    <span class="ukt-program-topic-pill">
                                        <i class="bi bi-check-circle-fill"></i> Easy to Train with Affiliation to Organisation
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>



                <!-- =========================================================
             SECTION: PAST PROGRAMS & ARTICLES (CAROUSEL)
        ========================================================== -->
        <section id="past-programs" class="py-5 ukt-past-programs-section">
            <div class="container py-lg-4">

                <!-- SECTION HEADER -->
                <div class="ukt-section-header mb-4">
                    <div class="ukt-section-eyebrow">
                        <span></span>
                        IMPACT &amp; ARCHIVES
                        <span></span>
                    </div>
                    <h2 class="ukt-section-main-title ukt-section-main-title-serif">
                        Past <span>Programs &amp; Articles</span>
                    </h2>
                    <div class="ukt-section-heading-design">
                        <span></span>
                        <i class="bi bi-flower1"></i>
                        <span></span>
                    </div>
                </div>

                <!-- INTRO PARAGRAPH -->
                <p class="text-center mx-auto mb-5 ukt-past-program-desc-p">
                    Past programs are as described in the links below where students and teachers benefited greatly from the sessions.
                </p>

                <!-- ARTICLES OWL CAROUSEL -->
                <div class="owl-carousel owl-theme ukt-past-programs-carousel">

                    <?php
                    

                    if ($posts->have_posts()) {
                        while ($posts->have_posts()) {
                            $posts->the_post();
                            $title = get_the_title();
                            $thumbnail_url = get_the_post_thumbnail_url();
                            
                            
                            
                            $categories = get_the_category();
                            $date = get_the_date('F j, Y');
                            $cat_count = 0;
                    ?>
                    <div class="item h-100 pb-2">
                        <article class="ukt-past-program-card">
                            <figure class="ukt-past-program-figure">
                                <img src="<?php echo $thumbnail_url;?>"
                                     alt="<?php echo $title; ?>"
                                     class="ukt-past-program-img">
                                <figcaption class="visually-hidden"><?php echo $title; ?></figcaption>
                            </figure>
                            <div class="ukt-past-program-body">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <?php
                                        $serial = 1;
                                        foreach ($categories as $category) {
                                            // echo esc_html($category->name);
                                            $cat_count += mb_strlen($category->name);
                                            if ($serial <= 3 && $cat_count <= 24) {
                                        ?>
                                                <a class="ukt-past-program-pill" href="<?php echo esc_url(get_category_link($category->term_id)) ?>"><?php echo $category->name; ?></a>
                                        <?php
                                                $serial++;
                                            } else {
                                                echo '<span>...<span>';
                                                break;
                                            }
                                        }
                                        ?>
                                    <!-- <span class="ukt-past-program-pill">Training</span>
                                    <span class="ukt-past-program-pill">School Children</span> -->
                                </div>
                                <h3 class="ukt-past-program-title">
                                    <a href="learning-made-easy-with-postive-energy.html">
                                        <?php echo $title; ?>
                                    </a>
                                </h3>
                                <div class="ukt-past-program-date">
                                    <?php echo $date; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php
                        }
                        wp_reset_postdata(); // Always reset post data after a custom query
                    } else {
                        echo '<p class="text-center w-100">No programs found.</p>';
                    }
                    ?>

                    <!-- STATIC FALLBACK CARDS (If you want to keep these, leave them here. Otherwise, delete them) -->
                    <!-- ARTICLE CARD 1 -->
                    <!-- <div class="item pb-2">
                        <article class="ukt-past-program-card">
                            <figure class="ukt-past-program-figure">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-1.jpg"
                                     alt="School Training Programs: Learning made easy with Positive Energy."
                                     class="ukt-past-program-img">
                            </figure>
                            <div class="ukt-past-program-body">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-past-program-pill">Training</span>
                                    <span class="ukt-past-program-pill">School Children</span>
                                </div>
                                <h3 class="ukt-past-program-title">
                                    <a href="learning-made-easy-with-postive-energy.html">
                                        School Training Programs: Learning made easy with Positive Energy.
                                    </a>
                                </h3>
                                <div class="ukt-past-program-date">August 18, 2026</div>
                            </div>
                        </article>
                    </div> -->

                    <!-- ARTICLE CARD 2 -->
                    <!-- <div class="item pb-2">
                        <article class="ukt-past-program-card">
                            <figure class="ukt-past-program-figure">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-6.jpg"
                                     alt="Out of the world SUMMER CAMP – Bengaluru"
                                     class="ukt-past-program-img">
                            </figure>
                            <div class="ukt-past-program-body">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-past-program-pill">Summer Camps</span>
                                    <span class="ukt-past-program-pill">Bengaluru</span>
                                </div>
                                <h3 class="ukt-past-program-title">
                                    Out of the world SUMMER CAMP – Bengaluru
                                </h3>
                                <div class="ukt-past-program-date">May 15, 2023</div>
                            </div>
                        </article>
                    </div> -->

                </div> <!-- END OF .owl-carousel -->

            </div>
        </section>

    </article>
            <!-- INITIALIZE PAST PROGRAMS CAROUSEL -->
        <script>
            jQuery(document).ready(function ($) {
                $(".ukt-past-programs-carousel").owlCarousel({
                    loop: false,
                    margin: 24,          // Space between cards
                    nav: true,           // Show Next/Prev arrows
                    dots: true,          // Show pagination dots
                    autoplay: true,      // Auto-slide
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    smartSpeed: 700,
                    responsive: {
                        0: {
                            items: 1     // 1 card on mobile
                        },
                        768: {
                            items: 2     // 2 cards on tablet
                        },
                        1200: {
                            items: 3     // 3 cards on desktop
                        }
                    }
                });
            });
        </script>

<?php
get_footer();
?>