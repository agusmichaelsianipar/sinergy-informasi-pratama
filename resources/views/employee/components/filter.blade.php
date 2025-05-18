<div class="d-flex row mb-2">
    <div class="col-auto mr-auto">
        <div class="button mr-1 list-inline">
            @foreach ($positions as $position)
                <form action="" class="list-inline-item mr-0">
                    @csrf
                    @if (request('position') && request('position') == $position)
                        <input type="hidden" name="position" value="">
                        <button type="submit" class="btn btn-sm btn-primary">{{ $position }}</button>
                    @else
                        <input type="hidden" name="position" value="{{ $position }}">
                        <button type="submit" class="btn btn-sm btn-outline-primary">{{ $position }}</button>
                    @endif
                </form>
            @endforeach
        </div>
    </div>
</div>