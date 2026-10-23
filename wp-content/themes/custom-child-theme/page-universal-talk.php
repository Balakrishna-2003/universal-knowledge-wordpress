<?php
    /* Template Name: Universal Talk Template */
    get_header();
?>

    <article>
        <?php get_template_part('page-banners'); ?>

        <!-- =========================================================
         FEATURED VIDEOS (TOP HIGHLIGHTS)
    ========================================================== -->
        <section class="ukt-featured-videos-section ukt-featured-videos-bg">
            <div class="container">

                <!-- SECTION HEADER -->
                <div class="ukt-section-header">
                    <div class="ukt-section-eyebrow">
                        <span></span>
                        KEYNOTE &amp; HIGHLIGHTS
                        <span></span>
                    </div>
                    <h2 class="ukt-section-main-title">
                        Featured <span>Videos</span>
                    </h2>
                    <div class="ukt-section-heading-design">
                        <span></span>
                        <i class="bi bi-flower1"></i>
                        <span></span>
                    </div>
                    <p class="ukt-section-lead-text">
                        Signature discourses by Master Rohan Shiri that introduce the foundational philosophy of
                        Universal Knowledge, self-transformation, and inner peace.
                    </p>
                </div>

                <div class="row g-4">

                    <?php 
                        $featured_videos = ut_get_featured_videos();
                        if(!empty($featured_videos)) {
                            foreach($featured_videos as $videos){
                                $video_title = $videos['title'];
                                $video_id = ukt_get_youtube_thumbnail($videos['link']); // Ensure this function returns just the 11-char ID
                                $video_author = $videos['author'];
                                $video_tag = $videos['tag'];
                                $video_description = $videos['description'];
                                ?>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                    <div class="ukt-yt-screen-card">
                                        <div class="ukt-yt-screen" data-yt-id="<?php echo esc_attr($video_id); ?>"
                                            data-title="<?php echo esc_attr($video_title); ?>" title="Click to play video">
                                            <img src="https://img.youtube.com/vi/<?php echo esc_attr($video_id); ?>/hqdefault.jpg"
                                                alt="<?php echo esc_attr($video_title); ?>" loading="lazy">
                                            <span class="ukt-yt-duration-badge"><i class="bi bi-star-fill text-warning me-1"></i>
                                                Featured</span>
                                            <div class="ukt-yt-screen-top-bar">
                                                <div class="ukt-yt-channel-avatar">
                                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/universal-knowledge-trust-logo.png"
                                                        alt="Universal Knowledge Trust">
                                                </div>
                                                <div class="ukt-yt-channel-meta">
                                                    <h4 class="ukt-yt-screen-video-title"><?php echo esc_html($video_title); ?></h4>
                                                    <p class="ukt-yt-channel-subtext">Universal Talk • Official Channel</p>
                                                </div>
                                            </div>
                                            <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                                <svg viewBox="0 0 68 48" width="48" height="34">
                                                    <path class="yt-btn-bg"
                                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                                        fill="#ff0000"></path>
                                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                                </svg>
                                            </div>
                                            <div class="ukt-yt-screen-bottom-bar">
                                                <div class="ukt-yt-screen-watermark">
                                                    <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                                </div>
                                                <a href="https://www.youtube.com/watch?v=<?php echo esc_attr($video_id); ?>" target="_blank"
                                                    rel="noopener noreferrer" class="ukt-yt-watch-on-pill"
                                                    onclick="event.stopPropagation();">
                                                    Watch on <i class="bi bi-youtube"></i> YouTube
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ukt-yt-screen-details">
                                            <div class="ukt-yt-screen-meta-top">
                                                <span class="ukt-author-pill-badge"><?php echo trim_by_letters($video_tag, 18); ?></span>
                                                <span class="ukt-yt-speaker" title="<?php echo esc_attr($video_author); ?>"><i
                                                        class="bi bi-person-fill"></i> <?php echo esc_html($video_author); ?></span>
                                            </div>
                                            <h3 class="ukt-yt-screen-title"><?php echo esc_html($video_title); ?></h3>
                                            <p class="ukt-yt-screen-desc"><?php echo esc_html($video_description); ?></p>
                                            <div class="ukt-yt-screen-actions">
                                                <span class="text-muted small"><i class="bi bi-youtube text-danger me-1"></i>
                                                    Featured</span>
                                                <a href="javascript:void(0)" class="ukt-yt-watch-btn ukt-open-lightbox-btn"
                                                    data-yt-id="<?php echo esc_attr($video_id); ?>" data-title="<?php echo esc_attr($video_title); ?>">
                                                    <i class="bi bi-play-circle-fill"></i> Play Inline
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    ?>

                </div>

            </div>
        </section>

        <!-- =========================================================
         UNIVERSAL TALKS GALLERY & INTERACTIVE VIDEO HUB
    ========================================================== -->
        <section class="ukt-video-gallery-section ukt-video-gallery-bg" id="universal-talks-gallery">
            <div class="container">

                <!-- SECTION HEADER -->
                <div class="ukt-section-header">
                    <div class="ukt-section-eyebrow">
                        <span></span>
                        VIDEO ARCHIVE &amp; WORKSHOPS
                        <span></span>
                    </div>
                    <h2 class="ukt-section-main-title">
                        Explore Talks by <span>Topic &amp; City</span>
                    </h2>
                    <div class="ukt-section-heading-design">
                        <span></span>
                        <i class="bi bi-flower1"></i>
                        <span></span>
                    </div>
                    <p class="ukt-section-lead-text">
                        Watch insightful sessions from our workshops in Singapore, Bangalore, Mysore, Shivamogga,
                        Belgaum, and Environmental Conclaves.
                    </p>
                </div>

                <!-- ELFSIGHT GALLERY WIDGET -->
                <div class="row g-4" id="universalTalkGrid">
                    <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                    <div class="elfsight-app-8014a88e-49ef-4e70-ab9b-59be2b7bf94a" data-elfsight-app-lazy=""></div>
                </div>
                
                <!-- EMPTY CONTAINERS KEPT FOR STRUCTURAL PURPOSES (Elfsight handles the rest) -->
                <div class="ukt-gallery-pagination-wrap" id="talkPaginationContainer"></div>
                <div id="noTalksFound" class="text-center py-5 d-none"></div>

            </div>
        </section>

    </article>

    <!-- =========================================================
         UNIVERSAL TALK VIDEO LIGHTBOX MODAL
    ========================================================== -->
    <div class="ukt-video-modal" id="universalTalkModal" role="dialog" aria-modal="true"
        aria-labelledby="talkModalTitle">
        <div class="ukt-video-modal-dialog">
            <div class="ukt-video-modal-header">
                <h4 id="talkModalTitle"><i class="bi bi-youtube text-danger me-2"></i> Universal Talk</h4>
                <button type="button" class="ukt-video-modal-close" id="closeTalkModalBtn" aria-label="Close modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="ukt-video-modal-body ukt-video-modal-responsive">
                <iframe id="talkModalIframe" src="" title="YouTube Video Player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen class="ukt-video-modal-iframe">
                </iframe>
            </div>
        </div>
    </div>

        <!-- =========================================================
         INLINE JAVASCRIPT FOR FEATURED VIDEOS
    ========================================================== -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // 1. Inline Player on Screen click (For Featured Videos)
            document.querySelectorAll(".ukt-yt-screen").forEach(screen => {
                screen.addEventListener('click', function (e) {
                    // If they click the "Watch on YouTube" link, let it happen naturally
                    if (e.target.closest(".ukt-yt-watch-on-pill")) return;
                    
                    // 🔴 FIX: If the iframe is already loaded, stop here so the user can interact with the video player (pause, play, etc.)
                    if (this.querySelector('iframe')) return; 

                    e.preventDefault();
                    const ytId = this.getAttribute("data-yt-id");
                    if (!ytId) return;

                    // Replace content with iframe
                    this.innerHTML = `
                        <iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0"
                                title="YouTube Video Player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;z-index:10;">
                        </iframe>
                    `;
                    this.style.cursor = "default";
                });
            });

            // 2. Lightbox popup on action button click (For Featured Videos)
            document.querySelectorAll(".ukt-open-lightbox-btn").forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const ytId = this.getAttribute("data-yt-id");
                    const title = this.getAttribute("data-title");
                    
                    const modal = document.getElementById("universalTalkModal");
                    const modalTitle = document.getElementById("talkModalTitle");
                    const modalIframe = document.getElementById("talkModalIframe");

                    if (!modal || !modalIframe) return;
                    
                    if (modalTitle) modalTitle.textContent = title || "Universal Talk";
                    modalIframe.src = `https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0`;
                    modal.classList.add("is-open");
                    document.body.style.overflow = "hidden";
                });
            });

            // 3. Modal Close Logic
            const modal = document.getElementById("universalTalkModal");
            const modalIframe = document.getElementById("talkModalIframe");
            const closeBtn = document.getElementById("closeTalkModalBtn");

            function closeTalkModal() {
                if (!modal || !modalIframe) return;
                modal.classList.remove("is-open");
                modalIframe.src = "";
                document.body.style.overflow = "";
            }

            if (closeBtn) closeBtn.addEventListener('click', closeTalkModal);
            
            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeTalkModal();
                });
            }
            
            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape" && modal && modal.classList.contains("is-open")) {
                    closeTalkModal();
                }
            });
        });
    </script>

<?php 
    get_footer();
?>