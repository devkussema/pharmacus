@if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-end mt-3" id="js-users-pagination">
        {!! $users->links('pagination::bootstrap-5') !!}
    </div>
@else
    <div class="d-flex justify-content-end mt-3" id="js-users-pagination"></div>
@endif
