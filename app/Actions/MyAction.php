<?php

namespace App\Actions;

use Illuminate\Http\Request;
use TCG\Voyager\Actions\AbstractAction;

class MyAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Ver';
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
            'class' => 'btn btn-sm btn-warning pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        // $tipo = 'g';
        // if($_GET['tipo']){
        //     $tipo = $_GET['tipo'];
        // }
;        return route('voyager.users.show', [$this->data->id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }
}
