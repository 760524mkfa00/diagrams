<?php
namespace Plans\Composers;

use Plans\Floor;
use Illuminate\Contracts\View\View;


class FloorComposer {

    protected $floor;

    public function __construct (Floor $floor)
    {

        $this->floor = $floor;

    }

    public function compose($view)
    {
        $view->with('floors', $this->floor->listFloors());
    }

}