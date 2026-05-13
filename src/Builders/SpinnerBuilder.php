<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class SpinnerBuilder implements Renderable
{
    protected ?string $variant = null;
    protected string $type = 'border';
    protected string $size = 'medium';
    protected bool $grow = false;
    protected array $extraClasses = [];
    protected array $attributes = [];
    protected ?string $srText = null;

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

    public function type(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function border(): static
    {
        return $this->type('border');
    }

    public function grow(): static
    {
        return $this->type('grow');
    }

    public function small(): static
    {
        $this->size = 'small';
        return $this;
    }

    public function srText(string $text): static
    {
        $this->srText = $text;
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

    public function render(): string
    {
        $fw = UI::framework();
        $classes = $fw->spinner($this->variant, $this->type);
        if ($this->size === 'small') {
            $classes[] = $this->type === 'grow' ? 'spinner-grow-sm' : 'spinner-border-sm';
        }
        $classes = array_merge($classes, $this->extraClasses);

        $html = '<div' . Renderer::buildAttributes($this->attributes, $classes) . ' role="status">';
        if ($this->srText) {
            $html .= '<span class="visually-hidden">' . Renderer::escape($this->srText) . '</span>';
        }
        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
