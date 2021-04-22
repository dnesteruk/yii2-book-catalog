<p align="center">
    <h1 align="center">Демо-пример каталога</h1>
    <br>
</p>

<p>Демонстрационный пример в виде [каталога книг](http://nesteryx.beget.tech/) на фреймворке Yii2.<br>
    Данные для входа в административную панель (по умолчанию Yii2): <br>
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
