<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class BadgeBuilder implements Renderable
{
    protected string $text;
    protected ?string $variant = null;
    protected bool $pill = false;
    protected array $extraClasses = [];
    protected array $attributes = [];

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function variant(string $variant): static
    {
        $this->variant = $variant;
        return $this;
    }

    public function primary(): static { return $this->variant('primary'); }
    public function secondary(): static { return $this->variant('secondary'); }
    public function success(): static { return $this->variant('success'); }
    public function danger(): static { return $this->variant('danger'); }
    public function warning(): static { return $this->variant('warning'); }
    public function info(): static { return $this->variant('info'); }
    public function light(): static { return $this->variant('light'); }
    public function dark(): static { return $this->variant('dark'); }

    public function pill(bool $pill = true): static
    {
        $this->pill = $pill;
        return $this;
    }

    public function class(string|array $classes): static
    {
        if (is_string($classes)) {
            $classes = array_filter(explode(' ', $classes));
        }
        $this->extraClasses = array_merge($this->extraClasses, $classes);
        return $this;
    }

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function href(string $url): static
    {
        $this->attributes['href'] = $url;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->badge($this->variant, $this->pill), $this->extraClasses);

        if (isset($this->attributes['href'])) {
            return '<a' . Renderer::buildAttributes($this->attributes, $classes) . '>' . Renderer::escape($this->text) . '</a>';
        }

        return '<span' . Renderer::buildAttributes($this->attributes, $classes) . '>' . Renderer::escape($this->text) . '</span>';
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
