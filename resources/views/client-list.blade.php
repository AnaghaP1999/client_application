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
    <tbody id="client-list">
        @foreach ($clients as $key => $client)
        @php
            $key++;
        @endphp
            <tr class="client-item">
                <td> {{ $key }} </td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->category_name }}</td>
                <td>
                <a href="{{"edit-client/" .$client['id']}}"><i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                <td>
                    <a href="{{"delete-client/" .$client['id']}}" onclick="return confirm('Are you sure you want to delete this client?')"><i class="fa-regular fa-trash-can" style="color: #ed0707;"></i></a>
                </td>
            </tr> 
        @endforeach
    </tbody>
</table>
{{ $clients->links() }}