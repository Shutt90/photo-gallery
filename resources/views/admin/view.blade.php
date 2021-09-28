<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js" type="module" defer></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Area</title>
</head>
<body>
    <div class="image-head">
        <h1 class="welcome">Welcome Back {{Auth::user()->name}}</h1>
        <div class="image-head__links">
            <a class="fake-link gal">Gallery</a>
            <a class="fake-link cat">Categories</a>
        </div>
    </div>
    <section class="image">
        <div class="image-upload">
            {{Form::open(array('route' => 'admin.store' ,'files'=>'true'))}}
                @csrf
                @method('POST')
                <input type="file" name="file_path">
                <label for="title">Title:</label>
                <input type="text" name="title">
                <label for="category_id">Select Category</label>
                <select name="category_id">
                    @foreach($category as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                <input name="submit" type="submit">
            {{Form::close()}}
        </div>

        <div class="image-gallery">
            @foreach($gallery as $item)
            <div class="image-gallery__container">
                <img class="image-gallery__item" src="{{asset('/storage/' . $item->file_path)}}" alt="{{$item->name}}">
                <h3 class="image-gallery__container-name">
                    {{$item->name}}
                </h3>
                <form class="update" method="POST" action="{{route('admin.update', $item->id)}}">
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
                    <input class="submit" name="update" type="submit">
                </form>
                <form method="POST" action="{{route('admin.destroy', $item->id)}}">
                    @csrf
                    @method('DELETE')
                    <div class="delete">
                        <button class="delete" type="submit">
                            <img src="{{asset('storage/images/delete-icon.png')}}">
                        </button>
                    </div>
                </form>
            </div>
            @endforeach
            @include('admin.errors')
        </div>
        
    </section>

    <section class="categories">
        <div class="categories-upload">
            {{Form::open(array('route' => 'admin.store'))}}
            @csrf
            @method('POST')
            <label for="category">Add New Category</label>
            <input type="text" name="category">
            <input class=""type="submit">
            {{Form::close()}}
        </div>
        <div class="categories-delete">
            @foreach($category as $cat)
            {{Form::open(array('route' => array('admin.destroy', $cat->id)))}}
            @csrf
            @method('DELETE')
                <li>{{$cat->name}}</li>
            @endforeach
        </div>
    </section>
        
</body>
</html>