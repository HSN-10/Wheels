<?php

namespace App\Http\Controllers;

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
        $path = 'images/BodyTpye';
        $validate = Validator::make($request->all(),[
            'name' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
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
    public function forceDelete($id)
    {
        $bodyType = BodyType::onlyTrashed()->where('id', $id)->first();

        if (!File::exists('public/' . $bodyType->icon))
            Storage::delete('public/' . $bodyType->icon);

        if ($bodyType->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }
}
