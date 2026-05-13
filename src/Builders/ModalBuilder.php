<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class ModalBuilder implements Renderable
{
    protected string $id;
    protected string $title;
    protected array $body = [];
    protected array $footer = [];
    protected array $extraClasses = [];
    protected string $size = 'medium';
    protected bool $centered = true;

    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function body(array $items): static
    {
        $this->body = $items;
        return $this;
    }

    public function addBody(Renderable $item): static
    {
        $this->body[] = $item;
        return $this;
    }

    public function footer(array $items): static
    {
        $this->footer = $items;
        return $this;
    }

    public function addFooter(Renderable $item): static
    {
        $this->footer[] = $item;
        return $this;
    }

    public function size(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function centered(bool $centered = true): static
    {
        $this->centered = $centered;
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

        $overlayClasses = array_merge($fw->modalOverlay(), $this->extraClasses);
        $overlayAttr = Renderer::buildAttributes(['id' => $this->id], $overlayClasses);

        $dialogClasses = $fw->modalDialog($this->size, $this->centered);
        $dialogAttr = Renderer::buildAttributes([], $dialogClasses);

        $contentClasses = $fw->modalContent();
        $contentAttr = Renderer::buildAttributes([], $contentClasses);

        $html = "<div{$overlayAttr}>";
        $html .= "<div{$dialogAttr}>";
        $html .= "<div{$contentAttr}>";

        $headerClasses = $fw->modalHeader();
        $html .= "<div" . Renderer::classes($headerClasses) . ">";
        $html .= "<h3>{$this->title}</h3>";

        $closeScript = $fw->modalHideScript($this->id);
        $closeClasses = $fw->modalClose();
        $html .= "<button type='button' onclick=\"{$closeScript}\"" . Renderer::classes($closeClasses) . " aria-label='Close'></button>";
        $html .= "</div>";

        $bodyClasses = $fw->modalBody();
        $html .= "<div" . Renderer::classes($bodyClasses) . ">";
        foreach ($this->body as $item) {
            $html .= $item->render();
        }
        $html .= "</div>";

        if (!empty($this->footer)) {
            $footerClasses = $fw->modalFooter();
            $html .= "<div" . Renderer::classes($footerClasses) . ">";
            foreach ($this->footer as $item) {
                $html .= $item->render();
            }
            $html .= "</div>";
        }

        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
