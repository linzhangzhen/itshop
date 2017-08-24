<?php
ob_start();
echo 'aaaaa';
echo  ob_get_level();

ob_start();
echo 'bbbb';
echo  ob_get_level();


ob_start();
echo 'ccccc';
echo  ob_get_level();

