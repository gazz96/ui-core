<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class GridBuilder implements Renderable
{
    protected array $items = [];
    protected int $columns = 2;
    protected string $gap = '16px';
    protected array $extraClasses = [];
    protected array $attributes = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function columns(int $cols): static
    {
        $this->columns = $cols;
        return $this;
    }

    public function gap(string $gap): static
    {
        $this->gap = $gap;
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

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function add(Renderable $item): static
    {
        $this->items[] = $item;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->grid($this->columns, $this->gap), $this->extraClasses);
        $attrStr = Renderer::buildAttributes($this->attributes, $classes);

        $html = "<div{$attrStr}>";

        foreach ($this->items as $item) {
            $html .= $item->render();
        }

        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
