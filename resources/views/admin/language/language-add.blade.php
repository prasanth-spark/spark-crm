@extends('../admin/layout/components/' . $layout)
@section('subhead')
<title>Language</title>
@endsection

@section('subcontent')
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
<div class="preview">
                    <!-- BEGIN: Validation Form -->
                    <form action="{{route('add-language-process')}}" method="post">
                        @csrf
                        <div class="grid grid-cols-12 gap-12 mt-5">
                            <div class="col-span-12 md:col-span-12">
                            <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">
                                        Language
                            </label>
                                    <input id="regular-form-4" type="text" class="form-control" placeholder=" Language" name='language'  required>
                            </div>
                        </div>
                       
                            <div>
                                <button type="submit" class="btn btn-primary mt-5">Add</button>
                                <a href="/admin/employee-list" class="btn btn-primary mt-5">Back</a>
                            </div>
                    </form>
                </div>
   
</div>

 @endsection