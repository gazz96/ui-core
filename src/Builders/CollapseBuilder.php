<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class CollapseBuilder implements Renderable
{
    protected string $id;
    protected string $triggerLabel = 'Toggle';
    protected ?string $triggerVariant = null;
    protected array $content = [];
    protected bool $defaultOpen = false;
    protected array $extraClasses = [];

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function triggerLabel(string $label): static
    {
        $this->triggerLabel = $label;
        return $this;
    }

    public function triggerVariant(string $variant): static
    {
        $this->triggerVariant = $variant;
        return $this;
    }

    public function content(string|Renderable $content): static
    {
        $this->content[] = $content;
        return $this;
    }

    public function defaultOpen(bool $open = true): static
    {
        $this->defaultOpen = $open;
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
        $btnClasses = $fw->button($this->triggerVariant, 'medium');
        $html = '<p>';
        $html .= '<button class="' . implode(' ', $btnClasses) . '" type="button" data-bs-toggle="collapse" data-bs-target="#' . $this->id . '" aria-expanded="' . ($this->defaultOpen ? 'true' : 'false') . '" aria-controls="' . $this->id . '">';
        $html .= Renderer::escape($this->triggerLabel);
        $html .= '</button>';
        $html .= '</p>';

        $collapseClasses = $fw->collapse();
        $showClass = $this->defaultOpen ? ' show' : '';
        $classes = array_merge($collapseClasses, $this->extraClasses);
        $html .= '<div class="' . implode(' ', $classes) . $showClass . '" id="' . $this->id . '">';

        foreach ($this->content as $item) {
            $html .= $item instanceof Renderable ? $item->render() : $item;
        }

        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
