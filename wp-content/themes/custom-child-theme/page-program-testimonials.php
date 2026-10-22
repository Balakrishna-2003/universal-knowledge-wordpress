<?php
/**
 * Template Name: Program Testimonials Template
 */
get_header();
?>

<article>
    <!-- =========================================================
         PROGRAM TESTIMONIALS BANNER / HERO SECTION
    ========================================================== -->
    <section class="ukt-hero-showcase">
        <div class="ukt-hero-carousel-shell">
            <div class="carousel-inner">
                <div class="carousel-item active ukt-hero-carousel-item">
                    <div class="ukt-hero-slide-layout">
                        <div class="container-fluid">
                            <div class="row g-0 align-items-stretch">

                                <!-- LEFT CONTENT AREA -->
                                <div class="col-lg-6 col-xl-5 d-flex align-items-center">
                                    <div class="ukt-hero-copy-zone">
                                        <div class="ukt-hero-left-decoration"></div>

                                        <div class="ukt-hero-slide-kicker">
                                            <i class="bi bi-chat-quote-fill me-1 ukt-text-green"></i>
                                            Universal Knowledge Trust • Program Testimonials
                                        </div>

                                        <h1 class="ukt-hero-main-title">
                                            <span>Program</span>
                                            <span>Testimonials</span>
                                        </h1>

                                        <div class="ukt-hero-script-line">
                                            Voices of Transformation · Inspiring Journeys
                                        </div>

                                        <p class="ukt-hero-description">
                                            Read inspiring testimonials and heartfelt experiences shared by
                                            students, teachers, parents, and seekers whose lives have been deeply touched and
                                            transformed through Universal Knowledge Trust's programs, workshops, and
                                            spiritual guidance.
                                        </p>

                                        <div class="ukt-hero-action-row">
                                            <a href="#reviews" class="ukt-hero-primary-action">
                                                Read Testimonials
                                                <i class="bi bi-arrow-down-circle"></i>
                                            </a>
                                            <a href="#add-testimonial" class="ukt-hero-secondary-action">
                                                <i class="bi bi-plus-circle-fill me-1"></i> Add Testimonial
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT IMAGE AREA -->
                                <div class="col-lg-6 col-xl-7">
                                    <div class="ukt-hero-visual-zone">
                                        <div class="ukt-hero-image-frame">
                                            <figure class="ukt-hero-image-figure">
                                                <!-- Update the image path to your actual theme assets -->
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/program-testimonials-banner.jpg"
                                                    alt="Program Testimonials - Universal Knowledge Trust"
                                                    loading="eager">
                                                <figcaption class="visually-hidden">Program Testimonials - Universal
                                                    Knowledge Trust Hero Banner</figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION: PROGRAM TESTIMONIALS
    ========================================================== -->
    <section id="reviews" class="ukt-testimonials-section">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header text-center mb-4">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    VOICES OF TRANSFORMATION
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-testimonials-section-title">
                    Program <span>Testimonials</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-flower1"></i>
                    <span></span>
                </div>
                <p class="text-muted mx-auto mt-3 ukt-testimonials-lead">
                    Hear directly from educators, students, parents, and seekers about their transformative journeys
                    across our workshops, school training programs, and retreats.
                </p>
            </div>

            <!-- TESTIMONIAL CARDS GRID -->
            <div class="row g-4 justify-content-center" id="testimonialsGrid">
                
                <?php
                // Fetch existing testimonials
                $args = [
                    'post_type'      => 'ukt_testimonial',
                    'posts_per_page' => -1,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ];
                $reviews_query = new WP_Query($args);

                if ($reviews_query->have_posts()) :
                    while ($reviews_query->have_posts()) : $reviews_query->the_post(); 
                ?>
                    <div class="col-lg-4 col-md-6 col-12 ukt-review-col" id="review-<?php the_ID(); ?>">
                        <div class="ukt-reference-review-card">
                            <h4 class="ukt-reference-review-title">
                                <?php the_title(); ?>
                            </h4>
                            <div class="ukt-reference-review-body">
                                <?php the_content(); ?>
                            </div>
                            <div class="ukt-reference-review-date">
                                <i class="bi bi-calendar3 me-1"></i> <?php echo get_the_date('F j, Y'); ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    endwhile; 
                    wp_reset_postdata();
                endif; 
                ?>

            </div>

            <!-- PAGINATION CONTAINER (9 cards per page) -->
            <div class="ukt-gallery-pagination-wrap" id="testimonialsPagination" role="navigation"
                aria-label="Testimonials Pagination">
                <!-- Pagination dynamically rendered via JavaScript -->
            </div>

        </div>
    </section>

    <!-- =========================================================
         SECTION: ADD PROGRAM TESTIMONIAL FORM
    ========================================================== -->
    <section id="add-testimonial" class="ukt-submit-review-section">
        <div class="container">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header text-center mb-4">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    SHARE YOUR REFLECTION
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-testimonials-section-title">
                    Add Your <span>Testimonial</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-pencil-fill"></i>
                    <span></span>
                </div>
                <p class="text-muted mx-auto mt-3 ukt-submit-lead">
                    Have you attended one of our programs, retreats, or workshops? Share your reflections below.
                    Your transformation story inspires others on their path to wellness and growth.
                </p>
            </div>

            <!-- FORM CARD CONTAINER -->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <div class="ukt-review-form-card">

                        <!-- Success Alert Banner (Initially Hidden) -->
                        <div id="testimonialSuccessAlert"
                            class="alert alert-success d-none align-items-center mb-4 rounded-3 p-3 ukt-review-success-alert"
                            role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                            <div>
                                <strong>Thank you!</strong> Your testimonial has been successfully added to the
                                program testimonials above.
                            </div>
                        </div>

                        <form id="addTestimonialForm" novalidate>
                            <?php wp_nonce_field('ukt_review_nonce', 'nonce'); ?>
                            <input type="hidden" name="action" value="submit_program_review">

                            <div class="row g-3">

                                <!-- Field 1: Testimonial Title -->
                                <div class="col-12">
                                    <div class="ukt-form-group">
                                        <label for="testimonialTitle" class="ukt-form-label">
                                            Testimonial Title <span class="req">*</span>
                                        </label>
                                        <input type="text" id="testimonialTitle" name="title"
                                            class="ukt-form-control-custom"
                                            placeholder="e.g. Unprecedented Discipline and Focus from S.T.O.P. Program"
                                            required>
                                        <div class="invalid-feedback ukt-form-invalid-feedback" id="titleError">
                                            <i class="bi bi-exclamation-circle me-1"></i>Please enter a testimonial title.
                                        </div>
                                    </div>
                                </div>

                                <!-- Field 2: Testimonial Content -->
                                <div class="col-12">
                                    <div class="ukt-form-group">
                                        <label for="testimonialContent" class="ukt-form-label">
                                            Testimonial Content <span class="req">*</span>
                                        </label>
                                        <textarea id="testimonialContent" name="content"
                                            class="ukt-form-control-custom" rows="6"
                                            placeholder="Write your testimonial reflections, program experience, or personal transformation journey here as a paragraph..."
                                            required></textarea>
                                        <div class="invalid-feedback ukt-form-invalid-feedback" id="contentError">
                                            <i class="bi bi-exclamation-circle me-1"></i>Please write your testimonial content.
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit & Reset Action Buttons -->
                                <div class="col-12">
                                    <div class="ukt-form-actions">
                                        <button type="submit" class="ukt-btn-form-submit" id="submitTestimonialBtn">
                                            <i class="bi bi-plus-circle-fill"></i> Add Testimonial
                                        </button>
                                        <button type="reset" class="ukt-btn-form-cancel" id="cancelTestimonialBtn">
                                            <i class="bi bi-arrow-counterclockwise"></i> Clear
                                        </button>
                                    </div>
                                </div>

                                <!-- Submission Support Notice Below the Form -->
                                <div class="col-12 mt-3 pt-3 ukt-form-whatsapp-border">
                                    <p class="mb-0 text-muted ukt-form-whatsapp-text">
                                        <i class="bi bi-whatsapp me-1 text-success"></i>
                                        Send a message if your submission doesnt show up in a day or 2
                                        <a href="https://wa.me/919845082856" target="_blank"
                                            rel="noopener noreferrer"
                                            class="ukt-form-whatsapp-link">https://wa.me/919845082856</a>
                                    </p>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================
         CALL TO ACTION SECTION
    ========================================================== -->
    <section class="ukt-cta-section-unified">
        <div class="container text-center">
            <span class="ukt-cta-kicker">EMPOWER YOUR JOURNEY</span>
            <h2 class="ukt-cta-title">
                Transform Your Life. <span class="ukt-cta-title-accent">Begin Your Program Today.</span>
            </h2>
            <p class="ukt-cta-desc">
                Discover how our educational training programs, self-healing workshops, and youth empowerment
                initiatives can inspire lasting positive change in your life and community.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="all-school-training-programs.html" class="ukt-hero-primary-action ukt-cta-btn-gold">
                    Explore Programs <i class="bi bi-arrow-right"></i>
                </a>
                <a href="mailto:UniversalknowledgR@gmail.com" class="ukt-hero-secondary-action ukt-cta-btn-ghost">
                    <i class="bi bi-envelope me-1"></i> Contact Us
                </a>
            </div>
        </div>
    </section>

</article>

<!-- =========================================================
     JAVASCRIPT FOR DYNAMIC FUNCTIONALITY & AJAX
========================================================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    
    // =========================================================
    // 1. PROGRAM TESTIMONIALS PAGINATION MANAGER (9 per page)
    // =========================================================
    const TestimonialsPagination = (function () {
        const ITEMS_PER_PAGE = 9;
        let currentPage = 1;
        let grid = null;
        let paginationEl = null;

        function getItems() {
            if (!grid) grid = document.getElementById("testimonialsGrid");
            if (!grid) return [];
            return Array.from(grid.querySelectorAll(".ukt-review-col"));
        }

        function renderPagination() {
            if (!paginationEl) paginationEl = document.getElementById("testimonialsPagination");
            if (!paginationEl) return;

            const items = getItems();
            const totalItems = items.length;
            const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);

            if (totalPages <= 1) {
                paginationEl.innerHTML = `
                    <div class="ukt-pagination-info">
                        Showing <strong>1–${totalItems}</strong> of <strong>${totalItems}</strong> testimonials
                    </div>
                `;
                return;
            }

            let buttonsHTML = `<div class="ukt-gallery-pagination">`;

            buttonsHTML += `
                <button type="button" class="ukt-page-btn nav-btn" data-page="${currentPage - 1}" ${currentPage === 1 ? "disabled" : ""} aria-label="Previous Page">
                    <i class="bi bi-chevron-left"></i> Prev
                </button>
            `;

            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    buttonsHTML += `
                        <button type="button" class="ukt-page-btn ${i === currentPage ? "active" : ""}" data-page="${i}" aria-label="Page ${i}" ${i === currentPage ? 'aria-current="page"' : ""}>
                            ${i}
                        </button>
                    `;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    buttonsHTML += `<span class="ukt-page-ellipsis" aria-hidden="true">...</span>`;
                }
            }

            buttonsHTML += `
                <button type="button" class="ukt-page-btn nav-btn" data-page="${currentPage + 1}" ${currentPage === totalPages ? "disabled" : ""} aria-label="Next Page">
                    Next <i class="bi bi-chevron-right"></i>
                </button>
            `;

            buttonsHTML += `</div>`;

            const visibleStart = (currentPage - 1) * ITEMS_PER_PAGE + 1;
            const visibleEnd = Math.min(currentPage * ITEMS_PER_PAGE, totalItems);
            buttonsHTML += `
                <div class="ukt-pagination-info">
                    Showing <strong>${visibleStart}–${visibleEnd}</strong> of <strong>${totalItems}</strong> testimonials
                </div>
            `;

            paginationEl.innerHTML = buttonsHTML;

            paginationEl.querySelectorAll(".ukt-page-btn:not(:disabled)").forEach(btn => {
                btn.addEventListener("click", function () {
                    const targetPage = parseInt(this.getAttribute("data-page"), 10);
                    if (targetPage && targetPage !== currentPage && targetPage >= 1 && targetPage <= totalPages) {
                        showPage(targetPage, true);
                    }
                });
            });
        }

        function showPage(page, shouldScroll) {
            const items = getItems();
            const totalPages = Math.ceil(items.length / ITEMS_PER_PAGE);

            if (page < 1) page = 1;
            if (page > totalPages && totalPages > 0) page = totalPages;
            currentPage = page;

            const startIdx = (currentPage - 1) * ITEMS_PER_PAGE;
            const endIdx = startIdx + ITEMS_PER_PAGE;

            items.forEach((item, index) => {
                if (index >= startIdx && index < endIdx) {
                    item.style.display = "";
                    item.style.animation = "none";
                    item.offsetHeight; /* trigger reflow */
                    item.style.animation = "fadeInReviewCard 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards";
                } else {
                    item.style.display = "none";
                }
            });

            renderPagination();

            if (shouldScroll) {
                const targetSection = document.getElementById("reviews");
                if (targetSection) {
                    const navOffset = 90;
                    const targetPos = targetSection.getBoundingClientRect().top + window.pageYOffset - navOffset;
                    window.scrollTo({ top: targetPos, behavior: "smooth" });
                }
            }
        }

        function init() {
            grid = document.getElementById("testimonialsGrid");
            paginationEl = document.getElementById("testimonialsPagination");
            if (!grid) return;
            showPage(1, false);
        }

        return { init: init, showPage: showPage };
    })();

    // =========================================================
    // 2. READ MORE / READ LESS TOGGLE (45-word limit)
    // =========================================================
    window.toggleReview = function(btn) {
        const card = btn.closest('.ukt-reference-review-card');
        if (!card) return;
        const fullContent = card.querySelector('.review-full-content');
        const dots = card.querySelector('.review-dots');
        if (!fullContent) return;

        const isHidden = fullContent.style.display === 'none' || getComputedStyle(fullContent).display === 'none';

        if (isHidden) {
            fullContent.style.display = 'inline';
            if (dots) dots.style.display = 'none';
            btn.innerHTML = 'Read Less <i class="bi bi-chevron-up ms-1"></i>';
            btn.setAttribute('aria-expanded', 'true');
        } else {
            fullContent.style.display = 'none';
            if (dots) dots.style.display = 'inline';
            btn.innerHTML = 'Read More <i class="bi bi-chevron-down ms-1"></i>';
            btn.setAttribute('aria-expanded', 'false');
        }
    }

    function applyReadMoreToCard(card, maxWords) {
        if (!card) return;
        const limit = maxWords || 45;
        const body = card.querySelector('.ukt-reference-review-body');
        if (!body) return;
        const pElement = body.querySelector('p') || body;
        if (!pElement || pElement.querySelector('.review-full-content')) return;

        const rawText = pElement.textContent.trim();
        const words = rawText.split(/\s+/).filter(Boolean);
        if (words.length <= limit) return;

        const tempPreview = document.createElement('span');
        const tempFull = document.createElement('span');
        let wordCount = 0;
        let reachedLimit = false;

        function walk(node, currentPreviewParent, currentFullParent) {
            if (node.nodeType === Node.TEXT_NODE) {
                const text = node.textContent;
                const tokens = text.split(/(\s+)/);

                for (let i = 0; i < tokens.length; i++) {
                    const token = tokens[i];
                    if (!token) continue;
                    const isWord = /\S/.test(token);

                    if (!reachedLimit) {
                        if (isWord) {
                            wordCount++;
                            if (wordCount >= limit) {
                                reachedLimit = true;
                                currentPreviewParent.appendChild(document.createTextNode(token));
                                continue;
                            }
                        }
                        currentPreviewParent.appendChild(document.createTextNode(token));
                    } else {
                        currentFullParent.appendChild(document.createTextNode(token));
                    }
                }
            } else if (node.nodeType === Node.ELEMENT_NODE) {
                if (node.tagName.toLowerCase() === 'button' && node.classList.contains('ukt-read-more-btn')) {
                    return;
                }
                if (!reachedLimit) {
                    const previewClone = node.cloneNode(false);
                    const fullClone = node.cloneNode(false);
                    currentPreviewParent.appendChild(previewClone);

                    for (let child of Array.from(node.childNodes)) {
                        walk(child, previewClone, fullClone);
                    }

                    if (fullClone.hasChildNodes()) {
                        currentFullParent.appendChild(fullClone);
                    }
                } else {
                    currentFullParent.appendChild(node.cloneNode(true));
                }
            }
        }

        for (let child of Array.from(pElement.childNodes)) {
            walk(child, tempPreview, tempFull);
        }

        const dotsSpan = document.createElement('span');
        dotsSpan.className = 'review-dots';
        dotsSpan.textContent = '...';

        const fullSpan = document.createElement('span');
        fullSpan.className = 'review-full-content';
        fullSpan.style.display = 'none';
        fullSpan.appendChild(tempFull);

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'ukt-read-more-btn';
        btn.setAttribute('onclick', 'toggleReview(this)');
        btn.setAttribute('aria-expanded', 'false');
        btn.innerHTML = 'Read More <i class="bi bi-chevron-down ms-1"></i>';

        const br = document.createElement('br');

        pElement.innerHTML = '';
        pElement.appendChild(tempPreview);
        pElement.appendChild(dotsSpan);
        pElement.appendChild(fullSpan);
        pElement.appendChild(br);
        pElement.appendChild(btn);
    }

    function initTestimonialsAutoReadMore() {
        document.querySelectorAll('#testimonialsGrid .ukt-reference-review-card').forEach(function (card) {
            applyReadMoreToCard(card, 45);
        });
    }

    // Initialize on Load
    initTestimonialsAutoReadMore();
    TestimonialsPagination.init();

    // =========================================================
    // 3. ADD TESTIMONIAL FORM (AJAX SUBMISSION)
    // =========================================================
    const form = document.getElementById("addTestimonialForm");
    if (!form) return;

    const titleInput = document.getElementById("testimonialTitle");
    const contentInput = document.getElementById("testimonialContent");
    const titleError = document.getElementById("titleError");
    const contentError = document.getElementById("contentError");
    const successAlert = document.getElementById("testimonialSuccessAlert");
    const grid = document.getElementById("testimonialsGrid");
    const submitBtn = document.getElementById("submitTestimonialBtn");

    // Real-time input error clearing
    titleInput.addEventListener("input", function () {
        if (titleInput.value.trim().length > 0) {
            titleError.style.display = "none";
            titleInput.style.borderColor = "";
        }
    });

    contentInput.addEventListener("input", function () {
        if (contentInput.value.trim().length > 0) {
            contentError.style.display = "none";
            contentInput.style.borderColor = "";
        }
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const titleVal = titleInput.value.trim();
        const contentVal = contentInput.value.trim();
        let isValid = true;

        if (!titleVal) {
            titleError.style.display = "block";
            titleInput.style.borderColor = "#e11d48";
            isValid = false;
        } else {
            titleError.style.display = "none";
            titleInput.style.borderColor = "";
        }

        if (!contentVal) {
            contentError.style.display = "block";
            contentInput.style.borderColor = "#e11d48";
            isValid = false;
        } else {
            contentError.style.display = "none";
            contentInput.style.borderColor = "";
        }

        if (!isValid) return;

        // UI Updates for loading
        submitBtn.disabled = true;
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting...';
        if (successAlert) {
            successAlert.classList.add("d-none");
            successAlert.classList.remove("d-flex");
        }

        // Prepare Data
        const formData = new FormData(form);

        // Send AJAX Request
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // 1. Show success alert
                if (successAlert) {
                    successAlert.classList.remove("d-none");
                    successAlert.classList.add("d-flex");
                }

                // 2. Insert new HTML card into DOM
                if (grid && data.data.html) {
                    grid.insertAdjacentHTML('afterbegin', data.data.html);
                    
                    // Target the newly added card
                    const newCardCol = grid.firstElementChild;
                    const newCardInner = newCardCol.querySelector('.ukt-reference-review-card');

                    // Apply Read More to the new card
                    applyReadMoreToCard(newCardInner, 45);

                    // Reset pagination to page 1 so the new card shows up
                    TestimonialsPagination.showPage(1, false);

                    // Smoothly scroll to the new card
                    newCardCol.scrollIntoView({ behavior: "smooth", block: "center" });
                }

                // 3. Reset form
                form.reset();
            } else {
                // Handle validation errors from backend
                alert(data.data.message || 'Something went wrong. Please try again.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('A network error occurred. Please try again.');
        })
        .finally(() => {
            // Restore button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
        });
    });

    form.addEventListener("reset", function () {
        titleError.style.display = "none";
        contentError.style.display = "none";
        titleInput.style.borderColor = "";
        contentInput.style.borderColor = "";
        if (successAlert) {
            successAlert.classList.add("d-none");
            successAlert.classList.remove("d-flex");
        }
    });
});
</script>

<?php
get_footer();
?>