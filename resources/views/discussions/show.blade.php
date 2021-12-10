@extends('layouts.app')

@section('content')

<div class="card mb-4">
  @include('partials.discussion-header')
  <div class="card-body ">
      
    <div class="text-center">
      <strong>
        {{ $discussion->title }}
      </strong>
    </div>
       <hr>

       <div class="text-center">{!! $discussion->content !!}</div>

       @if($discussion->reply)

       <div class="card my-5 text-center">
         <div class="card-header bg-success" style="color: #FFF">
           <div class="d-flex justify-content-between">
             <div>
                <img src="{{ $discussion->reply->user->avatar }}" width="80px" height="60px" style="border-radius: 50%" alt="">
                <strong>
                  {{ $discussion->reply->user->name }}
                </strong>
             </div>
             <div>
                <strong>Best Reply</strong>
             </div>
           </div>
         </div>

         <div class="card-body">

            {!! $discussion->reply->content !!}
         </div>
       </div>

       @endif
  </div>
</div>


@foreach($discussion->replies()->paginate(3) as $reply)

   <div class="card my-5">
     <div class="card-header"> 

      <div class="d-flex justify-content-between">
        <div>
          <img src="{{ $reply->user->avatar }}" width="70px" height="60px" style="border-radius: 50%" alt="">
          <span class="ml-2 font-weight-bold">{{ $reply->user->name }}</span>
        </div>

        <div>

          @auth
            
              @if(auth()->user()->id === $discussion->id)

              <form action="{{ route('discussion.best-reply', ['discussion'=>$discussion->slug, 'reply'=>$reply->id]) }}" method="POST">

                  @csrf
                  
                  <button type="submit" class="btn btn-info">Mark best a reply</button>

              </form>

            @endif
            
          @endauth
          
        </div>
    
        
      </div>

     </div>
       <div class="card-body text-center">

            {{ $reply->content }}

          

       </div>
    
   </div>

@endforeach


<dvi class="card my-5">
  <div class="card-header">Add a reply..</div>

  <div class="card-body">

    @auth
    <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">
    @csrf   
      <dvi class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" cols="5" rows="5"></textarea>
      </dvi>
    
      <button class="btn btn-info mt-2 float-right">add a reply</button>
    
    </form>

    @else

   <div class="text-center">
     <a href="{{ route('login') }}" class="btn btn-info form-control">Sing in to add a reply</a>
   </div>
  
@endauth
  </div>
</dvi>



      
@endsection
