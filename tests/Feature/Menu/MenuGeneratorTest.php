<?php

namespace Tests\Feature\Menu;

use App\Models\Menu\MenuElement;
use App\Services\Menu\MenuGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuGeneratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var array
     */
    private $menuElements;

    protected function setUp(): void
    {
        parent::setUp();
        $this->menuElements = collect();
        $this->menuElements[] = factory(MenuElement::class)->create();
        $this->menuElements[] = factory(MenuElement::class)->create(['parent_id' => $this->menuElements[0]->id]);
        $this->menuElements[] = factory(MenuElement::class)->create(['parent_id' => $this->menuElements[1]->id]);
        $this->menuElements[] = factory(MenuElement::class)->create();

    }

    /** @test */
    public function MenuGenerator_return_html()
    {
        $menuGenerator = new MenuGenerator($this->menuElements);

        $this->assertEquals(
            $this->expectedHtml(),
            $menuGenerator->render()
        );

    }

    /**
     * @return string
     */
    private function expectedHtml(): string
    {
        return '<ul><li>' . $this->menuElements[0]->name . '<ul><li>'.$this->menuElements[1]->name.'<ul><li>'.$this->menuElements[2]->name.'</li></ul></li></ul></li><li>'.$this->menuElements[3]->name.'</li></ul>';
    }
}
