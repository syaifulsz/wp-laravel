<?php

namespace SSZ\CMS\Readers;

interface CMSInterface
{
    public function posts(\SSZ\CMS\Params\Post $args = null);
    public function getPost($id, \SSZ\CMS\Params\Post $args = null);
    public function categories(\SSZ\CMS\Params\Category $args = null);
    public function getCategory($id, \SSZ\CMS\Params\Category $args = null);
    public function medias(\SSZ\CMS\Params\Media $args = null);
    public function getMedia($id, \SSZ\CMS\Params\Media $args = null);
    public function users(\SSZ\CMS\Params\User $args = null);
    public function getUser($id, \SSZ\CMS\Params\User $args = null);
    public function get($method, array $query = []);
}
