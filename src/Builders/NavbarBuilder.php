<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class NavbarBuilder implements Renderable
{
    protected string $brand;
    protected ?string $brandHref = null;
    protected array $links = [];
    protected array $extraClasses = [];
    protected ?string $variant = null;
    protected array $rightContent = [];

    public function __construct(string $brand)
    {
        $this->brand = $brand;
    }

    public function brandHref(string $href): static
    {
        $this->brandHref = $href;
        return $this;
    }

    public function link(string $label, string $href, bool $active = false): static
    {
        $this->links[] = ['label' => $label, 'href' => $href, 'active' => $active];
        return $this;
    }

    public function links(array $links): static
    {
        foreach ($links as $label => $href) {
            $this->links[] = ['label' => $label, 'href' => $href, 'active' => false];
        }
        return $this;
    }

    public function rightContent(Renderable $content): static
    {
        $this->rightContent[] = $content;
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

    public function variant(string $variant): static
    {
        $this->variant = $variant;
        return $this;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->navbar($this->variant), $this->extraClasses);
        $attrStr = Renderer::buildAttributes([], $classes);

        $html = "<nav{$attrStr}>";

        $brandHref = $this->brandHref ?? '#';
        $brandClasses = $fw->navbarBrand();
        $html .= "<a href='{$brandHref}'" . Renderer::classes($brandClasses) . ">{$this->brand}</a>";

        $linksClasses = $fw->navbarLinks();
        $html .= "<div" . Renderer::classes($linksClasses) . ">";

        foreach ($this->links as $link) {
            $linkClasses = $fw->navbarLink($link['active']);
            $html .= "<a href='{$link['href']}'" . Renderer::classes($linkClasses) . ">{$link['label']}</a>";
        }

        foreach ($this->rightContent as $content) {
            $html .= $content->render();
        }

        $html .= "</div>";
        $html .= "</nav>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
