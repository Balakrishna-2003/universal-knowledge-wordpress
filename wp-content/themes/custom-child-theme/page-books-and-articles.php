<?php
/*Template Name: Books and Articles Template */
get_header();
?>
<article>

    <?php get_template_part('page-banners'); ?>

    <!-- =========================================================
         BOOKS & PUBLICATIONS SHOWCASE SECTION
    ========================================================== -->
    <section class="ukt-books-section" id="books-articles">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-books-header">
                <span class="ukt-books-tagline">Publications &amp; Books</span>
                <h2 class="ukt-section-main-title">
                    Explore Enlightening <span>Books & Works</span>
                </h2>
                <p class="ukt-books-lead">
                    Discover inspiring literature authored by the spiritual guides and mentors of Universal
                    Knowledge Trust on positive living, spiritual growth, healing, and personal transformation.
                </p>
            </div>

            <!-- SEARCH & CATEGORY FILTER TOOLBAR -->
            <div class="ukt-books-toolbar">
                <div class="row g-3 align-items-center">

                    <!-- Search Input -->
                    <div class="col-lg-4 col-md-12">
                        <div class="ukt-books-search-wrap">
                            <i class="bi bi-search"></i>
                            <input type="text" id="uktBookSearchInput" class="ukt-books-search-input"
                                placeholder="Search books by title, author, or keyword..."
                                aria-label="Search Books & Articles">
                        </div>
                    </div>

                    <!-- Category Pills -->
                    <div class="col-lg-8 col-md-12">
                        <div class="ukt-books-filter-pills justify-content-lg-end" role="tablist">
                            <button type="button" class="ukt-books-filter-pill active" data-category="all">
                                All Books
                            </button>
                            <?php
                            $books = ukt_get_ba_books();
                            $unique_authors = array_unique(array_filter(array_column($books, 'author')));

                            // 4. Reset the array keys (optional, but makes it a clean 0, 1, 2 list)
                            $unique_authors = array_values($unique_authors);


                            if (!empty($unique_authors)) {
                                $count = count($books);
                                $serial = 1;
                                foreach ($unique_authors as $book) {
                                    # code...
                                    if ($serial > 4) {
                                        break;
                                    }
                                    ?>
                                    <button type="button" class="ukt-books-filter-pill" data-category="<?php echo $book; ?>">
                                        <?php echo $book; ?>
                                    </button>
                                    <?php
                                    $serial++;
                                }
                                ?>
                                <!-- <button type="button" class="ukt-books-filter-pill" data-category="mind">
                                    Positive Living &amp; Mind
                                </button>
                                <button type="button" class="ukt-books-filter-pill" data-category="healing">
                                    Healing &amp; Energy
                                </button>
                                <button type="button" class="ukt-books-filter-pill" data-category="spirituality">
                                    Spiritual Wisdom
                                </button>
                                <button type="button" class="ukt-books-filter-pill" data-category="youth">
                                    Youth &amp; Values
                                </button> -->
                            </div>
                        </div>

                    </div>
                </div>






                <!-- Meta Count Bar -->
                <div class="ukt-books-meta-bar">
                    <div>
                        Showing <strong id="uktBookMatchCount"><?php echo $count; ?></strong> publications
                    </div>
                    <div class="d-none d-md-block text-muted small">
                        <i class="bi bi-shield-check text-success me-1"></i> Official Publications of Universal
                        Knowledge Trust
                    </div>
                </div>

                <!-- BOOKS GRID (2-COLUMN HORIZONTAL CARDS) -->
                <div class="row g-4" id="booksGrid">
                    <?php
                    foreach ($books as $book) {
                        // echo '<a href="' . esc_url($book['link']) . '">' . esc_html($book['title']) . '</a>';
                
                        $book_url = !empty($book['link']) ? $book['link'] : $book['pdf_url'];
                        ?>
                        <!-- Book 1: Learning Made Easy with Positive Energy -->
                        <div class="col-lg-6 col-md-12 ukt-book-item" data-category="<?php echo $book['author']; ?>"
                            data-keywords="<?php echo $book['description']; ?>">
                            <div class="ukt-book-card">
                                <div class="ukt-book-card-grid">
                                    <div class="ukt-book-cover-stage">
                                        <div class="ukt-book-mockup">
                                            <span class="ukt-book-pages-bottom"></span>
                                            <span class="ukt-book-pages-right"></span>
                                            <div class="ukt-book-mockup-inner">
                                                <img src="<?php echo $book['cover_url']; ?>"
                                                    alt="<?php echo $book['title']; ?> - By <?php echo $book['author']; ?>"
                                                    class="ukt-book-img" loading="lazy">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ukt-book-body">
                                        <!-- <span class="ukt-book-category">Positive Energy</span> -->
                                        <h3 class="ukt-book-title">
                                            <?php echo $book['title']; ?>
                                        </h3>
                                        <div class="ukt-book-author">
                                            <i class="bi bi-person-circle"></i> <?php echo $book['author']; ?>
                                        </div>
                                        <p class="ukt-book-desc">
                                            <?php echo wp_trim_words($book['description'], 22) ?>
                                        </p>
                                        <?php if (!empty($book_url)) {
                                            ?>
                                            <div class="ukt-book-actions">
                                                <a href="<?php echo $book_url; ?>" target="_blank" rel="noopener noreferrer"
                                                    class="ukt-book-purchase-btn">
                                                    <i class="bi bi-bag-check me-2"></i>
                                                    <?php echo !empty($book['link']) ? 'Purchase Book' : 'Read Book'; ?>

                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                            }
                            ?>

                <!-- Book 2: Cosmic Energy & The Science of Self-Healing -->
                <!-- <div class="col-lg-6 col-md-12 ukt-book-item" data-category="healing"
                        data-keywords="cosmic energy self healing sashidhar shetty chakra aura health vitality meditation">
                        <div class="ukt-book-card">
                            <div class="ukt-book-card-grid">
                                <div class="ukt-book-cover-stage">
                                    <div class="ukt-book-mockup">
                                        <span class="ukt-book-pages-bottom"></span>
                                        <span class="ukt-book-pages-right"></span>
                                        <div class="ukt-book-mockup-inner">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/book2.webp"
                                                alt="Cosmic Energy &amp; The Science of Self-Healing"
                                                class="ukt-book-img" loading="lazy">
                                        </div>
                                    </div>
                                </div>

                                <div class="ukt-book-body">
                                    
                                    <h3 class="ukt-book-title">
                                        Way of Life for Better Generation
                                    </h3>
                                    <div class="ukt-book-author">
                                        <i class="bi bi-person-circle"></i> Rohan Michael Shiri
                                    </div>
                                    <p class="ukt-book-desc">
                                        A guide to living with positivity and purpose. Discover how aligning with universal positive energy can inspire inner growth, spread goodness, and create a meaningful impact on yourself, others, and the world.
                                    </p>
                                    <div class="ukt-book-actions">
                                        <a href="https://amzn.to/489RYyt"
                                            target="_blank" rel="noopener noreferrer" class="ukt-book-purchase-btn">
                                            <i class="bi bi-bag-check me-2"></i> Purchase Book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
            </div>

            <!-- No Books Found State -->
            <div id="uktNoBooksFound" class="text-center py-5 d-none">
                <div class="mb-3">
                    <i class="bi bi-search text-muted ukt-search-empty-icon"></i>
                </div>
                <h4 class="text-dark fw-bold mb-2">No matching books found</h4>
                <p class="text-muted small">Try adjusting your search query or choosing a different category filter.
                </p>
                <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-4 mt-2"
                    id="uktResetBookFilters">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset Filters
                </button>
            </div>

        </div>
    </section> <!-- =========================================================
             SECTION: ARTICLES & MEDIA COVERAGE
             (Picked from press-release with 9-article pagination)
        ========================================================== -->
    <section id="articles" class="ukt-books-articles-section">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    ARTICLES &amp; PUBLICATIONS
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title">
                    Articles &amp; <span>Media Coverage</span>
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
                            'posts_per_page' => 6,
                            'cat' => $child->term_id,
                        );

                        $child_posts = new WP_Query($args);

                        if ($child_posts->have_posts()) {

                            while ($child_posts->have_posts()) {
                                $child_posts->the_post();

                                $categories = get_the_category();
                                $title = get_the_title();
                                $content = wp_trim_words(get_the_content(), 31, '...');
                                $img_url = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : ' ';
                                $date = get_the_date('F j, Y');

                                ?>

                                <div class="col-lg-4 col-md-6 col-12 press-article-item">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    <article class="ukt-article-card">
                                        <!-- Cover Image Container -->
                                        <figure class="ukt-article-cover">
                                            <img src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>" alt="<?php echo $title; ?>"
                                                loading="lazy">
                                            <figcaption class="visually-hidden"><?php echo $title; ?></figcaption>
                                        </figure>

                                        <!-- Card Body -->
                                        <div class="ukt-article-body">
                                            <!-- Category Pills -->
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <?php
                                                if (!empty($categories)) {
                                                    foreach ($categories as $category) {
                                                        ?>

                                                        <span class="ukt-article-pill"><?php echo esc_html($category->name); ?></span>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <!-- <span class="ukt-article-pill">Books</span>
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span> -->
                                            </div>

                                            <!-- Title -->
                                            <h3 class="ukt-article-title">
                                                <?php echo $title; ?>
                                            </h3>

                                            <!-- Description -->
                                            <p class="ukt-article-desc">
                                                <?php echo $content; ?>
                                            </p>

                                            <!-- Date -->
                                            <div class="ukt-article-date">
                                                <?php echo $date; ?>
                                            </div>
                                        </div>
                                    </article>
                                    </a>
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

                <!-- ARTICLE CARD 1 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-1.jpg"
                                    alt="Learning Made Easy with Positive Energy: 2 Lakh Children Trained" loading="lazy">
                                <figcaption class="visually-hidden">Learning Made Easy with Positive Energy: 2 Lakh
                                    Children Trained</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Books</span>
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Learning Made Easy with Positive Energy: 2 Lakh Children Trained
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    For many years, trainers of Universal Knowledge have mastered and perfected the
                                    techniques of betterment in daily life which is easy for children to grasp. Trainers
                                    provide training on various simple…
                                </p>

                                
                                <div class="ukt-article-date">
                                    August 18, 2026
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 2 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-2.jpg"
                                    alt="Punch TV News Feature: School Positive Energy Training Program" loading="lazy">
                                <figcaption class="visually-hidden">Punch TV News Feature: School Positive Energy
                                    Training Program</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Press Release</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Punch TV News Feature: School Positive Energy Training Program
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    <a href="https://youtu.be/ZE7_icro6_E?si=DojD5ev8hNyHRAAO" target="_blank"
                                        rel="noopener noreferrer">https://youtu.be/ZE7_icro6_E?si=DojD5ev8hNyHRAAO</a><br>
                                    <a href="https://youtu.be/L7Sivd-H0_c?si=RaBgx3e8ebgm2ucu" target="_blank"
                                        rel="noopener noreferrer">https://youtu.be/L7Sivd-H0_c?si=RaBgx3e8ebgm2ucu</a>
                                </p>

                                
                                <div class="ukt-article-date">
                                    August 11, 2026
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 3 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-3.jpg"
                                    alt="Trust Milestone Report: 50,000+ People Healed &amp; 65,000+ Students Trained" loading="lazy">
                                <figcaption class="visually-hidden">Trust Milestone Report: 50,000+ People Healed &amp;
                                    65,000+ Students Trained</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Conclaves</span>
                                    <span class="ukt-article-pill">Donation</span>
                                    <span class="ukt-article-pill">Healing</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Trust Milestone Report: 50,000+ People Healed &amp; 65,000+ Students Trained
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Universal Knowledge Trust &#174; Krishna towers ladyhill Mangalore Score card March
                                    2024 1) 50,000+ people are healed and are living a healthy life. 2) 65,000+ govt.
                                    School children trained to…
                                </p>

                                
                                <div class="ukt-article-date">
                                    March 31, 2024
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 4 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">

                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-4.jpg"
                                    alt="School Training Program: Curriculum Guide &amp; Registration Brochure" loading="lazy">
                                <figcaption class="visually-hidden">School Training Program: Curriculum Guide &amp;
                                    Registration Brochure</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Corporate Training</span>
                                    <span class="ukt-article-pill">Downloads</span>
                                    <span class="ukt-article-pill">Training</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                    <span class="ukt-article-pill">Universal</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    School Training Program: Curriculum Guide &amp; Registration Brochure
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    TRAINING PROGRAM DETAILS and Submission Form This programme can bring great results
                                    immediately and the details of which are as mentioned in the brochure below. Submit
                                    your details if interested…
                                </p>

                                
                                <div class="ukt-article-date">
                                    February 14, 2024
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 5 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-5.jpg"
                                    alt="Out of the World Summer Camp @ Mangalore: Creative &amp; Analytical Skills" loading="lazy">
                                <figcaption class="visually-hidden">Out of the World Summer Camp @ Mangalore: Creative
                                    &amp; Analytical Skills</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Out of the World Summer Camp @ Mangalore: Creative &amp; Analytical Skills
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Mentors of Universal Knowledge Trust Mangalore, will be conducting a Summer Camp at
                                    Shree Gokarnanatheshwara College Auditorium for Children aged 11 to 17 years of age.
                                    The purpose of the…
                                </p>

                                
                                <div class="ukt-article-date">
                                    January 20, 2024
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 6 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-6.jpg"
                                    alt="Out of the World Summer Camp – Bengaluru: Whole-Brain Learning for Kids" loading="lazy">
                                <figcaption class="visually-hidden">Out of the World Summer Camp – Bengaluru:
                                    Whole-Brain Learning for Kids</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Out of the World Summer Camp – Bengaluru: Whole-Brain Learning for Kids
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    The purpose of the Summer Camp is to build in Positive Outlook into Children
                                    behavior and train them use both the side of their Brains which is Creative and
                                    Analytical,…
                                </p>

                                
                                <div class="ukt-article-date">
                                    May 15, 2023
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 7 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-7.jpg"
                                    alt="Youth Empowerment Summer Camp 2023 @ Mangalore" loading="lazy">
                                <figcaption class="visually-hidden">Youth Empowerment Summer Camp 2023 @ Mangalore
                                </figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Youth Empowerment Summer Camp 2023 @ Mangalore
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Mentors of Universal Knowledge Trust Mangalore, will be conducting a Summer Camp at
                                    Shree Gokarnanatheshwara College Auditorium for Children aged 11 to 17 years of age.
                                    The purpose of the…
                                </p>

                                
                                <div class="ukt-article-date">
                                    April 10, 2023
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 8 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-8.jpg"
                                    alt="Fruit Seed Collection Drive: NECF Environmental Partnership Webinar" loading="lazy">
                                <figcaption class="visually-hidden">Fruit Seed Collection Drive: NECF Environmental
                                    Partnership Webinar</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Environment</span>
                                    <span class="ukt-article-pill">Events</span>
                                    <span class="ukt-article-pill">Project Green</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Fruit Seed Collection Drive: NECF Environmental Partnership Webinar
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    ಹಣ್ಣಿನ ಬೀಜ ಸಂಗ್ರಹ ಸ್ಪರ್ಧೆ ಫಲಿತಾಂಶಗಳು Universal knowledge ಮತ್ತು ರಾಷ್ಟ್ರೀಯ ಪರಿಸರ
                                    ಸಂರಕ್ಷಣಾ ಒಕ್ಕೂಟ (NECF) ಸಹಯೋಗದಲ್ಲಿ ಶುಕ್ರವಾರ 6 ನೇ ಆಗಸ್ಟ್ 2021 ರಂದು ಸಂಜೆ 6:00 ಗಂಟೆಗೆ
                                    ವೆಬಿನಾರ್ನಲ್ಲಿ ಲಿಂಕ್: meet.google.com/ybi-sztb-smz FB ಲೈವ್: Shashidhar Shetty…
                                </p>

                                
                                <div class="ukt-article-date">
                                    August 06, 2021
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 9 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-9.jpg"
                                    alt="Finding a Friend in the Mountains: Nature Immersion Field Trip" loading="lazy">
                                <figcaption class="visually-hidden">Finding a Friend in the Mountains: Nature Immersion
                                    Field Trip</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Finding a Friend in the Mountains: Nature Immersion Field Trip
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Date: 26th Feb to 28th feb Travelling by own vehicle. Dist of Chickmangalur to be a
                                    part of nature working closely with Mountains, Rivers and trees, understanding their
                                    life journey…
                                </p>

                                
                                <div class="ukt-article-date">
                                    February 28, 2021
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 10 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-10.jpg"
                                    alt="ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ: Positive Energy School Outreach &amp; Student Scholarships" loading="lazy">
                                <figcaption class="visually-hidden">ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ: Positive Energy School Outreach
                                    &amp; Student Scholarships</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ: Positive Energy School Outreach &amp; Student Scholarships
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Free Teaching at 20 schools targeting 1000 students within 100 kms from Mangalore. 3
                                    hrs in each school starting from January 26th 2021. Scholarship of Rs.6000 each for
                                    100 students.…
                                </p>

                                
                                <div class="ukt-article-date">
                                    January 26, 2021
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 11 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-11.jpg"
                                    alt="One-Day Positive Energy Workshops: Focus &amp; Stress Release for Students" loading="lazy">
                                <figcaption class="visually-hidden">One-Day Positive Energy Workshops: Focus &amp;
                                    Stress Release for Students</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    One-Day Positive Energy Workshops: Focus &amp; Stress Release for Students
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Learning made easy with positive energy. One day workshop at schools for children
                                    above 10 years. Group size above 40 and upto 150 children. One day workshop to
                                    improve learning…
                                </p>

                                
                                <div class="ukt-article-date">
                                    March 10, 2020
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 12 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-12.jpg"
                                    alt="Holistic Kids Summer Camp 2019: Creative Growth in Mangalore" loading="lazy">
                                <figcaption class="visually-hidden">Holistic Kids Summer Camp 2019: Creative Growth in
                                    Mangalore</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Holistic Kids Summer Camp 2019: Creative Growth in Mangalore
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Mangalore's most awaited Summer Camp is back for kids Universal Knowledge Shared
                                    present from May 13th to 19th 2019 9:30 am to 1pm , An unique opportunity for your
                                    kids…
                                </p>

                                
                                <div class="ukt-article-date">
                                    May 19, 2019
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 13 -->
                <!-- <div class="col-lg-4 col-md-6 col-12 press-article-item">
                        <article class="ukt-article-card">
                            
                            <figure class="ukt-article-cover">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training-programs-for-scool/training-programs-for-school-13.jpg"
                                    alt="Mangalorean News Feature: Positive Energy Learning at Kids Summer Camp" loading="lazy">
                                <figcaption class="visually-hidden">Mangalorean News Feature: Positive Energy Learning
                                    at Kids Summer Camp</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Mangalorean News Feature: Positive Energy Learning at Kids Summer Camp
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Learning made easy with positive energy for kids at summer camp 23rd to 30th April
                                    2018<br>
                                    <a href="http://www.mangalorean.com/learning-made-easy-with-positive-energy-for-kids-at-summer-camp/"
                                        target="_blank" rel="noopener noreferrer">http://www.mangalorean.com/learning-made-easy-with-positive-energy-for-kids-at-summer-camp/</a>
                                </p>

                                
                                <div class="ukt-article-date">
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

    <!-- =========================================================
             SECTION: AGNIHOTRA MATERIALS SHOWCASE
        ========================================================== -->
    <section id="agnihotra-materials" class="ukt-agnihotra-materials-section">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    SACRED PRACTICES
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title">
                    Agnihotra <span>Materials</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-fire ukt-icon-fire"></i>
                    <span></span>
                </div>
            </div>

            <!-- MATERIALS IMAGE GALLERY -->
            <div class="row g-3 g-md-4" id="agnihotraMaterialsGrid">
                <?php
                $agni_images = ukt_get_ba_agnihotra();
                if (!empty($agni_images)) {
                    foreach ($agni_images as $img) {
                        // You can use the image URL for a <img> tag
                        // echo '<img src="' . esc_url($img['url']) . '" alt="Agnihotra Material">';
                        ?>
                        <div class="col-lg-4 col-md-6 col-6">
                            <div class="agnihotra-img-card">
                                <img src="<?php echo esc_url($img['url']); ?>" alt="Agnihotra Material" loading="lazy">
                            </div>
                        </div>
                        <?php

                        // Or if you need a specific size (since we stored the ID), use WP functions:
                        // echo wp_get_attachment_image($img['id'], 'large');
                    }
                }
                ?>
                <!-- Image 1 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                        <div class="agnihotra-img-card">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/agnihotra-materials/img-1.webp" alt="Agnihotra Material"
                                loading="lazy">
                        </div>
                    </div> -->

                <!-- Image 2 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                        <div class="agnihotra-img-card">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/agnihotra-materials/img-2.webp" alt="Agnihotra Material"
                                loading="lazy">
                        </div>
                    </div> -->

                <!-- Image 3 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                        <div class="agnihotra-img-card">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/agnihotra-materials/img-3.webp" alt="Agnihotra Material"
                                loading="lazy">
                        </div>
                    </div> -->

                <!-- Image 4 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                        <div class="agnihotra-img-card">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/agnihotra-materials/img-4.webp" alt="Agnihotra Material"
                                loading="lazy">
                        </div>
                    </div> -->

                <!-- Image 5 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                        <div class="agnihotra-img-card">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/agnihotra-materials/img-5.webp" alt="Agnihotra Material"
                                loading="lazy">
                        </div>
                    </div> -->

                <!-- Image 6 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                        <div class="agnihotra-img-card">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/agnihotra-materials/img-6.webp" alt="Agnihotra Material"
                                loading="lazy">
                        </div>
                    </div> -->

            </div>
            <!-- /MATERIALS IMAGE GALLERY -->

        </div>
    </section>

    <!-- =========================================================
             SECTION: GIFTS SHOWCASE
        ========================================================== -->
    <section id="gifts" class="ukt-gifts-section">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    MINDFUL GIFTING
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title">
                    Gifts
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-gift ukt-icon-gift"></i>
                    <span></span>
                </div>
            </div>

            <!-- GIFTS IMAGE GALLERY -->
            <div class="row g-3 g-md-4" id="giftsGrid">

                <?php
                $agni_images = ukt_get_ba_gifts();
                if (!empty($agni_images)) {
                    foreach ($agni_images as $img) {
                        // You can use the image URL for a <img> tag
                        // echo '<img src="' . esc_url($img['url']) . '" alt="Agnihotra Material">';
                        ?>
                        <div class="col-lg-4 col-md-6 col-6">
                            <div class="gifts-img-card">
                                <img src="<?php echo $img['url']; ?>" alt="Gift Item" loading="lazy">
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

                <!-- Image 1 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                    <div class="gifts-img-card">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/gifts/img-1.webp"
                            alt="Gift Item" loading="lazy">
                    </div>
                </div> -->

                <!-- Image 2 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                    <div class="gifts-img-card">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/gifts/img-2.webp"
                            alt="Gift Item" loading="lazy">
                    </div>
                </div> -->

                <!-- Image 3 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                    <div class="gifts-img-card">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/gifts/img-3.webp"
                            alt="Gift Item" loading="lazy">
                    </div>
                </div> -->

                <!-- Image 4 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                    <div class="gifts-img-card">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/gifts/img-4.webp"
                            alt="Gift Item" loading="lazy">
                    </div>
                </div> -->

                <!-- Image 5 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                    <div class="gifts-img-card">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/gifts/img-5.webp"
                            alt="Gift Item" loading="lazy">
                    </div>
                </div> -->

                <!-- Image 6 -->
                <!-- <div class="col-lg-4 col-md-6 col-6">
                    <div class="gifts-img-card">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/books-and-articles/gifts/img-6.webp"
                            alt="Gift Item" loading="lazy">
                    </div>
                </div> -->

            </div>
            <!-- /GIFTS IMAGE GALLERY -->

        </div>
    </section>

    <!-- =========================================================
         CALL TO ACTION SECTION
         (Matches about-us CTA section style)
    ========================================================== -->
    <section class="ukt-cta-section ukt-cta-dark">
        <div class="container text-center">
            <span class="ukt-cta-dark-kicker">BE A PART OF OUR MISSION</span>
            <h2 class="ukt-cta-dark-title">
                Transform Your Life. <span>Serve the World.</span>
            </h2>
            <p class="ukt-cta-dark-desc">
                Whether you wish to participate in our healing sessions, enroll in youth programs, or support our
                community feeding initiatives, your presence brings light.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="<?php echo home_url('our-training-programs'); ?>" class="ukt-hero-primary-action ukt-cta-btn-primary">
                    Explore Programs <i class="bi bi-arrow-right"></i>
                </a>
                <a href="mailto:UniversalknowledgR@gmail.com" class="ukt-hero-secondary-action ukt-cta-btn-secondary">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>

</article>

<!-- =========================================================
     BOOK INQUIRY MODAL
========================================================== -->
<div class="modal fade ukt-book-modal" id="uktBookInquiryModal" tabindex="-1" aria-labelledby="uktBookInquiryModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uktBookInquiryModalTitle">
                    <i class="bi bi-book-half me-2"></i> Book Inquiry &amp; Order Request
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uktBookInquiryForm" onsubmit="handleBookInquirySubmit(event)">
                    <div class="ukt-book-modal-field">
                        <label for="modalBookName">Selected Book</label>
                        <input type="text" id="modalBookName" class="form-control" readonly>
                    </div>
                    <div class="ukt-book-modal-field">
                        <label for="inquiryName">Your Full Name</label>
                        <input type="text" id="inquiryName" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="ukt-book-modal-field">
                        <label for="inquiryPhone">Phone / WhatsApp Number</label>
                        <input type="tel" id="inquiryPhone" class="form-control" placeholder="+91 98765 43210" required>
                    </div>
                    <div class="ukt-book-modal-field">
                        <label for="inquiryMessage">Your Query / Delivery Address</label>
                        <textarea id="inquiryMessage" rows="3" class="form-control"
                            placeholder="Provide delivery city/state or any specific inquiry..."></textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success rounded-pill px-4 ukt-modal-wa-btn">
                            <i class="bi bi-send-fill me-1"></i> Send via WhatsApp
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // =========================================================
    // BOOKS & ARTICLES SEARCH & FILTER FUNCTIONALITY
    // =========================================================
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("uktBookSearchInput");
        const filterPills = document.querySelectorAll(".ukt-books-filter-pill");
        const bookItems = document.querySelectorAll(".ukt-book-item");
        const matchCountEl = document.getElementById("uktBookMatchCount");
        const noBooksFound = document.getElementById("uktNoBooksFound");
        const resetBtn = document.getElementById("uktResetBookFilters");

        let currentCategory = "all";
        let searchQuery = "";

        function filterBooks() {
            let visibleCount = 0;

            bookItems.forEach(item => {
                const category = item.getAttribute("data-category") || "";
                const keywords = (item.getAttribute("data-keywords") || "").toLowerCase();
                const title = (item.querySelector(".ukt-book-title")?.textContent || "").toLowerCase();
                const author = (item.querySelector(".ukt-book-author")?.textContent || "").toLowerCase();
                const desc = (item.querySelector(".ukt-book-desc")?.textContent || "").toLowerCase();

                const matchesCategory = (currentCategory === "all" || category === currentCategory);
                const matchesSearch = !searchQuery ||
                    title.includes(searchQuery) ||
                    author.includes(searchQuery) ||
                    desc.includes(searchQuery) ||
                    keywords.includes(searchQuery);

                if (matchesCategory && matchesSearch) {
                    item.style.display = "";
                    visibleCount++;
                } else {
                    item.style.display = "none";
                }
            });

            if (matchCountEl) {
                matchCountEl.textContent = visibleCount;
            }

            if (noBooksFound) {
                if (visibleCount === 0) {
                    noBooksFound.classList.remove("d-none");
                } else {
                    noBooksFound.classList.add("d-none");
                }
            }
        }

        if (searchInput) {
            searchInput.addEventListener("input", function (e) {
                searchQuery = e.target.value.toLowerCase().trim();
                filterBooks();
            });
        }

        filterPills.forEach(pill => {
            pill.addEventListener("click", function () {
                filterPills.forEach(p => p.classList.remove("active"));
                this.classList.add("active");
                currentCategory = this.getAttribute("data-category") || "all";
                filterBooks();
            });
        });

        if (resetBtn) {
            resetBtn.addEventListener("click", function () {
                if (searchInput) searchInput.value = "";
                searchQuery = "";
                currentCategory = "all";
                filterPills.forEach(p => p.classList.remove("active"));
                const allPill = document.querySelector('.ukt-books-filter-pill[data-category="all"]');
                if (allPill) allPill.classList.add("active");
                filterBooks();
            });
        }

        // Modal Book Name Binding
        const inquiryModalEl = document.getElementById('uktBookInquiryModal');
        if (inquiryModalEl && typeof bootstrap !== 'undefined') {
            const bookModal = new bootstrap.Modal(inquiryModalEl);
            document.querySelectorAll('.ukt-open-inquiry-modal').forEach(btn => {
                btn.addEventListener('click', function () {
                    const bookName = this.getAttribute('data-book') || 'Universal Knowledge Trust Book';
                    const input = document.getElementById('modalBookName');
                    if (input) input.value = bookName;
                    bookModal.show();
                });
            });
        }
    });

    function handleBookInquirySubmit(e) {
        e.preventDefault();
        const book = document.getElementById('modalBookName')?.value || '';
        const name = document.getElementById('inquiryName')?.value || '';
        const phone = document.getElementById('inquiryPhone')?.value || '';
        const msg = document.getElementById('inquiryMessage')?.value || '';

        const waText = encodeURIComponent(`Hello Universal Knowledge Trust,\n\nI would like to inquire about the book:\n*${book}*\n\nMy Details:\nName: ${name}\nPhone: ${phone}\nNote/Address: ${msg}`);
        window.open(`https://wa.me/919632171156?text=${waText}`, '_blank');

        const modalEl = document.getElementById('uktBookInquiryModal');
        if (modalEl && typeof bootstrap !== 'undefined') {
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
        }
    }

    // =========================================================
    // ARTICLES PAGINATION (AT MOST 9 ARTICLES PER PAGE)
    // =========================================================
    document.addEventListener("DOMContentLoaded", function () {
        const grid = document.getElementById("pressArticlesGrid");
        const paginationEl = document.getElementById("pressArticlesPagination");
        if (!grid || !paginationEl) return;

        const items = Array.from(grid.querySelectorAll(".press-article-item"));
        const ITEMS_PER_PAGE = 6;
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