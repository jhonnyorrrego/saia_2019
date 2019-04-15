$(function () {
    var baseUrl = Session.getBaseUrl();
    Ui.putColor();
    Ui.putLogo('#logo');
    Ui.bindServiceWorker();
    resize();

    $("[name='username'],[name='password']").on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('#access').trigger('click');
        }
    });

    $('#access').on('click', function (event) {
        event.preventDefault();
        let ts = Math.round((new Date()).getTime() / 1000);
        $.ajax({
            type: 'POST',
            url: `${baseUrl}app/funcionario/login.php`,
            dataType: 'json',
            data: {
                user: $("[name='username']").val(),
                password: $("[name='password']").val(),
                token: window.btoa(ts)
            },
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('key', response.data.key);
                    window.location = baseUrl + response.data.route;
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error'
                    });
                }
            },
            error: function (xhr) {
                console.log(xhr.status, 'Error!');
            }
        });
    });

    $('#recovery_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: baseUrl + 'app/funcionario/solicitar_cambio_clave.php',
            dataType: 'json',
            data: $("#recovery_form").serialize(),
            beforeSend: function () {
                $('#buttons,#spiner').toggleClass('d-none');
            },
            success: function (response) {
                $('#buttons,#spiner').toggleClass('d-none');
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    $('#recovery_modal').modal('toggle');
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            },
            error: function (xhr) {
                console.log(xhr.status, 'Error!');
            }
        });
    });



    (function checkDirectory() {
        $.post(Session.getBaseUrl() + 'app/configuracion/consulta_configuraciones.php', {
            configurations: ['validar_acceso_ldap']
        }, function (response) {
            if (response.success) {
                if (response.data[0].value == 0) {
                    $('#message').parent().parent().hide();
                }
            }
        }, 'json');
    })();

    function loadCarousel() {
        if ($("#carousel_container").is(':visible') && !$("#homepageItems").children().length) {
            $.ajax({
                url: baseUrl + 'app/carrusel/consulta_carousel.php',
                dataType: 'json',
                success: function (response) {
                    if (!$("#homepageItems").children().length) {
                        paintCarousel(response.data);
                    }
                }
            });
        }
    }

    function paintCarousel(data) {
        var items = '',
            indicators = '';

        for (var i = 0; i < data.length; i++) {
            items += `
            <div class="carousel-item mx-0 px-0">
                <img src="${baseUrl + data[i].image}" alt="..." class="carousel_image">
                <div class="carousel-caption d-none d-md-block bg-info" style="opacity: 0.7">
                    <h3 class="text-white" style="opacity: 1">${data[i].title}</h3>
                    <p class="text-white" style="opacity: 1">${data[i].content}<p>
                </div>
            </div>`;
            indicators += `<li data-target="#myCarousel" data-slide-to="${i}"></li>`;
        }

        $('#homepageItems').html(items);
        $('#indicators').html(indicators);
        $('.carousel-item').first().addClass('active');
        $('.carousel-indicators > li').first().addClass('active');
        let maxHeight = $(window).height() - $('#footer').height();
        let maxWidth = $(window).width() - $('#form-container').width();
        $('#carousel_container,#homepageItems').height(maxHeight).width(maxWidth);

        $('.carousel_image').first().on('load', function () {
            resizeCarouselImage($(this), maxHeight, maxWidth);
        });

        $("#myCarousel").carousel();
        $('#myCarousel').on('slide.bs.carousel', function (e) {
            let image = $(e.relatedTarget).find('img');
            resizeCarouselImage(image, maxHeight, maxWidth);

            if (!$(e.relatedTarget).is(':visible')) {
                $(e.relatedTarget).show();
            }
        }).on('slid.bs.carousel', function (e) {
            if (e.direction == 'left') {
                $('.carousel-item.active').prev().hide();
            } else {
                $('.carousel-item.active').next().hide();
            }
        });
    }

    function resizeCarouselImage(image, maxHeight, maxWidth) {
        $('.carousel-item').removeClass('d-flex justify-content-center');
        $('#homepageItems').removeClass('d-flex align-items-center');
        console.log(image.width(), image.height(), image);
        if (image.width() > image.height()) {
            image.css('width', maxWidth);
            $('#homepageItems').addClass('d-flex align-items-center');
        } else {
            image.css('height', maxHeight);
            image.parent().addClass('d-flex justify-content-center');
        }
    }

    $(window).resize(function () {
        resize();
    });

    window.addEventListener("orientationchange", function () {
        setTimeout(() => {
            resize();
        }, 500);
    }, false);

    function resize() {
        breakpoint = checkSize();
        $('.carousel-item > img')
            .attr('height', $(window).height() - $("#footer").height())
            .attr('width', $("#carousel_container").width());

        loadCarousel();
    }
});