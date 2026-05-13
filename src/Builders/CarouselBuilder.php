<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\UI;
use BagasTopati\UiCore\Rendering\Renderer;

class CarouselBuilder implements Renderable
{
    protected string $id;
    protected array $slides = [];
    protected bool $showControls = true;
    protected bool $showIndicators = true;
    protected array $extraClasses = [];

    public function __construct(string $id = 'carousel')
    {
        $this->id = $id;
    }

    public function addSlide(string $content, ?string $caption = null, bool $active = false): static
    {
        $this->slides[] = ['content' => $content, 'caption' => $caption, 'active' => $active];
        return $this;
    }

    public function slides(array $slides): static
    {
        $first = true;
        foreach ($slides as $slide) {
            if (is_string($slide)) {
                $this->addSlide($slide, null, $first);
            } else {
                $this->addSlide(
                    $slide['content'] ?? '',
                    $slide['caption'] ?? null,
                    $first && !isset($slide['active']) ? true : ($slide['active'] ?? false)
                );
            }
            $first = false;
        }
        return $this;
    }

    public function showControls(bool $show = true): static
    {
        $this->showControls = $show;
        return $this;
    }

    public function showIndicators(bool $show = true): static
    {
        $this->showIndicators = $show;
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
        $classes = array_merge($fw->carousel(), $this->extraClasses);
        $html = '<div' . Renderer::buildAttributes(['id' => $this->id], $classes) . ' data-bs-ride="carousel">';

        if ($this->showIndicators && count($this->slides) > 1) {
            $html .= '<div class="carousel-indicators">';
            foreach ($this->slides as $index => $slide) {
                $indicatorClasses = $fw->carouselIndicator($slide['active']);
                $html .= '<button type="button" data-bs-target="#' . $this->id . '" data-bs-slide-to="' . $index . '"';
                if (!empty($indicatorClasses)) {
                    $html .= ' class="' . implode(' ', $indicatorClasses) . '"';
                }
                if ($slide['active']) {
                    $html .= ' aria-current="true"';
                }
                $html .= '></button>';
            }
            $html .= '</div>';
        }

        $innerClasses = $fw->carouselInner();
        $html .= '<div class="' . implode(' ', $innerClasses) . '">';

        foreach ($this->slides as $slide) {
            $itemClasses = $fw->carouselItem($slide['active']);
            $html .= '<div class="' . implode(' ', $itemClasses) . '">';
            $html .= $slide['content'];
            if ($slide['caption']) {
                $html .= '<div class="carousel-caption d-none d-md-block"><p>' . $slide['caption'] . '</p></div>';
            }
            $html .= '</div>';
        }

        $html .= '</div>';

        if ($this->showControls && count($this->slides) > 1) {
            $prevClasses = $fw->carouselControl('prev');
            $html .= '<button class="' . implode(' ', $prevClasses) . '" type="button" data-bs-target="#' . $this->id . '" data-bs-slide="prev">';
            $html .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>';
            $html .= '</button>';

            $nextClasses = $fw->carouselControl('next');
            $html .= '<button class="' . implode(' ', $nextClasses) . '" type="button" data-bs-target="#' . $this->id . '" data-bs-slide="next">';
            $html .= '<span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span>';
            $html .= '</button>';
        }

        $html .= '</div>';
        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
