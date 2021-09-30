
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap');
    </style>
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js" type="module" defer></script>
    <title>Photography</title>
</head>
<body>
    <div class="title">
        <h1 class="title-txt">
            Madeline Settle Photograhy &copy;
        </h1>
    </div>
    <nav class="nav">
        @foreach($category as $nav)
        <a class="fake-nav" onclick="slideShow()">
            {{$nav->name}}
        </a>
        @endforeach
    </nav>
    <div class="image-container">
        <img name="slider">
    </div>
</body>

<script>
    
    var i = 0;  
    const TIME = 3000;

    let catOne = [];
    let catTwo = [];
    let catThree = [];
    let catFour = [];
    let catFive = [];

    @foreach($catOne as $item)
    catOne.push("{{asset('/storage/' . $item)}}");
    @endforeach

    @foreach($catTwo as $item)
    catTwo.push("{{asset('/storage/' . $item)}}");
    @endforeach

    @foreach($catThree as $item)
    catThree.push("{{asset('/storage/' . $item)}}");
    @endforeach

    @foreach($catFour as $item)
    catFour.push("{{asset('/storage/' . $item)}}");
    @endforeach

    @foreach($catFive as $item)
    catFive.push("{{asset('/storage/' . $item)}}");
    @endforeach

    const slideShow = function(category){
        let current = (document.slider.src = category[i]);
        if (i < category.length - 1) {
        i++;
        } else i = 0;

        setTimeout(`slideShow(${category})`, TIME);
    };

    window.onload = slideShow(catOne);

    </script>
</html>