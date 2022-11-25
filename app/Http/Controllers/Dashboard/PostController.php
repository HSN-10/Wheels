<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.post.view', compact(['posts']));
    }

    public function edit(Post $post)
    {
        $bodyTypes = BodyType::all();
        $users = User::all();
        return view('dashboard.post.edit', compact(['post', 'users', 'bodyTypes']));
    }
    public function update(Request $request, Post $post)
    {
        $path = 'images/Post';
        $validate = $request->validate([
            'title' => 'required',
            'price' => 'required|integer',
            'user_id' => 'required|integer',
            'negotiable' => 'required|boolean',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'maker' => 'required',
            'model' => 'required',
            'colour' => 'required',
            'years' => 'required|integer',
            'body_type_id' => 'required|integer',
            'transmission_type' => 'required',
            'kilometrage' => 'required|integer',
            'gas_type' => 'required|integer',
            'doors' => 'required|integer',
            'engine_cylinders' => 'required|integer',
            'condition' => 'required|integer',
            'number_of_owners' => 'required|integer',
            'number_of_accidents' => 'required|integer',
        ]);


        $edit = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'negotiable' => $request->negotiable,
            'type_post' => $request->type_post,
            'maker' => $request->maker,
            'model' => $request->model,
            'colour' => $request->colour,
            'years' => $request->years,
            'body_type_id' => $request->body_type_id,
            'transmission_type' => $request->transmission_type,
            'kilometrage' => $request->kilometrage,
            'gas_type' => $request->gas_type,
            'doors' => $request->doors,
            'engine_cylinders' => $request->engine_cylinders,
            'condition' => $request->condition,
            'number_of_owners' => $request->number_of_owners,
            'number_of_accidents' => $request->number_of_accidents,
        ];

        if ($request->file('image')) {
            if (!File::exists('public/' . $post->image))
                Storage::delete('public/' . $post->image);
            $saveImage = $request->file('image')->store('public/' . $path);
            $request->image = $path . '/' . basename($saveImage);
            $edit += ['image' => $request->image];
        }
        $post->fill($edit);

        if ($post->save())
            return redirect()->route('post.index')->with(['success' => Lang::get('global.updateSuccess')]);
        else
            return redirect()->route('post.index')->with(['error' => Lang::get('global.updateError')]);
    }
    public function destroy(Post $post)
    {
        if ($post->delete())
            return redirect()->back()->with(['success' => Lang::get('global.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('global.deleteError')]);
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        return view('dashboard.post.trash', compact(['posts']));
    }
    public function undo($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->deleted_at = null;
        if ($post->save())
            return redirect()->back()->with(['success' => Lang::get('global.undoSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('global.undoError')]);
    }

    public function reports(Post $post)
    {
        $reports = $post->reports;
        return view('dashboard.post.reports', compact(['reports']));
    }
}
