<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class CardBuilder implements Renderable
{
    protected string $title;
    protected string|int|null $value = null;
    protected ?string $subtitle = null;
    protected ?string $footer = null;
    protected ?string $image = null;
    protected ?string $variant = null;
    protected array $extraClasses = [];
    protected array $attributes = [];
    protected array $body = [];

    public function __construct(string $title, string|int|null $value = null)
    {
        $this->title = $title;
        $this->value = $value;
    }

    public function subtitle(string $subtitle): static
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function footer(string $footer): static
    {
        $this->footer = $footer;
        return $this;
    }

    public function image(string $src): static
    {
        $this->image = $src;
        return $this;
    }

    public function variant(string $variant): static
    {
        $this->variant = $variant;
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

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->card($this->variant), $this->extraClasses);
        $attrStr = Renderer::buildAttributes($this->attributes, $classes);

        $html = "<div{$attrStr}>";

        if ($this->image) {
            $imgClasses = $fw->cardImage();
            $html .= "<img src='{$this->image}' alt='{$this->title}'" . Renderer::classes($imgClasses) . ">";
        }

        $bodyClasses = $fw->cardBody();
        $html .= "<div" . Renderer::classes($bodyClasses) . ">";

        $html .= "<small>{$this->title}</small>";

        if ($this->value !== null) {
            $html .= "<h2>{$this->value}</h2>";
        }

        if ($this->subtitle) {
            $html .= "<p>{$this->subtitle}</p>";
        }

        foreach ($this->body as $item) {
            $html .= $item->render();
        }

        $html .= "</div>";

        if ($this->footer) {
            $footerClasses = $fw->cardFooter();
            $html .= "<div" . Renderer::classes($footerClasses) . ">{$this->footer}</div>";
        }

        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
