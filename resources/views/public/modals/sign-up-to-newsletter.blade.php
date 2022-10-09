<div id="signUpToNewsletterModal" class="modal fade" role="dialog" aria-labelledby="signUpToNewsletterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-peach" id="signUpToNewsletterModalLabel"> 
                    Sign Up To Our Newsletter
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('public.subscribeNewsletter', ['contest' => $contest])}}" method="POST" id="subscribe-newsletter-form">
                    @csrf
                    <span> Enter your email address </span>
                    <input type="email" name="email" class="form-control" placeholder="e.g. joemike@gmail.com"/> 
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('subscribe-newsletter-form')"> 
                    Sign up
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>