<?php

namespace App\Http\Controllers\Api\Master;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $length = $request->input('length', 50);
        $page   = $request->input('page', 1);
        $offset = ($page - 1) * $length;
        $query = Project::query()->with('galleries');
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('author')) {
            $query->where('author', $request->author);
        }
        $count = (clone $query)->count();
        $data = $query
            ->orderByDesc('id')
            ->skip($offset)
            ->take($length)
            ->get()
            ->map(function ($item) {
                return $item;
            });
        return response()->json([
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'page' => $page,
            'offset' => $offset,
            'last_page' => ceil($count / $length),
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'github_link' => 'nullable|url|max:255',
            'technologies' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'database' => 'nullable|string|max:255',
            'framework' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'developed_by' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        $slug = Str::slug($validated['name']);
        $count = Project::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $validated['slug'] = $slug;
        $validated['developed_by'] = $validated['developed_by'] == NULL ?? "Muhammad Shakeeb Raza";
        $validated['author'] = $validated['author'] == NULL ?? "Muhammad Shakeeb Raza";

        $project = Project::create($validated);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }


    public function show($id)
    {
        $project = Project::with('galleries')->findOrFail($id);
        return response()->json($project);
    }


    public function update(Request $request, $id)
    {
    
        try {

            $project = Project::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'url' => 'nullable|url|max:255',
                'github_link' => 'nullable|url|max:255',
                'technologies' => 'nullable|string',
                'image' => 'nullable|string|max:255',
                'database' => 'nullable|string|max:255',
                'framework' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'video' => 'nullable|string|max:255',
                'date' => 'nullable|date',
                'developed_by' => 'nullable|string|max:255',
                'author' => 'nullable|string|max:255',
            ]);

    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            if ($project->name !== $validated['name']) {
                $baseSlug = Str::slug($validated['name']);
                $slug = $baseSlug;
                $i = 1;

                while (Project::where('slug', $slug)
                    ->where('id', '!=', $project->id)
                    ->exists()) {

                    $slug = $baseSlug . '-' . $i++;
                }

                $validated['slug'] = $slug;
            }

            $project->update($validated);

            return response()->json([
                'message' => 'Project updated successfully',
                'data' => $project->load('galleries')
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'message' => 'Project not found'
            ], 404);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}
