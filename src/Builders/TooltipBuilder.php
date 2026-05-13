<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class TooltipBuilder implements Renderable
{
    protected string $content;
    protected string $placement = 'top';
    protected string $trigger = 'hover';
    protected string $tag = 'span';
    protected string $text = '';
    protected array $extraClasses = [];
    protected array $attributes = [];

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function placement(string $placement): static
    {
        $this->placement = $placement;
        return $this;
    }

    public function top(): static { return $this->placement('top'); }
    public function bottom(): static { return $this->placement('bottom'); }
    public function start(): static { return $this->placement('start'); }
    public function end(): static { return $this->placement('end'); }

    public function trigger(string $trigger): static
    {
        $this->trigger = $trigger;
        return $this;
    }

    public function tag(string $tag): static
    {
        $this->tag = $tag;
        return $this;
    }

    public function text(string $text): static
    {
        $this->text = $text;
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

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->tooltip(), $this->extraClasses);

        $attrs = $this->attributes;
        $attrs['data-bs-toggle'] = 'tooltip';
        $attrs['data-bs-placement'] = $this->placement;
        $attrs['title'] = $this->content;

        if ($this->trigger !== 'hover') {
            $attrs['data-bs-trigger'] = $this->trigger;
        }

        $html = '<' . $this->tag . Renderer::buildAttributes($attrs, $classes) . '>';
        $html .= Renderer::escape($this->text ?: $this->content);
        $html .= '</' . $this->tag . '>';
        return $html;
    }

    public function renderScript(): string
    {
        return '<script>document.querySelectorAll(\'[data-bs-toggle="tooltip"]\').forEach(function(el){new bootstrap.Tooltip(el)});</script>';
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
