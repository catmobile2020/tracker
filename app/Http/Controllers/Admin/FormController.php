<?php

namespace App\Http\Controllers\Admin;

use App\Form;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormDataRequest;
use App\Result;
use App\UserForms;

class FormController extends Controller
{
    use  UploadImage;

    public function index()
    {
        $rows = Form::latest()->paginate(20);
        return view('admin.pages.form.index',compact('rows'));
    }

    public function create()
    {
        $form = new Form;
        return view('admin.pages.form.form',compact('form'));
    }

    public function store(FormDataRequest $request)
    {
        $inputs = $request->all();
        $form = Form::create($inputs);
        $this->upload($request->logo,$form,'logo');
        return redirect()->route('admin.forms.index')->with('message','Done Successfully');
    }

    public function show($id)
    {

    }

    public function edit(Form $form)
    {
        return view('admin.pages.form.form',compact('form'));
    }

    public function update(FormDataRequest $request, Form $form)
    {
        $inputs = $request->all();
        $form->update($inputs);
        if ($request->logo)
            $this->upload($request->logo,$form,'logo',true);
        return redirect()->route('admin.forms.index')->with('message','Done Successfully');
    }

    public function destroy(Form $form)
    {
        $form->trash();
        return redirect()->route('admin.forms.index')->with('message','Done Successfully');
    }

    public function users(Form $form)
    {
        $rows = $form->forms()->latest()->paginate(20);
        return view('admin.pages.form.user.index',compact('form','rows'));
    }

    public function formResult(Form $form,UserForms $row)
    {
        $result = $row->result;
        return view('admin.pages.form.user.result',compact('form','row','result'));
    }
}
