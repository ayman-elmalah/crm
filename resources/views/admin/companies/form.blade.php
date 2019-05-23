@include('components.flash')

<div class="row">
    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
            <label>{{ __('lang.name') }}</label>
            <div class="input-conatiner">
                <input type="text" class="form-control" placeholder="{{ __('lang.name') }}" name="name" value="@if(old('name') != null){{ old('name') }}@elseif(isset($company)){{$company->name}}@endif">
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <label>{{ __('lang.email') }}</label>
            <div class="input-conatiner">
                <input type="email" class="form-control" placeholder="{{ __('lang.email') }}" name="email" value="@if(old('email') != null){{ old('email') }}@elseif(isset($company)){{$company->email}}@endif">
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('website') ? ' has-error' : '' }}">
            <label>{{ __('lang.website') }}</label>
            <div class="input-conatiner">
                <input type="url" class="form-control" placeholder="{{ __('lang.website') }}" name="website" value="@if(old('website') != null){{ old('website') }}@elseif(isset($company)){{$company->website}}@endif">
            </div>
            @if ($errors->has('website'))
                <span class="help-block">
          <strong>{{ $errors->first('website') }}</strong>
      </span>
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('logo') ? ' has-error' : '' }}">
            <label>{{ __('lang.logo') }} 100px*100px or more recommended</label>
            <div class="input-conatiner">
                <input type="file" class="form-control" name="logo">
                @if(isset($company) && $company->logo != null)
                    <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="thumb-image">
                @endif
            </div>
            @if ($errors->has('logo'))
                <span class="help-block">
          <strong>{{ $errors->first('logo') }}</strong>
      </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="form-actions">
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
        <button type="reset" class="btn btn-danger">{{ __('lang.cancel') }}</button>
    </div>
</div>
