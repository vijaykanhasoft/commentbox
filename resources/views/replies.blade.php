@if($comments)
    @foreach($comments as $subcomm)
        <div class="card card-inner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                    </div>
                    <div class="col-md-10">
                        <p><a href="javascirpt:void(0)"><strong>{{ $subcomm->user->name??"" }}</strong></a>
                        <span class="float-right">{{ Carbon\Carbon::parse($subcomm->created_at)->diffForHumans()}} </span>
                        </p>
                        <p>{{ $subcomm->comment??"" }}</p>
                        <p>
                            <button class="float-right btn btn-outline-primary ml-2 add_subreply_{{ $subcomm->id }}" onclick="subrepliesfucntion({{ $subcomm->id }})"" >  <i class="fa fa-reply"></i> Reply</button>
                            <a class="float-right btn btn-outline-primary ml-2" href="{{ route('comment.delete',$subcomm->id) }}"> <i class="fa fa-trash"></i> Delete</a>
                        </p>
                    </div>
                    <div class="add_subreplies_{{$subcomm->id}} " style="display: none;">
                        <form role="form" id="addsubcomment_{{$subcomm->id}}" method="POST" action="{{ route('comment.replies',$subcomm->id)}}" enctype="multipart/form-data">   
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif