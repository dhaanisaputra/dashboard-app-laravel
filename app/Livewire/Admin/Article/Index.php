<?php

namespace App\Livewire\Admin\Article;

use Livewire\Component;
use App\Models\Articles;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // declare article_id
    public $article_id;

    public function deleteArticle($article_id)
    {
        $this->article_id = $article_id;
    }

    public function destroyArticle()
    {
        $article = Articles::find($this->article_id);
        $path = 'upload/category/' . $article->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $article->delete();
        session()->flash('message', 'Article Deleted');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $articles = Articles::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.admin.article.index', ['articles' => $articles]);
    }
}
