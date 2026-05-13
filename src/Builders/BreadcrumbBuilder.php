<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class BreadcrumbBuilder implements Renderable
{
    protected array $items = [];
    protected array $extraClasses = [];
    protected bool $ordered = false;

    public function addItem(string $label, ?string $url = null): static
    {
        $this->items[] = ['label' => $label, 'url' => $url];
        return $this;
    }

    public function items(array $items): static
    {
        foreach ($items as $label => $url) {
            if (is_int($label)) {
                $this->addItem($url);
            } else {
                $this->addItem($label, $url);
            }
        }
        return $this;
    }

    public function ordered(bool $ordered = true): static
    {
        $this->ordered = $ordered;
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

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->breadcrumb(), $this->extraClasses);
        $tag = $this->ordered ? 'ol' : 'ul';
        $html = '<' . $tag . Renderer::buildAttributes([], $classes) . '>';

        $total = count($this->items);
        foreach ($this->items as $index => $item) {
            $isLast = $index === $total - 1;
            $itemClasses = $fw->breadcrumbItem($isLast);

            $html .= '<li' . Renderer::classes($itemClasses) . '>';
            if ($isLast || !$item['url']) {
                $html .= Renderer::escape($item['label']);
            } else {
                $html .= '<a href="' . Renderer::escape($item['url']) . '">' . Renderer::escape($item['label']) . '</a>';
            }
            $html .= '</li>';
        }

        $html .= '</' . $tag . '>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
