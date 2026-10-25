<?php 
/* Template Name: Nature Retreats Template */
get_header(); 
?>

<article>
    <?php get_template_part('page-banners'); ?>

    <!-- =========================================================
         SECTION: ARTICLES & INSIGHTS ON NATURE RETREATS
    ========================================================== -->
    <section id="articles" class="py-5 ukt-articles-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span> EXPERIENCE &amp; RENEWAL <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-section-main-title-serif">
                    Sacred <span>Nature Retreats</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span> <i class="bi bi-flower1"></i> <span></span>
                </div>
            </div>

            <!-- ARTICLES GRID (3 COLUMNS) -->
            <div class="row g-4 ukt-paginated-grid" id="natureRetreatsGrid">
                <?php
                // 1. Setup the Query for the "nature-retreats" category
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => -1, // Fetch all, let JS handle pagination
                    'category_name'  => 'nature-retreats', 
                    'post_status'    => 'publish',
                );
                $query = new WP_Query( $args );

                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post();
                        
                        // Get Featured Image (Fallback to placeholder if none)
                        $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $thumb_url ) {
                            $thumb_url = get_stylesheet_directory_uri() . '/images/nature-retreats-articles/empty-cover.svg';
                        }

                        // Get Categories for the Pills
                        $categories = get_the_category();
                        ?>
                        
                        <!-- DYNAMIC ARTICLE CARD -->
                        <div class="col-lg-4 col-md-6 col-12 ukt-paginated-item">
                            
                            <!-- WRAPPED IN PERMALINK TAG -->
                            <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit; display: block;">
                                <article class="ukt-card-articles">

                                    <!-- Cover Image Container -->
                                    <figure class="ukt-card-articles-figure">
                                        <img src="<?php echo esc_url( $thumb_url ); ?>"
                                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                                             class="ukt-card-articles-img"
                                             loading="lazy">
                                        <figcaption class="visually-hidden"><?php echo esc_attr( get_the_title() ); ?></figcaption>
                                    </figure>

                                    <!-- Card Body -->
                                    <div class="ukt-card-articles-body">

                                        <!-- Category Pills (Limited to 3 categories or 24 characters) -->
                                        <?php if ( ! empty( $categories ) ) : ?>
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <?php
                                                $serial = 1;
                                                $cat_count = 0;
                                                
                                                foreach ($categories as $category) {
                                                    $cat_count += mb_strlen($category->name);
                                                    
                                                    if ($serial <= 3 && $cat_count <= 24) {
                                                        ?>
                                                        <span class="ukt-card-articles-tag"><?php echo esc_html($category->name); ?></span>
                                                        <?php
                                                        $serial++;
                                                    } else if($serial == 1){
                                                        ?>
                                                        <span class="ukt-card-articles-tag"><?php echo esc_html($category->name); ?></span>
                                                        <?php
                                                        echo '<span>...</span>';
                                                        break;
                                                    } else {
                                                        echo '<span>...</span>';
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Title -->
                                        <h3 class="ukt-card-articles-title">
                                            <?php the_title(); ?>
                                        </h3>

                                        <!-- Description (Excerpt limited to ~25 words) -->
                                        <p class="ukt-card-articles-desc">
                                            <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                                        </p>

                                        <!-- Date -->
                                        <div class="ukt-card-articles-footer">
                                            <?php echo get_the_date( 'F j, Y' ); ?>
                                        </div>
                                    </div>
                                </article>
                            </a>

                        </div>

                    <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<div class="col-12"><p>No retreats found in the "Nature Retreats" category.</p></div>';
                endif; 
                ?>
            </div>

            <!-- Pagination Container (JS will populate this) -->
            <div id="nature-retreats-pagination" class="mt-5 text-center"></div>

        </div>
    </section>
</article>



<?php get_footer(); ?>