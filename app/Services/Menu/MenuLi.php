<?php


namespace App\Services\Menu;


use App\Models\Menu\MenuElement;

class MenuLi extends MenuComponent
{
    /** @var MenuElement $menuElement */
    private $menuElement;

    public function __construct(MenuElement $menuElement)
    {
        $this->menuElement = $menuElement;
    }

    public function render()
    {
        return '<li>' . $this->menuElement->name . '</li>';
    }
}
