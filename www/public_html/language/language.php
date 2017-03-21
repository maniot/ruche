<?php
//I18N support information here
$language = "en_US.UTF8";
putenv("LANG=".$language);
setLocale(LC_ALL, $language);

//set the text domain as "messages"
$domain = "messages";
bindtextdomain($domain, "Locale");
bind_textdomain_codeset($domain);
textdomain($domain);
?>
