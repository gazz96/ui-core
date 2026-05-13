<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;

class ElementBuilder implements Renderable
{
    protected string $tag;
    protected ?string $content = null;
    protected array $attributes = [];
    protected array $classes = [];
    protected array $children = [];

    public function __construct(string $tag, ?string $content = null)
    {
        $this->tag = $tag;
        $this->content = $content;
    }

    public static function make(string $tag, ?string $content = null): static
    {
        return new static($tag, $content);
    }

    public function div(?string $content = null): static
    {
        return $this->child(new static('div', $content));
    }

    public function span(?string $content = null): static
    {
        return $this->child(new static('span', $content));
    }

    public function h1(?string $content = null): static
    {
        return $this->child(new static('h1', $content));
    }

    public function h2(?string $content = null): static
    {
        return $this->child(new static('h2', $content));
    }

    public function h3(?string $content = null): static
    {
        return $this->child(new static('h3', $content));
    }

    public function h4(?string $content = null): static
    {
        return $this->child(new static('h4', $content));
    }

    public function h5(?string $content = null): static
    {
        return $this->child(new static('h5', $content));
    }

    public function h6(?string $content = null): static
    {
        return $this->child(new static('h6', $content));
    }

    public function p(?string $content = null): static
    {
        return $this->child(new static('p', $content));
    }

    public function a(string $href, ?string $content = null): static
    {
        $el = new static('a', $content);
        $el->attr('href', $href);
        return $this->child($el);
    }

    public function img(string $src, ?string $alt = null): static
    {
        $el = new static('img');
        $el->attr('src', $src);
        if ($alt !== null) {
            $el->attr('alt', $alt);
        }
        return $this->child($el);
    }

    public function button(string $content, string $type = 'button'): static
    {
        $el = new static('button', $content);
        $el->attr('type', $type);
        return $this->child($el);
    }

    public function hr(): static
    {
        return $this->child(new static('hr'));
    }

    public function br(): static
    {
        return $this->child(new static('br'));
    }

    public function strong(?string $content = null): static
    {
        return $this->child(new static('strong', $content));
    }

    public function em(?string $content = null): static
    {
        return $this->child(new static('em', $content));
    }

    public function small(?string $content = null): static
    {
        return $this->child(new static('small', $content));
    }

    public function section(?string $content = null): static
    {
        return $this->child(new static('section', $content));
    }

    public function header(?string $content = null): static
    {
        return $this->child(new static('header', $content));
    }

    public function footer(?string $content = null): static
    {
        return $this->child(new static('footer', $content));
    }

    public function nav(?string $content = null): static
    {
        return $this->child(new static('nav', $content));
    }

    public function main(?string $content = null): static
    {
        return $this->child(new static('main', $content));
    }

    public function aside(?string $content = null): static
    {
        return $this->child(new static('aside', $content));
    }

    public function child(Renderable|string $child): static
    {
        if (is_string($child)) {
            $this->children[] = new class($child) implements Renderable {
                public function __construct(private string $text) {}
                public function render(): string
                {
                    return $this->text;
                }
            };
        } else {
            $this->children[] = $child;
        }

        return $this;
    }

    public function children(array $children): static
    {
        foreach ($children as $child) {
            $this->child($child);
        }

        return $this;
    }

    public function content(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function attrs(array $attributes): static
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    public function id(string $id): static
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    public function class(string|array $class): static
    {
        if (is_string($class)) {
            $class = array_filter(explode(' ', $class));
        }

        $this->classes = array_merge($this->classes, $class);
        return $this;
    }

    public function data(string $key, string|int|bool|null $value = true): static
    {
        $this->attributes['data-' . $key] = $value;
        return $this;
    }

    public function utilities(UtilityBuilder $utility): static
    {
        $this->classes = array_merge($this->classes, $utility->getClasses());
        return $this;
    }

    public function render(): string
    {
        $inner = $this->content ?? '';

        foreach ($this->children as $child) {
            $inner .= $child->render();
        }

        return Renderer::tag(
            $this->tag,
            $inner,
            $this->attributes,
            $this->classes
        );
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
