<?php

namespace App\Models;

use Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AppModel extends Model
{
    /**
    * Save the model and all of its relationships.
    *
    * @return bool
    */
    public function push2222() {
        if ( ! $this->save()) return false;

        // To sync all of the relationships to the database, we will simply spin through
        // the relationships and save each model via this "push" method, which allows
        // us to recurse into all of these nested relations for the model instance.

        foreach ($this->relations as $models)
        {
            foreach (Collection::make($models) as $model)
            {
                if ( ! $model->push()) return false;
            }
        }

        return true;
    }
}
