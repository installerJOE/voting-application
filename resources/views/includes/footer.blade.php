<footer>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-9 col-12 footer-sub-div">
            <a href={{route('public.home')}}>
                {{-- <img src="{{asset('images/logo.png')}}" width="auto" height="40px"/> --}}
                <h1 class="footer-header">
                    MyVotingApp
                </h1>
            </a>
            <p class="text-light mt-1">
                We are a worldwide voting application solution for beauty contests, fashion contests
                as well as other business contests.
            </p>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-12 col-12 footer-sub-div">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 footer-sub-div">
          <div>
            <h1 class="footer-header">
                Quick Links
            </h1><hr class="footer-hr"/>
            <p class="mt-1" style="line-height: 2em">
              <a href="{{route('public.about')}}" class="links"> About Us </a> <br>
              <a href="{{route('public.contact')}}" class="links">Our Contact</a> <br>
              <a href="{{route('public.contests')}}" class="links"> Contests </a> <br>
            </p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 footer-sub-div">
          <div>
            <h1 class="footer-header">
                Newsletter
            </h1><hr class="footer-hr"/>
            <p class="text-light mt-1">
                Subscribe for latest news on My Counsellor.
                <form class="footer-form" action="{{route('public.subscribeNewsletter')}}" method="POST">
                    @csrf
                    <input type="email" name="email" style="margin-bottom:0px" class="form-control footer-email-input" placeholder="Enter your email address"/> 
                    <br>
                    <input type="submit" class="btn btn-footer" value="Susbscribe">
                </form>
            </p>
          </div>
        </div>
    </div> 
    <div class="socials-hr">
      <div class="row">
        <hr>
      </div>
    </div>
    <div class="row div-copyright">
        <div class="col-md-8 col-sm-12 col-12">
            ©2022 All Rights Reserved. 
            Powered by <a class="text-grey" href="{{route('public.home')}}" target="__blank"> {{config('app.name')}} </a>
        </div>
        <div class="col-md-4 col-sm-12 col-12 footer-socials">
            <a href="#">
                <i class="fab fa-instagram-square"></i>
            </a> &nbsp; &nbsp;
            <a href="#">
                <i class="fab fa-twitter-square"></i> 
            </a> &nbsp; &nbsp;
            <a href="#">
                <i class="fab fa-facebook-square"></i> 
            </a> &nbsp; &nbsp;
            <a href="#">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
</footer>