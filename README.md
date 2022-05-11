## Тестовое задание 

Необходимо разработать систему учета заявок, используя стек PHP +
MySQL/PostgreSQL в качестве бэкенда.
Допустимо использование PHP-фреймворков. Нельзя использовать генераторы
кода.
В качестве фронтенда можно использовать любые инструменты на свой вкус.
Система должна включать в себя:
1. Форму подачи заявки для клиентов, включающую в себя:
- ФИО
- Адрес
- Контактные данные (телефон, email)
2. Список заявок для менеджера, с возможностью фильтрации. Фильтры
выбрать по своему усмотрению.
3. Форму для менеджера системы, позволяющую редактировать и
просматривать заявку.
4. Для пунктов 2 и 3 реализовать авторизацию по своему усмотрению.
5. Вывести на отдельной странице отчет в виде графика, отображающего
количество заявок в день.
6. Дизайн для системы выбрать по своему усмотрению.
Результат выложить на github.com и прислать ссылку

## Пару слов об использовании:

1. php artisan serve (запуск)
2. php artisan migrate (выполнение миграций)
3. php artisan db:seed --class=AdminSeeder (создание админа)
4. Заходим на http://127.0.0.1:8000/admin/login (логин: admin , пароль: admin (можно менять в классе AdminSeeder))
5. Создаем менеджера
6. Выходим из админа
7. Дальше пользуемся из-под клиента или из-под менеджера
8. (опционально) Наполнение таблиц городов и клиентов
php artisan db:seed --class=CitySeeder
php artisan db:seed --class=ClientSeeder 

Функционал:
- Создание заявки клиентом
- Просмотр заявок с пагинацией, фильтром по городам и датам для менеджеров
- Удаление заявок для менеджеров
- Редактирование заявок для менеджеров
- График заявок для менеджера с фильтром по датам (по умолчанию за последний месяц)