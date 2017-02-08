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
define('DB_NAME', 'joomla');

/** Имя пользователя MySQL */
define('DB_USER', 'joomla');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ja%a}?JgU(^0r2~MgQg5[*(e+?C`]/[},{I^:M)R$F$Lxy)kz:/g.tPjpgX1SRQ+');
define('SECURE_AUTH_KEY',  'p2WBT@v=~45^)[cWm[OTTt`u,3V3)4P]yYY.*mXXLA/]^Yo3(G gRokV<P&QN]~<');
define('LOGGED_IN_KEY',    'U_[YV6Ve^h}`!^.]%/j&1n[oVJ!C8{{bH<~kkal&Q/zQ4q5tAaH3RKnG3`P;>=[i');
define('NONCE_KEY',        '-`jZ=BC*rD3H*;l:^k%+Da7Sb`-HI@UKEE2wHXD;v1EfsgQGl2Hs>S1A6mEUd|tU');
define('AUTH_SALT',        '+nL$sR5l}fp76SP]^7~qn~rfvOqAk /3_+/9CL4>{IW[QX|aDEqk[:4zY0`35,8S');
define('SECURE_AUTH_SALT', 'SX{0LI1WB0isoi@`<^__7T^F,(;p<IL}xWA;86:{]0F:CZu|+RG?*KG_(Cx5KEg.');
define('LOGGED_IN_SALT',   '.4MpA>Omo[1j^,Iml s>tV@8 {cObBi50F_Nth&>-;n9Nw`Sm@hVVpr^<PH>vOKW');
define('NONCE_SALT',       'ocCLgsa)m!b7MRz/IK9uv+~:VBU88Ho?q_kY8K$Ln=CE8uGP mtpEVce!gELHjaP');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
