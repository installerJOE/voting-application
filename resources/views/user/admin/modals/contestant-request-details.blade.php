<div id="contestRequestDetailsModal" class="modal fade" role="dialog" aria-labelledby="contestRequestDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title text-peach" id="contestRequestDetailsModalLabel"></h1>                    
            </div>
            <div class="modal-body" id="contest-request-modal"> 
                <form action="{{route('admin.contests.acceptContestant', ['slug' => $contest->slug])}}" method="POST" id="approve-contestant-request-form">
                    @csrf
                    <input type="hidden" name="contestant_id" id="contestant" value="{{old('contestant_id')}}"/>
                </form>

                <div class="col-md-12 col-12">
                    <p class="text-blue"> Cover Images </p>
                    <div id="contestant-modal-image-container"></div>
                </div>

                <div class="col-md-12 col-12 mt-1">
                    <p class="text-blue"> Profile </p> <hr class="modal-hr"/>
                    <p id="modal-contestant-profile"></p>
                </div>

            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-blue-bg btn-alert-modal" style="float:left" onclick="submitModalForm('approve-contestant-request-form')"> 
                    Approve
                </button>
                <button type="button" class="btn btn-peach-bg btn-alert-modal" style="float:left" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showContestantRequestDetail(contestant, images, public_path){
        var contestant = JSON.parse(contestant);
        var images = JSON.parse(images);
        
        document.getElementById('contestRequestDetailsModalLabel').innerHTML = `Contestant #${contestant.contestant_number}`
        document.getElementById('modal-contestant-profile').innerHTML = contestant.profile_overview

        $('#contestant').val(contestant.id)

        var imageContainer = document.getElementById('contestant-modal-image-container');
        imageContainer.innerHTML = "";
        for(let i=0; i<images.length; i++){
            imageContainer.innerHTML += 
            `<div class="col-md-6 col-sm-12 col-12 contest-image">
                <img src="${public_path + '/images/contestants/' + images[i].image_url}" width="100%" height="auto"/>
            </div>`;
        }

        $("#contestRequestDetailsModal").modal('show');
    }
</script>