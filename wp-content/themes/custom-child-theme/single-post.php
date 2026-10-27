<?php
    get_header();
    $title = get_the_title();
    $thumb_url = get_the_post_thumbnail_url();
    $date = get_the_date('F j, Y');
    $categories = get_the_category();
    $tags = get_the_tags();
?>
    <article class="ukt-article-page">
        <!-- =========================================================
             ARTICLE HERO HEADER (MATCHING REFERENCE IMAGE DESIGN)
        ========================================================== -->
        <header class="ukt-article-hero mb-4 mb-lg-5">
            <div class="pt-3 ukt-article-header-wrapper">

                <!-- HERO CARD CONTAINER MATCHING USER REFERENCE IMAGE -->
                <div class="p-4 p-md-5 ukt-article-header-card">

                    <!-- MAIN TITLE -->
                    <h1 class="mb-4 ukt-article-hero-title">
                        <?php echo $title; ?>
                    </h1>

                    <!-- BADGES & DATE BAR -->
                    <div class="d-flex flex-wrap align-items-center gap-2 pt-1 mb-3">
                        <?php 
                            if(!empty($categories)) {
                                foreach($categories as $category){
                                    ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="badge ukt-badge-category-blue fw-medium"><?php echo $category->name?></a>
                                    <?php
                                }
                            }
                        ?>
                        <span class="text-secondary fw-bold mx-2 ukt-article-bullet-sep">•</span>
                        <span class="fw-normal text-secondary ukt-article-pub-date"><?php echo $date; ?></span>
                    </div>

                    <!-- HASHTAGS INSIDE HERO CARD CONTAINER -->
                    <div class="d-flex flex-wrap gap-1 pt-3 border-top border-secondary-subtle">
                        <?php 
                            if(!empty($tags)){
                                ?>
                                <span class="fw-semibold me-2 align-self-center text-secondary small"><i
                                class="bi bi-tags-fill me-1"></i>Tags:</span>
                                <?php
                                foreach($tags as $tag){
                                    ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge ukt-badge-tag-pill fw-normal">#<?php echo $tag->name; ?></a>
                                    <?php
                                }
                            }
                        ?>
                    </div>

                </div>

            </div>
        </header>

        <!-- =========================================================
             ARTICLE MAIN BODY & SIDEBAR CONTAINER
        ========================================================== -->
        <div class="container pb-5">
            <div class="row g-4 g-lg-5">

                <!-- MAIN ARTICLE CONTENT (LEFT COLUMN) -->
                <div class="col-lg-8">

                    <!-- FEATURED ARTICLE COVER IMAGE -->
                    <?php if ( $thumb_url ) : ?>
                    <div class="mb-4">
                        <figure class="ukt-article-featured-figure">
                            <img src="<?php echo $thumb_url; ?>"
                                alt="<?php echo $title; ?>" class="ukt-article-featured-img">
                            <figcaption class="visually-hidden"><?php echo $title; ?>
                            </figcaption>
                        </figure>
                    </div>
                    <?php endif; ?>

                    <!-- NARRATIVE PARAGRAPHS -->
                    <div class="article-body-text lead-text fs-5 mb-4 ukt-article-content-body text-start">
                        <!-- Changed <p> to <div> so wpautop works properly -->
                        <div class="">
                            <?php the_content(); ?>
                        </div>

                    </div>

                </div>


                <!-- SIDEBAR (RIGHT COLUMN) -->
                <div class="col-lg-4">
                    <div class="sticky-top ukt-article-sidebar-sticky">

                        <!-- RELATED POSTS WIDGET (DYNAMIC) -->
                        <div class="mb-4">
                            <h4 class="h6 fw-bold mb-3 ukt-article-sidebar-heading">
                                <i class="bi bi-journal-text me-2 text-success"></i>Related Posts
                            </h4>

                            <?php
                            // 1. Get current post categories
                            $current_categories = get_the_category();
                            $category_ids = array();
                            if ( ! empty( $current_categories ) ) {
                                foreach ( $current_categories as $cat ) {
                                    $category_ids[] = $cat->term_id;
                                }
                            }

                            // 2. Query related posts
                            if ( ! empty( $category_ids ) ) {
                                $related_args = array(
                                    'category__in'   => $category_ids,
                                    'post__not_in'   => array( get_the_ID() ), // Exclude current post
                                    'posts_per_page' => 3,
                                    'post_status'    => 'publish',
                                    'orderby'        => 'rand', // Randomize
                                );
                                
                                $related_query = new WP_Query( $related_args );

                                // 3. Loop through related posts
                                if ( $related_query->have_posts() ) {
                                    while ( $related_query->have_posts() ) {
                                        $related_query->the_post();
                                        
                                        $rel_title = get_the_title();
                                        $rel_link = get_the_permalink();
                                        $rel_date = get_the_date('M Y');
                                        $rel_thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                                        
                                        // Fallback if no image
                                        if ( ! $rel_thumb ) {
                                            $rel_thumb = get_template_directory_uri() . '/images/empty-cover.svg'; 
                                        }
                                        
                                        // Get up to 3 tags for badges
                                        $rel_tags = get_the_tags();
                                        $badges = array();
                                        if ( $rel_tags ) {
                                            $badges = array_slice( $rel_tags, 0, 3 );
                                        } else {
                                            $badges = array_slice( get_the_category(), 0, 3 );
                                        }
                                        ?>

                                        <!-- RELATED POST CARD (NOW AN <a> TAG) -->
                                        <a href="<?php echo esc_url( $rel_link ); ?>" class="card border-0 rounded-4 overflow-hidden shadow-sm mb-3 position-relative text-white ukt-related-post-card text-decoration-none d-block">
                                            <figure class="ukt-related-post-figure">
                                                <img src="<?php echo esc_url( $rel_thumb ); ?>" alt="<?php echo esc_attr( $rel_title ); ?>" title="<?php echo esc_attr( $rel_title ); ?>" loading="lazy" class="ukt-related-post-img">
                                                <div class="ukt-related-post-overlay"></div>
                                            </figure>
                                            
                                            <div class="card-body p-4 d-flex flex-column justify-content-between position-relative h-100 ukt-related-post-body">
                                                <!-- TOP: BADGES -->
                                                <div class="d-flex flex-wrap gap-1">
                                                    <?php 
                                                    if ( ! empty( $badges ) ) {
                                                        foreach ( $badges as $badge ) {
                                                            echo '<span class="badge ukt-related-post-badge fw-medium">' . esc_html( $badge->name ) . '</span>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                
                                                <!-- BOTTOM: TITLE AND DATE -->
                                                <div class="mt-auto pt-3">
                                                    <h5 class="lh-sm mb-2 ukt-related-post-title">
                                                        <?php echo esc_html( $rel_title ); ?>
                                                    </h5>
                                                    <div class="small text-white-50 ukt-related-post-date">
                                                        <i class="bi bi-calendar3 me-1 text-warning"></i> <?php echo esc_html( $rel_date ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    

                                        <?php
                                    } // End While Loop
                                    wp_reset_postdata(); // Reset post data
                                } else {
                                    echo '<p class="text-muted small">No related posts found.</p>';
                                }
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- =========================================================
             PREVIOUS & NEXT ARTICLE NAVIGATION (DYNAMIC)
        ========================================================== -->
        <section class="ukt-article-nav-section py-4">
            <div class="container py-md-2">
                <div class="row g-3 align-items-center">
                    
                    <?php
                    // Fetch previous and next posts
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>

                    <!-- PREVIOUS ARTICLE -->
                    <?php if ( ! empty( $prev_post ) ) : ?>
                        <div class="col-md-6">
                            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"
                                class="card h-100 border-0 rounded-4 p-3 p-md-4 text-decoration-none shadow-sm ukt-article-nav-card">
                                <div class="d-flex align-items-center gap-2 small mb-1 ukt-article-nav-meta">
                                    <i class="bi bi-arrow-left text-success fs-6"></i>
                                    <span class="fw-semibold text-uppercase ukt-article-nav-label">Previous Article</span>
                                </div>
                                <h6 class="mb-0 lh-sm fw-semibold ukt-article-nav-title">
                                    <?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
                                </h6>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- NEXT ARTICLE -->
                    <?php if ( ! empty( $next_post ) ) : ?>
                        <!-- If there is no previous post, add an offset to push this to the right -->
                        <div class="col-md-6 text-md-end <?php echo empty( $prev_post ) ? 'offset-md-6' : ''; ?>">
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"
                                class="card h-100 border-0 rounded-4 p-3 p-md-4 text-decoration-none shadow-sm ukt-article-nav-card">
                                <div
                                    class="d-flex align-items-center justify-content-md-end gap-2 small mb-1 ukt-article-nav-meta">
                                    <span class="fw-semibold text-uppercase ukt-article-nav-label">Next Article</span>
                                    <i class="bi bi-arrow-right text-success fs-6"></i>
                                </div>
                                <h6 class="mb-0 lh-sm fw-semibold ukt-article-nav-title">
                                    <?php echo esc_html( get_the_title( $next_post->ID ) ); ?>
                                </h6>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>


    </article>
<?php 
    get_footer();
?>