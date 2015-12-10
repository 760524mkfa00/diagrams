<?php
namespace Plans\Composers;

use Plans\Repositories\Floor\FloorRepository;
use Illuminate\Contracts\View\View;


class FloorComposer {

    protected $floor;

    public function __construct (FloorRepository $floor)
    {

        $this->floor = $floor;

    }

    public function compose($view)
    {
        $view->with('floors', $this->floor->listFloors());
    }

}