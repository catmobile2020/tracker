<div class="page-info">
    @foreach($page->fields as $field)
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="name">{{$field->label_name}}</label>
                    @switch($field->field->type)
                        @case(1)
                        <input type="text" class="form-control" placeholder="{{$field->place_holder}}">
                        @break
                        @case(2)
                        <input type="number" class="form-control" placeholder="{{$field->place_holder}}">
                        @break
                        @case(3)
                        <select name="title" class="form-control">
                            @foreach($field->options as $option)
                                <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                        @break
                        @case(4)
                        @foreach($field->options as $option)
                            <div>
                                <input type="checkbox" id="{{$option}}" value="{{$option}}">
                                <label for="{{$option}}">{{$option}}</label>
                            </div>
                        @endforeach
                        @break
                        @case(5)
                        @foreach($field->options as $option)
                            <div>
                                <input type="radio" id="{{$option}}" value="{{$option}}">
                                <label for="{{$option}}">{{$option}}</label>
                            </div>
                        @endforeach
                        @break
                        @case(6)
                        <textarea class="form-control" rows="5"></textarea>
                        @break
                        @case(7)
                        <input type="file" class="form-control">
                        @break
                        @case(8)

                        @break
                    @endswitch
                </div>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-info btn-rounded editPageField" data-url="{{route('admin.fields.edit',[$page->id,$field->id])}}"><i class="fa fa-pencil"></i></button>
                <a href="{{route('admin.fields.destroy',[$page->id,$field->id])}}" class="btn btn-danger btn-rounded"><i class="fa fa-trash-o"></i></a>
            </div>
        </div>
    @endforeach
        <button type="button" class="btn btn-primary" style="background-color: {{$page->btn_color}}">{{$page->btn_text}}</button>
</div>
