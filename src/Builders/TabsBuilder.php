<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class TabsBuilder implements Renderable
{
    protected array $tabs = [];
    protected array $extraClasses = [];

    public function __construct()
    {
    }

    public function tab(string $label, Renderable $content, bool $active = false): static
    {
        $id = 'tab_' . count($this->tabs);
        $this->tabs[] = [
            'id' => $id,
            'label' => $label,
            'content' => $content,
            'active' => $active || empty($this->tabs),
        ];
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

    public function render(): string
    {
        $fw = UI::framework();

        $containerClasses = array_merge($fw->tabsContainer(), $this->extraClasses);
        $html = "<div" . Renderer::classes($containerClasses) . ">";

        $navClasses = $fw->tabsNav();
        $html .= "<div" . Renderer::classes($navClasses) . ">";
        foreach ($this->tabs as $tab) {
            $btnClasses = $fw->tabButton($tab['active']);
            $onclick = "";
            foreach ($this->tabs as $t) {
                $onclick .= "document.getElementById('{$t['id']}_content').style.display='none';";
            }
            $onclick .= "document.getElementById('{$tab['id']}_content').style.display='block';";
            foreach ($this->tabs as $t) {
                $onclick .= "document.getElementById('{$t['id']}_btn').className=document.getElementById('{$t['id']}_btn').className.replace(/\bui-tab-btn-active\b/g,'');";
            }
            $onclick .= "document.getElementById('{$tab['id']}_btn').className+=' ui-tab-btn-active';";

            $html .= "<button type='button' id='{$tab['id']}_btn' onclick=\"{$onclick}\"" . Renderer::classes($btnClasses) . ">";
            $html .= $tab['label'];
            $html .= "</button>";
        }
        $html .= "</div>";

        foreach ($this->tabs as $tab) {
            $display = $tab['active'] ? 'block' : 'none';
            $contentClasses = $fw->tabContent();
            $html .= "<div id='{$tab['id']}_content' style='display:{$display}'" . Renderer::classes($contentClasses) . ">";
            $html .= $tab['content']->render();
            $html .= "</div>";
        }

        $html .= "</div>";

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
