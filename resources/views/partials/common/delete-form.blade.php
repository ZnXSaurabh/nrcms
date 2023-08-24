<form class="delete-form" action="{{ $route }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete?');" title="Delete">
        <i data-feather="trash-2"></i>
    </button>
</form>