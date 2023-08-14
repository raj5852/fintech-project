<?php

namespace App\View\Components;

use App\Services\Frontend\UserProfileService;
use Illuminate\View\Component;

class mobileusergroup extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $userGroups =  UserProfileService::userGroup();

        return view('components.mobileusergroup',compact('userGroups'));
    }
}
