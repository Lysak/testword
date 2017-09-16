$(document).ready(function(){
    
    /* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */    
    var inProgress = false;
    /* С какой статьи надо делать выборку из базы при ajax-запросе */ 
    var startFrom = 3;

    
        /* Используйте вариант $('#more').click(function() для того, чтобы дать пользователю возможность управлять процессом, кликая по кнопке "Дальше" под блоком статей (см. файл index.php) */
        // $('#more').click(function() {
        $(window).scroll(function() {
            
            /* Если высота окна + высота прокрутки больше или равны высоте всего документа и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос */
            if($(window).scrollTop() + $(window).height() >= $(document).height() && !inProgress) {
        
            $.ajax({            
                /* адрес файла-обработчика запроса */
                url: 'ajax',
                /* метод отправки данных */
                method: 'POST',
                /* данные, которые мы передаем в файл-обработчик */
                data: {"startFrom" : startFrom},
                
                /* что нужно сделать до отправки запрса */
                beforeSend: function() {
                /* меняем значение флага на true, т.е. запрос сейчас в процессе выполнения */
                inProgress = true;}
                /* что нужно сделать по факту выполнения запроса */            
                }).done(function(data){
                
                /* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */ 
                data = jQuery.parseJSON(data);
                // console.log(data);
                
                /* Если массив не пуст (т.е. статьи там есть) */
                if (data.length > 0) {
                    
                /* Делаем проход по каждому результату, оказвашемуся в массиве,
                где в index попадает индекс текущего элемента массива, а в data - сама статья */                 
                $.each(data, function(index, data){
                
                /* Отбираем по идентификатору блок со статьями и дозаполняем его новыми данными */    
                
                var postStrElm =
                    "<div class='col-sm-6 col-md-12'>\
                        <div class='thumbnail blog'>\
                            <h3>" + data.title + "</h3>\
                            <img src='/template/img/news/" + data.id + "\.jpg'>\
                            <p>" + data.short_content + "</p>\
                            <div class='content'>\
                                <div class='post'>\
                                <p> Likes: " + data.likes + "</p>";
                                // console.log(data);
                                // console.log(data.if_like);
                                if (data.if_like == 1) {
                                    postStrElm += '<span><a href="" class="unlike btn btn-primary" role="button" id=' + data.id + '>Unlike</a></span>';
                                } else {
                                    postStrElm += '<span><a href="" class="like btn btn-primary" role="button" id=' + data.id + '>Like</a></span>';
                                }
                                postStrElm +=  
                                "<\div>\
                            <\div>\
                            <p align='center'>\<strong\>Дата публікації: " + data.date + "\</strong\>\<\/p\>\
                            <p align='center'><a href=blog/" + data.id + " class='btn btn-primary' role='button'>Читати</a></p>\
                        <\div>\
                    <\div>";
                    $("#article").append(postStrElm);
                });
                
                /* По факту окончания запроса снова меняем значение флага на false */
                inProgress = false;
                // Увеличиваем на 3 порядковый номер статьи, с которой надо начинать выборку из базы
                startFrom += 3;
                }});   
            }
        });

        // when the user clicks on like
        $('body').on('click', '.like', function () {
        // $('.like').click(function() {
            debugger;
            var postid = $(this).attr('id');
            debugger;
            console.log(postid + 'postid'); 
            // alert('You clicked on ' + postid);
            $.ajax({
                url: 'blog',
                type: 'post',
                async: false,
                data: {
                    'liked': 1,
                    'postid': postid
                },
                success: function() {
                }
            });
        });

        // when the user clicks on unlike
        $('body').on('click', '.unlike', function () {
        // $('.unlike').click(function() {
            debugger;
            var postid = $(this).attr('id');
            debugger;
            // alert('You clicked on ' + postid);
            $.ajax({
                url: 'blog',
                type: 'post',
                async: false,
                data: {
                    'unliked': 1,
                    'postid': postid
                },
                success: function() {
                }
            });
        });
    });