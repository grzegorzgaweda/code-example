<?php


namespace App\Services\Menu;

use App\Models\Menu\MenuElement;
use Illuminate\Support\Collection;

class MenuGenerator
{
    private $menu;
    /**
     * @var Collection
     */
    private $elements;

    public function __construct(Collection $menuElements)
    {
        $this->elements = $menuElements;
        $this->menu = new MenuEmptyUl();

        $menuElements = $this->elements->where('parent_id', 0);
        foreach ($menuElements as $element) {
            $this->getChildren($element, $this->menu);
        }
    }

    public function getChildren(MenuElement $item, MenuUl $menuItem)
    {
        $children = $this->elements->where('parent_id', $item->id);
        if ($children->count() > 0) {
            $childComponent = new MenuUl($item);

            foreach ($children as $child) {
                $this->getChildren($child, $childComponent);
            }

        } else {
            $childComponent = new MenuLi($item);
        }
        $menuItem->add($childComponent);
    }

    public function render()
    {
        return $this->menu->render();
    }
}
