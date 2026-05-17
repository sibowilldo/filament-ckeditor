<?php

namespace Kahusoftware\FilamentCkeditorField;

use Closure;
use Filament\Forms\Components\Field;

class CKEditor extends Field
{
    protected string | Closure $content = '';

    protected string $name = 'ckeditor';

    protected int $minLength = 0;

    protected string | Closure | null $uploadUrl = null;

    protected bool $uploadUrlExplicitlySet = false;

    protected array | Closure | null $toolbarItems = null;

    protected array | Closure | null $headingOptions = null;

    protected bool | Closure | null $menuBarVisible = null;

    protected string $placeholder = 'Type or paste your content here...';

    protected string $view = 'filament-ckeditor-field::ckeditor';

    public static function make(?string $name = null): static
    {
        $field = app(static::class, [
            'name' => $name ?? 'ckeditor',
        ]);

        return $field;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrated(false);
    }

    public function uploadUrl(string | Closure | null $uploadUrl): self
    {
        $this->uploadUrl = $uploadUrl;
        $this->uploadUrlExplicitlySet = true;

        return $this;
    }

    public function content(string | Closure $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getContent(): string
    {
        return $this->evaluate($this->content);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function getUploadUrl(): ?string
    {
        if ($this->uploadUrlExplicitlySet) {
            return $this->evaluate($this->uploadUrl);
        }

        // If not explicitly set, use config value as default
        return config('filament-ckeditor-field.upload_url');
    }

    public function toolbarItems(array | Closure $toolbarItems): self
    {
        $this->toolbarItems = $toolbarItems;

        return $this;
    }

    public function getToolbarItems(): array
    {
        if ($this->toolbarItems !== null) {
            return $this->evaluate($this->toolbarItems);
        }

        return config('filament-ckeditor-field.toolbar_items', [
            'undo', 'redo', '|', 'sourceEditing', 'showBlocks', '|',
            'heading', 'style', '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'bold', 'italic', 'underline', '|', 'link', 'insertTable', 'highlight', 'blockQuote', 'codeBlock', '|',
            'alignment', '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
        ]);
    }

    public function headingOptions(array | Closure $headingOptions): self
    {
        $this->headingOptions = $headingOptions;

        return $this;
    }

    public function getHeadingOptions(): array
    {
        if ($this->headingOptions !== null) {
            return $this->evaluate($this->headingOptions);
        }

        return config('filament-ckeditor-field.heading_options', [
            ['model' => 'paragraph', 'title' => 'Paragraph', 'class' => 'ck-heading_paragraph'],
            ['model' => 'heading1', 'view' => 'h1', 'title' => 'Heading 1', 'class' => 'ck-heading_heading1'],
            ['model' => 'heading2', 'view' => 'h2', 'title' => 'Heading 2', 'class' => 'ck-heading_heading2'],
            ['model' => 'heading3', 'view' => 'h3', 'title' => 'Heading 3', 'class' => 'ck-heading_heading3'],
            ['model' => 'heading4', 'view' => 'h4', 'title' => 'Heading 4', 'class' => 'ck-heading_heading4'],
            ['model' => 'heading5', 'view' => 'h5', 'title' => 'Heading 5', 'class' => 'ck-heading_heading5'],
            ['model' => 'heading6', 'view' => 'h6', 'title' => 'Heading 6', 'class' => 'ck-heading_heading6'],
        ]);
    }

    public function menuBarVisible(bool | Closure $visible): self
    {
        $this->menuBarVisible = $visible;

        return $this;
    }

    public function getMenuBarVisible(): bool
    {
        if ($this->menuBarVisible !== null) {
            return (bool) $this->evaluate($this->menuBarVisible);
        }

        return (bool) config('filament-ckeditor-field.menu_bar_visible', true);
    }
}
