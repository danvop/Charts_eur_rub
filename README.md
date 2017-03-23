# Курс ЕРВО

### Сравнение курса Евро по данным Европейского ЦБ и Центробанка РФ

Этот мини-проект создан для сравнения расхождения курсов.

Рабочий пример:
[charts.techamm.com](http://charts.techamm.com/)

![Eur rate](https://cloud.githubusercontent.com/assets/5978976/24227442/d1b1ea2c-0fb8-11e7-87f7-2a3747e7e739.png)

Курс получается ежедневно с ЕЦБ и ЦБ РФ посредством скриптов: fetchFromCbrDaily.php, fetchFromEcbDaily.php

### Установка
1. Создать файл database.sqlite в корне проекта
2. Создать таблицы
```
CREATE TABLE IF NOT EXISTS "cbr_rate" ("id" integer not null primary key autoincrement, "date" datetime null, "rate" real null);
CREATE TABLE IF NOT EXISTS "cbr_rate" ("id" integer not null primary key autoincrement, "date" datetime null, "rate" real null);
CREATE TABLE IF NOT EXISTS "dates" ("date" datetime null);

```
3. Наполнить таблицы запустив скрипты:
  ```
  fetchFromCbr.php
  ```
  ```
  fetchFromEcb.php
  ```
  ```
  popDates.php
  ```
1. Make my changes
  1. Fix bug
  2. Improve formatting
    * Make the headings bigger
2. Push my commits to GitHub
3. Open a pull request
  * Describe my changes
  * Mention all the members of my team
    * Ask for feedback


### Использованные технологии и библиотеки:
- Chart.js
- PHP7
- Bootstrap 4
- SQLite database
