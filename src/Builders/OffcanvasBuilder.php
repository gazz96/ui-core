<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class OffcanvasBuilder implements Renderable
{
    protected string $id;
    protected string $title;
    protected string $placement = 'start';
    protected array $body = [];
    protected array $footer = [];
    protected array $extraClasses = [];

    public function __construct(string $id, string $title = '')
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function placement(string $placement): static
    {
        $this->placement = $placement;
        return $this;
    }

    public function start(): static { return $this->placement('start'); }
    public function end(): static { return $this->placement('end'); }
    public function top(): static { return $this->placement('top'); }
    public function bottom(): static { return $this->placement('bottom'); }

    public function addBody(string|Renderable $content): static
    {
        $this->body[] = $content;
        return $this;
    }

    public function addFooter(Renderable $content): static
    {
        $this->footer[] = $content;
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
        $classes = array_merge($fw->offcanvas($this->placement), $this->extraClasses);
        $html = '<div' . Renderer::buildAttributes(['id' => $this->id, 'tabindex' => '-1'], $classes) . '>';

        $headerClasses = $fw->offcanvasHeader();
        $html .= '<div class="' . implode(' ', $headerClasses) . '">';
        $html .= '<h5 class="offcanvas-title">' . Renderer::escape($this->title) . '</h5>';
        $closeScript = $fw->offcanvasHideScript($this->id);
        $closeClasses = $fw->modalClose();
        $html .= '<button type="button" class="' . implode(' ', $closeClasses) . '" onclick="' . $closeScript . '" aria-label="Close"></button>';
        $html .= '</div>';

        $bodyClasses = $fw->offcanvasBody();
        $html .= '<div class="' . implode(' ', $bodyClasses) . '">';
        foreach ($this->body as $item) {
            $html .= $item instanceof Renderable ? $item->render() : $item;
        }
        $html .= '</div>';

        if (!empty($this->footer)) {
            foreach ($this->footer as $item) {
                $html .= $item->render();
            }
        }

        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
