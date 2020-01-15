<?php

namespace App\Http\Controllers\Api;

use App\Form;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormDataResource;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"forms"},
     *      path="/forms",
     *      summary="Get forms",
     *      security={
     *          {"jwt": {}}
     *      },
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function index()
    {
        $forms = Form::with('pages')->get();
        return FormDataResource::collection($forms);
    }


    /**
     *
     * @SWG\Get(
     *      tags={"forms"},
     *      path="/forms/{form}",
     *      summary="Get single form",
     *      security={
     *          {"jwt": {}}
     *      },
     *     @SWG\Parameter(
     *         name="form",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     * @param Form $form
     * @return FormDataResource
     */
    public function show(Form $form)
    {
        return FormDataResource::make($form);
    }
}
