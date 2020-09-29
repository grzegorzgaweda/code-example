<?php


namespace App\Services\Menu;



abstract class MenuComponent
{
    protected $parent;

    /**
     * @param MenuComponent $parent
     */
    public function setParent(MenuComponent $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return MenuComponent
     */
    public function getParent(): MenuComponent
    {
        return $this->parent;
    }

    public function isComposite(): bool
    {
        return false;
    }
    abstract public function render();
}
