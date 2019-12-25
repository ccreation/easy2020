<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class FormDataExport implements FromCollection
{
    public $clollection = [];

    public function __construct($collection = [])
    {
        $this->collection = $collection;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return new Collection($this->collection);
    }
}
