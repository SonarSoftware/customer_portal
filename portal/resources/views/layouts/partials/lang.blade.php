<div class="form-inline text-right">
    <p>
        <div class="form-group">
            <label class="sr-only">{{trans("general.language")}}</label>
            <p class="form-control-static">{{trans("general.language")}}</p>
        </div>
        <div class="form-group">
            <select id="languageSelector" class="form-control">
                @foreach(getAvailableLanguages($language) as $key => $value)
                    <option value="{{$key}}" @if($language == $key) selected @endif>{{$value}}</option>
                @endforeach
            </select>
        </div>
    </p>
</div>
