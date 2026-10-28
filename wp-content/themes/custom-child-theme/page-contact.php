<?php 
    /*Template Name: Contact page Template */
    get_header();
?>
    <article>
        <?php get_template_part('page-banners'); ?>

        <!-- =========================================================
         DIRECT CONTACT CHANNELS & INTERACTIVE FORM
         (Standardized 45px vertical gap & reduced side margins)
    ========================================================== -->
        <section class="ukt-contact-section-gap">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-11 ukt-contact-container">

                        <!-- SECTION HEADER -->
                        <div class="text-center mb-5">
                            <span class="badge px-3 py-1 rounded-pill mb-2 ukt-badge-touchpoints">
                                <i class="bi bi-person-lines-fill me-1"></i> Direct Touchpoints
                            </span>
                            <h2 class="fw-bold mb-2 ukt-contact-main-title">
                                Reach Out To Universal Knowledge Trust
                            </h2>
                            <p class="text-muted mx-auto mb-0 ukt-contact-lead-desc">
                                We welcome your questions, consultation requests, and program enquiries. Connect with us through any of our official channels below.
                            </p>
                        </div>

                        <!-- 3 CONTACT CARDS GRID -->
                        <div class="row g-4 mb-4">

                            <!-- CARD 1: PHONE & MOBILE -->
                            <div class="col-md-4">
                                <div class="ukt-contact-card">
                                    <div class="ukt-contact-icon-circle ukt-contact-icon-gold">
                                        <i class="bi bi-telephone-outbound-fill"></i>
                                    </div>
                                    <h3 class="fw-bold mb-1 ukt-contact-card-title">
                                        Telephone &amp; Mobile
                                    </h3>
                                    <p class="text-muted small mb-3">
                                        Dedicated voice support &amp; consultation
                                    </p>

                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fs-5">☎</span>
                                            <div>
                                                <div class="text-muted ukt-contact-card-meta-label">Office Telephone</div>
                                                <a href="tel:+919632171156" class="fw-bold text-decoration-none ukt-contact-card-link-dark">
                                                    +91 96321 71156
                                                </a>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fs-5">📲</span>
                                            <div>
                                                <div class="text-muted ukt-contact-card-meta-label">Mobile &amp; WhatsApp</div>
                                                <a href="tel:+919845082856" class="fw-bold text-decoration-none ukt-contact-card-link-green">
                                                    +91 98450 82856
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 2: EMAIL -->
                            <div class="col-md-4">
                                <div class="ukt-contact-card">
                                    <div class="ukt-contact-icon-circle ukt-contact-icon-green">
                                        <i class="bi bi-envelope-heart-fill"></i>
                                    </div>
                                    <h3 class="fw-bold mb-1 ukt-contact-card-title">
                                        Official Email
                                    </h3>
                                    <p class="text-muted small mb-3">
                                        Enquiries, registrations &amp; support
                                    </p>

                                    <div class="d-flex flex-column gap-3">
                                        <div>
                                            <div class="text-muted ukt-contact-card-meta-label mb-1">Support Inbox</div>
                                            <a href="mailto:UniversalknowledgR@gmail.com" class="fw-bold text-decoration-none ukt-contact-card-link-dark text-break">
                                                UniversalknowledgR@gmail.com
                                            </a>
                                            <div class="mt-2 text-muted small">
                                                <i class="bi bi-clock-history me-1 text-muted"></i> Responses typically provided within 24–48 hours.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 3: OPERATING HOURS & SCHEDULE -->
                            <div class="col-md-4">
                                <div class="ukt-contact-card">
                                    <div class="ukt-contact-icon-circle ukt-contact-icon-teal">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <h3 class="fw-bold mb-1 ukt-contact-card-title">
                                        Operating Hours
                                    </h3>
                                    <p class="text-muted small mb-3">
                                        Centre schedule &amp; visiting timings
                                    </p>

                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex align-items-start gap-2">
                                            <span class="fs-5">⏰</span>
                                            <div>
                                                <div class="text-muted ukt-contact-card-meta-label">Monday – Saturday</div>
                                                <div class="fw-bold ukt-contact-card-link-dark">
                                                    9:30 AM – 6:30 PM
                                                </div>
                                                <div class="text-muted small mt-1">
                                                    Indian Standard Time (IST)
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-start gap-2">
                                            <span class="fs-5">🌿</span>
                                            <div>
                                                <div class="text-muted ukt-contact-card-meta-label">Sunday &amp; Holidays</div>
                                                <div class="fw-bold text-success">
                                                    By Prior Appointment
                                                </div>
                                                <div class="text-muted small mt-1">
                                                    Special programmes &amp; retreats
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Clean Subtle Divider (45px total vertical rhythm) -->
                        <hr class="ukt-contact-divider">

                        <!-- FORM SECTION -->
                        <div class="row g-4">

                            <!-- CONTACT INQUIRY FORM (FULL WIDTH) -->
                            <div class="col-12">
                                <div class="p-4 p-md-5 rounded-4 h-100 ukt-contact-form-panel">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge px-3 py-1 rounded-pill ukt-badge-enquiry">
                                            <i class="bi bi-chat-square-text me-1"></i> Online Enquiry
                                        </span>
                                    </div>
                                    <h3 class="fw-bold mb-2 ukt-contact-card-title fs-4">
                                        Send Us A Message
                                    </h3>
                                    <p class="text-muted mb-4 small">
                                        Please submit your details below and our team will get back to you promptly.
                                    </p>
                                    <?php the_content(); ?>

                                    
                                </div>
                            </div>

                        </div>

                        <!-- Clean Subtle Divider (45px total vertical rhythm) -->
                        <hr class="ukt-contact-divider">

                        <!-- OUR CENTRES & INTERACTIVE MAPS SECTION -->
                        <div id="our-locations" class="mb-0">
                            <div class="text-center mb-4">
                                <span class="badge px-3 py-1 rounded-pill mb-2 ukt-badge-touchpoints">
                                    <i class="bi bi-geo-alt-fill me-1"></i> Interactive Maps
                                </span>
                                <h3 class="fw-bold mb-2 ukt-contact-main-title fs-3">
                                    Our Healing &amp; Experience Centres
                                </h3>
                                <p class="text-muted mx-auto mb-0 ukt-contact-lead-desc">
                                    Visit our centres in Mangalore and Bangalore. Use the interactive maps below for direct route navigation.
                                </p>
                            </div>

                            <div class="row g-4">
                                <!-- MANGALORE LOCATION -->
                                <div class="col-lg-6">
                                    <div class="p-4 rounded-4 h-100 d-flex flex-column ukt-contact-map-card">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="ukt-location-icon-gold">
                                                    <i class="bi bi-building"></i>
                                                </div>
                                                <div>
                                                    <h4 class="fw-bold mb-0 ukt-contact-card-title">
                                                        Mangalore Centre
                                                    </h4>
                                                    <span class="badge ukt-badge-hq">Headquarters</span>
                                                </div>
                                            </div>
                                            <span class="badge px-3 py-1 rounded-pill ukt-badge-touchpoints">
                                                Mon – Sat: 9:30 AM – 6:30 PM
                                            </span>
                                        </div>

                                        <p class="mb-3 text-muted small">
                                            <strong class="text-dark">Address:</strong> 1st Floor, Krishna Towers, Near More Super Market, Lady Hill, Dakshina Kannada, Mangalore — 575003, Karnataka, India
                                        </p>

                                        <!-- <div class="d-flex flex-wrap gap-2 mb-3 small">
                                            <a href="tel:+919632171156" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                                <i class="bi bi-telephone-fill me-1"></i> +91 96321 71156
                                            </a>
                                            <a href="https://wa.me/919845082856" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-semibold">
                                                <i class="bi bi-whatsapp me-1"></i> +91 98450 82856
                                            </a>
                                        </div> -->

                                        <!-- Google Maps Embed: Mangalore -->
                                        <div class="rounded-3 overflow-hidden mt-auto ukt-contact-map-frame">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15556.996685342465!2d74.835418!3d12.891693!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba35a5daaaaaaab%3A0x1a8309ff8b6b6840!2sUniversal%20Knowledge%20Trust%20%C2%AE!5e0!3m2!1sen!2sin!4v1788807889149!5m2!1sen!2sin" width="100%" height="100%" class="border-0" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                                        </div>
                                    </div>
                                </div>

                                <!-- BANGALORE LOCATION -->
                                <div class="col-lg-6">
                                    <div class="p-4 rounded-4 h-100 d-flex flex-column ukt-contact-map-card">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="ukt-location-icon-green">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                </div>
                                                <div>
                                                    <h4 class="fw-bold mb-0 ukt-contact-card-title">
                                                        Bangalore Centre
                                                    </h4>
                                                    <span class="badge ukt-badge-centre">Wholesomeness Centre</span>
                                                </div>
                                            </div>
                                            <span class="badge px-3 py-1 rounded-pill ukt-badge-enquiry">
                                                By Appointment Only
                                            </span>
                                        </div>

                                        <p class="mb-3 text-muted small">
                                            <strong class="text-dark">Address:</strong> Wholesomeness Centre, 107 Railway Parallel Road, West Kumara Park, Bangalore — 560020, Karnataka, India
                                        </p>

                                        <!-- <div class="d-flex flex-wrap gap-2 mb-3 small">
                                            <a href="tel:+919980365948" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                                <i class="bi bi-telephone-fill me-1"></i> +91 99803 65948
                                            </a>
                                            <a href="https://wa.me/919845082856" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-semibold">
                                                <i class="bi bi-whatsapp me-1"></i> +91 98450 82856
                                            </a>
                                        </div> -->

                                        <!-- Google Maps Embed: Bangalore -->
                                        <div class="rounded-3 overflow-hidden mt-auto ukt-contact-map-frame">
                                            
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d485.95916464725497!2d77.58031095226559!3d12.99273435848083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae170013289c79%3A0x5661ab0adcc13965!2sUniversal%20Knowledge!5e0!3m2!1sen!2sin!4v1791024540597!5m2!1sen!2sin" width="100%" height="100%" class="border-0" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
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
         CALL TO ACTION SECTION
         (Matches about-us CTA section style)
    ========================================================== -->
        <section class="ukt-cta-section ukt-contact-cta-section">
            <div class="container text-center">
                <span class="ukt-contact-cta-eyebrow">DISCOVER INNER HARMONY • AWAKEN &amp; TRANSFORM</span>
                <h2 class="ukt-contact-cta-title">
                    Begin Your Journey Of <span class="ukt-contact-cta-highlight">Self Healing &amp; Positive Living</span>
                </h2>
                <p class="ukt-contact-cta-desc">
                    Explore our free mobile app for remote distance healing, guided meditations, and daily routine practices crafted for complete physical, mental, and spiritual wellbeing.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="<?php echo home_url('parivarthan-apps'); ?>" class="ukt-hero-primary-action ukt-btn-cta-gold">
                        <i class="bi bi-phone-vibrate me-1"></i> Explore Parivarthan App
                    </a>
                    <a href="<?php echo home_url('donations'); ?>" class="ukt-hero-secondary-action ukt-btn-cta-outline">
                        <i class="bi bi-heart-fill text-success me-1"></i> Make A Donation
                    </a>
                </div>
            </div>
        </section>

    </article>

<script>
// Contact Form Handling (mailto prefill & visual confirmation)
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("uktContactForm");
            const feedback = document.getElementById("contactFormFeedback");
            if (form) {
                form.addEventListener("submit", function (e) {
                    e.preventDefault();
                    const name = document.getElementById("contactName").value;
                    const email = document.getElementById("contactEmail").value;
                    const phone = document.getElementById("contactPhone").value;
                    const subject = document.getElementById("contactSubject").value;
                    const message = document.getElementById("contactMessage").value;

                    if (feedback) {
                        feedback.classList.remove("d-none");
                        feedback.scrollIntoView({ behavior: "smooth", block: "nearest" });
                    }

                    const mailtoUrl = "mailto:UniversalknowledgR@gmail.com?subject=" +
                        encodeURIComponent(subject + " - " + name) +
                        "&body=" + encodeURIComponent("Name: " + name + "\nEmail: " + email + "\nPhone: " + phone + "\nInterest: " + subject + "\n\nMessage:\n" + message);

                    setTimeout(function () {
                        window.location.href = mailtoUrl;
                    }, 400);
                });
            }
        });
</script>
<?php
    get_footer();
?>