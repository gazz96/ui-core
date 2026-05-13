<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class DropdownBuilder implements Renderable
{
    protected string $label;
    protected ?string $variant = null;
    protected array $items = [];
    protected array $extraClasses = [];
    protected string $id;

    public function __construct(string $label, string $id = '')
    {
        $this->label = $label;
        $this->id = $id ?: 'dropdown-' . substr(md5($label), 0, 8);
    }

    public function variant(string $variant): static
    {
        $this->variant = $variant;
        return $this;
    }

    public function addItem(string $label, ?string $url = null, bool $active = false, bool $disabled = false): static
    {
        $this->items[] = ['type' => 'item', 'label' => $label, 'url' => $url, 'active' => $active, 'disabled' => $disabled];
        return $this;
    }

    public function addDivider(): static
    {
        $this->items[] = ['type' => 'divider'];
        return $this;
    }

    public function addHeader(string $text): static
    {
        $this->items[] = ['type' => 'header', 'text' => $text];
        return $this;
    }

    public function items(array $items): static
    {
        foreach ($items as $item) {
            if (is_string($item)) {
                $this->addItem($item);
            } elseif (isset($item['type']) && $item['type'] === 'divider') {
                $this->addDivider();
            } elseif (isset($item['type']) && $item['type'] === 'header') {
                $this->addHeader($item['text']);
            } else {
                $this->addItem(
                    $item['label'] ?? '',
                    $item['url'] ?? null,
                    $item['active'] ?? false,
                    $item['disabled'] ?? false
                );
            }
        }
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
        $dropdownClasses = array_merge($fw->dropdown(), $this->extraClasses);
        $html = '<div' . Renderer::classes($dropdownClasses) . '>';

        $btnClasses = $fw->button($this->variant, 'medium');
        $html .= '<button class="' . implode(' ', $btnClasses) . ' dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
        $html .= Renderer::escape($this->label);
        $html .= '</button>';

        $menuClasses = $fw->dropdownMenu();
        $html .= '<ul' . Renderer::classes($menuClasses) . '>';

        foreach ($this->items as $item) {
            if ($item['type'] === 'divider') {
                $dividerClasses = $fw->dropdownDivider();
                $html .= '<li><hr' . Renderer::classes($dividerClasses) . '></li>';
            } elseif ($item['type'] === 'header') {
                $headerClasses = $fw->dropdownHeader();
                $html .= '<li' . Renderer::classes($headerClasses) . '>' . Renderer::escape($item['text']) . '</li>';
            } else {
                $itemClasses = $fw->dropdownItem($item['active'], $item['disabled']);
                $url = $item['url'] ?? '#';
                $html .= '<li><a class="' . implode(' ', $itemClasses) . '" href="' . Renderer::escape($url) . '">';
                $html .= Renderer::escape($item['label']);
                $html .= '</a></li>';
            }
        }

        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
