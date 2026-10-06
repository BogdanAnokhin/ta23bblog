@extends('partials.layout')
@section('content')
    @include('partials.post-card', ['full' => true])

    <!-- Comments Section -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-base-content mb-6">{{ __('Comments') }}</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div role="alert" class="alert alert-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Add Comment Form -->
        @auth
            <div class="card bg-base-200 mb-6">
                <div class="card-body">
                    <h3 class="card-title text-lg">{{ __('Add a Comment') }}</h3>
                    <form method="POST" action="{{ route('comments.store', $post) }}" class="space-y-4">
                        @csrf
                        <div>
                            <textarea
                                name="body"
                                placeholder="{{ __('Share your thoughts...') }}"
                                class="textarea textarea-bordered w-full h-24 focus:outline-none focus:ring-2 focus:ring-primary @error('body') textarea-error @enderror"
                                required></textarea>
                            @error('body')
                                <p class="text-error text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Post Comment') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div role="alert" class="alert alert-info mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span><a href="{{ route('login') }}" class="link link-primary">{{ __('Log in') }}</a> {{ __('to comment on this post.') }}</span>
            </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-4">
            @forelse ($post->comments as $comment)
                <div class="card bg-base-200 shadow-sm">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm text-base-content/70 mb-2">
                                    <span class="font-semibold text-base-content">{{ $comment->user->name }}</span>
                                    <span class="text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                                </p>
                                <p class="text-base-content">{{ nl2br(htmlspecialchars($comment->body)) }}</p>
                            </div>
                            @auth
                                @can('delete', $comment)
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm btn-circle text-error" onclick="return confirm('{{ __('Are you sure?') }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-base-content/70">{{ __('No comments yet. Be the first to comment!') }}</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection