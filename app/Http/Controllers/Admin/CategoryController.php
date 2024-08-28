<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {

        return view('admin.category.add');
    }

    public function store(CategoryRequest $request)
    {
//        return $request ;
        try {
            $category = Category::create([
                'name'=>$request->name,
            ]);
            return redirect()->route('admin.category')->with(['success' => 'تم الحفظ بنجاح']);

        }catch (\Exception $ex){

        }
        return redirect()->route('category')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);



    }
    public function index()
    {
        $Category = Category::Selection()->paginate(PAGINATION_COUNT);
        return view('admin.category.index', compact('Category'));


    }
    public function edit($id)
    {
        $Category = Category::Selection()->find($id);

        if (!$Category)
            return redirect()->route('admin.category')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.category.edit', compact('Category'));

    }
    public function update($id, CategoryRequest $request)
    {

        try {
            $Jobs = Category::find($id);
            if (!$Jobs) {
                return redirect()->route('category', $id)->with(['error' => 'هذه القسم غير موجوده']);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $Jobs->update($request->except('_token'));

            return redirect()->route('category.admin')->with(['success' => 'تم تحديث القسم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
    public function destroy($id){
        try {
            $Category = Category::find($id);
            if (!$Category) {
                return redirect()->route('category', $id)->with(['error' => 'هذه الوظيفة غير موجوده']);
            }
            $Category->delete();

            return redirect()->route('admin.category')->with(['error' => 'تم حذف الوظيفة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


}
