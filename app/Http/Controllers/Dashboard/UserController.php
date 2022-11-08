<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.view', compact(['users']));
    }

    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact(['user']));
    }

    public function destroy(User $user)
    {
        if ($user->delete())
            return redirect()->back()->with(['success' => Lang::get('global.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('global.deleteError')]);
    }

    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('dashboard.user.trash', compact(['users']));
    }
    public function undo($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->deleted_at = null;
        if ($user->save())
            return redirect()->back()->with(['success' => Lang::get('global.undoSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('global.undoError')]);
    }
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();

        if ($user->forceDelete())
            return redirect()->back()->with(['success' => Lang::get('lang.deleteSuccess')]);
        else
            return redirect()->back()->with(['error' => Lang::get('lang.deleteError')]);
    }
}
