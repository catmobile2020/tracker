<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FieldDataRequest;
use App\Page;
use App\PageFields;

class PageFieldsController extends Controller
{
    public function index(Page $page)
    {
        $rows = $page->fields()->latest()->paginate(20);
        return view('admin.pages.form.field.index',compact('page','rows'));
    }

    public function create(Page $page)
    {
        $field = new PageFields();
        $fields = Field::all();
        return view('admin.pages.form.field.form',compact('page','field','fields'));
    }

    public function store(Page $page,FieldDataRequest $request)
    {
        $inputs = $request->all();
        $page->fields()->create($inputs);
        return redirect()->route('admin.fields.index',$page->id)->with('message','Done Successfully');
    }

    public function show(Page $page,PageFields $field)
    {

    }

    public function edit(Page $page,PageFields $field)
    {
        $fields = Field::all();
        return view('admin.pages.form.field.form',compact('page','field','fields'));
    }

    public function update(Page $page,FieldDataRequest $request,PageFields $field)
    {
        $inputs = $request->all();
        $field->update($inputs);
        return redirect()->route('admin.fields.index',$page->id)->with('message','Done Successfully');
    }

    public function destroy(Page $page,PageFields $field)
    {
        $field->trash();
        return redirect()->route('admin.fields.index',$page->id)->with('message','Done Successfully');
    }
}
