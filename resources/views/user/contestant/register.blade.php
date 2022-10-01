@extends('user.layout')

@section('meta-content')
    <title> Register Contest | {{config('app.name')}} </title>
@endsection

@section('content-header')
    <h1 class="header">
        Register Contest
    </h1>
@endsection

@section('content-body')
<div class="submenu-less-div-content">
    @if($contests->where('slug', request()->get('contest'))->first() !== null)
        <div class="col-md-12 text-right">
            <a href="{{route('public.showContest', [
                "slug" => request()->get('contest')
            ])}}" class="btn btn-blue-bd btn-alert-modal" style="float:right"> 
                Back to Contest
            </a>
        </div>
    @endif

    <div class="content-sub-header">
        <h1 class="text-blue sub-header">
            Choose Contest
        </h1>
    </div> 
    <hr class="sub-header-hr"/>

    <div class="mt-2 analytics-block">
        <div class="col-md-12 col-sm-12 col-12 contest-card">
        @if($contests->count() > 0)
            <form action="{{route('user.contests.registerContest')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>
                    Contest Name
                </label>
                <select class="form-control" name="contest" 
                    @if($contests->where('slug', request()->get('contest'))->first() !== null) 
                        disabled
                        value="{{request()->get('contest')}}"
                    @endif
                >
                    @if($contests->where('slug', request()->get('contest'))->first() !== null)
                        <option>
                            {{$contests->where('slug', request()->get('contest'))->first()->name}}
                        </option>
                        <input type="hidden" name="contest_slug" value="{{request()->get('contest')}}"/>
                    @else
                        @foreach ($contests as $contest)
                            <option value="{{$contest->slug}}">
                                {{$contest->name}}
                            </option>
                        @endforeach
                    @endif
                </select>
                
                <div class="form-group">
                    <label>
                        Username (Note: This name is only applicable to this contest)
                    </label>
                    <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder="e.g. Installerjoe" required/>
                </div>

                <div class="form-group">
                    <label>
                        Profile Overview
                    </label>
                    <textarea name="profile_overview" class="form-control" rows="5"
                      placeholder="Tell people a little about yourself and why they should vote for you" 
                      required>{{old('profile_overview')}}</textarea>
                </div>

                <div class="form-group">
                    <label>
                        Phone Number
                    </label>
                    <input type="text" name="phone_number" value="{{old('phone_number')}}" class="form-control" placeholder="e.g. +234 801 2892 203" required/>
                </div>

                <div class="form-group" id="cover_image">
                    <label>
                        Cover Image
                    </label>
                    <div class="mt-1 image-container" style="display: none">
                        <img height="100px" width="auto"/>
                    </div>
                    <input type="file" class="form-control" onchange="showImageCropper(event, '#cover_image', 16/9)" required/>
                    <input type="hidden" class="base64image" name="cover_image" value="{{old('cover_image1')}}" required/>
                </div>

                <div class="form-group" id="secondary_image">
                    <label>
                        Secondary Image <em> (Optional) </em>
                    </label>
                    <div class="mt-1 image-container" style="display: none">
                        <img height="100px" width="auto"/>
                    </div>
                    <input type="file" class="form-control" onchange="showImageCropper(event, '#secondary_image', 16/9)"/>
                    <input type="hidden" class="base64image" name="secondary_image" value="{{old('secondary_image')}}" required/>
                </div>

                <div>
                    <button class="btn btn-peach-bg">
                        Submit Application
                    </button>
                </div>
            </form>
        @else
            <div class="card">
                <h1 class="caption-header text-peach"> 
                    Sorry, there is no active contest for registration for now.
                </h1>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
