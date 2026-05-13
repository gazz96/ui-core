<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class PageBuilder implements Renderable
{
    protected string $title;
    protected array $body = [];
    protected array $meta = [];
    protected array $cssFiles = [];
    protected array $jsFiles = [];
    protected string $inlineCss = '';
    protected string $inlineJs = '';
    protected ?string $lang = null;
    protected ?string $charset = null;
    protected ?string $favicon = null;
    protected bool $fullDocument = false;
    protected ?NavbarBuilder $navbar = null;
    protected ?SidebarBuilder $sidebar = null;
    protected array $bodyClasses = [];

    public function __construct(string $title, array $body = [])
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function fullDocument(bool $full = true): static
    {
        $this->fullDocument = $full;
        return $this;
    }

    public function lang(string $lang): static
    {
        $this->lang = $lang;
        return $this;
    }

    public function charset(string $charset): static
    {
        $this->charset = $charset;
        return $this;
    }

    public function meta(string $name, string $content): static
    {
        $this->meta[$name] = $content;
        return $this;
    }

    public function favicon(string $href): static
    {
        $this->favicon = $href;
        return $this;
    }

    public function css(string $href): static
    {
        $this->cssFiles[] = $href;
        return $this;
    }

    public function js(string $src): static
    {
        $this->jsFiles[] = $src;
        return $this;
    }

    public function inlineCss(string $css): static
    {
        $this->inlineCss .= $css;
        return $this;
    }

    public function inlineJs(string $js): static
    {
        $this->inlineJs .= $js;
        return $this;
    }

    public function navbar(NavbarBuilder $navbar): static
    {
        $this->navbar = $navbar;
        return $this;
    }

    public function sidebar(SidebarBuilder $sidebar): static
    {
        $this->sidebar = $sidebar;
        return $this;
    }

    public function bodyClass(string|array $class): static
    {
        if (is_string($class)) {
            $class = array_filter(explode(' ', $class));
        }
        $this->bodyClasses = array_merge($this->bodyClasses, $class);
        return $this;
    }

    public function add(Renderable $item): static
    {
        $this->body[] = $item;
        return $this;
    }

    protected function renderHead(): string
    {
        $fw = UI::framework();
        $html = '<head>';
        $html .= '<meta charset="' . ($this->charset ?? 'UTF-8') . '">';
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $html .= "<title>{$this->title}</title>";

        foreach ($this->meta as $name => $content) {
            $html .= "<meta name='{$name}' content='{$content}'>";
        }

        if ($this->favicon) {
            $html .= "<link rel='icon' href='{$this->favicon}'>";
        }

        if ($fw->requiresExternalCss()) {
            foreach ($fw->externalCssUrls() as $url) {
                $html .= "<link rel='stylesheet' href='{$url}'>";
            }
        }

        foreach ($this->cssFiles as $href) {
            $html .= "<link rel='stylesheet' href='{$href}'>";
        }

        $stylesheet = $fw->generateStylesheet();
        if ($stylesheet) {
            $html .= "<style>{$stylesheet}</style>";
        }

        if ($this->inlineCss) {
            $html .= "<style>{$this->inlineCss}</style>";
        }

        $html .= '</head>';

        return $html;
    }

    protected function renderBodyContent(): string
    {
        $fw = UI::framework();
        $html = '';

        if ($this->navbar) {
            $html .= $this->navbar->render();
        }

        if ($this->sidebar) {
            $html .= "<div" . Renderer::classes(['ui-flex', 'ui-flex-row']) . ">";
            $html .= $this->sidebar->render();
            $html .= "<main" . Renderer::classes(['ui-flex-1']) . ">";
            $html .= "<h1" . Renderer::classes($fw->pageTitle()) . ">{$this->title}</h1>";
            foreach ($this->body as $item) {
                $html .= $item->render();
            }
            $html .= "</main>";
            $html .= "</div>";
        } else {
            $html .= "<div" . Renderer::classes($fw->container(false, null)) . ">";
            $html .= "<h1" . Renderer::classes($fw->pageTitle()) . ">{$this->title}</h1>";
            foreach ($this->body as $item) {
                $html .= $item->render();
            }
            $html .= "</div>";
        }

        return $html;
    }

    protected function renderScripts(): string
    {
        $fw = UI::framework();
        $html = '';

        foreach ($fw->externalJsUrls() as $src) {
            $html .= "<script src='{$src}'></script>";
        }

        foreach ($this->jsFiles as $src) {
            $html .= "<script src='{$src}'></script>";
        }

        if ($this->inlineJs) {
            $html .= "<script>{$this->inlineJs}</script>";
        }

        return $html;
    }

    public function render(): string
    {
        $fw = UI::framework();

        if (!$this->fullDocument) {
            $html = "<h1" . Renderer::classes($fw->pageTitle()) . ">{$this->title}</h1>";
            foreach ($this->body as $item) {
                $html .= $item->render();
            }
            return $html;
        }

        $lang = $this->lang ?? 'id';
        $html = "<!DOCTYPE html><html lang='{$lang}'>";

        $html .= $this->renderHead();

        $bodyClasses = array_merge($fw->pageBody(), $this->bodyClasses);
        $html .= "<body" . Renderer::classes($bodyClasses) . ">";

        $html .= $this->renderBodyContent();
        $html .= $this->renderScripts();

        $html .= '</body></html>';

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
