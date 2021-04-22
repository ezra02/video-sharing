@extends('layouts.app')
@section('content')
 <div class="flex flex-wrap">
 @forelse ($videos as $video)
     <div>
       <img src="'public/'.{{$video->cover}}">
       <p>{{$video->title}}</p>
       <p>{{$video->views}}</p>
       <p>{{$video->channel}}</p>
     </div>
 @empty
  <p>oops no video was found like {{$query}}</p> 
 @endforelse    
 <div>
@endsection