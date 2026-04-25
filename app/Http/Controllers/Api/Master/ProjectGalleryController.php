<?php

namespace App\Http\Controllers\Api\Master;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProjectGalleryController extends Controller
{
    // ✅ CREATE
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:100000',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/project/gallery'), $fileName);

        $gallery = ProjectGallery::create([
            'project_id' => $request->project_id,
            'image' => env('APP_URL_IMAGE').'/uploads/project/gallery/'.$fileName,
            'title' => $request->title,
        ]);

        return response()->json([
            'message' => 'Gallery image added',
            'data' => $gallery
        ]);
    }

    // ✅ READ (single project ki gallery)
    public function index($project_id)
    {
        $galleries = ProjectGallery::where('project_id', $project_id)->get();

        return response()->json([
            'data' => $galleries
        ]);
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $gallery = ProjectGallery::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 🔥 Image update
        if ($request->hasFile('image')) {

            // old delete
            if ($gallery->image && File::exists(public_path($gallery->image))) {
                File::delete(public_path($gallery->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/project/gallery'), $imageName);

            $gallery->image = 'uploads/project/gallery/'.$imageName;
        }

        if ($request->has('title')) {
            $gallery->title = $request->title;
        }

        $gallery->save();

        return response()->json([
            'message' => 'Gallery updated',
            'data' => $gallery
        ]);
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $gallery = ProjectGallery::findOrFail($id);

        // 🔥 delete image
        if ($gallery->image && File::exists(public_path($gallery->image))) {
            File::delete(public_path($gallery->image));
        }

        $gallery->delete();

        return response()->json([
            'message' => 'Gallery deleted'
        ]);
    }
}
