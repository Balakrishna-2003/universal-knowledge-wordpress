<?php
    /* Template Name: Inspirational Videos Template */
    get_header();
?>
    <article>

    <?php get_template_part('page-banners');?>

    <!-- =========================================================
         AUTHOR INSPIRATIONAL VIDEO COLLECTIONS SECTION
    ========================================================== -->
    <section class="ukt-author-videos-section" id="videos">
        <div class="container">

            <!-- Section Header -->
            <div class="ukt-author-videos-header text-center">
                <span class="ukt-author-videos-tagline">
                    <i class="bi bi-play-btn-fill"></i> Discourses &amp; Wisdom
                </span>
                <h2 class="ukt-author-videos-heading">
                    Inspirational Video Series by Authors
                </h2>
                <p class="ukt-author-videos-lead">
                    Explore curated talks, healing perspectives, spiritual reflections, and life-changing wisdom shared by the guides and healers of Universal Knowledge Trust.
                </p>
            </div>

                        <!-- Author Video Cards Column List -->
            <div class="row g-4 justify-content-center">

            <?php
                // 1. Setup the Query
                $args = array(
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'category_name'  => 'inspirational-videos',
                    'posts_per_page' => 6,
                    'order_by'       => 'DESC'
                );
                $video_query = new WP_Query($args);

                // 2. Check if posts exist
                if ($video_query->have_posts()) : 
                    
                    // 3. Loop through posts
                    while ($video_query->have_posts()) : $video_query->the_post(); 
                        $title = get_the_title();
                        $permalink = get_the_permalink();
                        // Use featured image, fallback to a default if none exists
                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_stylesheet_directory_uri() . '/assets/images/inspirational-videos-sashidhar-shetty.jpg';
                       

                        $content = wp_trim_words(get_the_content(), 20, '...');
            ?>
                
                <!-- Dynamic Author Card -->
                <div class="col-xl-10 col-lg-11 col-12">
                    <div class="ukt-author-video-card">
                        <a href="<?php echo esc_url($permalink); ?>" class="ukt-author-card-link" aria-label="Watch <?php echo esc_attr($title); ?>">
                            <div class="ukt-author-card-inner">
                                
                                <!-- Left Image Visual -->
                                <div class="ukt-author-card-visual">
                                    <img src="<?php echo esc_url($image_url); ?>" 
                                         alt="<?php echo esc_attr($title); ?>" 
                                         loading="lazy">
                                    <div class="ukt-author-card-overlay"></div>
                                    
                                    <!-- Top Artistic Overlay Caption -->
                                    <div class="ukt-author-img-caption">
                                        <!-- <div class="caption-title"><?php echo $title;?></div> -->
                                        <div class="caption-author"><?php echo $title;?></div>
                                    </div>

                                    <!-- Bottom-Left Blue Camera Badge -->
                                    <div class="ukt-author-camera-badge" title="Video Series">
                                        <i class="bi bi-camera-video-fill"></i>
                                    </div>
                                </div>

                                <!-- Right Content Details -->
                                <div class="ukt-author-card-content">
                                    <?php
                                    $tags = get_the_tags();
                                    
                                    if ($tags) {
                                        ?>
                                        <div class="d-flex gap-30" style="margin-right: 10px">    
                                        <?php
                                        foreach ($tags as $tag) {
                                            ?>
                                                <span class="ukt-author-pill-badge"><?php echo esc_html($tag->name); ?></span>
                                                  
                                                <?php
                                        }
                                        ?>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <span class="ukt-author-pill-badge">INSPIRATIONAL VIDEOS</span>
                                        <?php
                                    }
                                    ?>
                                    
                                    <h3 class="ukt-author-card-title">
                                        <?php echo esc_html($title); ?>
                                    </h3>
                                    
                                    <div class="ukt-author-card-author-role">
                                        <i class="bi bi-patch-check-fill"></i> Healer &amp; Spiritual Guide
                                    </div>

                                    <p class="ukt-author-card-desc">
                                        <?php echo esc_html($content); ?>
                                    </p>

                                    <div class="ukt-author-card-meta">
                                        <span><i class="bi bi-clock-history"></i> Watch Now</span>
                                        <span class="ukt-author-card-btn">
                                            Watch Series <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>

            <?php 
                    endwhile; 
                    wp_reset_postdata(); // 4. Restore original post data
                else : 
            ?>
                
                <!-- 5. Fallback if no posts found -->
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">No Videos found</h3>
                    <p>Please add posts to the <strong>inspirational-videos</strong> category in WordPress.</p>
                </div>

            <?php endif; ?>

            </div>
        </div>
    </section>

</article>
<?php
    get_footer();
?>