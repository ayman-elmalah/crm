@include('components.flash')

<div class="row">
    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('first_name') ? ' has-error' : '' }}">
            <label>{{ __('lang.first_name') }}</label>
            <div class="input-conatiner">
                <input type="text" class="form-control" placeholder="{{ __('lang.first_name') }}" name="first_name" value="@if(old('first_name') != null){{ old('first_name') }}@elseif(isset($employee)){{$employee->first_name}}@endif">
            </div>
            @if ($errors->has('first_name'))
                <span class="help-block">
          <strong>{{ $errors->first('first_name') }}</strong>
      </span>
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('last_name') ? ' has-error' : '' }}">
            <label>{{ __('lang.last_name') }}</label>
            <div class="input-conatiner">
                <input type="text" class="form-control" placeholder="{{ __('lang.last_name') }}" name="last_name" value="@if(old('last_name') != null){{ old('last_name') }}@elseif(isset($employee)){{$employee->last_name}}@endif">
            </div>
            @if ($errors->has('last_name'))
                <span class="help-block">
          <strong>{{ $errors->first('last_name') }}</strong>
      </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <label>{{ __('lang.email') }}</label>
            <div class="input-conatiner">
                <input type="email" class="form-control" placeholder="{{ __('lang.email') }}" name="email" value="@if(old('email') != null){{ old('email') }}@elseif(isset($employee)){{$employee->email}}@endif">
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
            <label>{{ __('lang.phone') }}</label>
            <div class="input-conatiner">
                <input type="text" class="form-control" placeholder="{{ __('lang.phone') }}" name="phone" value="@if(old('phone') != null){{ old('phone') }}@elseif(isset($employee)){{$employee->phone}}@endif">
            </div>
            @if ($errors->has('phone'))
                <span class="help-block">
          <strong>{{ $errors->first('phone') }}</strong>
      </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group has-feedback {{ $errors->has('company_id') ? ' has-error' : '' }}">
            <label>{{ __('lang.company_id') }}</label>
            <div class="input-conatiner">
                <select name="company_id" class="form-control">
                    @forelse($companies as $company)
                        <option value="{{ $company->id }}" @if(old('company_id') == $company->id) selected @elseif(isset($employee) && $employee->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            @if ($errors->has('company_id'))
                <span class="help-block">
                <strong>{{ $errors->first('company_id') }}</strong>
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
