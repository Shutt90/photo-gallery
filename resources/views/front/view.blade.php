
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap');
    </style>

    <script src="app.js" type="module" defer></script>
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
        <a class="fake-nav">
            {{$nav->name}}
        </a>
        @endforeach
    </nav>
    <div class="image-container">
        <img name="slider">
    </div>
</body>

<script type="module">
    const fs = require('fs');

    let interiors = "./imgs/"

    let filenames = fs.readdirSync(interiors);

    console.log("Filenames in directory:");
    filenames.forEach((file) => {
        console.log("File:", file)
    });

    var i = 0;  
    const TIME = 3000;
    let imgs = ["./imgs/source1.jpg", "./imgs/source2.jpg", "./imgs/source3.jpg", "./imgs/source4.jpg", "./imgs/source5.jpg"];

    const slideShow = function () {
        let current = (document.slider.src = imgs[i]);
        if (i < imgs.length - 1) {
        i++;
        } else i = 0;


        setTimeout("slideShow()", TIME);
    };

    window.onload = slideShow();

    </script>
</html>