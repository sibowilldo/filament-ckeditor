<?php

return [

    /**
     * Image upload enabled
     *
     * WARNING: Setting this to false will use CKEditor's default Base64 upload method which is HIGHLY INEFFICIENT.
     * https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html#base64-adapter
     */
    'upload_enabled' => false,

    /**
     * Image URL to upload to if one is not specified on the form field's ->uploadUrl() method
     */
    'upload_url' => null,

    /**
     * Toolbar items displayed in the CKEditor toolbar.
     * Use '|' as a separator. Set to null to use the default built-in toolbar.
     * See: https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html
     */
    /**
     * Whether the CKEditor menu bar is visible.
     */
    'menu_bar_visible' => false,

    /**
     * Heading options available in the CKEditor heading dropdown.
     * Each entry requires a 'model', 'title', and 'class'. Add a 'view' key for non-paragraph elements.
     * Set to null to use the default built-in headings.
     */
    'heading_options' => [
        [
            'model' => 'paragraph',
            'title' => 'Paragraph',
            'class' => 'ck-heading_paragraph',
        ],
        [
            'model' => 'heading1',
            'view'  => 'h1',
            'title' => 'Heading 1',
            'class' => 'ck-heading_heading1',
        ],
        [
            'model' => 'heading2',
            'view'  => 'h2',
            'title' => 'Heading 2',
            'class' => 'ck-heading_heading2',
        ],
        [
            'model' => 'heading3',
            'view'  => 'h3',
            'title' => 'Heading 3',
            'class' => 'ck-heading_heading3',
        ],
        [
            'model' => 'heading4',
            'view'  => 'h4',
            'title' => 'Heading 4',
            'class' => 'ck-heading_heading4',
        ],
        [
            'model' => 'heading5',
            'view'  => 'h5',
            'title' => 'Heading 5',
            'class' => 'ck-heading_heading5',
        ],
        [
            'model' => 'heading6',
            'view'  => 'h6',
            'title' => 'Heading 6',
            'class' => 'ck-heading_heading6',
        ],
    ],

    'toolbar_items' => [
        'undo',
        'redo',
        '|',
        'heading',
        '|',
        'bold',
        'italic',
        'underline',
        '|',
        'link',
        'insertTable',
        '|',
        'alignment',
        '|',
        'bulletedList',
        'numberedList',
        'todoList',
        'outdent',
        'indent',
        '|',
        'sourceEditing',
        'showBlocks',
//        'style',
//        '|',
//        'fontSize',
//        'fontFamily',
//        'fontColor',
//        'fontBackgroundColor',
//        'blockQuote',
//        'codeBlock',
//        'highlight',
    ],

];
