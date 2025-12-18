<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studios = Studio::all();
        
        return view('welcome', compact('studios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studios.form', ['studio' => new Studio()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'founded_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = $path;
        }

        Studio::create($data);

        return redirect('/')->with('success', 'Студия успешно добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Studio $studio)
    {
        return view('studios.show', compact('studio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studio $studio)
    {
        return view('studios.form', ['studio' => $studio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studio $studio)
    {
         $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $data['image'] = $path;
        }

        $studio->update($data);

        return redirect('/')->with('success', 'Студия обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studio $studio)
    {
        $studio->delete();
        return redirect('/')->with('success', 'Студия удалена.');
    }

    public function indexByUser($username)
    {
        $query = $user->posts();

        if (Auth::user()->is_admin)
        {
            $studio = $query->withTrashed()->get();
        } else {
            $studios = $query->get();
        }

        return view('studios.index', compact('studios', 'user'));
    }
}
