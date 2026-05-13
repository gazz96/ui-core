<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class SidebarBuilder implements Renderable
{
    protected array $items = [];
    protected array $extraClasses = [];
    protected ?string $header = null;
    protected ?string $variant = null;

    public function __construct()
    {
    }

    public function header(string $header): static
    {
        $this->header = $header;
        return $this;
    }

    public function item(string $label, string $href, ?string $icon = null, bool $active = false): static
    {
        $this->items[] = ['label' => $label, 'href' => $href, 'icon' => $icon, 'active' => $active];
        return $this;
    }

    public function items(array $items): static
    {
        foreach ($items as $label => $href) {
            $this->items[] = ['label' => $label, 'href' => $href, 'icon' => null, 'active' => false];
        }
        return $this;
    }

    public function divider(): static
    {
        $this->items[] = ['type' => 'divider'];
        return $this;
    }

    public function heading(string $text): static
    {
        $this->items[] = ['type' => 'heading', 'text' => $text];
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

    public function variant(string $variant): static
    {
        $this->variant = $variant;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->sidebar($this->variant), $this->extraClasses);
        $attrStr = Renderer::buildAttributes([], $classes);

        $html = "<aside{$attrStr}>";

        if ($this->header) {
            $headerClasses = $fw->sidebarHeader();
            $html .= "<div" . Renderer::classes($headerClasses) . ">{$this->header}</div>";
        }

        foreach ($this->items as $item) {
            if (isset($item['type']) && $item['type'] === 'divider') {
                $dividerClasses = $fw->sidebarDivider();
                $html .= "<hr" . Renderer::classes($dividerClasses) . ">";
                continue;
            }

            if (isset($item['type']) && $item['type'] === 'heading') {
                $headingClasses = $fw->sidebarHeading();
                $html .= "<div" . Renderer::classes($headingClasses) . ">{$item['text']}</div>";
                continue;
            }

            $isActive = $item['active'] ?? false;
            $itemClasses = $fw->sidebarItem($isActive);
            $html .= "<a href='{$item['href']}'" . Renderer::classes($itemClasses) . ">";

            if ($item['icon']) {
                $html .= "<span>{$item['icon']}</span> ";
            }

            $html .= $item['label'];
            $html .= "</a>";
        }

        $html .= "</aside>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
