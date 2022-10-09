<div id="becomeASponsorModal" class="modal fade" role="dialog" aria-labelledby="becomeASponsorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="sub-header modal-title text-blue" id="becomeASponsorModalLabel"> 
                    Become a Partner
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('public.sendSponsorshipRequest', ['contest' => $contest])}}" method="POST" id="sponsorship-request-form">
                    @csrf
                    <span> Company/Business Name </span>
                    <input type="text" name="company_name" class="form-control" placeholder="e.g. Google Developer Groups, Warri"/> 

                    <span> Email address </span>
                    <input type="email" name="email" class="form-control" placeholder="e.g. joemike@gmail.com"/> 

                    <span> Name of Sender </span>
                    <input type="text" name="sender_name" class="form-control" placeholder="e.g. Joe Mike"/> 

                    <span> Job Role/Position </span>
                    <input type="text" name="job_role" class="form-control" placeholder="e.g. Lead Software Engineer"/> 
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('sponsorship-request-form')"> 
                    Send Request
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>