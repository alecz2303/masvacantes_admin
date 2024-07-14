<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class VerEmpleo extends AbstractAction
{
    public function getTitle()
    {
        return 'Ver Empleo';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('voyager.empleos.show', [$this->data->id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'empleos';
    }
}
