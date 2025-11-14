<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\User;
class PagesController extends Controller
{
  public function index(Request $request)
{
    $user = $request->user();
    $search = $request->input('search');

    $quotes = Quote::where('is_published', 1)
        ->when($search, function($query) use ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        })
        ->with('likes')
        ->get();

    return view('quotes.quotes', compact('user', 'quotes', 'search'));
}

public function login(){
    return view('auth.login');

}
public function register(){
        return view('auth.register');

    }

    public function profil(Request $request){
        $user=$request->user();
        $quotes=Quote::where('user_id',$user->id)->get();
$publishedcount=Quote::where('user_id',$user->id)->where('is_published',1)->count();
$quotescount=Quote::where('user_id',$user->id)->count();
        return view('pages.profile',compact('user','quotes','publishedcount','quotescount'));
    }


    public function users(Request $request){
$users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editRole(Request $request, User $user){
        $user->role = $request->role;
        $user->save();
        return redirect()->route('users');
    }
}
