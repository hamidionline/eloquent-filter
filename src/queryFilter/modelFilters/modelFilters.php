<?php
/**
 * Created by PhpStorm.
 * User: mehdi
 * Date: 7/25/18
 * Time: 9:14 PM
 */

namespace eloquentFilter\QueryFilter\modelFilters;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Zaman;
use Config;
use eloquentFilter\QueryFilter\queryFilter;

class modelFilters extends queryFilter
{

    public function __call($name, $arguments)
    {


        if ($name == 'username_int') {

        }


        if (Schema::hasColumn($this->table, $name) &&
            !method_exists($this->builder->getModel(), $name)) {


            if (!empty($arguments[0]['from']) && !empty($arguments[0]['to'])) {

                $arg['from'] = $arguments[0]['from'];
                $arg['to'] = $arguments[0]['to'];

                $this->builder->whereBetween($name, [$arg['from'], $arg['to']]);
            } else {
                if (!empty($arguments[0]) && !is_array($arguments[0])) {

                    $this->builder->where("$name", $arguments[0]);

                }
            }
        } else {

            $this->builder->getModel()->$name($this->builder, $arguments[0]);
        }


    }

}
