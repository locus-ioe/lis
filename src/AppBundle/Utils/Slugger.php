<?php

namespace AppBundle\Utils;

class Slugger
{
    public function slugify($slug)
    {
        return preg_replace(
            '/[^a-z0-9]/', '-', strtolower(trim(strip_tags($slug)))
        );
    }
}
