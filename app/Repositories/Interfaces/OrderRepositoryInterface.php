<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function order($input);
    public function product($input);
    public function list($input);
}
