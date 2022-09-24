<div id="startContestRegConfirmModal" class="modal fade" role="dialog" aria-labelledby="startContestRegConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-blue" id="startContestRegConfirmModalLabel"> 
                    Are you sure you want to start registration for this contest?
                </h2>                    
            </div>
            <form action="{{route('admin.startContestReg', ['contest' => $contest])}}" method="POST" id="start-contest-reg-form">
                @csrf                    
            </form>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-danger-bg btn-alert-modal" style="float:left" onclick="submitConfirmForm('#start-contest-reg-form')"> 
                    Yes, Start
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>