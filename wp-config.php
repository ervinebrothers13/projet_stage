<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'monstage_wp');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Nom de la base de données de stage. */  /*modif ervine rajout de la 2e bdd*/
define('DB_NAME2', 'monstage_bdd');

/** Utilisateur de la base de données MySQL. */
define('DB_USER2', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD2', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST2', 'localhost');



define('NMIN' , 'MINISTERE<br>DE L&rsquo;EDUCATION<br>ET DE l&rsquo;ENSEIGNEMENT SUPERIEUR');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '. 0].7Nu*{~blgn2/vZ=6u=_&/{?BX)?|_*sGWdK|uvD|k%hE@] vd2`@!k$[NwG');
define('SECURE_AUTH_KEY', 'Yz,-a1qM<U:g?=.*=Y,yi&3;).okr+8Kv,5VxY#T4R->rx8Pp.yx^D*UOaG.4! $');
define('LOGGED_IN_KEY', '$x)la1{b,bED jtt;OYu;jC;/VW.O18Xh&+@!;~9kIT;lJljzV[<s(y;y{+l^Gz?');
define('NONCE_KEY', 'q9&pKOPqBl(=vWi2h^eE1v1V?^IPaoK+&YUy:%gVn20fq%{]Y7BTG)mjv<LB7A@4');
define('AUTH_SALT', '/g~Ba)%O;70q^jyzpgM?XXI{F6vZ0HT%?>TRo6x.G%dl_QMSb1ytZp1+G.i=E5RD');
define('SECURE_AUTH_SALT', 'f#XAO$Bj#vdy3m}Sw[-K27o_~WIR)nY7/|xAH}TjQyLPr Z@.7EU)!8Nv}HECQ_3');
define('LOGGED_IN_SALT', ')9@/7<dE*We:GoUWWD/b7k5vxV;xOq]G1=Wkgp,Da6bjQU8d@TpEsWJQQrMu%xr2');
define('NONCE_SALT', ':e,lC/|4l1skY)MKaAcM6P&2n:/s30~cI4wx{Oh3CM|V%_}m~+7/TPuD(M6UXiP:');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'educ_';
define('ALLOW_UNFILTERED_UPLOADS', true);
/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');


