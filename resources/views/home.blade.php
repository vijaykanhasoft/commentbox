@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form role="form" id="addcomment" method="POST" action="{{ route('comment.store')}}" enctype="multipart/form-data" class="form_hideshow d-none">  
            <div class="container">
            <div class="row justify-content-center">
        <div class="col-md-8">
            @csrf
            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                <label>Comment:</label>
                <textarea class="form-control" id="comment" name="comment"></textarea>
                @if ($errors->has('comment'))
                    <span class="text-red" role="alert">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </div>
            </div>
            </div>
            </form>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <a class="float-right btn btn-outline-primary ml-2 add_comment"> Add Comment</a></div>
                <div class="container">
                    @if($comments->count() > 0)
                        @foreach($comments as $comm)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                    </div>
                                    <div class="col-md-10" style="padding-bottom: 10px">
                                        <p>
                                            <a class="float-left" href="javascript:void(0)"><strong>{{ $comm->user->name??"" }}</strong></a>
                                        </p>
                                        <span class="float-right">{{ Carbon\Carbon::parse($comm->created_at)->diffForHumans()}} </span>
                                    <div class="clearfix"></div>
                                        <p>{{ $comm->comment??"" }}</p>
                                        <p>
                                            <button class="float-right btn btn-outline-primary ml-2 add_reply_{{ $comm->id }}" onclick="repliesfucntion({{ $comm->id }})"> <i class="fa fa-reply"></i> Reply</button>
                                            <a class="float-right btn btn-outline-primary ml-2" href="{{ route('comment.delete',$comm->id) }}"> <i class="fa fa-trash"></i> Delete</a>
                                        </p>
                                    </div>
                                    <div class="add_replies_{{$comm->id}} " style="display: none;">
                                        <form role="form" id="addcomment_{{$comm->id}}" method="POST" action="{{ route('comment.store') }}" enctype="multipart/form-data">   
                                            @csrf
                                            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                                                <label>Comment:</label>
                                                <textarea class="form-control" id="comment" name="comment"></textarea>
                                                <input type="hidden" name="parent_id" value="{{ $comm->id }}" />
                                                @if ($errors->has('comment'))
                                                    <span class="text-red" role="alert">
                                                        <strong>{{ $errors->first('comment') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                        @include('subcomment', ['comments' => $comm->replies,'id'=>$comm->id])
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.add_comment').click(function() {
       $('.form_hideshow').addClass('d-block');
    });
    @if ($errors->has('comment'))
        $('.form_hideshow').show().addClass('d-block');
    @endif
    function repliesfucntion(id){
        $('.add_replies_'+id).show();
    }
    function subrepliesfucntion(id){
        $('.add_subreplies_'+id).show();
    }
    // function subsubrepliesfucntion(id){
    //     $('.add_replies_'+id).show();
    // }
    
</script>

@endsection
