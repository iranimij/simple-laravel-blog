@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="row">
            @foreach( $errors->all() as $message )
                <div class="alert alert-danger">{{ $message }}</div>
            @endforeach
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('List of posts') }}</div>

				<div class="card-body">
                    @if( ! $posts->isEmpty() )
                        <div class="grutto-blog-admin-list-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Slug</th>
                                <th scope="col">category</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $posts as $post )
                                <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td>{{ \Carbon\Carbon::parse( $post->created_at )->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if( $posts->isEmpty() )
                       There is no post.
                    @endif
				</div>
			</div>
		</div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Adding a post') }}</div>

                <div class="card-body">
                    <form action="{{ route( 'admin.post.new' ) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="post_name">News title</label>
                            <input type="text" required="required" class="form-control" id="post_name" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group grutto-blog-slug-input">
                            <label for="post_slug">Slug</label>
                            <input type="text" required="required" class="form-control" id="post_slug" name="slug" placeholder="Enter slug">
                            <small>Like : /de/article/test</small>
                            <br>
                            <span></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="post_content">News content</label>
                            <textarea class="form-control" id="post_content" name="content" rows="3" required></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="post_content">Category</label>
                            @if( ! $categories->isEmpty() )
                                <select class="form-control" name="category" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            @endif
                            @if( ! $categories->isEmpty() )
                                You should first add some categories.
                            @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select multiple class="form-control" id="tags" name="tags[]" required>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">You can choose multiple tags.</small>
                        </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" name="is_selected" id="selected_news">
                            <label class="form-check-label" for="selected_news">
                                Selected news
                            </label>
                        </div>

                        @if( ! $categories->isEmpty() && ! $tags->isEmpty() )
                            <div class="grutto-blog-list-heading mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary d-block w-100">{{ __( 'Add a new post' ) }}</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
