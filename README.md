<p align="center">
    <h1 align="center">Демо-пример каталога книг</h1>
    <br>
</p>

<p><strong>Task for PHP developer</strong></p>

<p>
1. Create a directory of books, with the possibility of CRUD. Each book must have:
    1.1 Name. (Obligatory field)
    1.2 Brief description. (Optional field)
    1.3 Picture. (jpg or png, no more than 2 MB, must be saved in a separate folder and
        have a unique filename)
    1.4 Authors (Required field, there can be several authors for one book, must
        be able to choose from a list of authors, which is created separately).
    1.5 Date of publication of the book.
2. The list of authors is created separately. It should also be possible to add
    deletion and editing. Each author must have:
    2.1 Surname (Required field, no shorter than 3 characters)
    2.2 Name (Required, not empty)
    2.3 Middle name (Optional)
3. At the output we get:
    3.1 Viewing separately the pages of all books and authors.
    3.2 On the authors page:
        -It should be possible to see all authors.
        -Sorting authors by last name.
        -Search (filter) by last name, first name.
        -Adding, editing implement in modal windows via ajax.
        -Removal.
    3.3 On the books page:
        -It should be possible to see all the books.
        -Sort books by title.
        -Search (filter) by title, author.
        -Adding, editing implement in modal windows via ajax.
        -Removal.
    3.4 Make pagination 15 per page.
4. In the project, be sure to use:
    -Database (mysql).
    - Create tables to implement through the mechanism of migrations.
    -Back-end use Yii2, Laravel or Symfony.

P.S. Visual design at the discretion of the performer.
Provide a link to a repository with instructions for deploying the project.
We give 3 days for the test, if you have any questions - write :)
</p>

<p>Демонстрационный пример каталога книг на фреймворке Yii2:<br>
    https://books.maze.sbs/<br>
    Данные для входа в административную панель (по умолчанию Yii2):<br>
    Логин: demo <br>
    Пароль: demo
</p>

<p> В данном руководстве предполагается, что Git и Composer уже установлен. При необходимости ознакомиться с рекомендованными настройками веб сервера вы можете из [официальной документации Yii2](https://www.yiiframework.com/doc/guide/2.0/ru/start-installation).</p>

Установка
------------

<pre>
    <code>
    git clone https://github.com/dnesteruk/yii2-demo-catalog-book project
    cd project
    composer install
    </code>
</pre>

<p>Создайте базу данных и добавьте данные для доступа в файл <code>config/db.php</code>:</p>
<div class="highlight highlight-text-html-php"><pre><span class="pl-ent">&lt;?php</span>
<span class="pl-k">return</span> [
    <span class="pl-s">'class'</span> =&gt; <span class="pl-s">'yii\db\Connection'</span>,
    <span class="pl-s">'dsn'</span> =&gt; <span class="pl-s">'mysql:host=localhost;dbname=yii2basic'</span>,
    <span class="pl-s">'username'</span> =&gt; <span class="pl-s">'root'</span>,
    <span class="pl-s">'password'</span> =&gt; <span class="pl-s">''</span>,
    <span class="pl-s">'charset'</span> =&gt; <span class="pl-s">'utf8'</span>,
];</pre></div>

<p> Выполните миграции: </p>
<pre>
    <code>
        php yii migrate
    </code>
</pre>
<p>
    Загрузите демонстрационные данные: <br>
    В корне проекта расположена папка backups, которая содержит dump базы данных и архив с демонстрационными изображениями. Распокуйте содержимое архива storage в папку web/storage.</p>
