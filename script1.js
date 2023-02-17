    let offsett = 0;
    const sliderLinee = document.querySelector('.slider-line2');

    let m = document.getElementById("mx").value;


    document.querySelector('.slider-n').addEventListener('click', function () {
        offsett = offsett + 300;
        if (offsett > m) {
            offsett = 0;
        }
        sliderLinee.style.left = -offsett + 'px';
    });

    document.querySelector('.slider-p').addEventListener('click', function () {
        offsett = offsett - 229;
        if (offsett < 0) {
            offsett = m;
        }
        sliderLinee.style.left = -offsett + 'px';
    });