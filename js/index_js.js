let i=0;
let slideImages= []; //images array path
let category= []; //category array
let articleHeading= [];
let timer= 3000;

//Images Data Path
slideImages[0]= "imgs/main_article_img.png";
slideImages[1]= "imgs/main_article_img_2.jpg";

//Categories Data
category[0]= "Aritificial Intelligence"
category[1]= "Computer Science"

// Article Heading Data
articleHeading[0]= "An Eextraordinary WebGL has been released by great china scientist";
articleHeading[1]= "Polygon Artwork is in demand right now";

function slide() {
    document.trendImage.src= slideImages[i];
    document.getElementById('trendCategory').innerHTML= category[i];
    document.getElementById('trendHeading').innerHTML= articleHeading[i];

    if(i < slideImages.length-1) {
        i++;
    }
    else {
        i=0;
    }

    setTimeout("slide()", timer);
}

window.onload= slide;