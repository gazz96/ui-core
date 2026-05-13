<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;

class UtilityBuilder implements Renderable
{
    protected array $classes = [];
    protected array $attributes = [];
    protected string $tag = 'div';
    protected ?string $content = null;
    protected array $children = [];

    public function __construct(array $classes = [])
    {
        $this->classes = $classes;
    }

    public function tag(string $tag): static
    {
        $this->tag = $tag;
        return $this;
    }

    public function content(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function child(Renderable|string $child): static
    {
        $this->children[] = is_string($child) ? new class($child) implements Renderable {
            public function __construct(private string $text) {}
            public function render(): string { return $this->text; }
        } : $child;
        return $this;
    }

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function id(string $id): static
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function add(string|array $classes): static
    {
        if (is_string($classes)) {
            $classes = array_filter(explode(' ', $classes));
        }
        $this->classes = array_merge($this->classes, $classes);
        return $this;
    }

    public function spacing(string $property, ?string $side, string $size, ?string $breakpoint = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('spacing', [
            'property' => $property,
            'side' => $side,
            'size' => $size,
            'breakpoint' => $breakpoint,
        ]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function m(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', null, $size, $breakpoint);
    }

    public function mt(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', 'top', $size, $breakpoint);
    }

    public function mb(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', 'bottom', $size, $breakpoint);
    }

    public function ms(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', 'start', $size, $breakpoint);
    }

    public function me(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', 'end', $size, $breakpoint);
    }

    public function mx(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', 'x', $size, $breakpoint);
    }

    public function my(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('margin', 'y', $size, $breakpoint);
    }

    public function p(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', null, $size, $breakpoint);
    }

    public function pt(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', 'top', $size, $breakpoint);
    }

    public function pb(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', 'bottom', $size, $breakpoint);
    }

    public function ps(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', 'start', $size, $breakpoint);
    }

    public function pe(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', 'end', $size, $breakpoint);
    }

    public function px(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', 'x', $size, $breakpoint);
    }

    public function py(string $size, ?string $breakpoint = null): static
    {
        return $this->spacing('padding', 'y', $size, $breakpoint);
    }

    public function gap(string $size, ?string $breakpoint = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('gap', ['size' => $size, 'breakpoint' => $breakpoint]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function display(string $value, ?string $breakpoint = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('display', ['value' => $value, 'breakpoint' => $breakpoint]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function d(?string $breakpoint = null): static
    {
        return $this->display('block', $breakpoint);
    }

    public function dNone(?string $breakpoint = null): static
    {
        return $this->display('none', $breakpoint);
    }

    public function dFlex(?string $breakpoint = null): static
    {
        return $this->display('flex', $breakpoint);
    }

    public function dInline(?string $breakpoint = null): static
    {
        return $this->display('inline', $breakpoint);
    }

    public function dInlineBlock(?string $breakpoint = null): static
    {
        return $this->display('inline-block', $breakpoint);
    }

    public function dGrid(?string $breakpoint = null): static
    {
        return $this->display('grid', $breakpoint);
    }

    public function flexDirection(string $direction): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('flexDirection', ['value' => $direction]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function flexRow(): static
    {
        return $this->flexDirection('row');
    }

    public function flexCol(): static
    {
        return $this->flexDirection('column');
    }

    public function flexWrap(string $value = 'wrap'): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('flexWrap', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function alignItems(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('alignItems', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function justify(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('justifyContent', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function text(string $property, string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('text', ['property' => $property, 'value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function textAlign(string $value): static
    {
        return $this->text('align', $value);
    }

    public function textColor(string $value): static
    {
        return $this->text('color', $value);
    }

    public function textSize(string $value): static
    {
        return $this->text('size', $value);
    }

    public function textWeight(string $value): static
    {
        return $this->text('weight', $value);
    }

    public function textTransform(string $value): static
    {
        return $this->text('transform', $value);
    }

    public function textDecoration(string $value): static
    {
        return $this->text('decoration', $value);
    }

    public function textWrap(string $value = 'wrap'): static
    {
        return $this->text('wrap', $value);
    }

    public function bg(string $value, ?string $gradient = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('background', ['value' => $value, 'gradient' => $gradient]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function bgColor(string $value): static
    {
        return $this->bg($value);
    }

    public function bgGradient(string $value): static
    {
        return $this->bg($value, 'gradient');
    }

    public function bgOpacity(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('bgOpacity', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function border(string $value = '', ?string $side = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('border', ['value' => $value, 'side' => $side]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function borderTop(): static
    {
        return $this->border('', 'top');
    }

    public function borderBottom(): static
    {
        return $this->border('', 'bottom');
    }

    public function borderStart(): static
    {
        return $this->border('', 'start');
    }

    public function borderEnd(): static
    {
        return $this->border('', 'end');
    }

    public function border0(?string $side = null): static
    {
        return $this->border('0', $side);
    }

    public function borderColor(string $value): static
    {
        return $this->border($value);
    }

    public function borderRadius(string $value = '', ?string $side = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('borderRadius', ['value' => $value, 'side' => $side]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function rounded(string $value = ''): static
    {
        return $this->borderRadius($value);
    }

    public function roundedTop(): static
    {
        return $this->borderRadius('', 'top');
    }

    public function roundedBottom(): static
    {
        return $this->borderRadius('', 'bottom');
    }

    public function roundedStart(): static
    {
        return $this->borderRadius('', 'start');
    }

    public function roundedEnd(): static
    {
        return $this->borderRadius('', 'end');
    }

    public function roundedCircle(): static
    {
        return $this->borderRadius('circle');
    }

    public function roundedPill(): static
    {
        return $this->borderRadius('pill');
    }

    public function w(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('width', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function h(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('height', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function mw(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('maxWidth', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function mh(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('maxHeight', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function vw(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('viewportWidth', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function vh(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('viewportHeight', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function position(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('position', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function top(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('top', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function bottom(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('bottom', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function start(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('start', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function end(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('end', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function overflow(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('overflow', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function shadow(?string $value = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('shadow', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function opacity(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('opacity', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function zIndex(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('zIndex', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function float(string $value, ?string $breakpoint = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('float', ['value' => $value, 'breakpoint' => $breakpoint]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function clear(string $value = 'both'): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('clear', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function cursor(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('cursor', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function userSelect(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('userSelect', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function pointerEvents(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('pointerEvents', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function visibility(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('visibility', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function order(string $value): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('order', ['value' => $value]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function col(string $value, ?string $breakpoint = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('col', ['value' => $value, 'breakpoint' => $breakpoint]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function offset(string $value, ?string $breakpoint = null): static
    {
        $fw = UI::framework();
        $class = $fw->resolveUtility('offset', ['value' => $value, 'breakpoint' => $breakpoint]);
        if ($class) {
            $this->classes[] = $class;
        }
        return $this;
    }

    public function getClasses(): array
    {
        return array_unique(array_filter($this->classes));
    }

    public function render(): string
    {
        $inner = $this->content ?? '';
        foreach ($this->children as $child) {
            $inner .= $child->render();
        }

        return \BagasTopati\UiCore\Rendering\Renderer::tag(
            $this->tag,
            $inner,
            $this->attributes,
            $this->getClasses()
        );
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
