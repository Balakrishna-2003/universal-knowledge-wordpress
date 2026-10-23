<?php
/* Template Name: Our Events Template */
get_header();
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1, // Use -1 to show all posts, or a number like 10
    'category_name'  => 'events', // The slug of the parent category
    'post_status'    => 'publish',
);
$posts = new WP_Query($args);

?>
<article>
    <?php get_template_part('page-banners'); ?>


    <!-- =========================================================
             SECTION: ARTICLES & OUR EVENTS
        ========================================================== -->
    <section id="articles" class="py-5 ukt-articles-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    EVENTS &amp; RETREATS
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title">
                    All <span>Our Events</span>
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
                                <article class="ukt-article-card">

                                    <!-- Cover Image Container -->
                                    <figure class="ukt-article-cover">
                                        <img src="<?php echo $thumbnail_url; ?>"
                                            alt="<?php echo $title; ?>"
                                            loading="lazy">
                                        <figcaption class="visually-hidden"><?php echo $title; ?></figcaption>
                                    </figure>

                                    <!-- Card Body -->
                                    <div class="ukt-article-body">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <?php
                                            $serial = 1;
                                            foreach ($categories as $category) {
                                                // echo esc_html($category->name);
                                                $cat_count += mb_strlen($category->name);
                                                if ($serial <= 3 && $cat_count <= 24) {
                                            ?>
                                                    <a class="ukt-article-pill" href="<?php echo esc_url(get_category_link($category->term_id)) ?>"><?php echo $category->name; ?></a>
                                            <?php
                                                    $serial++;
                                                } else {
                                                    echo '<span>...<span>';
                                                    break;
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!-- Category Pills -->
                                        <!-- <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Retreats</span>
                                    </div> -->

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
                }
                ?>


                <!-- ARTICLE CARD 1 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-article-card">

                        
                        <figure class="ukt-article-cover">
                            <img src="images/nature-retreats-articles/nature-retreat-1.jpg"
                                alt="Mansoon Retreat 2024 – Planet Hollywood Goa"
                                loading="lazy">
                            <figcaption class="visually-hidden">Mansoon Retreat 2024 – Planet Hollywood Goa</figcaption>
                        </figure>

                        
                        <div class="ukt-article-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-article-pill">Retreats</span>
                            </div>

                            
                            <h3 class="ukt-article-title">
                                Mansoon Retreat 2024
                            </h3>

                            
                            <p class="ukt-article-desc">
                                Universal Knowledge presents the Mansoon Retreat 2024 at Planet Hollywood Goa, nestled on the picturesque Uttorda Beach. Choose from 2-night/3-day or 3-night/4-day options, with rates inclusive of all taxes and…
                            </p>

                            
                            <div class="ukt-article-date">
                                July 15, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 2 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-article-card">

                        
                        <figure class="ukt-article-cover">
                            <img src="images/nature-retreats-articles/nature-retreat-2.jpg"
                                alt="Update – March 2024"
                                loading="lazy">
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
                                <span class="ukt-article-pill">Inner Growth Programmes</span>
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
                                Universal Knowledge Trust &#174; Krishna towers ladyhill Mangalore Score card March 2024 1) 50,000+ people are healed and are living a healthy life. 2) 65,000+ govt. School children trained to…
                            </p>

                            
                            <div class="ukt-article-date">
                                March 31, 2024
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 3 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/nature-retreats-articles/nature-retreat-3.jpg"
                                     alt="Monsoon Retreat- Chikkamagaluru"
                                     loading="lazy">
                                <figcaption class="visually-hidden">Monsoon Retreat- Chikkamagaluru</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Retreats</span>
                                </div>

                             
                                <h3 class="ukt-article-title">
                                    Monsoon Retreat- Chikkamagaluru
                                </h3>

                                
                                <p class="ukt-article-desc">
                                    Universal Knowledge Monsoon retreat chickmangalur on 2nd - 4th July 2023 Universal Knowledge®, a Spiritual and wellness organization, is hosting a Monsoon Retreat at Honeydewwz Exoticaa Chickmagalur , a scenic hill station…
                                </p>

                                
                                <div class="ukt-article-date">
                                    July 04, 2023
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 4 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                        <article class="ukt-article-card">

                            
                            <figure class="ukt-article-cover">
                                <img src="images/nature-retreats-articles/nature-retreat-4.jpg"
                                     alt="Coorg Retreat 2022"
                                     loading="lazy">
                                <figcaption class="visually-hidden">Coorg Retreat 2022</figcaption>
                            </figure>

                            
                            <div class="ukt-article-body">

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="ukt-article-pill">Environment</span>
                                    <span class="ukt-article-pill">Events</span>
                                    <span class="ukt-article-pill">Project Green</span>
                                    <span class="ukt-article-pill">Retreats</span>
                                    <span class="ukt-article-pill">Spirituality</span>
                                    <span class="ukt-article-pill">Upliftment Programmes</span>
                                </div>

                                
                                <h3 class="ukt-article-title">
                                    Coorg Retreat 2022
                                </h3>

                               
                                <p class="ukt-article-desc">
                                    Nestled in the heart of Madikeri, Karnataka is Coorg Gavadana where Universal Knowledge Trust conducted a retreat conducted on November 21st and 22nd, 2022.
                                </p>

                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <a href="https://youtu.be/3JhDRdqS8Qk" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 1</a>
                                    <a href="https://youtu.be/Ci127rcQc8s" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 2</a>
                                    <a href="https://youtu.be/CpErtk_rHMA" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 3</a>
                                    <a href="https://youtu.be/0kYgGIPE1SU" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 4</a>
                                    <a href="https://youtu.be/VG2ZHwo_Sc8" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 5</a>
                                    <a href="https://youtu.be/qideI9wSeeY" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 6</a>
                                    <a href="https://youtu.be/9ok4qMgYjME" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 7</a>
                                    <a href="https://youtu.be/kVm17D7TmOk" target="_blank" rel="noopener noreferrer" class="ukt-press-video-pill"><i class="bi bi-play-circle-fill text-danger"></i>Video 8</a>
                                </div>

                                
                                <div class="ukt-article-date">
                                    November 22, 2022
                                </div>
                            </div>
                        </article>
                    </div> -->

                <!-- ARTICLE CARD 5 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-article-card">

                        
                        <figure class="ukt-article-cover">
                            <img src="images/nature-retreats-articles/nature-retreat-5.jpg"
                                alt="Monsoon Retreat 2021"
                                loading="lazy">
                            <figcaption class="visually-hidden">Monsoon Retreat 2021</figcaption>
                        </figure>

                        
                        <div class="ukt-article-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-article-pill">Retreats</span>
                                <span class="ukt-article-pill">Upliftment Programmes</span>
                            </div>

                            
                            <h3 class="ukt-article-title">
                                Monsoon Retreat 2021
                            </h3>

                            
                            <p class="ukt-article-desc">
                                Universal Knowledge Trust hosted the Monsoon Retreat 2021, bringing seekers together for deep spiritual rejuvenation, meditation, and inner upliftment in nature.
                            </p>

                            
                            <div class="ukt-article-date">
                                July 2021
                            </div>
                        </div>
                    </article>
                </div> -->

                <!-- ARTICLE CARD 6 -->
                <!-- <div class="col-lg-4 col-md-6 col-12">
                    <article class="ukt-article-card">

                        
                        <figure class="ukt-article-cover">
                            <img src="images/nature-retreats-articles/empty-cover.svg"
                                alt="UKS Upliftment Beach Retreat"
                                loading="lazy">
                            <figcaption class="visually-hidden">UKS Upliftment Beach Retreat</figcaption>
                        </figure>

                        
                        <div class="ukt-article-body">

                            
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="ukt-article-pill">Camps</span>
                                <span class="ukt-article-pill">Healing Camp</span>
                                <span class="ukt-article-pill">Programmes</span>
                                <span class="ukt-article-pill">Retreats</span>
                                <span class="ukt-article-pill">Upliftment Programmes</span>
                            </div>

                            
                            <h3 class="ukt-article-title">
                                UKS Upliftment Beach Retreat
                            </h3>

                            
                            <p class="ukt-article-desc">
                                3 to 4 days UKs Upliftment Beach Retreat from Dec 02 to Dec 05, 2020 at Sai Radha Heritage beach resort, Kapu. Udupi district. Limited seats. You are welcome to…
                            </p>

                            
                            <div class="ukt-article-date">
                                December 05, 2020
                            </div>
                        </div>
                    </article>
                </div> -->

            </div>

            <!-- =========================================================
                     PAGINATION CONTAINER
                ========================================================== -->
            <div class="ukt-gallery-pagination-wrap mt-5" id="eventsPagination" role="navigation" aria-label="Events Pagination">
                <!-- Pagination dynamically rendered via JavaScript -->
            </div>

        </div>
    </section>

</article>



<!-- =========================================================
         EVENTS PAGINATION SCRIPT
    ========================================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const eventsContainer = document.querySelector("#articles .row.g-4");
        const paginationEl = document.getElementById("eventsPagination");

        if (!eventsContainer || !paginationEl) return;

        // Select all event cards inside the row
        const items = Array.from(eventsContainer.querySelectorAll(".col-lg-4"));
        const ITEMS_PER_PAGE = 6; // Change this number to show more/less per page
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
                        Showing <strong>${startIdx}–${endIdx}</strong> of <strong>${totalItems}</strong> events
                    </div>
                `;

            paginationEl.innerHTML = buttonsHTML;

            // Attach click events to buttons
            paginationEl.querySelectorAll(".ukt-page-btn:not(:disabled)").forEach(btn => {
                btn.addEventListener("click", function() {
                    const targetPage = parseInt(this.getAttribute("data-page"), 10);
                    if (targetPage && targetPage !== currentPage && targetPage >= 1 && targetPage <= totalPages) {
                        currentPage = targetPage;
                        updatePage();

                        // Scroll smoothly back to the top of the section
                        const sectionTop = document.getElementById("articles").getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({
                            top: sectionTop,
                            behavior: "smooth"
                        });
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