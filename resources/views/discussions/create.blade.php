@extends('layouts.app')

@section('content')


            <div class="card">
                <div class="card-header">Create Discussion</div>

                <div class="card-body">

                  <form action="{{ route('discussions.store') }}" method="post">

                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="form-group">

                      <label for="content">Content</label>

                      <textarea name="content" id="content" class="form-control" cols="5" rows="5"></textarea>

                    </div>

                    <div class="form-group">

                      <label for="Channel">Channel</label>
                      <select name="channel_id" id="channel_id" class="form-control">

                        @foreach($channels as $channel)

                          <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                        
                        @endforeach

                      </select>
                    </div>


                    <button class="btn btn-info" type="submit">Create Discussion</button>

                  </form>
            
                </div>
            </div>
      
@endsection
