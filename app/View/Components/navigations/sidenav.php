<?php

namespace App\View\Components\navigations;

use Illuminate\View\Component;

class sidenav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.navigations.sidenav', [
            'title' => 'Desa Maja Pesawaran'
        ]);
    }
}
