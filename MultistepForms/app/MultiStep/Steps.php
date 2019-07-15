<?php

namespace App\MultiStep;

use Illuminate\Http\Request;
use App\MultiStep\Store\Contracts\StepStorage;

class Steps
{
    protected $name;

    protected $step;

    public function __construct(StepStorage $storage)
    {
        $this->storage = $storage;
    }

    public function step($name, $step)
    {
        $this->name = $name;
        $this->step = $step;

        return $this;
    }

    public function store($data)
    {

    }
}