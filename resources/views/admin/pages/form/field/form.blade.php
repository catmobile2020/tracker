@extends('admin.layouts.master')

@section('title','field')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>field</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
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
                        <form action="{{isset($field->id) ? route('admin.fields.update',[$page->id,$field->id]) : route('admin.fields.store',$page->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @isset($field->id)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="label_name">label name</label>
                                        <input type="text" name="label_name" class="form-control" id="label_name" placeholder="label name" value="{{$field->label_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="place_holder">place holder</label>
                                        <input type="text" name="place_holder" class="form-control" id="place_holder" placeholder="place holder" value="{{$field->place_holder}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row {{$field->field->type == 2 ? '' : 'sr-only'}} numFields">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="min_value">min value</label>
                                        <input type="number" name="min_value" class="form-control" id="min_value" placeholder="min value" value="{{$field->min_value}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="max_value">max value</label>
                                        <input type="number" name="max_value" class="form-control" id="max_value" placeholder="max value" value="{{$field->max_value}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="is_required"> required</label>
                                        <select name="is_required" class="form-control" id="is_required" >
                                            <option value="1" {{$field->is_required == 1 ? 'selected' : ''}}>Yes</option>
                                            <option value="0" {{$field->is_required == 0 ? 'selected' : ''}}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="field_id">Field Type</label>
                                        <select name="field_id" class="form-control changeFieldType" id="field_id" >
                                            @foreach ($fields as $fie)
                                                <option value="{{$fie->id}}" {{ $fie->id == $field->field_id ? 'selected' : ''}}>{{$fie->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row  {{in_array($field->field->type,[3,4,5]) ? '' : 'sr-only'}} multiValues">
                                <a class="btn btn-primary btn-rounded addNewOption">+</a>
                                <div class="content">
                                    @isset($field->id)
                                        @foreach($field->options as $option)
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>options</label>
                                                    <input type="text" name="options[]" class="form-control" placeholder="options" value="{{$option}}">
                                                </div>
                                                <a class="btn btn-danger btn-rounded removeOption">-</a>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>options</label>
                                            <input type="text" name="options[]" class="form-control" placeholder="options" value="">
                                        </div>
                                        <a class="btn btn-danger btn-rounded removeOption">-</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('admin.fields.index',$page->id)}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
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
