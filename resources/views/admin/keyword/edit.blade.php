@extends('admin.layouts.design')
@section('body')

<form action="{{ route('admin.keyword.update', ['id' => $games->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
    @csrf
    <div class="row gx-3">
        <div class="col-xxl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Game Keyword</h5>
                </div>
                <div class="card-body">
                    <!-- Row start -->
                    <div class="row gx-3">

                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Game Keyword</label>
                                <select class="form-select" name="game_id" value="{{ old('game_id', $game->game_id)? 'selected' : ''}}">
                                    <option value="0" {{ $game->game_id == 0 ? 'selected' : '' }}>Select</option>
                                    @foreach($games as $game)
                                    <option value="{{ $game->id }}" {{ ($game->game_id == $game->id) ? 'selected' : '' }}>
                                        {{ $game->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('game_id'))
                                <p class="fs-6 text-danger"> {{ $errors->first('game_id') }} </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-4 col-12">
                            <div class="mb-3">
                                <label class="form-label">Game Keyword </label>
                                <select class="form-select choices-multiple" name="game_keyword" value="{{ old('game_keyword', $game->game_keyword)? 'selected' : ''}}">
                                    <option value="0" {{ $game->game_id == 0 ? 'selected' : '' }}>Select</option>
                                    @foreach($games as $game)
                                    <option value="{{ $game->id }}" {{ ($game->game_keyword == $game->id) ? 'selected' : '' }}>
                                        {{ $game->game_keyword }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('game_keyword'))
                                <p class="fs-6 text-danger"> {{ $errors->first('game_keyword') }} </p>
                                @endif
                            </div>
                        </div>


                        <div class="card-footer">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{route('admin.countries.index')}}"> <button type="button" class="btn btn-outline-secondary">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</form>
<script> $(document).ready(function() {
    $(".choices-multiple").select2({
        tags: true,                // Enable tagging
        tokenSeparators: [',', ' '], // Allow tagging with commas and spaces
        placeholder: "Enter a keyword" // Placeholder text
    });
});
</script>
@endsection
