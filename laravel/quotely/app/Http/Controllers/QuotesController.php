<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;

class QuotesController extends Controller
{
   public function index(Request $request)
{
    $user = $request->user();
    $status = $request->input('status');
    
    $quotes = Quote::when($status !== null, function($query) use ($status) {
        return $query->where('is_published', $status === 'published');
    })
    ->get();
    
    return view('admin.quotes', compact('user', 'quotes', 'status'));
}

    public function create(Request $request)
{
    $quotes=Quote::all();
    $user = $request->user();
    
        return view('admin.create', compact('user'));
    
    }


    public function store(Request $request){
$user = $request->user();
// validation des champs
       $validatedData = $request->validate([
    'content' => 'required|string|max:255',
    'author'  => 'required|string',
]);

// ajoute l'user_id
$validatedData['user_id'] = $user->id;

// récupère le checkbox (true/false)
$validatedData['is_published'] = $request->has('is_published');

// crée la citation
$article = Quote::create($validatedData);

if($user->role == 'editor'){

    return redirect('/profile')->with(['success_message' => 'La citation a été créé avec succès !']);
}else{

    return redirect('/dashboard')->with(['success_message' => 'La citation a été créé avec succès !']);
}
        // redirect ou dump pour tester

    }

    public function edit(Request $request, Quote $quote)
{
    $user = $request->user();
        return view('quotes.edit', compact('user','quote'));;
    }

     public function update(Request $request, Quote $quote)
{
    $user = $request->user();
     $quote->update([
    'content' => $request->content,
    'author' => $request->author,
    'is_published' => $request->has('is_published') ? 1 : 0,
]);

      return redirect()->route('edit', ['quote' => $quote->id]);
    }

    public function delete(Request $request, Quote $quote){
        $quote->delete();
        $user=$request->user();
        
        if($user->role == 'editor'){
            return redirect()->route('profil');

        }else{

            return redirect()->route('dashboard');
        }
    }
}
