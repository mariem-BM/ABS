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
define( 'DB_NAME', 'abshore' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         ' ,oUm~=Pt sSsBdl6MiO}U;z)aq]Mbk80s>2|x7YRs4^|l[eQtE8~Yo-4,D@B/mV' );
define( 'SECURE_AUTH_KEY',  'A`PtN1t%bIvQeTw1]cIhp%y|.p8OmXj3xEP[5Q/130E<T]d7,NWN0hi^ribb]/vj' );
define( 'LOGGED_IN_KEY',    'L6;Ep4go$_Gm/@6%^sp~+JiGczI$k[=xe_P/P{CO +h{#yDut4qnQnfw (.gWK)L' );
define( 'NONCE_KEY',        'RQpX6#B5UxPHc^c 3R$997-%F|=&FhNrv,3-x4l#r.]JT5jbo*9w]OFOS!t#eDd^' );
define( 'AUTH_SALT',        ' Ic  3%t]xUF@2BnEe`@|v:vUw~}9u3$;gO *auT,(E_(I/om]D>BD~A;xen)Xa.' );
define( 'SECURE_AUTH_SALT', ':%?6WjH;,fyRsO[^&ExTga2@svQJ)jC._oGC3N%{.&B~HkeW.]GKl1C084{A6e 5' );
define( 'LOGGED_IN_SALT',   '5`cT|<IZ/r[<L=zJFFgpOi(Yb%q9OlK z]*%bgl}9f5{(rYbkwp^>0]c)X/ g!D7' );
define( 'NONCE_SALT',       '[^UVIu`##&Et:g71Z)h(+x+yr;vAjd^0% gIyt gfrO=%yH*{q~7lF%.0#-QNj?!' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
