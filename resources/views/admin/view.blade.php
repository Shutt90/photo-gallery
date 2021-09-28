<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Area</title>
</head>
<body>
    <section>
        <h1 class="welcome">Welcome Back {{Auth::user()->name}}</h1>
        <div class="image-upload">
            <form method="POST" action="{{route('admin.store')}}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="file" name="file_path">
                <input type="text" name="title">
                <select name="category_id">
                    @foreach($category as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                <input name="submit" type="submit">
            </form>
        </div>

        <div class="image-gallery">
            @foreach($gallery as $item)
            <div class="image-gallery__container">
                <img src="{{asset('storage/images/' . $item->file_path)}}" alt="{{$item->name}}">
                <h3 class="image-gallery__container-name">
                    {{$item->name}}
                </h3>
                <form method="POST" action="{{route('admin.update', $item->id)}}">
                    @method('PUT')
                    @csrf
                    <label for="title">Image Name:</label>
                    <input type="text" name="title">
                    <label for="category_id">Category:</label>
                    <select name="category_id">
                        @foreach($category as $cat)
                        <option value="{{$cat->id}}" @if($cat->id === $item->category_id) selected="selected" @endif>{{$cat->name}}</option>
                        @endforeach
                    </select>
                    <input name="update" type="submit">
                </form>
                <form method="POST" action="{{route('admin.destroy', $item->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        <img src="{{asset('storage/images/delete-icon.png')}}">
                    </button>
                </form>
            </div>
            @endforeach
            @include('admin.errors')
        </div>
        
    </section>
</body>
</html>