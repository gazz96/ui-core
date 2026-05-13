<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class FlexBuilder implements Renderable
{
    protected array $children = [];
    protected string $direction = 'row';
    protected string $justify = 'start';
    protected string $align = 'stretch';
    protected string $gap = '0px';
    protected bool $wrap = false;
    protected array $extraClasses = [];
    protected array $attributes = [];

    public function __construct(array $children = [])
    {
        $this->children = $children;
    }

    public function add(Renderable $child): static
    {
        $this->children[] = $child;
        return $this;
    }

    public function row(): static
    {
        $this->direction = 'row';
        return $this;
    }

    public function col(): static
    {
        $this->direction = 'column';
        return $this;
    }

    public function justify(string $value): static
    {
        $this->justify = $value;
        return $this;
    }

    public function center(): static
    {
        $this->justify = 'center';
        $this->align = 'center';
        return $this;
    }

    public function between(): static
    {
        $this->justify = 'space-between';
        return $this;
    }

    public function around(): static
    {
        $this->justify = 'space-around';
        return $this;
    }

    public function align(string $value): static
    {
        $this->align = $value;
        return $this;
    }

    public function gap(string $gap): static
    {
        $this->gap = $gap;
        return $this;
    }

    public function wrap(bool $wrap = true): static
    {
        $this->wrap = $wrap;
        return $this;
    }

    public function class(string|array $class): static
    {
        if (is_string($class)) {
            $class = array_filter(explode(' ', $class));
        }
        $this->extraClasses = array_merge($this->extraClasses, $class);
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();

        if ($this->direction === 'column') {
            $classes = $fw->flexCol($this->gap);
        } else {
            $classes = $fw->flexRow($this->gap);
        }

        if ($this->justify === 'center' && $this->align === 'center') {
            $classes = $fw->flexCenter();
        } elseif ($this->justify === 'space-between') {
            $classes = $fw->flexBetween();
        }

        if ($this->wrap) {
            $classes = array_merge($classes, $fw->flexWrap());
        }

        $classes = array_merge($classes, $this->extraClasses);
        $attrStr = Renderer::buildAttributes($this->attributes, $classes);

        $html = "<div{$attrStr}>";

        foreach ($this->children as $child) {
            $html .= $child->render();
        }

        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
