    let offset = 0;
    const sliderLine = document.querySelector('.slider-line');

    let mx = document.getElementById("mxxx").value;

    document.querySelector('.slider-nt').addEventListener('click', function () {
        
        offset = offset + 229;
        if (offset > mx) {
            offset = 0;
        }
        sliderLine.style.left = -offset + 'px';
    });

    document.querySelector('.slider-prv').addEventListener('click', function () {
        offset = offset - 229;
        if (offset < 0) {
            offset = mx;
        }
        sliderLine.style.left = -offset + 'px';
    });