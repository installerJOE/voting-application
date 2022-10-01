<div id="startContestVotingConfirmModal" class="modal fade" role="dialog" aria-labelledby="startContestVotingConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p class="" id="startContestVotingConfirmModalLabel"> 
                    Are you sure you want to start voting session for this contest?
                </p>                    
                <p class="text-red mt-2">
                    Note: Registration will end automatically
                </p>
            </div>
            <form action="{{route('admin.startContestVoting', ['contest' => $contest])}}" method="POST" id="start-contest-voting-form">
                @csrf                    
            </form>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-danger-bg btn-alert-modal" style="float:left" onclick="submitConfirmForm('#start-contest-voting-form')"> 
                    Yes, Start
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>