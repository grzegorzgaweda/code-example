<?php


namespace App\Services\Menu;


use SplObjectStorage;

class MenuEmptyUl extends MenuUl
{
    public function __construct()
    {
        $this->children = new SplObjectStorage;
    }

    public function render(): string
    {
        $result = '';
        foreach ($this->children as $child) {
            $result .= $child->render();
        }

        return '<ul>' . $result . '</ul>';
    }
}
