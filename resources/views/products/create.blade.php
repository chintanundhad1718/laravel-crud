@extends('products.layout')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Add New Product</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i>Back</a>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="inputName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name">
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email">
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="country_dropdown" class="form-label">Country</label>
                        <select class="form-select" name="country_dropdown" id="country_dropdown">
                            <option value="">Select Country</option>
                            @foreach ($countries as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="state_dropdown" class="form-label">State</label>
                        <select id="state_dropdown" name="state_dropdown" class="form-select">
                            <option value="">Select State</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="city_dropdown" class="form-label">City</label>
                        <select id="city_dropdown" name="city_dropdown" class="form-select">
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputDetail" class="form-label">Detail</label>
                    <textarea class="form-control @error('detail') is-invalid @enderror" style="height:150px" name="detail" id="inputDetail" placeholder="Detail"></textarea>
                    @error('detail')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputImage" class="form-label">Image</label>
                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        id="inputImage">
                    @error('image')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>Submit</button>
            </form>
        </div>
    </div>
@endsection
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#country_dropdown').on('change', function () {
            var idCountry = this.value;
            console.log(idCountry);
            $("#state_dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state_dropdown').html('<option value="">Select State</option>');
                    $.each(result.states, function (key, value) {
                        $("#state_dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city_dropdown').html('<option value="">Select City</option>');
                }
            });
        });
        $('#state_dropdown').on('change', function () {
            var idState = this.value;
            console.log(idState);
            $("#city_dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city_dropdown').html('<option value="">Select City</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city_dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>