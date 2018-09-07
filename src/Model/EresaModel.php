<?php

namespace App\Model;

class EresaModel
{
    public $isActivated;

    public function toArray()
    {
        return [
            'isActivated'=> $this->isActivated
        ];
    }
}
