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
                    <table class="w-full mt-6">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>Category</th> 
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                <tr align="center">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="return confirm('Are you sure you want to delete this invoice?')"><i class="fa-regular fa-trash-can" style="color: #ed0707;"></i></a>
                                    </td>
                                </tr> 
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
