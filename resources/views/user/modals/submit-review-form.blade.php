<div id="submitReviewModal" class="modal fade" role="dialog" aria-labelledby="submitReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="caption-header modal-title" id="submitReviewModalLabel"> 
                    Leave a Feedback
                </h2>                    
            </div>
            <div class="modal-body"> 
                <form action="{{route('user.submitReview')}}" method="POST" id="submit-review-form">
                    @csrf
                    <div class="form-group">
                        Please drop a review about this counsellor platform
                        <textarea name="review_body" class="form-control question" rows="3" 
                          placeholder="Tell us your experience/feedback about this platform" 
                          required>{{old('review_body') ?? Auth::user()->review->body ?? ''}}</textarea>
                    </div>

                    <div class="form-group">
                        <label> Select Rating </label><br>
                        <div id="rating-select" style="margin-top: 0.5em;">
                            @for($count = 1; $count <= 5; $count++)
                                <i class="fa-star star-rating" onclick="rateStar(`{{$count}}`)"></i>
                            @endfor
                            <input type="hidden" name="rating" id="review-rating" 
                                value="{{old('rating') ?? Auth::user()->review->rating ?? ''}}"/>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <input type="checkbox" name="publish" 
                            {{-- value="{{old('publish') ?? Auth::user()->review->published ? 'on' : 'off' ?? ''}}" --}}
                            {{old('publish') == 'on' || Auth::user()->review->published ? 'checked' : ''}}/> 
                            Publish my feedback for public view
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="text-align:left">
                <button type="button" class="btn btn-purple-bg btn-alert-modal" style="float:left" onclick="submitReview()"> 
                    Submit 
                </button>
                <button type="button" class="btn btn-primary btn-alert-modal" style="float:left" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitReview(){
        document.getElementById('submit-review-form').submit();
    }

    function rateStar(rating){
        var ratings = document.querySelectorAll('#rating-select > .fa-star');
        var review_rating = document.getElementById('review-rating')
        review_rating.value = rating;
        
        // display star rating
        for(var i=0; i<5; i++){
            ratings[i].className = `${rating <= i ? 'fas' : 'far' } fa-star star-rating`;
        }
        console.log(document.getElementById('review-rating').value)
    }
</script>