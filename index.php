<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-js/home.min.css">
    <link rel="stylesheet" href="css-js/swiper-bundle.min.css">
    <title>Instagram Feed</title>
</head>
<body>
<section class="socialChannels section pb-0" style="margin-bottom: -60px;">
    <div class="container">
        <div class="custom-row no-gutters">
            <div class="col_12 col_md_4 m-auto text-center">
                <h2 class="h2 title-col animate fadein-Up" data-delay=".4s"
                    style="animation: 0.65s ease-out 0.4s 1 normal forwards running anim;">Social Feed</h2>
            </div>
        </div>
    </div>
    <div class="socialChannels__slider swiper swiper-initialized swiper-horizontal">
        <div class="swiper-wrapper instagram-data-section" aria-live="polite"  id="instagram-feed">
        </div>
    </div>
</section>
<script>
    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
        var expires = '';
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + value + expires + '; path=/';
    }

    // Fonction pour obtenir la valeur d'un cookie
    function getCookie(name) {
        var nameEQ = name + '=';
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            while (cookie.charAt(0) === ' ') cookie = cookie.substring(1, cookie.length);
            if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
        }
        return null;
    }


    function displayData(data) {
        var feedContainer = document.getElementById('instagram-feed');
        if (data && data.data && Array.isArray(data.data)) {
            data.data.forEach(function (post) {
                var postElement = document.createElement('div');
                postElement.classList.add('swiper-slide');
                // Ajoutez des styles à l'élément
                postElement.style.width = '223px';
                postElement.style.marginRight = '15px';
                postElement.innerHTML = `  <a href="${post.permalink}" target="_blank">
                                                    <div class="slideImg">
                                                        <img class="" src="${post.thumbnail_url}">
                                                    </div>
                                                    <div class="icon">
                                                        <img class="" src="https://dubaicrocodilepark.dev-web.ch/wp-content/themes/dubaicrocodilepark/assets/svg/instagram.svg" width="20" height="20" alt="social-image">
                                                    </div>
                                                </a>
                                            `;
                feedContainer.appendChild(postElement);
            });
        } else {
            console.error('Invalid data format:', data);
        }
    }

    fetch('getdata.php')
        .then(response => response.json())
        .then(data => {
            // console.log('Data from server:', data);
            // Stocker les données dans les cookies
            setCookie('instagramData', JSON.stringify(data), 1);
            // Afficher les données sur la page
            displayData(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // return error.text(); // Récupérer le contenu de la réponse HTML
        })
        .then(htmlContent => {
            //   console.log('HTML Content:', htmlContent);
        });
</script>
</body>
</html>
