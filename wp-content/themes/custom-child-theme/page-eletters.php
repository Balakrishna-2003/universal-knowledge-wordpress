<?php
    /* Template Name:  E-Letters Page Template */
    get_header();
?>
<article>

    <?php get_template_part('page-banners');?>

    <!-- =========================================================
         E-LETTERS PDF ARCHIVE & SEARCH SECTION
    ========================================================== -->
    <section class="ukt-eletters-section" id="e-letters">
        
        <!-- Ambient Decorative Glows -->
        <div class="ukt-eletters-ambient-glow ukt-eletters-glow-1"></div>
        <div class="ukt-eletters-ambient-glow ukt-eletters-glow-2"></div>

        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-eletters-header">
                <div class="ukt-section-eyebrow justify-content-center">
                        <span></span>
                        Publications & Books
                        <span></span>
                    </div>
                <h2 class="ukt-section-main-title">
                    Explore E-Letters &amp; <span>Updates by Year</span>
                </h2>
                <p class="ukt-eletters-lead">
                    Search, read, and download monthly and periodic E-Letter publications from Universal Knowledge Trust to stay updated on our activities, healing workshops, and social initiatives.
                </p>
            </div>

            <!-- SEARCH & FILTER TOOLBAR -->
            <div class="ukt-eletters-toolbar">
                <div class="row g-3 align-items-center">

                    <!-- Real-Time Search Box -->
                    <div class="col-lg-5">
                        <div class="ukt-eletters-search-box">
                            <i class="bi bi-search ukt-eletters-search-icon"></i>
                            <input type="text" id="uktEletterSearchInput" class="ukt-eletters-search-input"
                                placeholder="Search by title, month, or topic (e.g. March, NPEH, Retreat)..."
                                aria-label="Search E-Letters">
                            <button type="button" id="uktSearchClearBtn" class="ukt-eletters-search-clear" aria-label="Clear Search Input">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Year Filter Buttons -->
                    <div class="col-lg-7">
                        <div class="ukt-eletters-year-filters justify-content-lg-end" role="tablist" aria-label="Filter E-Letters by Year">
                            <button type="button" class="ukt-year-filter-btn active" data-filter="all">
                                <i class="bi bi-collection"></i> All Years
                                <span class="ukt-year-count" id="count-all">11</span>
                            </button>
                            <?php
$e_years = ukt_get_e_letters();

if (!empty($e_years)) :
    // this below is varible for count no of entries max is 3 needed
    $t_count = 1;
    foreach ($e_years as $year => $entries) :
        $count = count($entries);
        if($t_count > 3):
            break;
        endif;
        ?>
        <button type="button" class="ukt-year-filter-btn" data-filter="<?php echo $year;?>">
            <?php echo $year; ?>
        <span class="ukt-year-count" id="count-<?php echo $year;?>"><?php echo $count;?></span>
        </button>
        <?php
        $t_count++;
    endforeach;
endif;
?>
                            <!-- <button type="button" class="ukt-year-filter-btn" data-filter="2026">
                                2026
                                <span class="ukt-year-count" id="count-2026">2</span>
                            </button>
                            <button type="button" class="ukt-year-filter-btn" data-filter="2025">
                                2025
                                <span class="ukt-year-count" id="count-2025">5</span>
                            </button>
                            <button type="button" class="ukt-year-filter-btn" data-filter="2024">
                                2024
                                <span class="ukt-year-count" id="count-2024">4</span>
                            </button> -->
                        </div>
                    </div>

                </div>

                <!-- Status / Quick Reset Bar -->
                <div class="ukt-eletters-status-bar">
                    <span>
                        Showing <strong id="uktMatchCount">11</strong> of <strong>11</strong> publications
                    </span>
                    <button type="button" id="uktResetFilterBtn" class="ukt-reset-filter-btn">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset all filters
                    </button>
                </div>
            </div>

            <!-- =====================================================
                 NO SEARCH RESULTS FOUND
            ====================================================== -->
            <div id="uktNoResults" class="ukt-eletters-no-results">
                <div class="ukt-no-results-icon">
                    <i class="bi bi-search"></i>
                </div>
                <h3>No Matching E-Letters Found</h3>
                <p>We couldn't find any E-Letters matching your search query or filter selection. Try adjusting your search term or select another year.</p>
                <button type="button" class="btn btn-outline-primary rounded-pill px-4" id="uktNoResultsResetBtn">
                    View All E-Letters
                </button>
            </div>

            <?php
$e_letters = ukt_get_e_letters();

if (!empty($e_letters)) :
    foreach ($e_letters as $year => $entries) :

        $count = count($entries);
?>
<!-- <div class="ukt-year-section" id="year-section-2026" data-year="2026"> -->
        <div class="ukt-year-section" id="year-section-<?php echo esc_attr($year); ?>" data-year="<?php echo esc_attr($year); ?>">
            <div class="ukt-year-section-header">
                <span class="ukt-year-badge-pill">
                    <i class="bi bi-calendar3"></i> <?php echo esc_html($year); ?>
                </span>
                <div class="ukt-year-divider-line"></div>
                <span class="ukt-year-section-count">
                    <?php echo esc_html($count); ?> <?php echo $count === 1 ? 'Edition' : 'Editions'; ?>
                </span>
            </div>

            <div class="row g-4">
                <?php foreach ($entries as $entry) :
                    $title    = $entry['title'] ?? '';
                    $file_url = $entry['file_url'] ?? '';
                    $cover_url = $entry['cover_url'] ?? '';
                    $file_id  = $entry['file_id'] ?? 0;

                    // Cover image — if the uploaded file is a PDF,
                    // you may want to use a custom cover image field.
                    // For now, use the PDF itself as cover preview fallback,
                    // or add a "cover_id" field to the meta box.
                    // $cover_url = wp_get_attachment_image_url($file_id, 'medium') ?: '';
                ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col"
                         data-year="<?php echo esc_attr($year); ?>"
                         data-title="<?php echo esc_attr($title); ?>">
                        <div class="ukt-3d-book-container">
                            <a href="<?php echo esc_url($file_url); ?>"
                               target="_blank"
                               rel="noopener"
                               class="ukt-3d-book-link ukt-open-flipbook"
                               data-pdf="<?php echo esc_url($file_url); ?>"
                               data-title="<?php echo esc_attr($title); ?>">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <?php if ($cover_url) : ?>
                                            <img src="<?php echo esc_url($cover_url); ?>"
                                                 alt="<?php echo esc_attr($title); ?>"
                                                 loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>

                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title"><?php echo esc_html($title); ?></h3>
                                    <a href="<?php echo esc_url($file_url); ?>"
                                       download
                                       class="ukt-3d-btn-dl"
                                       title="Download <?php echo esc_attr($title); ?>">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    endforeach;
endif;
?>

            <!-- =====================================================
                 YEAR 2026 CATEGORY
            ====================================================== -->
            <!-- <div class="ukt-year-section" id="year-section-2026" data-year="2026">
                <div class="ukt-year-section-header">
                    <span class="ukt-year-badge-pill">
                        <i class="bi bi-calendar3"></i> 2026
                    </span>
                    <div class="ukt-year-divider-line"></div>
                    <span class="ukt-year-section-count">2 Editions</span>
                </div>


                <div class="row g-4">
                     <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2026" data-title="Jan Feb 2026 January February E-Letter Activities Report Universal Knowledge" data-keywords="jan feb january february 2026 new year harmony seva npeh youth values">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/July-to-August-2026.pdf" data-title="July to August 2026 E-Letter" aria-label="Preview July to August 2026 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/July-to-August-2026.jpg" alt="January-February 2026 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">July - Auguest 2026</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/July-to-August-2026.pdf" download="Jan-Feb-2026.pdf" class="ukt-3d-btn-dl" title="Download January-February 2026 PDF" aria-label="Download January-February 2026 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2026"
                        data-title="March April 2026 E-Letter Activities Report Universal Knowledge"
                        data-keywords="march april 2026 activities report retreats conclave meditation workshop npeh">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/March-April-2026.pdf" 
                               data-title="March - April 2026 E-Letter" 
                               aria-label="Preview March-April 2026 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/March-April-2026.jpg" alt="March-April 2026 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">March - April 2026</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/March-April-2026.pdf" download="March-April-2026.pdf" class="ukt-3d-btn-dl" title="Download March-April 2026 PDF" aria-label="Download March-April 2026 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2026"
                        data-title="Jan Feb 2026 January February E-Letter Activities Report Universal Knowledge"
                        data-keywords="jan feb january february 2026 new year harmony seva npeh youth values">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/Jan-Feb-2026.pdf" 
                               data-title="January - February 2026 E-Letter" 
                               aria-label="Preview January-February 2026 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/Jan-Feb-2026.jpg" alt="January-February 2026 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">January - February 2026</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/Jan-Feb-2026.pdf" download="Jan-Feb-2026.pdf" class="ukt-3d-btn-dl" title="Download January-February 2026 PDF" aria-label="Download January-February 2026 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- =====================================================
                 YEAR 2025 CATEGORY
            ====================================================== -->
            <!-- <div class="ukt-year-section" id="year-section-2025" data-year="2025">
                <div class="ukt-year-section-header">
                    <span class="ukt-year-badge-pill">
                        <i class="bi bi-calendar3"></i> 2025
                    </span>
                    <div class="ukt-year-divider-line"></div>
                    <span class="ukt-year-section-count">5 Editions</span>
                </div>

                <div class="row g-4">
                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2025"
                        data-title="November December 2025 E-Letter Activities Report Universal Knowledge"
                        data-keywords="november december 2025 year end transformation seva highlights annual review">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/November-December-2025.pdf" 
                               data-title="November - December 2025 E-Letter" 
                               aria-label="Preview November-December 2025 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/November-December-2025.jpg" alt="November-December 2025 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">November - December 2025</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/November-December-2025.pdf" download="November-December-2025.pdf" class="ukt-3d-btn-dl" title="Download November-December 2025 PDF" aria-label="Download November-December 2025 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2025"
                        data-title="September October 2025 E-Letter Activities Report Universal Knowledge"
                        data-keywords="september october 2025 agnihotra wellness atmosphere purification healing">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/September-October-2025.pdf" 
                               data-title="September - October 2025 E-Letter" 
                               aria-label="Preview September-October 2025 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/September-October-2025.jpg" alt="September-October 2025 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">September - October 2025</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/September-October-2025.pdf" download="September-October-2025.pdf" class="ukt-3d-btn-dl" title="Download September-October 2025 PDF" aria-label="Download September-October 2025 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2025"
                        data-title="June August 2025 June July August E-Letter Activities Report Universal Knowledge"
                        data-keywords="june august july 2025 project green environment plantation youth camps">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/June-August-2025.pdf" 
                               data-title="June - August 2025 E-Letter" 
                               aria-label="Preview June-August 2025 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/June-August-2025.jpg" alt="June-August 2025 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">June - August 2025</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/June-August-2025.pdf" download="June-August-2025.pdf" class="ukt-3d-btn-dl" title="Download June-August 2025 PDF" aria-label="Download June-August 2025 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2025"
                        data-title="March to May 2025 March April May E-Letter Activities Report Universal Knowledge"
                        data-keywords="march to may april 2025 spiritual wisdom inner peace npeh healing ghh training">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/March-to-May-2025.pdf" 
                               data-title="March - May 2025 E-Letter" 
                               aria-label="Preview March-to-May 2025 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/March-to-May-2025.jpg" alt="March-to-May 2025 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">March - May 2025</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/March-to-May-2025.pdf" download="March-to-May-2025.pdf" class="ukt-3d-btn-dl" title="Download March-to-May 2025 PDF" aria-label="Download March-to-May 2025 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2025"
                        data-title="December 2024 to Feb 2025 January February E-Letter Activities Report Universal Knowledge"
                        data-keywords="december to feb 2025 january february 2024 winter retreats nutrition seva">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/December-to-Feb-2025.pdf" 
                               data-title="December 2024 - February 2025 E-Letter" 
                               aria-label="Preview December 2024 - February 2025 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/December-to-Feb-2025.jpg" alt="December 2024 - February 2025 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">December 2024 - February 2025</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/December-to-Feb-2025.pdf" download="December-to-Feb-2025.pdf" class="ukt-3d-btn-dl" title="Download December 2024 - February 2025 PDF" aria-label="Download PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- =====================================================
                 YEAR 2024 CATEGORY
            ====================================================== -->
            <!-- <div class="ukt-year-section" id="year-section-2024" data-year="2024">
                <div class="ukt-year-section-header">
                    <span class="ukt-year-badge-pill">
                        <i class="bi bi-calendar3"></i> 2024
                    </span>
                    <div class="ukt-year-divider-line"></div>
                    <span class="ukt-year-section-count">4 Editions</span>
                </div>

                <div class="row g-4">
                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2024"
                        data-title="Sept Nov 2024 September October November E-Letter Activities Report Universal Knowledge"
                        data-keywords="sept nov september october november 2024 annual milestones spiritual talks outreach">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/Sept-Nov-2024.pdf" 
                               data-title="September - November 2024 E-Letter" 
                               aria-label="Preview September-November 2024 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/Sept-Nov-2024.jpg" alt="September-November 2024 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">September - November 2024</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/Sept-Nov-2024.pdf" download="Sept-Nov-2024.pdf" class="ukt-3d-btn-dl" title="Download September-November 2024 PDF" aria-label="Download September-November 2024 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2024"
                        data-title="August 2024 2 Special E-Letter Activities Report Universal Knowledge"
                        data-keywords="august 2024 school outreach student leadership camps youth education empowerment">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/August-2024-2.pdf" 
                               data-title="August 2024 Special Edition E-Letter" 
                               aria-label="Preview August 2024 Special Edition in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/August-2024-2.jpg" alt="August 2024 Special Edition Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">August 2024 (Special Edition)</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/August-2024-2.pdf" download="August-2024-2.pdf" class="ukt-3d-btn-dl" title="Download August 2024 PDF" aria-label="Download August 2024 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2024"
                        data-title="July 2024 E-Letter Activities Report Universal Knowledge"
                        data-keywords="july 2024 self healing inner growth meditation mindfulness routine">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/July-2024.pdf" 
                               data-title="July 2024 E-Letter" 
                               aria-label="Preview July 2024 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/July-2024.jpg" alt="July 2024 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">July 2024</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/July-2024.pdf" download="July-2024.pdf" class="ukt-3d-btn-dl" title="Download July 2024 PDF" aria-label="Download July 2024 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 ukt-eletter-col" data-year="2024"
                        data-title="June 2024 E-Letter Activities Report Universal Knowledge"
                        data-keywords="june 2024 food on wheels wall compassion nutrition distribution seva">
                        <div class="ukt-3d-book-container">
                            <a href="javascript:void(0)" class="ukt-3d-book-link ukt-open-flipbook" 
                               data-pdf="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/June-2024.pdf" 
                               data-title="June 2024 E-Letter" 
                               aria-label="Preview June 2024 E-Letter in Book Reader">
                                <div class="ukt-3d-book-cover">
                                    <div class="ukt-3d-book-img-wrap">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/June-2024.jpg" alt="June 2024 Front Cover" loading="lazy">
                                    </div>
                                    <div class="ukt-3d-book-footer">
                                        <span>Open Book</span>
                                        <i class="bi bi-book-half"></i>
                                    </div>
                                </div>
                                <div class="ukt-3d-page-layer ukt-3d-page-1"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-2"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-3"></div>
                                <div class="ukt-3d-page-layer ukt-3d-page-4"></div>
                                <div class="ukt-3d-book-shadow"></div>
                            </a>
                            <div class="ukt-3d-book-meta">
                                <div class="ukt-3d-book-meta-row">
                                    <h3 class="ukt-3d-book-meta-title">June 2024</h3>
                                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/pdf/e-letter-pdf/June-2024.pdf" download="June-2024.pdf" class="ukt-3d-btn-dl" title="Download June 2024 PDF" aria-label="Download June 2024 PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </section>

    <!-- =========================================================
         3D INTERACTIVE FLIPBOOK PDF READER MODAL
    ========================================================== -->
    <div id="uktFlipbookModal" class="ukt-flipbook-modal" role="dialog" aria-modal="true" aria-label="Interactive PDF Flipbook">
        <!-- Top Header -->
        <div class="ukt-flipbook-header">
            <div class="ukt-flipbook-title-wrap">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/universal-knowledge-trust-logo.png" alt="Logo" class="ukt-flipbook-logo">
                <h2 class="ukt-flipbook-title" id="flipbookTitle">Universal Knowledge E-Letter</h2>
            </div>
            <div class="ukt-flipbook-controls">
                <span class="ukt-flipbook-page-badge">
                    Page <span id="flipbookCurrentPage">1</span> / <span id="flipbookTotalPages">1</span>
                </span>
                <button type="button" class="ukt-flipbook-btn" id="flipbookZoomIn" title="Zoom In" aria-label="Zoom In">
                    <i class="bi bi-zoom-in"></i>
                </button>
                <button type="button" class="ukt-flipbook-btn" id="flipbookZoomOut" title="Zoom Out" aria-label="Zoom Out">
                    <i class="bi bi-zoom-out"></i>
                </button>
                <button type="button" class="ukt-flipbook-btn" id="flipbookFullscreen" title="Toggle Fullscreen" aria-label="Toggle Fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>
                <a href="#" download id="flipbookDownloadBtn" class="ukt-flipbook-btn" title="Download Current PDF" aria-label="Download PDF">
                    <i class="bi bi-download"></i>
                </a>
                <button type="button" class="ukt-flipbook-btn ukt-flipbook-close" id="flipbookCloseBtn" title="Close Reader (Esc)" aria-label="Close Flipbook">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        

        <!-- Reader Stage -->
        <div class="ukt-flipbook-body">

            <!-- Previous Page Side Button -->
            <button type="button" class="ukt-flipbook-side-btn ukt-flipbook-btn-prev" id="flipbookPrevBtn" title="Previous Page" aria-label="Previous Page">
                <i class="bi bi-chevron-left"></i>
            </button>

            <!-- Book Stage -->
            <div class="ukt-flipbook-stage" id="flipbookStage">
                <!-- Loading Spinner -->
                <div class="ukt-flipbook-loader is-active" id="flipbookLoader">
                    <div class="ukt-flipbook-spinner"></div>
                    <p>Opening Booklet Pages...</p>
                </div>

                <!-- Open Book Spread -->
                <div class="ukt-flipbook-spread" id="flipbookSpread">
                    <!-- Left Leaf -->
                    <div class="ukt-flipbook-leaf leaf-left" id="flipbookLeafLeft">
                        <canvas class="ukt-flipbook-page-canvas" id="canvasLeft"></canvas>
                        <span class="ukt-flipbook-page-num" id="pageNumLeft"></span>
                    </div>

                    <!-- Right Leaf -->
                    <div class="ukt-flipbook-leaf leaf-right" id="flipbookLeafRight">
                        <canvas class="ukt-flipbook-page-canvas" id="canvasRight"></canvas>
                        <span class="ukt-flipbook-page-num" id="pageNumRight">1</span>
                    </div>

                    <!-- 3D Turning Sheet Layer -->
                    <div class="ukt-flip-animating-leaf" id="flipAnimLeaf">
                        <div class="ukt-flip-leaf-front">
                            <canvas class="ukt-flipbook-page-canvas" id="canvasAnimFront"></canvas>
                        </div>
                        <div class="ukt-flip-leaf-back">
                            <canvas class="ukt-flipbook-page-canvas" id="canvasAnimBack"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Page Side Button -->
            <button type="button" class="ukt-flipbook-side-btn ukt-flipbook-btn-next" id="flipbookNextBtn" title="Next Page" aria-label="Next Page">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <!-- Bottom Scrubber Bar -->
        <div class="ukt-flipbook-footer">
            <button type="button" class="ukt-flipbook-nav-pill" id="flipbookNavPrev">
                <i class="bi bi-arrow-left"></i> Prev Page
            </button>
            <input type="range" class="ukt-flipbook-slider" id="flipbookSlider" min="1" max="1" value="1" aria-label="Page Slider">
            <button type="button" class="ukt-flipbook-nav-pill" id="flipbookNavNext">
                Next Page <i class="bi bi-arrow-right"></i>
            </button>
        </div>
    </div>

        </div>
    </section>

</article>
<?php
    get_footer();
?>