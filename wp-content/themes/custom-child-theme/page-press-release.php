<?php
/* Template Name: Press Release Template */
get_header();
?>
<article>
    <?php get_template_part('page-banners'); ?>

    <!-- =========================================================
             SECTION: LATEST NEWS (4 ARTICLES IN A ROW)
             (Uses exact same card design as #articles below)
        ========================================================== -->
    <section id="latest-news" class="py-5 ukt-section-press-news">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    MEDIA UPDATES &amp; PRESS
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-press-section-title">
                    Latest <span>News</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-flower1"></i>
                    <span></span>
                </div>
            </div>


            <!-- 4 ARTICLES IN A ROW GRID (col-xl-3 col-lg-3 col-md-6 col-12) -->
            <div class="row g-4">
                <?php
                // 1. Get the Parent Category ID
                $parent_cat = get_category_by_slug('press-release');
                $parent_id = $parent_cat ? $parent_cat->term_id : 0;

                if ($parent_id) {
                    // 2. Fetch ONLY the child categories
                    $child_categories = get_categories(array(
                        'parent' => $parent_id,
                        'hide_empty' => false, // Set to true if you only want categories with posts
                
                    ));
                    

                    foreach ($child_categories as $child) {

                        // echo '<h3>Category: ' . esc_html($child->name) . '</h3>'; // Category Title
                
                        // 3. Query posts for THIS specific child category
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 4,
                            'cat' => $child->term_id,
                        );

                        $child_posts = new WP_Query($args);
                        
                        
                        if ($child_posts->have_posts()) {
                            while ($child_posts->have_posts()) {
                                $child_posts->the_post();

                                $categories = get_the_category();
                                $title = get_the_title();
                                $content = wp_trim_words(get_the_content(), 22, '...');
                                $img_url = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : ' ';
                                $date = get_the_date('F j, Y');

                                ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                                    <article class="ukt-press-card">

                                        <!-- Cover Image Container -->
                                        <figure class="ukt-press-card-thumb">
                                            <img src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>">
                                            <figcaption class="visually-hidden"><?php echo $title; ?></figcaption>
                                        </figure>

                                        <!-- Card Body -->
                                        <div class="ukt-press-card-body">

                                            <!-- Category Pills -->
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <?php
                                                if (!empty($categories)) {
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <span class="ukt-press-badge"><?php echo esc_html($category->name); ?></span>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <!-- <span
                                        class="ukt-press-badge">Books</span>
                                    <span
                                        class="ukt-press-badge">Camps</span>
                                    <span
                                        class="ukt-press-badge">Programmes</span>
                                    <span
                                        class="ukt-press-badge">Training
                                        Programmes for School Children</span> -->
                                            </div>

                                            <!-- Title -->
                                            <h3 class="ukt-press-card-title">
                                                <?php echo $title; ?>
                                            </h3>

                                            <!-- Description -->
                                            <p class="ukt-press-card-desc">
                                                <?php echo $content; ?>
                                            </p>

                                            <!-- Date -->
                                            <div class="ukt-press-card-date">
                                                <?php echo $date; ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <?php
                            }

                            wp_reset_postdata();
                        } else {
                            echo '<p>No posts in this sub-category.</p>';
                        }
                    }
                }
                ?>

                <!-- ARTICLE CARD 1 -->
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-1.jpg"
                                alt="Training Programmes for School Children">
                            <figcaption class="visually-hidden">Training Programmes for School Children</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Books</span>
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Learning made easy with Positive Energy: 2 Lakh Children Trained
                            </h3>

                            <p class="ukt-press-card-desc">
                                For many years, trainers of Universalknowledge.in have mastered and perfected the
                                techniques of betterment in daily life which is easy for children to grasp. Trainers
                                provide training on various simple…
                            </p>

                            <div class="ukt-press-card-date">
                                August 18, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 2 -->
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-2.jpg"
                                alt="School Training Program News Article – Punch Tv Kolar">
                            <figcaption class="visually-hidden">School Training Program News Article – Punch Tv
                                Kolar</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Press
                                    Release</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                School Training Program News Article – Punch Tv Kolar
                            </h3>

                            <p class="ukt-press-card-desc">
                                <a href="https://youtu.be/ZE7_icro6_E?si=DojD5ev8hNyHRAAO" target="_blank"
                                    rel="noopener noreferrer"
                                    class="ukt-press-link">https://youtu.be/ZE7_icro6_E?si=DojD5ev8hNyHRAAO</a><br>
                                <a href="https://youtu.be/L7Sivd-H0_c?si=RaBgx3e8ebgm2ucu" target="_blank"
                                    rel="noopener noreferrer"
                                    class="ukt-press-link">https://youtu.be/L7Sivd-H0_c?si=RaBgx3e8ebgm2ucu</a>
                            </p>

                            <div class="ukt-press-card-date">
                                August 11, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 3 -->
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-3.jpg"
                                alt="Update – March 2024">
                            <figcaption class="visually-hidden">Update – March 2024</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Conclaves</span>
                                <span class="ukt-press-badge">Donation</span>
                                <span class="ukt-press-badge">Healing</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Update – March 2024
                            </h3>

                            <p class="ukt-press-card-desc">
                                Universal Knowledge Trust &#174; Krishna towers ladyhill Mangalore Score card March
                                2024 1) 50,000+ people are healed and are living a healthy life. 2) 65,000+ govt.
                                School children trained to…
                            </p>

                            <div class="ukt-press-card-date">
                                March 31, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 4 -->
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-4.jpg"
                                alt="Downloads for School Training Program">
                            <figcaption class="visually-hidden">Downloads for School Training Program</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Corporate
                                    Training</span>
                                <span class="ukt-press-badge">Downloads</span>
                                <span class="ukt-press-badge">Training</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Downloads for School Training Program
                            </h3>

                            <p class="ukt-press-card-desc">
                                TRAINING PROGRAM DETAILS and Submission Form This programme can bring great results
                                immediately and the details of which are as mentioned in the brochure below. Submit
                                your details if interested…
                            </p>

                            <div class="ukt-press-card-date">
                                February 14, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

            </div>

        </div>
    </section>


    <!-- =========================================================
             SECTION: ALL PRESS RELEASES & MEDIA ARTICLES
        ========================================================== -->
    <section id="articles" class="py-5 ukt-articles-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    MEDIA COVERAGE &amp; PRESS ARCHIVE
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-press-section-title">
                    Press Releases &amp; <span>Media Coverage</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-flower1"></i>
                    <span></span>
                </div>
            </div>
            <!-- ARTICLES GRID (3 COLUMNS) -->
            <div class="row g-4" id="pressArticlesGrid">
                <?php
                // 1. Get the Parent Category ID
                $parent_cat = get_category_by_slug('press-release');
                $parent_id = $parent_cat ? $parent_cat->term_id : 0;

                if ($parent_id) {
                    // 2. Fetch ONLY the child categories
                    $child_categories = get_categories(array(
                        'parent' => $parent_id,
                        'hide_empty' => false, // Set to true if you only want categories with posts
                
                    ));
                    

                    foreach ($child_categories as $child) {

                        // echo '<h3>Category: ' . esc_html($child->name) . '</h3>'; // Category Title
                
                        // 3. Query posts for THIS specific child category
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => -1,
                            'cat' => $child->term_id,
                        );

                        $child_posts = new WP_Query($args);
                        
                        
                        if ($child_posts->have_posts()) {
                            while ($child_posts->have_posts()) {
                                $child_posts->the_post();

                                $categories = get_the_category();
                                $title = get_the_title();
                                $content = wp_trim_words(get_the_content(), 32, '...');
                                $img_url = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : ' ';
                                $date = get_the_date('F j, Y');

                                ?>
                                

                    <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo $img_url; ?>"
                                alt="<?php echo $title;?>">
                            <figcaption class="visually-hidden"><?php echo $title;?></figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            ?>
                                            <span class="ukt-press-badge"><?php echo esc_html($category->name); ?></span>
                                            <?php
                                        }
                                    }
                                    ?>
                                <!-- <span class="ukt-press-badge">Books</span>
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span> -->
                            </div>

                            <h3 class="ukt-press-card-title">
                                <?php echo $title;?>
                            </h3>

                            <p class="ukt-press-card-desc">
                                <?php echo $content; ?>
                            </p>

                            <div class="ukt-press-card-date">
                                <?php echo $date; ?>
                            </div>
                        </div>
                    </article>
                </div>
                                <?php
                            }

                            wp_reset_postdata();
                        } else {
                            echo '<p class="text-center">No posts in this sub-category.</p>';
                        }
                    }
                }
                ?>
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-1.jpg"
                                alt="Learning Made Easy with Positive Energy: 2 Lakh Children Trained">
                            <figcaption class="visually-hidden">Learning Made Easy with Positive Energy: 2 Lakh Children
                                Trained</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Books</span>
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Learning Made Easy with Positive Energy: 2 Lakh Children Trained
                            </h3>

                            <p class="ukt-press-card-desc">
                                For many years, trainers of Universalknowledge.in have mastered and perfected the
                                techniques of betterment in daily life which is easy for children to grasp. Trainers
                                provide training on various simple…
                            </p>

                            <div class="ukt-press-card-date">
                                August 18, 2026
                            </div>
                        </div>
                    </article>
                </div> -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-1.jpg"
                                alt="Learning Made Easy with Positive Energy: 2 Lakh Children Trained">
                            <figcaption class="visually-hidden">Learning Made Easy with Positive Energy: 2 Lakh Children
                                Trained</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Books</span>
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Learning Made Easy with Positive Energy: 2 Lakh Children Trained
                            </h3>

                            <p class="ukt-press-card-desc">
                                For many years, trainers of Universalknowledge.in have mastered and perfected the
                                techniques of betterment in daily life which is easy for children to grasp. Trainers
                                provide training on various simple…
                            </p>

                            <div class="ukt-press-card-date">
                                August 18, 2026
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-2.jpg"
                                alt="Punch TV News Feature: School Positive Energy Training Program">
                            <figcaption class="visually-hidden">Punch TV News Feature: School Positive Energy Training
                                Program</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Press
                                    Release</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Punch TV News Feature: School Positive Energy Training Program
                            </h3>

                            <p class="ukt-press-card-desc">
                                <a href="https://youtu.be/ZE7_icro6_E?si=DojD5ev8hNyHRAAO" target="_blank"
                                    rel="noopener noreferrer"
                                    class="ukt-press-link">https://youtu.be/ZE7_icro6_E?si=DojD5ev8hNyHRAAO</a><br>
                                <a href="https://youtu.be/L7Sivd-H0_c?si=RaBgx3e8ebgm2ucu" target="_blank"
                                    rel="noopener noreferrer"
                                    class="ukt-press-link">https://youtu.be/L7Sivd-H0_c?si=RaBgx3e8ebgm2ucu</a>
                            </p>

                            <div class="ukt-press-card-date">
                                August 11, 2026
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-3.jpg"
                                alt="Trust Milestone Report: 50,000+ People Healed &amp; 65,000+ Students Trained">
                            <figcaption class="visually-hidden">Trust Milestone Report: 50,000+ People Healed &amp;
                                65,000+ Students Trained</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Conclaves</span>
                                <span class="ukt-press-badge">Donation</span>
                                <span class="ukt-press-badge">Healing</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Trust Milestone Report: 50,000+ People Healed &amp; 65,000+ Students Trained
                            </h3>

                            <p class="ukt-press-card-desc">
                                Universal Knowledge Trust &#174; Krishna towers ladyhill Mangalore Score card March
                                2024 1) 50,000+ people are healed and are living a healthy life. 2) 65,000+ govt.
                                School children trained to…
                            </p>

                            <div class="ukt-press-card-date">
                                March 31, 2024
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-4.jpg"
                                alt="School Training Program: Curriculum Guide &amp; Registration Brochure">
                            <figcaption class="visually-hidden">School Training Program: Curriculum Guide &amp;
                                Registration Brochure</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Corporate
                                    Training</span>
                                <span class="ukt-press-badge">Downloads</span>
                                <span class="ukt-press-badge">Training</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                                <span class="ukt-press-badge">Universal</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                School Training Program: Curriculum Guide &amp; Registration Brochure
                            </h3>

                            <p class="ukt-press-card-desc">
                                TRAINING PROGRAM DETAILS and Submission Form This programme can bring great results
                                immediately and the details of which are as mentioned in the brochure below. Submit
                                your details if interested…
                            </p>

                            <div class="ukt-press-card-date">
                                February 14, 2024
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-5.jpg"
                                alt="Out of the World Summer Camp @ Mangalore: Creative &amp; Analytical Skills">
                            <figcaption class="visually-hidden">Out of the World Summer Camp @ Mangalore: Creative &amp;
                                Analytical Skills</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Out of the World Summer Camp @ Mangalore: Creative &amp; Analytical Skills
                            </h3>

                            <p class="ukt-press-card-desc">
                                Mentors of Universal Knowledge Trust Mangalore, will be conducting a Summer Camp at
                                Shree Gokarnanatheshwara College Auditorium for Children aged 11 to 17 years of age.
                                The purpose of the…
                            </p>

                            <div class="ukt-press-card-date">
                                January 20, 2024
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-6.jpg"
                                alt="Out of the World Summer Camp – Bengaluru: Whole-Brain Learning for Kids">
                            <figcaption class="visually-hidden">Out of the World Summer Camp – Bengaluru: Whole-Brain
                                Learning for Kids</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Out of the World Summer Camp – Bengaluru: Whole-Brain Learning for Kids
                            </h3>

                            <p class="ukt-press-card-desc">
                                The purpose of the Summer Camp is to build in Positive Outlook into Children
                                behavior and train them use both the side of their Brains which is Creative and
                                Analytical,…
                            </p>

                            <div class="ukt-press-card-date">
                                May 15, 2023
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-7.jpg"
                                alt="Youth Empowerment Summer Camp 2023 @ Mangalore">
                            <figcaption class="visually-hidden">Youth Empowerment Summer Camp 2023 @ Mangalore
                            </figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Youth Empowerment Summer Camp 2023 @ Mangalore
                            </h3>

                            <p class="ukt-press-card-desc">
                                Mentors of Universal Knowledge Trust Mangalore, will be conducting a Summer Camp at
                                Shree Gokarnanatheshwara College Auditorium for Children aged 11 to 17 years of age.
                                The purpose of the…
                            </p>

                            <div class="ukt-press-card-date">
                                April 10, 2023
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-8.jpg"
                                alt="Fruit Seed Collection Drive: NECF Environmental Partnership Webinar">
                            <figcaption class="visually-hidden">Fruit Seed Collection Drive: NECF Environmental
                                Partnership Webinar</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Environment</span>
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Project
                                    Green</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Fruit Seed Collection Drive: NECF Environmental Partnership Webinar
                            </h3>

                            <p class="ukt-press-card-desc">
                                ಹಣ್ಣಿನ ಬೀಜ ಸಂಗ್ರಹ ಸ್ಪರ್ಧೆ ಫಲಿತಾಂಶಗಳು Universal knowledge ಮತ್ತು ರಾಷ್ಟ್ರೀಯ ಪರಿಸರ
                                ಸಂರಕ್ಷಣಾ ಒಕ್ಕೂಟ (NECF) ಸಹಯೋಗದಲ್ಲಿ ಶುಕ್ರವಾರ 6 ನೇ ಆಗಸ್ಟ್ 2021 ರಂದು ಸಂಜೆ 6:00 ಗಂಟೆಗೆ
                                ವೆಬಿನಾರ್ನಲ್ಲಿ ಲಿಂಕ್: meet.google.com/ybi-sztb-smz FB ಲೈವ್: Shashidhar Shetty…
                            </p>

                            <div class="ukt-press-card-date">
                                August 06, 2021
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-9.jpg"
                                alt="Finding a Friend in the Mountains: Nature Immersion Field Trip">
                            <figcaption class="visually-hidden">Finding a Friend in the Mountains: Nature Immersion
                                Field Trip</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Finding a Friend in the Mountains: Nature Immersion Field Trip
                            </h3>

                            <p class="ukt-press-card-desc">
                                Date: 26th Feb to 28th feb Travelling by own vehicle. Dist of Chickmangalur to be a
                                part of nature working closely with Mountains, Rivers and trees, understanding their
                                life journey…
                            </p>

                            <div class="ukt-press-card-date">
                                February 28, 2021
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-10.jpg"
                                alt="ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ: Positive Energy School Outreach &amp; Student Scholarships">
                            <figcaption class="visually-hidden">ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ: Positive Energy School Outreach &amp;
                                Student Scholarships</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ: Positive Energy School Outreach &amp; Student Scholarships
                            </h3>

                            <p class="ukt-press-card-desc">
                                Free Teaching at 20 schools targeting 1000 students within 100 kms from Mangalore. 3
                                hrs in each school starting from January 26th 2021. Scholarship of Rs.6000 each for
                                100 students.…
                            </p>

                            <div class="ukt-press-card-date">
                                January 26, 2021
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-11.jpg"
                                alt="One-Day Positive Energy Workshops: Focus &amp; Stress Release for Students">
                            <figcaption class="visually-hidden">One-Day Positive Energy Workshops: Focus &amp; Stress
                                Release for Students</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                One-Day Positive Energy Workshops: Focus &amp; Stress Release for Students
                            </h3>

                            <p class="ukt-press-card-desc">
                                Learning made easy with positive energy. One day workshop at schools for children
                                above 10 years. Group size above 40 and upto 150 children. One day workshop to
                                improve learning…
                            </p>

                            <div class="ukt-press-card-date">
                                March 10, 2020
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-12.jpg"
                                alt="Holistic Kids Summer Camp 2019: Creative Growth in Mangalore">
                            <figcaption class="visually-hidden">Holistic Kids Summer Camp 2019: Creative Growth in
                                Mangalore</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Holistic Kids Summer Camp 2019: Creative Growth in Mangalore
                            </h3>

                            <p class="ukt-press-card-desc">
                                Mangalore’s most awaited Summer Camp is back for kids Universal Knowledge Shared
                                present from May 13th to 19th 2019 9:30 am to 1pm , An unique opportunity for your
                                kids…
                            </p>

                            <div class="ukt-press-card-date">
                                May 19, 2019
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                    <article class="ukt-press-card">

                        <figure class="ukt-press-card-thumb">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-13.jpg"
                                alt="Mangalorean News Feature: Positive Energy Learning at Kids Summer Camp">
                            <figcaption class="visually-hidden">Mangalorean News Feature: Positive Energy Learning at
                                Kids Summer Camp</figcaption>
                        </figure>

                        <div class="ukt-press-card-body">

                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Summer
                                    Camps</span>
                                <span class="ukt-press-badge">Training
                                    for Youths</span>
                                <span class="ukt-press-badge">Training
                                    Programmes for School Children</span>
                            </div>

                            <h3 class="ukt-press-card-title">
                                Mangalorean News Feature: Positive Energy Learning at Kids Summer Camp
                            </h3>

                            <p class="ukt-press-card-desc">
                                Learning made easy with positive energy for kids at summer camp 23rd to 30th April
                                2018<br>
                                <a href="http://www.mangalorean.com/learning-made-easy-with-positive-energy-for-kids-at-summer-camp/"
                                    target="_blank" rel="noopener noreferrer"
                                    class="ukt-press-link">http://www.mangalorean.com/learning-made-easy-with-positive-energy-for-kids-at-summer-camp/</a>
                            </p>

                            <div class="ukt-press-card-date">
                                April 30, 2018
                            </div>
                        </div>
                    </article>
                </div> -->
            </div>
            

            <!-- PAGINATION CONTAINER -->
            <div class="ukt-gallery-pagination-wrap mt-5" id="pressArticlesPagination" role="navigation"
                aria-label="Articles Pagination">
                <!-- Pagination dynamically rendered via JavaScript -->
            </div>

        </div>
    </section>

</article>

<script>
    // =========================================================
        // PRESS ARTICLES PAGINATION (9 ARTICLES PER PAGE)
        // =========================================================
        document.addEventListener("DOMContentLoaded", function () {
            const grid = document.getElementById("pressArticlesGrid");
            const paginationEl = document.getElementById("pressArticlesPagination");
            if (!grid || !paginationEl) return;

            const items = Array.from(grid.querySelectorAll(".press-article-item"));
            const ITEMS_PER_PAGE = 9;
            const totalItems = items.length;
            const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);
            let currentPage = 1;

            function showPage(page, shouldScroll) {
                if (page < 1) page = 1;
                if (page > totalPages) page = totalPages;
                currentPage = page;

                const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
                const endIdx = startIdx + ITEMS_PER_PAGE;

                items.forEach((item, index) => {
                    if (index >= startIdx && index < endIdx) {
                        item.style.display = "";
                        // Retrigger subtle micro-animation
                        item.style.animation = "none";
                        item.offsetHeight; /* trigger reflow */
                        item.style.animation = "fadeInArticle 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards";
                    } else {
                        item.style.display = "none";
                    }
                });

                renderPagination();

                if (shouldScroll) {
                    const targetSection = document.getElementById("articles");
                    if (targetSection) {
                        const navOffset = 90;
                        const targetPos = targetSection.getBoundingClientRect().top + window.pageYOffset - navOffset;
                        window.scrollTo({ top: targetPos, behavior: "smooth" });
                    }
                }
            }

            function renderPagination() {
                if (totalPages <= 1) {
                    paginationEl.innerHTML = "";
                    return;
                }

                let buttonsHTML = `<div class="ukt-gallery-pagination" role="navigation" aria-label="Articles Pagination">`;

                // Previous Button
                buttonsHTML += `
                    <button type="button" 
                            class="ukt-page-btn nav-btn" 
                            data-page="${currentPage - 1}" 
                            ${currentPage === 1 ? "disabled" : ""} 
                            aria-label="Previous Page">
                        <i class="bi bi-chevron-left"></i> Prev
                    </button>
                `;

                // Page Number Buttons
                for (let i = 1; i <= totalPages; i++) {
                    if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                        buttonsHTML += `
                            <button type="button" 
                                    class="ukt-page-btn ${i === currentPage ? "active" : ""}" 
                                    data-page="${i}"
                                    aria-current="${i === currentPage ? "page" : "false"}"
                                    aria-label="Page ${i}">
                                ${i}
                            </button>
                        `;
                    } else if (i === currentPage - 2 || i === currentPage + 2) {
                        buttonsHTML += `<span class="ukt-page-ellipsis" aria-hidden="true">...</span>`;
                    }
                }

                // Next Button
                buttonsHTML += `
                    <button type="button" 
                            class="ukt-page-btn nav-btn" 
                            data-page="${currentPage + 1}" 
                            ${currentPage === totalPages ? "disabled" : ""} 
                            aria-label="Next Page">
                        Next <i class="bi bi-chevron-right"></i>
                    </button>
                `;

                buttonsHTML += `</div>`;

                // Counter / Status text
                const visibleStart = (currentPage - 1) * ITEMS_PER_PAGE + 1;
                const visibleEnd = Math.min(currentPage * ITEMS_PER_PAGE, totalItems);
                buttonsHTML += `
                    <div class="ukt-pagination-info">
                        Showing <strong>${visibleStart}–${visibleEnd}</strong> of <strong>${totalItems}</strong> articles
                    </div>
                `;

                paginationEl.innerHTML = buttonsHTML;

                // Bind click events
                paginationEl.querySelectorAll(".ukt-page-btn:not(:disabled)").forEach(btn => {
                    btn.addEventListener("click", function () {
                        const targetPage = parseInt(this.getAttribute("data-page"), 10);
                        if (targetPage && targetPage !== currentPage && targetPage >= 1 && targetPage <= totalPages) {
                            showPage(targetPage, true);
                        }
                    });
                });
            }

            // Initial render
            showPage(1, false);
        });
</script>
<?php
get_footer();
?>