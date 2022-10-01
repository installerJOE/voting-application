<div id="editContestantProfileModal" class="modal fade" role="dialog" aria-labelledby="editContestantProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title" id="editContestantProfileModalLabel"> 
                    Update Profile
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('contestant.updateProfile', ['contestant' => $contestant])}}" method="POST" id="edit-contestant-profile-form">
                    @csrf
                    <div class="form-group">
                        Profile Overview
                        <textarea name="profile_overview" class="form-control" rows="5" 
                          placeholder="Tell people a little about yourself and why they should vote for you" 
                          required>{{old('profile_overview') ?? $contestant->profile_overview}}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-peach-bg btn-alert-modal" style="float:left" onclick="submitModalForm('edit-contestant-profile-form')"> 
                    Update Profile
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>