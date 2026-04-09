<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Blog;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $recentProjects = Project::where('is_active', true)
            ->latest()
            ->limit(3)
            ->get();
        
        $latestBlogs = Blog::where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();
        
        return view('landing.home', compact('recentProjects', 'latestBlogs'));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function projects()
    {
        $projects = Project::where('is_active', true)
            ->latest()
            ->paginate(9);
        
        return view('landing.projects', compact('projects'));
    }

    public function projectDetail($id)
    {
        $project = Project::with('media')->findOrFail($id);
        return view('landing.project-detail', compact('project'));
    }

    public function blog()
    {
        $blogs = Blog::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);
        
        return view('landing.blog', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('landing.blog-detail', compact('blog'));
    }

    public function contact()
    {
        return view('landing.contact');
    }
}
