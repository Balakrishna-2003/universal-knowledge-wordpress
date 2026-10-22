<?php
/* Template Name: Video Testimonials Template */
get_header();
?>
<article>
    <?php



    // Get the data
    $video_sections = el_get_video_sections_data();

    get_template_part('page-banners');

    ?>
        <!-- STICKY RETREAT QUICK JUMP BAR -->
        <nav class="ukt-video-jump-bar py-3" aria-label="Retreat video sections navigation">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center gap-2">
                    <span class="text-muted small fw-semibold me-2 d-none d-md-inline"><i class="bi bi-filter me-1"></i> Jump to Retreat:</span>

                    <?php
                    $serial = 1;
                        foreach ($video_sections as $titles) {
                            $count = count($titles['videos']);
                            if($serial > 4){
                                break;
                            }
                            ?>
                            <a href="#<?php echo $titles['title']; ?>" class="ukt-video-jump-pill">
                        <i class="bi bi-flower1 text-success"></i> <?php echo $titles['title'];?> <span class="ukt-video-count-badge"><?php echo $count; ?></span>
                    </a>
                    <?php
                        }
                    ?>

                    <!-- <a href="#inner-growth-2023" class="ukt-video-jump-pill">
                        <i class="bi bi-flower1 text-success"></i> Inner Growth 2023 <span class="ukt-video-count-badge">8</span>
                    </a>
                    <a href="#uk-retreat-2022" class="ukt-video-jump-pill">
                        <i class="bi bi-compass text-primary"></i> UK Retreat 2022 <span class="ukt-video-count-badge">8</span>
                    </a>
                    <a href="#upliftment-retreat-2021" class="ukt-video-jump-pill">
                        <i class="bi bi-sun text-warning"></i> Upliftment Retreat 2021 <span class="ukt-video-count-badge">3</span>
                    </a>
                    <a href="#beach-retreat-2020" class="ukt-video-jump-pill">
                        <i class="bi bi-water text-info"></i> Beach Retreat 2020 <span class="ukt-video-count-badge">7</span>
                    </a> -->
                </div>
            </div>
        </nav>
    <?php

    if (!empty($video_sections)) {
        foreach ($video_sections as $video) {
            $sec_title   = $video['title'];
            $sec_year    = $video['year'];
            $description = $video['description'];
            $videos    = $video['videos'];




    ?>
        
        
            <section id="<?php echo $sec_title; ?>" class="ukt-video-section ukt-featured-videos-bg">
                <div class="container">

                    <!-- SECTION HEADER -->
                    <div class="ukt-section-header text-center mb-4">
                        <div class="ukt-section-eyebrow">
                            <span></span>
                            RETREAT EXPERIENCES • <?php echo $sec_year; ?>
                            <span></span>
                        </div>
                        <h2 class="ukt-section-main-title ukt-serif-title">
                            <?php echo $sec_title; ?> <span><?php echo $sec_year; ?></span>
                        </h2>
                        <div class="ukt-section-heading-design">
                            <span></span>
                            <i class="bi bi-flower1"></i>
                            <span></span>
                        </div>
                        <p class="text-muted mx-auto mt-3 ukt-section-sub-desc-wide">
                            <?php echo $description; ?>
                        </p>
                    </div>

                    <!-- VIDEO CARDS GRID -->
                    <div class="row g-4 justify-content-center">

                        <?php
                        if (!empty($videos)) {
                        foreach ($videos as $video) {
                        $video_title = $video['title'];
                        $video_id = ukt_get_youtube_thumbnail($video['url']);
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="FlEPHe3wZpw" data-title="Inner Growth, Feedback back by Rajendra Amin" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/<?php echo $video_id;?>/hqdefault.jpg" alt="Inner Growth, Feedback back by Rajendra Amin" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title"><?php echo $sec_title.' '.$sec_year;?></h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/<?php echo $video_id;?>" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title"><?php echo $video_title; ?></h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }
                        ?>

                        <!-- CARD 1 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="FlEPHe3wZpw" data-title="Inner Growth, Feedback back by Rajendra Amin" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/FlEPHe3wZpw/hqdefault.jpg" alt="Inner Growth, Feedback back by Rajendra Amin" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/FlEPHe3wZpw" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner Growth, Feedback back by Rajendra Amin</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 2 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="Ncr8dcaZa3I" data-title="Feedback Inner Growth 23 by Shree Nidhi" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/Ncr8dcaZa3I/hqdefault.jpg" alt="Feedback Inner Growth 23 by Shree Nidhi" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/Ncr8dcaZa3I" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Feedback Inner Growth 23 by Shree Nidhi</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 3 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="zHjg3ogcDtM" data-title="Inner Growth Feedback Suhas Shetty" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/zHjg3ogcDtM/hqdefault.jpg" alt="Inner Growth Feedback Suhas Shetty" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/zHjg3ogcDtM" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner Growth Feedback Suhas Shetty</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 4 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="y_v6l6L5N1w" data-title="Inner Growth Feedback from Amitha HA" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/y_v6l6L5N1w/hqdefault.jpg" alt="Inner Growth Feedback from Amitha HA" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/y_v6l6L5N1w" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner Growth Feedback from Amitha HA</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 5 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="z7RJ4NYuOhA" data-title="Inner growth - Feedback from Daneshwari &amp; Veeresh" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/z7RJ4NYuOhA/hqdefault.jpg" alt="Inner growth - Feedback from Daneshwari &amp; Veeresh" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/z7RJ4NYuOhA" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner growth - Feedback from Daneshwari &amp; Veeresh</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 6 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="QAP8MXiSQ-I" data-title="Inner Growth Feedback Ravi and Prakash" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/QAP8MXiSQ-I/hqdefault.jpg" alt="Inner Growth Feedback Ravi and Prakash" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/QAP8MXiSQ-I" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner Growth Feedback Ravi and Prakash</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 7 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="iwq1njVSNe0" data-title="Inner growth feedback – Madhava and Vijay" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/iwq1njVSNe0/hqdefault.jpg" alt="Inner growth feedback – Madhava and Vijay" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/iwq1njVSNe0" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner growth feedback – Madhava and Vijay</h3>
                                </div>
                            </div>
                        </div> -->

                        <!-- CARD 8 -->
                        <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                            <div class="ukt-yt-screen-card w-100">
                                <div class="ukt-yt-screen" data-yt-id="JNGj5SfL06U" data-title="Inner growth feedback - Devaraj and Venkatesh" title="Click to play video">
                                    <img src="https://img.youtube.com/vi/JNGj5SfL06U/hqdefault.jpg" alt="Inner growth feedback - Devaraj and Venkatesh" class="ukt-yt-screen-thumb" loading="lazy" onerror="this.onerror=null; this.src='images/universal-knowledge-retreats.jpg';">
                                    <span class="ukt-yt-duration-badge"><i class="bi bi-play-circle-fill me-1"></i> Video</span>
                                    <div class="ukt-yt-screen-top-bar">
                                        <div class="ukt-yt-channel-avatar">
                                            <img src="images/universal-knowledge-trust-logo.png" alt="Universal Knowledge Trust">
                                        </div>
                                        <div class="ukt-yt-channel-meta">
                                            <h4 class="ukt-yt-screen-video-title">Inner Growth 2023</h4>
                                            <p class="ukt-yt-channel-subtext">Universal Knowledge Trust</p>
                                        </div>
                                    </div>
                                    <div class="ukt-yt-center-play-btn" aria-label="Play Video">
                                        <svg viewBox="0 0 68 48" width="48" height="34">
                                            <path class="yt-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                        </svg>
                                    </div>
                                    <div class="ukt-yt-screen-bottom-bar">
                                        <div class="ukt-yt-screen-watermark">
                                            <i class="bi bi-flower1"></i> Universal Knowledge Trust
                                        </div>
                                        <a href="https://youtu.be/JNGj5SfL06U" target="_blank" rel="noopener noreferrer" class="ukt-yt-watch-on-pill" onclick="event.stopPropagation();" title="Open on YouTube">
                                            Watch on <i class="bi bi-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                                <div class="ukt-yt-screen-details">
                                    <div class="ukt-yt-screen-meta-top">
                                        <span class="ukt-author-pill-badge"><i class="bi bi-calendar-check me-1"></i> Inner Growth 2023</span>
                                        <span class="ukt-yt-speaker" title="Participant Feedback"><i class="bi bi-chat-heart-fill me-1 text-success"></i> Testimonial</span>
                                    </div>
                                    <h3 class="ukt-yt-screen-title">Inner growth feedback - Devaraj and Venkatesh</h3>
                                </div>
                            </div>
                        </div> -->

                    </div>

                </div>
            </section>
    <?php
        }
    }
    ?>
</article>

<script>
    // Inline YouTube Video Player Handler
    document.querySelectorAll(".ukt-yt-screen").forEach(function(screen) {
        screen.addEventListener("click", function(e) {
            if (e.target.closest(".ukt-yt-watch-on-pill")) return;
            e.preventDefault();
            const ytId = this.getAttribute("data-yt-id");
            if (!ytId) return;

            this.innerHTML = `
                        <iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0" 
                                title="YouTube Video Player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen 
                                class="ukt-video-modal-iframe-z">
                        </iframe>
                    `;
            this.style.cursor = "default";
        });
    });
</script>

<?php
get_footer();
?>