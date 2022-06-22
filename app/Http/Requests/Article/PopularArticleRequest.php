<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

class PopularArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from_date' => 'nullable|required_with:to_date|date_format:Y-m-d H:i:s',
            'to_date' => 'nullable|required_with:from_date|date_format:Y-m-d H:i:s',
        ];
    }

    public function getPopularArticles()
    {
        $fromDate = $this->from_date ?: now()->subMonth()->format('Y-m-d H:i:s');
        $toDate = $this->to_date ?: date('Y-m-d H:i:s');
        return Article::latest('total_views')
            ->with(['author', 'category', 'creator', 'updater'])
            ->whereBetween('created_at', [$fromDate, $toDate])->paginate();
    }
}
