  {{-- The modal and JQuery for cropping image upload --}}
  <div class="modal fade" id="cropImageModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-blue caption-header modal-title" id="modalLabel">Crop Image</h1>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="original_image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer ctrl-btn">
                <button type="button" class="btn btn-alert-modal btn-purple-bd" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-alert-modal btn-purple-bg" id="cropImage">Crop</button>
            </div>
        </div>
    </div>
</div>