<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class ToastBuilder implements Renderable
{
    protected string $id;
    protected string $title = '';
    protected string $body = '';
    protected ?string $variant = null;
    protected bool $dismissible = true;
    protected bool $autoHide = true;
    protected int $delay = 5000;
    protected array $extraClasses = [];

    public function __construct(string $id = '')
    {
        $this->id = $id ?: 'toast-' . substr(md5(uniqid()), 0, 8);
    }

    public function title(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function body(string $body): static
    {
        $this->body = $body;
        return $this;
    }

    public function variant(string $variant): static
    {
        $this->variant = $variant;
        return $this;
    }

    public function dismissible(bool $dismissible = true): static
    {
        $this->dismissible = $dismissible;
        return $this;
    }

    public function autoHide(bool $autoHide = true): static
    {
        $this->autoHide = $autoHide;
        return $this;
    }

    public function delay(int $ms): static
    {
        $this->delay = $ms;
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
        $classes = array_merge($fw->toast(), $this->extraClasses);
        $extraAttr = '';
        if (!$this->autoHide) {
            $extraAttr .= ' data-bs-autohide="false"';
        } else {
            $extraAttr .= ' data-bs-delay="' . $this->delay . '"';
        }

        $html = '<div class="' . implode(' ', $classes) . '" role="alert" aria-live="assertive" aria-atomic="true"' . $extraAttr . ' id="' . $this->id . '">';

        if ($this->title) {
            $headerClasses = $fw->toastHeader();
            $html .= '<div class="' . implode(' ', $headerClasses) . '">';
            if ($this->variant) {
                $html .= '<span class="badge bg-' . $this->variant . ' me-auto"></span>';
            }
            $html .= '<strong class="me-auto">' . Renderer::escape($this->title) . '</strong>';
            $html .= '<small>just now</small>';
            if ($this->dismissible) {
                $closeClasses = $fw->modalClose();
                $html .= '<button type="button" class="' . implode(' ', $closeClasses) . '" data-bs-dismiss="toast" aria-label="Close"></button>';
            }
            $html .= '</div>';
        }

        $bodyClasses = $fw->toastBody();
        $html .= '<div class="' . implode(' ', $bodyClasses) . '">';
        $html .= Renderer::escape($this->body);
        $html .= '</div>';

        $html .= '</div>';
        return $html;
    }

    public function renderWithTrigger(): string
    {
        $btnClasses = UI::framework()->button($this->variant, 'medium');
        $html = '<button type="button" class="' . implode(' ', $btnClasses) . '" onclick="new bootstrap.Toast(document.getElementById(\'' . $this->id . '\')).show()">';
        $html .= 'Show Toast';
        $html .= '</button>';
        $html .= $this->render();
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
