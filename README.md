<p align="center">
    <h1 align="center">Creation of a book catalog in Yii2</h1>
    <br>
</p>

<h2>Task for PHP developer.</h2>
<p>  
<ol>
			<li> <strong>Create a directory of books, with the possibility of CRUD. Each book must have:</strong>
				<ol>
					<li>Name. (Required field)</li>
					<li>Brief description. (Optional field)</li>
					<li>Picture. (jpg or png, no more than 2 MB, must be saved in a separate folder and have a unique filename)</li>
					<li>Authors (Required field, there can be several authors for one book, must be able to choose from a list of authors, which is created separately).</li>
					<li>Date of publication of the book</li>
				</ol>
			</li>
			<li> <strong>The list of authors is created separately. It should also be possible to add deletion and editing. Each author must have:</strong>
				<ol>
					<li>Surname (Required field, no shorter than 3 characters)</li>
					<li>Name (Required, not empty)</li>
					<li>Middle name (Optional)</li>
				</ol>
			</li>
			<li> <strong>At the output we get:</strong>
				<ol>
					<li>Viewing separately the pages of all books and authors.</li>
					<li>On the authors page:
						<ul>
							<li>It should be possible to see all authors.</li>
							<li>Sorting authors by last name.</li>
							<li>-Search (filter) by last name, first name.</li>
							<li>Adding, editing implement in modal windows via ajax.</li>
							<li>Removal.</li>
						</ul>
					</li>
					<li>On the books page:
						<ul>
							<li>It should be possible to see all the books.</li>
							<li>Sort books by title.</li>
							<li>Search (filter) by title, author.</li>
							<li>Adding, editing implement in modal windows via ajax.</li>
							<li>Removal.</li>
						</ul>
					</li>
					<li>Make pagination 15 per page.</li>
				</ol>
			</li>
			<li> <strong>In the project, be sure to use:</strong>
				<ol>
					<li>Database (mysql).</li>
					<li>Create tables to implement through the mechanism of migrations.</li>
					<li>Back-end use Yii2, Laravel or Symfony.</li>
				</ol>
			</li>
		</ol>
P.S. Visual design at the discretion of the performer. Provide a link to a repository with instructions for deploying the project. We give 3 days for the test, if you have any questions - write :)
</p>

<h2>Solution of the task.</h2>

<p>Demo: <a href="https://books.maze.sbs/">book catalog on the Yii2 framework</a>.<br>
    Admin panel login details (default Yii2):<br>
    Login: demo <br>
    Password: demo
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
