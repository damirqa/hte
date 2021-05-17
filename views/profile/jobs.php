<?php
?>

<div class="container-fluid table">
    <table id="table">
        <thead>
        <tr>
            <th data-field="title">Заголовок</th>
            <th data-field="type">Тип работ</th>
            <th data-field="date">Дата</th>
            <th data-field="annotation">Аннотация</th>
            <th data-field="description">Описание</th>
            <th data-field="task_status">Статус</th>
            <th data-field="price" data-formatter="priceFormatter">Стоимость</th>
            <th data-field="id" data-align="center" data-formatter="linkFormatter">Действия</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    var $table = $('#table');
    $table.bootstrapTable({
        url: '/profile/jobs-json',
        pagination: 'true',
        pageList: [5, 10, 15],
        search: 'true',
        showRefresh: 'true',
        showFullscreen: 'true',
        advancedSearch: 'true',
        idTable: 'advancedSearch',
        buttons: buttons(),
        icons: {advancedSearchIcon: 'fa-search-plus', refresh: 'fa-sync', fullscreen: 'fa-arrows-alt'},
        buttonsOrder: ['advancedSearch', 'clearAdvancedSearch', 'refresh']
    });

    function buttons () {
        return {
            clearAdvancedSearch: {
                text: 'Очистить расширенный фильтр',
                icon: 'fa-search-minus',
                event: function () {

                },
                attributes: {
                    title: 'Очистить фильтр'
                }
            },

        }
    }

    function priceFormatter(value) {
        if (value == null) {
            return "Договорная"
        }
        else {
            return value + ' ₽';
        }
    }
</script>