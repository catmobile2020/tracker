<?php

namespace App\Http\Controllers\Admin;

use App\Form;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageDataRequest;
use App\Page;

class PageController extends Controller
{
    public function index(Form $form)
    {
        $rows = $form->pages()->latest()->paginate(20);
        return view('admin.pages.form.page.index',compact('form','rows'));
    }

    public function create(Form $form)
    {
        $page = new Page();
        return view('admin.pages.form.page.form',compact('form','page'));
    }

    public function store(Form $form,PageDataRequest $request)
    {
        $inputs = $request->all();
        $page = $form->pages()->create($inputs);
        return redirect()->route('admin.pages.index',$form->id)->with('message','Done Successfully');
    }

    public function show(Form $form,Page $page)
    {

    }

    public function edit(Form $form,Page $page)
    {
        return view('admin.pages.form.page.form',compact('form','page'));
    }

    public function update(Form $form,PageDataRequest $request,Page $page)
    {
        $inputs = $request->all();
        $page->update($inputs);
        return redirect()->route('admin.pages.index',$form->id)->with('message','Done Successfully');
    }

    public function destroy(Form $form,Page $page)
    {
        $page->trash();
        return redirect()->route('admin.pages.index',$form->id)->with('message','Done Successfully');
    }
}
