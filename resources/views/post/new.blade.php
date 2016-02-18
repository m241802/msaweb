@extends('app')
@section('content')
	<div class="container">
		<div class="right-column">
			<article class="item-page">
				<div class="top-article">
					<h2>{!! $post[0]->title !!}</h2>
					<div class="public-excerpt">
						@if(isset($post[0]->files))
							<div class="main-image">
								<img src="{!! reset($post[0]->files)[1] !!}">
							</div>
						@endif
						{!! $post[0]->content !!}
					</div>
				</div>
				<div class="gallery-page">
					@if(isset($post[0]->files))
						<h4>Галерея</h4>
						@foreach($post[0]->files as $file)
							<img src="{!! $file[0] !!}" class="img-thumbnail">
						@endforeach
					@endif
				</div>
			</article>
		</div>
	</div>
@stop