<?php
    if (isset($_POST['nom']))
    {
       $nom = $_POST['nom'];
        shell_exec('echo -e "'.$nom.'\tIN\tCNAME\tpierre47.fr.">> /etc/bind/db.pierre47.fr');
        shell_exec('touch /etc/apache2/sites-available/'.$nom.'.pierre47.fr.conf');
        shell_exec('mkdir /var/www/'.$nom.'.pierre47.fr');
        shell_exec('mkdir /var/www/'.$nom.'.pierre47.fr/public_html');
        
        shell_exec('echo -e "
        <VirtualHost *:80>\n
  ServerName pierre47.fr\n
  ServerAlias www.pierre47.fr\n
  DocumentRoot /var/www/'.$nom.'.pierre47.fr/public_html\n
  
  CustomLog /var/log/apache2/access.log combined\n
  ErrorLog /var/log/apache2/error.log\n
</VirtualHost> " >> /etc/apache2/sites-available/'.$nom.'.pierre47.fr.conf';)
        
        shell_exec("a2ensite ".$nom.".pierre47.fr.conf");
        shell_exec("systemctl reload apache2");
        shell_exec("service bind9 restart");
    }
   
?>


<form action="index.php" method="post">
                     <label for="nom">Nom du sous domaine :</label><input type="text" name="nom" id="nom"/></br>
                     
                    <input type="submit" value="submit">

                </form>
