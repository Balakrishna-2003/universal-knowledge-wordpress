<?php 
/* Template Name: We Support Template */
get_header(); 
?>

<article>
    <?php get_template_part('page-banners'); ?>

    <!-- =========================================================
         SECTION: WE SUPPORT INTRO OVERVIEW
    ========================================================== -->
    <section id="we-support-overview" class="py-5 ukt-program-section-white">
        <div class="container py-lg-4">
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span> NOBLE INITIATIVES &amp; SEVA <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-section-main-title-serif">
                    Supporting Communities,<span>Empowering Lives</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span> <i class="bi bi-flower1"></i> <span></span>
                </div>
            </div>

            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="ukt-program-feature-outer">
                        <div class="ukt-program-feature-inner">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/universal-knowledge-trust-we-support-intro-img.jpg"
                                alt="Universal Knowledge Trust - We Support NGOs and Communities"
                                class="ukt-program-feature-img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ukt-program-hero-card">
                        <div class="ukt-program-hero-lead">
                            <p class="ukt-program-p-mb-10">
                                The Universal Knowledge team members and Healers identify NGOs that are making genuine and sustained efforts to uplift underprivileged communities.
                            </p>
                            <p class="ukt-program-p-mb-10">
                                This year, Universal Knowledge Trust (UKT) is supporting 12 NGOs. Our Trustees personally visit these organisations, understand their work, and hand over the donations directly after witnessing their efforts.
                            </p>
                            <p class="ukt-program-p-mb-10">
                                Our support is envisioned as a continuous endeavour—from providing monthly ration and essential supplies to helping organisations fulfil their dreams and initiatives through financial support and blessings.
                            </p>
                            <p class="mb-0">
                                If you have benefited from the work of Universal Knowledge, we invite you to join hands with us in this noble cause. Together, let us extend the spirit of service, uplift lives, and create a meaningful impact in our communities.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION: EXPLORING THEIR WORK (DYNAMIC POST LOOP)
    ========================================================== -->
    <section id="exploring-their-work" class="py-5 ukt-support-initiatives-section">
        <div class="container py-lg-4">
            
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span> INITIATIVES &amp; SEVA <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-section-main-title-serif">
                    Explore <span>Our Work</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span> <i class="bi bi-flower1"></i> <span></span>
                </div>
            </div>

            <div class="row g-4 ukt-paginated-grid" id="uktWorkGrid">
                <?php
                // 1. Setup the Query for the "we-support" category
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => -1, 
                    'category_name'  => 'we-support',
                    'post_status'    => 'publish',
                );
                $query = new WP_Query( $args );
                $counter = $query->post_count;

                if ( $query->have_posts() ) :
                    // $counter = 1; 
                    
                    while ( $query->have_posts() ) : $query->the_post();
                        $content = get_the_content();
                        
                        // Get Category
                        $category = get_the_category();
                        $cat_name = !empty($category) ? esc_html($category[0]->name) : 'Initiative';
                    ?>

                    <!-- DYNAMIC ITEM -->
                    <div class="col-12 ukt-work-item">
                        <div class="ukt-work-card">
                            <div>
                                <!-- Header / Tags -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="ukt-support-tag-num">#<?php echo sprintf('%02d', $counter); ?></span>
                                        <span class="ukt-support-tag-cat"><?php echo $cat_name; ?></span>
                                    </div>
                                    <span class="ukt-support-tag-src">UKT Initiative</span>
                                </div>
                                
                                <!-- Main Title -->
                                <h3 class="ukt-support-card-title"><?php the_title(); ?></h3>

                                <?php
                                // 2. Parse content to separate normal text from the shortcode
                                $pattern = '/(\[article_data[^\]]*\])/';
                                $content_parts = preg_split($pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

                                if ( ! empty( $content_parts ) ) {
                                    foreach ( $content_parts as $part ) {
                                        
                                        $part = trim( $part );
                                        if ( empty( $part ) ) continue;

                                        // CHECK 1: Is this the shortcode?
                                        if ( strpos( $part, '[article_data' ) !== false ) {
                                            
                                            preg_match('/\[article_data\s+urls="([^"]+)"\]/', $part, $matches);
                                            
                                            if ( ! empty( $matches[1] ) ) {
                                                $urls = explode( ',', $matches[1] );
                                                
                                                foreach ( $urls as $url ) {
                                                    $first_url = trim( $url );
                                                    $target_post_id = url_to_postid( $first_url );
                                                    
                                                    if ( $target_post_id ) {
                                                        $target_title   = get_the_title( $target_post_id );
                                                        $target_excerpt = wp_trim_words( get_the_excerpt( $target_post_id ), 25 );
                                                        $target_date    = get_the_date( 'F j, Y', $target_post_id );
                                                        $target_url     = get_permalink( $target_post_id );
                                                        ?>
                                                        
                                                        <!-- ==========================================
                                                             FEATURED ARTICLE UI
                                                        =========================================== -->
                                                        <a href="<?php echo esc_url( $target_url ); ?>" class="ukt-unique-article-link-card" style="margin-top: 15px; margin-bottom: 15px;">
                                                            <i class="bi bi-journal-check ukt-article-link-watermark"></i>
                                                            <div class="ukt-article-link-grid">

                                                                <!-- BADGE BLOCK -->
                                                                <div class="ukt-article-link-badge-col">
                                                                    <i class="bi bi-heart-pulse-fill ukt-article-link-icon"></i>
                                                                    <span class="ukt-article-link-type">FEATURED ARTICLE</span>
                                                                    <span class="ukt-article-link-time"><?php echo esc_html( $target_date ); ?></span>
                                                                </div>

                                                                <!-- CONTENT BLOCK -->
                                                                <div class="ukt-article-link-content">
                                                                    <div class="ukt-article-link-meta-row">
                                                                        <span class="ukt-article-link-pill"><?php echo strtoupper( $cat_name ); ?></span>
                                                                        <span class="ukt-article-link-source">
                                                                            <i class="bi bi-shield-check text-success"></i> Universal Knowledge Trust
                                                                        </span>
                                                                    </div>
                                                                    <h4 class="ukt-article-link-title">
                                                                        <?php echo esc_html( $target_title ); ?>
                                                                    </h4>
                                                                    <p class="ukt-article-link-snippet">
                                                                        <?php echo esc_html( $target_excerpt ); ?>
                                                                    </p>
                                                                </div>

                                                                <!-- CTA ACTION BUTTON -->
                                                                <div class="ukt-article-link-cta-col">
                                                                    <span class="ukt-article-link-btn">
                                                                        <span>Read Full Article</span>
                                                                        <i class="bi bi-arrow-right"></i>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </a>

                                                        <?php
                                                    }
                                                }
                                            }
                                        } 
                                        // CHECK 2: Is it normal text/images?
                                        else {
                                            
                                            // Extract all images from the content part
                                            preg_match_all('/<img[^>]+>/i', $part, $img_matches);
                                            $images = $img_matches[0];
                                            
                                            // Remove images from the text to get plain text
                                            $text_only = preg_replace('/<img[^>]+>/i', '', $part);
                                            $text_only = preg_replace('/<figure[^>]*>.*?<\/figure>/is', '', $text_only); 
                                            $text_only = trim($text_only);

                                            // 2a. Render the TEXT
                                            if ( ! empty( $text_only ) ) {
                                                ?>
                                                <div class="ukt-card-desc-wrap mb-3">
                                                    <div class="ukt-card-desc-text">
                                                        <?php echo wpautop( do_shortcode( $text_only ) ); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }

                                            // 2b. Render the IMAGES inside the specific grid
                                            if ( ! empty( $images ) ) {
                                                echo '<div class="row g-3 mt-3 pt-3 ukt-card-images-grid">';
                                                
                                                foreach ( $images as $img_tag ) {
                                                    // Ensure the image has the correct custom class for styling
                                                    if ( strpos( $img_tag, 'class="' ) !== false ) {
                                                        $img_tag = preg_replace('/class="([^"]*)"/', 'class="$1 ukt-work-thumb-img"', $img_tag);
                                                    } else {
                                                        $img_tag = str_replace('<img', '<img class="ukt-work-thumb-img"', $img_tag);
                                                    }
                                                    
                                                    // Add lazy loading if not present
                                                    if ( strpos( $img_tag, 'loading=' ) === false ) {
                                                        $img_tag = str_replace('<img', '<img loading="lazy"', $img_tag);
                                                    }
                                                    ?>
                                                    
                                                    <!-- IMAGE GRID COLUMN -->
                                                    <div class="col-12 col-sm-6 col-md-4 ukt-card-img-col">
                                                        <div class="ukt-work-thumb-frame">
                                                            <?php echo $img_tag; ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php
                                                }
                                                echo '</div>'; // End row
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                    $counter--; 
                    endwhile;
                    wp_reset_postdata();
                else : 
                    echo '<p>No initiatives found in this category.</p>';
                endif; 
                ?>
            </div>
            
            <!-- Pagination Container (JS will populate this) -->
            <div id="ukt-pagination-container" class="mt-5 text-center"></div>

        </div>
    </section>
</article>

<!-- =========================================================
     JAVASCRIPT FOR THE UI (Pagination, Lightbox, Load More, Read More)
========================================================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    
    // ==========================================
    // 1. JAVASCRIPT PAGINATION
    // ==========================================
    const gridItems = document.querySelectorAll('.ukt-paginated-grid .ukt-work-item');
    const paginationContainer = document.getElementById('ukt-pagination-container');
    const itemsPerPage = 5; // Change this to show more or fewer cards per page
    let currentPage = 1;

    function displayPage(page) {
        currentPage = page;
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Show/Hide items based on the page
        gridItems.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        renderPaginationButtons();
    }

    function renderPaginationButtons() {
        const totalPages = Math.ceil(gridItems.length / itemsPerPage);
        
        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let html = '<ul class="pagination justify-content-center" style="gap: 5px;">';

        // Previous Button
        html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:void(0);" data-page="${currentPage - 1}" style="border-radius: 8px; color: #114b4f; border-color: #eaeaea;">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                 </li>`;

        // Page Numbers
        for (let i = 1; i <= totalPages; i++) {
            const activeStyle = currentPage === i ? 'background-color: #114b4f; border-color: #114b4f; color: white;' : 'color: #114b4f; border-color: #eaeaea;';
            html += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                        <a class="page-link" href="javascript:void(0);" data-page="${i}" style="border-radius: 8px; font-weight: bold; ${activeStyle}">
                            ${i}
                        </a>
                     </li>`;
        }

        // Next Button
        html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:void(0);" data-page="${currentPage + 1}" style="border-radius: 8px; color: #114b4f; border-color: #eaeaea;">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                 </li>`;

        html += '</ul>';
        paginationContainer.innerHTML = html;

        // Add click events to new buttons
        paginationContainer.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetPage = parseInt(this.getAttribute('data-page'));
                if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                    displayPage(targetPage);
                    // Smooth scroll back to the top of the grid
                    document.getElementById('exploring-their-work').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    // Initialize pagination if items exist
    if (gridItems.length > 0) {
        displayPage(1);
    }

    // ==========================================
    // 2. CARD-LEVEL IMAGE "LOAD MORE" FUNCTIONALITY
    // ==========================================
    function initCardImagesLoadMore() {
        const cards = document.querySelectorAll(".ukt-work-card");
        const maxVisibleImages = 6;

        cards.forEach(function (card) {
            const imagesGrid = card.querySelector(".ukt-card-images-grid");
            if (!imagesGrid) return;

            const imageCols = Array.from(imagesGrid.children).filter(function (child) {
                return child.classList.contains("ukt-card-img-col");
            });

            if (imageCols.length <= maxVisibleImages) {
                return;
            }

            // Hide excess
            imageCols.forEach(function (col, idx) {
                col.classList.add("ukt-card-img-col");
                if (idx >= maxVisibleImages) {
                    col.classList.add("ukt-img-hidden");
                }
            });

            // Create action button container
            let actionWrap = card.querySelector(".ukt-card-images-action");
            if (!actionWrap) {
                actionWrap = document.createElement("div");
                actionWrap.className = "ukt-card-images-action text-center mt-3";
                imagesGrid.parentNode.insertBefore(actionWrap, imagesGrid.nextSibling);
            }

            const hiddenCount = imageCols.length - maxVisibleImages;
            actionWrap.innerHTML = `
                <button type="button" class="ukt-btn-card-load-more" data-expanded="false">
                    <span class="btn-label">View All ${imageCols.length} Images (+${hiddenCount})</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
            `;

            const btn = actionWrap.querySelector(".ukt-btn-card-load-more");
            btn.addEventListener("click", function () {
                const isExpanded = btn.getAttribute("data-expanded") === "true";
                const hiddenCols = imageCols.slice(maxVisibleImages);

                if (!isExpanded) {
                    hiddenCols.forEach(function (col) {
                        col.classList.remove("ukt-img-hidden");
                        col.style.opacity = "0";
                        col.style.transform = "translateY(12px)";
                        setTimeout(function () {
                            col.style.transition = "all 0.35s ease";
                            col.style.opacity = "1";
                            col.style.transform = "translateY(0)";
                        }, 40);
                    });
                    btn.setAttribute("data-expanded", "true");
                    btn.innerHTML = `
                        <span class="btn-label">Show Less</span>
                        <i class="bi bi-chevron-up"></i>
                    `;
                } else {
                    hiddenCols.forEach(function (col) {
                        col.classList.add("ukt-img-hidden");
                        col.style.opacity = "";
                        col.style.transform = "";
                    });
                    btn.setAttribute("data-expanded", "false");
                    btn.innerHTML = `
                        <span class="btn-label">View All ${imageCols.length} Images (+${hiddenCount})</span>
                        <i class="bi bi-chevron-down"></i>
                    `;
                }
            });
        });
    }

    // Initialize the image load more
    initCardImagesLoadMore();

    // ==========================================
    // 3. IMAGE GALLERY LIGHTBOX LOGIC
    // ==========================================
    const lightbox = document.getElementById("uktGalleryLightbox");
    if (lightbox) {
        const lightboxImg = document.getElementById("uktLightboxImage");
        const counter = document.getElementById("uktLightboxCounter");
        const closeBtn = document.getElementById("uktLightboxClose");
        const prevBtn = document.getElementById("uktLightboxPrev");
        const nextBtn = document.getElementById("uktLightboxNext");
        const backdrop = lightbox.querySelector(".ukt-lightbox-backdrop");
        
        const images = Array.from(document.querySelectorAll(".ukt-work-card img"));
        
        if (images.length > 0) {
            let currentIndex = 0;

            images.forEach((img, index) => {
                img.style.cursor = "pointer";
                img.addEventListener("click", () => openLightbox(index));
            });

            function openLightbox(index) {
                currentIndex = index;
                updateImage();
                lightbox.classList.add("is-active");
                document.body.style.overflow = "hidden";
            }

            function closeLightbox() {
                lightbox.classList.remove("is-active");
                document.body.style.overflow = "";
            }

            function updateImage() {
                if (currentIndex < 0) currentIndex = images.length - 1;
                if (currentIndex >= images.length) currentIndex = 0;
                lightboxImg.src = images[currentIndex].src;
                counter.textContent = (currentIndex + 1) + " / " + images.length;
            }

            closeBtn.addEventListener("click", closeLightbox);
            backdrop.addEventListener("click", closeLightbox);
            nextBtn.addEventListener("click", () => { currentIndex++; updateImage(); });
            prevBtn.addEventListener("click", () => { currentIndex--; updateImage(); });
        }
    }

    // ==========================================
    // 4. "READ MORE" DESCRIPTION TOGGLE
    // ==========================================
    const toggleBtns = document.querySelectorAll(".ukt-desc-toggle-btn");
    toggleBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const targetSelector = btn.getAttribute("data-target");
            const targetElem = document.querySelector(targetSelector);
            if (!targetElem) return;

            const isClamped = targetElem.classList.contains("ukt-desc-clamped");
            if (isClamped) {
                targetElem.classList.remove("ukt-desc-clamped");
                btn.innerHTML = `<span class="ukt-toggle-text">Read Less</span> <i class="bi bi-chevron-up"></i>`;
            } else {
                targetElem.classList.add("ukt-desc-clamped");
                btn.innerHTML = `<span class="ukt-toggle-text">... Read More</span> <i class="bi bi-chevron-down"></i>`;
            }
        });
    });
});
</script>

<?php get_footer(); ?>