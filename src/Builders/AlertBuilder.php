<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class AlertBuilder implements Renderable
{
    protected string $message;
    protected ?string $title = null;
    protected string $variant = 'info';
    protected bool $dismissible = false;
    protected array $extraClasses = [];

    public function __construct(string $message, string $variant = 'info')
    {
        $this->message = $message;
        $this->variant = $variant;
    }

    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function dismissible(bool $dismissible = true): static
    {
        $this->dismissible = $dismissible;
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
        $classes = array_merge($fw->alert($this->variant), $this->extraClasses);
        $attrStr = Renderer::buildAttributes([], $classes);

        $html = "<div{$attrStr}>";

        $bodyClasses = $fw->alertBody();
        $html .= "<div" . Renderer::classes($bodyClasses) . ">";

        if ($this->title) {
            $titleClasses = $fw->alertTitle();
            $html .= "<span" . Renderer::classes($titleClasses) . ">{$this->title}</span>";
        }

        $html .= "<div>{$this->message}</div>";
        $html .= "</div>";

        if ($this->dismissible) {
            $dismissClasses = $fw->alertDismiss();
            $html .= "<button type='button' onclick='this.parentElement.remove()'" . Renderer::classes($dismissClasses) . ">×</button>";
        }

        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
