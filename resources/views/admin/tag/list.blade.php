@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="row">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('List of tags') }}</div>

				<div class="card-body">
                    @if( ! $tags->isEmpty() )
                        <div class="grutto-blog-admin-list-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $tags as $tag )
                                <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ \Carbon\Carbon::parse( $tag->created_at )->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if( $tags->isEmpty() )
                       There is no tag.
                    @endif
				</div>
			</div>
		</div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Adding a tag') }}</div>

                <div class="card-body">
                    <form action="{{ route( 'admin.tag.new' ) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Tag name</label>
                            <input type="text" required="required" class="form-control" id="tag_name" name="title" placeholder="Enter tag">
                        </div>
                        <div class="grutto-blog-list-heading mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-block w-100">{{ __( 'Add a new tag' ) }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
