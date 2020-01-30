@extends('admin.layouts.master')

@section('title','Pages')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>Pages</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix text-center">
                        <h3> Page Info</h3>
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                                <h4>{{session()->get('message')}}</h4>
                            </div>
                        @endif
                        <form action="{{isset($page->id) ? route('admin.pages.update',[$form->id,$page->id]) : route('admin.pages.store',$form->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($page->id)
                                @method('PUT')
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input type="text" name="title" class="form-control" id="name" placeholder="Title" value="{{$page->title}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea name="description" rows="7" class="form-control" id="desc" placeholder="description">{{$page->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="bg_type">Background Type</label>
                                    <select name="bg_type" class="form-control changeBackgroundType">
                                        <option value>Choose Type</option>
                                        <option value="1" {{$page->bg_type == 1 ? 'selected' : ''}}>Color</option>
                                        <option value="2" {{$page->bg_type == 2 ? 'selected' : ''}}>Image</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 colorBackgroundType {{$page->bg_type != 1 ? 'sr-only' : ''}}">
                                <div class="form-group">
                                    <label for="address">Background color</label>
                                    <div class="input-group color-picker">
                                        <input type="text" name="bg_color" value="{{$page->bg_color}}" data-format="hex" autocomplete="off" class="form-control colorpicker colorpicker-element">
                                        <span class="input-group-addon"><i class="icon-color-preview"  style="background-color: rgb(255, 255, 255);"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 imageBackgroundType {{$page->bg_type != 2 ? 'sr-only' : ''}}">
                                <div class="form-group">
                                    <label for="address">Background Image</label>
                                    <input type="file" name="bg_photo" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="address">Button color</label>
                                    <div class="input-group color-picker">
                                        <input type="text" name="btn_color" value="{{$page->btn_color}}" data-format="hex" autocomplete="off" class="form-control colorpicker colorpicker-element">
                                        <span class="input-group-addon"><i class="icon-color-preview"  style="background-color: rgb(255, 255, 255);"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="address">Button Text</label>
                                    <input type="text" name="btn_text" value="{{$page->btn_text}}" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('admin.pages.index',$form->id)}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix text-center">
                        <h3> Page Fields</h3>
                    </div>
                    @isset($page->id)
                    <div class="panel-body" style="@if($page->bg_type == 1) background-color: {{$page->bg_color}}; @else background-size:cover; background-image: url({{$page->photo}}) @endif">
                        @include('admin.pages.form.page.fields')
                        <div class="row text-right">
                            <button type="button" class="btn btn-primary addNewFiled">New Field</button>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.addNewFiled').click(function (e) {
            e.preventDefault();
            $.ajax({
                url:"/{{$page->id}}/fields/create",
                success:function (result) {
                    $('#insertModalData').html(result);
                    $('#showModalData').modal('show');
                }
            });
        });

        $('.editPageField').click(function (e) {
            e.preventDefault();
            let field = $(this);
            let url = field.data('url');
            $.ajax({
                url:url,
                success:function (result) {
                    $('#insertModalData').html(result);
                    $('#showModalData').modal('show');
                }
            });
        });


        $(document).on('submit','.form-ajax',function (e) {
            e.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();
            $.ajax({
                url:url,
                data:data,
                method:"post",
                success:function (result) {
                    console.log(result);
                    form.find('.insertResponse').html(result.message);
                    form.find('.insertResponse').removeClass('sr-only');
                    if (result.status == true)
                    {
                        setTimeout(function () {
                            window.location.reload();
                        },2000);
                    }
                },
                error:function (errors) {
                    console.log(errors.responseJSON.errors);
                    $('#insertErrors').html(errors.responseJSON.errors);
                    let validation_errors;
                    // errors.responseJSON.errors.each(function (error) {
                    //     validation_errors+=error;
                    // });
                    //
                    // console.log(validation_errors);
                }
            });
        });
    </script>
    <script>
        $(document).on('change','.changeFieldType',function () {
            let value = $(this).val();
            if (value == 2)
            {
                $('.numFields').removeClass('sr-only');
            }else
            {
                $('.numFields').addClass('sr-only');
            }
            if ([3,4,5].includes(parseInt(value)))
            {
                $('.multiValues').removeClass('sr-only');
            }else
            {
                $('.multiValues').addClass('sr-only');
            }
        });

        $(document).on('change','.changeBackgroundType',function () {
            let value = $(this).val();
            if (value == 1)
            {
                $('.colorBackgroundType').removeClass('sr-only');
                $('.imageBackgroundType').addClass('sr-only');
            }else
            {
                $('.imageBackgroundType').removeClass('sr-only');
                $('.colorBackgroundType').addClass('sr-only');
            }
        });

        $(document).on('click','.addNewOption',function (e) {
            e.preventDefault();
            let newElement = `
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>options</label>
                            <input type="text" name="options[]" class="form-control" placeholder="options" value="">
                        </div>
                       <a class="btn btn-danger btn-rounded removeOption">-</a>
                    </div>
            `;
            $(this).parent().find('.content').append(newElement);
        });

        $(document).on('click','.removeOption',function (e) {
            e.preventDefault();
            $(this).parent().remove();
        });
    </script>
@endsection

@section('modal')
{{--    @include('admin.modals.field')--}}
@endsection
