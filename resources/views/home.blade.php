@extends('layouts.app')
@section('content')
{{-- 
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div> 

{{-- <div class="card-body">
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('Hello Admin!') }}

</div>

{{-- </div>
</div>
</div>
</div>  --}}




<div class="container " style="margin-top:30px; ">
    <div class="table-responsive">
    
    <table class="table table-bordered" >
        
        <tr>
        <th>#</th>
        <th>Blogs</th>
        <th>Created_at</th>
        <th>Updated_at</th>
        <th>Status</th>
        @if(auth()->user()->hasRole('admin'))
        <th>Action</th>
        @endif
        </tr> 
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->blog }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>{{ $post->status }}</td>
                  
                    @if(auth()->user()->hasRole('admin'))
                    <td>
                            <form class="form-horizontal" role="form" action="{{route('home.edit', $post->id)}}">
                                @if($post->status == 'Approved' || $post->status == 'Rejected' || $post->status == 'Deleted')
                                <input name="action" value="Pending" type="hidden">
                                <button type="submit" class="btn btn-success mt-2">Refresh</button>
                                @elseif($post->status == 'Pending')
                                <input name="action" value="Rejected" type="submit" class="btn btn-primary mt-2">
                                <input name="action" value="Approved" type="submit" class="btn btn-info mt-2">
                                <input name="action" value="Deleted" type="submit"class="btn btn-danger mt-2">
                             </form>
                             @endif 
                    </td>
                    @endif
                    
                    @endforeach
                </tr>
                
                </table>
        
    

    @if(auth()->user()->hasRole('user'))
        <h5>Start blogging</h5>
        <form action="{{ route('home.store') }}" method="POST">
            @csrf
            <div class="form-floating">
                <textarea class="form-control" name="blog" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Send</button>
                </div>
            </div>
        </form>
    
    @endif
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
</div>
@endsection