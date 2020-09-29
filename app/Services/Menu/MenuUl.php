<?php


namespace App\Services\Menu;


use App\Models\Menu\MenuElement;
use SplObjectStorage;

class MenuUl extends MenuComponent
{
    /** @var MenuElement $menuElement */
    private $menuElement;

    /** @var SplObjectStorage */
    protected $children;

    public function __construct(MenuElement $menuElement)
    {
        $this->menuElement = $menuElement;
        $this->children = new SplObjectStorage;
    }

    public function add(MenuComponent $component)
    {
        $this->children->attach($component);
    }

    public function remove(MenuComponent $component)
    {
        $this->children->detach($component);
        $component->setParent(null);
    }

    public function isComposite(): bool
    {
        return true;
    }

    public function render(): string
    {
        $result = '';
        foreach ($this->children as $child) {
            $result .= $child->render();
        }

        return '<li>' . $this->menuElement->name . '<ul>'.$result . '</ul></li>';
    }
}

