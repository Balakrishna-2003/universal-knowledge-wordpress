<?php
/* Template Name: Downloads for school training program Template */
get_header();
$pdfs = ds_get_downloadable_materials();
$audios = ds_get_downloadable_audios();
$videos = ds_get_daily_practice_videos();

// echo '<span class="text-center">' . $extension . '</span>';


?>

<article>

    <!-- =========================================================
         E-LETTERS BANNER / HERO SECTION
         (Matches index.html showcase hero layout)
    ========================================================== -->
    <section class="ukt-hero-showcase">
        <div class="ukt-hero-slide-layout">
            <div class="container-fluid">
                <div class="row g-0 align-items-stretch">

                    <!-- LEFT CONTENT AREA -->
                    <div class="col-lg-5 d-flex align-items-center">
                        <div class="ukt-hero-copy-zone">
                            <div class="ukt-hero-left-decoration"></div>

                            <div class="ukt-hero-slide-kicker">
                                Universal Knowledge Trust
                            </div>

                            <h1 class="ukt-hero-main-title">
                                <span>Downloads for School</span>
                                <span>Training Program</span>
                            </h1>

                            <div class="ukt-hero-script-line">
                                From Universal Knowledge
                            </div>

                            <p class="ukt-hero-description">
                                This programme can bring great results immediately and the details of which are as mentioned in the brochure below. Submit your details if interested in participating. Submission form is at <a href="universal-knowledge-trust-training-programs.html">Training Programs</a>
                            </p>

                            <div class="ukt-hero-action-row">
                                <a href="#training-downloads" class="ukt-hero-primary-action">
                                    Download Resources
                                    <i class="bi bi-cloud-arrow-down"></i>
                                </a>
                                <a href="#training-audios" class="ukt-hero-secondary-action">
                                    Audio Sessions
                                    <i class="bi bi-headphones"></i>
                                </a>
                                <a href="#training-videos" class="ukt-hero-secondary-action">
                                    Watch Videos
                                    <i class="bi bi-play-circle"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT IMAGE AREA -->
                    <div class="col-lg-7">
                        <div class="ukt-hero-visual-zone">
                            <div class="ukt-hero-image-frame">
                                <img src="images/download-for-school-training-program-banner.png"
                                    alt="Downloads for School Training Program - UKT"
                                    title="Downloads for School Training Program - UKT" loading="eager">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 1: DOWNLOADS & TRAINING MATERIALS (PDF & EXCEL)
    ========================================================== -->
    <section class="ukt-stp-section ukt-stp-section-alt" id="training-downloads">
        <span id="training-pdfs"></span>
        <div class="container">

            <!-- Section Header -->
            <div class="ukt-stp-header">
                <span class="ukt-stp-badge">
                    <i class="bi bi-cloud-arrow-down-fill text-danger"></i> Downloads &amp; Resources
                </span>
                <h2 class="ukt-stp-heading">
                    Downloads &amp; Training Materials
                </h2>
                <p class="ukt-stp-lead">
                    Download official program brochures and Excel training status tracking templates for schools and educators.
                </p>
            </div>

            <!-- Simple Download Items Grid -->
            <div class="row g-4 justify-content-center">

                <?php
                if (!empty($pdfs)) {
                    // echo 'slkdfjlskj<br>';
                    foreach ($pdfs as $pdf) {
                        $url_path = parse_url($pdf['file_url'], PHP_URL_PATH);



$icon = '';
$label = '';
$tagline = '';
$extension = strtolower(
    pathinfo($url_path ?? '', PATHINFO_EXTENSION)
);
                        // echo $pdf['title'];
                        if (!empty($url_path) && esc_url($url_path) !== '') {
                            // $extension = 'pdf';
                            // echo $extension;

                            switch ($extension) {

                                // PDF files (viewable in browser)
case 'pdf':
    $icon = '<i class="bi bi-file-earmark-pdf-fill"></i>';
    $label = '<a href="' . esc_url($pdf['file_url']) . '"
    target="_blank" rel="noopener noreferrer" class="ukt-dl-btn"
    title="View Brochure PDF">
    <i class="bi bi-eye"></i> View
</a>
<a href="' . esc_url($pdf['file_url']) . '"
    download="' . esc_attr(basename(wp_parse_url($pdf['file_url'], PHP_URL_PATH))) . '" class="ukt-dl-btn"
    title="Download Brochure PDF">
    <i class="bi bi-download"></i> Download
</a>';
    $tagline = 'PDF Document • Universal Knowledge Trust';
    break;

// Excel files (not viewable in browser → download only)
case 'xls':
case 'xlsx':
case 'xlsm':
    $icon = '<i class="bi bi-file-earmark-excel-fill"></i>';
    $label = '<a href="' . esc_url($pdf['file_url']) . '"
        download="' . esc_attr(basename(wp_parse_url($pdf['file_url'], PHP_URL_PATH))) . '" class="ukt-dl-btn"
        title="Download Excel File">
        <i class="bi bi-download"></i> Download
    </a>';
    $tagline = 'Excel Document • Universal Knowledge Trust';
    break;

// Word documents (not viewable in browser → download only)
case 'doc':
case 'docx':
    $icon = '<i class="bi bi-file-earmark-word-fill"></i>';
    $label = '<a href="' . esc_url($pdf['file_url']) . '"
        download="' . esc_attr(basename(wp_parse_url($pdf['file_url'], PHP_URL_PATH))) . '" class="ukt-dl-btn"
        title="Download Word File">
        <i class="bi bi-download"></i> Download
    </a>';
    $tagline = 'Word Document • Universal Knowledge Trust';
    break;

// PowerPoint presentations (not viewable in browser → download only)
case 'ppt':
case 'pptx':
    $icon = '<i class="bi bi-file-earmark-ppt-fill"></i>';
    $label = '<a href="' . esc_url($pdf['file_url']) . '"
        download="' . esc_attr(basename(wp_parse_url($pdf['file_url'], PHP_URL_PATH))) . '" class="ukt-dl-btn"
        title="Download PPT File">
        <i class="bi bi-download"></i> Download
    </a>';
    $tagline = 'PPT Document • Universal Knowledge Trust';
    break;

// CSV files (browser can't render → download only)
case 'csv':
    $icon = '<i class="bi bi-file-earmark-spreadsheet-fill"></i>';
    $label = '<a href="' . esc_url($pdf['file_url']) . '"
        download="' . esc_attr(basename(wp_parse_url($pdf['file_url'], PHP_URL_PATH))) . '" class="ukt-dl-btn"
        title="Download CSV File">
        <i class="bi bi-download"></i> Download
    </a>';
    $tagline = 'CSV Document • Universal Knowledge Trust';
    break;

// Unknown or other file types (download only)
default:
    $icon = '<i class="bi bi-file-earmark"></i>';
    $label = '<a href="' . esc_url($pdf['file_url']) . '"
        download="' . esc_attr(basename(wp_parse_url($pdf['file_url'], PHP_URL_PATH))) . '" class="ukt-dl-btn"
        title="Download File">
        <i class="bi bi-download"></i> Download
    </a>';
    $tagline = 'Document • Universal Knowledge Trust';
    break;
                            }
                        }

                ?>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="ukt-dl-item ukt-dl-item-featured">
                                <div class="ukt-dl-icon ukt-dl-icon-pdf" title="PDF Document">
                                    <?php echo $icon; ?>
                                </div>
                                <div class="ukt-dl-info">
                                    <h3 class="ukt-dl-title"><?php echo $pdf['title']; ?></h3>
                                    <span class="ukt-dl-meta"><?php echo $tagline; ?></span>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php echo $label; ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <!-- Item 1: Program Brochure PDF -->
                <!-- <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-dl-item ukt-dl-item-featured">
                        <div class="ukt-dl-icon ukt-dl-icon-pdf" title="PDF Document">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="ukt-dl-info">
                            <h3 class="ukt-dl-title">Universal Knowledge training Brochure PDF</h3>
                            <span class="ukt-dl-meta"><?php echo $tagline; ?></span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="pdf/downloads-for-school-training-programs/pdf&excels/Brochers-1-1.pdf"
                                target="_blank" rel="noopener noreferrer" class="ukt-dl-btn"
                                title="View Brochure PDF">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="pdf/downloads-for-school-training-programs/pdf&excels/Brochers-1-1.pdf"
                                download="Brochers-1-1.pdf" class="ukt-dl-btn"
                                title="Download Brochure PDF">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div> -->

                <!-- Item 2: School Training Status (EXCEL) -->
                <!-- <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-dl-item ukt-dl-item-featured">
                        <div class="ukt-dl-icon ukt-dl-icon-excel" title="Excel Spreadsheet">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                        </div>
                        <div class="ukt-dl-info">
                            <h3 class="ukt-dl-title">List of schoools completed & School training status </h3>
                            <span class="ukt-dl-meta">Excel Spreadsheet (.xlsx) • 11 KB • Status &amp; Tracker Template</span>
                        </div>
                        <a href="pdf/downloads-for-school-training-programs/pdf&excels/School-training-status.xlsx"
                            download="School-training-status.xlsx"
                            class="ukt-dl-btn ukt-dl-btn-excel" title="Download Excel Template">
                            <i class="bi bi-download"></i> Download
                        </a>
                    </div>
                </div> -->

                <!-- Item 3: Daily Practice Guide (English) -->
                <!-- <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-dl-item ukt-dl-item-featured">
                        <div class="ukt-dl-icon ukt-dl-icon-pdf" title="PDF Document">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="ukt-dl-info">
                            <h3 class="ukt-dl-title">Student Daily Practice Guide (English)</h3>
                            <span class="ukt-dl-meta">PDF Document • 1.6 MB • English Daily Worksheet</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="pdf/downloads-for-school-training-programs/daily_practice/Practice-english-2.pdf"
                                target="_blank" rel="noopener noreferrer" class="ukt-dl-btn"
                                title="View English Practice PDF">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="pdf/downloads-for-school-training-programs/daily_practice/Practice-english-2.pdf"
                                download="Practice-english-2.pdf" class="ukt-dl-btn"
                                title="Download English Practice PDF">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div> -->

                <!-- Item 4: Daily Practice & Leaflets (Kannada) - 2 PDFs in 1 -->
                <!-- <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-dl-item ukt-dl-item-featured">
                        <div class="ukt-dl-icon ukt-dl-icon-pdf" title="PDF Documents">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="ukt-dl-info">
                            <h3 class="ukt-dl-title">Daily Practice &amp; Leaflets (Kannada)</h3>
                            <span class="ukt-dl-meta">2 PDF Documents • Practice Sheet &amp; Leaflets</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="pdf/downloads-for-school-training-programs/daily_practice/1/Practice-Kannada-2-1.pdf"
                                download="Practice-Kannada-2-1.pdf" class="ukt-dl-btn"
                                title="Download Kannada Practice PDF">
                                <i class="bi bi-download"></i> Practice PDF
                            </a>
                            <a href="pdf/downloads-for-school-training-programs/daily_practice/1/KANNADA-LEAFLETS-3.pdf"
                                download="KANNADA-LEAFLETS-3.pdf" class="ukt-dl-btn"
                                title="Download Kannada Leaflets PDF">
                                <i class="bi bi-download"></i> Leaflets PDF
                            </a>
                        </div>
                    </div>
                </div> -->

            </div>

        </div>
    </section>

    <!-- =========================================================
         SECTION 2: SCHOOL TRAINING AUDIO SESSIONS & DISCOURSES
    ========================================================== -->
    <section class="ukt-stp-section" id="training-audios">
        <div class="container">

            <!-- Section Header -->
            <div class="ukt-stp-header">
                <span class="ukt-stp-badge ukt-stp-badge-purple">
                    <i class="bi bi-headphones text-purple"></i> Audio Sessions &amp; Discourses
                </span>
                <h2 class="ukt-stp-heading">
                    School Training Audio Recordings
                </h2>
                <p class="ukt-stp-lead">
                    Listen to recorded training sessions, guided practices, and audio instructions for teachers, coordinators, and students.
                </p>
            </div>

            <!-- Audio Cards Grid -->
            <div class="row g-4 justify-content-center">

                <div class="col-lg-8 col-md-10 col-12">
                    <div class="ukt-audio-player-card">
                        <div class="ukt-audio-card-accent"></div>

                        <div class="ukt-audio-top-row">
                            <div class="ukt-audio-icon-wrap">
                                <i class="bi bi-soundwave"></i>
                            </div>
                            <div class="ukt-audio-meta-info">
                                <span class="ukt-audio-pill">Recorded Session</span>
                                <h3 class="ukt-audio-card-title">School Training Audio Guidance</h3>
                                <span class="ukt-audio-meta-sub">Audio MP3 • 9.2 MB • Recorded on 09-09-2023</span>
                            </div>
                        </div>

                        <div class="ukt-audio-player-container">
                            <audio controls preload="metadata" class="w-100 ukt-custom-audio-player">
                                <source src="pdf/downloads-for-school-training-programs/audios/Audio-2023-09-09.mp3" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>

                        <div class="ukt-audio-footer-row">
                            <span class="ukt-audio-note">
                                <i class="bi bi-info-circle me-1"></i> Stream online or download for offline classroom listening.
                            </span>
                            <a href="pdf/downloads-for-school-training-programs/audios/Audio-2023-09-09.mp3"
                                download="UKT-School-Training-Audio-2023-09-09.mp3"
                                class="ukt-dl-btn ukt-dl-btn-purple" title="Download Audio File">
                                <i class="bi bi-download"></i> Download Audio
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =========================================================
         SECTION 3: SCHOOL TRAINING VIDEOS & MEDIA COVERAGE
    ========================================================== -->
    <section class="ukt-stp-section ukt-stp-section-alt" id="training-videos">
        <div class="container">

            <!-- Section Header -->
            <div class="ukt-stp-header">
                <span class="ukt-stp-badge ukt-stp-badge-blue">
                    <i class="bi bi-play-btn-fill text-danger"></i> Daily Practice Videos
                </span>
                <h2 class="ukt-stp-heading">
                    School Training Daily Practice Videos
                </h2>
                <p class="ukt-stp-lead">
                    Follow the day-wise Monday through Saturday guided classroom practice sessions for brain balancing, mind alignment, and student positivity.
                </p>
            </div>

            <!-- Video Cards Grid (6 Daily Practice Videos, 2 per row on desktop) -->
            <div class="row g-4 justify-content-center">

                <!-- Video Card 1: Monday Practice Session -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-video-item-card">
                        <div class="ukt-video-thumb-frame" data-yt-id="9ZxfNvPe8jI"
                            title="Click to play video inline">
                            <img src="https://img.youtube.com/vi/9ZxfNvPe8jI/hqdefault.jpg"
                                alt="Monday Practice Session - UKT School Training"
                                class="ukt-video-thumb-img" loading="lazy">

                            <div class="ukt-video-watermark-top">
                                <img src="images/universal-knowledge-trust-logo.png" alt="UKT Logo">
                                <span class="ukt-video-watermark-title">Universal Knowledge • Monday Practice</span>
                            </div>

                            <div class="ukt-video-play-button" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="56" height="39">
                                    <path
                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                        fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>

                            <div class="ukt-video-bottom-strip">
                                <span class="ukt-video-channel-pill"><i class="bi bi-flower1"></i> UKT Training</span>
                                <a href="https://www.youtube.com/watch?v=9ZxfNvPe8jI" target="_blank" rel="noopener noreferrer"
                                    class="ukt-video-watch-link" onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ukt-video-content">
                            <h3 class="ukt-video-title mb-0">Monday Practice Session</h3>
                        </div>
                    </div>
                </div>

                <!-- Video Card 2: Tuesday Practice Session -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-video-item-card">
                        <div class="ukt-video-thumb-frame" data-yt-id="DeqoA149NDo"
                            title="Click to play video inline">
                            <img src="https://img.youtube.com/vi/DeqoA149NDo/hqdefault.jpg"
                                alt="Tuesday Practice Session - UKT School Training"
                                class="ukt-video-thumb-img" loading="lazy">

                            <div class="ukt-video-watermark-top">
                                <img src="images/universal-knowledge-trust-logo.png" alt="UKT Logo">
                                <span class="ukt-video-watermark-title">Universal Knowledge • Tuesday Practice</span>
                            </div>

                            <div class="ukt-video-play-button" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="56" height="39">
                                    <path
                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                        fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>

                            <div class="ukt-video-bottom-strip">
                                <span class="ukt-video-channel-pill"><i class="bi bi-flower1"></i> UKT Training</span>
                                <a href="https://www.youtube.com/watch?v=DeqoA149NDo" target="_blank" rel="noopener noreferrer"
                                    class="ukt-video-watch-link" onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ukt-video-content">
                            <h3 class="ukt-video-title mb-0">Tuesday Practice Session</h3>
                        </div>
                    </div>
                </div>

                <!-- Video Card 3: Wednesday Practice Session -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-video-item-card">
                        <div class="ukt-video-thumb-frame" data-yt-id="iD6MTVXyR3w"
                            title="Click to play video inline">
                            <img src="https://img.youtube.com/vi/iD6MTVXyR3w/hqdefault.jpg"
                                alt="Wednesday Practice Session - UKT School Training"
                                class="ukt-video-thumb-img" loading="lazy">

                            <div class="ukt-video-watermark-top">
                                <img src="images/universal-knowledge-trust-logo.png" alt="UKT Logo">
                                <span class="ukt-video-watermark-title">Universal Knowledge • Wednesday Practice</span>
                            </div>

                            <div class="ukt-video-play-button" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="56" height="39">
                                    <path
                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                        fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>

                            <div class="ukt-video-bottom-strip">
                                <span class="ukt-video-channel-pill"><i class="bi bi-flower1"></i> UKT Training</span>
                                <a href="https://www.youtube.com/watch?v=iD6MTVXyR3w" target="_blank" rel="noopener noreferrer"
                                    class="ukt-video-watch-link" onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ukt-video-content">
                            <h3 class="ukt-video-title mb-0">Wednesday Practice Session</h3>
                        </div>
                    </div>
                </div>

                <!-- Video Card 4: Thursday Practice Session -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-video-item-card">
                        <div class="ukt-video-thumb-frame" data-yt-id="1ho0cfxH960"
                            title="Click to play video inline">
                            <img src="https://img.youtube.com/vi/1ho0cfxH960/hqdefault.jpg"
                                alt="Thursday Practice Session - UKT School Training"
                                class="ukt-video-thumb-img" loading="lazy">

                            <div class="ukt-video-watermark-top">
                                <img src="images/universal-knowledge-trust-logo.png" alt="UKT Logo">
                                <span class="ukt-video-watermark-title">Universal Knowledge • Thursday Practice</span>
                            </div>

                            <div class="ukt-video-play-button" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="56" height="39">
                                    <path
                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                        fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>

                            <div class="ukt-video-bottom-strip">
                                <span class="ukt-video-channel-pill"><i class="bi bi-flower1"></i> UKT Training</span>
                                <a href="https://www.youtube.com/watch?v=1ho0cfxH960" target="_blank" rel="noopener noreferrer"
                                    class="ukt-video-watch-link" onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ukt-video-content">
                            <h3 class="ukt-video-title mb-0">Thursday Practice Session</h3>
                        </div>
                    </div>
                </div>

                <!-- Video Card 5: Friday Practice Session -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-video-item-card">
                        <div class="ukt-video-thumb-frame" data-yt-id="3dWXb3bpA4I"
                            title="Click to play video inline">
                            <img src="https://img.youtube.com/vi/3dWXb3bpA4I/hqdefault.jpg"
                                alt="Friday Practice Session - UKT School Training"
                                class="ukt-video-thumb-img" loading="lazy">

                            <div class="ukt-video-watermark-top">
                                <img src="images/universal-knowledge-trust-logo.png" alt="UKT Logo">
                                <span class="ukt-video-watermark-title">Universal Knowledge • Friday Practice</span>
                            </div>

                            <div class="ukt-video-play-button" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="56" height="39">
                                    <path
                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                        fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>

                            <div class="ukt-video-bottom-strip">
                                <span class="ukt-video-channel-pill"><i class="bi bi-flower1"></i> UKT Training</span>
                                <a href="https://www.youtube.com/watch?v=3dWXb3bpA4I" target="_blank" rel="noopener noreferrer"
                                    class="ukt-video-watch-link" onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ukt-video-content">
                            <h3 class="ukt-video-title mb-0">Friday Practice Session</h3>
                        </div>
                    </div>
                </div>

                <!-- Video Card 6: Saturday Practice Session -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="ukt-video-item-card">
                        <div class="ukt-video-thumb-frame" data-yt-id="X0ekRm011g0"
                            title="Click to play video inline">
                            <img src="https://img.youtube.com/vi/X0ekRm011g0/hqdefault.jpg"
                                alt="Saturday Practice Session - UKT School Training"
                                class="ukt-video-thumb-img" loading="lazy">

                            <div class="ukt-video-watermark-top">
                                <img src="images/universal-knowledge-trust-logo.png" alt="UKT Logo">
                                <span class="ukt-video-watermark-title">Universal Knowledge • Saturday Practice</span>
                            </div>

                            <div class="ukt-video-play-button" aria-label="Play Video">
                                <svg viewBox="0 0 68 48" width="56" height="39">
                                    <path
                                        d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                        fill="#ff0000"></path>
                                    <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                                </svg>
                            </div>

                            <div class="ukt-video-bottom-strip">
                                <span class="ukt-video-channel-pill"><i class="bi bi-flower1"></i> UKT Training</span>
                                <a href="https://www.youtube.com/watch?v=X0ekRm011g0" target="_blank" rel="noopener noreferrer"
                                    class="ukt-video-watch-link" onclick="event.stopPropagation();">
                                    Watch on <i class="bi bi-youtube text-danger"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ukt-video-content">
                            <h3 class="ukt-video-title mb-0">Saturday Practice Session</h3>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- =====================================================
         CALL TO ACTION SECTION
         (Matches index.html & about-us page CTA layout)
    ===================================================== -->
    <section class="ukt-cta-section">

        <!-- Decorative Elements -->
        <div class="ukt-cta-orb ukt-cta-orb-left"></div>
        <div class="ukt-cta-orb ukt-cta-orb-right"></div>

        <div class="container position-relative">

            <div class="row justify-content-center">

                <div class="col-xl-9 col-lg-10">

                    <div class="ukt-cta-content text-center">

                        <span class="ukt-cta-kicker">
                            BEGIN YOUR JOURNEY
                        </span>

                        <h2>
                            A Better World Begins
                            <span>With a Positive Change.</span>
                        </h2>

                        <p>
                            Discover knowledge, healing and meaningful experiences
                            designed to bring greater awareness, balance and
                            positive transformation into everyday life.
                        </p>

                        <div class="ukt-cta-actions">

                            <a href="about-us.html" class="ukt-cta-primary-btn" title="About Us">
                                <span>ABOUT US</span>
                                <i class="bi bi-arrow-up-right"></i>
                            </a>

                            <a href="mailto:UniversalknowledgR@gmail.com" class="ukt-cta-secondary-btn">
                                <span>GET IN TOUCH</span>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</article>

<script>
    // Inline YouTube Player for School Training Videos
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".ukt-video-thumb-frame, .ukt-video-play-btn-inline").forEach(function(trigger) {
            trigger.addEventListener("click", function(e) {
                if (e.target.closest(".ukt-video-watch-link")) return;
                e.preventDefault();
                const card = this.closest(".ukt-video-item-card");
                if (!card) return;
                const frame = card.querySelector(".ukt-video-thumb-frame");
                if (!frame) return;
                const ytId = frame.getAttribute("data-yt-id");
                if (!ytId) return;

                frame.innerHTML = `
                    <iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0"
                            title="YouTube Video Player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            class="ukt-video-iframe-embed">
                    </iframe>
                `;
                frame.classList.add("ukt-video-playing");
            });
        });
    });
</script>
<?php
get_footer();
?>