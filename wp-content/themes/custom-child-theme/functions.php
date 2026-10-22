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
                    'application/pdf',
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
                        library: { type: allowedMimeTypes } // Filters the Media Library tab
                    }, 
                    function (att) {
                        // 2. Strict Validation upon selection
                        const fileName = att.filename || att.title || getFileName(att.url);
                        const fileExt = fileName.split('.').pop().toLowerCase();
                        const allowedExts = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
                        
                        // Check if the MIME type or extension is NOT in our allowed lists
                        if (allowedMimeTypes.indexOf(att.mime) === -1 || allowedExts.indexOf(fileExt) === -1) {
                            alert('Invalid file type!\n\nPlease upload only PDF, Word (.doc/.docx), Excel (.xls/.xlsx), or PowerPoint (.ppt/.pptx) files.');
                            return; // Stop execution, do not save the file data
                        }

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
                    library: { type: 'application/pdf' }
                });
                frame.on('select', function() {
                    const att = frame.state().get('selection').first().toJSON();
                    
                    // Validate PDF
                    const fileName = att.filename || att.title || att.url.split('/').pop();
                    const fileExt = fileName.split('.').pop().toLowerCase();
                    
                    if (att.mime !== 'application/pdf' || fileExt !== 'pdf') {
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
}
add_action( 'add_meta_boxes', 'el_add_meta_box' );

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