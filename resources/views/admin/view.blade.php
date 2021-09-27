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
            <form method="POST" action="{{route('admin.store')}}">
                @csrf
                @method('POST')
                <input name="file" type="file">
                <input type="text" name="name">
                <select name="categories">
                    @foreach($gallery as $item)
                    <option>{{$item->title}}</option>
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
                <form method="PUT" action="{{route('admin.update')}}">
                    <select onchange="this.form.submit()">
                        @foreach($category as $cat)
                        <option @if($item->categoryRelation->get()->id) selected="selected" @endif>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @endforeach
        </div>
    </section>
</body>
</html>