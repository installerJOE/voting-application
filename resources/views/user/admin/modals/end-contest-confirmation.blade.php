<div id="endContestConfirmModal" class="modal fade" role="dialog" aria-labelledby="endContestConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-red" id="endContestConfirmModalLabel"> 
                    Do you really want to end this contest? There is no going back.
                </h2>                    
            </div>
            <form action="{{route('admin.endContest', ['contest' => $contest])}}" method="POST" id="end-contest-form">
                @csrf                    
            </form>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-danger-bg btn-alert-modal" style="float:left" onclick="endContest()"> 
                    Yes, End
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>

<script>
    function endContest(){
        document.getElementById('end-contest-form').submit();
    }
</script>