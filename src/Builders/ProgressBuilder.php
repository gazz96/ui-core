<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class ProgressBuilder implements Renderable
{
    protected array $bars = [];
    protected array $extraClasses = [];
    protected int $height = 0;

    public function addBar(int $value, ?string $variant = null, bool $striped = false, bool $animated = false, ?string $label = null): static
    {
        $this->bars[] = [
            'value' => min(100, max(0, $value)),
            'variant' => $variant,
            'striped' => $striped,
            'animated' => $animated,
            'label' => $label,
        ];
        return $this;
    }

    public function bar(int $value, ?string $variant = null): static
    {
        return $this->addBar($value, $variant);
    }

    public function striped(int $value, ?string $variant = null): static
    {
        return $this->addBar($value, $variant, true);
    }

    public function animated(int $value, ?string $variant = null): static
    {
        return $this->addBar($value, $variant, true, true);
    }

    public function height(int $px): static
    {
        $this->height = $px;
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
        $classes = array_merge($fw->progress(), $this->extraClasses);
        $styleAttr = $this->height > 0 ? ' style="height: ' . $this->height . 'px"' : '';

        $html = '<div class="' . implode(' ', $classes) . '"' . $styleAttr . '>';

        foreach ($this->bars as $bar) {
            $barClasses = $fw->progressBar($bar['variant'], $bar['striped'], $bar['animated']);
            $label = $bar['label'] ?? $bar['value'] . '%';
            $html .= '<div class="' . implode(' ', $barClasses) . '" role="progressbar" style="width: ' . $bar['value'] . '%" aria-valuenow="' . $bar['value'] . '" aria-valuemin="0" aria-valuemax="100">' . Renderer::escape($label) . '</div>';
        }

        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
