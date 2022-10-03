<div id="editContestRegDataModal" class="modal fade" role="dialog" aria-labelledby="editContestRegDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-peach" id="editContestRegDataModalLabel"> 
                    Edit Registration Data
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('admin.contests.updateContestBaseData', ['contest' => $contest])}}" method="POST" id="change-contest-reg-data-form">
                    @csrf
                    <label>  Start Date </label> 
                    <input type="date" name="registration_start_date" value="{{old('registration_start_date') ??  \Illuminate\Support\Carbon::parse($contest->registration_start_at)->format('Y-m-d')}}"
                        class="form-control" {{$contest->registration_status() == "active" ? "disabled" : ""}}/>

                    <label> Duration of Registration (Days) </label> 
                    <input type="number" name="registration_duration" value="{{old('registration_duration') ?? $contest->registration_duration()}}" class="form-control" placeholder="e.g. 10"/>    
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('change-contest-reg-data-form')"> 
                    Update Contest
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>