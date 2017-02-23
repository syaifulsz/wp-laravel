<?php

namespace App\Providers\Readers;

interface CMSInterface
{
    public function posts(\App\Providers\Params\Post $args = null);
    public function getPost($id, \App\Providers\Params\Post $args = null);
    public function categories(\App\Providers\Params\Category $args = null);
    public function getCategory($id, \App\Providers\Params\Category $args = null);
    public function get($method, array $query = []);
}
