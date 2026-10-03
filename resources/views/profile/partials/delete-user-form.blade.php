<section class="space-y-6">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-error">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-base-content/70">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-error" onclick="my_modal_1.showModal()">{{ __('Delete Account') }}</button>
    <dialog id="my_modal_1" class="modal" @if($errors->userDeletion->get('password')) open @endif>
        <div class="modal-box">
            <form id="delete-form" method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <h3 class="font-bold text-lg text-error">
                    {{ __('Are you sure you want to delete your account?') }}
                </h3>

                <p class="py-4 text-sm text-base-content/70">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">@lang('Password')</legend>
                    <input name="password" type="password" required
                        class="input input-bordered w-full @error('password') input-error @enderror" autocomplete="current-password" />
                    @if($errors->userDeletion->get('password'))
                        @foreach($errors->userDeletion->get('password') as $error)
                            <p class="text-error text-sm mt-1">{{ $error }}</p>
                        @endforeach
                    @endif
                </fieldset>

                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn">
                            {{ __('Cancel') }}
                        </button>
                    </form>
                    <button type="submit" form="delete-form" class="btn btn-error">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</section>