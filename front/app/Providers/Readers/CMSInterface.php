<?php

namespace App\Providers\Readers;

interface CMSInterface
{
    public function posts(\App\Providers\Params\Post $args = null);
    public function getPost($id, \App\Providers\Params\Post $args = null);
    public function categories(\App\Providers\Params\Category $args = null);
    public function getCategory($id, \App\Providers\Params\Category $args = null);
    public function medias(\App\Providers\Params\Media $args = null);
    public function getMedia($id, \App\Providers\Params\Media $args = null);
    public function users(\App\Providers\Params\User $args = null);
    public function getUser($id, \App\Providers\Params\User $args = null);
    public function get($method, array $query = []);
}
