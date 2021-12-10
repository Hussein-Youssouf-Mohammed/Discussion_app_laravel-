<div class="card-header">

  <div class="d-flex justify-content-between">
    <div>
      <img src="{{ $discussion->user->avatar }}" width="70px" height="60px" style="border-radius: 50%" alt="">
      <span class="ml-2 font-weight-bold">{{ $discussion->user->name }}</span>
    </div>

    <div class="">

      <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-info btn-sm">View</a>
       
    </div>
  </div>

</div>