<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class ResourceCollectionAbstract extends ResourceCollection
{
    private $links;
    private $meta;

    public function __construct($resource, $locale ='en')
    {
        if ($resource instanceof LengthAwarePaginator) {
            $resource->setPageName('pagina');

            $this->meta = [
                __('pagination.total', [], $locale)        => $resource->total(),
                __('pagination.count', [], $locale)        => $resource->count(),
                __('pagination.per_page', [], $locale)     => $resource->perPage(),
                __('pagination.current_page', [], $locale) => $resource->currentPage(),
                __('pagination.last_page', [], $locale)    => $resource->lastPage(),
                __('pagination.from', [], $locale)         => $resource->firstItem(),
                __('pagination.to', [], $locale)           => $resource->lastItem(),
            ];

            $this->links = [

                __('pagination.first_page', [], $locale) => $resource->url(1),
                __('pagination.last_page', [], $locale)  => $resource->url($resource->lastPage()),
                __('pagination.prev_page', [], $locale)  => $resource->previousPageUrl(),
                __('pagination.next_page', [], $locale)  => $resource->nextPageUrl()
            ];


            $resource = $resource->getCollection();
        }

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        if (is_null($this->meta) || is_null($this->links)) {
            return $this->collection;
        }

        return [
            'data'  => $this->collection,
            'meta'  => $this->meta,
            'links' => $this->links
        ];
    }
}
