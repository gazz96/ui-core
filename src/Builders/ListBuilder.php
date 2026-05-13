<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class ListBuilder implements Renderable
{
    protected array $items = [];
    protected string $type = 'ul';
    protected array $extraClasses = [];
    protected bool $styled = true;

    public function __construct(array $items = [], string $type = 'ul')
    {
        $this->items = $items;
        $this->type = $type;
    }

    public static function ul(array $items = []): static
    {
        return new static($items, 'ul');
    }

    public static function ol(array $items = []): static
    {
        return new static($items, 'ol');
    }

    public function add(string $item): static
    {
        $this->items[] = $item;
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

    public function styled(bool $styled = true): static
    {
        $this->styled = $styled;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->list($this->type, $this->styled), $this->extraClasses);
        $attrStr = Renderer::buildAttributes([], $classes);

        $html = "<{$this->type}{$attrStr}>";

        foreach ($this->items as $item) {
            $liClasses = $fw->listItem();
            $html .= "<li" . Renderer::classes($liClasses) . ">";
            $html .= $item instanceof Renderable ? $item->render() : $item;
            $html .= "</li>";
        }

        $html .= "</{$this->type}>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
