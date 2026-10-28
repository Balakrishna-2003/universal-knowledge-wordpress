<?php
function twentytwentyfive_child_enqueue_assets() {

    // Load child theme's style.css (required by WordPress for theme metadata or overrides)
    wp_enqueue_style(
        'twentytwentyfive-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->get('Version')
    );

    // Enqueue your static site's CSS files
    wp_enqueue_style('bhi-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0');
    // wp_enqueue_style('bhi-animate', get_stylesheet_directory_uri() . '/assets/css/animate.css', array(), '1.0');
    // wp_enqueue_style('bhi-owl-carousel', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4');
    wp_enqueue_style('bhi-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), '1.0');

    // Use WordPress's built-in jQuery
    wp_enqueue_script('jquery');

    // Enqueue JavaScript libraries
    wp_enqueue_script(
        'bhi-bootstrap-bundle',
        get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.0',
        true
    );

    // wp_enqueue_script(
    //     'bhi-owl-carousel',
    //     get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js',
    //     array('jquery'),
    //     '2.3.4',
    //     true
    // );

    wp_enqueue_script(
        'bhi-wow',
        get_stylesheet_directory_uri() . '/assets/js/wow.min.js',
        array('jquery'),
        '1.1.3',
        true
    );

    // Optional: enqueue custom.js only if it exists
    if (file_exists(get_stylesheet_directory() . '/assets/js/custom.js')) {
        wp_enqueue_script(
            'bhi-custom-script',
            get_stylesheet_directory_uri() . '/assets/js/custom.js',
            array('jquery'),
            '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'twentytwentyfive_child_enqueue_assets');


/**
 * Force allow PDF uploads and handle alternative MIME types.
 */
function ukt_allow_pdf_uploads( $mimes ) {
    $mimes['pdf'] = 'application/pdf';
    $mimes['pdf'] = 'application/x-pdf';
    return $mimes;
}
add_filter( 'upload_mimes', 'ukt_allow_pdf_uploads' );

/**
 * Bypass strict real-mime check if the server misreads the PDF header.
 */
add_filter( 'wp_check_filetype_and_ext', function( $filedata, $file, $filename, $mimes ) {
    $ext = pathinfo( $filename, PATHINFO_EXTENSION );
    if ( 'pdf' === strtolower( $ext ) ) {
        $filedata['ext']  = 'pdf';
        $filedata['type'] = 'application/pdf';
        $filedata['proper_filename'] = $filename;
    }
    return $filedata;
}, 10, 4 );



/**
 * ============================================================================
 * E-LETTERS PAGE META BOX (Bulletproof Base64 Save Mechanism)
 * ============================================================================
 */

// 1. REGISTER THE META BOX
add_action('add_meta_boxes', function ($post_type, $post) {
    if ($post_type !== 'page' || !$post) return;
    if ($post->post_name !== 'e-letter') return;

    add_meta_box(
        'ukt_e_letters_metabox',
        __('E-Letters Manager', 'ukt'),
        'ukt_e_letters_metabox_render',
        'page',
        'normal',
        'high'
    );
}, 10, 2);

// 2. ENQUEUE WP MEDIA UPLOADER
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) return;
    if (empty($_GET['post'])) return;

    $post = get_post(intval($_GET['post']));
    if (!$post || $post->post_type !== 'page') return;
    if ($post->post_name !== 'e-letter') return;

    wp_enqueue_media();
});

// 3. META BOX RENDER
function ukt_e_letters_metabox_render($post) {
    wp_nonce_field('ukt_e_letters_save', 'ukt_e_letters_nonce');

    $data = get_post_meta($post->ID, '_ukt_e_letters', true);
    if (!is_array($data)) $data = [];
    
    uksort($data, function ($a, $b) { return intval($b) - intval($a); });
    
    // Base64 encode to prevent WordPress from escaping quotes/slashes in the JSON
    $json = wp_json_encode($data);
    if ($json === false) $json = '{}';
    $base64_json = base64_encode($json);
    ?>
    <style>
        #ukt-el-manager { padding: 8px 0 16px; }
        #ukt-el-manager .description { margin-bottom: 14px; }
        .ukt-el-year-group { margin-bottom: 12px; border: 1px solid #ccd0d4; border-radius: 6px; background: #fff; overflow: hidden; }
        
        /* Header */
        .ukt-el-year-header { display: flex; align-items: center; justify-content: space-between; padding: 14px 18px; background: #f6f7f7; cursor: pointer; user-select: none; transition: background .15s; }
        .ukt-el-year-header:hover { background: #eef0f1; }
        .ukt-el-year-header.is-open { border-bottom: 1px solid #ccd0d4; }
        .ukt-el-year-left { display: flex; align-items: center; gap: 10px; }
        .ukt-el-caret { display: inline-block; font-size: 14px; color: #50575e; transition: transform .2s ease; width: 14px; }
        .ukt-el-caret.is-open { transform: rotate(90deg); }
        .ukt-el-year-label { font-size: 15px; color: #1d2327; }
        .ukt-el-year-count { color: #646970; font-size: 13px; }
        .ukt-el-year-body { padding: 16px 18px; display: none; }

        /* Entry Rows */
        .ukt-el-entry { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; background: #f9f9f9; border: 1px solid #e5e5e5; border-radius: 4px; margin-bottom: 8px; gap: 12px; }
        .ukt-el-entry:last-child { margin-bottom: 0; }
        .ukt-el-entry-thumb { flex-shrink: 0; width: 48px; height: 60px; border: 1px dashed #ccc; border-radius: 3px; background: #fff; display: flex; align-items: center; justify-content: center; overflow: hidden; color: #ccc; }
        .ukt-el-entry-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .ukt-el-entry-thumb::before { content: "📄"; font-size: 20px; }
        .ukt-el-entry-thumb.has-image::before { display: none; }
        .ukt-el-entry-info { flex: 1; min-width: 0; }
        .ukt-el-entry-title { display: block; color: #1d2327; font-weight: 600; margin-bottom: 2px; font-size: 14px; }
        .ukt-el-entry-file { font-size: 12px; color: #646970; word-break: break-all; }
        .ukt-el-entry-actions { flex-shrink: 0; white-space: nowrap; display: flex; gap: 6px; }

        /* Inline Form */
        .ukt-el-entry-form-wrap { margin-top: 16px; padding: 16px; background: #f9f9f9; border: 1px dashed #ccd0d4; border-radius: 6px; }
        .ukt-el-entry-form-wrap h4 { margin: 0 0 12px; font-size: 14px; color: #1d2327; }
        .ukt-el-entry-form-wrap p { margin: 0 0 12px; }
        .ukt-el-entry-form-wrap label { display: block; font-weight: 600; margin-bottom: 4px; color: #1d2327; }
        .ukt-el-entry-form-wrap .ukt-el-file-name, .ukt-el-entry-form-wrap .ukt-el-cover-name { color: #646970; margin-left: 8px; font-style: italic; font-size: 13px; }

        /* Cover Preview */
        .ukt-el-cover-preview { margin-top: 10px; width: 80px; height: 100px; border: 1px solid #ddd; border-radius: 4px; background: #fff; display: none; overflow: hidden; }
        .ukt-el-cover-preview img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .ukt-el-cover-clear { font-size: 12px; margin-left: 8px; color: #b32d2e; cursor: pointer; text-decoration: underline; }

        .ukt-el-add-year-wrap { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
        .ukt-el-add-year-wrap label { font-weight: 600; margin-right: 8px; }
        .ukt-el-empty { color: #646970; font-style: italic; padding: 12px; text-align: center; background: #f1f1f1; border-radius: 4px; }
        .ukt-el-danger { color: #b32d2e !important; border-color: #b32d2e !important; }
        .ukt-el-danger:hover { background: #fcf0f1 !important; border-color: #8a2424 !important; }
    </style>

    <div id="ukt-el-manager">
        <p class="description">
            Manage E-Letters grouped by year. Click any year header to expand or collapse it.
            Each entry has a <strong>Title</strong>, a <strong>Cover Image</strong>, and a <strong>File</strong>.
            Changes are saved when you click <strong>Update</strong> on the page.
        </p>

        <div id="ukt-el-years-container"></div>

        <div class="ukt-el-add-year-wrap">
            <label for="ukt-el-new-year">Add New Year:</label>
            <input type="number" id="ukt-el-new-year" placeholder="e.g. 2026" min="2000" max="2100" step="1" style="width: 130px;">
            <button type="button" class="button button-primary" id="ukt-el-add-year-btn">Add Year</button>
        </div>

        <textarea name="ukt_e_letters_data" id="ukt-el-data" style="display:none;"><?php echo esc_textarea($base64_json); ?></textarea>
    </div>

    <script>
    (function ($) {
        'use strict';
        $(function () {
            const $container = $('#ukt-el-years-container');
            const $dataField = $('#ukt-el-data');
            const openYears = new Set();

            let data = {};
            
            // Decode the Base64 JSON string
            try { 
                const base64Str = $dataField.val();
                if (base64Str) {
                    const jsonStr = decodeURIComponent(escape(atob(base64Str)));
                    const parsed = JSON.parse(jsonStr);
                    if (parsed && typeof parsed === 'object' && !Array.isArray(parsed)) {
                        data = parsed;
                    }
                }
            } catch (e) { 
                console.error('Failed to parse initial data', e); 
                data = {};
            }

            function saveData() { 
                try {
                    // Encode to Base64 before saving to bypass WordPress escaping
                    const jsonStr = JSON.stringify(data);
                    $dataField.val(btoa(unescape(encodeURIComponent(jsonStr))));
                } catch (e) {
                    console.error('Failed to encode data', e);
                }
            }

            function escapeHtml(str) {
                return String(str == null ? '' : str).replace(/[&<>"']/g, function (s) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[s];
                });
            }

            function getFileName(url) {
                if (!url) return '';
                try { return decodeURIComponent(url.split('/').pop().split('?')[0]); }
                catch (e) { return url; }
            }

            function resetForm($form) {
                $form.data('edit-index', -1);
                $form.find('.ukt-el-form-title').text('New E-Letter');
                $form.find('.ukt-el-entry-title').val('');
                $form.find('.ukt-el-cover-id').val('');
                $form.find('.ukt-el-cover-url').val('');
                $form.find('.ukt-el-cover-name').text('');
                $form.find('.ukt-el-cover-clear').hide();
                $form.find('.ukt-el-cover-preview').hide().find('img').attr('src', '');
                $form.find('.ukt-el-file-id').val('');
                $form.find('.ukt-el-file-url').val('');
                $form.find('.ukt-el-file-name').text('');
            }

            function render() {
                $container.empty();
                const years = Object.keys(data).sort(function (a, b) {
                    return parseInt(b, 10) - parseInt(a, 10);
                });

                if (years.length === 0) {
                    $container.append('<div class="ukt-el-empty">No years added yet. Use the field below to add a year.</div>');
                    return;
                }
                
                years.forEach(function (year) { 
                    const entries = Array.isArray(data[year]) ? data[year] : [];
                    const countLabel = entries.length + ' ' + (entries.length === 1 ? 'entry' : 'entries');

                    const $group = $(
                        '<div class="ukt-el-year-group" data-year="' + escapeHtml(year) + '">' +
                            '<div class="ukt-el-year-header">' +
                                '<div class="ukt-el-year-left">' +
                                    '<span class="ukt-el-caret">▶</span>' +
                                    '<strong class="ukt-el-year-label">' + escapeHtml(year) + '</strong>' +
                                    '<span class="ukt-el-year-count">(' + countLabel + ')</span>' +
                                '</div>' +
                                '<div>' +
                                    '<button type="button" class="button ukt-el-delete-year ukt-el-danger">Delete Year</button>' +
                                '</div>' +
                            '</div>' +
                            '<div class="ukt-el-year-body">' +
                                '<div class="ukt-el-entries"></div>' +
                                '<button type="button" class="button button-primary ukt-el-add-entry-btn" style="margin-top:10px;">+ Add E-Letter</button>' +
                                '<div class="ukt-el-entry-form-wrap" style="display:none;">' +
                                    '<h4 class="ukt-el-form-title">New E-Letter</h4>' +
                                    '<p>' +
                                        '<label>Title</label>' +
                                        '<input type="text" class="ukt-el-entry-title widefat" placeholder="e.g. January – February 2026">' +
                                    '</p>' +
                                    '<p>' +
                                        '<label>Cover Image</label>' +
                                        '<button type="button" class="button ukt-el-upload-cover-btn">Upload / Select Cover</button>' +
                                        '<span class="ukt-el-cover-name"></span>' +
                                        '<span class="ukt-el-cover-clear" style="display:none;">Remove cover</span>' +
                                        '<input type="hidden" class="ukt-el-cover-id">' +
                                        '<input type="hidden" class="ukt-el-cover-url">' +
                                        '<div class="ukt-el-cover-preview"><img src="" alt=""></div>' +
                                    '</p>' +
                                    '<p>' +
                                        '<label>File (PDF / Document)</label>' +
                                        '<button type="button" class="button ukt-el-upload-file-btn">Upload / Select File</button>' +
                                        '<span class="ukt-el-file-name"></span>' +
                                        '<input type="hidden" class="ukt-el-file-id">' +
                                        '<input type="hidden" class="ukt-el-file-url">' +
                                    '</p>' +
                                    '<p style="margin:16px 0 0;">' +
                                        '<button type="button" class="button button-primary ukt-el-save-entry">Save Entry</button> ' +
                                        '<button type="button" class="button ukt-el-cancel-entry">Cancel</button>' +
                                    '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );

                    const $entriesWrap = $group.find('.ukt-el-entries');
                    if (entries.length === 0) {
                        $entriesWrap.append('<div class="ukt-el-empty">No entries yet for this year.</div>');
                    } else {
                        entries.forEach(function (entry, idx) {
                            const fileName  = getFileName(entry.file_url || '');
                            const coverUrl  = entry.cover_url || '';
                            const hasImg    = coverUrl ? ' has-image' : '';
                            const coverHtml = coverUrl ? '<img src="' + escapeHtml(coverUrl) + '" alt="">' : '';

                            const $entry = $(
                                '<div class="ukt-el-entry" data-index="' + idx + '">' +
                                    '<div class="ukt-el-entry-thumb' + hasImg + '">' + coverHtml + '</div>' +
                                    '<div class="ukt-el-entry-info">' +
                                        '<span class="ukt-el-entry-title">' + escapeHtml(entry.title || '') + '</span>' +
                                        '<span class="ukt-el-entry-file">📎 ' + escapeHtml(fileName || '(no file)') + '</span>' +
                                    '</div>' +
                                    '<div class="ukt-el-entry-actions">' +
                                        '<button type="button" class="button ukt-el-edit-entry">Edit</button>' +
                                        '<button type="button" class="button ukt-el-danger ukt-el-remove-entry">Remove</button>' +
                                    '</div>' +
                                '</div>'
                            );
                            $entriesWrap.append($entry);
                        });
                    }

                    if (openYears.has(year)) {
                        $group.find('.ukt-el-year-body').show();
                        $group.find('.ukt-el-caret').addClass('is-open');
                        $group.find('.ukt-el-year-header').addClass('is-open');
                    }

                    $container.append($group);
                });
            }

            function openMediaFrame(opts, onSelect) {
                if (typeof wp === 'undefined' || !wp.media) {
                    alert('Media library is not available. Please reload the page.');
                    return;
                }
                const frame = wp.media({
                    title: opts.title || 'Select File',
                    button: { text: opts.buttonText || 'Use This File' },
                    multiple: false,
                    library: opts.library || {}
                });
                frame.on('select', function () {
                    const att = frame.state().get('selection').first().toJSON();
                    onSelect(att);
                });
                frame.open();
            }

            // =================================================================
            // DELEGATED EVENTS (Ensures buttons work after render())
            // =================================================================

            $container.on('click', '.ukt-el-year-header', function(e) {
                if ($(e.target).closest('.ukt-el-delete-year').length) return;
                
                const $header = $(this);
                const $group = $header.closest('.ukt-el-year-group');
                const year = $group.data('year');
                const $body = $group.find('.ukt-el-year-body');
                const $caret = $header.find('.ukt-el-caret');
                const isOpen = $body.is(':visible');

                if (isOpen) {
                    $body.slideUp(150);
                    $caret.removeClass('is-open');
                    $header.removeClass('is-open');
                    openYears.delete(year);
                } else {
                    $body.slideDown(150);
                    $caret.addClass('is-open');
                    $header.addClass('is-open');
                    openYears.add(year);
                }
            });

            $container.on('click', '.ukt-el-year-body', function(e) {
                e.stopPropagation(); // Prevents accordion from closing when clicking inside
            });

            $container.on('click', '.ukt-el-delete-year', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const $group = $(this).closest('.ukt-el-year-group');
                const year = $group.data('year');
                
                if (!confirm('Are you sure you want to delete the year ' + year + ' and ALL its entries?')) return;
                
                delete data[year];
                openYears.delete(year);
                saveData();
                render();
            });

            $container.on('click', '.ukt-el-add-entry-btn', function(e) {
                e.preventDefault();
                const $group = $(this).closest('.ukt-el-year-group');
                const $form = $group.find('.ukt-el-entry-form-wrap');
                
                resetForm($form);
                $form.slideDown(150);
                $form.find('.ukt-el-entry-title').focus();
            });

            $container.on('click', '.ukt-el-cancel-entry', function(e) {
                e.preventDefault();
                $(this).closest('.ukt-el-entry-form-wrap').slideUp(150);
            });

            $container.on('click', '.ukt-el-upload-cover-btn', function(e) {
                e.preventDefault();
                const $form = $(this).closest('.ukt-el-entry-form-wrap');
                
                openMediaFrame(
                    { title: 'Select Cover Image', buttonText: 'Use This Cover', library: { type: 'image' } },
                    function (att) {
                        const previewUrl = att.sizes && att.sizes.medium ? att.sizes.medium.url : att.url;
                        $form.find('.ukt-el-cover-id').val(att.id);
                        $form.find('.ukt-el-cover-url').val(att.url);
                        $form.find('.ukt-el-cover-name').text(att.filename || att.title || getFileName(att.url));
                        $form.find('.ukt-el-cover-clear').show();
                        $form.find('.ukt-el-cover-preview').show().find('img').attr('src', previewUrl);
                    }
                );
            });

            $container.on('click', '.ukt-el-cover-clear', function(e) {
                e.preventDefault();
                const $form = $(this).closest('.ukt-el-entry-form-wrap');
                $form.find('.ukt-el-cover-id').val('');
                $form.find('.ukt-el-cover-url').val('');
                $form.find('.ukt-el-cover-name').text('');
                $(this).hide();
                $form.find('.ukt-el-cover-preview').hide().find('img').attr('src', '');
            });

            //this code for accept any type of files for the file in e-letters
            // $container.on('click', '.ukt-el-upload-file-btn', function(e) {
            //     e.preventDefault();
            //     const $form = $(this).closest('.ukt-el-entry-form-wrap');
                
            //     openMediaFrame(
            //         { title: 'Select E-Letter File', buttonText: 'Use This File' },
            //         function (att) {
            //             $form.find('.ukt-el-file-id').val(att.id);
            //             $form.find('.ukt-el-file-url').val(att.url);
            //             $form.find('.ukt-el-file-name').text(att.filename || att.title || getFileName(att.url));
            //         }
            //     );
            // });
        
            /* this code is for accepting only the pdf ... files in e-letters file.*/
             $container.on('click', '.ukt-el-upload-file-btn', function(e) {
                e.preventDefault();
                const $form = $(this).closest('.ukt-el-entry-form-wrap');
                
                // 1. Allowed MIME types for the library filter
                const allowedMimeTypes = [
                    'application/x-pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',       // .xlsx
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation' // .pptx
                ];

                openMediaFrame(
                    { 
                        title: 'Select E-Letter File', 
                        buttonText: 'Use This File',
                         // Filters the Media Library tab
                    }, 
                    function (att) {
                        // 2. Strict Validation upon selection
                        const fileName = att.filename || att.title || getFileName(att.url);
                        const fileExt = fileName.split('.').pop().toLowerCase();
                        const allowedExts = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
                        
                        // Check if the MIME type or extension is NOT in our allowed lists
                        // if (allowedMimeTypes.indexOf(att.mime) === -1 || allowedExts.indexOf(fileExt) === -1) {
                        //     alert('Invalid file type!\n\nPlease upload only PDF, Word (.doc/.docx), Excel (.xls/.xlsx), or PowerPoint (.ppt/.pptx) files.');
                        //     return; 
                        // }

                        // 3. If valid, populate the form
                        $form.find('.ukt-el-file-id').val(att.id);
                        $form.find('.ukt-el-file-url').val(att.url);
                        $form.find('.ukt-el-file-name').text(fileName);
                    }
                );
            });


            $container.on('click', '.ukt-el-save-entry', function(e) {
                e.preventDefault();
                
                const $form = $(this).closest('.ukt-el-entry-form-wrap');
                const $group = $(this).closest('.ukt-el-year-group');
                const year = $group.data('year');
                
                const title    = ($form.find('.ukt-el-entry-title').val() || '').trim();
                const coverId  = parseInt($form.find('.ukt-el-cover-id').val(), 10) || 0;
                const coverUrl = ($form.find('.ukt-el-cover-url').val() || '').trim();
                const fileId   = parseInt($form.find('.ukt-el-file-id').val(), 10) || 0;
                const fileUrl  = ($form.find('.ukt-el-file-url').val() || '').trim();
                const editIdx  = parseInt($form.data('edit-index'), 10);

                if (!title)    { alert('Please enter a title.'); return; }
                if (!fileUrl)  { alert('Please upload or select a file.'); return; }

                const entry = { 
                    title: title, 
                    cover_id: coverId, 
                    cover_url: coverUrl, 
                    file_id: fileId, 
                    file_url: fileUrl 
                };

                if (!Array.isArray(data[year])) data[year] = [];
                
                if (!isNaN(editIdx) && editIdx >= 0 && editIdx < data[year].length) {
                    data[year][editIdx] = entry;
                } else {
                    data[year].push(entry);
                }

                saveData();          // 1. Update the hidden textarea
                openYears.add(year); // 2. Keep accordion open
                render();            // 3. Re-render the UI
            });

            $container.on('click', '.ukt-el-edit-entry', function(e) {
                e.preventDefault();
                
                const $entry = $(this).closest('.ukt-el-entry');
                const idx = parseInt($entry.data('index'), 10);
                const $group = $(this).closest('.ukt-el-year-group');
                const year = $group.data('year');
                const entry = data[year][idx];
                
                const $form = $group.find('.ukt-el-entry-form-wrap');
                
                $form.data('edit-index', idx);
                $form.find('.ukt-el-form-title').text('Edit E-Letter');
                $form.find('.ukt-el-entry-title').val(entry.title || '');
                
                $form.find('.ukt-el-cover-id').val(entry.cover_id || '');
                $form.find('.ukt-el-cover-url').val(entry.cover_url || '');
                $form.find('.ukt-el-cover-name').text(entry.cover_url ? getFileName(entry.cover_url) : '');
                $form.find('.ukt-el-cover-clear').toggle(!!entry.cover_url);
                
                if (entry.cover_url) {
                    $form.find('.ukt-el-cover-preview').show().find('img').attr('src', entry.cover_url);
                } else {
                    $form.find('.ukt-el-cover-preview').hide().find('img').attr('src', '');
                }
                
                $form.find('.ukt-el-file-id').val(entry.file_id || '');
                $form.find('.ukt-el-file-url').val(entry.file_url || '');
                $form.find('.ukt-el-file-name').text(getFileName(entry.file_url));

                $form.slideDown(150, function() {
                    $('html, body').animate({
                        scrollTop: $form.offset().top - 50
                    }, 300);
                });
            });

            $container.on('click', '.ukt-el-remove-entry', function(e) {
                e.preventDefault();
                
                const $entry = $(this).closest('.ukt-el-entry');
                const idx = parseInt($entry.data('index'), 10);
                const $group = $(this).closest('.ukt-el-year-group');
                const year = $group.data('year');
                
                if (!confirm('Remove this E-Letter?')) return;
                
                data[year].splice(idx, 1);
                saveData();
                openYears.add(year);
                render();
            });

            // Add New Year
            $('#ukt-el-add-year-btn').on('click', function (e) {
                e.preventDefault();
                const year = String($('#ukt-el-new-year').val() || '').trim();
                
                if (!/^\d{4}$/.test(year)) {
                    alert('Please enter a valid 4-digit year (e.g. 2026).');
                    return;
                }
                if (data[year]) {
                    alert('The year ' + year + ' already exists.');
                    return;
                }
                
                data[year] = [];
                saveData();
                openYears.add(year);
                $('#ukt-el-new-year').val('');
                render();
            });

            $('#ukt-el-new-year').on('keydown', function (e) {
                if (e.key === 'Enter') { 
                    e.preventDefault(); 
                    $('#ukt-el-add-year-btn').trigger('click'); 
                }
            });

            // Fallback: Ensure data is saved if the user clicks WP's "Update" button
            $(document).on('submit', '#post', function() {
                saveData();
            });

            // Initial Render
            render();
        });
    })(jQuery);
    </script>
    <?php
}

// 4. SAVE HANDLER
add_action('save_post', function ($post_id) {
    if (!isset($_POST['ukt_e_letters_nonce'])) return;
    if (!wp_verify_nonce($_POST['ukt_e_letters_nonce'], 'ukt_e_letters_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_page', $post_id)) return;

    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'page') return;

    if (!isset($_POST['ukt_e_letters_data'])) return;

    $raw = wp_unslash($_POST['ukt_e_letters_data']);
    if (empty($raw)) {
        delete_post_meta($post_id, '_ukt_e_letters');
        return;
    }

    // Decode Base64
    $json = base64_decode($raw);
    if ($json === false) return;

    // Decode JSON
    $decoded = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
        // Data is corrupt, fail gracefully without deleting existing data
        return; 
    }

    $clean = [];
    foreach ($decoded as $year => $entries) {
        $year = sanitize_text_field((string) $year);
        if (!preg_match('/^\d{4}$/', $year)) continue;

        $clean_entries = [];
        if (is_array($entries)) {
            foreach ($entries as $entry) {
                if (!is_array($entry)) continue;

                $title     = isset($entry['title'])     ? sanitize_text_field($entry['title'])     : '';
                $cover_id  = isset($entry['cover_id'])  ? intval($entry['cover_id'])                : 0;
                $cover_url = isset($entry['cover_url']) ? esc_url_raw($entry['cover_url'])         : '';
                $file_id   = isset($entry['file_id'])   ? intval($entry['file_id'])                : 0;
                $file_url  = isset($entry['file_url'])  ? esc_url_raw($entry['file_url'])          : '';

                if ($title === '' && $file_url === '') continue;

                $clean_entries[] = [
                    'title'     => $title,
                    'cover_id'  => $cover_id,
                    'cover_url' => $cover_url,
                    'file_id'   => $file_id,
                    'file_url'  => $file_url,
                ];
            }
        }
        // if (!empty($clean_entries)) {
            $clean[$year] = $clean_entries;
        // }
    }

    uksort($clean, function ($a, $b) { return intval($b) - intval($a); });
    update_post_meta($post_id, '_ukt_e_letters', $clean);
});

// 5. FRONTEND HELPER
function ukt_get_e_letters($page_slug = 'e-letter') {
    $page = get_page_by_path($page_slug);
    if (!$page) return [];

    $data = get_post_meta($page->ID, '_ukt_e_letters', true);
    if (!is_array($data)) return [];

    uksort($data, function ($a, $b) { return intval($b) - intval($a); });
    return $data;
}


/**
 * ============================================================================
 * BOOKS & ARTICLES PAGE META BOX (Unrestricted Link Text)
 * ============================================================================
 */

// 1. REGISTER THE META BOX
add_action('add_meta_boxes', function ($post_type, $post) {
    if ($post_type !== 'page' || !$post) return;
    if ($post->post_name !== 'books-and-articles') return;

    add_meta_box(
        'ukt_ba_metabox',
        __('Books & Articles Manager', 'ukt'),
        'ukt_ba_metabox_render',
        'page',
        'normal',
        'high'
    );
}, 10, 2);

// 2. ENQUEUE WP MEDIA UPLOADER
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) return;
    if (empty($_GET['post'])) return;

    $post = get_post(intval($_GET['post']));
    if (!$post || $post->post_type !== 'page') return;
    if ($post->post_name !== 'books-and-articles') return;

    wp_enqueue_media();
});

// 3. META BOX RENDER
function ukt_ba_metabox_render($post) {
    wp_nonce_field('ukt_ba_save', 'ukt_ba_nonce');

    $books     = get_post_meta($post->ID, '_ukt_ba_books', true);
    $agnihotra = get_post_meta($post->ID, '_ukt_ba_agnihotra', true);
    $gifts     = get_post_meta($post->ID, '_ukt_ba_gifts', true);

    if (!is_array($books)) $books = [];
    if (!is_array($agnihotra)) $agnihotra = [];
    if (!is_array($gifts)) $gifts = [];

    $books_json = wp_json_encode($books);
    $agni_json  = wp_json_encode($agnihotra);
    $gifts_json = wp_json_encode($gifts);
    ?>
    <style>
        .ukt-ba-section { margin-bottom: 30px; padding: 20px; background: #fff; border: 1px solid #ccd0d4; border-radius: 6px; }
        .ukt-ba-section h3 { margin-top: 0; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee; color: #1d2327; }
        
        /* Books Repeater */
        .ukt-ba-book-row { display: flex; gap: 15px; align-items: center; background: #f9f9f9; padding: 10px; border: 1px solid #e5e5e5; border-radius: 4px; margin-bottom: 8px; }
        .ukt-ba-book-row .book-thumb { width: 40px; height: 55px; border-radius: 3px; object-fit: cover; background: #eee; border: 1px solid #ccc; flex-shrink: 0; }
        .ukt-ba-book-row .book-info { flex: 1; min-width: 0; }
        .ukt-ba-book-row .book-title { display: block; font-weight: 600; font-size: 14px; color: #1d2327; }
        .ukt-ba-book-row .book-author { display: block; font-size: 12px; color: #b57b23; font-style: italic; margin: 2px 0; }
        .ukt-ba-book-row .book-desc { display: block; font-size: 12px; color: #646970; margin-bottom: 4px; }
        .ukt-ba-book-row .book-link { display: block; font-size: 11px; color: #2271b1; word-break: break-all; margin-bottom: 4px; }
        .ukt-ba-book-row .book-pdf-badge { display: inline-block; font-size: 10px; font-weight: 600; color: #d63638; background: #fcf0f1; padding: 2px 6px; border-radius: 4px; border: 1px solid #d63638; }
        
        .ukt-ba-book-row .button-danger { color: #b32d2e; border-color: #b32d2e; }
        .ukt-ba-book-row .button-danger:hover { background: #fcf0f1; }
        
        .ukt-ba-book-form { background: #f1f1f1; padding: 15px; border-radius: 4px; border: 1px dashed #ccc; margin-top: 15px; display: none; }
        .ukt-ba-form-flex { display: flex; gap: 20px; margin-bottom: 15px; }
        .ukt-ba-form-cover { flex-shrink: 0; text-align: center; width: 100px; }
        .ukt-ba-cover-preview { width: 100px; height: 140px; border: 1px solid #ccc; border-radius: 4px; background: #fff; margin-top: 8px; display: none; overflow: hidden; }
        .ukt-ba-cover-preview img { width: 100%; height: 100%; object-fit: cover; }
        .ukt-ba-form-fields { flex: 1; display: flex; flex-direction: column; gap: 10px; }
        .ukt-ba-form-fields input, .ukt-ba-form-fields textarea { width: 100%; padding: 6px; }
        .ukt-ba-link-pdf-row { display: flex; gap: 10px; align-items: center; }
        .ukt-ba-pdf-status { font-size: 12px; color: #646970; margin-top: 4px; display: block; }

        /* Image Galleries */
        .ukt-ba-gallery { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; }
        .ukt-ba-img-item { position: relative; width: 100px; height: 100px; border-radius: 6px; overflow: hidden; border: 1px solid #ddd; background: #f1f1f1; }
        .ukt-ba-img-item img { width: 100%; height: 100%; object-fit: cover; }
        .ukt-ba-img-item .remove-img { position: absolute; top: 2px; right: 2px; background: rgba(255,0,0,0.8); color: #fff; border: none; border-radius: 50%; width: 22px; height: 22px; line-height: 20px; text-align: center; cursor: pointer; padding: 0; font-size: 14px; }
        .ukt-ba-img-item .remove-img:hover { background: red; }
        .ukt-ba-empty-text { color: #888; font-style: italic; margin-bottom: 15px; display: block; }
    </style>

    <div id="ukt-ba-manager">
        
        <!-- ==============================
             SECTION 1: BOOKS
        =============================== -->
        <div class="ukt-ba-section">
            <h3><i class="dashicons dashicons-book"></i> Books</h3>
            
            <div id="ukt-ba-books-list">
                <!-- JS renders rows here -->
            </div>
            <div class="ukt-ba-empty-text" id="ukt-ba-books-empty">No books added yet.</div>

            <button type="button" class="button button-primary" id="ukt-ba-add-book-btn">+ Add Book</button>

            <!-- Add/Edit Form -->
            <div class="ukt-ba-book-form" id="ukt-ba-book-form">
                <h4 style="margin-top:0;">Book Details</h4>
                
                <div class="ukt-ba-form-flex">
                    <!-- Cover Uploader -->
                    <div class="ukt-ba-form-cover">
                        <button type="button" class="button" id="ukt-ba-upload-cover-btn">Select Cover</button>
                        <input type="hidden" id="ukt-ba-book-cover-id">
                        <input type="hidden" id="ukt-ba-book-cover-url">
                        <div class="ukt-ba-cover-preview" id="ukt-ba-cover-preview">
                            <img src="" alt="Cover">
                        </div>
                    </div>
                    
                    <!-- Text Fields -->
                    <div class="ukt-ba-form-fields">
                        <input type="text" id="ukt-ba-book-title" placeholder="Book Title" class="widefat">
                        <input type="text" id="ukt-ba-book-author" placeholder="Author Name" class="widefat">
                        <textarea id="ukt-ba-book-desc" placeholder="Short Description (1-2 sentences)" class="widefat" rows="3"></textarea>
                        
                        <!-- Link & PDF Row -->
                        <div class="ukt-ba-link-pdf-row">
                            <input type="text" id="ukt-ba-book-link" placeholder="Purchase Link, Read Link, or Any Text" class="widefat" style="flex: 1;">
                            <button type="button" class="button" id="ukt-ba-upload-pdf-btn" style="white-space:nowrap;">Upload PDF <span style="font-size:10px; color:#888;">(Only .pdf)</span></button>
                            <button type="button" class="button" id="ukt-ba-clear-pdf-btn" style="display:none; color:#b32d2e; border-color:#b32d2e; white-space:nowrap;">Remove PDF</button>
                        </div>
                        <span class="ukt-ba-pdf-status" id="ukt-ba-pdf-name"></span>
                        <input type="hidden" id="ukt-ba-book-pdf-id">
                        <input type="hidden" id="ukt-ba-book-pdf-url">
                    </div>
                </div>

                <p style="margin-bottom:0;">
                    <button type="button" class="button button-primary" id="ukt-ba-save-book-btn">Save Book</button>
                    <button type="button" class="button" id="ukt-ba-cancel-book-btn">Cancel</button>
                </p>
            </div>

            <textarea name="ukt_ba_books_data" id="ukt-ba-books-data" style="display:none;"><?php echo esc_textarea($books_json); ?></textarea>
        </div>

        <!-- ==============================
             SECTION 2: AGNIHOTRA MATERIALS
        =============================== -->
        <div class="ukt-ba-section">
            <h3><i class="dashicons dashicons-format-gallery"></i> Agnihotra Materials</h3>
            <p class="description" style="margin-bottom:15px;">Upload multiple images of Agnihotra materials. (You can select multiple files at once).</p>
            
            <div class="ukt-ba-gallery" id="ukt-ba-agni-gallery"></div>
            <div class="ukt-ba-empty-text" id="ukt-ba-agni-empty">No images added yet.</div>
            <button type="button" class="button button-primary ukt-ba-upload-imgs-btn" data-target="agni">+ Add Images</button>

            <textarea name="ukt_ba_agnihotra_data" id="ukt-ba-agni-data" style="display:none;"><?php echo esc_textarea($agni_json); ?></textarea>
        </div>

        <!-- ==============================
             SECTION 3: GIFTS
        =============================== -->
        <div class="ukt-ba-section">
            <h3><i class="dashicons dashicons-heart"></i> Gifts</h3>
            <p class="description" style="margin-bottom:15px;">Upload multiple images of gifts. (You can select multiple files at once).</p>
            
            <div class="ukt-ba-gallery" id="ukt-ba-gifts-gallery"></div>
            <div class="ukt-ba-empty-text" id="ukt-ba-gifts-empty">No images added yet.</div>
            <button type="button" class="button button-primary ukt-ba-upload-imgs-btn" data-target="gifts">+ Add Images</button>

            <textarea name="ukt_ba_gifts_data" id="ukt-ba-gifts-data" style="display:none;"><?php echo esc_textarea($gifts_json); ?></textarea>
        </div>

    </div>

    <script>
    (function ($) {
        'use strict';
        $(function () {
            // ========================================================
            // 1. BOOKS REPEATER LOGIC
            // ========================================================
            let books = JSON.parse($('#ukt-ba-books-data').val()) || [];
            
            function saveBooksData() {
                $('#ukt-ba-books-data').val(JSON.stringify(books));
            }

            function renderBooks() {
                const $list = $('#ukt-ba-books-list');
                $list.empty();
                
                if (books.length === 0) {
                    $('#ukt-ba-books-empty').show();
                    return;
                }
                $('#ukt-ba-books-empty').hide();

                books.forEach((book, index) => {
                    const coverHtml = book.cover_url 
                        ? '<img src="' + book.cover_url + '" class="book-thumb" alt="Cover">' 
                        : '<div class="book-thumb"></div>';

                    const pdfHtml = book.pdf_url 
                        ? '<span class="book-pdf-badge"><i class="dashicons dashicons-pdf"></i> PDF Attached</span>' 
                        : '';

                    const row = $(
                        '<div class="ukt-ba-book-row">' +
                            coverHtml +
                            '<div class="book-info">' +
                                '<span class="book-title">' + escapeHtml(book.title) + '</span>' +
                                (book.author ? '<span class="book-author">By ' + escapeHtml(book.author) + '</span>' : '') +
                                (book.description ? '<span class="book-desc">' + escapeHtml(book.description) + '</span>' : '') +
                                (book.link ? '<span class="book-link">' + escapeHtml(book.link) + '</span>' : '') +
                                pdfHtml +
                            '</div>' +
                            '<button type="button" class="button ukt-ba-edit-book" data-idx="' + index + '">Edit</button>' +
                            '<button type="button" class="button button-danger ukt-ba-del-book" data-idx="' + index + '">Remove</button>' +
                        '</div>'
                    );
                    $list.append(row);
                });
            }

            // Add Book Btn (Reset all fields)
            $('#ukt-ba-add-book-btn').on('click', function() {
                $('#ukt-ba-book-title').val('');
                $('#ukt-ba-book-author').val('');
                $('#ukt-ba-book-desc').val('');
                $('#ukt-ba-book-link').val('');
                
                // Reset Cover
                $('#ukt-ba-book-cover-id').val('');
                $('#ukt-ba-book-cover-url').val('');
                $('#ukt-ba-cover-preview').hide().find('img').attr('src', '');
                
                // Reset PDF
                $('#ukt-ba-book-pdf-id').val('');
                $('#ukt-ba-book-pdf-url').val('');
                $('#ukt-ba-pdf-name').text('').hide();
                $('#ukt-ba-clear-pdf-btn').hide();
                
                $('#ukt-ba-book-form').data('edit-idx', -1).slideDown();
                $('#ukt-ba-book-title').focus();
            });

            // Cancel Book
            $('#ukt-ba-cancel-book-btn').on('click', function() {
                $('#ukt-ba-book-form').slideUp();
            });

            // Upload Cover
            $('#ukt-ba-upload-cover-btn').on('click', function(e) {
                e.preventDefault();
                const frame = wp.media({
                    title: 'Select Book Cover',
                    button: { text: 'Use This Cover' },
                    multiple: false,
                    library: { type: 'image' }
                });
                frame.on('select', function() {
                    const att = frame.state().get('selection').first().toJSON();
                    const previewUrl = att.sizes && att.sizes.medium ? att.sizes.medium.url : att.url;
                    
                    $('#ukt-ba-book-cover-id').val(att.id);
                    $('#ukt-ba-book-cover-url').val(att.url);
                    $('#ukt-ba-cover-preview').show().find('img').attr('src', previewUrl);
                });
                frame.open();
            });

            // Upload PDF
            $('#ukt-ba-upload-pdf-btn').on('click', function(e) {
                e.preventDefault();
                const frame = wp.media({
                    title: 'Select PDF File',
                    button: { text: 'Use This PDF' },
                    multiple: false,
                    library: { type: 'application/x-pdf' }
                });
                frame.on('select', function() {
                    const att = frame.state().get('selection').first().toJSON();
                    
                    // Validate PDF
                    const fileName = att.filename || att.title || att.url.split('/').pop();
                    const fileExt = fileName.split('.').pop().toLowerCase();
                    
                    if (att.mime !== 'application/x-pdf' || fileExt !== 'pdf') {
                        alert('Invalid file type! Please upload only PDF files.');
                        return;
                    }

                    $('#ukt-ba-book-pdf-id').val(att.id);
                    $('#ukt-ba-book-pdf-url').val(att.url);
                    $('#ukt-ba-pdf-name').text('Attached: ' + fileName).show();
                    $('#ukt-ba-clear-pdf-btn').show();
                    
                    // MUTUAL EXCLUSIVITY: Clear the text link
                    $('#ukt-ba-book-link').val('');
                });
                frame.open();
            });

            // Remove PDF
            $('#ukt-ba-clear-pdf-btn').on('click', function(e) {
                e.preventDefault();
                $('#ukt-ba-book-pdf-id').val('');
                $('#ukt-ba-book-pdf-url').val('');
                $('#ukt-ba-pdf-name').text('').hide();
                $(this).hide();
            });

            // Type in Link (Clears PDF)
            $('#ukt-ba-book-link').on('input', function() {
                if ($(this).val().trim().length > 0) {
                    // MUTUAL EXCLUSIVITY: Clear the PDF
                    $('#ukt-ba-book-pdf-id').val('');
                    $('#ukt-ba-book-pdf-url').val('');
                    $('#ukt-ba-pdf-name').text('').hide();
                    $('#ukt-ba-clear-pdf-btn').hide();
                }
            });

            // Save Book (Add/Update)
            $('#ukt-ba-save-book-btn').on('click', function() {
                const title = $('#ukt-ba-book-title').val().trim();
                const author = $('#ukt-ba-book-author').val().trim();
                const description = $('#ukt-ba-book-desc').val().trim();
                const link = $('#ukt-ba-book-link').val().trim(); // No strict validation here anymore
                
                const coverId = $('#ukt-ba-book-cover-id').val();
                const coverUrl = $('#ukt-ba-book-cover-url').val();
                
                const pdfId = $('#ukt-ba-book-pdf-id').val();
                const pdfUrl = $('#ukt-ba-book-pdf-url').val();
                
                const editIdx = $('#ukt-ba-book-form').data('edit-idx');

                // Require at least Title
                if (!title) {
                    alert('Please enter a Book Title.');
                    $('#ukt-ba-book-title').focus();
                    return;
                }

                // Require either a Link or a PDF
                if (!link && !pdfUrl) {
                    alert('Please enter a Purchase/Read Link (or any text) OR upload a PDF.');
                    return;
                }

                const newBook = { 
                    title: title, 
                    author: author,
                    description: description,
                    link: link,
                    cover_id: coverId,
                    cover_url: coverUrl,
                    pdf_id: pdfId,
                    pdf_url: pdfUrl
                };

                if (editIdx >= 0) {
                    books[editIdx] = newBook;
                } else {
                    books.push(newBook);
                }

                saveBooksData();
                renderBooks();
                $('#ukt-ba-book-form').slideUp();
            });

            // Edit Book
            $('#ukt-ba-books-list').on('click', '.ukt-ba-edit-book', function() {
                const idx = $(this).data('idx');
                const book = books[idx];
                
                $('#ukt-ba-book-title').val(book.title);
                $('#ukt-ba-book-author').val(book.author || '');
                $('#ukt-ba-book-desc').val(book.description || '');
                $('#ukt-ba-book-link').val(book.link || '');
                
                if (book.cover_url) {
                    $('#ukt-ba-book-cover-id').val(book.cover_id || '');
                    $('#ukt-ba-book-cover-url').val(book.cover_url);
                    $('#ukt-ba-cover-preview').show().find('img').attr('src', book.cover_url);
                } else {
                    $('#ukt-ba-book-cover-id').val('');
                    $('#ukt-ba-book-cover-url').val('');
                    $('#ukt-ba-cover-preview').hide().find('img').attr('src', '');
                }

                if (book.pdf_url) {
                    $('#ukt-ba-book-pdf-id').val(book.pdf_id || '');
                    $('#ukt-ba-book-pdf-url').val(book.pdf_url);
                    const pdfName = book.pdf_url.split('/').pop().split('?')[0];
                    $('#ukt-ba-pdf-name').text('Attached: ' + pdfName).show();
                    $('#ukt-ba-clear-pdf-btn').show();
                } else {
                    $('#ukt-ba-book-pdf-id').val('');
                    $('#ukt-ba-book-pdf-url').val('');
                    $('#ukt-ba-pdf-name').text('').hide();
                    $('#ukt-ba-clear-pdf-btn').hide();
                }

                $('#ukt-ba-book-form').data('edit-idx', idx).slideDown();
            });

            // Remove Book
            $('#ukt-ba-books-list').on('click', '.ukt-ba-del-book', function() {
                const idx = $(this).data('idx');
                if(confirm('Remove this book?')) {
                    books.splice(idx, 1);
                    saveBooksData();
                    renderBooks();
                }
            });

            renderBooks();


            // ========================================================
            // 2. IMAGE GALLERIES LOGIC (Agnihotra & Gifts)
            // ========================================================
            function setupGallery(target, dataFieldId, galleryId, emptyMsgId) {
                let images = JSON.parse($('#' + dataFieldId).val()) || [];
                const $gallery = $('#' + galleryId);

                function saveData() {
                    $('#' + dataFieldId).val(JSON.stringify(images));
                }

                function renderImages() {
                    $gallery.empty();
                    if (images.length === 0) {
                        $('#' + emptyMsgId).show();
                        return;
                    }
                    $('#' + emptyMsgId).hide();

                    images.forEach((img, idx) => {
                        const item = $(
                            '<div class="ukt-ba-img-item">' +
                                '<img src="' + img.url + '" alt="Image">' +
                                '<button type="button" class="remove-img" data-idx="' + idx + '" title="Remove">&times;</button>' +
                            '</div>'
                        );
                        $gallery.append(item);
                    });
                }

                $('.ukt-ba-upload-imgs-btn[data-target="' + target + '"]').on('click', function(e) {
                    e.preventDefault();
                    const frame = wp.media({
                        title: 'Select Images',
                        button: { text: 'Add to Gallery' },
                        multiple: true,
                        library: { type: 'image' }
                    });

                    frame.on('select', function() {
                        const selection = frame.state().get('selection');
                        selection.map(function(attachment) {
                            attachment = attachment.toJSON();
                            if (!images.some(i => i.id === attachment.id)) {
                                images.push({
                                    id: attachment.id,
                                    url: attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url
                                });
                            }
                        });
                        saveData();
                        renderImages();
                    });
                    frame.open();
                });

                $gallery.on('click', '.remove-img', function(e) {
                    e.preventDefault();
                    const idx = $(this).data('idx');
                    images.splice(idx, 1);
                    saveData();
                    renderImages();
                });

                renderImages();
            }

            setupGallery('agni', 'ukt-ba-agni-data', 'ukt-ba-agni-gallery', 'ukt-ba-agni-empty');
            setupGallery('gifts', 'ukt-ba-gifts-data', 'ukt-ba-gifts-gallery', 'ukt-ba-gifts-empty');

            // Helper
            function escapeHtml(str) {
                if (!str) return '';
                return String(str).replace(/[&<>"']/g, function (s) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[s];
                });
            }
            
            // ========================================================
            // 3. SYNC ON PAGE SUBMIT
            // ========================================================
            $(document).on('submit', '#post', function(e) {
                const $form = $('#ukt-ba-book-form');
                if ($form.is(':visible')) {
                    const title = $('#ukt-ba-book-title').val().trim();
                    if (title) {
                        $('#ukt-ba-save-book-btn').trigger('click');
                        
                        // If the form is STILL visible after the click, it means validation failed (e.g. no link and no PDF)
                        if ($form.is(':visible')) {
                            e.preventDefault();
                            return false;
                        }
                    }
                }
                saveBooksData();
            });
        });
    })(jQuery);
    </script>
    <?php
}

// 4. SAVE HANDLER (Sanitizes link as text, not strict URL)
add_action('save_post_page', function ($post_id) {
    if (!isset($_POST['ukt_ba_nonce'])) return;
    if (!wp_verify_nonce($_POST['ukt_ba_nonce'], 'ukt_ba_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_page', $post_id)) return;

    // 1. Save Books
    if (isset($_POST['ukt_ba_books_data'])) {
        $raw_books = wp_unslash($_POST['ukt_ba_books_data']);
        $books = json_decode($raw_books, true);
        
        $clean_books = [];
        if (is_array($books)) {
            foreach ($books as $book) {
                
                // Use sanitize_text_field instead of esc_url_raw to allow ANY text
                $link    = isset($book['link']) ? sanitize_text_field($book['link']) : '';
                
                $pdf_id  = isset($book['pdf_id']) ? intval($book['pdf_id']) : 0;
                $pdf_url = isset($book['pdf_url']) ? esc_url_raw($book['pdf_url']) : '';

                // ENFORCE MUTUAL EXCLUSIVITY
                if (!empty($link)) {
                    $pdf_id = 0;
                    $pdf_url = '';
                } elseif (!empty($pdf_url)) {
                    $link = '';
                }

                if (!empty($book['title']) || !empty($link) || !empty($pdf_url)) {
                    $clean_books[] = [
                        'title'       => sanitize_text_field($book['title']),
                        'author'      => isset($book['author']) ? sanitize_text_field($book['author']) : '',
                        'description' => isset($book['description']) ? sanitize_textarea_field($book['description']) : '',
                        'link'        => $link,
                        'cover_id'    => isset($book['cover_id']) ? intval($book['cover_id']) : 0,
                        'cover_url'   => isset($book['cover_url']) ? esc_url_raw($book['cover_url']) : '',
                        'pdf_id'      => $pdf_id,
                        'pdf_url'     => $pdf_url
                    ];
                }
            }
        }
        update_post_meta($post_id, '_ukt_ba_books', $clean_books);
    }

    // 2. Save Agnihotra Images
    if (isset($_POST['ukt_ba_agnihotra_data'])) {
        $raw_agni = wp_unslash($_POST['ukt_ba_agnihotra_data']);
        $agni = json_decode($raw_agni, true);
        $clean_agni = [];
        if (is_array($agni)) {
            foreach ($agni as $img) {
                if (isset($img['id']) && isset($img['url'])) {
                    $clean_agni[] = [
                        'id'  => intval($img['id']),
                        'url' => esc_url_raw($img['url'])
                    ];
                }
            }
        }
        update_post_meta($post_id, '_ukt_ba_agnihotra', $clean_agni);
    }

    // 3. Save Gifts Images
    if (isset($_POST['ukt_ba_gifts_data'])) {
        $raw_gifts = wp_unslash($_POST['ukt_ba_gifts_data']);
        $gifts = json_decode($raw_gifts, true);
        $clean_gifts = [];
        if (is_array($gifts)) {
            foreach ($gifts as $img) {
                if (isset($img['id']) && isset($img['url'])) {
                    $clean_gifts[] = [
                        'id'  => intval($img['id']),
                        'url' => esc_url_raw($img['url'])
                    ];
                }
            }
        }
        update_post_meta($post_id, '_ukt_ba_gifts', $clean_gifts);
    }
});

// 5. FRONTEND HELPER FUNCTIONS
function ukt_get_ba_books($page_slug = 'books-and-articles') {
    $page = get_page_by_path($page_slug);
    if (!$page) return [];
    return get_post_meta($page->ID, '_ukt_ba_books', true) ?: [];
}

function ukt_get_ba_agnihotra($page_slug = 'books-and-articles') {
    $page = get_page_by_path($page_slug);
    if (!$page) return [];
    return get_post_meta($page->ID, '_ukt_ba_agnihotra', true) ?: [];
}

function ukt_get_ba_gifts($page_slug = 'books-and-articles') {
    $page = get_page_by_path($page_slug);
    if (!$page) return [];
    return get_post_meta($page->ID, '_ukt_ba_gifts', true) ?: [];
}


/* =========================================================
   1. REGISTER 'REVIEW' CUSTOM POST TYPE
========================================================= */
add_action('init', 'ukt_register_review_cpt');
function ukt_register_review_cpt() {
    register_post_type('ukt_review', array(
        'labels' => array(
            'name'          => 'Reviews',
            'singular_name' => 'Review',
            'menu_name'     => 'Reviews',
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-star-filled',
        'supports'     => array('title', 'editor'), // Title = Name, Editor = Review Text
    ));
}

/* =========================================================
   2. HANDLE AJAX FORM SUBMISSION
========================================================= */
add_action('wp_ajax_submit_ukt_review', 'ukt_handle_review_submission');
add_action('wp_ajax_nopriv_submit_ukt_review', 'ukt_handle_review_submission');

function ukt_handle_review_submission() {
    // Security check
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ukt_review_nonce')) {
        wp_send_json_error(array('message' => 'Security check failed.'));
    }

    // Sanitize inputs
    $name     = sanitize_text_field($_POST['name']);
    $email    = sanitize_email($_POST['email']);
    $phone    = sanitize_text_field($_POST['phone']);
    $healer   = sanitize_text_field($_POST['healer']);
    $program  = sanitize_text_field($_POST['program']);
    $rating   = intval($_POST['rating']);
    $review   = sanitize_textarea_field($_POST['review']);

    if (empty($name) || empty($review)) {
        wp_send_json_error(array('message' => 'Name and Review are required.'));
    }

    // Create the new Review Post
    $post_id = wp_insert_post(array(
        'post_type'    => 'ukt_review',
        'post_status'  => 'publish',
        'post_title'   => $name,
        'post_content' => $review,
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => 'Failed to save review.'));
    }

    // Save the meta data
    update_post_meta($post_id, '_ukt_email', $email);
    update_post_meta($post_id, '_ukt_phone', $phone);
    update_post_meta($post_id, '_ukt_healer', $healer);
    update_post_meta($post_id, '_ukt_program', $program);
    update_post_meta($post_id, '_ukt_rating', $rating);

    // Return the data back to JavaScript to create the card dynamically
    wp_send_json_success(array(
        'name'    => $name,
        'healer'  => $healer,
        'program' => $program,
        'rating'  => $rating,
        'review'  => $review,
        'date'    => date('M d, Y') // Format matching your static HTML
    ));
}


/* End of review custom post */

// =========================================================
// 1. REGISTER TESTIMONIAL CUSTOM POST TYPE
// =========================================================
add_action('init', 'ukt_register_testimonial_cpt');
function ukt_register_testimonial_cpt() {
    register_post_type('ukt_testimonial', [
        'labels' => [
            'name'          => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new'       => 'Add New',
            'add_new_item'  => 'Add New Testimonial',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'supports'     => ['title', 'editor'],
        'menu_icon'    => 'dashicons-testimonial',
    ]);
}

// =========================================================
// 2. HANDLE AJAX FORM SUBMISSION (PROGRAM TESTIMONIALS)
// =========================================================
// Note: Renamed to prevent conflict with the other review function!
add_action('wp_ajax_submit_program_review', 'ukt_handle_program_testimonial_submission');
add_action('wp_ajax_nopriv_submit_program_review', 'ukt_handle_program_testimonial_submission');

// =========================================================
// 2. HANDLE AJAX FORM SUBMISSION (PROGRAM TESTIMONIALS)
// =========================================================
add_action('wp_ajax_submit_program_review', 'ukt_handle_program_testimonial_submission');
add_action('wp_ajax_nopriv_submit_program_review', 'ukt_handle_program_testimonial_submission');

function ukt_handle_program_testimonial_submission() {
    // Verify Nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ukt_review_nonce')) {
        wp_send_json_error(['message' => 'Security check failed. Please refresh and try again.']);
    }

    // Sanitize inputs based on static HTML form fields
    $title   = sanitize_text_field($_POST['title'] ?? '');
    $content = sanitize_textarea_field($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        wp_send_json_error(['message' => 'Please fill in both the Title and Content fields.']);
    }

    // Insert into Custom Post Type
    $post_id = wp_insert_post([
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'ukt_testimonial',
    ]);

    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'Failed to save testimonial. Please try again.']);
    }

    // Format current date
    $date_str = date('F j, Y');

    // Generate exact HTML matching the static design
    ob_start();
    ?>
    <div class="col-lg-4 col-md-6 col-12 ukt-review-col" id="review-<?php echo esc_attr($post_id); ?>">
        <div class="ukt-reference-review-card ukt-highlight-new-card">
            <h4 class="ukt-reference-review-title">
                "<?php echo esc_html($title); ?>"
            </h4>
            <div class="ukt-reference-review-body">
                <p><?php echo nl2br(esc_html($content)); ?></p>
            </div>
            <div class="ukt-reference-review-date">
                <i class="bi bi-calendar3 me-1"></i> <?php echo esc_html($date_str); ?>
            </div>
        </div>
    </div>
    <?php
    $html = ob_get_clean();

    wp_send_json_success(['html' => $html]);
}

/* End Testimonial */


/* Begin Video Testimonials */
/*
// 1. Add Meta Box
function el_add_meta_box() {
    add_meta_box(
        'video_section_manager',
        'Video Section Manager',
        'el_meta_box_html',
        'page', 
        'normal',
        'high'
    );
}*/

add_action( 'add_meta_boxes', function($post_type, $post){
    if ($post_type !== 'page' || !$post) return;
    if ($post->post_name !== 'video-testimonials') return;
    add_meta_box(
        'video_section_manager',
        'Video Section Manager',
        'el_meta_box_html',
        'page', 
        'normal',
        'high'
    );

},10, 2);

// 2. Render Meta Box HTML
function el_meta_box_html( $post ) {
    
    $data = get_post_meta( $post->ID, '_el_video_sections_data', true );
    if ( ! is_array( $data ) ) {
        $data = array();
    } else {
        // Sort sections by year in descending order (latest year first)
        usort($data, function($a, $b) {
            $yearA = isset($a['year']) ? (int)$a['year'] : 0;
            $yearB = isset($b['year']) ? (int)$b['year'] : 0;
            return $yearB <=> $yearA; 
        });
    }

    wp_nonce_field( 'el_save_video_sections', 'el_video_sections_nonce' );
    ?>

    <style>
        .el-manager-wrap { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
        .el-desc { color: #50575e; margin-bottom: 20px; font-size: 13px; }
        
        /* Top Add Section Bar */
        .el-add-section-bar { display: flex; align-items: center; gap: 15px; padding-bottom: 20px; margin-bottom: 20px; flex-wrap: wrap; }
        .el-add-section-bar label { font-weight: 600; font-size: 13px; color: #1d2327; }
        .el-add-section-bar input[type="text"], .el-add-section-bar input[type="number"] { padding: 4px 8px; border: 1px solid #8c8f94; border-radius: 3px; }
        .el-add-section-bar input[type="text"] { width: 220px; }
        .el-add-section-bar input[type="number"] { width: 100px; }
        .el-btn-primary { background: #2271b1; color: #fff; border: 1px solid #2271b1; padding: 4px 12px; border-radius: 3px; cursor: pointer; font-weight: 500; font-size: 13px; margin-left: auto; }
        .el-btn-primary:hover { background: #135e96; border-color: #135e96; }

        /* Accordion Groups */
        .el-section-group { border: 1px solid #c3c4c7; border-radius: 4px; margin-bottom: 15px; background: #fff; overflow: hidden; }
        .el-section-header { display: flex; justify-content: space-between; align-items: center; background: #f6f7f7; padding: 12px 15px; cursor: pointer; user-select: none; border-bottom: 1px solid #c3c4c7; transition: background 0.2s; }
        .el-section-header:hover { background: #f0f0f1; }
        .el-section-group.collapsed .el-section-header { border-bottom-color: transparent; }
        
        .el-section-title-wrap { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; color: #1d2327; }
        
        /* Arrow Icon */
        .el-arrow { width: 0; height: 0; border-left: 5px solid transparent; border-right: 5px solid transparent; border-top: 6px solid #1d2327; transition: transform 0.3s; }
        .el-section-group.collapsed .el-arrow { transform: rotate(-90deg); }

        /* Delete Buttons */
        .el-btn-delete-section { background: transparent; color: #d63638; border: 1px solid #d63638; padding: 4px 12px; border-radius: 3px; cursor: pointer; font-size: 13px; font-weight: 500; }
        .el-btn-delete-section:hover { background: #fcf0f1; border-color: #b32d2e; color: #b32d2e; }
        .el-btn-remove-video { background: #d63638; color: #fff; border: none; border-radius: 3px; padding: 6px 10px; cursor: pointer; align-self: flex-end; margin-bottom: 1px; }

        /* Body & Fields */
        .el-section-body { padding: 20px; display: block; }
        .el-section-group.collapsed .el-section-body { display: none; }
        .el-field-row { display: flex; gap: 15px; margin-bottom: 15px; align-items: flex-end; }
        .el-field { flex: 1; }
        .el-field label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 13px; color: #1d2327; }
        .el-field input[type="text"], .el-field input[type="number"], .el-field textarea { width: 100%; padding: 6px 10px; border: 1px solid #8c8f94; border-radius: 3px; box-sizing: border-box; }
        .el-field textarea { resize: vertical; min-height: 70px; }
        
        /* Video Rows Container */
        .el-video-rows { background: #f9f9f9; border: 1px solid #e2e4e7; padding: 15px; border-radius: 4px; margin-top: 15px; }
        .el-video-rows:empty { display: none; /* Hide background if empty */ }
        .el-add-video-btn { background: #00a32a; color: #fff; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; font-size: 13px; margin-top: 10px; font-weight: 500; }
        .el-add-video-btn:hover { background: #008a20; }
    </style>

    <div class="el-manager-wrap" id="el-manager">
        <p class="el-desc">Manage Video Sections grouped by year. Click any section header to expand or collapse it. Changes are saved when you click Update on the page.</p>

        <!-- Add New Section Bar -->
        <div class="el-add-section-bar">
            <label for="el-new-title">Section Name:</label>
            <input type="text" id="el-new-title" placeholder="e.g. Inner Growth">
            
            <label for="el-new-year">Year:</label>
            <input type="number" id="el-new-year" placeholder="e.g. 2026" min="1900" max="2100">
            
            <button type="button" class="el-btn-primary" id="el-add-section-btn">Add Section</button>
        </div>

        <hr style="border: 0; border-top: 1px solid #dcdcde; margin: 0 0 20px 0;">

        <!-- Sections Container -->
        <div id="el-sections-container">
            <?php 
            // Render existing sections
            if ( ! empty( $data ) ) {
                foreach ( $data as $sec_index => $section ) {
                    $sec_title = isset( $section['title'] ) ? esc_attr( $section['title'] ) : '';
                    $sec_year = isset( $section['year'] ) ? esc_attr( $section['year'] ) : '';
                    $sec_desc = isset( $section['description'] ) ? esc_textarea( $section['description'] ) : '';
                    $videos = isset( $section['videos'] ) && is_array( $section['videos'] ) ? $section['videos'] : array();
                    ?>
                    <div class="el-section-group collapsed" data-index="<?php echo esc_attr( $sec_index ); ?>" data-year="<?php echo $sec_year; ?>">
                        <div class="el-section-header">
                            <div class="el-section-title-wrap">
                                <span class="el-arrow"></span>
                                <span class="el-section-display-title"><?php echo esc_html( $sec_title . ($sec_year ? ' (' . $sec_year . ')' : '') ); ?></span>
                            </div>
                            <button type="button" class="el-btn-delete-section">Delete Section</button>
                        </div>
                        <div class="el-section-body">
                            
                            <!-- Section Title & Year Fields -->
                            <div class="el-field-row">
                                <div class="el-field">
                                    <label>Section Title *</label>
                                    <input type="text" class="el-input-section-title" name="el_data[<?php echo esc_attr( $sec_index ); ?>][title]" value="<?php echo $sec_title; ?>" required>
                                </div>
                                <div class="el-field">
                                    <label>Year *</label>
                                    <input type="number" class="el-input-section-year" name="el_data[<?php echo esc_attr( $sec_index ); ?>][year]" value="<?php echo $sec_year; ?>" required min="1900" max="2100">
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="el-field-row">
                                <div class="el-field">
                                    <label>Description</label>
                                    <textarea name="el_data[<?php echo esc_attr( $sec_index ); ?>][description]"><?php echo $sec_desc; ?></textarea>
                                </div>
                            </div>

                            <!-- Video Rows Container -->
                            <div class="el-video-rows" data-sec-id="<?php echo esc_attr( $sec_index ); ?>">
                                <?php 
                                if ( ! empty( $videos ) ) {
                                    foreach ( $videos as $vid_index => $video ) {
                                        $v_title = isset( $video['title'] ) ? esc_attr( $video['title'] ) : '';
                                        $v_url = isset( $video['url'] ) ? esc_attr( $video['url'] ) : '';
                                        ?>
                                        <div class="el-field-row el-video-item">
                                            <div class="el-field">
                                                <label>Video Title *</label>
                                                <input type="text" name="el_data[<?php echo esc_attr( $sec_index ); ?>][videos][<?php echo esc_attr( $vid_index ); ?>][title]" value="<?php echo $v_title; ?>" required>
                                            </div>
                                            <div class="el-field">
                                                <label>Video URL *</label>
                                                <input type="text" name="el_data[<?php echo esc_attr( $sec_index ); ?>][videos][<?php echo esc_attr( $vid_index ); ?>][url]" value="<?php echo $v_url; ?>" required>
                                            </div>
                                            <button type="button" class="el-btn-remove-video">Remove</button>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            
                            <button type="button" class="el-add-video-btn">+ Add Video</button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('el-sections-container');
            const addSecBtn = document.getElementById('el-add-section-btn');
            const titleInput = document.getElementById('el-new-title');
            const yearInput = document.getElementById('el-new-year');
            
            let sectionIndex = <?php echo count($data); ?>;

            // Toggle Accordion
            container.addEventListener('click', function(e) {
                const header = e.target.closest('.el-section-header');
                if (header && !e.target.classList.contains('el-btn-delete-section')) {
                    header.closest('.el-section-group').classList.toggle('collapsed');
                }
            });

            // Live update header title while typing inside the body
            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('el-input-section-title') || e.target.classList.contains('el-input-section-year')) {
                    const group = e.target.closest('.el-section-group');
                    const t = group.querySelector('.el-input-section-title').value || 'Untitled Section';
                    const y = group.querySelector('.el-input-section-year').value;
                    group.querySelector('.el-section-display-title').textContent = t + (y ? ' (' + y + ')' : '');
                }
            });

            // Add Section Logic
            addSecBtn.addEventListener('click', function() {
                const title = titleInput.value.trim();
                const year = yearInput.value.trim();
                
                if (!title) {
                    alert('Please enter a Section Name.');
                    titleInput.focus();
                    return;
                }
                if (!year || year < 1900 || year > 2100) {
                    alert('Please enter a valid 4-digit Year.');
                    yearInput.focus();
                    return;
                }

                const html = `
                <div class="el-section-group collapsed" data-index="${sectionIndex}" data-year="${year}">
                    <div class="el-section-header">
                        <div class="el-section-title-wrap">
                            <span class="el-arrow"></span>
                            <span class="el-section-display-title">${title} (${year})</span>
                        </div>
                        <button type="button" class="el-btn-delete-section">Delete Section</button>
                    </div>
                    <div class="el-section-body">
                        <div class="el-field-row">
                            <div class="el-field">
                                <label>Section Title *</label>
                                <input type="text" class="el-input-section-title" name="el_data[${sectionIndex}][title]" value="${title}" required>
                            </div>
                            <div class="el-field">
                                <label>Year *</label>
                                <input type="number" class="el-input-section-year" name="el_data[${sectionIndex}][year]" value="${year}" required min="1900" max="2100">
                            </div>
                        </div>
                        
                        <!-- New Description Field -->
                        <div class="el-field-row">
                            <div class="el-field">
                                <label>Description</label>
                                <textarea name="el_data[${sectionIndex}][description]"></textarea>
                            </div>
                        </div>

                        <div class="el-video-rows" data-sec-id="${sectionIndex}"></div>
                        <button type="button" class="el-add-video-btn">+ Add Video</button>
                    </div>
                </div>`;

                // Add to the top
                container.insertAdjacentHTML('afterbegin', html);
                
                titleInput.value = ''; 
                yearInput.value = '';
                sectionIndex++;
            });

            // Delete Section
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('el-btn-delete-section')) {
                    if (confirm('Are you sure you want to delete this entire section?')) {
                        e.target.closest('.el-section-group').remove();
                    }
                }
            });

            // Add Video Row
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('el-add-video-btn')) {
                    const body = e.target.closest('.el-section-body');
                    const videoContainer = body.querySelector('.el-video-rows');
                    const secId = videoContainer.getAttribute('data-sec-id');
                    const vidCount = videoContainer.querySelectorAll('.el-video-item').length;

                    const html = `
                    <div class="el-field-row el-video-item">
                        <div class="el-field">
                            <label>Video Title *</label>
                            <input type="text" name="el_data[${secId}][videos][${vidCount}][title]" value="" required>
                        </div>
                        <div class="el-field">
                            <label>Video URL *</label>
                            <input type="text" name="el_data[${secId}][videos][${vidCount}][url]" value="" required>
                        </div>
                        <button type="button" class="el-btn-remove-video">Remove</button>
                    </div>`;
                    
                    videoContainer.insertAdjacentHTML('beforeend', html);
                }
            });

            // Remove Video Row
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('el-btn-remove-video')) {
                    e.target.closest('.el-video-item').remove();
                }
            });
        });
    </script>
    <?php
}

// 3. Save Meta Box Data
function el_save_video_sections_meta( $post_id ) {
    if ( ! isset( $_POST['el_video_sections_nonce'] ) || ! wp_verify_nonce( $_POST['el_video_sections_nonce'], 'el_save_video_sections' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    $saved_data = array();

    if ( isset( $_POST['el_data'] ) && is_array( $_POST['el_data'] ) ) {
        foreach ( $_POST['el_data'] as $section ) {
            
            $clean_title = isset( $section['title'] ) ? sanitize_text_field( $section['title'] ) : '';
            $clean_year = isset( $section['year'] ) ? sanitize_text_field( $section['year'] ) : '';
            $clean_desc = isset( $section['description'] ) ? sanitize_textarea_field( $section['description'] ) : '';
            
            if ( empty( $clean_title ) || empty( $clean_year ) ) {
                continue;
            }

            $clean_videos = array();
            if ( isset( $section['videos'] ) && is_array( $section['videos'] ) ) {
                foreach ( $section['videos'] as $video ) {
                    $v_title = isset( $video['title'] ) ? sanitize_text_field( $video['title'] ) : '';
                    $v_url = isset( $video['url'] ) ? sanitize_text_field( $video['url'] ) : '';
                    
                    if ( ! empty( $v_title ) && ! empty( $v_url ) ) {
                        $clean_videos[] = array(
                            'title' => $v_title,
                            'url'   => $v_url
                        );
                    }
                }
            }

            $saved_data[] = array(
                'title'       => $clean_title,
                'year'        => $clean_year,
                'description' => $clean_desc,
                'videos'      => $clean_videos
            );
        }
    }

    update_post_meta( $post_id, '_el_video_sections_data', $saved_data );
}
add_action( 'save_post_page', 'el_save_video_sections_meta' );

// 4. Frontend Data Helper
function el_get_video_sections_data( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( ! $post_id ) return array();
    
    $data = get_post_meta( $post_id, '_el_video_sections_data', true );
    
    if ( ! is_array( $data ) ) {
        return array();
    }

    // Sort sections by year in descending order on the frontend as well
    usort($data, function($a, $b) {
        $yearA = isset($a['year']) ? (int)$a['year'] : 0;
        $yearB = isset($b['year']) ? (int)$b['year'] : 0;
        return $yearB <=> $yearA;
    });

    return $data;
}

// Extract youtube link
function ukt_get_youtube_thumbnail($url, $quality = 'maxresdefault') {
    $video_id = '';
    
    // Extract the 11-character video ID using Regex
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
        $video_id = $match[1];
    }
    
    // If a valid ID was found, return the thumbnail URL
    if ($video_id) {
        return $video_id;
        // return "https://img.youtube.com/vi/" . $video_id . "/" . $quality . ".jpg";
    }
    
    return false; // Return false if no valid ID found
}


/* End Video Testimonials */


/* Begin Universal Talk */

// 1. Add Meta Box
function ut_add_featured_videos_meta_box() {
    global $post;

    // Only add if the page slug is 'universal-talk'
    if ( $post && get_post_field( 'post_name', $post->ID ) === 'universal-talk' ) {
        add_meta_box(
            'ut_featured_videos',
            'Featured Videos',
            'ut_featured_videos_meta_box_html',
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'ut_add_featured_videos_meta_box' );

// 2. Render Meta Box HTML & JS
function ut_featured_videos_meta_box_html( $post ) {
    $data = get_post_meta( $post->ID, '_ut_featured_videos_data', true );
    if ( ! is_array( $data ) ) {
        $data = array();
    }

    wp_nonce_field( 'ut_save_featured_videos', 'ut_featured_videos_nonce' );
    ?>

    <style>
        .ut-video-row { display: flex; flex-wrap: wrap; gap: 15px; background: #f9f9f9; padding: 15px; border: 1px solid #e2e4e7; margin-bottom: 15px; border-radius: 4px; position: relative; }
        .ut-field { display: flex; flex-direction: column; }
        .ut-field label { font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1d2327; }
        .ut-field input[type="text"], .ut-field textarea { width: 100%; padding: 8px; border: 1px solid #8c8f94; border-radius: 3px; box-sizing: border-box; }
        .ut-field textarea { resize: vertical; min-height: 60px; }
        
        .ut-col-half { flex: 1; min-width: 200px; }
        .ut-col-full { width: 100%; }
        
        .ut-btn { cursor: pointer; padding: 8px 16px; border: none; border-radius: 3px; font-weight: 600; font-size: 13px; text-decoration: none; display: inline-block; }
        .ut-btn-add { background: #2271b1; color: #fff; width: 100%; text-align: center; margin-top: 10px; font-size: 14px; padding: 12px; }
        .ut-btn-add:hover { background: #135e96; }
        .ut-btn-remove { background: #d63638; color: #fff; align-self: flex-end; margin-bottom: 1px; padding: 6px 12px; }
        .ut-btn-remove:hover { background: #b32d2e; }
    </style>

    <div id="ut-videos-container">
        <?php 
        $index = 0;
        if ( ! empty( $data ) ) {
            foreach ( $data as $video ) {
                ut_render_admin_video_row( $index, $video );
                $index++;
            }
        }
        ?>
    </div>

    <button type="button" class="ut-btn ut-btn-add" id="ut-add-video-btn">+ Add Featured Video</button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let videoIndex = <?php echo $index; ?>;
            const container = document.getElementById('ut-videos-container');
            const addBtn = document.getElementById('ut-add-video-btn');

            addBtn.addEventListener('click', function() {
                const html = `
                <div class="ut-video-row">
                    <button type="button" class="ut-btn ut-btn-remove ut-remove-btn">Remove</button>
                    
                    <div class="ut-field ut-col-half">
                        <label>Video Title *</label>
                        <input type="text" name="ut_videos[${videoIndex}][title]" required>
                    </div>
                    <div class="ut-field ut-col-half">
                        <label>Video Link *</label>
                        <input type="text" name="ut_videos[${videoIndex}][link]" required>
                    </div>
                    
                    <div class="ut-field ut-col-half">
                        <label>Author Name</label>
                        <input type="text" name="ut_videos[${videoIndex}][author]">
                    </div>
                    <div class="ut-field ut-col-half">
                        <label>Tag Name (e.g. introduction)</label>
                        <input type="text" name="ut_videos[${videoIndex}][tag]">
                    </div>
                    
                    <div class="ut-field ut-col-full">
                        <label>Description</label>
                        <textarea name="ut_videos[${videoIndex}][description]" rows="3"></textarea>
                    </div>
                </div>`;
                
                container.insertAdjacentHTML('beforeend', html);
                videoIndex++;
            });

            // Remove Video Row
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('ut-remove-btn')) {
                    if (confirm('Are you sure you want to remove this video?')) {
                        e.target.closest('.ut-video-row').remove();
                    }
                }
            });
        });
    </script>
    <?php
}

// Helper function to render existing row in PHP
function ut_render_admin_video_row( $index, $video ) {
    $title = isset( $video['title'] ) ? esc_attr( $video['title'] ) : '';
    $link = isset( $video['link'] ) ? esc_attr( $video['link'] ) : '';
    $author = isset( $video['author'] ) ? esc_attr( $video['author'] ) : '';
    $tag = isset( $video['tag'] ) ? esc_attr( $video['tag'] ) : '';
    $desc = isset( $video['description'] ) ? esc_textarea( $video['description'] ) : '';
    ?>
    <div class="ut-video-row">
        <button type="button" class="ut-btn ut-btn-remove ut-remove-btn">Remove</button>
        
        <div class="ut-field ut-col-half">
            <label>Video Title *</label>
            <input type="text" name="ut_videos[<?php echo $index; ?>][title]" value="<?php echo $title; ?>" required>
        </div>
        <div class="ut-field ut-col-half">
            <label>Video Link *</label>
            <input type="text" name="ut_videos[<?php echo $index; ?>][link]" value="<?php echo $link; ?>" required>
        </div>
        
        <div class="ut-field ut-col-half">
            <label>Author Name</label>
            <input type="text" name="ut_videos[<?php echo $index; ?>][author]" value="<?php echo $author; ?>">
        </div>
        <div class="ut-field ut-col-half">
            <label>Tag Name (e.g. introduction)</label>
            <input type="text" name="ut_videos[<?php echo $index; ?>][tag]" value="<?php echo $tag; ?>">
        </div>
        
        <div class="ut-field ut-col-full">
            <label>Description</label>
            <textarea name="ut_videos[<?php echo $index; ?>][description]" rows="3"><?php echo $desc; ?></textarea>
        </div>
    </div>
    <?php
}

// 3. Save Meta Box Data
function ut_save_featured_videos_meta( $post_id ) {
    if ( ! isset( $_POST['ut_featured_videos_nonce'] ) || ! wp_verify_nonce( $_POST['ut_featured_videos_nonce'], 'ut_save_featured_videos' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    $saved_data = array();

    if ( isset( $_POST['ut_videos'] ) && is_array( $_POST['ut_videos'] ) ) {
        foreach ( $_POST['ut_videos'] as $video ) {
            
            $clean_title = isset( $video['title'] ) ? sanitize_text_field( $video['title'] ) : '';
            $clean_link = isset( $video['link'] ) ? sanitize_text_field( $video['link'] ) : '';
            
            // Skip if title and link are empty
            if ( empty( $clean_title ) || empty( $clean_link ) ) {
                continue;
            }

            $saved_data[] = array(
                'title'       => $clean_title,
                'link'        => $clean_link,
                'author'      => isset( $video['author'] ) ? sanitize_text_field( $video['author'] ) : '',
                'tag'         => isset( $video['tag'] ) ? sanitize_text_field( $video['tag'] ) : '',
                'description' => isset( $video['description'] ) ? sanitize_textarea_field( $video['description'] ) : '',
            );
        }
    }

    update_post_meta( $post_id, '_ut_featured_videos_data', $saved_data );
}
add_action( 'save_post_page', 'ut_save_featured_videos_meta' );

// Trim by letters function for tag
function trim_by_letters($text, $limit = 30) {
    // Strip HTML tags first (optional, but good for descriptions)
    $text = strip_tags($text); 
    
    // Check if the text is longer than the limit
    if (mb_strlen($text, 'UTF-8') > $limit) {
        // Trim to limit and add ...
        return mb_substr($text, 0, $limit, 'UTF-8') . '...';
    }
    
    return $text;
}

// 4. Frontend Data Helper Function
function ut_get_featured_videos( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( ! $post_id ) {
        return array();
    }

    $data = get_post_meta( $post_id, '_ut_featured_videos_data', true );
    
    if ( ! is_array( $data ) ) {
        return array();
    }

    return $data;
}

/* End of Universal Talk */



/* Begin Downloads for school training programs */


// 1. Add Meta Box
function ds_add_materials_meta_box() {
    global $post;

    // Only add if the page slug is 'downloads-for-school-training-programs'
    if ( $post && get_post_field( 'post_name', $post->ID ) === 'downloads-for-school-training-programs' ) {
        add_meta_box(
            'ds_downloadable_materials',
            'Add Downloadable materials',
            'ds_materials_meta_box_html',
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'ds_add_materials_meta_box' );

// 2. Render Meta Box HTML & JS
function ds_materials_meta_box_html( $post ) {
    wp_enqueue_media();

    // Get existing data
    $files_data = get_post_meta( $post->ID, '_ds_downloadable_materials', true );
    if ( ! is_array( $files_data ) ) $files_data = array();

    $audio_data = get_post_meta( $post->ID, '_ds_downloadable_audios', true );
    if ( ! is_array( $audio_data ) ) $audio_data = array();

    $video_data = get_post_meta( $post->ID, '_ds_daily_practice_videos', true );
    if ( ! is_array( $video_data ) ) $video_data = array();

    wp_nonce_field( 'ds_save_materials', 'ds_materials_nonce' );
    ?>

    <style>
        .ds-accordion { border: 1px solid #c3c4c7; border-radius: 4px; margin-bottom: 15px; background: #fff; }
        .ds-accordion-header { display: flex; justify-content: space-between; align-items: center; background: #f6f7f7; padding: 12px 15px; cursor: pointer; user-select: none; border-radius: 4px; font-weight: 600; font-size: 14px; color: #1d2327; transition: background 0.2s; }
        .ds-accordion-header:hover { background: #f0f0f1; }
        .ds-accordion.open .ds-accordion-header { border-bottom: 1px solid #c3c4c7; border-radius: 4px 4px 0 0; }
        
        .ds-arrow { width: 0; height: 0; border-left: 5px solid transparent; border-right: 5px solid transparent; border-top: 6px solid #1d2327; transition: transform 0.3s; }
        .ds-accordion.open .ds-arrow { transform: rotate(180deg); }

        .ds-accordion-body { display: none; padding: 20px; }
        .ds-accordion.open .ds-accordion-body { display: block; }

        .ds-row { display: flex; flex-wrap: wrap; gap: 15px; background: #f9f9f9; padding: 15px; border: 1px solid #e2e4e7; margin-bottom: 15px; border-radius: 4px; position: relative; align-items: flex-end; }
        
        .ds-field { display: flex; flex-direction: column; min-width: 150px; }
        .ds-field label { font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1d2327; }
        .ds-field input[type="text"] { width: 100%; padding: 6px 10px; border: 1px solid #8c8f94; border-radius: 3px; box-sizing: border-box; height: 35px; }
        
        /* Field Widths */
        .ds-field-title { flex: 2; }
        .ds-field-file { flex: 2; }
        .ds-field-tagline { flex: 1; }
        
        .ds-field-audio-title { flex: 1; }
        .ds-field-audio-file { flex: 1; }
        
        .ds-field-video-title { flex: 1; }
        .ds-field-video-url { flex: 1; }
        
        /* File Upload specific styles */
        .ds-upload-wrap { display: flex; gap: 8px; }
        .ds-upload-wrap input[type="text"] { flex: 1; background: #f0f0f1; cursor: not-allowed; }
        .ds-upload-btn { background: #2271b1; color: #fff; border: none; padding: 0 12px; border-radius: 3px; cursor: pointer; font-weight: 500; font-size: 13px; height: 35px; }
        .ds-upload-btn:hover { background: #135e96; }

        .ds-btn { cursor: pointer; padding: 8px 16px; border: none; border-radius: 3px; font-weight: 600; font-size: 13px; text-decoration: none; display: inline-block; }
        .ds-btn-add { background: #2271b1; color: #fff; width: 100%; text-align: center; font-size: 14px; padding: 12px; }
        .ds-btn-add:hover { background: #135e96; }
        .ds-btn-remove { background: #d63638; color: #fff; height: 35px; padding: 0 12px; margin-bottom: 0px; }
        .ds-btn-remove:hover { background: #b32d2e; }
    </style>

    <!-- ACCORDION 1: FILES -->
    <div class="ds-accordion open" id="ds-accordion-files">
        <div class="ds-accordion-header ds-toggle-header">
            <span>Add Files (e.g pdf, excel etc)</span>
            <span class="ds-arrow"></span>
        </div>
        <div class="ds-accordion-body">
            <div id="ds-files-container">
                <?php 
                $file_index = 0;
                if ( ! empty( $files_data ) ) {
                    foreach ( $files_data as $file ) {
                        ds_render_admin_file_row( $file_index, $file );
                        $file_index++;
                    }
                }
                ?>
            </div>
            <button type="button" class="ds-btn ds-btn-add" id="ds-add-file-btn">+ Add New File</button>
        </div>
    </div>

    <!-- ACCORDION 2: AUDIO -->
    <div class="ds-accordion" id="ds-accordion-audio">
        <div class="ds-accordion-header ds-toggle-header">
            <span>Add Audio Files</span>
            <span class="ds-arrow"></span>
        </div>
        <div class="ds-accordion-body">
            <div id="ds-audio-container">
                <?php 
                $audio_index = 0;
                if ( ! empty( $audio_data ) ) {
                    foreach ( $audio_data as $audio ) {
                        ds_render_admin_audio_row( $audio_index, $audio );
                        $audio_index++;
                    }
                }
                ?>
            </div>
            <button type="button" class="ds-btn ds-btn-add" id="ds-add-audio-btn">+ Add New Audio</button>
        </div>
    </div>

    <!-- ACCORDION 3: DAILY PRACTICE VIDEOS -->
    <div class="ds-accordion" id="ds-accordion-videos">
        <div class="ds-accordion-header ds-toggle-header">
            <span>Add School Training Daily practice videos</span>
            <span class="ds-arrow"></span>
        </div>
        <div class="ds-accordion-body">
            <div id="ds-videos-container">
                <?php 
                $video_index = 0;
                if ( ! empty( $video_data ) ) {
                    foreach ( $video_data as $video ) {
                        ds_render_admin_video_row( $video_index, $video );
                        $video_index++;
                    }
                }
                ?>
            </div>
            <button type="button" class="ds-btn ds-btn-add" id="ds-add-video-btn">+ Add New Video</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Accordion Toggles
            const toggles = document.querySelectorAll('.ds-toggle-header');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    this.closest('.ds-accordion').classList.toggle('open');
                });
            });

            // ==========================================
            // 1. FILES UPLOADER LOGIC
            // ==========================================
            let fileIndex = <?php echo $file_index; ?>;
            const filesContainer = document.getElementById('ds-files-container');
            const addFileBtn = document.getElementById('ds-add-file-btn');

            filesContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('ds-upload-file-btn')) {
                    e.preventDefault();
                    const urlInput = e.target.closest('.ds-upload-wrap').querySelector('.ds-file-url');
                    const frame = wp.media({
                        title: 'Select or Upload File',
                        button: { text: 'Use this file' },
                        multiple: false
                    });
                    frame.on('select', function() {
                        const attachment = frame.state().get('selection').first().toJSON();
                        urlInput.value = attachment.url;
                    });
                    frame.open();
                }
                if (e.target.classList.contains('ds-remove-file-row')) {
                    if (confirm('Remove this file?')) {
                        e.target.closest('.ds-row').remove();
                    }
                }
            });

            addFileBtn.addEventListener('click', function() {
                const html = `
                <div class="ds-row">
                    <div class="ds-field ds-field-title">
                        <label>Document Title *</label>
                        <input type="text" name="ds_files[${fileIndex}][title]" required>
                    </div>
                    <div class="ds-field ds-field-file">
                        <label>Upload File *</label>
                        <div class="ds-upload-wrap">
                            <input type="text" class="ds-file-url" name="ds_files[${fileIndex}][file_url]" required readonly placeholder="No file selected">
                            <button type="button" class="ds-upload-btn ds-upload-file-btn">Select File</button>
                        </div>
                    </div>
                    <div class="ds-field ds-field-tagline">
                        <label>Tagline</label>
                        <input type="text" name="ds_files[${fileIndex}][tagline]">
                    </div>
                    <button type="button" class="ds-btn ds-btn-remove ds-remove-file-row">Remove</button>
                </div>`;
                filesContainer.insertAdjacentHTML('beforeend', html);
                fileIndex++;
            });

            // ==========================================
            // 2. AUDIO UPLOADER LOGIC
            // ==========================================
            let audioIndex = <?php echo $audio_index; ?>;
            const audioContainer = document.getElementById('ds-audio-container');
            const addAudioBtn = document.getElementById('ds-add-audio-btn');

            audioContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('ds-upload-audio-btn')) {
                    e.preventDefault();
                    const urlInput = e.target.closest('.ds-upload-wrap').querySelector('.ds-audio-url');
                    const frame = wp.media({
                        title: 'Select or Upload Audio',
                        button: { text: 'Use this audio' },
                        multiple: false,
                        library: { type: 'audio' }
                    });
                    frame.on('select', function() {
                        const attachment = frame.state().get('selection').first().toJSON();
                        urlInput.value = attachment.url;
                    });
                    frame.open();
                }
                if (e.target.classList.contains('ds-remove-audio-row')) {
                    if (confirm('Remove this audio file?')) {
                        e.target.closest('.ds-row').remove();
                    }
                }
            });

            addAudioBtn.addEventListener('click', function() {
                const html = `
                <div class="ds-row">
                    <div class="ds-field ds-field-audio-title">
                        <label>Audio File Title *</label>
                        <input type="text" name="ds_audios[${audioIndex}][title]" required>
                    </div>
                    <div class="ds-field ds-field-audio-file">
                        <label>Upload Audio File *</label>
                        <div class="ds-upload-wrap">
                            <input type="text" class="ds-audio-url" name="ds_audios[${audioIndex}][audio_url]" required readonly placeholder="No audio selected">
                            <button type="button" class="ds-upload-btn ds-upload-audio-btn">Select Audio</button>
                        </div>
                    </div>
                    <button type="button" class="ds-btn ds-btn-remove ds-remove-audio-row">Remove</button>
                </div>`;
                audioContainer.insertAdjacentHTML('beforeend', html);
                audioIndex++;
            });

            // ==========================================
            // 3. DAILY PRACTICE VIDEOS LOGIC
            // ==========================================
            let videoIndex = <?php echo $video_index; ?>;
            const videosContainer = document.getElementById('ds-videos-container');
            const addVideoBtn = document.getElementById('ds-add-video-btn');

            videosContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('ds-remove-video-row')) {
                    if (confirm('Remove this video?')) {
                        e.target.closest('.ds-row').remove();
                    }
                }
            });

            addVideoBtn.addEventListener('click', function() {
                const html = `
                <div class="ds-row">
                    <div class="ds-field ds-field-video-title">
                        <label>Video Title *</label>
                        <input type="text" name="ds_videos[${videoIndex}][title]" required>
                    </div>
                    <div class="ds-field ds-field-video-url">
                        <label>Video URL *</label>
                        <input type="text" name="ds_videos[${videoIndex}][video_url]" required placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                    <button type="button" class="ds-btn ds-btn-remove ds-remove-video-row">Remove</button>
                </div>`;
                videosContainer.insertAdjacentHTML('beforeend', html);
                videoIndex++;
            });
        });
    </script>
    <?php
}

// Helper function to render existing FILE rows
function ds_render_admin_file_row( $index, $file ) {
    $title = isset( $file['title'] ) ? esc_attr( $file['title'] ) : '';
    $url = isset( $file['file_url'] ) ? esc_attr( $file['file_url'] ) : '';
    $tagline = isset( $file['tagline'] ) ? esc_attr( $file['tagline'] ) : '';
    ?>
    <div class="ds-row">
        <div class="ds-field ds-field-title">
            <label>Document Title *</label>
            <input type="text" name="ds_files[<?php echo $index; ?>][title]" value="<?php echo $title; ?>" required>
        </div>
        <div class="ds-field ds-field-file">
            <label>Upload File *</label>
            <div class="ds-upload-wrap">
                <input type="text" class="ds-file-url" name="ds_files[<?php echo $index; ?>][file_url]" value="<?php echo $url; ?>" required readonly placeholder="No file selected">
                <button type="button" class="ds-upload-btn ds-upload-file-btn">Select File</button>
            </div>
        </div>
        <div class="ds-field ds-field-tagline">
            <label>Tagline</label>
            <input type="text" name="ds_files[<?php echo $index; ?>][tagline]" value="<?php echo $tagline; ?>">
        </div>
        <button type="button" class="ds-btn ds-btn-remove ds-remove-file-row">Remove</button>
    </div>
    <?php
}

// Helper function to render existing AUDIO rows
function ds_render_admin_audio_row( $index, $audio ) {
    $title = isset( $audio['title'] ) ? esc_attr( $audio['title'] ) : '';
    $url = isset( $audio['audio_url'] ) ? esc_attr( $audio['audio_url'] ) : '';
    ?>
    <div class="ds-row">
        <div class="ds-field ds-field-audio-title">
            <label>Audio File Title *</label>
            <input type="text" name="ds_audios[<?php echo $index; ?>][title]" value="<?php echo $title; ?>" required>
        </div>
        <div class="ds-field ds-field-audio-file">
            <label>Upload Audio File *</label>
            <div class="ds-upload-wrap">
                <input type="text" class="ds-audio-url" name="ds_audios[<?php echo $index; ?>][audio_url]" value="<?php echo $url; ?>" required readonly placeholder="No audio selected">
                <button type="button" class="ds-upload-btn ds-upload-audio-btn">Select Audio</button>
            </div>
        </div>
        <button type="button" class="ds-btn ds-btn-remove ds-remove-audio-row">Remove</button>
    </div>
    <?php
}

// Helper function to render existing VIDEO rows
function ds_render_admin_video_row( $index, $video ) {
    $title = isset( $video['title'] ) ? esc_attr( $video['title'] ) : '';
    $url = isset( $video['video_url'] ) ? esc_attr( $video['video_url'] ) : '';
    ?>
    <div class="ds-row">
        <div class="ds-field ds-field-video-title">
            <label>Video Title *</label>
            <input type="text" name="ds_videos[<?php echo $index; ?>][title]" value="<?php echo $title; ?>" required>
        </div>
        <div class="ds-field ds-field-video-url">
            <label>Video URL *</label>
            <input type="text" name="ds_videos[<?php echo $index; ?>][video_url]" value="<?php echo $url; ?>" required placeholder="https://www.youtube.com/watch?v=...">
        </div>
        <button type="button" class="ds-btn ds-btn-remove ds-remove-video-row">Remove</button>
    </div>
    <?php
}

// 3. Save Meta Box Data
function ds_save_materials_meta( $post_id ) {
    if ( ! isset( $_POST['ds_materials_nonce'] ) || ! wp_verify_nonce( $_POST['ds_materials_nonce'], 'ds_save_materials' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
        return;
    }

    // --- Save Files ---
    $saved_files = array();
    if ( isset( $_POST['ds_files'] ) && is_array( $_POST['ds_files'] ) ) {
        foreach ( $_POST['ds_files'] as $file ) {
            $clean_title = isset( $file['title'] ) ? sanitize_text_field( $file['title'] ) : '';
            $clean_url = isset( $file['file_url'] ) ? esc_url_raw( $file['file_url'] ) : '';
            if ( empty( $clean_title ) || empty( $clean_url ) ) continue;
            $saved_files[] = array(
                'title'    => $clean_title,
                'file_url' => $clean_url,
                'tagline'  => isset( $file['tagline'] ) ? sanitize_text_field( $file['tagline'] ) : '',
            );
        }
    }
    update_post_meta( $post_id, '_ds_downloadable_materials', $saved_files );

    // --- Save Audios ---
    $saved_audios = array();
    if ( isset( $_POST['ds_audios'] ) && is_array( $_POST['ds_audios'] ) ) {
        foreach ( $_POST['ds_audios'] as $audio ) {
            $clean_title = isset( $audio['title'] ) ? sanitize_text_field( $audio['title'] ) : '';
            $clean_url = isset( $audio['audio_url'] ) ? esc_url_raw( $audio['audio_url'] ) : '';
            if ( empty( $clean_title ) || empty( $clean_url ) ) continue;
            $saved_audios[] = array(
                'title'     => $clean_title,
                'audio_url' => $clean_url,
                'date_added'    => current_time( 'mysql' ),
            );
        }
    }
    update_post_meta( $post_id, '_ds_downloadable_audios', $saved_audios );

    // --- Save Daily Practice Videos ---
    $saved_videos = array();
    if ( isset( $_POST['ds_videos'] ) && is_array( $_POST['ds_videos'] ) ) {
        foreach ( $_POST['ds_videos'] as $video ) {
            $clean_title = isset( $video['title'] ) ? sanitize_text_field( $video['title'] ) : '';
            // Using sanitize_text_field for URL as requested type="text", but validating it looks like a URL
            $clean_url = isset( $video['video_url'] ) ? sanitize_text_field( $video['video_url'] ) : '';
            if ( empty( $clean_title ) || empty( $clean_url ) ) continue;
            $saved_videos[] = array(
                'title'     => $clean_title,
                'video_url' => $clean_url,
            );
        }
    }
    update_post_meta( $post_id, '_ds_daily_practice_videos', $saved_videos );
}
add_action( 'save_post_page', 'ds_save_materials_meta' );

// 4. Frontend Data Helper Functions
function ds_get_downloadable_materials( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( ! $post_id ) return array();
    $data = get_post_meta( $post_id, '_ds_downloadable_materials', true );
    return is_array( $data ) ? $data : array();
}

function ds_get_downloadable_audios( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( ! $post_id ) return array();
    $data = get_post_meta( $post_id, '_ds_downloadable_audios', true );
    return is_array( $data ) ? $data : array();
}

function ds_get_daily_practice_videos( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( ! $post_id ) return array();
    $data = get_post_meta( $post_id, '_ds_daily_practice_videos', true );
    return is_array( $data ) ? $data : array();
}




/*End of download for school training programs */


/**
 * ============================================================================
 * EXTERNAL ARTICLE FETCHER (TinyMCE Button + PHP Array Generator)
 * ============================================================================
 */

// 1. Add the custom button to the Classic Editor toolbar (First row)
add_filter('mce_buttons', function($buttons) {
    array_push($buttons, 'external_article_btn');
    return $buttons;
}, 999); // High priority to ensure it runs last

// 1b. (Fallback) Add to the Second row just in case the first row is full
add_filter('mce_buttons_2', function($buttons) {
    array_push($buttons, 'external_article_btn');
    return $buttons;
}, 999);

// 2. Load the JS file into TinyMCE
add_filter('mce_external_plugins', function($plugin_array) {
    $plugin_array['external_article_btn'] = get_stylesheet_directory_uri() . '/js/article-button.js';
    return $plugin_array;
});

// 3. Create a dummy shortcode so the editor keeps the URL in the post content
add_shortcode('article_data', function($atts) {
    return ''; // Outputs nothing visually, just holds the data
});

function ukt_get_posts_by_slugs_array( $slugs_string ) {
    $articles_array = array();
    if ( empty( $slugs_string ) ) return $articles_array;

    // Convert comma-separated string into a clean array of slugs
    $slugs = array_map( 'trim', explode( ',', $slugs_string ) );

    // Query the posts
    $args = array(
        'post_type'      => 'post', // Change to 'page' or custom post type if needed
        'post_name__in'  => $slugs,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );
    
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Get featured image
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            
            // Build the array
            $articles_array[] = array(
                'title'         => get_the_title(),
                'content'       => wp_trim_words( get_the_excerpt(), 30 ), 
                'thumbnail_url' => $thumbnail_url ? $thumbnail_url : '',
                'date'          => get_the_date( 'M j, Y' ),
                'url'           => get_permalink(),
            );
        }
        wp_reset_postdata();
    }
    
    return $articles_array;
}





// registering menu 
add_action('after_setup_theme', function() {
    register_nav_menus(array(
        'our_events'    => 'Activities - Our Events',
        'spiritualty_and_you' => 'Activities - Spirituality and you',
        'training_programs' => 'Activities - Training Programs',
        'we_support' => 'Activities - We Support',
        'project_green' => 'Activities - Project Green',

        'healing' => 'Healing Solutions - Healing',
        'parivarthan_app' => 'Healing Solutions - Parivarthan app',
        'healing_locations' => 'Healing Solutions - Healing Locations',
        'spiritual_resources' => 'Healing Solutions - Spititual Resources',

        'press' => 'Reviews & Testimonials - Press',
        'reviews' => 'Reviews & Testimonials - reviews',
        'testimonials' => 'Reviews & Testimonials - Testionials',
    
        'faq-and-reading' => 'FAQ & Reading',

        'contact-us' => 'Contact Us'
    ));
});