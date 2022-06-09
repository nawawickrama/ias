<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use App\Models\DocumentCourse;
use App\Models\DocumentSetting;
use App\Models\PermissionList;
use App\Models\Smtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class SettingControler extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'actived', 'agent']);
    }

    public function smtp_page()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('smtp-setting.edit');

        if ($permission) {
            $smtp_setting = Smtp::orderbyDesc('id')->first();
            return view('admin.settings.smtp')->with(['smtp_setting' => $smtp_setting]);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function set_smtp(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('smtp-setting.create');

        if ($permission) {
            $host = request('host');
            $port = request('port');
            $uname = request('uname');
            $pword = request('pword');

            try {
                $d = Smtp::create([
                    'MAIL_HOST' => request('host'),
                    'MAIL_PORT' => request('port'),
                    'MAIL_USERNAME' => request('uname'),
                    'MAIL_PASSWORD' => request('pword'),
                ]);
            } catch (Throwable $e) {
                dd($e);
                return back()->with(['error' => 'SMTP setting failed.']);
            }

            return back()->with(['success' => 'SMTP setting added.']);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function role_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('role.view') || $user->can('role.create');

        if ($permission) {

            $role_details = Role::all();
            $permission_details = Permission::all();
            return view('admin.settings.new-role')->with(['role_details' => $role_details, 'permission_details' => $permission_details]);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function role_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('role.create');

        if ($permission) {

            $request->validate([
                'role' => 'required',
                'role_color' => 'nullable',
            ]);

            try {
                Role::create(['name' => request('role'), 'color' => request('role_color')]);
            } catch (Throwable $e) {
                return back()->with(['error' => 'Role create Failed.', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Role create successful.']);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function permission_role_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission.view') || $user->can('permission.create');

        if ($permission) {
            $permission_details = PermissionList::all();
            $role_details = Role::where('name', '!=', 'Super Admin')->get();

            return view('admin.settings.role-permission')->with(['permission_details' => $permission_details, 'role_details' => $role_details]);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function permission_role_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission.create') || $user->can('permission.edit');

        if ($permission) {
            $all_permission = PermissionList::all();
            $role_id = request('role_id');
            $role = Role::find($role_id);

            if ($user->can('permission.edit')) {
                $role->syncPermissions();
            }

            try {
                foreach ($all_permission as $per) {
                    $input = request($per->name);
                    if ($input != null) {
                        foreach ($input as $in) {
                            $permission = $per->name . '.' . $in;
                            $role->givePermissionTo($permission);
                        }
                    }
                }
            } catch (Throwable $e) {
                return back()->with(['error' => 'Permission added faild.', 'error_type' => 'error']);
            }

            return back()->with(['success' => 'Permission added successful.']);
        } else {
            Auth::logout();
            abort(403);
        }
    }

    public function fill_permission(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('permission.view');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $role_id = request('role_id');
        $permission = Role::find($role_id)->permissions;

        return response()->json($permission);
    }

    public function course_get()
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('course.view') || $user->can('course.create');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $course_details = Course::all();
        return view('admin.settings.courses')->with(['course_details' => $course_details]);
    }

    public function course_post(Request $request)
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('course.create');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $request->validate([
            'course_name' => 'required',
            'course_code' => 'required',
            'course_description' => 'nullable',
        ]);

        try{
            Course::create([
                'course_name' => request('course_name'),
                'course_code' => request('course_code'),
                'course_status' => 1,
                'course_description' => request('course_name'),
            ]);

        }catch(Throwable $e){
            return back()->with(['error' => 'Course added failed.', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Course added successfully.']);
    }

    public function statusChange(){

        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('course.active_deactivate');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $status = \request('status');
        $course_id = \request('course_id');

        try{
            Course::find($course_id)->update([
                'course_status' => $status
            ]);
        }catch (Throwable $e){
            return back()->with(['error' => 'Status change failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Status change successfully']);
    }

    public function documentSetting(){
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('setting.document');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $coursesDetails = Course::where('course_status', '1')->get();
        $documents = Document::all();
        $documentDetails = DocumentCourse::all();
        return view('admin.settings.document-settings')->with(['coursesDetails' => $coursesDetails, 'documentDetails' => $documentDetails , 'documents' => $documents]);
    }

    public function documentCourseLink(Request $request){
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('document.create');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $documentId = \request('documentId');
        $courseId = \request('courseId');

        $request->validate([
           'documentId' => 'required',
           'courseId' => 'required',
           'option' => 'required',
        ]);

        try{
            if ($courseId == 'all'){
                $allCourses = Course::where('course_status', '1')->get();

                foreach ($allCourses as $course){
                   DocumentCourse::create([
                       'doc_id' => $documentId,
                       'course_id' => $course->course_id,
                       'document_course_status' => 1,
                       'option' => \request('option'),
                   ]);
                }

            }else {
                DocumentCourse::create([
                    'doc_id' => $documentId,
                    'course_id' => $courseId,
                    'document_course_status' => 1,
                    'option' => \request('option'),
                ]);
            }
        }catch (Throwable $e){
            return back()->with(['error' => $e->getMessage(), 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Document Setting created.']);
    }

    public function documentCourseStatus(){
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('document-status.change');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $status = \request('status');
        $id = \request('documentSettingId');

        try{
            DocumentCourse::find($id)->update([
               'document_course_status' => $status,
            ]);
        }catch (Throwable $e){
            return back()->with(['error' => 'Status changed failed.', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Status changed']);
    }

    public function addNewDocument(Request $request){
        /** @var App\Models\User $user */
        $user = Auth::user();
        $permission = $user->can('document.create');

        if (!$permission) {
            Auth::logout();
            abort(403);
        }

        $documentName = \request('doc_name');

        try{
            Document::create([
                'doc_name' => str_replace(' ', '_', $documentName)
            ]);
        }catch (Throwable $e){
            return back()->with(['error' => 'New document submission failed', 'error_type' => 'error']);
        }
        return back()->with(['success' => 'New document created']);

    }
}
