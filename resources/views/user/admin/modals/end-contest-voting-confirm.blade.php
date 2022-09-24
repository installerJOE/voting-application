<div id="endContestVotingConfirmModal" class="modal fade" role="dialog" aria-labelledby="endContestVotingConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-blue" id="endContestVotingConfirmModalLabel"> 
                    Are you sure you want to automatically end voting for this contest?
                </h2>                    
            </div>
            <form action="{{route('admin.endContestVoting', ['contest' => $contest])}}" method="POST" id="end-contest-voting-form">
                @csrf                    
            </form>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-danger-bg btn-alert-modal" style="float:left" onclick="submitConfirmForm('#end-contest-voting-form')"> 
                    Yes, End
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>