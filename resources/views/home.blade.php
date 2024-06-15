<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Diagnosa Kerusakan Hardware PC?') }}</div>
                        <div class="card-body">
                            <form action="{{ route('spk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @foreach ($gejala as $item)
                                    <div class="form-check"> 
                                        <input type="hidden" name="gejala[{{ $item->kode_gejala }}]" value="0">
                                        <input class="form-check-input" type="checkbox" name="gejala[{{ $item->kode_gejala }}]" value="{{ $item->bobot }}" id="{{ $item->kode_gejala }}">
                                        <label class="form-check-label" for="{{ $item->kode_gejala }}">
                                            {{ $item->gejala }}
                                        </label>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-success mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
