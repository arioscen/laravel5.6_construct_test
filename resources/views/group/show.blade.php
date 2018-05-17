@extends('layouts.base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <h1>{{ $group->title }}</h1>
        </div>    
    </div>
    <br>
    @auth
        <div class="row justify-content-center">
            <div class="col-6">
                <a class="btn btn-primary" href="{{ url('user/posts/create').'?group_id='.$group->id }}" role="button">Create post</a>
            </div>    
        </div>
        <br>
    @endauth
    @foreach ($group->posts as $post)
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                <a href="#"><h5 class="card-header">{{ $post->title }}</h5></a>
                <div class="card-body">
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                </div>
            </div>
            <div class="col-2 align-self-center">
                @auth
                    @if ($post->user_id == Auth::user()->id)
                        <a class="btn btn-success" href="{{ url('user/posts/'.$post->id.'/edit') }}" role="button">Edit</a>
                        <form action="{{ url('user/posts/'.$post->id) }}" method="POST" style="display: inline;">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>                        
                    @endif
                @endauth
            </div>            
        </div>        
        @if(!$loop->last)
            <br>
        @endif        
    @endforeach
@endsection