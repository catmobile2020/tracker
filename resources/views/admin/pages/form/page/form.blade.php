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
                                    <label for="address">Background color</label>
                                    <div class="input-group color-picker">
                                        <input type="text" name="bg_color" value="{{$page->bg_color}}" data-format="hex" autocomplete="off" class="form-control colorpicker colorpicker-element">
                                        <span class="input-group-addon"><i class="icon-color-preview"  style="background-color: rgb(255, 255, 255);"></i></span>
                                    </div>
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
        </div>
    </div>
@endsection
