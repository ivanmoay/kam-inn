@props(['main_class','label', 'name', 'value', 'placeholder'])
<div class="{{$main_class}}">
    <label for="inputEmail3" class="col-sm-2 col-form-label">{{$label}}</label>
    <div class="col-sm-10">                            
    <input type="text" class="form-control" id="inputText" name="{{$name}}" placeholder="{{@$placeholder}}" value="{{$value}}">
    @error($name)
        <code>{{$message}}</code>
    @enderror                            
    </div>
</div>