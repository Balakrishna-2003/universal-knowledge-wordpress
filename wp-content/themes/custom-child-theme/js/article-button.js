(function() {
    tinymce.PluginManager.add('external_article_btn', function(editor) {
        editor.addButton('external_article_btn', {
            icon: 'link', 
            tooltip: 'Insert Article Link(s)',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Insert Article Link(s)',
                    body: [
                        {
                            type: 'textbox',
                            name: 'urls',
                            label: 'Article URL(s)',
                            value: '',
                            multiline: true,
                            minWidth: 500,
                            minHeight: 100,
                            placeholder: 'Paste 1 or more links separated by commas (e.g. https://site.com/art1, https://site.com/art2)'
                        }
                    ],
                    onsubmit: function(e) {
                        var urls = e.data.urls.trim();
                        if(urls) {
                            editor.insertContent('[article_data urls="' + urls + '"]');
                        }
                    }
                });
            }
        });
    });
})();