<?php
/* Template Name: Spirituality Template */
get_header();
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1, // Use -1 to show all posts, or a number like 10
    'category_name'  => 'spirituality', // The slug of the parent category
    'post_status'    => 'publish',
);
$posts = new WP_Query($args);
?>


<article>
    <?php get_template_part('page-banners'); ?>


    <!-- =========================================================
             SECTION: SPIRITUALITY ARTICLES & INSIGHTS
             (Matching Reference News Card Layout)
        ========================================================== -->
    <section id="articles" class="py-5 ukt-articles-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    WISDOM &amp; INSIGHTS
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-serif-title">
                    Articles on <span>Spirituality</span>
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
                        $title =  get_the_title();
                        $content = get_the_content();
                        $thumbnail_url = get_the_post_thumbnail_url();
                        $categories = get_the_category();
                        $date = get_the_date('F j, Y');
                        // print_r($categories);
                        $cat_count = 0;
                ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <a href="<?php echo get_post_permalink(); ?>">
                            <article class="ukt-press-card">


                                <figure class="ukt-press-card-thumb">
                                    <img src="<?php echo $thumbnail_url; ?>"
                                        alt="Agnihotra World Record - Gram Vikas Society and Universal Knowledge Trust">
                                    <figcaption class="visually-hidden"><?php echo $title; ?></figcaption>
                                </figure>


                                <div class="ukt-press-card-body">


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
                                                break;
                                            }else {
                                                echo '<span>...<span>';
                                                break;
                                            }
                                        }
                                        ?>
                                        <!-- <span class="ukt-press-badge">Events</span>
                                        <span class="ukt-press-badge">Spirituality</span> -->
                                    </div>


                                    <h3 class="ukt-press-card-title">
                                        <?php echo $title; ?>
                                    </h3>


                                    <p class="ukt-press-card-desc">
                                        <?php echo $content; ?>
                                    </p>


                                    <div class="ukt-press-card-date">
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
                    <article class="ukt-press-card">


                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-1.jpg"
                                alt="Agnihotra World Record - Gram Vikas Society and Universal Knowledge Trust">
                            <figcaption class="visually-hidden">Agnihotra World Record - Gram Vikas Society and Universal Knowledge Trust</figcaption>
                        </figure>


                        <div class="ukt-press-card-body">


                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>


                            <h3 class="ukt-press-card-title">
                                Agnihotra World Record
                            </h3>


                            <p class="ukt-press-card-desc">
                                Gram Vikas Society along with Universal Knowledge Trust’s Agnihotra event sets a world record!! A remarkable Agnihotra ceremony, organized by the Gram Vikas society along with Universal Knowledge Trust, has…
                            </p>


                            <div class="ukt-press-card-date">
                                August 18, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 2 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">


                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-2.jpg"
                                alt="KARNATAKA AGNIHOTRA SPECTACULAR">
                            <figcaption class="visually-hidden">KARNATAKA AGNIHOTRA SPECTACULAR</figcaption>
                        </figure>


                        <div class="ukt-press-card-body">


                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>


                            <h3 class="ukt-press-card-title">
                                KARNATAKA AGNIHOTRA SPECTACULAR
                            </h3>


                            <p class="ukt-press-card-desc">
                                Namaskara Sir &#128591; We are pleased to invite you for KARNATAKA AGNIHOTRA SPECTACULAR event to be held on 13th APRIL, 2025, SUNDAY. 11,111+ PEOPLE will perform MASS AGNIHOTRA @ DHARWAD.…
                            </p>


                            <div class="ukt-press-card-date">
                                August 11, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 3 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">


                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-3.jpg"
                                alt="Agnihotra Procedure">
                            <figcaption class="visually-hidden">Agnihotra Procedure</figcaption>
                        </figure>


                        <div class="ukt-press-card-body">


                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>


                            <h3 class="ukt-press-card-title">
                                Agnihotra Procedure
                            </h3>


                            <p class="ukt-press-card-desc">
                                Angihotra, also known as Agnihotra, is an ancient Vedic fire ritual originating from India. It’s a powerful practice for physical, mental, and spiritual well-being. Here’s a step-by-step guide: Materials Needed:…
                            </p>


                            <div class="ukt-press-card-date">
                                August 11, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 4 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-4.jpg"
                                alt="Spirituality and You – Tumkur">
                            <figcaption class="visually-hidden">Spirituality and You – Tumkur</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Spirituality and You – Tumkur
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Dear friends, I hope this message finds you well. I am excited to share with you information about the upcoming “Spirituality and You” program organized by Universal Knowledge Trust in…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                July 20, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 5 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-5.jpg"
                                alt="Spirituality and you – Singapore">
                            <figcaption class="visually-hidden">Spirituality and you – Singapore</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Spirituality and you – Singapore
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                “Spirituality and You” by Universal Knowledge, is now coming to Singapore. Organized by The Singapore Hindu Sabai on Sunday, 12th May 2024 at PGP Hall, ( Function Hall @3rd level)…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                July 08, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 6 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-6.jpg"
                                alt="Holistic Wellness Program">
                            <figcaption class="visually-hidden">Holistic Wellness Program</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Healing</span>
                                <span class="ukt-press-badge">Healing Camp</span>
                                <span class="ukt-press-badge">Inner Growth</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Self Healing</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Holistic Wellness Program
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Celebrate Life Holistic Wellness, in association with Universal Knowledge Trust. One-of-a-kind wellness workshop at a 3-star sea-facing beach resort 6th April to 9th April 2024, at MANTHAN Beach Resort, Kapu,…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                June 25, 2026
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 7 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-7.jpg"
                                alt="Update – March 2024">
                            <figcaption class="visually-hidden">Update – March 2024</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Camps</span>
                                <span class="ukt-press-badge">Conclaves</span>
                                <span class="ukt-press-badge">Donation</span>
                                <span class="ukt-press-badge">Environment</span>
                                <span class="ukt-press-badge">Food on Wall</span>
                                <span class="ukt-press-badge">Healing</span>
                                <span class="ukt-press-badge">Healing Camp</span>
                                <span class="ukt-press-badge">Inner Growth</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Project Green</span>
                                <span class="ukt-press-badge">Retreats</span>
                                <span class="ukt-press-badge">Self Healing</span>
                                <span class="ukt-press-badge">Spirituality</span>
                                <span class="ukt-press-badge">Summer Camps</span>
                                <span class="ukt-press-badge">Training</span>
                                <span class="ukt-press-badge">Training Programmes for School Children</span>
                                <span class="ukt-press-badge">Universal Talks</span>
                                <span class="ukt-press-badge">Upliftment Programmes</span>
                                <span class="ukt-press-badge">We Support</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Update – March 2024
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Universal Knowledge Trust &#174; Krishna towers ladyhill Mangalore Score card March 2024 1) 50,000+ people are healed and are living a healthy life. 2) 65,000+ govt. School children trained to…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                March 31, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 8 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-8.jpg"
                                alt="Spirituality and you – Bengaluru">
                            <figcaption class="visually-hidden">Spirituality and you – Bengaluru</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Inner Growth</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Spirituality and you – Bengaluru
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Dear friends Atma Namaste &#128591; As you are aware Universal Knowledge Trust has been conducting different programs to uplift human consciousness. UKT will be organising Spirituality and you a unique…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                February 15, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 9 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-9.jpg"
                                alt="Spirituality and You – Mysore">
                            <figcaption class="visually-hidden">Spirituality and You – Mysore</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Spirituality and You – Mysore
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Dear friends Atma Namaste &#128591; As you are aware *Universal Knowledge Trust* has been conducting different programs to uplift human consciousness. UKT will be organising *Spirituality and you* a unique…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                January 20, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 10 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-10.jpg"
                                alt="Spirituality and you – Chikmagalur">
                            <figcaption class="visually-hidden">Spirituality and you – Chikmagalur</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Healing</span>
                                <span class="ukt-press-badge">Inner Growth</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Self Healing</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Spirituality and you – Chikmagalur
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Universal Knowledge Trust (R), Mangalore has organized a unique workshop on ‘The Spirituality &amp; You’ at Binary Exotica luxury hotels and resorts Chikkamagalur on Sunday 20-08-2023 from 09:30 am to…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                August 20, 2023
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 11 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-11.jpg"
                                alt="Coorg Retreat 2022">
                            <figcaption class="visually-hidden">Coorg Retreat 2022</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Environment</span>
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Project Green</span>
                                <span class="ukt-press-badge">Retreats</span>
                                <span class="ukt-press-badge">Spirituality</span>
                                <span class="ukt-press-badge">Upliftment Programmes</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Coorg Retreat 2022
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                Nestled in the heart of Madikeri, Karnataka is Coorg Gavadana where Universal Knowledge Trust conducted a retreat for 2022 on Nov 21&amp;22…
                            </p>

                            
                            <div class="ukt-press-card-date">
                                November 22, 2022
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 12 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-press-card">

                        
                        <figure class="ukt-press-card-thumb">
                            <img src="images/spirituality-articles/spirituality-article-12.jpg"
                                alt="Spirituality and You – Dharwad">
                            <figcaption class="visually-hidden">Spirituality and You – Dharwad</figcaption>
                        </figure>

                        
                        <div class="ukt-press-card-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-press-badge">Events</span>
                                <span class="ukt-press-badge">Healing</span>
                                <span class="ukt-press-badge">Inner Growth</span>
                                <span class="ukt-press-badge">Programmes</span>
                                <span class="ukt-press-badge">Self Healing</span>
                                <span class="ukt-press-badge">Spirituality</span>
                            </div>

                            
                            <h3 class="ukt-press-card-title">
                                Spirituality and You – Dharwad
                            </h3>

                            
                            <p class="ukt-press-card-desc">
                                One day program in 20 cities of India
                            </p>

                            
                            <div class="ukt-press-card-date">
                                October 15, 2022
                            </div>
                        </div>
                    </article>
                </div> -->

            </div>

        </div>
    </section>

</article>

<?php
get_footer();
?>