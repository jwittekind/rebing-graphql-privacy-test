<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentTypeModel extends Model {

    function children() {
        return [
            new ChildTypeModel(),
            new ChildTypeModel(),
            new ChildTypeModel(),
            new ChildTypeModel(),
        ];
    }
}
