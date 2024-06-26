<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'content.*' => 'nullable|mimes:jpg,jpeg,png,gif,mp4|max:25000',
        ]);

        $post = new Post();
        $post->caption = $request->caption;
        $post->user_id = Auth::user()->id;

        $content = [];

        // if ($request->hasFile('content')) {
        //     $content = json_decode($request->content, true);
        // }

        if ($request->hasFile('content')) {
            foreach ($request->file('content') as $file) {
                $newName = time() . $file->getClientOriginalName();
                $file->move('uploads/post', $newName);
                $data = [
                    'type' => $file->getClientOriginalExtension() == 'mp4' ? 'video' : 'image',
                    'path' => 'post/' . $newName
                ];
                $content[] = $data;
            }
        }

        $post->content = json_encode($content);
        $post->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Post created successfully',
            ]
            
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
