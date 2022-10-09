<div id="deleteContestConfirmModal" class="modal fade" role="dialog" aria-labelledby="deleteContestConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-blue" id="deleteContestConfirmModalLabel"> 
                    Are you sure you want to delete this contest?
                </h2>                    
            </div>
            <form action="{{route('admin.contests.deleteContest', ['contest' => $contest])}}" method="POST" id="delete-contest-form">
                @csrf                       
            </form>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-danger-bg btn-alert-modal" style="float:left" onclick="submitConfirmForm('#delete-contest-form')"> 
                    Yes, Delete
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>