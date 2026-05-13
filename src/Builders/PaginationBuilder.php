<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class PaginationBuilder implements Renderable
{
    protected int $currentPage = 1;
    protected int $totalPages = 1;
    protected ?string $baseUrl = null;
    protected int $maxVisible = 5;
    protected bool $showArrows = true;
    protected bool $showFirstLast = false;
    protected string $size = 'medium';
    protected array $extraClasses = [];

    public function __construct(int $currentPage = 1, int $totalPages = 1)
    {
        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
    }

    public function currentPage(int $page): static
    {
        $this->currentPage = $page;
        return $this;
    }

    public function totalPages(int $total): static
    {
        $this->totalPages = $total;
        return $this;
    }

    public function baseUrl(string $url): static
    {
        $this->baseUrl = $url;
        return $this;
    }

    public function maxVisible(int $max): static
    {
        $this->maxVisible = $max;
        return $this;
    }

    public function showArrows(bool $show = true): static
    {
        $this->showArrows = $show;
        return $this;
    }

    public function showFirstLast(bool $show = true): static
    {
        $this->showFirstLast = $show;
        return $this;
    }

    public function size(string $size): static
    {
        $this->size = $size;
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

    protected function getPageUrl(int $page): string
    {
        if ($this->baseUrl) {
            return str_replace('{page}', (string)$page, $this->baseUrl);
        }
        return '#' . $page;
    }

    protected function renderPageItem(string $label, int $page, bool $active = false, bool $disabled = false): string
    {
        $fw = UI::framework();
        $itemClasses = $fw->paginationItem($active, $disabled);
        $linkClasses = $fw->paginationLink($active, $disabled);

        $html = '<li' . Renderer::classes($itemClasses) . '>';
        if ($disabled) {
            $html .= '<span class="' . implode(' ', $linkClasses) . '">' . Renderer::escape($label) . '</span>';
        } elseif ($active) {
            $html .= '<span class="' . implode(' ', $linkClasses) . '">' . Renderer::escape($label) . '</span>';
        } else {
            $html .= '<a class="' . implode(' ', $linkClasses) . '" href="' . Renderer::escape($this->getPageUrl($page)) . '">' . Renderer::escape($label) . '</a>';
        }
        $html .= '</li>';
        return $html;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $classes = array_merge($fw->pagination(), $this->extraClasses);
        $html = '<ul' . Renderer::classes($classes) . '>';

        if ($this->showFirstLast && $this->currentPage > 1) {
            $html .= $this->renderPageItem('First', 1);
        }

        if ($this->showArrows && $this->currentPage > 1) {
            $html .= $this->renderPageItem('Previous', $this->currentPage - 1);
        } elseif ($this->showArrows) {
            $html .= $this->renderPageItem('Previous', $this->currentPage, false, true);
        }

        $start = max(1, $this->currentPage - floor($this->maxVisible / 2));
        $end = min($this->totalPages, $start + $this->maxVisible - 1);
        if ($end - $start < $this->maxVisible - 1) {
            $start = max(1, $end - $this->maxVisible + 1);
        }

        for ($i = $start; $i <= $end; $i++) {
            $html .= $this->renderPageItem((string)$i, $i, $i === $this->currentPage);
        }

        if ($this->showArrows && $this->currentPage < $this->totalPages) {
            $html .= $this->renderPageItem('Next', $this->currentPage + 1);
        } elseif ($this->showArrows) {
            $html .= $this->renderPageItem('Next', $this->currentPage, false, true);
        }

        if ($this->showFirstLast && $this->currentPage < $this->totalPages) {
            $html .= $this->renderPageItem('Last', $this->totalPages);
        }

        $html .= '</ul>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
