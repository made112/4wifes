<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class UsersController extends Controller
{
    public function create()
    {

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        Order::create([
           'name'=>$request->name ,
            'invoice_num'=>$request->invoice_num ,
            'country_id'=>$request->country_id ,
            'address'=>$request->address ,
            'delivery_status'=>$request->delivery_status ,
            'accounting'=>$request->accounting ,
            'city'=>$request->city_id ,
            'amount'=>$request->amount ,
            'price'=>$request->price
        ]);
        return redirect()->back()->with([
            'notify'=>alert()->success('نجاح','تم اضافة الطلب بنجاح')
        ]);
    }

    public function index()
    {
        $users = User::where('name','!=','admin')->get();
        return view('admin.users.index',compact('users'));


    }

    public function indexRquest()
    {
        $jobs = Request_job::paginate(6);
        return view('admin.job_request.index', compact('jobs'));


    }
    public function edit($id)
    {
        $Jobs = Order::find($id);

        if (!$Jobs)
            return redirect()->route('admin.job')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.job.edit', compact('Jobs'));

    }
    public function update($id, JobRequest $request)
    {

        try {
            $Jobs = Order::find($id);
            if (!$Jobs) {
                return redirect()->route('admin.job', $id)->with(['error' => 'هذه الزظيفة غير موجوده']);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $Jobs->update($request->except('_token'));

            return redirect()->route('jop')->with(['success' => 'تم تحديث الوظيفة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.job')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
    public function destroy($id){
        try {
            $Jobs = User::find($id);
            if (!$Jobs) {
                return redirect()->back()->with(['error' => 'هذه الوظيفة غير موجوده']);
            }
            $Jobs->delete();

            return redirect()->back()->with(['error' => 'تم حذف الوظيفة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
    public function deleteRquest($id){
//        try {
            $Jobs = Request_job::find($id);
            if (!$Jobs) {
                return redirect()->route('admin.job_request', $id)->with(['error' => 'هذه الوظيفة غير موجوده']);
            }
            $Jobs->delete();

            return redirect()->route('admin.job_request')->with(['error' => 'تم حذف الوظيفة بنجاح']);

//        } catch (\Exception $ex) {
            return redirect()->route('admin.job')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
//        }
    }

    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
