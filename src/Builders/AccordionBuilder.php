<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class AccordionBuilder implements Renderable
{
    protected string $id;
    protected array $items = [];
    protected array $extraClasses = [];

    public function __construct(string $id = 'accordion')
    {
        $this->id = $id;
    }

    public function addItem(string $header, string $body, bool $open = false): static
    {
        $this->items[] = ['header' => $header, 'body' => $body, 'open' => $open];
        return $this;
    }

    public function items(array $items): static
    {
        foreach ($items as $item) {
            $this->addItem($item[0], $item[1], $item[2] ?? false);
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
        $classes = array_merge($fw->accordion(), $this->extraClasses);
        $html = '<div' . Renderer::buildAttributes(['id' => $this->id], $classes) . '>';

        foreach ($this->items as $index => $item) {
            $itemId = "{$this->id}-item-{$index}";
            $collapseId = "{$this->id}-collapse-{$index}";
            $isOpen = $item['open'];

            $itemClasses = $fw->accordionItem($isOpen);
            $html .= '<div' . Renderer::classes($itemClasses) . '>';

            $headerClasses = $fw->accordionHeader();
            $html .= '<h2' . Renderer::classes($headerClasses) . '>';

            $buttonClasses = $fw->accordionButton(!$isOpen);
            $buttonAttr = $isOpen ? '' : ' aria-expanded="false"';
            $html .= '<button class="' . implode(' ', $buttonClasses) . '" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-controls="' . $collapseId . '"' . $buttonAttr . '>';
            $html .= $item['header'];
            $html .= '</button>';
            $html .= '</h2>';

            $collapseClasses = $fw->accordionCollapse();
            $showClass = $isOpen ? ' show' : '';
            $html .= '<div id="' . $collapseId . '" class="' . implode(' ', $collapseClasses) . $showClass . '" data-bs-parent="#' . $this->id . '">';

            $bodyClasses = $fw->accordionBody();
            $html .= '<div' . Renderer::classes($bodyClasses) . '>';
            $html .= $item['body'];
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
