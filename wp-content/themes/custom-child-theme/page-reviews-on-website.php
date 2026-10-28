<?php
/* Template Name: Reviews on Website Template */
get_header();
?>

<article>
    <?php get_template_part('page-banners'); ?>

    <!-- =========================================================
         SECTION: REVIEWS ON WEBSITE
    ========================================================== -->
    <section id="reviews" class="py-5 ukt-articles-section position-relative">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    TESTIMONIALS &amp; EXPERIENCES
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-serif-title">
                    Reviews on <span>Website</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-flower1"></i>
                    <span></span>
                </div>
            </div>

            <!-- SUBMISSION SUCCESS ALERT CONTAINER -->
            <div id="reviewSubmissionAlert" class="d-none"></div>

            <!-- DYNAMIC REVIEWS GRID -->
            <div class="row g-4 justify-content-center text-start" id="reviewsGrid">
                <?php
                // Fetch all reviews from the database
                $args = array(
                    'post_type'      => 'ukt_review',
                    'posts_per_page' => -1, // Get all reviews
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );
                $reviews_query = new WP_Query($args);

                if ($reviews_query->have_posts()) :
                    while ($reviews_query->have_posts()) : $reviews_query->the_post();
                        $healer  = get_post_meta(get_the_ID(), '_ukt_healer', true);
                        $program = get_post_meta(get_the_ID(), '_ukt_program', true);
                        $rating  = get_post_meta(get_the_ID(), '_ukt_rating', true) ?: 5; // Default to 5 if empty
                        $date    = get_the_date('M d, Y');
                        $content = get_the_content();
                ?>
                    <div class="col-lg-4 col-md-6 col-12 ukt-review-col">
                        <div class="ukt-reference-review-card">
                            <!-- Reviewer Header -->
                            <div class="ukt-reference-review-header">
                                <div>
                                    <h3 class="ukt-reference-review-author"><?php the_title(); ?></h3>
                                    <div class="ukt-card-stars">
                                        <?php for($i=1; $i<=5; $i++) : ?>
                                            <i class="bi bi-star<?php echo ($i <= $rating) ? '-fill' : ''; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <span class="ukt-reference-review-quote-icon">
                                    <i class="bi bi-quote"></i>
                                </span>
                            </div>

                            <!-- Metadata: Healer & Program/Topic -->
                            <?php if ($healer || $program) : ?>
                            <div class="ukt-reference-review-meta-text">
                                <?php if ($healer) : ?><div><strong>Healer:</strong> <?php echo esc_html($healer); ?></div><?php endif; ?>
                                <?php if ($program) : ?><div><strong>Program/Topic:</strong> <?php echo esc_html($program); ?></div><?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <hr class="ukt-reference-review-divider">

                            <!-- Review Body -->
                            <div class="ukt-reference-review-body">
                                <?php echo wpautop(wp_kses_post($content)); ?>
                            </div>

                            <!-- Date -->
                            <div class="ukt-reference-review-date">
                                <?php echo esc_html($date); ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    endwhile; 
                    wp_reset_postdata();
                else : 
                ?>
                    <div class="col-12 text-center"><p>No reviews found. Be the first to share your experience!</p></div>
                <?php endif; ?>
            </div>

            <!-- PAGINATION CONTAINER -->
            <div class="ukt-gallery-pagination-wrap" id="reviewsPagination" role="navigation" aria-label="Reviews Pagination">
                <!-- Pagination dynamically rendered via JavaScript -->
            </div>

        </div>
    </section>

    <!-- =========================================================
         SECTION: SUBMIT YOUR REVIEW FORM
    ========================================================== -->
    <section id="submit-review" class="ukt-submit-review-section">
        <div class="container py-lg-4">

            <!-- SECTION HEADER -->
            <div class="ukt-section-header mb-5">
                <div class="ukt-section-eyebrow">
                    <span></span>
                    SHARE YOUR TESTIMONIAL
                    <span></span>
                </div>
                <h2 class="ukt-section-main-title ukt-serif-title">
                    Submit Your <span>Review</span>
                </h2>
                <div class="ukt-section-heading-design">
                    <span></span>
                    <i class="bi bi-pencil-fill"></i>
                    <span></span>
                </div>
                <p class="text-muted mx-auto mt-3 ukt-section-sub-desc">
                    We would love to hear about your experience with our workshops, healers, and programs. Your
                    sincere review inspires seekers on their healing and learning journeys.
                </p>
            </div>

            <!-- FORM CARD CONTAINER -->
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="ukt-review-form-card">
                        <form id="submitReviewForm" novalidate>

                            <div class="row g-3">
                                <!-- Field: Name -->
                                <div class="col-md-6">
                                    <div class="ukt-form-group">
                                        <label for="reviewAuthorName" class="ukt-form-label">
                                            Name: <span class="req">*</span>
                                        </label>
                                        <input type="text" id="reviewAuthorName" name="author_name"
                                            class="ukt-form-control-custom" placeholder="Enter your full name"
                                            required>
                                    </div>
                                </div>

                                <!-- Field: Email -->
                                <div class="col-md-6">
                                    <div class="ukt-form-group">
                                        <label for="reviewAuthorEmail" class="ukt-form-label">
                                            Email: <span class="req">*</span>
                                        </label>
                                        <input type="email" id="reviewAuthorEmail" name="author_email"
                                            class="ukt-form-control-custom" placeholder="Enter your email address"
                                            required>
                                    </div>
                                </div>

                                <!-- Field: Phone -->
                                <div class="col-md-6">
                                    <div class="ukt-form-group">
                                        <label for="reviewAuthorPhone" class="ukt-form-label">
                                            Phone:
                                        </label>
                                        <input type="tel" id="reviewAuthorPhone" name="author_phone"
                                            class="ukt-form-control-custom" placeholder="Enter your phone number">
                                    </div>
                                </div>

                                <!-- Field: Healer -->
                                <div class="col-md-6">
                                    <div class="ukt-form-group">
                                        <label for="reviewHealer" class="ukt-form-label">
                                            Healer: <span class="req">*</span>
                                        </label>
                                        <input type="text" id="reviewHealer" name="healer"
                                            class="ukt-form-control-custom" value=""
                                            placeholder="Enter healer's name" required>
                                    </div>
                                </div>

                                <!-- Field: Program/Topic -->
                                <div class="col-12">
                                    <div class="ukt-form-group">
                                        <label for="reviewProgram" class="ukt-form-label">
                                            Program/Topic: <span class="req">*</span>
                                        </label>
                                        <input type="text" id="reviewProgram" name="program_topic"
                                            class="ukt-form-control-custom" value=""
                                            placeholder="Enter program or workshop topic" required>
                                    </div>
                                </div>

                                <!-- Field: Rating (Interactive 5-star selector) -->
                                <div class="col-12">
                                    <div class="ukt-form-group">
                                        <label class="ukt-form-label">Rating:</label>
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <div class="ukt-star-rating-wrap" id="starRatingWidget"
                                                role="radiogroup" aria-label="Rating selector">
                                                <button type="button" class="star-btn active" data-rating="1" aria-label="1 star"><i class="bi bi-star-fill"></i></button>
                                                <button type="button" class="star-btn active" data-rating="2" aria-label="2 stars"><i class="bi bi-star-fill"></i></button>
                                                <button type="button" class="star-btn active" data-rating="3" aria-label="3 stars"><i class="bi bi-star-fill"></i></button>
                                                <button type="button" class="star-btn active" data-rating="4" aria-label="4 stars"><i class="bi bi-star-fill"></i></button>
                                                <button type="button" class="star-btn active" data-rating="5" aria-label="5 stars"><i class="bi bi-star-fill"></i></button>
                                            </div>
                                            <span class="ukt-rating-label-text" id="ratingLabelText">5.0 • Excellent</span>
                                            <input type="hidden" id="reviewRating" name="rating" value="5">
                                        </div>
                                    </div>
                                </div>

                                <!-- Field: Review (Textarea) -->
                                <div class="col-12">
                                    <div class="ukt-form-group">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label for="reviewText" class="ukt-form-label mb-0">
                                                Review: <span class="req">*</span>
                                            </label>
                                            <span class="text-muted ukt-form-hint-sm" id="wordCountDisplay">0 words</span>
                                        </div>
                                        <textarea id="reviewText" name="review_content"
                                            class="ukt-form-control-custom" rows="5"
                                            placeholder="Write your review, transformation story, or appreciation here..."
                                            required></textarea>
                                        <small class="text-muted mt-1 d-block ukt-form-hint-xs">
                                            <i class="bi bi-info-circle me-1"></i> Reviews exceeding 35 words will
                                            automatically feature a "Read More" button on the card.
                                        </small>
                                    </div>
                                </div>

                                <!-- Field: Confirm Human Checkbox -->
                                <div class="col-12">
                                    <div class="ukt-human-verify-box">
                                        <div class="form-check m-0 d-flex align-items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="reviewHumanConfirm"
                                                required>
                                            <label class="form-check-label" for="reviewHumanConfirm">
                                                Check this box to confirm you are human.
                                            </label>
                                        </div>
                                        <i class="bi bi-shield-check ms-auto text-success ukt-form-icon-upload"></i>
                                    </div>
                                </div>

                                <!-- Actions: Submit & Cancel -->
                                <div class="col-12">
                                    <div class="ukt-form-actions">
                                        <button type="submit" class="ukt-btn-form-submit" id="submitReviewBtn">
                                            <i class="bi bi-send-fill"></i> Submit
                                        </button>
                                        <button type="button" class="ukt-btn-form-cancel" id="cancelReviewBtn">
                                            <i class="bi bi-x-circle"></i> Cancel
                                        </button>
                                    </div>
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
    <section class="ukt-cta-section ukt-cta-luxury-bg">
        <div class="container text-center">
            <span class="ukt-cta-eyebrow">BEGIN YOUR HEALING JOURNEY</span>
            <h2 class="ukt-cta-title">
                Transform Your Life. <span class="ukt-gold-italic">Experience Pure Healing.</span>
            </h2>
            <p class="ukt-cta-desc">
                Whether you wish to participate in our guided healing sessions, enroll in empowering life-skill
                workshops, or share your own journey of growth, Universal Knowledge Trust welcomes you with open
                hearts.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="<?php echo home_url('our-training-programs'); ?>" class="ukt-hero-primary-action ukt-cta-btn-gold">
                    Explore Programs <i class="bi bi-arrow-right"></i>
                </a>
                <a href="mailto:UniversalknowledgR@gmail.com"
                    class="ukt-hero-secondary-action ukt-cta-btn-outline">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>

</article>

<!-- =========================================================
     INLINE JAVASCRIPT LOGIC & AJAX
========================================================== -->
<script>
    // Pass WordPress AJAX URL and Security Nonce to JS
    const ukt_ajax_obj = {
        ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>',
        nonce: '<?php echo wp_create_nonce('ukt_review_nonce'); ?>'
    };

    document.addEventListener("DOMContentLoaded", function () {
        // --- 1. DYNAMIC CURRENT YEAR & STICKY HEADER (If handled elsewhere, ignore) ---
        const yearElem = document.getElementById("ukt-current-year");
        if (yearElem) yearElem.textContent = new Date().getFullYear();

        // --- 2. APPLY READ MORE TO CARD (COUNTS ALL PARAGRAPHS) ---
        function applyReadMoreToCard(card, maxWords) {
            if (!card) return;
            const limit = maxWords || 45;
            const body = card.querySelector('.ukt-reference-review-body');
            if (!body || body.querySelector('.review-full-content')) return;

            const rawText = body.textContent.trim();
            const words = rawText.split(/\s+/).filter(Boolean);
            
            // If it's under the limit, do nothing
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
                    if (node.tagName.toLowerCase() === 'button' && node.classList.contains('ukt-read-more-btn')) return;
                    
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

            // Iterate over ALL child nodes of the body (handles multiple <p> tags)
            for (let child of Array.from(body.childNodes)) {
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
            btn.setAttribute('aria-expanded', 'false');
            btn.innerHTML = 'Read More <i class="bi bi-chevron-down ms-1"></i>';
            
            // Use Event Listener instead of inline onclick
            btn.addEventListener('click', function() {
                const isHidden = fullSpan.style.display === 'none';
                if (isHidden) {
                    fullSpan.style.display = 'inline';
                    dotsSpan.style.display = 'none';
                    this.innerHTML = 'Read Less <i class="bi bi-chevron-up ms-1"></i>';
                    this.setAttribute('aria-expanded', 'true');
                } else {
                    fullSpan.style.display = 'none';
                    dotsSpan.style.display = 'inline';
                    this.innerHTML = 'Read More <i class="bi bi-chevron-down ms-1"></i>';
                    this.setAttribute('aria-expanded', 'false');
                }
            });

            // Clear the body and append the new structure
            body.innerHTML = '';
            body.appendChild(tempPreview);
            body.appendChild(dotsSpan);
            body.appendChild(fullSpan);
            body.appendChild(document.createElement('br'));
            body.appendChild(btn);
        }

        // --- 4. REVIEWS MANAGER (Pagination & Dynamic Insert) ---
        const ReviewsManager = (function () {
            const ITEMS_PER_PAGE = 9;
            let currentPage = 1;
            let grid = null;
            let paginationEl = null;

            function escapeHtml(str) {
                if (!str) return "";
                return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
            }

            function getItems() {
                if (!grid) return [];
                return Array.from(grid.querySelectorAll(".ukt-review-col"));
            }

            function renderPagination() {
                const items = getItems();
                const totalItems = items.length;
                const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);

                if (!paginationEl) return;
                if (totalPages <= 1) { paginationEl.innerHTML = ""; return; }

                let buttonsHTML = `<div class="ukt-gallery-pagination" role="navigation" aria-label="Reviews Pagination">`;
                
                buttonsHTML += `<button type="button" class="ukt-page-btn nav-btn" data-page="${currentPage - 1}" ${currentPage === 1 ? "disabled" : ""}><i class="bi bi-chevron-left"></i> Prev</button>`;

                for (let i = 1; i <= totalPages; i++) {
                    if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                        buttonsHTML += `<button type="button" class="ukt-page-btn ${i === currentPage ? "active" : ""}" data-page="${i}">${i}</button>`;
                    } else if (i === currentPage - 2 || i === currentPage + 2) {
                        buttonsHTML += `<span class="ukt-page-ellipsis">...</span>`;
                    }
                }

                buttonsHTML += `<button type="button" class="ukt-page-btn nav-btn" data-page="${currentPage + 1}" ${currentPage === totalPages ? "disabled" : ""}>Next <i class="bi bi-chevron-right"></i></button></div>`;

                const visibleStart = (currentPage - 1) * ITEMS_PER_PAGE + 1;
                const visibleEnd = Math.min(currentPage * ITEMS_PER_PAGE, totalItems);
                buttonsHTML += `<div class="ukt-pagination-info">Showing <strong>${visibleStart}–${visibleEnd}</strong> of <strong>${totalItems}</strong> reviews</div>`;

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
                        const targetPos = targetSection.getBoundingClientRect().top + window.pageYOffset - 90;
                        window.scrollTo({ top: targetPos, behavior: "smooth" });
                    }
                }
            }

            function createReviewCardElement(data, isNew) {
                const col = document.createElement("div");
                col.className = "col-lg-4 col-md-6 col-12 ukt-review-col user-submitted-col";

                const reviewBodyHtml = escapeHtml(data.review).replace(/\n\n+/g, "<br><br>").replace(/\n/g, "<br>");
                const ratingCount = (data.rating && data.rating > 0) ? parseInt(data.rating, 10) : 5;
                
                let starsHtml = `<div class="ukt-card-stars">`;
                for (let s = 1; s <= 5; s++) {
                    starsHtml += s <= ratingCount ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                }
                starsHtml += `</div>`;

                col.innerHTML = `
                    <div class="ukt-reference-review-card ${isNew ? 'ukt-highlight-new-card' : ''}">
                        <div class="ukt-reference-review-header">
                            <div>
                                <h3 class="ukt-reference-review-author">${escapeHtml(data.name)}</h3>
                                ${starsHtml}
                            </div>
                            <span class="ukt-reference-review-quote-icon">
                                <i class="bi bi-quote"></i>
                            </span>
                        </div>
                        <div class="ukt-reference-review-meta-text">
                            <div><strong>Healer:</strong> ${escapeHtml(data.healer)}</div>
                            <div><strong>Program/Topic:</strong> ${escapeHtml(data.program)}</div>
                        </div>
                        <hr class="ukt-reference-review-divider">
                        <p class="ukt-reference-review-body">${reviewBodyHtml}</p>
                        <div class="ukt-reference-review-date d-flex justify-content-between align-items-center">
                            <span>${escapeHtml(data.date)}</span>
                            <span class="badge ukt-review-badge-light">
                                <i class="bi bi-patch-check-fill me-1"></i>Community Review
                            </span>
                        </div>
                    </div>
                `;

                applyReadMoreToCard(col.querySelector('.ukt-reference-review-card'), 45);
                return col;
            }

            function addReview(data) {
                const cardEl = createReviewCardElement(data, true);
                if (grid) {
                    grid.insertBefore(cardEl, grid.firstChild);
                }
                showPage(1, false);

                const alertContainer = document.getElementById("reviewSubmissionAlert");
                if (alertContainer) {
                    alertContainer.style.display = "block";
                    alertContainer.innerHTML = `
                        <div class="alert alert-success ukt-alert-success-custom d-flex align-items-center justify-content-between gap-3 p-3 mb-4 rounded-4 shadow-sm" style="background-color: #d1e7dd; border-color: #badbcc; color: #0f5132;">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-check-circle-fill text-success ukt-success-icon-lg" style="font-size: 2rem;"></i>
                                <div>
                                    <h5 class="mb-1 ukt-alert-success-title">Review Submitted Successfully!</h5>
                                    <p class="mb-0 ukt-alert-success-text">Thank you, <strong>${escapeHtml(data.name)}</strong>! Your review has been added to the reviews collection above.</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" onclick="document.getElementById('reviewSubmissionAlert').style.display='none';" aria-label="Close"></button>
                        </div>
                    `;
                }

                const reviewsSec = document.getElementById("reviews");
                if (reviewsSec) {
                    const targetPos = reviewsSec.getBoundingClientRect().top + window.pageYOffset - 80;
                    window.scrollTo({ top: targetPos, behavior: "smooth" });
                }
            }

            function init() {
                grid = document.getElementById("reviewsGrid");
                paginationEl = document.getElementById("reviewsPagination");
                if (!grid) return;

                // Apply Read More to initial PHP loaded cards
                document.querySelectorAll('.ukt-reference-review-card').forEach(card => applyReadMoreToCard(card, 45));
                showPage(1, false);
            }

            return { init: init, addReview: addReview };
        })();

        // --- 5. INITIALIZE REVIEWS ---
        ReviewsManager.init();

        // --- 6. FORM UI CONTROLS & AJAX SUBMISSION ---
        const form = document.getElementById("submitReviewForm");
        const cancelBtn = document.getElementById("cancelReviewBtn");
        const wordCountDisplay = document.getElementById("wordCountDisplay");
        const reviewText = document.getElementById("reviewText");
        const ratingInput = document.getElementById("reviewRating");
        const ratingLabel = document.getElementById("ratingLabelText");
        const starBtns = document.querySelectorAll("#starRatingWidget .star-btn");

        const ratingLabels = { 1: "1.0 • Poor", 2: "2.0 • Fair", 3: "3.0 • Good", 4: "4.0 • Very Good", 5: "5.0 • Excellent" };

        function setRating(val) {
            if (ratingInput) ratingInput.value = val;
            if (ratingLabel) ratingLabel.textContent = ratingLabels[val] || (val + ".0");
            starBtns.forEach(btn => {
                const starVal = parseInt(btn.getAttribute("data-rating"), 10);
                if (starVal <= val) {
                    btn.classList.add("active");
                    btn.innerHTML = '<i class="bi bi-star-fill"></i>';
                } else {
                    btn.classList.remove("active");
                    btn.innerHTML = '<i class="bi bi-star"></i>';
                }
            });
        }

        starBtns.forEach(btn => {
            btn.addEventListener("click", function () { setRating(parseInt(this.getAttribute("data-rating"), 10)); });
            btn.addEventListener("mouseenter", function () {
                const hoverVal = parseInt(this.getAttribute("data-rating"), 10);
                starBtns.forEach(b => {
                    const starVal = parseInt(b.getAttribute("data-rating"), 10);
                    b.classList.toggle("hover-active", starVal <= hoverVal);
                });
            });
        });

        const starWidget = document.getElementById("starRatingWidget");
        if (starWidget) starWidget.addEventListener("mouseleave", () => starBtns.forEach(b => b.classList.remove("hover-active")));

        if (reviewText && wordCountDisplay) {
            reviewText.addEventListener("input", function () {
                const words = this.value.trim() === "" ? 0 : this.value.trim().split(/\s+/).length;
                wordCountDisplay.textContent = words + (words === 1 ? " word" : " words");
            });
        }

        if (cancelBtn && form) {
            cancelBtn.addEventListener("click", function () {
                form.reset();
                setRating(5);
                if (wordCountDisplay) wordCountDisplay.textContent = "0 words";
                document.getElementById("reviewHealer").value = "";
                document.getElementById("reviewProgram").value = "";
            });
        }

        if (form) {
            form.addEventListener("submit", function (e) {
                e.preventDefault();

                const nameInput = document.getElementById("reviewAuthorName");
                const emailInput = document.getElementById("reviewAuthorEmail");
                const phoneInput = document.getElementById("reviewAuthorPhone");
                const healerInput = document.getElementById("reviewHealer");
                const progInput = document.getElementById("reviewProgram");
                const humanCheck = document.getElementById("reviewHumanConfirm");
                const submitBtn = document.getElementById("submitReviewBtn");

                const name = nameInput.value.trim();
                const email = emailInput.value.trim();
                const phone = phoneInput ? phoneInput.value.trim() : "";
                const healer = healerInput.value.trim();
                const program = progInput.value.trim();
                const review = reviewText.value.trim();
                const rating = parseInt(ratingInput ? ratingInput.value : "5", 10) || 5;

                // Validations
                if (!name) { alert("Please enter your name."); nameInput.focus(); return; }
                if (!email || !email.includes("@")) { alert("Please enter a valid email."); emailInput.focus(); return; }
                if (!healer) { alert("Please specify the healer."); healerInput.focus(); return; }
                if (!program) { alert("Please specify the program."); progInput.focus(); return; }
                if (!review) { alert("Please write your review."); reviewText.focus(); return; }
                if (!humanCheck || !humanCheck.checked) { alert("Please confirm you are human."); return; }

                // Prepare AJAX data
                const formData = new FormData();
                formData.append('action', 'submit_ukt_review');
                formData.append('nonce', ukt_ajax_obj.nonce);
                formData.append('name', name);
                formData.append('email', email);
                formData.append('phone', phone);
                formData.append('healer', healer);
                formData.append('program', program);
                formData.append('rating', rating);
                formData.append('review', review);

                // Change button state
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Submitting...';
                submitBtn.disabled = true;

                // Fetch Request to WordPress Backend
                fetch(ukt_ajax_obj.ajax_url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(res => {
                    if (res.success) {
                        // Data saved! Add the new card dynamically
                        ReviewsManager.addReview(res.data);

                        // Reset form
                        form.reset();
                        setRating(5);
                        if (wordCountDisplay) wordCountDisplay.textContent = "0 words";
                        document.getElementById("reviewHealer").value = "";
                        document.getElementById("reviewProgram").value = "";
                    } else {
                        alert(res.data.message || "Something went wrong.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("There was an error submitting your review.");
                })
                .finally(() => {
                    submitBtn.innerHTML = '<i class="bi bi-send-fill"></i> Submit';
                    submitBtn.disabled = false;
                });
            });
        }
    });
</script>

<?php get_footer(); ?>