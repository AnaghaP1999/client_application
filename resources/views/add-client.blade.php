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
                        <div class="flex items-center justify-end gap-4">
                        <x-primary-button id="openCategoryModal" type="button">{{ __('Add New Category') }}</x-primary-button>
                        </div><br>
                        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="category-form" action="/categories" method="post">
                                            @csrf
                                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Category Name" value="{{ old('name') }}"/>
                                            @error('name')
                                                <span class="error" id="name-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                            @enderror
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    <x-primary-button type="submit" class="btn btn-primary" id="add-category-button">{{ __('Add') }}</x-primary-button>
                                        <x-primary-button id="cancel-button" data-bs-dismiss="modal" type="button">{{ __('Cancel') }}</x-primary-button>                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add Client') }}
                            </h2>
                        </header>
                        <form method="POST" action="{{ route('save-client') }}" id="invoiceForm" class="mt-6 space-y-6">
                            @csrf
                        <x-text-input id="user_id" name="user_id" type="hidden" class="mt-1 block w-full"  value="{{ Auth::user()->id }}"/>
                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full px-4">
                                    <x-input-label for="name" :value="__('Client Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Client Name" value="{{ old('name') }}"/>
                                    @error('name')
                                        <span class="error" id="name-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-4"><br>
                                    <x-input-label for="category_id" :value="__('Category')"/>
                                    <select id="category_id" name="category_id" class="mt-1 block w-full">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
    // Open the category modal
    $('#openCategoryModal').on('click', function() {
        $('#categoryModal').modal('show'); // Show the modal
    });

    // Handle category form submission
    $('#add-category-button').on('click', function() {
        let category = $('#name').val(); // Get the category name from the form

        // Send an AJAX request to store the category
        $.post('/categories', { name: category, _token: $('meta[name="csrf-token"]').attr('content') }, function(data) {
            // On success, update the category dropdown
            $('#tax_perc').append($('<option>', {
                value: data.id,
                text: data.name
            }));
            $('#categoryModal').modal('hide'); // Hide the modal
        });
    });
});


</script>
</x-app-layout>
