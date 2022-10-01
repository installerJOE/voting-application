<div id="editContestVotingDataModal" class="modal fade" role="dialog" aria-labelledby="editContestVotingDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title" id="editContestVotingDataModalLabel"> 
                    Edit Registration Data
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('admin.contests.updateContestBaseData', ['contest' => $contest])}}" method="POST" id="change-contest-voting-data-form">
                    @csrf
                    
                    <label>  Start Date </label> </td>
                    <input type="date" name="voting_start_date" value="{{old('voting_start_date')}}" class="form-control"/>
                    
                    <label> Duration of Voting (Days) </label>
                    <input type="number" name="voting_duration" value="{{old('voting_duration')}}" class="form-control" placeholder="e.g. 10"/>
                </form>
            </div>
            
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('change-contest-voting-data-form')"> 
                    Update Contest
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>