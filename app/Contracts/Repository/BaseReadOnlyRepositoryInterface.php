<?php

namespace App\Contracts\Repository;


interface BaseReadOnlyRepositoryInterface {
    public function get($id);
    public function getAll();
}