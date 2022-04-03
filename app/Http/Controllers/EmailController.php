<?php

namespace App\Http\Controllers;

use App\Mail\CpfLinkMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmail;
use App\Models\Lead;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Throwable;

class EmailController extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth', 'actived', 'agent']);
    }

    //normal email
    public function send_email_get(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('email-send.view');

        if($permission){

            return view('admin.mail.send-mail');

        }else{
            Auth::logout();
            abort(403);
        }
    }

    //normal email
    public function send_email_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('email-send.create');

        if($permission){

            $subject = request('subject');
            $data = request('body');
            $email = request('email');

            try{
                Mail::to($email)->send( new sendEmail($data, $subject));

            }catch(Throwable){
                return back()->with(['error' => 'Email send failed', 'error_type'=> 'error']);
            }

            Session::put('success', '1');
            return Redirect::route('send-mail');

        }else{
            Auth::logout();
            abort(403);
        }
    }

    //normal email
    public function email_button(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('email-send.create');

        if($permission){

            $email_add = request('email');
            return view('admin.mail.send-mail')->with(['email_add' => $email_add]);

        }else{
            Auth::logout();
            abort(403);
        }

    }

    //cpf_form_link
    public function send_potential_liad_cpf(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('lead-potential-send-cpf.create');

        if($permission){

            $random_no = request('cpf_no');
            $lead_info = Lead::where('lead_random_number', $random_no)->first();
            $subject = 'Candidate Profile Form - IAS College';
            $link = config('app.url').'/lead-cpf-form/'.$random_no;

            try{
                Mail::to($lead_info->lead_email)->send( new CpfLinkMail($subject, $link));

            }catch(Throwable $e){
                dd($e);
                return back()->with(['error' => 'Email send failed', 'error_type'=> 'error']);
            }

            Session::put('success', '1');
            return Redirect::route('potential_lead');

        }else{
            Auth::logout();
            abort(403);
        }
    }
}
