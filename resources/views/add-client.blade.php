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
                                        <form id="category-form">
                                            @csrf
                                            <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" placeholder="Category Name" value="{{ old('quantity') }}"/>
                                            @error('quantity')
                                                <span class="error" id="quantity-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
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
                        <form method="POST" action="" id="invoiceForm" class="mt-6 space-y-6">
                            @csrf

                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full px-4">
                                    <x-input-label for="quantity" :value="__('Client Name')" />
                                    <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" placeholder="Client Name" value="{{ old('quantity') }}"/>
                                    @error('quantity')
                                        <span class="error" id="quantity-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-full px-4"><br>
                                    <x-input-label for="tax_perc" :value="__('Category')"/>
                                        <select id="tax_perc" name="tax_perc" class="mt-1 block w-full" placeholder="Tax Percentage">
                                            <option value="">Select Option</option>
                                            <option value="0" {{ old('tax_perc') == '0' ? 'selected' : '' }}>0%</option>
                                            <option value="5" {{ old('tax_perc') == '5' ? 'selected' : '' }}>5%</option>
                                            <option value="12" {{ old('tax_perc') == '12' ? 'selected' : '' }}>12%</option>
                                            <option value="18" {{ old('tax_perc') == '18' ? 'selected' : '' }}>18%</option>
                                            <option value="28" {{ old('tax_perc') == '28' ? 'selected' : '' }}>28%</option>
                                        </select>
                                        @error('tax_perc')
                                        <span class="error" id="tax_perc-error" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button type="submit">{{ __('Add') }}</x-primary-button>
                                <x-primary-button id="cancel-button" type="button">{{ __('Cancel') }}</x-primary-button>
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
        let category = $('#category-input').val();

        // Send an AJAX request to store the category
        $.post('/categories', { name: category }, function(data) {
            // On success, update the category dropdown
            $('#category_id').append($('<option>', {
                value: data.id,
                text: data.name
            }));
            $('#categoryModal').modal('hide'); // Hide the modal
        });
    });
});

</script>
</x-app-layout>
