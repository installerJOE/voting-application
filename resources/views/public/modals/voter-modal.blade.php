<div id="voteContestantModal" class="modal fade" role="dialog" aria-labelledby="voteContestantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title" id="voteContestantModalLabel"> 
                    Vote Contestant
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('public.voteContestant', [
                    'slug' => $contestant->contest->slug, 'contestant_number' => $contestant->contestant_number
                ])}}" method="POST" id="vote-contestant-form">
                    @csrf
                    <label> Username </label>
                    <input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="e.g. JohndoeMan" required>

                    <label> Phone Contact </label>
                    <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}" placeholder="e.g. +234 80 2992 3948" required>

                    <input type="hidden" name="contestant_id" value="1"/>
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitVote()"> 
                    Submit Vote
                </button>
                <button type="button" class="btn btn-default btn-alert-modal" style="float:left" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitVote(){
        document.getElementById('vote-contestant-form').submit();
    }
</script>