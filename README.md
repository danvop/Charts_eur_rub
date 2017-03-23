# Курс ЕРВО

### Сравнение курса Евро по данным Европейского ЦБ и Центробанка РФ

Этот мини-проект создан для сравнения расхождения курсов.

Рабочий пример:
[charts.techamm.com](http://charts.techamm.com/)

![Eur rate](https://cloud.githubusercontent.com/assets/5978976/24227442/d1b1ea2c-0fb8-11e7-87f7-2a3747e7e739.png)

Курс получается ежедневно с ЕЦБ и ЦБ РФ посредством скриптов: fetchFromCbrDaily.php, fetchFromEcbDaily.php

### Установка
- Создать файл database.sqlite в корне проекта
- Создать таблицы
```
CREATE TABLE IF NOT EXISTS "cbr_rate" ("id" integer not null primary key autoincrement, "date" datetime null, "rate" real null);

```

-- 

### Использованные технологии и библиотеки:
- Chart.js
- PHP7
- Bootstrap 4
- SQLite database
