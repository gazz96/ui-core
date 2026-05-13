<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class ButtonGroupBuilder implements Renderable
{
    protected array $buttons = [];
    protected ?string $size = null;
    protected bool $toolbar = false;
    protected array $extraClasses = [];
    protected string $label = '';

    public function addButton(string $label, ?string $variant = null, array $attributes = []): static
    {
        $this->buttons[] = ['label' => $label, 'variant' => $variant, 'attributes' => $attributes];
        return $this;
    }

    public function buttons(array $buttons): static
    {
        foreach ($buttons as $button) {
            if (is_string($button)) {
                $this->addButton($button);
            } else {
                $this->addButton(
                    $button['label'] ?? '',
                    $button['variant'] ?? null,
                    $button['attributes'] ?? []
                );
            }
        }
        return $this;
    }

    public function size(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function small(): static
    {
        return $this->size('small');
    }

    public function large(): static
    {
        return $this->size('large');
    }

    public function toolbar(bool $toolbar = true): static
    {
        $this->toolbar = $toolbar;
        return $this;
    }

    public function label(string $label): static
    {
        $this->label = $label;
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

        if ($this->toolbar) {
            $classes = array_merge($fw->buttonToolbar(), $this->extraClasses);
            $html = '<div' . Renderer::buildAttributes(
                $this->label ? ['role' => 'toolbar', 'aria-label' => $this->label] : ['role' => 'toolbar'],
                $classes
            ) . '>';
            $groupClasses = $fw->buttonGroup($this->size);
            $html .= '<div' . Renderer::classes($groupClasses) . '>';
        } else {
            $classes = array_merge($fw->buttonGroup($this->size), $this->extraClasses);
            $html = '<div' . Renderer::buildAttributes(
                $this->label ? ['role' => 'group', 'aria-label' => $this->label] : ['role' => 'group'],
                $classes
            ) . '>';
        }

        foreach ($this->buttons as $btn) {
            $btnClasses = $fw->button($btn['variant'], $this->size);
            $attrs = '';
            foreach ($btn['attributes'] as $key => $value) {
                if (is_bool($value) && $value) {
                    $attrs .= " {$key}";
                } elseif (!is_bool($value)) {
                    $attrs .= " {$key}=\"" . htmlspecialchars((string)$value, ENT_COMPAT, 'UTF-8') . "\"";
                }
            }
            $html .= '<button type="button" class="' . implode(' ', $btnClasses) . "\"{$attrs}>" . Renderer::escape($btn['label']) . '</button>';
        }

        $html .= '</div>';
        if ($this->toolbar) {
            $html .= '</div>';
        }

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
