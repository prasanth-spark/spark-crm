@extends('../admin/layout/components/' . $layout)
@section('subhead')
<title>Employee Add</title>
@endsection

@section('subcontent')

    <div class="col-span-8 xl:col-span-8 mt-6 pt-6"> 
        
                    <div class="intro-y box p-6 mt-8 max-w-md m-auto sm:mt-4">
            
                        <form class="form-horizontal " method="POST" action="{{ route('employee-list-import') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file  to import</label>

                                <div class="col-md-6" style="margin: 19px;" > 
                                    <input id="csv_file" type="file"  name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4" style="margin: 19px;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Upload CSV </button>
                                 <a class="btn btn-warning" href="/admin/employee-list-export">Sample Export File</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

@endsection