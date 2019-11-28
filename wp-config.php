<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'lab6' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Z{LV7!)8HXu>4LYi7|d!%vym;}sbJ{yzvW!OU&4hkw/b:*_Z+!OPWPj?[II`k4Fv' );
define( 'SECURE_AUTH_KEY',  'aS87lrmrrT5:k`jm| 1a?t5#fW%ojkA6gj1B@@6lTx5a0m/(em_Dw#2S4g%zAs*_' );
define( 'LOGGED_IN_KEY',    'Ai1dK3$OP(P<P6i`pqp2m%>FadF2U3f @ve#w+x%60s82$5ddd#hYVj[n-?pg`Ti' );
define( 'NONCE_KEY',        'Xh1}?eXVM7;)LU~*F UJxZtGTB-kve:7@JP&O/DVO b.~r*PS~u]pH$~S_`?[.9g' );
define( 'AUTH_SALT',        '+n%/0%bhvpZGfNV_p .BL;ZEVy|g_B#TN/SNtx0._+ Kj)Xp~byE%ZUN5pQ7a6SD' );
define( 'SECURE_AUTH_SALT', '7}de6jzpbq.&B(=R6}hbNX=d_QLJ#+EEtB2eU6Yp^.}[RM*}WOtjEI7u:=aQhw-t' );
define( 'LOGGED_IN_SALT',   '0_2UNQSC}a9jGziWS38mC]ny 5zAv#Y #jDy*xD$[a_ahsCW2I7CFN@{%g_UI-pH' );
define( 'NONCE_SALT',       '6_r9@&m{oA!)H:KifDnx2FI8K)%4jH:QGDMc.I][6cf`!7aNsPb%j}:kq[1C^NQc' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
