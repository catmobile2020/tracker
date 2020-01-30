<?php

namespace App\Http\Controllers\Api;

use App\Form;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubmitFormRequest;
use App\Http\Resources\FormDataResource;
use App\Http\Resources\ResultDataResource;
use App\Result;
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
        $forms = Form::with('pages')->paginate(5);
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


    /**
     *
     * @SWG\Post(
     *      tags={"forms"},
     *      path="/forms/{form}/submit",
     *      summary="submit form",
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
     * @param SubmitFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Form $form,SubmitFormRequest $request)
    {
        $request = new Request();
        $request['fields'] =[
                [
                    'value'=>"test Submit",
                    'page_fields_id'=>1
                ],[
                    'value'=>"9",
                    'page_fields_id'=>2
                ],[
                    'value'=>"55",
                    'page_fields_id'=>3
                ],[
                    'value'=>"13",
                    'page_fields_id'=>4
                ]
             ];
        try
        {
            $user = auth()->user();
            $user_form = $user->forms()->create(['form_id'=>$form->id]);
            foreach ($request->fields as $field)
            {
                $user_form->result()->create($field);
            }
            return response()->json(['message' => 'Submit Successfully'],200);

        }catch (\Exception $exception)
        {
            return response()->json(['error' => 'Error Happen Try Again'], 400);
        }
    }
}
