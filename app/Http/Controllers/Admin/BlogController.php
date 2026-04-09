<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'required|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');
        
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }
        
        if ($validated['is_published'] && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_published'] = $request->has('is_published');
        
        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                \Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }
        
        if ($validated['is_published'] && !$blog->published_at) {
            $validated['published_at'] = $validated['published_at'] ?? now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->featured_image) {
            \Storage::disk('public')->delete($blog->featured_image);
        }
        
        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
