<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class PrettyPaginator extends Paginator {

    public function url($page)
    {
        if ($page <= 0) {
            $page = 1;
        }
        // If we have any extra query string key / value pairs that need to be added
        // onto the URL, we will put them in query string form and then attach it
        // to the URL. This allows for extra information like sortings storage.
        $parameters = [$this->pageName => $page];
        if (count($this->query) > 0) {
            $parameters = array_merge($this->query, $parameters);
        }
        return $this->path.'/page/'.$page;
    }

}
