@php
    $name = $getName();
    $uploadUrl = $getUploadUrl();
    $placeholder = $getPlaceholder();
    $isConcealed = $isConcealed();
    $statePath = $getStatePath();
    $isDisabled = $isDisabled();
    $toolbarItems = $getToolbarItems();
    $headingOptions = $getHeadingOptions();
    $menuBarVisible = $getMenuBarVisible();
    // Create a safe identifier from statePath for use in JavaScript
    $editorId = str_replace(['.', '[', ']'], ['-', '-', ''], $statePath);
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <x-filament::input.wrapper
        :valid="! $errors->has($statePath)"
    >
        <div wire:ignore>
            <script type="text/javascript">
                // Initialize the instance and event listener flags if not already set
                if (!window.ckeditorInstances["ckeditor-{{ $editorId }}"]) {
                    window.ckeditorInstances["ckeditor-{{ $editorId }}"] = {
                        instance: null,
                        eventListenerAdded: false,
                        createHandler: null,
                        destroyHandler: null
                    };
                }

                function createCKEditor(editorId, statePath, alpineComponent) {
                    // To prevent duplicates, halt here if an editor already exists
                    if (window.ckeditorInstances["ckeditor-" + editorId].instance) {
                        return;
                    }

                    // Check if the textarea element exists
                    const textarea = document.querySelector('#ckeditor-' + editorId);
                    if (!textarea) {
                        return;
                    }

                    // Store statePath and Alpine component for this editor instance
                    window.ckeditorInstances["ckeditor-" + editorId].statePath = statePath;
                    window.ckeditorInstances["ckeditor-" + editorId].alpineComponent = alpineComponent;

                    // Create new editor instance
                    ClassicEditor
                        .create(textarea, {
                            plugins: [
                                AccessibilityHelp,
                                Alignment,
                                Autoformat,
                                AutoImage,
                                AutoLink,
                                Autosave,
                                BlockQuote,
                                Bold,
                                Code,
                                CodeBlock,
                                Essentials,
                                FindAndReplace,
                                FontBackgroundColor,
                                FontColor,
                                FontFamily,
                                FontSize,
                                GeneralHtmlSupport,
                                Heading,
                                Highlight,
                                HorizontalLine,
                                HtmlComment,
                                HtmlEmbed,
                                ImageBlock,
                                ImageCaption,
                                ImageInline,

                                @if($uploadUrl)

                                    ImageInsert,
                                    ImageInsertViaUrl,
                                    ImageUpload,

                                @else

                                    ImageInsertViaUrl,

                                @endif

                                ImageResize,
                                ImageStyle,
                                ImageTextAlternative,
                                ImageToolbar,
                                Indent,
                                IndentBlock,
                                Italic,
                                Link,
                                LinkImage,
                                List,
                                ListProperties,
                                MediaEmbed,
                                PageBreak,
                                Paragraph,
                                PasteFromOffice,
                                RemoveFormat,
                                SelectAll,
                                ShowBlocks,

                                @if($uploadUrl)

                                    SimpleUploadAdapter,

                                @endif

                                SourceEditing,
                                SpecialCharacters,
                                SpecialCharactersArrows,
                                SpecialCharactersCurrency,
                                SpecialCharactersEssentials,
                                SpecialCharactersLatin,
                                SpecialCharactersMathematical,
                                SpecialCharactersText,
                                Strikethrough,
                                Style,
                                Subscript,
                                Superscript,
                                Table,
                                TableCaption,
                                TableCellProperties,
                                TableColumnResize,
                                TableProperties,
                                TableToolbar,
                                TextTransformation,
                                TodoList,
                                Underline,
                                Undo
                            ],
                            toolbar: {
                                items: @json($toolbarItems),
                                shouldNotGroupWhenFull: false
                            },
                            fontFamily: {
                                supportAllValues: true
                            },
                            fontSize: {
                                options: [10, 12, 14, 'default', 18, 20, 22],
                                supportAllValues: true
                            },
                            heading: {
                                options: @json($headingOptions)
                            },
                            htmlSupport: {
                                allow: [
                                    {
                                        name: /^.*$/,
                                        styles: true,
                                        attributes: true,
                                        classes: true
                                    }
                                ],
                                disallow: [
                                    {
                                        styles: {
                                            'background-color': true,
                                            'color': true
                                        }
                                    }
                                ]
                            },
                            image: {
                                toolbar: [
                                    'toggleImageCaption',
                                    'imageTextAlternative',
                                    '|',
                                    'imageStyle:inline',
                                    'imageStyle:wrapText',
                                    'imageStyle:breakText',
                                    '|',
                                    'resizeImage'
                                ]
                            },
                            link: {
                                addTargetToExternalLinks: true,
                                defaultProtocol: 'https://',
                                decorators: {
                                    toggleDownloadable: {
                                        mode: 'manual',
                                        label: 'Downloadable',
                                        attributes: {
                                            download: 'file'
                                        }
                                    },

                                    openInNewTab: {
                                        mode: 'manual',
                                        label: 'Open in a new tab',
                                        defaultValue: true, // Optional
                                        attributes: {
                                            target: '_blank',
                                            rel: 'noopener noreferrer'
                                        }
                                    }
                                }
                            },
                            list: {
                                properties: {
                                    styles: true,
                                    startIndex: true,
                                    reversed: true
                                }
                            },
                            menuBar: {
                                isVisible: @json($menuBarVisible)
                            },
                            placeholder: '{{ $placeholder }}',
                            style: {
                                definitions: [
                                    {
                                        name: 'Article category',
                                        element: 'h3',
                                        classes: ['category']
                                    },
                                    {
                                        name: 'Title',
                                        element: 'h2',
                                        classes: ['document-title']
                                    },
                                    {
                                        name: 'Subtitle',
                                        element: 'h3',
                                        classes: ['document-subtitle']
                                    },
                                    {
                                        name: 'Info box',
                                        element: 'p',
                                        classes: ['info-box']
                                    },
                                    {
                                        name: 'Side quote',
                                        element: 'blockquote',
                                        classes: ['side-quote']
                                    },
                                    {
                                        name: 'Marker',
                                        element: 'span',
                                        classes: ['marker']
                                    },
                                    {
                                        name: 'Spoiler',
                                        element: 'span',
                                        classes: ['spoiler']
                                    },
                                    {
                                        name: 'Code (dark)',
                                        element: 'pre',
                                        classes: ['fancy-code', 'fancy-code-dark']
                                    },
                                    {
                                        name: 'Code (bright)',
                                        element: 'pre',
                                        classes: ['fancy-code', 'fancy-code-bright']
                                    }
                                ]
                            },
                            table: {
                                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
                            },

                            @isset($uploadUrl)

                                simpleUpload: {
                                    uploadUrl: '{{ $uploadUrl }}',
                                    withCredentials: true,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }

                            @endisset

                        })
                        .then(editor => {
                            window.ckeditorInstances["ckeditor-" + editorId].instance = editor;

                            // Find the main ckeditor class and add some helpful class names to it

                            document.getElementsByClassName('ck-editor__main')[0].classList.add('prose', 'max-w-none', 'dark:prose-invert')

                            editor.editing.view.change(writer => {
                                writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
                            });


                            // Listen to changes (only if not disabled)
                            @if(!$isDisabled)

                                // Update Alpine state immediately on every change (no network calls)
                                editor.model.document.on('change:data', () => {
                                    const instance = window.ckeditorInstances["ckeditor-" + editorId];
                                    if (instance.alpineComponent) {
                                        // Update Alpine state directly (will sync via $entangle on form submit)
                                        instance.alpineComponent.state = editor.getData();
                                    }
                                });

                            @else

                                editor.enableReadOnlyMode('{{ $editorId }}');

                            @endif

                        })
                        .catch(err => {
                            console.error(err);
                        });
                }

                function destroyCKEditor(editorId) {
                    if (window.ckeditorInstances["ckeditor-" + editorId]?.instance) {
                        window.ckeditorInstances["ckeditor-" + editorId].instance.destroy()
                            .then(() => {
                                window.ckeditorInstances["ckeditor-" + editorId].instance = null;
                            })
                            .catch(err => {
                                console.error('Failed to destroy editor:', err);
                            });
                    }
                }

                // Create bound wrapper functions for event listeners (will be set with Alpine component in init)
                window.ckeditorInstances["ckeditor-{{ $editorId }}"].createHandler = null;
                window.ckeditorInstances["ckeditor-{{ $editorId }}"].destroyHandler = () => destroyCKEditor('{{ $editorId }}');
            </script>
            <div
                x-data="{
                    state: $wire.$entangle('{{ $getStatePath() }}'),
                    init() {
                        const instance = window.ckeditorInstances['ckeditor-{{ $editorId }}'];

                        // Create handler with Alpine component context
                        instance.createHandler = () => createCKEditor('{{ $editorId }}', '{{ $statePath }}', this);

                        // Remove existing event listeners to prevent duplicates
                        if (instance.createHandler) {
                            document.removeEventListener('livewire:navigated', instance.createHandler);
                        }
                        if (instance.destroyHandler) {
                            document.removeEventListener('livewire:navigate', instance.destroyHandler);
                        }

                        // Add event listeners if not already added
                        if (!instance.eventListenerAdded && instance.createHandler && instance.destroyHandler) {
                            document.addEventListener('livewire:navigated', instance.createHandler);
                            document.addEventListener('livewire:navigate', instance.destroyHandler);
                            instance.eventListenerAdded = true;
                        }

                        // Initialize editor immediately if ClassicEditor is available
                        this.$nextTick(() => {
                            if (typeof ClassicEditor !== 'undefined' && !instance.instance) {
                                const textarea = document.querySelector('#ckeditor-{{ $editorId }}');
                                if (textarea) {
                                    createCKEditor('{{ $editorId }}', '{{ $statePath }}', this);
                                }
                            }
                        });

                        // Watch for state changes and update editor content
                        this.$watch('state', (value) => {
                            const editor = instance.instance;
                            if (editor && value !== null && value !== undefined) {
                                const currentContent = editor.getData();
                                // Only update if content actually changed to prevent loops
                                if (currentContent !== value) {
                                    editor.setData(value);
                                }
                            }
                        });
                    }
                }"
                x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('filament-ckeditor-field', package: 'kahusoftware/filament-ckeditor-field'))]"
                x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-ckeditor-field', package: 'kahusoftware/filament-ckeditor-field'))]"
            >
                <textarea
                    id="ckeditor-{{ $editorId }}"
                    name="{{ $name }}"
                    x-model="state"
                ></textarea>
            </div>
        </div>
    </x-filament::input.wrapper>
</x-dynamic-component>
