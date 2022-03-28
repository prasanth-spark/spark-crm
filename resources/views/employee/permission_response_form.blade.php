@extends('../employee/layout/components/' . $layout)
@section('subhead')
    <title>Response Form</title>
@endsection

@section('subcontent')
            <div class="mt-4 mb-4 grid grid-cols-12  intro-y">
                <div class="col-span-12  relative text-center sm:text-left">
                    <div class="text-black text-sm 2xl:text-base font-medium -mb-1">Hi {{$teamLead['name']}} , </div>  
                     <p class="text-black mt-4">Permission Response to {{$user->name}} for {{$hoursdiff}} hours </p>
                </div>
                    <form action="{{route('permission-status')}}" method="post">
              @csrf
                    <div class="mt-5">
                      <div class="flex flex-col sm:flex-row mr-2 mt- 5">
                        <div class="form-check mr-5 mb-5">
                         <input id="accept" class="form-check-input" type="radio" name="leave_response"  value="2">
                         <label class="form-check-label text-black" for="active">Accepted</label>
                        </div>
                        <div class="form-check mr-5 mb-5">
                            <input id="reject" class="form-check-input" type="radio" name="leave_response" value="3">
                            <label class="form-check-label text-black" for="inactive">Rejected</label>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
                      </div>
                      <div class="flex flex-col">
                        <select class="form-select form-select-md  mb-6" id="reason" name="rejected_reason" aria-label=".form-select-lg" style="width:25em;">
                            <option> </option>
                            <option name="rejected_reason" value="Office time also reduced">Office Time  also reduced</option>
                            <option name="rejected_reason" value="Death time is near for your project">Death time is near for the project</option>
                        </select>
                      </div>
                      <div class="cols-12 gap-4 mt-6"> 
                        <button class="btn btn-success mt-4" id="save_button" type="submit">Submit</button> 
                      </div> 
                    </div>                     
                    </form>
                </div>
            </div>  
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#reason").hide();
    $("#reject").click(function(){
        $("#reason").show();
    });
    $("#accept").click(function(){
    $("#reason").hide();
    });
    });
</script>