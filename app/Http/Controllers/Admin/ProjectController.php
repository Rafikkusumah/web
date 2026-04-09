<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'required|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        $project = Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }
        
        $project->media()->each(function ($media) {
            Storage::disk('public')->delete($media->file_path);
        });
        
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function uploadMedia(Request $request, Project $project)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|max:10240',
        ]);

        foreach ($request->file('files') as $file) {
            $path = $file->store('projects/media', 'public');
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();
            
            $fileType = Str::startsWith($mimeType, 'video/') ? 'video' : 'image';

            ProjectMedia::create([
                'project_id' => $project->id,
                'file_path' => $path,
                'file_type' => $fileType,
            ]);
        }

        return back()->with('success', 'Media uploaded successfully.');
    }

    public function deleteMedia(ProjectMedia $media)
    {
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return back()->with('success', 'Media deleted successfully.');
    }
}
