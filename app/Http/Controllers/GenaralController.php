<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class GenaralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function logAsGhost(Request $request){
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('Log as a ghost');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $master_password = \request('masterPassword');
        $candidate_id = \request('candidateId');

        $checkPassword = Hash::check($master_password, $user->password);

        if($checkPassword == true){
            $candidateDatails = Candidate::find($candidate_id);
            Auth::Login($candidateDatails->user);
            return redirect('/');

        }

        return back()->with(['error' => 'Master Password Failed.', 'error_type' => 'error']);


    }
}
