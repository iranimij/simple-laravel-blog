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
				<div class="card-header">{{ __('List of categories') }}</div>

                @if( ! $categories->isEmpty() )
                    <div class="card-body">
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
                                @foreach( $categories as $category )
                                    <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse( $category->created_at )->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                @if( $categories->isEmpty() )
                    There is no category.
                @endif
			</div>
		</div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Adding a category') }}</div>

                <div class="card-body">
                    <form action="{{ route( 'admin.category.new' ) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category name</label>
                            <input type="text" required="required" class="form-control" id="category_name" name="title" placeholder="Enter category">
                        </div>
                        <div class="grutto-blog-list-heading mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-block w-100">{{ __( 'Add a new category' ) }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
