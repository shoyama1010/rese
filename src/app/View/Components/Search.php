<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class Search extends Component
{
    public $shops;
    public $areas;
    public $genres;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //\
        $this->shops = Shop::getShops();
        $this->areas = Area::all();
        $this->genres = Genre::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search');
    }
}
