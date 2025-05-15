@extends('layouts.admin')

@section('content')
<div class="content content--top-nav">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Reset Password</h2>

                {{-- Session messages --}}
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible show flex items-center mb-4" role="alert">
                        <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible show flex items-center mb-4" role="alert">
                        <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i>
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="list-disc pl-5 text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transaksi.pengaturan.user.update-password') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="mb-5">
                        <label for="current-password" class="block text-sm font-medium text-gray-600">Current Password</label>
                        <input type="password" id="current-password" name="current_password" required
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('current_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="new-password" class="block text-sm font-medium text-gray-600">New Password</label>
                        <input type="password" id="new-password" name="new_password" required
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('new_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="confirm-password" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm_password" required
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('confirm_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <p id="password-match" class="text-sm text-red-500 mt-2 hidden">Passwords do not match.</p>

                    <button type="submit" id="submit-btn" class="btn py-3 btn-primary w-full md:w-52">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#new-password, #confirm-password').on('keyup', function () {
            const newPassword = $('#new-password').val();
            const confirmPassword = $('#confirm-password').val();

            if (newPassword === confirmPassword) {
                $('#password-match').addClass('hidden');
                $('#submit-btn').prop('disabled', false);
            } else {
                $('#password-match').removeClass('hidden');
                $('#submit-btn').prop('disabled', true);
            }
        });
    });
</script>
@endsection
