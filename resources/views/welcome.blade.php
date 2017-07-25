@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Multiple Files</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('post.image') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Image 1</label>
                            <div class="col-sm-10">
                                <input type="file" name="image[]" class="form-control" id="image-file" multiple>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default btn-sm">Submit with PHP</button>
                                <button type="submit" class="btn btn-success btn-sm" id="btn-submit-js">Submit with Javascript</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if (isset($galleries))
                    <div class="panel-body">
                        @foreach ($galleries as $item)
                            <div>
                                <div>{{ $item->id }}</div>
                                <div>
                                    @php
                                        $images = json_decode($item->images);
                                    @endphp

                                    @foreach ($images as $image)
                                        <img src="{{ asset($image) }}" width="50" height="50">
                                    @endforeach
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $("input#image-file").change(function() {
            var ele = document.getElementById($(this).attr('id'));
            var files = ele.files;
            axios.post( "{{ route('post.image') }}", {
                images: files.name,
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log("error");
            });
        });

        $('body').on('click', '#btn-submit-js', function(event) {
            event.preventDefault();
            /* Act on the event */


        });
    </script>

@endsection
