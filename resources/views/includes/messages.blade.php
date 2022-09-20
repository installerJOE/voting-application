<!-- Modal -->
<div id="alertModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered">  
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" id="modalBody"> 
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="alert-msg text-red alert-danger-msg"> {{$error}} </p>
                    @endforeach
                @endif
                
                @if(session('info') || isset($info))
                    <p class="alert-msg text-blue alert-info alert-info-msg"> {{session('info')}} </p>
                @endif

                @if(session('success') || isset($success))
                    <p class="alert-msg text-green alert-success-msg"> {{session('success')}} </p>
                @endif

                @if(session('error') || isset($error))
                    <p class="alert-msg text-red alert-danger-msg"> {{session('error')}} </p>
                @endif
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
