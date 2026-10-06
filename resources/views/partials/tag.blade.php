@extends('partials.layout')
@section('content')
    <div class="card bg-base-200 shadow-sm mb-2">
        <div class="card-body">
            <h1 class="card-title">{{ $tag->name }}</h1>
            <table class="table table-zebra">
                <tbody>
                    <tr>
                        <th>Posts Count</th>
                        <td>{{ $tag->posts()->count() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{ $posts->links() }}
    <div class="grid grid-cols-4 gap-2">
        @foreach($posts as $post)
            @include('partials.post-card')
        @endforeach
    </div>
@endsection