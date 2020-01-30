<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FieldDataRequest;
use App\Page;
use App\PageFields;
use Illuminate\Http\Request;

class PageFieldsController extends Controller
{
    public function index(Page $page)
    {
        $rows = $page->fields()->latest()->paginate(20);
        return view('admin.pages.form.field.index',compact('page','rows'));
    }

    public function create(Page $page,Request $request)
    {
        $field = new PageFields();
        $fields = Field::all();
        if ($request->ajax())
        {
            return view('admin.modals.field',compact('page','field','fields'));
        }
        return view('admin.pages.form.field.form',compact('page','field','fields'));
    }

    public function store(Page $page,FieldDataRequest $request)
    {
        $inputs = $request->all();
        $page->fields()->create($inputs);
        if ($request->ajax())
        {
            return ['status'=>true,'message' =>'Done Successfully'];
        }
        return redirect()->back()->with('message','Done Successfully');
    }

    public function show(Page $page,PageFields $field)
    {

    }

    public function edit(Page $page,PageFields $field,Request $request)
    {
        $fields = Field::all();
        if ($request->ajax())
        {
            return view('admin.modals.field',compact('page','field','fields'));
        }
        return view('admin.pages.form.field.form',compact('page','field','fields'));
    }

    public function update(Page $page,FieldDataRequest $request,PageFields $field)
    {
        $inputs = $request->all();
        $field->update($inputs);
        if ($request->ajax())
        {
            return ['status'=>true,'message' =>'Done Successfully'];
        }
        return redirect()->back()->with('message','Done Successfully');
    }

    public function destroy(Page $page,PageFields $field)
    {
        $field->delete();
        return redirect()->back()->with('message','Done Successfully');
    }
}
