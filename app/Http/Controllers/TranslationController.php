<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation; 
use App\Models\Tag; 
class TranslationController extends Controller
{
    public function index()
    {
        return Translation::with(['locale', 'tags'])->paginate(50);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'locale_id' => 'required|exists:locales,id',
            'key' => 'required',
            'value' => 'required',
            'tags' => 'array'
        ]);

        $translation = Translation::create($data);

        if (!empty($data['tags'])) {
            $tags = Tag::whereIn('name', $data['tags'])->pluck('id');
            $translation->tags()->sync($tags);
        }

        return response()->json($translation->load('tags'), 201);
    }

    public function update(Request $request, Translation $translation)
    {
        $translation->update($request->only('value'));

        if ($request->has('tags')) {
            $tags = Tag::whereIn('name', $request->tags)->pluck('id');
            $translation->tags()->sync($tags);
        }

        return $translation->load('tags');
    }

    public function search(Request $request)
    {
        return Translation::query()
            ->when($request->key, fn($q) => $q->where('key', 'like', "%{$request->key}%"))
            ->when($request->value, fn($q) => $q->where('value', 'like', "%{$request->value}%"))
            ->when($request->tag, function ($q) use ($request) {
                $q->whereHas('tags', fn($t) => $t->where('name', $request->tag));
            })
            ->with(['locale', 'tags'])
            ->get();
    }


    public function export(Request $request)
    {
        $locale = $request->get('locale', 'en');

        return Translation::whereHas('locale', fn($q) => $q->where('code', $locale))
            ->select('key', 'value')
            ->pluck('value', 'key'); 
    }
}

