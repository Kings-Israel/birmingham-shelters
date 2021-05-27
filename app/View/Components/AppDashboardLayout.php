<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppDashboardLayout extends Component
{

    public string $pageTitle;

    public function __construct(string $pageTitle = '')
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
       return view('layouts.app-dashboard');
    }
}
