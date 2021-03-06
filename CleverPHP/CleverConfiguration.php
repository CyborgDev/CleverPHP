<?php
    class CleverConfiguration {
        const MOD_DEV = 'dev';
        const MOD_PROD = 'prod';
        const EXEC_MOD = self::MOD_DEV;

        const LANG_FR = 'fr';
        const LANG_EN = 'en';

        /* PROD Database infos */
            const DATABASE_DRIVER_PROD = 'mysql';
            const DATABASE_HOST_PROD = 'localhost';
            const DATABASE_NAME_PROD = 'N\A';
            const DATABASE_CHARSET_PROD = 'utf8';
            const DATABASE_USERNAME_PROD = 'N\A';
            const DATABASE_PASSWORD_PROD = 'N\A';
        /* -------------------- */

        /* DEV Database infos */
            const DATABASE_DRIVER_DEV = 'mysql';
            const DATABASE_HOST_DEV = 'localhost';
            const DATABASE_NAME_DEV = 'clever_db';
            const DATABASE_CHARSET_DEV = 'utf8';
            const DATABASE_USERNAME_DEV = 'root';
            const DATABASE_PASSWORD_DEV = '';
        /* -------------------- */

        /* PROD Captcha infos */
            const SECRET_KEY_PROD = "N\A";
            const DATA_SITE_KEY_PROD = "N\A";
        /* -------------------- */

        /* DEV Captcha infos */
            const SECRET_KEY_DEV = "6LeGVqoUAAAAAAoliKhEIdncIicQCMLPo6TCL9Rw";
            const DATA_SITE_KEY_DEV = "6LeGVqoUAAAAAOryjRHnVkIzRHnBTgQmEBcYXbQq";
        /* -------------------- */

        const GLOBAL_DEATH_ENABLED = TRUE;

        const INCLUDE_DATATABLES_CSS = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.css"/>';
        const INCLUDE_DATATABLES_SCRIPT = '<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/datatables.min.js"></script>';

        const INCLUDE_SUMMERNOTE_CSS = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.css"/>';
        const INCLUDE_SUMMERNOTE_SCRIPT = '<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-lite.js"></script>';
        
        const INCLUDE_CANVASJS_SCRIPT = '<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>';

        
    }
?>