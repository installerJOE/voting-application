<div id="editContestVotingDataModal" class="modal fade" role="dialog" aria-labelledby="editContestVotingDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header text-blue modal-title" id="editContestVotingDataModalLabel"> 
                    Edit Voting Data
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('admin.contests.updateContestVotingData', ['contest' => $contest])}}" method="POST" id="update-voting-data-form">
                    @csrf
                    
                    <label>  Start Date </label>
                    <input type="date" name="voting_start_date" value="{{old('voting_start_date') ?? \Illuminate\Support\Carbon::parse($contest->vote_start_at)->format('Y-m-d')}}" class="form-control"/>
                    
                    <label> Duration of Voting (Days) </label>
                    <input type="number" name="voting_duration" value="{{old('voting_duration') ?? $contest->voting_duration()}}" class="form-control" placeholder="e.g. 10"/>

                    <label> Amount Per Vote (NGN) </label>
                    <input type="number" name="amount_per_vote" value="{{old('amount_per_vote') ?? $contest->amount_per_vote}}" class="form-control" placeholder="e.g. 50" required/>
                </form>
            </div>
            
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('update-voting-data-form')"> 
                    Update 
                </button>
                <button type="button" class="btn btn-peach-bg btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>