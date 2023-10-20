<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-end gap-4"><a href="{{ route('add-client') }}">
                        <x-primary-button type="submit">{{ __('Add Client') }}</x-primary-button></a>
                    </div><br>
                    <div class="w-full mt-6" id="client-list">
                        @include('client-list', ['clients' => $clients])
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchClients(page);
        });

        function fetchClients(page) {
            $.ajax({
                url: '/get-clients?page=' + page,
                success: function (data) {
                    $('#client-list').html(data);
                },
            });
        }
    });
</script>
</x-app-layout>
