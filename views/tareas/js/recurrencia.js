$(function() {
    let params = JSON.parse($('script[data-params]').attr('data-params'));
    let baseUrl = Session.getBaseUrl();
    let taskMomentDate = null;

    $('[name="default_recurrence"]').on('change', function() {
        if (+$(this).val() == 0) {
            $('#finish_container').addClass('d-none');
        } else {
            $('#finish_container').removeClass('d-none');
        }

        //personalizar
        if (+$(this).val() == 5) {
            $('#recurrence_container').removeClass('d-none');
        } else {
            $('.custom_option').addClass('d-none');

            switch (+$(this).val()) {
                case 1:
                    $('[name="unity"],[name="period"]')
                        .val(1)
                        .trigger('change');
                    break;
                case 2:
                    $('[name="unity"]').val(1);
                    $('[name="period"]')
                        .val(2)
                        .trigger('change');
                    $('#week_day_container').addClass('d-none');
                    $(`[name="week_day"][value=${taskMomentDate.day()}]`)
                        .prop('checked', true)
                        .trigger('change');
                    break;
                case 3:
                    $('[name="unity"]').val(1);
                    $('[name="period"]')
                        .val(3)
                        .trigger('change');
                    let day = $('[name="month_day"]')
                        .children()
                        .last()
                        .val();
                    $('[name="month_day"]')
                        .val(day)
                        .trigger('change');
                    $('#month_option_container').addClass('d-none');
                    break;
                case 4:
                    $('[name="unity"]').val(1);
                    $('[name="period"]')
                        .val(4)
                        .trigger('change');
                    break;
            }
        }
    });

    $('[name="period"]').on('change', function() {
        //semanas
        if (+$(this).val() == 2) {
            $('#week_day_container').removeClass('d-none');
            $('#month_option_container').addClass('d-none');
        } else if (+$(this).val() == 3) {
            $('#month_option_container').removeClass('d-none');
            $('#week_day_container').addClass('d-none');
        } else {
            $('#month_option_container,#week_day_container').addClass('d-none');
        }
    });

    $('#save_recurrence').on('click', function() {
        let data =
            $('#recurrence_form').serialize() +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                taskId: params.id
            });
        $.post(
            `${baseUrl}app/tareas/guardar_recurrencia.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    top.successModalEvent();
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    });

    (function init() {
        createSelects();
        createDatePicker();
        findData();
    })();

    function createSelects() {
        $('.select2').select2();
    }

    function createDatePicker() {
        $('[name="end_date"]').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD',
            defaultDate: moment()
        });
    }

    function findData() {
        $.post(
            `${baseUrl}app/tareas/consulta_recurrencia.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                taskId: params.id
            },
            function(response) {
                if (response.success) {
                    fillForm(response.data);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    function fillForm(data) {
        taskMomentDate = moment(data.date);
        createRecurrenceOptions(taskMomentDate);
        $(`[name="week_day"][value=${taskMomentDate.day()}]`).prop(
            'checked',
            1
        );

        if (data.recurrence) {
            $('[name="default_recurrence"]')
                .val(data.recurrence)
                .trigger('change');

            $('[name="unity"]').val(data.unity);
            $('[name="period"]')
                .val(data.period)
                .trigger('change');

            //semana
            if (data.period == 2) {
                $(`[name="week_day"][value=${data.option}]`).prop('checked', 1);
            } else if (data.period == 3) {
                //mes
                if (+data.option) {
                    $('[name="month_day"]').val(data.option);
                } else {
                    let day = $('[name="month_day"]')
                        .children()
                        .last()
                        .val();
                    $('[name="month_day"]')
                        .val(day)
                        .trigger('change');
                }
            }

            //mes
            if (+data.finish) {
                $('[name="end"][value=2]').prop('checked', true);
                $('#iterations').val(data.finish);
            } else {
                $('[name="end"][value=1]').prop('checked', true);
                $('[name="end_date"]')
                    .data('DateTimePicker')
                    .defaultDate(moment(data.finish));
            }
        }

        let notifications = data.notifications.length
            ? data.notifications
            : [
                  {
                      type: 2,
                      duration: 10,
                      period: 1
                  }
              ];

        paintNotifications(notifications);
    }

    function paintNotifications(notifications) {
        let div = $('#notification_items');
        notifications.forEach((n, i) => {
            let template = `
                <div class="row pt-2">
                    <div class="col-3">
                        <select name="period" class="form-control d-inline select2 full-width">
                            <option value="1">Días</option>
                            <option value="2">Semanas</option>
                            <option value="3">Meses</option>
                            <option value="4">Años</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-3">
                        <select name="period" class="form-control d-inline select2 full-width">
                            <option value="1">Días</option>
                            <option value="2">Semanas</option>
                            <option value="3">Meses</option>
                            <option value="4">Años</option>
                        </select>
                    </div>
                </div>
            `;
            div.append(template);
        });

        createSelects();
    }

    function createRecurrenceOptions(momentDate) {
        let dayName = momentDate.format('dddd');
        let monthName = momentDate.format('MMMM');
        let dayPosition = getDatePosition(momentDate);
        let labels = [
            'No repetir',
            'Diariamente',
            `Semanalmente los ${dayName}`,
            `Mensualmente el ${dayPosition.es} ${dayName}`,
            `Anualmente el ${momentDate.format('D')} de ${monthName}`,
            'Personalizar'
        ];

        labels.forEach((label, index) => {
            $('[name="default_recurrence"]').append(
                $('<option>', {
                    value: index,
                    text: label
                })
            );
        });

        $('[name="month_day"]').append(
            $('<option>', {
                value: momentDate.format('D'),
                text: `Mensualmente el día ${momentDate.format('D')}`
            }),
            $('<option>', {
                value: JSON.stringify({
                    position: dayPosition.en,
                    day: momentDate.day()
                }),
                text: `Mensualmente el ${dayPosition.es} ${dayName}`
            })
        );
    }

    function getDatePosition(date) {
        let daysToCurrent = date.dates();
        let days = [];
        let clone = date.clone();
        for (let i = 1; i <= daysToCurrent; i++) {
            clone.date(i);
            let day = clone.format('dddd');
            days[day] = ++days[day] || 1;
        }

        let total = days[date.format('dddd')];

        switch (total) {
            case 1:
                var response = {
                    es: 'primer',
                    en: 'first'
                };
                break;
            case 2:
                var response = {
                    es: 'segundo',
                    en: 'second'
                };
                break;
            case 3:
                var response = {
                    es: 'tercer',
                    en: 'third'
                };
                break;
            case 4:
                var response = {
                    es: 'cuarto',
                    en: 'fourth'
                };
                break;
            case 5:
                var response = {
                    es: 'ultimo',
                    en: 'last'
                };
                break;
        }

        return response;
    }
});
