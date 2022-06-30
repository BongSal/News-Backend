<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleReadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "title" => $this->title,
            "image" => $this->imageUrl(),
            "body" => $this->body,
            "total_views" => $this->total_views,
            "author" => new AuthorResource($this->author),
            "category" => new CategoryResource($this->category),
            'read_more' => $this->getReadMore(),
            "creator" => $this->creator?->response(),
            "updater" => $this->updater?->response(),
            "created_at" => $this->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    private function getReadMore()
    {
        $resource = Article::where('category_id', $this->category_id)->where('id', '<>', $this->id)->take(4)->get();
        return ArticleResource::collection($resource);
    }
}
