<?php
/*Template Name: All School Training Programs Template */
get_header();
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1, // Use -1 to show all posts, or a number like 10
    'category_name'  => 'training-programmes-for-school-children', // The slug of the parent category
    'post_status'    => 'publish',
);
$posts = new WP_Query($args);
?>

<article>
    <?php get_template_part('page-banners');?>


    <!-- =========================================================
             SECTION: ARTICLES & INSIGHTS ON SCHOOL TRAINING PROGRAMS
        ========================================================== -->
    <section id="articles" class="py-5 ukt-articles-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    YOUTH &amp; EDUCATION
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title">
                    Training Programs for <span>School Children</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-flower1"></i>
                    <span></span>
                </div>
            </div>

            <!-- ARTICLES GRID (3 COLUMNS) -->
            <div class="row g-4">
                <?php
                if ($posts->have_posts()) {
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        $title = get_the_title();
                        $content = get_the_content();
                        $thumbnail_url = get_the_post_thumbnail_url();
                        $categories =  get_the_category();
                        $date = get_the_date();
                        $cat_count = 0;
                        
                        ?>
                            <div class="col-lg-4 col-md-6 col-12">
                                <a href="<?php echo get_the_permalink();?>">
                    <article class="ukt-article-card">


                        <figure class="ukt-article-cover">
                            <img src="<?php echo $thumbnail_url; ?>"
                                alt="<?php echo $title;?>">
                            <figcaption class="visually-hidden">Training Programmes for School Children</figcaption>
                        </figure>


                        <div class="ukt-article-body">


                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php
                                        $serial = 1;
                                        foreach ($categories as $category) {
                                            // echo esc_html($category->name);
                                            $cat_count += mb_strlen($category->name);
                                            if ($serial <= 3 && $cat_count <= 24) {
                                        ?>
                                                <a class="ukt-press-badge" href="<?php echo esc_url(get_category_link($category->term_id)) ?>"><?php echo $category->name; ?></a>
                                        <?php
                                                $serial++;
                                            } else if($serial == 1){
                                                ?>
                                                <a class="ukt-press-badge" href="<?php echo esc_url(get_category_link($category->term_id)) ?>"><?php echo $category->name; ?></a>
                                                <?php
                                                echo '<span>...<span>';
                                                break;
                                            }else {
                                                echo '<span>...<span>';
                                                break;
                                            }
                                        }
                                        ?>
                                <!-- <span class="ukt-article-pill">Books</span>
                                <span class="ukt-article-pill">Camps</span>
                                <span class="ukt-article-pill">Programmes</span>
                                <span class="ukt-article-pill">Training Programmes for School Children</span> -->
                            </div>


                            <h3 class="ukt-article-title">
                                <?php echo $title; ?>
                            </h3>


                            <p class="ukt-article-desc">
                                <?php echo $content; ?>
                            </p>


                            <div class="ukt-article-date">
                                <?php echo $date; ?>
                            </div>
                        </div>
                    </article>
                    </a>
                </div>
                        <?php
                    }
                }
                ?>

                <!-- ARTICLE CARD 1 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-article-card">


                        <figure class="ukt-article-cover">
                            <img src="images/training-programs-for-scool/training-programs-for-school-1.jpg"
                                alt="Training Programmes for School Children">
                            <figcaption class="visually-hidden">Training Programmes for School Children</figcaption>
                        </figure>


                        <div class="ukt-article-body">


                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-article-pill">Books</span>
                                <span class="ukt-article-pill">Camps</span>
                                <span class="ukt-article-pill">Programmes</span>
                                <span class="ukt-article-pill">Training Programmes for School Children</span>
                            </div>


                            <h3 class="ukt-article-title">
                                Learning made easy with Positive Energy: 2 Lakh Children Trained
                            </h3>


                            <p class="ukt-article-desc">
                                For many years, trainers of Universalknowledge.in have mastered and perfected the
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-2.jpg"
                                    alt="School Training Program News Article – Punch Tv Kolar">
                                <figcaption class="visually-hidden">School Training Program News Article – Punch Tv
                                    Kolar</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Press Release</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    School Training Program News Article – Punch Tv Kolar
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-3.jpg"
                                    alt="Update – March 2024">
                                <figcaption class="visually-hidden">Update – March 2024</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Conclaves</span>
                                    <span class="ukt-article-pill">Donation</span>
                                    <span class="ukt-article-pill">Environment</span>
                                    <span class="ukt-article-pill">Food on Wall</span>
                                    <span class="ukt-article-pill">Healing</span>
                                    <span class="ukt-article-pill">Healing Camp</span>
                                    <span class="ukt-article-pill">Inner Growth</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Project Green</span>
                                    <span class="ukt-article-pill">Retreats</span>
                                    <span class="ukt-article-pill">Self Healing</span>
                                    <span class="ukt-article-pill">Spirituality</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                    <span class="ukt-article-pill">Universal Talks</span>
                                    <span class="ukt-article-pill">Upliftment Programmes</span>
                                    <span class="ukt-article-pill">We Support</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Update – March 2024
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-4.jpg"
                                    alt="Downloads for School Training Program">
                                <figcaption class="visually-hidden">Downloads for School Training Program</figcaption>
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
                                    Downloads for School Training Program
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-5.jpg"
                                    alt="Out of the World SUMMER CAMP @ Mangalore">
                                <figcaption class="visually-hidden">Out of the World SUMMER CAMP @ Mangalore
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
                                    Out of the World SUMMER CAMP @ Mangalore
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-6.jpg"
                                    alt="Out of the world SUMMER CAMP – Bengaluru">
                                <figcaption class="visually-hidden">Out of the world SUMMER CAMP – Bengaluru
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
                                    Out of the world SUMMER CAMP – Bengaluru
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-7.jpg"
                                    alt="Out of the world SUMMER CAMP">
                                <figcaption class="visually-hidden">Out of the world SUMMER CAMP</figcaption>
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
                                    Out of the world SUMMER CAMP
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-8.jpg"
                                    alt="Fruits Seed Collection Competition">
                                <figcaption class="visually-hidden">Fruits Seed Collection Competition</figcaption>
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
                                    Fruits Seed Collection Competition
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    ಹಣ್ಣಿನ ಬೀಜ ಸಂಗ್ರಹ ಸ್ಪರ್ಧೆ ಫಲಿತಾಂಶಗಳು Universal knowledge ಮತ್ತು ರಾಷ್ಟ್ರೀಯ ಪರಿಸರ
                                    ಸಂರಕ್ಷಣಾ ಒಕ್ಕೂಟ (NECF) ಸಹಯೋಗದಲ್ಲಿ ಶುಕ್ರವಾರ 6 ನೇ ಆಗಸ್ಟ್ 2021 ರಂದು ಸಂಜೆ 6:00 ಗಂಟೆಗೆ
                                    ವೆಬಿನಾರ್ನಲ್ಲಿ ಲಿಂಕ್: meet.google.com/ybi-sztb-smz FB ಲೈವ್: Shashidhar Shetty…
                                </p>

                                
                                <div class="ukt-article-date">
                                    August 06, 2021
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 9 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-9.jpg"
                                    alt="Finding a friend in Mountain- A field trip">
                                <figcaption class="visually-hidden">Finding a friend in Mountain- A field trip
                                </figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Finding a friend in Mountain- A field trip
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-10.jpg"
                                    alt="ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ, teaching from the book, Learning made easy with positive energy">
                                <figcaption class="visually-hidden">ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ, teaching from the book, Learning
                                    made easy with positive energy</figcaption>
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
                                    ಶಾಲೆಯಿಂದ ಶಾಲೆಗೆ, teaching from the book, Learning made easy with positive energy
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-11.jpg"
                                    alt="Training Program for School Children">
                                <figcaption class="visually-hidden">Training Program for School Children</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Training Program for School Children
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-12.jpg"
                                    alt="Summer camp 2019">
                                <figcaption class="visually-hidden">Summer camp 2019</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Camps</span>
                                    <span class="ukt-article-pill">Programmes</span>
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Summer camp 2019
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Mangalore’s most awaited Summer Camp is back for kids Universal Knowledge Shared
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
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/training-programs-for-scool/training-programs-for-school-13.jpg"
                                    alt="Learning made easy with positive energy for kids at Summer Camp 23rd to 30th April 2018">
                                <figcaption class="visually-hidden">Learning made easy with positive energy for kids at
                                    Summer Camp 23rd to 30th April 2018</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Summer Camps</span>
                                    <span class="ukt-article-pill">Training for Youths</span>
                                    <span class="ukt-article-pill">Training Programmes for School Children</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Learning made easy with positive energy for kids at Summer Camp 23rd to 30th April
                                    2018
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

            <!-- =========================================================
                     PAGINATION CONTAINER
                ========================================================== -->
                <div class="ukt-gallery-pagination-wrap mt-5" id="articlesPagination" role="navigation" aria-label="Articles Pagination">
                    <!-- Pagination dynamically rendered via JavaScript -->
                </div>

        </div>
    </section>

</article>

    <!-- =========================================================
         ARTICLES PAGINATION SCRIPT
    ========================================================== -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const articlesContainer = document.querySelector("#articles .row.g-4");
            const paginationEl = document.getElementById("articlesPagination");

            if (!articlesContainer || !paginationEl) return;

            // Select all article cards
            const items = Array.from(articlesContainer.children);
            const ITEMS_PER_PAGE = 6; // 6 items = 2 rows of 3 columns on desktop
            let currentPage = 1;

            function renderPagination() {
                const totalItems = items.length;
                const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);

                // If all items fit on one page, hide pagination
                if (totalPages <= 1) {
                    paginationEl.innerHTML = "";
                    items.forEach(item => item.style.display = "");
                    return;
                }

                let buttonsHTML = `<div class="ukt-gallery-pagination">`;

                // Previous Button
                buttonsHTML += `
                    <button type="button" class="ukt-page-btn nav-btn" data-page="${currentPage - 1}" ${currentPage === 1 ? "disabled" : ""} aria-label="Previous Page">
                        <i class="bi bi-chevron-left"></i> Prev
                    </button>
                `;

                // Page Numbers
                for (let i = 1; i <= totalPages; i++) {
                    // Show first, last, and pages around current
                    if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                        buttonsHTML += `
                            <button type="button" class="ukt-page-btn ${i === currentPage ? "active" : ""}" data-page="${i}" aria-current="${i === currentPage ? 'page' : 'false'}">
                                ${i}
                            </button>
                        `;
                    } else if (i === currentPage - 2 || i === currentPage + 2) {
                        buttonsHTML += `<span class="ukt-page-ellipsis">...</span>`;
                    }
                }

                // Next Button
                buttonsHTML += `
                    <button type="button" class="ukt-page-btn nav-btn" data-page="${currentPage + 1}" ${currentPage === totalPages ? "disabled" : ""} aria-label="Next Page">
                        Next <i class="bi bi-chevron-right"></i>
                    </button>
                `;

                buttonsHTML += `</div>`;

                // Info Text (Showing X-Y of Z)
                const startIdx = (currentPage - 1) * ITEMS_PER_PAGE + 1;
                const endIdx = Math.min(currentPage * ITEMS_PER_PAGE, totalItems);
                buttonsHTML += `
                    <div class="ukt-pagination-info mt-3 text-center">
                        Showing <strong>${startIdx}–${endIdx}</strong> of <strong>${totalItems}</strong> articles
                    </div>
                `;

                paginationEl.innerHTML = buttonsHTML;

                // Attach click events to new buttons
                paginationEl.querySelectorAll(".ukt-page-btn:not(:disabled)").forEach(btn => {
                    btn.addEventListener("click", function () {
                        const targetPage = parseInt(this.getAttribute("data-page"), 10);
                        if (targetPage && targetPage !== currentPage && targetPage >= 1 && targetPage <= totalPages) {
                            currentPage = targetPage;
                            updatePage();
                            
                            // Scroll smoothly back to the top of the articles section
                            const sectionTop = document.getElementById("articles").getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: sectionTop, behavior: "smooth" });
                        }
                    });
                });
            }

            function updatePage() {
                const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
                const endIdx = startIdx + ITEMS_PER_PAGE;

                items.forEach((item, index) => {
                    if (index >= startIdx && index < endIdx) {
                        item.style.display = ""; // Show
                        
                        // Optional: Add a subtle fade-in animation
                        item.style.animation = "none";
                        item.offsetHeight; /* trigger reflow */
                        item.style.animation = "fadeInArticle 0.4s ease forwards";
                    } else {
                        item.style.display = "none"; // Hide
                    }
                });

                renderPagination();
            }

            // Initialize on page load
            updatePage();
        });
    </script>

<?php
get_footer();
?>