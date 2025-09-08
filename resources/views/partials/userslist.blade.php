<style>
    .user-list-container {
    padding: 2rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    .user-table-wrapper {
        overflow-x: auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
    }

    .user-table th,
    .user-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.95rem;
    }

    .user-table th {
        background-color: #f9fafb;
        color: #374151;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.03em;
    }

    .user-table tbody tr:hover {
        background-color: #f3f4f6;
    }

    .delete-btn {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 0.5rem 0.9rem;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .delete-btn:hover {
        background-color: #b91c1c;
    }

    .no-data {
        text-align: center;
        padding: 1rem;
        color: #6b7280;
        font-style: italic;
    }

    .pagination {
        margin-top: 1.5rem;
        text-align: center;
    }

</style>

<div class="user-list-container">
    <h1 class="page-title">
        {{ ucfirst($status) }} List
    </h1>

    <div class="user-table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Account Created</th>
                    <th>Account Updated</th>
                    @if ($status === 'owners')
                        <th>Billboards Owned</th>
                    @elseif ($status === 'advertisers')
                        <th>Bookings Made</th>
                    @endif
                    <th>Actions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        @if ($status === 'owners')
                            <td>{{ $user->billboards_count }}</td>
                        @elseif ($status === 'advertisers')
                            <td>{{ $user->bookings_count }}</td>
                        @endif
                        <td>
                            <form action="{{route('admin-user-delete',$user->id)}}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button class="delete-btn">Delete</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to block this user?');">
                                @csrf
                                <button class="delete-btn" style="background: rgb(235, 113, 6)">Block</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
</div>


