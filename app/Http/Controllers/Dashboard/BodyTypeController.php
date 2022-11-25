<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BodyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BodyTypeController extends Controller
{
    public function index()
    {
        $bodyTypes = BodyType::all();
        return view('dashboard.bodytype.view', compact(['bodyTypes']));
    }

    public function create()
    {
        return view('dashboard.bodytype.create');
    }

    public function store(Request $request)
    {
        $path = 'images/BodyType';
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $saveImage = $request->file('image')->store('public/' . $path);
        $save = BodyType::Create([
            'name' => $request->name,
            'icon' => $path .'/'. basename($saveImage)
        ]);

        if($save)
            return redirect()->route('bodytype.index')->with(['success'=>Lang::get('global.addSuccess')]);
        else
            return redirect()->route('bodytype.index')->with(['error'=>Lang::get('global.addError')]);
    }

    public function edit(BodyType $bodyType)
    {
        return view('dashboard.bodytype.edit', compact(['bodyType']));
    }

    public function update(Request $request, BodyType $bodyType)
    {
        $path = 'images/BodyType';
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($request->file('image')) {
            if (!File::exists('public/' . $bodyType->icon))
                Storage::delete('public/' . $bodyType->icon);
            $saveImage = $request->file('image')->store('public/' . $path);
            $bodyType->icon = $path . '/' . basename($saveImage);
        }
        $bodyType->name = $request->name;
        if ($bodyType->save())
            return redirect()->route('bodytype.index')->with(['success' => Lang::get('global.updateSuccess')]);
        else
            return redirect()->route('bodytype.index')->with(['error' => Lang::get('global.updateError')]);
    }

    public function destroy(BodyType $bodyType)
    {
        if ($bodyType->delete())
            return redirect()->back()->with(['success' => Lang::get('global.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('global.deleteError')]);
    }

    public function trash()
    {
        $bodyTypes = BodyType::onlyTrashed()->get();
        return view('dashboard.bodytype.trash', compact(['bodyTypes']));
    }
    public function undo($id)
    {
        $bodyType = BodyType::onlyTrashed()->where('id', $id)->first();
        $bodyType->deleted_at = null;
        if ($bodyType->save())
            return redirect()->back()->with(['success' => Lang::get('global.undoSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('global.undoError')]);
    }
}
