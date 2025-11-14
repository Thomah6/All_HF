<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticlesController extends Controller implements HasMiddleware
{

     public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }
    public function index()
    {
        $articles = Article::with('user')->orderBy('created_at', 'desc')->get();
        return view('articles.articles', compact('articles'));
    }


    public function show($title)
    {

        $article = Article::with(['user', 'comments.user'])
            ->where('title', $title)
            ->firstOrFail(); // ou ->first() si tu ne veux pas lever d'exception

        if (!$article) return view('error.index');
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // pour test, récupère l'utilisateur 1
        $user = User::find(1);

        // validation des champs
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ajoute l'user_id
        $validatedData['user_id'] = $user->id;

        // gestion de l'image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = '/images/' . $imageName;
        }

        // création de l'article
        $article = Article::create($validatedData);

        // redirect ou dump pour tester
return redirect('/articles')->with(['success_message' => 'L\'article a été créé avec succès !']);

    }

    public function edit(Article $article)
{
    return view('articles.edit', compact('article'));
}


public function update(Request $request, Article $article)
{
    // dd($article, $request->all());
        $article->update($request->all());
       return redirect()->route('articles.edit', ['id' => $article->id]);
}


public function delete(Article $article)
{
    // vérification des permissions plus tard
    $article->delete();
      $article->update($request->all());
       return redirect()->route('articles');
}


}
