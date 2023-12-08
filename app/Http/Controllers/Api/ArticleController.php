<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Article $article)
    {
        try {
            if ($article->est_archive == 0) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des articles non archivés',
                    'article' => Article::where('est_archive', 0)->get(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function Archive(Article $article)
    {
        try {
            $article->update([
                    "est_archive" => 1,
                ]);
            $article->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été archivé',
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function articlesArchives(Article $article)
    {
        try {
            if ($article->est_archive == 0) {
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Voici la liste des articles  archivés',
                    'article' => Article::where('est_archive', 1)->get(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(CreateArticleRequest $request)
    {
        try {
            $article = new Article();
            $article->libelle = $request->libelle;
            $article->debouche = $request->debouche;
            $article->description = $request->description;
            $article->date_publication = $request->date_publication;
            $article->image = $this->storeImage($request->image);
            $article->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'article a été ajouter',
                'article' => $article
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function storeImage($image)
    {
        return $image->store('imagesArticles', 'public');
    }

    public function update(EditArticleRequest $request, Article $article)
    {
        try {
            $article->libelle = $request->libelle;
            $article->debouche = $request->debouche;
            $article->description = $request->description;
            $article->date_publication = $request->date_publication;
            if ($request->hasFile("image")) {
                $article->image = $this->storeImage($request->image);
            }
            $article->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'article a été modifier',
                'article' => $article
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Article $article)
    {
        try {
            $article->delete();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le post a été supprimer',
                'article' => $article
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
