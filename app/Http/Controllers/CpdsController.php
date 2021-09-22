<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CpdModal;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CpdsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        return view('cpds.index')
            ->with('cpds', CpdModal::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('cpds.create');
        }
        return redirect()->guest(route('login'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'resource' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        CpdModal::create([
            'title' => $request->input('title'),
            'resource' => $request->input('resource'),
            'description' => $request->input('description'),
            'slug' => SlugService::createSlug(CpdModal::class, 'slug', $request->title),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/cpds')
            ->with('message', 'Your post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('cpds.show')
            ->with('cpd', CpdModal::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        if (Auth::check()) {

            return view('cpds.edit')
                ->with('cpd', CpdModal::where('slug', $slug)->first());
        }

        return redirect()->guest(route('login'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'resource' => 'required',
            'description' => 'required',
            //'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);


        // $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();
        //$request->image->move(public_path('images'), $newImageName);





        CpdModal::where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'resource' => $request->input('resource'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(CpdModal::class, 'slug', $request->title),
                //'image_path' => $newImageName,
                'user_id' => auth()->user()->id
            ]);

        return redirect('/cpds')
            ->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if (Auth::check()) {
            $post = CpdModal::where('slug', $slug);
            $post->delete();

            return redirect('/cpds')
                ->with('message', 'Your post has been deleted!');
        }
        return redirect()->guest(route('login'));
    }
}
