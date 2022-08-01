@extends('../employee/layout/components/' . $layout)

@section('subhead')
<title>Employee List</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto"></h2>
    <form>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                        From Date
                    </label>
                    <input id="from" class="form-control" type="tel" maxlength="10" placeholder="dd/mm/yyyy" oninput="this.value = DDMMYYYY(this.value, event)" name="from_date" required>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-1" class="form-label w-full flex flex-col sm:flex-row">
                        To Date
                    </label>
                    <input id="to" type="tel" class="form-control" maxlength="10" placeholder="dd/mm/yyyy" oninput="this.value = DDMMYYYY(this.value, event)" name="to_date" required>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <label for="regular-form-4" class="form-label w-full flex flex-col sm:flex-row">Team</label>

                    <select placeholder="Team Name" type="text" class="tom-select w-full" id="team" name='team_name'>
                        <option value selected="selected" disabled="disabled"></option>
                        @foreach($teamList as $t)
                        <option value="{{$t->id}}">{{$t->team}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-primary mt-5" onclick="attendanceFilter()">Filter</button>
        </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table id="employee" class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">SI.No</th>
                <th class="whitespace-nowrap">DATE</th>
                <th class="whitespace-nowrap">NAME</th>
                <th class="whitespace-nowrap">TEAM</th>
                <th class="whitespace-nowrap">ROLE</th>
                <th class="whitespace-nowrap">ATTENDANCE STATUS</th>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript" src="{{URL::asset('dist/js/employeelistpagination/attendance-list-pagination.js')}}">

    function DDMMYYYY(value, event) {
        let newValue = value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');

        const dayOrMonth = (index) => index % 2 === 1 && index < 4;

        // on delete key.  
        if (!event.data) {
            return value;
        }

        return newValue.split('').map((v, i) => dayOrMonth(i) ? v + '/' : v).join('');;
    }
</script>


@endsection