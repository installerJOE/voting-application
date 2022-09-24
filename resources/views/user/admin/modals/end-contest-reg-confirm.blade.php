<div id="endContestRegConfirmModal" class="modal fade" role="dialog" aria-labelledby="endContestRegConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-blue" id="endContestRegConfirmModalLabel"> 
                    Are you sure you want to end the registration?
                </h2>                    
            </div>
            <form action="{{route('admin.endContestReg', ['contest' => $contest])}}" method="POST" id="end-contest-reg-form">
                @csrf                    
            </form>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-danger-bg btn-alert-modal" style="float:left" onclick="submitConfirmForm('#end-contest-reg-form')"> 
                    Yes, End
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>