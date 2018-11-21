<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница админ-панели</title>
</head>
<body>
<h3 style="text-align: center;">Админ-панель</h3>
<a href="/lesson_7/home_work1/?ctrl=Admin&action=ViewAdd"><p style="text-align: center;">Добавить новость</p></a><br>
<table border="1">
    <thead>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>content</th>
        <th>author</th>
        <th>edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->articles as $article) { ?>
        <tr>
            <?php foreach($article as $column) { ?>
                <td><?php echo $column; ?></td>
                <?php
                }
                ?>
            <td>
                <a href="/lesson_7/home_work1/?ctrl=Admin&action=ViewUpdate&id=<?php echo $article['id']; ?>">
                    <p style="text-align: center;">обновить новость</p>
                </a>
                <a href="/lesson_7/home_work1/?ctrl=Admin&action=Delete&id=<?php echo $article['id']; ?>">
                    <p style="text-align: center;">удалить новость</p>
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<a href="/lesson_7/home_work1/?ctrl=Index&action=Index"><p style="text-align: center;">Назад на главную</p></a>
<h3 style="text-align: center;">Значения счетчика:</h3>
<h4 style="text-align: center;"><?php echo SebastianBergmann\Timer\Timer::resourceUsage(); ?></h4>
</body>
</html>
