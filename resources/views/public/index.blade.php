@extends('layouts.app')

@section('meta-content')
	<title> Home | {{config('app.name')}} </title>
    <style>
        #home-opening-div{
            background: url({{asset('images/index-1.jpg')}})
        }
        .carousel-item p{
            width: 80%;
            margin: auto;
        }
    </style>  
@endsection

@section('content')
    <div class="parent-opening-div">
        <div class="row image-zoom-div" id="home-opening-div">   
        </div>
        <div class="row opening-page-div">
            <div class="col-md-8 col-sm-9 col-12">
                <h1 class="text-blue xxl-header" style="line-height: 1.2em"> 
                    Welcome to our Voting Application
                </h1>
                <p class="text-light-grey">
                    Your vote for each contest does count!
                </p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){    
            changeImageBg();
        });
        
        let index = 0;
        let timeout;
        var imageDiv = document.querySelector('#home-opening-div');
        function changeImageBg(){
            imageDiv.style.backgroundImage = `url('../images/index-${index+1}.jpg')`;
            if(index < 1){
                index++;
            }
            else{
                index = 0;
            }
            timeout = setTimeout(changeImageBg, 5000);
        }

    </script>
@endsection