    let offs= 0;
    const sliderLin = document.querySelector('.slider-line3');
    const mnp = document.querySelector('main-p');

    let mm = document.getElementById("max-wid").value;

    document.querySelector('.slider-nt').addEventListener('click', function () {
        offs= offs+ 229;
        if (offs> mm) {
            offs= 0;
        }
        sliderLin.style.left = -offs+ 'px';
    });

    document.querySelector('.slider-prv').addEventListener('click', function () {
        offs= offs- 229;
        if (offs< 0) {
            offs= mm;
        }
        sliderLin.style.left = -offs+ 'px';
    });


    