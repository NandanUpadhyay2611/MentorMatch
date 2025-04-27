<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'description' => 'nullable|string|max:1000',
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully!');
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully!');
    }
} 