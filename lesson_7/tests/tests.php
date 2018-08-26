<?php
require __DIR__. '/../autoload.php';


use App\Db;
$db = new Db();

// INSERT

$data = $db->execute('INSERT INTO news (title, content) VALUES (:title, :content)',
                        [':title' => 'Новость 10', ':content' => 'The standard chunk of Lorem Ipsum used since the 1500s
                                                                 is reproduced below for those interested. Sections
                                                                 1.10.32 and 1.10.33 from "de Finibus Bonorum et
                                                                 Malorum" by Cicero are also reproduced in their exact
                                                                 original form, accompanied by English versions from
                                                                 the 1914 translation by H. Rackham.

']);
var_dump($data);


// UPDATE
/*
$data = $db->execute('UPDATE news SET title=:title, content=:content WHERE id=:id',
                       [':title' => 'Новость 10', ':content' => 'There are many variations of passages of Lorem Ipsum
                                                                available, but the majority have suffered alteration in
                                                                some form, by injected humour, or randomised words which
                                                                don\'t look even slightly believable. If you are going
                                                                to use a passage of Lorem Ipsum, you need to be sure
                                                                there isn\'t anything embarrassing hidden in the middle
                                                                of text. All the Lorem Ipsum generators on the Internet
                                                                tend to repeat predefined chunks as necessary, making
                                                                this the first true generator on the Internet. It uses
                                                                a dictionary of over 200 Latin words, combined with a
                                                                handful of model sentence structures, to generate Lorem
                                                                Ipsum which looks reasonable. The generated Lorem Ipsum
                                                                is therefore always free from repetition, injected
                                                                humour, or non-characteristic words etc.',
                           ':id' => '14']);

var_dump($data);
*/

//  DELETE

/*
$data = $db->execute('DELETE FROM news WHERE id=:id',
                        [':id' => '11']);
var_dump($data);

*/

