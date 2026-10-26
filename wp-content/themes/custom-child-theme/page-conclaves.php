<?php 
/* Template Name: Conclaves Template */
get_header(); 
?>

<article>
    <?php get_template_part('page-banners'); ?>


    <!-- =========================================================
         SECTION: ARTICLES & INSIGHTS ON CONCLAVES
    ========================================================== -->
    <section id="articles" class="py-5 ukt-conclaves-articles-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span> GATHERINGS &amp; SUMMITS <span></span>
                </div>
                <h2 class="ukt-section-main-title">
                    Inspiring <span>Conclaves &amp; Summits</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span> <i class="bi bi-flower1"></i> <span></span>
                </div>
            </div>

            <!-- ARTICLES GRID (3 COLUMNS) -->
            <div class="row g-4 ukt-paginated-grid" id="conclavesGrid">
                <?php
                // 1. Setup the Query for the "conclaves" category
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => -1, // Fetch all, let JS handle pagination
                    'category_name'  => 'conclaves', 
                    'post_status'    => 'publish',
                );
                $query = new WP_Query( $args );

                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post();
                        
                        // Get Featured Image (Fallback to placeholder if none)
                        $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $thumb_url ) {
                            $thumb_url = get_stylesheet_directory_uri() . '/images/conclave-artilcle/empty-cover.svg';
                        }

                        // Get Categories for the Pills
                        $categories = get_the_category();
                        ?>
                        
                        <!-- DYNAMIC ARTICLE CARD -->
                        <div class="col-lg-4 col-md-6 col-12 ukt-paginated-item">
                            
                            <!-- WRAPPED IN PERMALINK TAG -->
                            <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: inherit; display: block;">
                                <article class="ukt-article-card">

                                    <!-- Cover Image Container -->
                                    <figure class="ukt-article-cover">
                                        <img src="<?php echo esc_url( $thumb_url ); ?>"
                                             alt="<?php echo esc_attr( get_the_title() ); ?>">
                                        <figcaption class="visually-hidden"><?php echo esc_attr( get_the_title() ); ?></figcaption>
                                    </figure>

                                    <!-- Card Body -->
                                    <div class="ukt-article-body">

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
                                                        <span class="ukt-article-pill"><?php echo esc_html($category->name); ?></span>
                                                        <?php
                                                        $serial++;
                                                    } else if($serial == 1){
                                                        ?>
                                                        <span class="ukt-article-pill"><?php echo esc_html($category->name); ?></span>
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
                                        <h3 class="ukt-article-title">
                                            <?php the_title(); ?>
                                        </h3>

                                        <!-- Description (Excerpt limited to ~25 words) -->
                                        <p class="ukt-article-desc">
                                            <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                                        </p>

                                        <!-- Date -->
                                        <div class="ukt-article-date">
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
                    echo '<div class="col-12"><p>No conclaves found in this category.</p></div>';
                endif; 
                ?>
            </div>

            <!-- Pagination Container (JS will populate this) -->
            <div id="conclaves-pagination" class="mt-5 text-center"></div>

        </div>
    </section>
</article>

<!-- =========================================================
     JAVASCRIPT PAGINATION (6 ITEMS PER PAGE)
========================================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const gridItems = document.querySelectorAll('.ukt-paginated-grid .ukt-paginated-item');
        const paginationContainer = document.getElementById('conclaves-pagination');
        const itemsPerPage = 6;
        let currentPage = 1;

        if (gridItems.length === 0) return;

        function displayPage(page) {
            currentPage = page;
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            // Hide/Show cards
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

            // Add click events
            paginationContainer.querySelectorAll('.page-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetPage = parseInt(this.getAttribute('data-page'));
                    if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                        displayPage(targetPage);
                        // Scroll to top of articles section
                        document.getElementById('articles').scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        }

        // Initialize
        displayPage(1);
    });
</script>

<?php get_footer(); ?>