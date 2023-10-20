<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add Client') }}
                            </h2>
                        </header>
                        <form method="POST" action="{{ route('save-client') }}" id="clientForm" class="mt-6 space-y-6">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$id}}">
                            <x-text-input id="user_id" name="user_id" type="hidden" class="mt-1 block w-full"  value="{{ Auth::user()->id }}"/>
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full px-4">
                                    <x-input-label for="name" :value="__('Client Name')" />
                                    <x-text-input id="clientname" name="name" type="text" class="mt-1 block w-full" placeholder="Client Name" value="{{ old('name') }}" value="{{ $clientDetails->name }}"/>
                                    @error('name')
                                        <span class="error" id="name-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-4"><br>
                                    <x-input-label for="category_id" :value="__('Category')"/>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $clientDetails->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                        @error('category_id')
                                        <span class="error" id="category_id-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
                                <a href="{{ route('dashboard') }}"> <x-primary-button id="cancel-button" type="button">{{ __('Cancel') }}</x-primary-button></a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
<script>

$(document).ready(function() {
    $('#clientForm').submit(function(e) {
        e.preventDefault(); 
        $('.error').remove(); 
        var errors = 0;

        if ($('#category_id').val() === '') {
            $('#category_id').after('<span class="error">Category is required</span>');
            errors++;
        }

        if ($('#clientname').val() === '') {
            $('#clientname').after('<span class="error">Client Name is required</span>');
            errors++;
        }

        if (errors > 0) {
            return;
        }

        this.submit();
    });
});
</script>
</x-app-layout>
