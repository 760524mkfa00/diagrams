<?php
namespace Plans\Composers;

use Plans\Repositories\Type\TypeRepository;
use Illuminate\Contracts\View\View;


class TypeComposer {

    protected $type;

    public function __construct (TypeRepository $type)
    {

        $this->type = $type;

    }

    public function compose($view)
    {
        $view->with('types', $this->type->listTypes());
    }

}