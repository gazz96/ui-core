<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class ContainerBuilder implements Renderable
{
    protected array $children = [];
    protected array $extraClasses = [];
    protected bool $fluid = false;

    public function __construct(array $children = [])
    {
        $this->children = $children;
    }

    public function add(Renderable $child): static
    {
        $this->children[] = $child;
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

    public function fluid(bool $fluid = true): static
    {
        $this->fluid = $fluid;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->container($this->fluid, null), $this->extraClasses);
        $attrStr = Renderer::buildAttributes([], $classes);

        $html = "<div{$attrStr}>";

        foreach ($this->children as $child) {
            $html .= $child->render();
        }

        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
