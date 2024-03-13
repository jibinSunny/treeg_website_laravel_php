<?php

namespace App\Http\Resources;

use App\ProjectCategory;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
         return [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $request->image,
            'type' => ($request->type=='1') ? 'Residential Projects' : 'Commercial Projects',
            'status' => ($request->type=='1') ? 'Ongoing Projects' : 'Completed Projects',
        ];
    }
}
